<?php

function get_survey_report($data)
{

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

            $fields1 = $fetdata[0]['setting']['defaultFields'];
            $fields2 = $fetdata[0]['setting']['allFields'];
            $reportName=$fetdata[0]['reportName'];
        }
    }

    
    $fields = array();
    $fields = shortArrayByKey($fields2,'order');
    $fields1 = shortArrayByKey($fields1,'order');
    $thead = array();
    $fieldArr = array();

    foreach ($fields as $fkey => $fvalue) 
    {
        array_push($thead,$fvalue['fieldName']);
        
    }
    foreach ($fields1 as $fkey1 => $fvalue1) 
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
                $condition['test_id'] = $value;
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
    //print_r($condition);die;
    $tmp = get_survey_data($condition);
    //print_r($tmp);die;
    if(!empty($tmp['data']))
    {

        $tableData = array();
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $newFieldArr=array();
        array_push($headArr, "Type");
        array_push($headArr, "Total");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];
        $totalcart=1;
        foreach ($tmp['data'] as $key=>$value) 
        {
            $row = array();
            /*  create chart data */
            $rowchart = array();
            array_push($rowchart, $value['key']);
            array_push($rowchart, $value['value']);
            /* end of chart data */

            array_push($productIdArr, $key);
            $row1 = array();

            foreach ($fields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "type":
                        array_push($row,$value['key']);
                        $row1[] = $value['key'];
                    break;
                    case "total":
                        array_push($row,$value['total']);
                        $row1[] = $value['total'];
                    break;
                    default: 
                        array_push($row,$value1[$fvalue['fieldValue']]);
                    break;
                }
                
            } 
               array_push($tableData,$row);
               array_push($chartArr, $rowchart);
              
               $newFieldArr[]=$row1;
               $totalcart++;
            }

            
            array_unshift($chartArr, $headArr);
        
    }
    //print_r($tableData);die;
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName);
}





function get_survey_data($data)
{
    global $companyId;
    $course="3";
    $test_id=$data['test_id'];
    $table_name = 'test_result_'.$companyId."_".$course. ' where test_id='.$test_id;
    $sel_field = '*';
    $getResult = Select_All($sel_field,$table_name);
    $count=0;
    $allData=array();
    $agree=0;
    $notAgree=0;
    $mayBe=0; 
    while($fetRes=mysqli_fetch_assoc($getResult))
    {   
       $answers=explode(",",$fetRes['answers']);
        if(in_array('A', $answers))
        {
            $agree++;
        }
        else if(in_array('B', $answers))
        {
            $notAgree++;
        }
        else if(in_array('C', $answers))
        {
            $mayBe++;
        }
        $count++;
    }
    $agree1=($agree*100)/$count;
    $notAgree1=($notAgree*100)/$count;
    $mayBe1=($mayBe*100)/$count;
    $allData[]=array('key'=>"Agree",'value'=>$agree1,'total'=>$agree);
    $allData[]=array('key'=>"Not Agree",'value'=>$notAgree1,'total'=>$notAgree);
    $allData[]=array('key'=>"May Be",'value'=>$mayBe1,'total'=>$mayBe);
    return array("success"=>"true","data"=>$allData,"error_code"=>"100");  
        
}


 ?>