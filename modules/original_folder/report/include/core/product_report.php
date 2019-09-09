<?php
function get_product_report($data)
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
        else
        {
            $getdata = select_mongo("report_type",array('_id'=>new MongoId($filterFields['report'])),array('fields'));
            $fetdata = add_id($getdata,"id");
            $fields1 = $fetdata[0]['fields'];
            $fields2 = $fetdata[0]['fields'];
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
    
    $tmp = get_top_selling_product($condition);
    if(!empty($tmp['data']))
    {

        $tableData = array();
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $newFieldArr=array();
        array_push($headArr, "Product");
        array_push($headArr, "Quantity");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp['data'] as $key=>$value) 
        {
            $productInfo = get_product_by_id(array('id'=>$key));
            $row = array();
            
            /*  create chart data */
            $rowchart = array();
            array_push($rowchart, $productInfo['data'][0]['title']);
            array_push($rowchart, $value);
            /* end of chart data */

            array_push($productIdArr, $key);
            $row1 = array();

            foreach ($fields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "title":
                        array_push($row,$productInfo['data'][0]['title']);
                        $row1[] = $productInfo['data'][0]['title'];
                    break;
                    case "quantity":
    
                        array_push($row,$value);
                        $row1[] = $value;
                    break;
                    case "productId":
    
                        array_push($row,$key);
                         $row1[] = $key;
                    break;
                    case "priceKD":
    
                        array_push($row,$productInfo['data'][0]['priceKD']);
                        $row1[] = $productInfo['data'][0]['priceKD'];
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


function get_top_selling_product($data)
{
        logger("19",'',$data,5);   
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        
        $condition['orderedOn'] = array('$gte'=>$start,'$lt'=>$end);

        $getdata = select_mongo("productOrderPlaced",$condition,array('productId','quantity'));
        $fetdata = add_id($getdata,"id");

        $product_result = array();
        foreach($fetdata as $row)
        {
            $array_len = count($row['productId']);
            $pro_array = $row['productId'];
            $qty_array = $row['quantity'];
            $counter = 0;
            for($i=0;$i<$array_len;$i++)
            {
                $product_result[$pro_array[$i]] = $product_result[$pro_array[$i]] + $qty_array[$i];
            }
            
        }
        arsort($product_result);
        return array("success"=>"true","data"=>$product_result,"error_code"=>"100");  
}

?>