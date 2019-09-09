<?php
include_once ('../../../../global.php');
function buildArr(array $elements, $parentId = 0) {
    $branch = array();
    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildArr($elements, $element['id']);
            if ($children) {

                $element['perform']['params']['perform'] = $children[0]['perform'];
            }

            $branch[] = $element;
        }
    }
    return $branch;
}

function get_on_failure($value) {
    $on_failure = array_combine($value['setvariablename'], $value['variablevalue']);
    $i = 1;
    foreach ($on_failure as $failure_name => $failure_value) {
        $erroearray[$i - 1] = array('perform' => array('type' => $failure_name, 'params' => array('value' => $failure_value)), 'parent_id' => $i - 1, 'id' => $i);
        $i++;
    }
    $on_failure_Final = buildArr($erroearray);
    unset($on_failure_Final[0]['id']);
    unset($on_failure_Final[0]['parent_id']);
    return $on_failure_Final;
}

if (sizeof($_POST) > 0) {
    $postdata = $_POST;
    unset($postdata['variablenamearray']);
    unset($postdata['variabletypearray']);
    unset($postdata['variabledefaultarray']);
    unset($postdata['nestable_structure']);
    $finalpostsize = sizeof($postdata);
    //For post size end.
    $variablenames[] = array('type' => "string", "name" => "temp_return_result", "value" => "");
    $variablenames[] = array('type' => "string", "name" => "next_action", "value" => "");
    $variablenames[] = array('type' => "string", "name" => "__retry", "value" => "");
    $counterno = 1;
    $taskCounter = 1;
    $nextActionCounter = 2;
    $getfinaldata = array();
    $foreach_obj_counter = 1;
    $while_obj_counter = 1;
    $check_next_child = 1;

    function makeNestableListUsingJSONArray($jsonArray) {
        global $assignwhileCounter;
        global $whileCaseId;
        global $getfinaldata;
        global $counterno;
        global $taskCounter;
        global $nextActionCounter;
        global $finalpostsize;
        global $tasklistArray;
        global $variablenames;
        global $counter_foreach;
        global $foreach_id_next_action;
        global $foreach_obj_counter;
        global $while_obj_counter;
        global $check_next_child;
        global $get_child_index;
        global $final_array;
        global $find_keys_arr;
        global $keys_count_array;
        global $parent_keys;
        $final_array = array();
        global $jsonArrayManualEnteredNextAction;
        $jsonArrayManualEnteredNextAction = json_decode($_POST['manualnextactionarr'], true);
        if(!empty($_GET['insertId'])) {
            $robotListres = select_mongo('robotlist', array('_id' => new MongoId($_GET['insertId'])), array('manual_next_actions'));
            $robotListres = add_id($robotListres, "id");
            if(!empty($robotListres[0]['manual_next_actions'])) {
                $jsonArrayManualEnteredNextAction = array_merge($jsonArrayManualEnteredNextAction, json_decode($robotListres[0]['manual_next_actions'], true));
            }
        }
        $jsonArrayManualEnteredNextAction = array_unique($jsonArrayManualEnteredNextAction);
        for ($i = 0; $i < sizeof($jsonArray); $i++) {
            ///Create data start..
            $sq_key = $jsonArray[$i]['id'];
            $get_form_value['data'] = $_POST[$sq_key];
            if (sizeof($get_form_value['data']) > 0) {
                $id = explode("-", $sq_key);
                /*
                 * Find set Of then & else array
                 */
                $jsonArrayData = json_decode($_POST['nestable_structure'], true);
                if (empty($final_array)) {
                    get_set_in_find($jsonArrayData);
                    /***************End Keys*********************/
                    getNestedFinalData($jsonArrayData, $find_keys_arr);
                }
                if (isset($id['0']) && $id['0'] != "" && $id['0'] == "tasklist") {
                    foreach ($get_form_value as $keys => $taskvalue) {
                        $uniqueid = $_SESSION['user']['name'] . "_" . rand();
                        if (!empty($getfinaldata)) {
                            $tasklistArray['tasklist'][] = array("task_id" => $taskCounter, "uniqueid" => $uniqueid, "userId" => $_SESSION['user']['user_id'], "nm" => "", "actionlist" => $getfinaldata);
                            $counterno = 1;
                            $taskCounter = 1;
                            $nextActionCounter = 2;
                            $getfinaldata = array();
                        }
                        //for task list..
                        $taskarray = getTaskListData(array('id' => $taskvalue['tasklist']));
                        $variableList = $taskarray['data'][0]['variablelist'];
                        $taskarray = $taskarray['data'][0]['robot'][0]['tasklist'];

                        $tasklistArray['tasklist'][] = $taskarray;
                        //$taskCounter++;
                        foreach ($variableList as $key => $variablevalue) {
                            $variablenames[] = $variablevalue;
                        }
                    }
                } else if (isset($id['1']) && $id['1'] != "") {
                    $getdata = get_data_by_table(array("table" => "configure", "id" => $id['1']));
                    $action = $getdata['data'][0]['action'];
                    $tablerecord = $getdata['data'];
                    unset($tablerecord[0]['id']);
                    $tablerecord[0]['action_id'] = intval($counterno);
                    $tablerecord[0]['on_success']['next']['next_action'] = "";
                    foreach ($get_form_value as $value) {
//                        $value['nextAction'] = intval($final_array[$sq_key]['then']);
                        if (isset($value['task']) && !empty($value['task'])) {
                            if ($value['task'] == 'copy_data') {
                                $value['mode'] = $value['copy_data-mode'];
                                unset($value['copy_data-mode']);
                            }
                            if ($value['task'] == 'set_value') {
                                $value['mode'] = $value['set_value-mode'];
                                unset($value['set_value-mode']);
                            }
                            if ($value['task'] == 'click') {
                                $value['mode'] = $value['click-mode'];
                                unset($value['click-mode']);
                            }
                        }
                        if ($action == 'list_operations') {
                            if ($value['type'] == 'append') {
                                $val = $value['value'];
                                $value['value'] = array();
                                $value['position'] ='';
                                $value['reverse'] = '';
                                $value['initial_index'] = '';
                                $value['final_index'] = '';
                                $value['elements'] = '';
                                $value['index'] = array();
                                foreach ($val as $key) {
                                    if ($key != '') {
                                        array_push($value['value'], $key);
                                    }
                                }
                            } else if ($value['type'] == 'insert') {
                                $val = $value['value'];
                                $position = $value['position1'];
                                unset($value['position1']);
                                $value['value'] = array();
                                $value['position'] = $position;
                                $value['reverse'] = '';
                                $value['initial_index'] = '';
                                $value['elements'] = '';
                                $value['final_index'] = '';
                                $value['index'] = array();
                                foreach ($val as $key) {
                                    if ($key != '') {
                                        array_push($value['value'], $key);
                                    }
                                }
                            } else if ($value['type'] == 'delete') {
                                $position = $value['position'];
                                $value['position'] = array();
                                $value['value'] = array();
                                $value['reverse'] = '';
                                $value['initial_index'] = '';
                                $value['elements'] = '';
                                $value['index'] = array();
                                $value['final_index'] = '';

                                foreach ($position as $key) {
                                if ($key != '') {
                                array_push($value['position'], $key);
                                }
                                }

                            } else if ($value['type'] == 'sort') {
                                $value['position'] = '';
                                $value['value'] = array();
                                $value['initial_index'] = '';
                                $value['final_index'] = '';
                                $value['index'] = array();
                                $value['elements'] = '';
                                if ($value['reverse'] != '') {
                                    $value['reverse'] = $value['reverse'];
                                } else {
                                    $value['reverse'] = 'False';
                                }
                            } else if ($value['type'] == 'fetch') {
                                $value['position'] = '';
                                $value['value'] = array();
                                $value['reverse'] = '';
                                $value['elements'] = $value['elements'];
                                $index = $value['index'];
                                $value['index'] = array();
                                foreach ($index as $key) {
                                    if ($key != '') {
                                        array_push($value['index'], $key);
                                    }
                                }
                            } else if ($value['type'] == 'clear' || $value['type'] == 'length' || $value['type'] == 'delete_empty_fields') {
                                $value['position'] = '';
                                $value['value'] = array();
                                $value['reverse'] = '';
                                $value['initial_index'] = '';
                                $value['final_index'] = '';
                                $value['elements'] = '';
                                $value['index'] = array();
                            }
                            unset($value['position1']);
                        } else if ($action == 'dictionary_operations') {
                            if ($value['type'] == 'fetch') {
                                $value['dictionary'] = array();
                                $value['keys'] = array();
                            } else if ($value['type'] == 'append') {
                                $value['fetch_list'] = array();
                                $value['keys'] = array();
                            } else if ($value['type'] == 'delete') {
                                $value['dictionary'] = array();
                                $value['fetch_list'] = array();
                            } else {
                                
                            }
                        } else if ($action == 'table_operations') {
                            if ($value['type'] == 'append') {
                                $value['position'] = array();
                                $list = $value['list'];
                                $value['list'] = array();
                                unset($value['row']);
                                unset($value['column']);
                                unset($value['fetch_data']);
                                unset($value['fetch_type']);
                                unset($value['position1']);
                                foreach ($list as $key) {
                                    if ($key != '') {
                                        array_push($value['list'], $key);
                                    }
                                }
                            } else if ($value['type'] == 'insert') {
                                $list = $value['list'];
                                $value['list'] = array();
                                $value['position'] = '';
                                $value['position'] = $value['position1'];
                                unset($value['position1']);
                                unset($value['row']);
                                unset($value['column']);
                                unset($value['fetch_data']);
                                unset($value['fetch_type']);
                                foreach ($list as $key) {
                                    if ($key != '') {
                                        array_push($value['list'], $key);
                                    }
                                }
                            } else if ($value['type'] == 'delete') {
                                $position = $value['position'];
                                $value['position'] = array();
                                $list = $value['list'];
                                $value['list'] = array();
                                unset($value['row']);
                                unset($value['column']);
                                unset($value['fetch_data']);
                                unset($value['fetch_type']);
                                unset($value['position1']);
                                foreach ($list as $key) {
                                    if ($key != '') {
                                        array_push($value['list'], $key);
                                    }
                                }
                                foreach ($position as $key) {
                                    if ($key != '') {
                                        array_push($value['position'], $key);
                                    }
                                }
                            } else if ($value['type'] == 'size' || $value['type'] == 'clear') {
                                $value['position'] = array();
                                $value['list'] = array();
                                unset($value['row']);
                                unset($value['column']);
                                unset($value['fetch_data']);
                                unset($value['fetch_type']);
                                unset($value['position1']);
                            } else if ($value['type'] == 'fetch') {
                                $value['position'] = array();
                                $value['list'] = array();
                                unset($value['position1']);
                                /*if (isset($value['fetch_type'])) {
                                    $value['fetch_data'] = array();
                                    if ($value['fetch_type'] == 'row') {
                                        $value['fetch_data'] = array('row' => $value['row']);
                                        unset($value['row']);
                                    } else if ($value['fetch_type'] == 'column') {
                                        $value['fetch_data'] = array('column' => $value['column']);
                                        unset($value['column']);
                                    } else if ($value['fetch_type'] == 'element') {
                                        $value['fetch_data'] = array('element' => array($value['row'], $value['column']));
                                        unset($value['row']);
                                        unset($value['column']);
                                    }
                                } else {
                                    
                                }*/
                            } else {
                                
                            }
                        }


                        if (isset($value['setvariablename']) && sizeof($value['setvariablename']) > 0) {
                            if ($value['setvariablename'][0] != "") {
                                $on_failure_Final = get_on_failure($value);
                            }
                        }
                        $tablerecord[0]['nm'] = $value['comment'];
                        $tablerecord[0]['on_success']['next']['wait_time'] = intval($value['wait']);

                        if (isset($value['mode'])) {
                            if (isset($value['location_getvalue']) && $value['location_getvalue'] != "") {
                                $value['location'] = $value['location_getvalue'];
                                unset($value['location_getvalue']);
                            }
                            if (isset($value['location_set_value']) && $value['location_set_value'] != "") {
                                $value['location'] = $value['location_set_value'];
                                unset($value['location_set_value']);
                            }
                            if (isset($value['location_click']) && $value['location_click'] != "") {
                                $value['location'] = $value['location_click'];
                                unset($value['location_click']);
                            }
                        }

                        if (isset($value['returntype']) && $value['returntype'] != "") {
                            $tablerecord[0]['on_success']['return_type'] = $value['returntype'];
                        } else {
                            $tablerecord[0]['on_success']['return_type'] = "none";
                        }

                        if (isset($value['variablename'])) {
                            $tablerecord[0]['on_success']['save'][] = array("var" => $value['variablename'],"path_to_key" => $value['path_to_key']);
                            unset($value['path_to_key']);
                        }
                        if (isset($on_failure_Final[0])) {
                            $tablerecord[0]['on_failure']['error_handle'][0]['val'] = "error";
                            $tablerecord[0]['on_failure']['error_handle'][0]['do'] = $on_failure_Final[0];
                            $on_failure_Final = "";
                        }
                        if ($action == 'drag') {
                            if (isset($value['path_from'])) {
                                $path_from = $value['path_from'];
                                unset($value['path_from']);
                            }
                            if (isset($value['path_to'])) {
                                $path_to = $value['path_to'];
                                unset($value['path_to']);
                            }
                            if (isset($path_from) && isset($path_to) && !empty($path_from) && !empty($path_to)) {
                                $value['path'] = array($path_from, $path_to);
                            } else if (isset($path_from) && isset($path_to)) {
                                $value['path'] = array();
                            }

                            if (isset($value['x_loc_from'])) {
                                $x_loc_from = $value['x_loc_from'];
                                unset($value['x_loc_from']);
                            }
                            if (isset($value['x_loc_to'])) {
                                $x_loc_to = $value['x_loc_to'];
                                unset($value['x_loc_to']);
                            }
                            if (isset($x_loc_from) && isset($x_loc_to) && !empty($x_loc_from) && !empty($x_loc_to)) {
                                $value['x_loc'] = array($x_loc_from, $x_loc_to);
                            } else if (isset($x_loc_from) && isset($x_loc_to)) {
                                $value['x_loc'] = array(0, 0);
                            }


                            if (isset($value['y_loc_from'])) {
                                $y_loc_from = $value['y_loc_from'];
                                unset($value['y_loc_from']);
                            }
                            if (isset($value['y_loc_to'])) {
                                $y_loc_to = $value['y_loc_to'];
                                unset($value['y_loc_to']);
                            }
                            if (isset($y_loc_from) && isset($y_loc_to) && !empty($y_loc_from) && !empty($y_loc_to)) {
                                $value['y_loc'] = array($y_loc_from, $y_loc_to);
                            } else if (isset($y_loc_from) && isset($y_loc_to)) {
                                $value['y_loc'] = array(0, 0);
                            }
                        } else {
                            if ($_POST['type_of_action'] == 'xloc_yloc') {
                                if (isset($value['x_loc'])) {
                                    if($value['x_loc']=="")
                                    {
                                      $value['x_loc'] = 0;  
                                    }
                                    else
                                    {
                                        $value['x_loc'] = intval($value['x_loc']);
                                    }
                                }
                                if (isset($value['y_loc'])) {
                                    if($value['y_loc']=="")
                                    {
                                        $value['y_loc'] = 0;
                                    }
                                    else
                                    {
                                      $value['y_loc'] = intval($value['y_loc']);  
                                    }
                                }
                            } else {
                                
                            }
                        }
                        if($value['y_loc']=="")
                        {
                            $value['y_loc'] = 0;
                        }
                        if($value['y_loc']=="")
                        {
                            $value['y_loc'] = 0;
                        }
                        if (isset($value['row'])) {
                            $value['row'] = $value['row'];
                        }
                        if (isset($value['comment'])) {
                            unset($value['comment']);
                        }
                        if (isset($value['wait'])) {
                            unset($value['wait']);
                        }
                        if (isset($value['nextAction'])) {
                            if($value['nextAction']=="")
                            {
                                unset($value['nextAction']);
                            }
                        }
                        if (isset($value['variablename'])) {
                            unset($value['variablename']);
                        }
                        if (isset($value['setvariablename'])) {
                            unset($value['setvariablename']);
                        }
                        if (isset($value['variablevalue'])) {
                            unset($value['variablevalue']);
                        }
                        if (isset($value['returntype'])) {
                            unset($value['returntype']);
                        }

                        /* if(isset($value['value']) && $value['value']!=""){
                          $value['value']=$value['value'];
                          } */
                        if (isset($value['command']) && $value['command'] != "") {
                            $value['command'] = "[var]" . $value['command'];
                        }if (isset($value['content']) && $value['content'] != "") {
                            $value['content'] = $value['content'];
                        }if (isset($value['sumvalue']) && $value['sumvalue'] != "") {
                            foreach ($value['sumvalue'] as $key => $sumvalue) {
                                $value['value'][] = $sumvalue;
                            }
                            unset($value['sumvalue']);
                        }if (isset($value['filelocation']) && $value['filelocation'] != "") {
                            $value['workbook_name'] = $value['filelocation'];
                        }
//                        if (isset($value['nextAction']) && $value['nextAction'] != "") {
//                            $tablerecord[0]['on_success']['next']['next_action'] = intval($final_array[$sq_key]['then']);
////                            $tablerecord[0]['on_success']['next']['next_action'] = intval($value['nextAction']);
//                        }
                        if(in_array($sq_key, $jsonArrayManualEnteredNextAction) && isset($value['nextAction'])) {
                            $tablerecord[0]['on_success']['next']['next_action'] = intval($value['nextAction']);
                        } else {
                            $tablerecord[0]['on_success']['next']['next_action'] = intval($final_array[$sq_key]['then']);
                        }
                    }
                    if (isset($id['0']) && ($id['0'] == "ifelse")) {
                        $setnxtaction = $nextActionCounter;
                        if ($finalpostsize == $counterno) {
                            $setnxtaction = 0;
                        }

                        //$value['then'] = $setnxtaction;
                        $tablerecord[0]['on_success']['next']['next_action'] = "[var]next_action";

                        // if($id['0']=="while" ){
                        // 	$assignwhileCounter=$nextActionCounter; //for counter while child.
                        // 	$assignwhileCounter=$assignwhileCounter-1;
                        // }
                        $nextActionCounter++;
                    }
                     if (isset($id['0']) && ($id['0'] == "receivemail")) {
                        if($value['check_callback']==true)
                        {
                            $setnxtaction = $nextActionCounter;
                            if ($finalpostsize == $counterno) {
                                $setnxtaction = 0;
                            }

                            $value['then'] = $setnxtaction;
                            $tablerecord[0]['on_success']['next']['next_action'] = "[var]next_action";
                            $nextActionCounter++;
                        }
                    }
                    /* Condition for Looping */
                    if (isset($id['0']) && ($id['0'] == "while" || $id['0'] == "foreach")) {
//                        $value['then'] = $nextActionCounter;
                        $value['then'] = $final_array[$sq_key]['then'];
                        $value['else'] = $final_array[$sq_key]['else'];
                        $check_same_level = sizeof($jsonArray) - 1;
                        $counter_foreach = 0;
                        if ($check_same_level > 0) {
                            if (isset($jsonArray[$i]['children'])) {
                                $find_id = get_last_index($jsonArray[$i]['children']);
                                $foreach_id_next_action[$find_id] = $nextActionCounter - 1;
                            }
                            if (isset($jsonArray[1]) || $check_next_child == 2) { //for check same level 
                                $find = $jsonArray[$check_same_level]['id'];
//                                $value['else'] = nested_array($jsonArrayData, $find, $counter_foreach);
                            } else {
//                                $value['else'] = "0";
                            }
                        } else {
                            //$find=$jsonArray[$check_same_level]['id'];
                            //$value['else']=nested_array($jsonArrayData,$find,$counter_foreach);

                            if (isset($jsonArray[1]) || $check_next_child == 2) { //for check same level 
                                $find = $jsonArray[$check_same_level]['id'];
//                                $value['else'] = nested_array($jsonArrayData, $find, $counter_foreach);
                            } else {
                                $get_child_index = 1;
//                                $value['else'] = "0";
                            }
                        }
//                        if ($check_same_level > 0) {
//                            if (isset($jsonArray[$i]['children'])) {
//                                $find_id = get_last_index($jsonArray[$i]['children']);
//                                $foreach_id_next_action[$find_id] = $nextActionCounter - 1;
//                            }
//                            if ($check_same_level != $i) {
//                                $count = $i + 1;
//                                if (isset($jsonArray[1]) || $check_next_child == 2) { //for check same level 
//                                    $find = $jsonArray[$count]['id'];
//                                    $value['else'] = nested_array($jsonArray, $find, $counter_foreach);
////                                if($value['else'] == $tablerecord[0]['action_id']) {
////                                    $value['else'] = "0";
////                                }
//                                } else {
//                                    $value['else'] = "0";
//                                }
//                            } else if($check_same_level == $i) {   
//                                $find = $jsonArray[$check_same_level-1]['id'];
//                                $value['else'] = nested_array($jsonArray, $find, $counter_foreach);
//                            } else {
//                                $value['else'] = "0";
//                            }
//                        } else {
//                            
//                            //$find=$jsonArray[$check_same_level]['id'];
//                            //$value['else']=nested_array($jsonArrayData,$find,$counter_foreach);
//
//                            if (isset($jsonArray[1]) || $check_next_child == 2) { //for check same level 
//                                $find = $jsonArray[$check_same_level]['id'];
//                                $value['else'] = nested_array($jsonArray, $find, $counter_foreach);
//                            } else {
//                                $get_child_index = 1;
//                                $value['else'] = "0";
//                            }
//                        }
                        if ($id['0'] == "foreach") {
                            $check_next_child = 2;
                            $value['loop_obj'] = "[var]for_each" . $foreach_obj_counter;
                            $variable_name_each = "for_each" . $foreach_obj_counter;
                            $variablenames[] = array("type" => "number", "name" => $variable_name_each, "value" => "-1");
                            $foreach_obj_counter++;
                        }
                        if ($id['0'] == "while") {
                            $check_next_child = 2;
                            $value['loop_obj'] = "[var]while" . $while_obj_counter;
                            $variable_name_each = "while" . $while_obj_counter;
                            $variablenames[] = array("type" => "number", "name" => $variable_name_each, "value" => "-1");
                            $while_obj_counter++;
                        }
                        $tablerecord[0]['on_success']['next']['next_action'] = "[var]next_action";
                        $nextActionCounter++; //use for nextaction field is not empty..	
                    }
                    
                    if ($tablerecord[0]['on_success']['next']['next_action'] == "") {
                        $nextActionVal = intval($final_array[$sq_key]['then']);
                        if(in_array($sq_key, $jsonArrayManualEnteredNextAction) && isset($value['nextAction'])) {
                            $nextActionVal = intval($value['nextAction']);
                        }
                        if ($finalpostsize == $counterno) {
                            $zero = 0;
                            $tablerecord[0]['on_success']['next']['next_action'] = $nextActionVal;
                        } else {
                            $tablerecord[0]['on_success']['next']['next_action'] = $nextActionVal;
                        }
                        if ($finalpostsize == $counterno && $get_child_index == 1) {
                            $get_child_index = 2;
                            $tablerecord[0]['on_success']['next']['next_action'] = $nextActionVal;
                        }

                        //foreach  check condition..
                        if (!empty($foreach_id_next_action)) {
                            $check_key = array_keys($foreach_id_next_action);
                            if (in_array($sq_key, $check_key)) {
                                $index_val = $foreach_id_next_action[$sq_key];
                                $tablerecord[0]['on_success']['next']['next_action'] = $nextActionVal;
                            }
                        }
                        if (sizeof($get_form_value['data']) > 0) {
                            $nextActionCounter++;
                        }
                    }

                    
                    foreach ($getdata['data'][0]['data'] as $key => $formvalue) {
                        $search = "[var]";
                        $checkdata = "";
                        $pos = strripos($formvalue, "[var]");
                        if ($pos === false) {
                            
                        } else {

                            $variablename = str_replace("[var]", "", $formvalue);
                            $variablenames[] = array("type" => "string", "name" => $variablename, "value" => "");
                        }
                    }
                    if (sizeof($get_form_value['data']) > 0) {
                        $getadddata['data'] = array_merge($getdata['data'][0]['data'], $value);
                        $getfinaldata[] = array_merge($tablerecord[0], $getadddata);
                        $counterno++;
                    }
                }
            } else {
                $finalpostsize++;
            }
            ///Create data end..
            if (is_array($jsonArray[$i]['children'])) {
                //$lastIndex=sizeof($jsonArray[$i]['children'])-1;
                //$whileCaseId=$jsonArray[$i]['children'][$lastIndex]['id'];
                makeNestableListUsingJSONArray($jsonArray[$i]['children']);
            }
        }
    }

    /*
     * Get All Find Keys From Nested Hierarchy
     */

    function get_set_in_find($jsonArrayData) {
        global $keys_count_array;
        $keys_count = 0;
        global $parent_keys;
        global $find_keys_arr;
        $find_keys_arr = array();
        foreach ($jsonArrayData as $val) {
            $keys_count++;
            $keys_count_array[$val['id']] = $keys_count;
            $tmp_parent_key = 0;
            $parent_keys[$val['id']] = $tmp_parent_key;
//            if(strpos($val['id'], 'foreach') !== false || strpos($val['id'], 'while') !== false) {
            array_push($find_keys_arr, $val['id']);
//            }
            if (!empty($val['children'])) {
                $tmp_parent_key = $keys_count;
                find_keys($val['children'], $keys_count, $find_keys_arr, $tmp_parent_key);
            }
        }
    }

    /*
     * Child Method of get_set_in_find
     * For Nested
     */

    function find_keys($val, &$keys_count, &$find_keys_arr, $tmp_parent_key) {
        global $keys_count_array;
        global $parent_keys;
        foreach ($val as $k => $v) {
            $keys_count++;
            $parent_keys[$v['id']] = $tmp_parent_key;
            $keys_count_array[$v['id']] = $keys_count;
            //        if(strpos($v['id'], 'foreach') !== false || strpos($v['id'], 'while') !== false) {
            array_push($find_keys_arr, $v['id']);
            //        }
            if (!empty($v['children'])) {
                //            $tmp_parent_key = $keys_count;
                find_keys($v['children'], $keys_count, $find_keys_arr, $keys_count);
            }
        }
    }

    /*
     * Find the Then & else from nested tree
     */

    function getNestedFinalData($jsonArrayData, $find_keys_arr) {
        global $final_array;
        global $keys_count_array;
        global $parent_keys;
        $nested_count = 1;
        foreach ($jsonArrayData as $key => $val) {
            $nested_count++;
            if (in_array($val['id'], $find_keys_arr)) {
                $else = 0;
                if (!empty($jsonArrayData[$key + 1])) {
                    $else = $keys_count_array[$jsonArrayData[$key + 1]['id']];
                } else {
                    $else = $parent_keys[$val['id']];
                }
                if (!empty($val['children'])) {
                    $final_array[$val['id']] = array('then' => $nested_count, 'else' => $else);
                } else {
                    if (!empty($jsonArrayData[$key + 1])) {
                        $final_array[$val['id']] = array('then' => $nested_count);
                    } else {
                        $final_array[$val['id']] = array('then' => $parent_keys[$val['id']]);
                    }
                }
            }
            if (!empty($val['children'])) {
                getChildNestedFinalData($jsonArrayData, $val['children'], $find_keys_arr, $nested_count);
            }
        }
    }

    /*
     * Child function to Find the Then & else from nested tree
     */

    function getChildNestedFinalData($jsonArrayData, $req_data, $find_keys_arr, &$nested_count) {
        global $final_array;
        global $keys_count_array;
        global $parent_keys;
        foreach ($req_data as $req_key => $req_val) {
            $nested_count++;
            if (in_array($req_val['id'], $find_keys_arr)) {
                $else = 0;
                if (!empty($req_data[$req_key + 1])) {
                    $else = $keys_count_array[$req_data[$req_key + 1]['id']];
                } else {
                    $else = $parent_keys[$req_val['id']];
                }
                if (!empty($req_val['children'])) {
                    $final_array[$req_val['id']] = array('then' => $nested_count, 'else' => $else);
                } else {
                    if (!empty($req_data[$req_key + 1])) {
                        $final_array[$req_val['id']] = array('then' => $nested_count);
                    } else {
                        $final_array[$req_val['id']] = array('then' => $parent_keys[$req_val['id']]);
                    }
                }
            }
            if (!empty($req_val['children'])) {
                getChildNestedFinalData($jsonArrayData, $req_val['children'], $find_keys_arr, $nested_count);
            }
        }
    }

    function get_last_index($dataArray) {
        $sizeIndex = sizeof($dataArray) - 1;
        $Index = $dataArray[$sizeIndex]['id'];
        return $Index;
    }

    function nested_array($datafinal, $find, $counter) {
        foreach ($datafinal as $value) {
            $res = rec($value, $find, $counter, array('counter' => $counter, 'find_status' => 0));
            if ($res['find_status'] == 1) {
                return $res['counter'];
            }
        }
    }

    function rec($mainArr, $find, &$counter, $res) {
        $counter++;
        if (array_key_exists('children', $mainArr)) {
            $i = 1;
            $p_id = 0;
            if ($mainArr['id'] == $find) {
                return array('counter' => $counter, 'find_status' => 1);
            }
            $total_cnt_arr = count($mainArr['children']);
            $t_id = $mainArr['children'][$total_cnt_arr - 1]['id'];
            $t_id_arr = explode('-', $t_id);
            if ($t_id_arr[0] == 'foreach') {
                $p_id_arr = explode('-', $mainArr['id']);
                $p_id = $p_id_arr[2];
            }
            foreach ($mainArr['children'] as $subArr) {
                $res = rec($subArr, $find, $counter, array('counter' => $counter, 'find_status' => 0));
                if ($i == $total_cnt_arr && $p_id != 0 && $res['find_status'] == 1) {
                    return array('counter' => $p_id, 'find_status' => 1);
                }

                if ($res['find_status'] == 1) {
                    return array('counter' => $counter, 'find_status' => 1);
                }
                $i++;
            }
        } else {
            if ($mainArr['id'] == $find) {
                return array('counter' => $counter, 'find_status' => 1);
            } else {
                return array('counter' => $counter, 'find_status' => 0);
            }
        }
    }

    $get_sequence_index = "";
    if (isset($_POST['nestable_structure']) && $_POST['nestable_structure'] != "") {
        $get_sequence_index = json_decode($_POST['nestable_structure'], true);
        makeNestableListUsingJSONArray($get_sequence_index);
    }
    //variable array..
    if (isset($_POST['variablenamearray']) && $_POST['variablenamearray'] != "") {
        $namevar = explode(",", $_POST['variablenamearray']);
        $typevar = explode(",", $_POST['variabletypearray']);
        $defvar = explode("|", $_POST['variabledefaultarray']);
        $lenghtTblVar = sizeof($defvar); 
        for ($variabearr = 0; $variabearr < sizeof($namevar); $variabearr++) {
            if ($typevar[$variabearr] == "list") {
                $listarray = explode(":", $defvar[$variabearr]);
                $variablenames[] = array("type" => $typevar[$variabearr], "name" => $namevar[$variabearr], "value" => $listarray);
            } else if ($typevar[$variabearr] == "table") {
                $variablenames[] = array("type" => $typevar[$variabearr], "name" => $namevar[$variabearr], "value" => $defvar[$lenghtTblVar-1]);
            } else {
                $variablenames[] = array("type" => $typevar[$variabearr], "name" => $namevar[$variabearr], "value" => $defvar[$variabearr]);
            }
        }
    }
    if (sizeof($getfinaldata) > 0 || sizeof($tasklistArray) > 0) {
        $title = "";
        if (isset($_GET['title']) && $_GET['title'] != "") {
            $title = $_GET['title'];
        }
        $submit_type = "";
        if (isset($_GET['submit_type']) && $_GET['submit_type'] != "") {
            $submit_type = $_GET['submit_type'];
        }
        $final_variablenames = unique_multidim_array($variablenames, 'name');
        $final_variablenames_arr=array();
        foreach($final_variablenames as $new_final_var)
        {
            if($new_final_var['type']=='table'){
                $final_variablenames_arr[] = array('type'=>$new_final_var['type'],'name'=>$new_final_var['name'],'value'=>json_decode($new_final_var['value']));   
            }
            else
            {
                $final_variablenames_arr[] = array('type'=>$new_final_var['type'],'name'=>$new_final_var['name'],'value'=>$new_final_var['value']);
            }   
        }
        $uniqueid = $_SESSION['user']['name'] . "_" . rand();
        if (sizeof($getfinaldata) > 0) {
            $tasklistArray['tasklist'][] = array("task_id" => $taskCounter, "uniqueid" => $uniqueid, "userId" => $_SESSION['user']['user_id'], "nm" => "", "actionlist" => $getfinaldata);
        }
        $submitdata[] = $tasklistArray;
        $insertId = "0";
        if ($_GET['insertId'] != "") {
            $insertId = $_GET['insertId'];
        }
        $responseAddRobot = add_robot(array("id" => $insertId, "robot" => $submitdata, "variablelist" => $final_variablenames_arr, 'manual_next_actions' => !empty($jsonArrayManualEnteredNextAction) ? json_encode($jsonArrayManualEnteredNextAction) : null, 'title' => $title, "createdBy" => $_SESSION['user']['user_id'], 'nestable_structure' => $_POST['nestable_structure'], 'submit_type'=> $submit_type));
        if ($responseAddRobot['success'] == "true" && $responseAddRobot['error_code'] == '201') {
            //echo $responseAddRobot['data'];
            echo json_encode(array('data'=>$responseAddRobot['data'],'error_code'=>'201'));
        }
        else if ($responseAddRobot['success'] == "true") {
            //echo $responseAddRobot['data'];
            echo json_encode(array('data'=>$responseAddRobot['data']));
        } else {
            if ($responseAddRobot['error_code'] == '117') {
                //echo "117";
                echo json_encode(array('data'=>'117'));
            }
            else {
                //echo "0";
                echo json_encode(array('data'=>'0'));
            }
        }
    } else {
        //echo "0";
        echo json_encode(array('data'=>'0'));
    }
} else {

    //echo "3";
    echo json_encode(array('data'=>'3'));
}

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            if($val['type'] == 'number') {
                $val['value'] = (int)$val['value'];
            }
            $key_array[$i] = $val[$key];
            $temp_array[] = $val;
        }
        $i++;
    }
    return $temp_array;
}
?>