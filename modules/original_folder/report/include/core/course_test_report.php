<?php

function get_course_test_wise_report($data)
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

    $tmp = get_course_test_wise_reprot_data($condition);
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
                    case "marks":
                        array_push($row,$rowData['marks']);
                    break;
                    case "rank":
                        array_push($row,$rowData['rank']);
                    break;
                    
                }
                
            } 
            array_push($tableData,$row);
            $sno++;
        }
        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName,'report_id'=>$data['report_id'],'dropDownArr'=>$dropDownArr,'course'=>$course);
}


function get_course_test_wise_reprot_data($data)
{
        global $companyId;
        logger("19",'',$data,5);   
        $condition=array();
        $course = $data['course'];
        $cTest = $data['cTest'];
        if($cTest == -1)
        {
            $table_name = 'test_result_'.$companyId."_".$course.' ,(SELECT @a:= 0) AS a';
            $sel_field = 'student_id, date, marks, @a:=@a+1 rank';
            $condition = " 1=1 order by CAST(`marks` AS SIGNED) DESC ,`date` asc";


            
        }
        else
        {
            $table_name = 'test_result_'.$companyId."_".$course. ' ,(SELECT @a:= 0) AS a';
            //$sel_field = 'student_id, date, marks, FIND_IN_SET( marks, ( SELECT GROUP_CONCAT( marks ORDER BY marks DESC )  FROM test_result_'.$companyId.'_'.$course.' where test_id='.$cTest.')) AS rank';
            $sel_field = 'student_id, date, marks, @a:=@a+1 rank';

            $condition = "test_id=".$cTest." order by CAST(`marks` AS SIGNED) DESC ,`date` asc";
        }
        
        //$getResult = Select_All($sel_field,$table_name);
        $getResult = Select_Some($sel_field,$table_name,$condition); 
        //print_r($getResult);
        $allData=array();
        while($fetRes=mysqli_fetch_assoc($getResult))
        {
            array_push($allData,$fetRes);
        }  


        return array("success"=>"true","data"=>$allData,"error_code"=>"100");  
}

 ?>