<?php


/* Top Selling Brand */
function get_product_topbrand_report($data)
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
    
    $tmp = get_top_selling_brand($condition);
    if(!empty($tmp['data']))
    {

        $blogArray = array();
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $newFieldArr=array();

        array_push($headArr, "Brand");
        array_push($headArr, "Sell Qty");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp['data'] as $brand=>$sell_qty) 
        {
            $row = array();
            
            $rowchart = array();
            array_push($rowchart, $brand);
            array_push($rowchart, $sell_qty);
            array_push($productIdArr, $brand);
            $row1 = array();
            foreach ($allFields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "brand":
                        array_push($row,$brand);
                        $row1[] = $brand;
                    break;
                    case "quantity":
    
                        array_push($row,$sell_qty);
                        $row1[] = $sell_qty;
                    break;
                    
                }
                
            } 
               array_push($blogArray,$row);
               array_push($chartArr, $rowchart);
              
               $newFieldArr[]=$row1;
            }

            
            array_unshift($chartArr, $headArr);
        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$blogArray,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName);
}


function get_top_selling_brand($data)
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

        $brand_array = array();
        foreach ($product_result as $productID => $saleQty) 
        {
             $getProInfo = get_product_by_id(array('id'=>$productID));
            
             $brandName = $getProInfo['data'][0]['brand'];           
             $brand_array[$brandName] = $brand_array[$brandName] + $saleQty;

        }

        
        arsort($brand_array);
        return array("success"=>"true","data"=>$brand_array,"error_code"=>"100");   
}

/* End Selling brand */


?>