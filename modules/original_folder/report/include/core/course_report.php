<?php

function get_course_wise_report($data)
{
	$filterFields = json_decode($data['jsonArr'],true);
    $defaultFields = array();
    $allFields = array();
    $reportName="";    
    $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array('setting','fields','reportName'));
    $fetdata = add_id($getdata,"id");       
    
    if($fetdata[0])
    {

        $defaultFields = $fetdata[0]['setting']['defaultFields'];
        $allFields = $fetdata[0]['setting']['allFields'];
        $reportName = $fetdata[0]['reportName'];
    }

    $allFields = shortArrayByKey($allFields,'order');
    $defaultFields = shortArrayByKey($defaultFields,'order');

    $thead = array();
    $fieldArr = array();
    $course="";
    $cTest="";
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

    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            
            case "course":
                $condition['course'] = $value;
                array_push($filterFieldsArr, $value);
                $course=$value;
                $dropDownArr[]=array('key'=>'idCourse','value'=>$value);
            break;
            case "cTest":
                $condition['cTest'] = $value;
                $cTest=$value;
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
  
    $tmp = get_course_wise_reprot_data($condition);
    $analytics_data = getEmployeeRankCalculation($condition);

   

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
            foreach ($allFields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "sno":
                        array_push($row,$sno);
                    break;
                     case "name":    
                        array_push($row,$customerInfo['data'][0]['name']);
                    break;
                    case "email":    
                        array_push($row,$customerInfo['data'][0]['email']);
                    break;
                    case "uploadedOn":
                        array_push($row,$rowData['date']);
                    break;
                    case "test":
                        array_push($row,$rowData['total']);
                    break;
                    
                }
                
            } 
            array_push($tableData,$row);
            $sno++;
        }

        // chart data 
        $chartHeadArr=array();        
        array_push($chartHeadArr, "Test");
        array_push($chartHeadArr, "Attempt");
        array_push($chartHeadArr, "Pass");
        array_push($chartHeadArr, "Fail");

        $tempChartArr =  $analytics_data['data']['chart_data'];        
        foreach($tempChartArr as $test_id=>$chartRow)
        {
            $rowchart = array();
            array_push($rowchart, $test_id);
            array_push($rowchart, 20);
            array_push($rowchart, intval($chartRow['pass']));
            array_push($rowchart, intval($chartRow['fail']));

            array_push($chartArr, $rowchart);
            
        }
        array_unshift($chartArr, $chartHeadArr);


        // Top Student Test Wise
         $tempTopStudTestWise =  $analytics_data['data']['top_stud']; 
         foreach($tempTopStudTestWise as $row)
         {
             $customerInfo = get_users(array('id'=>$row['student_id']));

            $topStudTestWise[] = array('studentName'=>$customerInfo['data'][0]['name'],'testName'=>$row['testName'],'testMark'=>$row['testtm'],'studentMark'=>$row['max(marks)']);
           
         }
        
         // Top student Course wise
         $tempTopStudCourseWise =  $analytics_data['data']['top1_stud']; 

         foreach($tempTopStudCourseWise as $row)
         {
             $customerInfo = get_users(array('id'=>$row['student_id']));

            $topStudCourseWise[] = $customerInfo['data'][0]['name'];
           
         }
        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName,'report_id'=>$data['report_id'],'dropDownArr'=>$dropDownArr,'course'=>$course,'topStudTestWise'=>$topStudTestWise,'topStudCourseWise'=>$topStudCourseWise);
}



function getEmployeeRankCalculation($data)
{

    global $companyId;
    logger("19",'',$data,5);
    $condition=array();
    $course = $data['course'];
    $result_array = array();
   
    // get chart data    
   // "SELECT test_id,testtm,marks,if((marks*100/testtm) >= 40, 'pass','fail') as result,count(if((marks*100/testtm) >= 40, 'pass','fail')) as result_count  FROM `test_result_7_7` group by test_id ,if((marks*100/testtm) >= 40, 'pass','fail')  order by test_id";
    $table_name_chart_data = "`test_result_".$companyId.'_'.$course. "` as tr group by test_id ,if((marks*100/testtm) >= 40, 'pass','fail')  order by test_id";
    $sel_fiels_chart_data = "(select name from material_".$companyId.'_'.$course. " where id = tr.test_id) as testName,if((marks*100/testtm) >= 40, 'pass','fail') as result,count(if((marks*100/testtm) >= 40, 'pass','fail')) as result_count";

        $getResult_chart_data = Select_All($sel_fiels_chart_data,$table_name_chart_data); 
        $allData_chart_data=array();

        while($fetRes=mysqli_fetch_assoc($getResult_chart_data))
        {
            $allData_chart_data[$fetRes['testName']][$fetRes['result']] = $fetRes['result_count'];
           
        }  
        $result_array['chart_data'] = $allData_chart_data;

    // get the top student test wise
    // "SELECT student_id,test_id,max(marks) ,testtm from `test_result_7_7`  group by test_id having max(marks*100/testtm >= 40)";
     $table_name_top_stud = "`test_result_".$companyId.'_'.$course. "` as tr  group by test_id having max(marks*100/testtm >= 40)";
     $sel_fiels_top_stud= "student_id,(select name from material_".$companyId.'_'.$course. " where id = tr.test_id) as testName,max(marks) ,testtm";
      $getResult_top_stud = Select_All($sel_fiels_top_stud,$table_name_top_stud); 
        $allData_top_stud=array();
        while($fetRes=mysqli_fetch_assoc($getResult_top_stud))
        {
            array_push($allData_top_stud,$fetRes);
        } 
   $result_array['top_stud'] = $allData_top_stud;


    // get the top 1 student course wise

    //"SELECT student_id , sum(marks*100/testtm) as rank FROM `test_result_7_7` where (marks*100/testtm)>=40 group by student_id having count(student_id) = (SELECT count(*) FROM `material_7_7` where `type` = 'test') order by rank desc limit 1"

    $table_name_top1_stud = "`test_result_".$companyId.'_'.$course. "` where (marks*100/testtm)>=40 group by student_id having count(student_id) = (SELECT count(*) FROM `material_".$companyId.'_'.$course. "` where `type` = 'test') order by rank desc limit 1";

     $sel_fiels_top1_stud = "student_id , sum(marks*100/testtm) as rank";          
       
        $getResult_top1_stud = Select_All($sel_fiels_top1_stud,$table_name_top1_stud); 
        $allData_top1_stud=array();
        while($fetRes=mysqli_fetch_assoc($getResult_top1_stud))
        {
            array_push($allData_top1_stud,$fetRes);
        } 
        $result_array['top1_stud'] = $allData_top1_stud;

   return array("success"=>"true","data"=>$result_array,"error_code"=>"100"); 
}


function get_course_wise_reprot_data($data)
{
	    global $companyId;
        logger("19",'',$data,5);   
        $condition=array();
        $course = $data['course'];
        $table_name = 'test_result_'.$companyId."_".$course. ' group by student_id';
        $sel_field = 'student_id,`date`,count(student_id) as total';
        $getResult = Select_All($sel_field,$table_name); 
        $allData=array();
        while($fetRes=mysqli_fetch_assoc($getResult))
        {
            array_push($allData,$fetRes);
        }  


        return array("success"=>"true","data"=>$allData,"error_code"=>"100");  
}
?>