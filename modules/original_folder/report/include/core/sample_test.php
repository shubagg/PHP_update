<?php

/* Start sample test report*/

function get_sample_reprot_data($data)
{
        global $companyId;
        logger("19",'',$data,5);   
        $condition=array();

        $course = $data['course'];
        $cTest  = $data['cTest'];
        $startDate  = $data['start'];        
        $endDate = $data['end'];
        $end = new MongoDate(strtotime($dt1));

        if($cTest == -1)
        {

            //SELECT (select name from material_0_5 where id = tr.test_id) as name,if((marks*100/testtm) >= 40, 'pass','fail') as result,count(if((marks*100/testtm) >= 40, 'pass','fail')) as result_count  FROM `test_result_0_5` as tr where date(`date`) >= date('2016-08-01') and date(`date`) <= date('2016-10-11') group by test_id ,if((marks*100/testtm) >= 40, 'pass','fail')  order by  test_id ;

            //"select (select  name from material_0_5 where id = test_result_0_5.`test_id`) as xVal,count(`date`) as yVal from test_result_0_5 where date(`date`) >= date('2016-08-01') and date(`date`) <= date('2016-10-11')  group by `test_id`"

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

        }
        else
        {
            $table_name = 'test_result_'.$companyId."_".$course;
            $sel_field = '`date` as xVal,count(`date`) as yVal';
            $condition = "date(`date`) >= date('".$startDate."') and date(`date`) <= date('".$endDate."') and test_id = '".$cTest."' group by `date`";


             $getResult = Select_Some($sel_field,$table_name,$condition); 
            $allData=array();
            while($fetRes=mysqli_fetch_assoc($getResult))
            {
                array_push($allData,$fetRes);
            }  

                      
        }
        
        
        return array("success"=>"true","data"=>$allData,"error_code"=>"100");  
}





function get_sample_test_report($data)
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
   
    $tmp = get_sample_reprot_data($condition);
    
    if(!empty($tmp['data']))
    {

        $tableData = array();
        $chartArr=array();
        $headArr=array();
        
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        $newFieldArr=array();
        if($condition['cTest']==-1)
        {
             
             array_push($headArr, "Name");
             array_push($headArr, "Attempt");
             array_push($headArr, "Pass");
             array_push($headArr, "Fail");             
       
             // name,pass,fail,total
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

            $row = array();
            
            $rowchart = array();
           
            array_push($rowchart, $test_name);
            array_push($rowchart, (int)$attemp_std);
            array_push($rowchart, (int)$pass_std);
            array_push($rowchart, (int)$fail_std);        
           
            $row1 = array();
            foreach ($allFields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "name":
                        array_push($row,$test_name);
                        $row1[] = $test_name;
                    break;
                    case "id":    
                        array_push($row,$attemp_std);
                        $row1[] = $attemp_std;
                    break;
                    
                }
                
            } 
               array_push($tableData,$row);
               array_push($chartArr, $rowchart);
              
               $newFieldArr[]=$row1;
            }

            
            array_unshift($chartArr, $headArr);


        }
        else
        {
             array_push($headArr, "Date");
             array_push($headArr, "Total Counting");

            foreach ($tmp['data'] as $rowData ) 
            {
                $xVal = $rowData['xVal'];
                $yVal = $rowData['yVal'];
                $row = array();
                
                $rowchart = array();
               
                array_push($rowchart, $xVal);
                array_push($rowchart, (int)$yVal);        
               
                $row1 = array();
                foreach ($allFields as $fkey => $fvalue) 
                {

                    Switch($fvalue['fieldValue'])
                    {
                        case "name":
                            array_push($row,$xVal);
                            $row1[] = $xVal;
                        break;
                        case "id":    
                            array_push($row,$yVal);
                            $row1[] = $yVal;
                        break;
                        
                    }
                    
                } 
                   array_push($tableData,$row);
                   array_push($chartArr, $rowchart);
                  
                   $newFieldArr[]=$row1;
                }

                
                array_unshift($chartArr, $headArr);
            }

        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName);

}


/*End sample test report */
?>