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

        $allData=array();
        while($fetRes=mysqli_fetch_assoc($getResult))
        {
            array_push($allData,$fetRes);
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
        array_push($headArr, "Attempt Student");

        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp['data'] as $rowData ) 
        {
            $xVal = $rowData['xVal'];
            $yVal = (int)$rowData['yVal'];
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
                    break;
                    case "attempt_student":    
                        array_push($row,$yVal);                        
                    break;
                    case "no_of_student":
                     array_push($row,$enroled_user);                        
                    break;                    
                }
                
            } 
               array_push($tableData,$row);
               array_push($chartArr, $rowchart);              
               
            }  

                   
            array_unshift($chartArr, $headArr);        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'allFields'=>$allFields,'reportName'=>$reportName);

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
        

		$table_name = 'test_result_'.$companyId."_".$course;

        $sel_field = 'id,content_id,student_id,questions,answers,marks,avg_marks,`date`,grade,testtm';

        $condition = "date(`date`) >= date('".$startDate."') and date(`date`) <= date('".$endDate."') and test_id = '".$cTest."' order by `date` asc";

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
            	$studentName = get_users(array('id'=>$order['userId']));
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
	                      array_push($row,$singlerecord['grade']);                        
	                    break;                  
	                }
                
            	} 
            	 array_push($tableData,$row);
            }
               array_push($chartArr, $rowchart);              
               
            }  
                   
            array_unshift($chartArr, $headArr);        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'allFields'=>$allFields,'reportName'=>$reportName,'reportId'=>$data['report_id']); 
}

/*----------------------*/

?>