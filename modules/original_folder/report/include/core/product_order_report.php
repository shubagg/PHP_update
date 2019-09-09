<?php

function get_product_order_report($data)
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
    //print_r($tmp);die;
    if(!empty($tmp))
    {
        $blogArray = array();
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $newFieldArr=array();
        array_push($headArr, "Date");
        array_push($headArr, "Amount");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp as $key=>$value) 
        {
            $rowchart = array();
            if($dateType=='week' || $dateType=='month')
            {
                $totalOrder = count_order_sale(array('start'=>$value[0],'end'=>$value[1]));
                $orderInfo   = get_order_sale_data(array('start'=>$value[0],'end'=>$value[1]));
                array_push($rowchart, $value[1]);
                array_push($rowchart, $totalOrder);
            }
            else
            {
                $totalOrder = count_order_sale(array('start'=>$value,'end'=>$value));
                $orderInfo   = get_order_sale_data(array('start'=>$value,'end'=>$value));
                array_push($rowchart, $value);
                array_push($rowchart, $totalOrder);
            }

            foreach ($orderInfo['data'] as $order) 
            {
                $row = array();
                $row1 = array(); 
                $customerInfo = get_users(array('id'=>$order['userId']));
                foreach ($fields as $fkey => $fvalue) 
                {

                    Switch($fvalue['fieldValue'])
                    {
                        case "orderedOn":
                            array_push($row,date("Y-m-d",$order['orderedOn']->sec));
                            $row1[] = date("Y-m-d",$order['orderedOn']->sec);
                        break;
                        case "orderId":
        
                            array_push($row,$order['orderId']);
                            $row1[] = $order['orderId'];
                        break;
                        case "orderPrice":
        
                            array_push($row,$order['orderPrice']);
                             $row1[] = $order['orderPrice'];
                        break;
                        case "userId":
        
                            array_push($row,$customerInfo['data'][0]['name']);
                            $row1[] = $customerInfo['data'][0]['name'];
                        break;
                        
                        default: 
                            array_push($row,$value1[$fvalue['fieldValue']]);
                        break;
                    }
                    
                }
                array_push($blogArray,$row); 
                $newFieldArr[]=$row1;
            }
              
               array_push($chartArr, $rowchart);
              
               
            }

            
            array_unshift($chartArr, $headArr);
        
    }
    
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$blogArray,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName);
}

function count_order_sale($data)
{
    $condition=array();
    $dt = $data['start']. " 00:00";
    $start = new MongoDate(strtotime($dt));
    $dt1 = $data['end']. " 24:00";
    $end = new MongoDate(strtotime($dt1));
    $condition['orderedOn'] = array('$gte'=>$start,'$lt'=>$end);
    $groupBy=array('orderPrice' => '$orderPrice'); 
    $total=10;
    $s=0;
    $getdata=  select_groupby_mongo('productOrderPlaced',$condition,$groupBy,$total);
    if(!empty($getdata['result'])){foreach ($getdata['result'] as $value) {
        $s=$s+$value['_id']['orderPrice'];
    } }
    return $s;
}

function get_order_sale_data($data)
{
        logger("19",'',$data,5);   
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        
        $condition['orderedOn'] = array('$gte'=>$start,'$lt'=>$end);

        $getdata = select_mongo("productOrderPlaced",$condition);
        $return = add_id($getdata,"id");
        if($return[0])
        {
            $alldata=array();
            foreach($return as $ret)
            {
                array_push($alldata,$ret);
            }
            return array('data'=>$alldata,'error_code'=>'100','success'=>'true');
        }
        else
        {
            return array('data'=>"",'error_code'=>'101','success'=>'false');
        }
         
}




?>