<?php


/* wishlist-------------------*/

function get_wish_list_report($data)
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
    
    $tmp = get_wishlist_data($condition);
   // print_r($tmp);die;
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
        $totalcart=1;
        foreach ($tmp['data'] as $key=>$value) 
        {
            $row = array();
            $categoryTitle=array();
            $productInfo = get_product_by_id(array('id'=>$key));
            $categoryId=$productInfo['data'][0]['category'];
            foreach ($categoryId as $cat) {
               $catId[]=$cat;
            }
            $allCategory=get_product_category(array('parentId'=>"0",'id'=>implode("|",$catId)));
            foreach ($allCategory['data'] as $c) {
               $categoryTitle[]=$c['title'];
            }
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
                    case "category":
    
                        array_push($row,implode(",",$categoryTitle));
                        $row1[] = implode(",",$categoryTitle);
                    break;
                    case "type":
    
                        array_push($row,$value);
                        $row1[] = $value;
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



function get_wishlist_data($data)
{
        logger("19",'',$data,5);   
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        $condition['type']="2";
        $condition['createdOn'] = array('$gte'=>$start,'$lt'=>$end);

        $getdata = select_mongo("productOrder",$condition,array('productId','createdOn'));
        $fetdata1 = $fetdata = add_id($getdata,"id");

        $product_result = array();
        $custOrdCount= array();
        foreach($fetdata1 as $row)
        {
            $custOrdCount[] = $row['productId'];
        }
        
        $custOrdCount = array_count_values($custOrdCount);
          
        foreach($fetdata as $row)
        {
                $productId = $row['productId'];
                $product_result[$productId] = $custOrdCount[$productId];
               
        }
      
        arsort($product_result);
        return array("success"=>"true","data"=>$product_result,"error_code"=>"100");  
}

/* end--------------------------------*/


?>