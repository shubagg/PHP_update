<?php

include_once("../../../../global.php");
$adminUiPath="https://$_SERVER[HTTP_HOST]/$folder/extensions/form/ui/";

/*
 * 
 * Data Table Ajax
 * 
 */
/* IF Query comes from DataTables do the following */

if (!empty($_POST)) {
    /*
     * Database Configuration and Connection using mysqli
     */
    
    $recordsTotal = 0;
    $post_data = array("smid" => '3','userid' =>$_POST['user'],'form_id'=>$_POST['formid']);

    

    /* changed end */
    $recordsFiltered = array();
    $final_data=array();
    $data = array();
    /* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start = $_POST["start"]; //Paging first record indicator.
    $length = $_POST['length']; //Number of records that the table can display in the current draw
    /* END of POST variables */
    /* SEARCH CASE : Filtered data */
    if (!empty($_POST['search']['value'])) {
        /* WHERE Clause for searching */
        $where = array();

        for ($i = 0; $i < count($_POST['columns']); $i++) {
           if($_POST['columns'][$i]['data'] == 'title' || $_POST['columns'][$i]['data'] == 'id' || $_POST['columns'][$i]['data'] == 'date')
           {

                $column = 'job.'.$_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request
                $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
           }
           

           /* if ($_POST['columns'][$i]['data'] == 'title') {
                $column = 'title'; //we get the name of each column using its index from POST request
                $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
            } else {

                echo "ssss"; die;
                $column = $_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request
                $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
            }*/
        }

        $post_data['search_value'] = implode(" OR ", $where); // id like '%searchValue%' or name like '%searchValue%' ....
        //echo $post_data['search_value']; die;
        /* End WHERE */
        //echo "<pre>"; print_r($post_data); die;

    }
    
    /* END SEARCH */ else {
        /*if ($orderBy == 'title') {
            $orderBy = 'id';
        }
        if ($orderBy == 'id' || $orderBy == 'date' || $orderBy == 'department' || $orderBy == 'current_owner') {
            $orderBy = 'id';
        }
        $post_data['orderby'] = "`{$orderBy}`  {$orderType}";*/
    }
   

    $post_data['order_col'] = $orderBy;
    $post_data['order_by'] = $orderType;
    $post_data['adv_where'] = $_POST['adv_where'];
    $post_data['get_total'] = 1;


    
    unset($post_data['get_total']);
    
    if($_POST['api_action'] == 'get_pending_formjob')
    {

        $total_data_count =get_pending_formjob_count($post_data);

        $recordsTotal = $total_data_count['data'];
        $post_data['offset'] = $start;
        $post_data['limit'] = $length;
        $recent_tickets = get_pending_formjob($post_data); 
        
 
    }

//echo "<pre>"; print_r($recent_tickets); die;
   
    if (!empty($recent_tickets['data']) && $recent_tickets['success'] == 'true') {
        $data = $recent_tickets['data'];
    }

 /* echo "<pre>";
      print_r($recent_tickets);
      echo "</pre>";
    die;*/


   
    $recordsFiltered = $recordsTotal;
    /* setting status */




    if (!empty($data)) {
      /*  $uisetting = curl_post("/get_module_setting_by_mid", array("mid" => '5', "smid" => '3'));
        $uisetting = $uisetting['data'][0]['uiSetting'];
        $setting_array = array();
        foreach ($uisetting as $uikey => $uivalue) {
            if (in_array($uikey, array("status"))) {
                $ui_setting = array();
                $key_id = $uikey . "Id";
                for ($counts = 0; $counts < count($uisetting[$uikey]); $counts++) {
                    $ui_setting[$uisetting[$key_id][$counts]] = $uisetting[$uikey][$counts];
                }
                if (count($ui_setting)) {
                    $setting_array[$uikey] = $ui_setting;
                }
            }
        }*/
        $data = $recent_tickets['data'];

        if (!empty($data)) {
            foreach ($data as $val) {

                 
        
                 
                    $val['date']=date('Y-m-d',$val['time']);
                    
                  
                    if($_POST['formtype']=='pendingform')
                    {

                        $user_id = $val['creator'];
                        $user_details = curl_post("/get_user_info_by_id", array("id" => $user_id));
                        if(isset($user_details['data']['0']) && $user_details['data']['0']!=''){
                          $val['creator'] = $user_details['data']['0']['name'];
                        }else {
                           $val['creator'] = '---' ;
                        }
                        

                    }
                 

                    if($_POST['formtype']=='pendingform') {
                        
                        $val['title']='<a href="'.$adminUiPath.'formdetail.tpl.php?type=formcreate&jobId='.$val['id'].'&formtype=pendingform&formid='.$val['form_id'].'"><b>'.$val['title'].'</b></a>';
                    }
                 
                    
              
                  
                   
               
                    $final_data[] = $val;

 
            }
        }

    }
    /* END of Setting status */
    /* Response to client before JSON encoding */
    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $final_data
    );
    echo json_encode($response);
} else {
    echo "NO POST Query from DataTable";
}
?>
