<?php

function get_test_status_wise_user_report($data)
{

    $filterFields = json_decode($data['jsonArr'],true);
    $defaultFields = array();
    $allFields = array();
    $reportName="";    
    $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array('setting','fields','reportName'));
    $fetdata = add_id($getdata,"id");       
    $searchFields=array();
    if($fetdata[0])
    {

        $defaultFields = $fetdata[0]['setting']['defaultFields'];
        $allFields = $fetdata[0]['setting']['allFields'];
        $reportName = $fetdata[0]['reportName'];
        $searchFields = $fetdata[0]['setting']['searchFields'][0];
    }

    $allFields = shortArrayByKey($allFields,'order');
    $defaultFields = shortArrayByKey($defaultFields,'order');

    $thead = array();
    $fieldArr = array();

    foreach ($allFields as $fkey => $fvalue) 
    {
        array_push($thead,$fvalue['fieldName']);
        
    }

    foreach ($defaultFields as $fkey1 => $fvalue1) 
    {
       
        array_push($fieldArr,$fvalue1['fieldName']);
    }
    $dropDownArr=array();
    $condition = array();
    $filterFieldsArr = array();
    $allTestInfo=array();
    $course="";
    $cTest="";
    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            
            case "course":
                $condition['course'] = $value;
                $course=$value;
                array_push($filterFieldsArr, $value);
                $dropDownArr[]=array('key'=>'idCourse','value'=>$value);
               
            break;
            case "cTest":
                $condition['cTest'] = $value;
                $cTest=$value;
                array_push($filterFieldsArr, $value);
                $dropDownArr[]=array('key'=>'idtest','value'=>$value);
            break;
            case "fromDate":
                $condition['start'] = $value;
                array_push($filterFieldsArr, $value);
            break;
            case "toDate":
                $condition['end'] = $value;
                array_push($filterFieldsArr, $value);
            break;
           
        }
    }
    $allTestInfo=get_all_test_according_course($course,$cTest);
    //print_r($allTestInfo);die;
    if(!empty($allTestInfo['data'])){foreach ($allTestInfo['data'] as $key => $value) {
       array_push($thead,$value['name']);
       $allFields[]=array('fieldName'=>$value['name'],'fieldValue'=>$value['id']);
       array_push($fieldArr,$value['name']);
    }}
    
    $tmp = get_course_test_status_wise_user_reprot_data($condition);
    //print_r($tmp);die;
    if(!empty($tmp['data']))
    {

        $tableData = array();
        $chartArr=array();
        $headArr=array();
        $newFieldArr=array();
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];
        $sno=1;
        foreach ($tmp['data'] as $rowData ) 
        {
           
            $row = array();
            $rowchart = array();
            $row1 = array();
             $customerInfo = get_users(array('id'=>$rowData['student_id']));
             //print_r($allFields);
            foreach ($allFields as $fkey => $fvalue) 
            {
                //echo $fvalue['fieldValue']."<br>";
                Switch($fvalue['fieldValue'])
                {
                   // echo $fvalue['fieldValue'];
                    case "sno":
                        array_push($row,$sno);
                    break;
                    case "name":    
                        array_push($row,$customerInfo['data'][0]['name']);
                    break;
                    case "email":    
                        array_push($row,$customerInfo['data'][0]['email']);
                    break;
                    
                }
                
            } 
            if(!empty($allTestInfo)){ foreach ($allTestInfo['data'] as $key => $value) {
                 $passFailed=get_pass_failed_data($course,$value['id'],$rowData['student_id']);
                array_push($row,$passFailed);
            } }
            array_push($tableData,$row);
            $sno++;
        }
        
    }
    //print_r($tableData);die;
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName,'report_id'=>$data['report_id'],'dropDownArr'=>$dropDownArr,'course'=>$course);
}


function get_course_test_status_wise_user_reprot_data($data)
{

        global $companyId;
        logger("19",'',$data,5);   
        $condition=array();
        $course = $data['course'];
        $cTest = $data['cTest'];
        if($cTest == -1)
        {
            $table_name = 'test_result_'.$companyId."_".$course. ' group by student_id';
            $sel_field = 'student_id, date';
        }
        else
        {
            $table_name = 'test_result_'.$companyId."_".$course. ' where test_id='.$cTest. ' group by student_id';
            $sel_field = 'student_id, date';
        }
        $getResult = Select_All($sel_field,$table_name); 
        //print_r($getResult);die;
        $allData=array();
        while($fetRes=mysqli_fetch_assoc($getResult))
        {
            array_push($allData,$fetRes);
        }  


        return array("success"=>"true","data"=>$allData,"error_code"=>"100");  
}

function get_all_test_according_course($course,$cTest)
{
       // print_r($course);
       // print_r($cTest);
        global $companyId;

        logger("19",'',$data,5); 
        if($cTest == -1)
        {
            $table_name = 'material_'.$companyId."_".$course. ' where type="test"';
            $sel_field = 'id, name';
        }
        else
        {
            $table_name = 'material_'.$companyId."_".$course. ' where type="test" and id='.$cTest;
            $sel_field = 'id, name';
        }
        $getResult = Select_All($sel_field,$table_name); 
        //print_r($getResult);
        $allData=array();
        while($fetRes=mysqli_fetch_assoc($getResult))
        {
            array_push($allData,$fetRes);
        }  
        //print_r($allData);die;

        return array("success"=>"true","data"=>$allData,"error_code"=>"100");
}


function get_pass_failed_data($course,$cTest,$student_id)
{
    
       global $companyId;
        $table_name = 'test_result_'.$companyId."_".$course. ' where student_id="'.$student_id.'" and test_id='.$cTest;
        $sel_field = '*';
        $getResult = Select_All($sel_field,$table_name); 
        //print_r($getResult);die;
        $allData=array();
        $resultType="N/A";

        while($fetRes=mysqli_fetch_assoc($getResult))
        {   $res=$fetRes['testtm'];
            $result=$fetRes['marks']*100/$fetRes['testtm'];
            if($result<50)
            {
                $resultType="Failed";
            }
            else
            {
                 $resultType="Pass";
            }
        } 
        return $resultType; 
}

 ?>