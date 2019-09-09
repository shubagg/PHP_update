<?php


/*--------- Visitor Report---------------*/
function get_visitor_report($data)
{

    $filterFields = json_decode($data['jsonArr'],true);
    $fields1 = array();
    $fields2 = array();
    $reportName="";
    $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array('setting','fields','reportName'));
    $fetdata = add_id($getdata,"id");
    if($fetdata[0])
    {

        $fields1 = $fetdata[0]['setting']['defaultFields'];
        $fields2 = $fetdata[0]['setting']['allFields'];
        $reportName=$fetdata[0]['reportName'];
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
            case "fromDate":
                $condition['start'] = $value;
                $startDate=$value;
                array_push($filterFieldsArr, $value);
            break;
            case "toDate":
                $condition['end'] = $value;
                $endDate=$value;
                array_push($filterFieldsArr, $value);
            break;
            case "dateType":
                $dateType=$value;
            break;
        }
    }

    if($endDate==''){
        $endDate=$startDate;
    }
    if($dateType=='week')
    {
        $tmp=getAllWeeksDate($startDate,$endDate);
    }
    else if($dateType=='month')
    {
        $tmp=getAllMonthDate($startDate,$endDate);
    }
    else
    {
        $tmp=createDateRangeArray($startDate,$endDate);
    }

    if(!empty($tmp))
    {
        $blogArray = array();
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $newFieldArr=array();
        array_push($headArr, "Date");
        array_push($headArr, "Visitor");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp as $key=>$value) 
        {
            $rowchart = array();

            if($dateType=='week' || $dateType=='month')
            {
                
               $start_date  = $value[0];
               $end_date    = $value[1];
               
            }
            else
            {
                $start_date = $end_date = $value;
            }

            $visitorCount   = get_visitor_report_data(array('start'=>$start_date,'end'=>$end_date));
           // print_r($visitorCount['data']);
            $visitorCount = $visitorCount['data'];
            array_push($rowchart, $end_date);
            array_push($rowchart, $visitorCount);

            
                $row = array();
                $row1 = array(); 
               

                foreach ($fields as $fkey => $fvalue) 
                {

                    Switch($fvalue['fieldValue'])
                    {
                        case "dateOn":
                            array_push($row,date("Y-m-d",strtotime($end_date)));
                            $row1[] = date("Y-m-d",strtotime($end_date));
                        break;
                        case "sessionID":
        
                            array_push($row,$visitorCount);
                            $row1[] = $visitorCount;
                        break;              
                        
                        default: 
                            array_push($row,$value1[$fvalue['fieldValue']]);
                        break;
                    }
                    
                }
                array_push($blogArray,$row); 
                $newFieldArr[]=$row1;
                         
               array_push($chartArr, $rowchart);             
               
            }
            
            array_unshift($chartArr, $headArr);
        
    }
       
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$blogArray,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'allFields'=>$allFields,'reportName'=>$reportName);

}

function get_visitor_report_data($data)
{
        logger("19",'',$data,5);   
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        
        $condition['dateOn'] = array('$gte'=>$start,'$lt'=>$end);

        $getdata = select_mongo("customerSessionHistory",$condition,array('sessionID','dateOn'));
        $return = add_id($getdata,"id");

        $result = array();
       
            foreach($return as $row)
            {
                $result[] = $row['dateOn'];
            }
            $result = count($result);
            return array('data'=>$result,'error_code'=>'100','success'=>'true');
            
         
}
/*--------- End Visitor Report---------------*/


?>