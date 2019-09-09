<?php
/*---------- Assigned Test Report-------------*/
function get_all_assigned_reprot_data($data)
{
        global $companyId;
        logger("19",'',$data,5);   
        $condition=array();

        $course = $data['course'];
        $cTest  = $data['cTest'];
        $startDate  = $data['start'];        
        $endDate = $data['end'];
         

            $table_name = 'test_result_'.$companyId."_".$course;
            $sel_field = ' (select  name from material_'.$companyId."_".$course.' where id = '.$table_name.'.`test_id`) as xVal,count(`date`) as yVal';
            $condition = "date(`date`) >= date('".$startDate."') and date(`date`) <= date('".$endDate."')  group by `test_id`";
            $getResult = Select_Some($sel_field,$table_name,$condition); 
            $total_attempt_user = array();
            while($fetRes=mysqli_fetch_assoc($getResult))
            {
                $total_attempt_user[$fetRes['xVal']] = $fetRes['yVal'];
            }  


            $table_name_2 = 'test_result_'.$companyId."_".$course." as tr";
            $sel_field_2 = " (select name from material_".$companyId."_".$course." where id = tr.test_id) as name,if((marks*100/testtm) >= 40, 'pass','fail') as result,count(if((marks*100/testtm) >= 40, 'pass','fail')) as result_count";
            $condition_2 = " date(`date`) >= date('".$startDate."') and date(`date`) <= date('".$endDate."') group by test_id ,if((marks*100/testtm) >= 40, 'pass','fail')  order by  test_id";


            $getResult = Select_Some($sel_field_2,$table_name_2,$condition_2); 
            $allData = array();
            while($fetRes=mysqli_fetch_assoc($getResult))
            {
                $name                = $fetRes['name'];
                $result              = $fetRes['result'];
                $result_count        = $fetRes['result_count'];
                $total_attempt_student  = $total_attempt_user[$name];

                 $allData[$name]['name'] = $name;
                 $allData[$name][$result] = $result_count;
                 $allData[$name]['total'] = $total_attempt_student;

            }
       
           
        return array("success"=>"true","data"=>$allData,"error_code"=>"100");  

}

function get_all_assigned_test_report($data)
{
   $filterFields = json_decode($data['jsonArr'],true);
    $getPageSetting = get_module_page_setting(array("userId"=>$data['userId'],"mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']));

    $defaultFields = array();
    $allFields = array();
    $reportName="";
    if(count($getPageSetting['data']))
    {
        $defaultFields = $getPageSetting['data'][0]['fields'];
        $allFields = $getPageSetting['data'][0]['fields'];
    }
    else
    {

        
        $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array('setting','fields','reportName'));
        $fetdata = add_id($getdata,"id");       
        
        if($fetdata[0])
        {

            $defaultFields = $fetdata[0]['setting']['defaultFields'];
            $allFields = $fetdata[0]['setting']['allFields'];
            $reportName = $fetdata[0]['reportName'];
        }
        
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

    $condition = array();
    $filterFieldsArr = array();
    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            
            case "course":
                $condition['course'] = $value;
                array_push($filterFieldsArr, $value);
            break;
            case "cTest":
                $condition['cTest'] = $value;
                array_push($filterFieldsArr, $value);
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

    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {            
            case "course":
                $courseID  = $value;               
            break;       
           
        }
    }
   
    $tmp = get_all_assigned_reprot_data($condition);
    // Findout total assigned User   
    $enroled_user = get_all_users_enrolled_to_item(array('itemId'=>"$courseID",'mid'=>"2",'smid'=>"1"));    
    $enroled_user = count($enroled_user['data']);

    if(!empty($tmp['data']))
    {

        $tableData = array();
        $chartArr=array();
        $headArr=array();
        
        $newFieldArr=array();

        array_push($headArr, "Name");
        array_push($headArr, "Attempt");
        array_push($headArr, "Pass");
        array_push($headArr, "Fail");
        array_push($headArr, "NotAttempt");

        $allFields = $fetdata[0]['setting']['allFields'];

        /*---------Get All field Name ----------*/
        $allFieldNameArr = array();
        if(!empty($allFields)){
            foreach ($allFields as $key => $value) {
            array_push($allFieldNameArr, $value['fieldName']);
            }
        }       
        /*---------End Get All field Name ----------*/

        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp['data'] as $rowData ) 
        {
            $test_name = $rowData['name'];
            $attemp_std = $rowData['total'];
            
            if (array_key_exists('pass', $rowData)) {
                $pass_std = $rowData['pass'];
            }else{
                 $pass_std = 0;
            }
            if (array_key_exists('fail', $rowData)) {
                $fail_std = $rowData['fail'];
            }else{
                 $fail_std = 0;
            }

            $not_attempt = $enroled_user - $attemp_std;




            $row = array();
            
            $rowchart = array();
           
            array_push($rowchart, $test_name);
            array_push($rowchart, (int)$attemp_std);
            array_push($rowchart, (int)$pass_std);
            array_push($rowchart, (int)$fail_std);
            array_push($rowchart, (int)$not_attempt);        
           
            $row1 = array();
           
            foreach ($allFields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "name":
                        array_push($row,$test_name);                        
                    break;
                    case "no_of_student":
                     array_push($row,$enroled_user);                        
                    break; 
                    case "attempt_student":    
                        array_push($row,$attemp_std);                        
                    break;
                    case "pass":    
                        array_push($row,$pass_std);                        
                    break;
                    case "fail":    
                        array_push($row,$fail_std);                        
                    break;
                                       
                }
                
            } 
               array_push($tableData,$row);
               array_push($chartArr, $rowchart);              
               
            }  

                   
            array_unshift($chartArr, $headArr);        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'allFields'=>$allFields,'allFieldName'=>$allFieldNameArr,'reportName'=>$reportName);

}

function get_single_assigned_reprot_data($data)
{

        global $companyId;
        logger("19",'',$data,5);   
        $condition=array();


       
        $course = $data['course'];
        $cTest  = $data['cTest'];
        $startDate  = $data['start'];        
        $endDate = $data['end'];
        

        $table_name = 'test_result_'.$companyId."_".$course." ,(SELECT @a:= 0) AS a ";

        $sel_field = 'id,content_id,student_id,marks,if((marks*100/testtm) >= 40 , "Pass","Fail") as result, @a:=@a+1 rank,`date`,grade,testtm';

        $condition = "date(`date`) >= date('".$startDate."') and date(`date`) <= date('".$endDate."') and test_id = '".$cTest."' order by CAST(`marks` AS SIGNED) DESC ,`date` asc";

        //"select * from test_result_0_7 where date(`date`) >= date('2016-08-01') and date(`date`) <= date('2016-10-10) and test_id = '13' order by marks desc ,`date` asc";


        $getResult = Select_Some($sel_field,$table_name,$condition); 

        $allData=array();
        while($fetRes=mysqli_fetch_assoc($getResult))
        {
            $allData[$fetRes['date']][] = $fetRes;
        }  
        
        

        return array("success"=>"true","data"=>$allData,"error_code"=>"100");
}



function get_single_assigned_test_report($data)
{
    //print_r($data);die;
    
        $filterFields = json_decode($data['jsonArr'],true);
    $getPageSetting = get_module_page_setting(array("userId"=>$data['userId'],"mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']));

    $fields1 = array();
    $fields2 = array();
    $reportName="";
    if(count($getPageSetting['data']))
    {
        $fields1 = $getPageSetting['data'][0]['fields'];
        $fields2 = $getPageSetting['data'][0]['fields'];
    }
    else
    {

       $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array('setting','fields','reportName'));
        $fetdata = add_id($getdata,"id");
       
        
        if($fetdata[0])
        {

            $defaultFields = $fetdata[0]['setting']['defaultFields'];
            $allFields = $fetdata[0]['setting']['allFields'];
            $reportName=$fetdata[0]['reportName'];
        }
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

    $condition = array();
    $filterFieldsArr = array();
    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            
            case "course":
                $condition['course'] = $value;
                array_push($filterFieldsArr, $value);
            break;
            case "cTest":
                $condition['cTest'] = $value;
                array_push($filterFieldsArr, $value);
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
   
    $tmp = get_single_assigned_reprot_data($condition);
    
    if(!empty($tmp['data']))
    {

        $tableData = array();
        $chartArr=array();
        $headArr=array();
        
        $newFieldArr=array();

        array_push($headArr, "Date");
        array_push($headArr, "Attempt Student");

        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];
        /*---------Get All field Name ----------*/
        $allFieldNameArr = array();
        if(!empty($allFields)){
            foreach ($allFields as $key => $value) {
            array_push($allFieldNameArr, $value['fieldName']);
            }
        }       
        /*---------End Get All field Name ----------*/

        foreach ($tmp['data'] as $date=>$rowData ) 
        {
            $studenArr = $rowData;

            $xVal = $date;
            $yVal = count($studenArr);
            $row = array();
            
            $rowchart = array();
           
            array_push($rowchart, $xVal);
            array_push($rowchart, (int)$yVal);        
           
            $row1 = array();
           
            foreach($studenArr as $singlerecord)
            {
                 $row = array();
                //print_r($singlerecord);
                $studentName = get_users(array('id'=>$singlerecord['student_id']));
                $studentName = $studentName['data'][0]['name'];
                foreach ($allFields as $fkey => $fvalue) 
                {
                   
                    Switch($fvalue['fieldValue'])
                    {
                        case "attemptDate":
                            array_push($row,$singlerecord['date']);                        
                        break;
                        case "studentName":    
                             array_push($row,$studentName);                      
                        break;
                        case "marks":
                          array_push($row,$singlerecord['marks'].' Of '.$singlerecord['testtm']);                        
                        break;  
                        case "grade":
                        if($singlerecord['result']=='Fail')
                        {
                            $rank = 0;
                        }else{
                            $rank = $singlerecord['rank'];
                        }
                        array_push($row,$rank);                        
                        break;                  
                    }
                
                } 
                 array_push($tableData,$row);
            }
               array_push($chartArr, $rowchart);              
               
            }  
               //die;    
            array_unshift($chartArr, $headArr);        
    }
    
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'allFields'=>$allFields,'allFieldName'=>$allFieldNameArr,'reportName'=>$reportName,'reportId'=>$data['report_id']); 
}

/*----------------------*/

?>