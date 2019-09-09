<?php


/*top customers (sales) start*/

function get_top_customers_according_sales_report($data)
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
    
    $tmp = get_top_customers_sales($condition);
    if(!empty($tmp['data']))
    {

        $tableData = array();
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $newFieldArr=array();
        array_push($headArr, "Customer");
        array_push($headArr, "Sales");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp['data'] as $key=>$value) 
        {
            $customerInfo = get_users(array('id'=>$key));
            $row = array();
            
            /*  create chart data */
            $rowchart = array();
            array_push($rowchart, $customerInfo['data'][0]['name']);
            array_push($rowchart, $value[0]);
            /* end of chart data */

            array_push($productIdArr, $key);
            $row1 = array();

            foreach ($fields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "name":
                        array_push($row,$customerInfo['data'][0]['name']);
                        $row1[] = $customerInfo['data'][0]['name'];
                    break;
                    case "email":
    
                        array_push($row,$customerInfo['data'][0]['email']);
                        $row1[] = $customerInfo['data'][0]['email'];
                    break;
                    case "phone":
    
                        array_push($row,$customerInfo['data'][0]['phone']);
                         $row1[] = $customerInfo['data'][0]['phone'];
                    break;
                    case "orders":
    
                        array_push($row,$value[1]);
                        $row1[] = $value[1];
                    break;
                    case "orderPrice":
    
                        array_push($row,$value[0]);
                        $row1[] = $value[0];
                    break;
                    
                    default: 
                        array_push($row,$value1[$fvalue['fieldValue']]);
                    break;
                }
                
            } 
               array_push($tableData,$row);
               array_push($chartArr, $rowchart);
              
               $newFieldArr[]=$row1;
            }

            
            array_unshift($chartArr, $headArr);
        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$tableData,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName);
}

function get_top_customers_sales($data)
{
        logger("19",'',$data,5);   
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        
        $condition['orderedOn'] = array('$gte'=>$start,'$lt'=>$end);

        $getdata = select_mongo("productOrderPlaced",$condition,array('userId','orderPrice'));
        $fetdata1 = $fetdata = add_id($getdata,"id");

        $product_result = array();
        $custOrdCount= array();
        foreach($fetdata1 as $row)
        {
            $custOrdCount[] = $row['userId'];
        }
        
        $custOrdCount = array_count_values($custOrdCount);
          
        foreach($fetdata as $row)
        {
                $userId = $row['userId'];
                $orderPrice = $row['orderPrice'];
                //$ord_sum = $product_result[$userId] + $orderPrice;

                $product_result[$userId] = array(($product_result[$userId][0] + $orderPrice),$custOrdCount[$userId]);
               
        }
      
        arsort($product_result);
        return array("success"=>"true","data"=>$product_result,"error_code"=>"100");  
}


/* end*/

?>