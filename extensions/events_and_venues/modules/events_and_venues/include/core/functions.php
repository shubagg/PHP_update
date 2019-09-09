<?php
function getHotels($cond)
{
	$fetchData = select_mongo('product',$cond,array());
	$fetchData = add_id($fetchData,"id");
	return array('success'=>'true','error_code'=>'200','data'=>$fetchData);
}
function getUserType($user_id)
{
	 $cond=array('_id'=>new MongoId($user_id)); 
	 $fetchData = select_mongo('user',$cond,array());
	 $fetchData = add_id($fetchData,"id");
	 $userData = $fetchData[0];
	 
	 if (in_array("5a4239dd281cda4d60a5777f", $userData['category']))
	 {
		 return 'hotel';
	 }else
	 {
		 return 'other';
	 }
	 
	 
}
function getHotelCatName($cat)
{
	if(count($cat)>0)
	{
		
		$cond = array();
		$cond['groupId'] = '587f04eca32974a8103c9869';
		$ids = array();
		foreach ($cat as $key => $val) 
		{
			$ids[$key] = new MongoId($val);
		}
		
        $cond['_id']= array('$in'=>$ids);
		//print_r($cond);
		$fetchData = select_mongo('productfeature',$cond,array());
		$fetchData = add_id($fetchData,"id");
		$str = array();
		foreach($fetchData as $hotelCat)
		{
				$str[] = $hotelCat['title'];
		}
		$result = implode(' | ',$str);
	}else
	{
		$result = 'N/A';
	}
	 return $result;
	 
}
function getCityTitle($id)
{
	$condCity = array();
	$condCity['_id'] = new MongoId($id);
	$exeCityQuery = select_mongo('cities',$condCity,array());
	$exeCityQuery = add_id($exeCityQuery,"id");
	if(count($exeCityQuery))
	{
		$result = $exeCityQuery[0]['title'];
	}else
	{
		$result = 'N/F';
	}
	return $result;
}
function get_hotel_user($data)
{
	 $user_type = getUserType($data['id']);
	 $cond = array();
	 if($user_type=='hotel')
	 {
		$cond['_id'] = new MongoId($data['id']);  
	 }	 
	 $cond['category'] = array('$in'=>array('5a4239dd281cda4d60a5777f'));
	 $cond['user_type'] = 'user';
	 	 
	 $fetchData = select_mongo('user',$cond,array());
	 
     $fetchData = add_id($fetchData,"id");
	
	 return array('success'=>'true','error_code'=>'200','data'=>$fetchData);
}

function get_feature_list_by_id($data)
{
    
    $fields=array();
    unset($data['lang']);
    if(isset($data['fields'])){ $fields=explode(",",$data['fields']); unset($data['fields']); }
    if(isset($data['id']) && $data['id']!='')
    {
        $data  = array('_id'=>new MongoId($data['id'])); 
    }

    if(isset($data['deviceType']))
    {
        unset($data['deviceType']);
    }
    $fetchData = select_mongo('productfeature',$data,$fields);
    $fetchData = add_id($fetchData,"id");
    
    $imagedetail=array();
    foreach ($fetchData as $fetchId) 
    { 
            $imageData=get_association_data("16","10","1",$fetchId['id']);
            $feature_picture=$imageData['media']['1'][$fetchId['id']][0]['mediaName'];
            if($feature_picture!=''){$img_url=media_url().'images/'.$feature_picture;}  
            else{$img_url=ui_media_url().'image_not_available_400.png';} 
            
            $fetchId['image']=$img_url;
            array_push($imagedetail, $fetchId);

    }

    return array('success'=>'true','error_code'=>'100','data'=>$imagedetail);
}

//warehouse...

function manage_option_inventory_warehouse($data)
{
    logger(16,'',$data,5);
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $data['updatedOn']=new MongoDate();
        
        switch($data['id'])
        {
            case "0":
                $manage = add_option_inventory_warehouse($data);
            break;
            
            default:
                $manage = update_option_inventory_warehouse($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }
}
function add_option_inventory_warehouse($data)
{
    logger(16,'',$data,5);
    $checkData=array('id'=>$data['id']);
    $checkUnique=check_key_available($checkData);
    if($checkUnique['success']=='true')
    {  
        if(isset($data['customField']))
        {
            $data['customField']=json_decode($data['customField']); 
        }
        $query=array('productId'=>$data['productId'],'customField.date'=>$data['customField']->date);
        $check=count_mongo('inventory',$query); 
        if($check)
        {
            return array("success"=>"false","data"=>$check,"error_code"=>"16003");
        }

        $data['createdOn']=new MongoDate();
        unset($data['id']);
        $data['_id']=new MongoId();
        $data['inventory']=intval($data['inventory']);
        //return array('success'=>'true','error_code'=>'aaa','data'=>$data);
            $res = insert_mongo('inventory',$data);
            if($res['n'] == 1)
            {
                return array("success"=>"false","data"=>"","error_code"=>"16001");
            }

            $productId =db_id($data);
            if($data['type']=='venue'){
            //insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>$data['smid'],'userId'=>"0",'itemId'=>$productId."||".$data['userId'],'eid'=>"206","extra"=>json_encode($data)));
            }else{
               // insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>$data['smid'],'userId'=>"0",'itemId'=>$productId."||".$data['userId'],'eid'=>"200","extra"=>json_encode($data)));
            }
            return array("success"=>"true","data"=>$productId,"error_code"=>"16002");
    }
    else
    {
        return $checkUnique;
    }
}

function update_option_inventory_warehouse($data)
{
   
    logger(1,'',$data,5);
    
    $where=array('productId'=>$data['productId'],'warehouseId'=>$data['warehouseId']);
    if(isset($data['id']) && $data['id']!="")
    {
        $where=array('_id'=>new MongoId($data['id']));
        $id=$data['id'];
        unset($data['id']);
    }
    if(isset($data['customField']))
    {
        $data['customField']=json_decode($data['customField']);   
    }
    $data['updatedOn']=new MongoDate();
    $data['inventory']=intval($data['inventory']);
    $ret=update_mongo('inventory',$data,$where);
    if($ret['n']>0)
    {
         if($data['type']=='venue'){
           // insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>$data['smid'],'userId'=>"0",'itemId'=>$id."||".$data['userId'],'eid'=>"207","extra"=>json_encode($data)));
            }
            else{
               // insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>$data['smid'],'userId'=>"0",'itemId'=>$id."||".$data['userId'],'eid'=>"201","extra"=>json_encode($data)));
            }
        return array('data'=>$id,'error_code'=>'16004','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1019','success'=>'false');
    }
}
//Warehouse...


function get_banner($data)
{  
    $bannerData=array();
    $data['orderby']=-1;
    $data['by']='mediaName';
    $data['index']='0';
    $data['nor']='6';

    if(isset($data['type'])){ $type=$data['type']; unset($data['type']); }
    if(isset($data['fields'])){ $fields=explode(",",$data['fields']); unset($data['fields']); }

    $getImage = select_sort_limit_mongo('media',array('smid'=>'1','amid' => '16'),array('mediaName'),array("$data[by]"=>$data['orderby']),$data['index'],$data['nor']);  
    $getImage = add_id($getImage);

    for($i=0;$i<6;$i++)
    {
       $bannerData[$i]['image']=get_upload_dir_uri()."media/images/".$getImage[$i]['mediaName'];    
    } 
    return array('success'=>'true','error_code'=>'100','data'=>$bannerData);
}

function get_categories($data)
{

    $categoryData=array();
    $fields=array('title');
    $thumbnail=true;
    if(isset($data['index'])&&isset($data['nor'])){ $index=$data['index'];  unset($data['index']);  $nor=$data['nor']; unset($data['nor']);}
    if(isset($data['fields'])){ $fields=explode(",",$data['fields']); unset($data['fields']); }
    if(isset($data['image'])){ $thumbnail=true; unset($data['image']); }
    if($index!='' && $nor!='')
    {
        
        $getData = select_limit_mongo('productfeature',$data,$fields,$index,$nor);
    }
    else{
        
        $getData=select_mongo("productfeature",$data,$fields);
    }
    
    $categoryData=add_id($getData);

    if($thumbnail)
    {
        $catData=array();
        foreach($categoryData as $category)
        {
            $getImage=select_mongo('media',array('aiid'=>$category['id'],'smid'=>'1'),array('mediaName'));

            $getImage=add_id($getImage);
            $getImage=$getImage[0];
            $category['image']=get_upload_dir_uri()."media/images/".$getImage['mediaName'];

            $totalcategory=get_product_listing(array('category'=>$category['id']));
            //$totalcategory=curl_posts("/get_listing_by_category",array('category'=>$category['id']));
            $category['length']=sizeof($totalcategory['data']);

            array_push($catData,$category);
        }

        //$catData['total']=$counter;
        return array("success"=>"true","error_code"=>"100","data"=>$catData);
    }
    else
    {
        return array("success"=>"true","error_code"=>"100","data"=>$categoryData);
    }
    
}
function gettotalcategory($data)
{
    $condition=array();
    $condition['groupId']=array('$in'=>array('587f04eca32974a8103c9869'));
    $counter=count_mongo("productfeature",$condition);
    return array("success"=>"true","error_code"=>"100","data"=>$counter);
}
function get_product_listing($data)
{   
  
    $fields=array();
    $thumbnail=true;
    $orderby=array();
    $index="";
    $nor="";
    $by="";
    $id="";
    $userId="";
    $key="";
    $data['status']='1';
    $data['warehouseStatus']='1'; //default for check warehouse..
    if(isset($data['key'])){ $key=$data['key']; unset($data['key']); }
     
    if(isset($data['userId'])){ $userId=$data['userId']; unset($data['userId']); }

    if(isset($data['id'])){   $data['_id']=new MongoId($data['id']); unset($data['id']);}
    if(isset($data['index'])&&isset($data['nor'])){ $index=$data['index'];  unset($data['index']);  $nor=$data['nor']; unset($data['nor']);}
    if(isset($data['orderBy'])&&isset($data['by'])){ $orderby=array($data['by']=>intval($data['orderBy']));unset($data['by']); unset($data['orderBy']); }

    if(isset($data['fields'])){ $fields=explode(",",$data['fields']); unset($data['fields']); }
    
    if(isset($data['type']) && $data['type']==''){  unset($data['type']); }
    
    if(isset($data['category']) && $data['category']==''){  unset($data['category']); }

    if(isset($data['amenity']) && $data['amenity']==''){  unset($data['amenity']); }

    if(isset($data['stateId']) && $data['stateId']==''){  unset($data['stateId']); }

     if(isset($data['cityId']) && $data['cityId']==''){  unset($data['cityId']); }  //chandan

    if(isset($data['category'])){ $category=explode("|",$data['category']);  $data['category']=array('$in'=>$category); }

    if(isset($data['amenity'])){ $amenity=explode("|",$data['amenity']);  $data['attributes']=array('$in'=>$amenity);  unset($data['amenity']); }
      

    if(isset($data['capacity'])){ $data['capacity']=array('$gte'=>intval($data['minCapacity']),'$lt'=>intval($data['maxCapacity'])); unset($data['minCapacity']); unset($data['maxCapacity']);}

    if(isset($data['basePrice'])){ 
       if(isset($data['minPrice']) && $data['minPrice']!='' || isset($data['maxPrice']) && $data['maxPrice']!=''){
        $data['basePrice']=array('$gte'=>intval($data['minPrice']),'$lte'=>intval($data['maxPrice'])); 
       } else{unset($data['basePrice']);}
        unset($data['maxPrice']); unset($data['minPrice']); 
       
     }

    if(isset($data['maxLocation'])){ 
        /*$data['location']=array('$gte'=>intval($data['minLocation']),'$lt'=>intval($data['maxLocation'])); */ 
        $distance=$data['maxLocation']*1000;
        unset($data['minLocation']); 
        unset($data['maxLocation']);
        if(isset($data['lat'])){ 
        $lat=$data['lat'];  
        $lng=$data['lng'];  
        unset($data['lat']); 
        unset($data['lng']);
        }
        $data['location']=array('$near'=>array('$geometry'=>array('type'=>"Point",'coordinates'=>array(floatval($lng),floatval($lat))),'$maxDistance'=>$distance));
        
    }
    $condition=array();
     if(isset($data['fdate']) && $data['fdate']!=''){
          $condition['customField.filterSecond']=floatval($data['fdate']);
    } unset($data['fdate']);
    
    if($index!='' && $nor!='')
    {
        $getData = select_sort_limit_mongo('product',$data,$fields,$orderby,$index,$nor);
    }
    elseif(sizeof($orderby)>0)
    {
        $getData = select_sort_mongo('product',$data,$fields,$orderby);
    }
    else
    {
        $getData=select_mongo("product",$data,$fields);      
    }
    
    $products=add_id($getData);
    if($thumbnail)
    {
        $productData=array();
        $condition['smid']='2';
        foreach($products as $product)
        {
            $condition['productId']=$product['id'];
            $inventoryDetails=array();
            $getCustomData=select_mongo('inventory',$condition);
            $getCustomData=add_id($getCustomData);
            if(sizeof($getCustomData)>0)
            {
                $getImage=get_association_data('16','10','1',$product['id']);
                if(isset($getImage['media'][1][$product['id']]))
                {
                   $getImage = $getImage['media'][1][$product['id']]; 
                }
                else
                {
                    $getImage = array();
                }
                

                //$getImage=select_mongo('media',array('aiid'=>$product['id'],'smid'=>'1'),array('mediaName'));
               // $getImage=add_id($getImage);
               
                if(!$key)
                {
                    if(sizeof($getImage)>1)
                    {
                        for($i=0;$i<sizeof($getImage);$i++)
                        {   
                            $getImage=$getImage[$i];
                            $filename=$getImage['mediaName'];
                            if($filename=="")
                            {
                                $filepath=ui_media_url().'image_not_available_400.png';
                            }
                            else
                            {
                                $filepath=get_upload_dir_uri()."media/images/".$getImage['mediaName'];
                            }
                            $product['image'][$i]=$filepath;       
                        }
                    }
                    else
                    {
                            $getImage=$getImage[0];
                            $filename=$getImage['mediaName'];
                            if($filename=="")
                            {
                                $filepath=ui_media_url().'image_not_available_400.png';
                            }
                            else
                            {
                                $filepath=get_upload_dir_uri()."media/images/".$getImage['mediaName'];
                            }
                            $product['image']['0']= $filepath;  
                    }
       
                    if(sizeof($getCustomData)>0)
                    {   
                        $product['date']=$getCustomData['0']['customField']['second'];
                        $duration='1';
                        if($getCustomData['0']['duration'])
                        {
                            $duration=$getCustomData['0']['duration'];
                        }
                        $product['duration']=$duration;
                        foreach ($getCustomData as $getfieldsData) {
                            $getfields['date']=$getfieldsData['customField']['second'];
                            $duration='1';
                            if($getfieldsData['duration'])
                            {
                                $duration=$getfieldsData['duration'];
                            }
                            $getfields['duration']=$duration;
                            $getfields['quantity']=$getfieldsData['inventory'];
                            $getfields['cdate']=date("Y-m-d",$getfieldsData['customField']['second']/1000);
                             $getfields['eventdate']=date("Y-m-d h:i a",$getfieldsData['customField']['second']/1000);
                            $priceJson='';
                            $finalDetail=array();
                            $priceJson=json_decode($getfieldsData['PriceDetail']);
                            $imageData=get_association_data("16","10","1",$getfieldsData['id']);
                            $FileArray=$imageData['media']['1'][$getfieldsData['id']];
                            $imageCounter=0;
                            foreach ($priceJson as $priceJsonkey) {
                                $tt='';
                                if($priceJsonkey->title){  $tt=$priceJsonkey->title; }
                                $priceDetail['title']=$tt;
                                $rt='';
                                if($priceJsonkey->rate!=""){  $rt=$priceJsonkey->rate; }
                                $priceDetail['rate']=$rt;


                                $priceDetail['ticket']=0;
                                $priceDetail['total']=0;
                                
                                /*$ticket=1;
                                if($priceJsonkey->ticket!=""){  $ticket=$priceJsonkey->ticket; }
                                $priceDetail['ticket']=$ticket;
                                $priceDetail['image']="";
                                if(isset($FileArray[$imageCounter]['mediaName'])){
                                    $priceDetail['image']=$FileArray[$imageCounter]['mediaName'];
                                }*/
                                
                                    $dt='';
                                if($priceJsonkey->desc){  $dt=$priceJsonkey->desc; }
                                $priceDetail['desc']=$dt;
                                array_push($finalDetail,$priceDetail);
                                $imageCounter++;
                            }
                            $getfields['detail']=$finalDetail;
                            array_push($inventoryDetails,$getfields);
                        }
                          
                    }
                    $product['customField']=$inventoryDetails;
                    $favourite='false';
                    if($userId)
                    {
                        $checkFavorite=count_mongo('productOrder',array('userId'=>$userId,'productId'=>$product['id'],'type'=>'2'));    
                        if($checkFavorite>0){ $favourite='true'; }
                    }
                    $product['favourite']=$favourite;
                    $productcategory=get_feature_list_by_id(array('id'=>$product['category'][0],'fields'=>'title'));
            $product['categoryname']=$productcategory['data'][0]['title'];
                    if(isset($product['basePrice'])){ $product['basePrice']=(string)$product['basePrice']; }
                    if(isset($product['capacity'])){ $product['capacity']=(string)$product['capacity']; }
                     
                    $attributesArray=array();
                    if(isset($product['attributes']) && $product['attributes']){
                           
                            foreach ($product['attributes'] as $attributesData) 
                            {
                                $attributesDetails=get_feature_list_by_id(array('id'=>$attributesData,'fields'=>'title'));
                                
                                $attributesImage=get_association_data("16","10","1",$attributesData);
                                $attributespicture=$attributesImage['media']['1'][$attributesData][0]['mediaName'];

                                if($attributespicture!=''){$imgurl=media_url().'images/'.$attributespicture;}  
                                else{$imgurl=admin_assets_url().'img/avatar.png';}  
                                $attributesDetails['data']['0']['image']=$imgurl;
                                array_push($attributesArray,$attributesDetails['data']['0']);
                            }
                    }
                    $product['attributesData']=$attributesArray;
                    unset($product['attributes']);     

                }
                else
                {
                    $getImage=$getImage[0];
                    $product['image']=get_upload_dir_uri()."media/images/".$getImage['mediaName']; 

                }
            array_push($productData,$product);      
            }
        }

        if(isset($datefilter) && $datefilter!='') {
             $fdateData=array();
             foreach ($productData as $productKey) {
                if(isset($productKey['customField']) && $productKey['customField']!=''){
                      foreach ($productKey['customField'] as $keyvalue) {
                            if($datefilter==$keyvalue['date']) {
                                array_push($fdateData,$productKey);
                            }

                      }
                   
                }
             }
        return array("success"=>"true","data"=>$fdateData,"error_code"=>"16006");
        }
   
        return array("success"=>"true","data"=>$productData,"error_code"=>"16006");
    }
    else
    {
        return array("success"=>"true","data"=>$products,"error_code"=>"16006");
    }
}
function search_suggestions_events_venues($data)
{
    logger(16,'',$data,5);
    $check = check_key_available($data,array('searchText'));
    if($check['success'] == 'true')
    {
        $totalPerPage=5;
    
        $return=array();
        $searchText=$data['searchText'];
       /* $getProducts=get_product_by_id(array('search'=>$searchText,'index'=>'0','nor'=>$totalPerPage,'id'=>'0','fields'=>'title,type'));
        $productData=$getProducts['data'];
        if(sizeof($productData)>0)
        {
            foreach($productData as $product)
            {
                array_push($return,array('label'=>$product['title'],"id"=>$product['id'],'category'=>$product['type']));
            }
        }
        
        $productCategory=get_product_features(array('searchText'=>$searchText,'index'=>'0','nor'=>$totalPerPage,'fields'=>'title,groupId','productId'=>'0'));
        $productCategory=$productCategory['data'];
        if(sizeof($productCategory)>0)
        {
            foreach($productCategory as $category)
            {
                $type='category';
                if($category['groupId']=='587f0295a3297480103c9869'){ $type='amenity'; }
                array_push($return,array('label'=>$category['title'],"id"=>$category['id'],'category'=>$type));
            }
        }*//*Done by yash as we only need states and cities for bitty krishna*/
        
        $states=get_states(array('searchText'=>$searchText,'index'=>'0','nor'=>$totalPerPage,'countryId'=>'0','id'=>''));
        $states=$states['data'];
        if(sizeof($states)>0)
        {
            foreach($states as $state)
            {
                array_push($return,array('label'=>$state['title'],"id"=>$state['id'],'category'=>'state'));
            }
        }

        /*$cities=get_cities(array('searchText'=>$searchText,'index'=>'0','nor'=>$totalPerPage));
        $cities=$cities['data'];
        if(sizeof($cities)>0)
        {
            foreach($cities as $city)
            {
                array_push($return,array('label'=>$city['title'],"id"=>$city['id'],'category'=>'city'));
            }
        }*/
        
        return array('success'=>'true','data'=>$return,'error_code'=>'100');
    }
    else
    {
        return $check;
    }
}


function get_filter($data)
{   
    $category=get_categories(array('groupId'=>'587f04eca32974a8103c9869'));
    $category=$category['data'];
    $filterData['category']=$category;
    //$filterData['venueType']=$category;
    $filterData['location']=array('min'=>'0','max'=>'1000');
    $filterData['price']=array('min'=>'0','max'=>'10000');

    $amenity=get_feature_list_by_id(array('groupId'=>'587f0295a3297480103c9869','fields'=>'title,image'));
    $amenity=$amenity['data'];
    $filterData['amenity']=$amenity;

    return array('success'=>'true','data'=>$filterData,'error_code'=>'100');
} 

function manage_filter($data)
{
    logger(16,'',$data,5);
    $check = check_key_available($data,array('userId'));
    
    $category='';
    if($check['success'] == 'true')
    {
        /*if(isset($data['eventType']) && $data['eventType']!=''){
            $category.=$data['eventType'].'|';            
        }
        unset($data['eventType']);
        if(isset($data['venueType']) && $data['venueType']!=''){
            $category.=$data['venueType'];        
        }
        unset($data['venueType']);
*/
        unset($data['fdate']);
        if(isset($data['minLocation']) || $data['maxLocation']){
            unset($data['minLocation']);     //temporary
            unset($data['maxLocation']);
        }

        if(isset($data['amenity']) && $data['amenity']==''){
           unset($data['amenity']);
        }

        if(isset($data['minPrice']) && isset($data['minPrice'])){
             $data['basePrice']=true;    
        }

        //$data['category']=rtrim($category,"|");

        $result=get_product_listing($data);
        //print_r($result);die;

        /*$data['updatedOn']=new MongoDate();
        $count = count_mongo('usermeta',array('userId'=>$data['userId']));
        
        if($count<1){ $data['id']='0' ;}

        switch($data['id'])
        {
            case "0":
                $manage = add_filter($data);
            break;
            
            default:
                $manage = update_filter($data);
            break;
        }*/
        return $result;
    }
    else
    {
        return $check;
    }
}

function add_filter($data)
{
    logger(16,'',$data,5);
 
        $data['createdOn']=new MongoDate();
        unset($data['id']);
        $data['_id']=new MongoId();
        $res = insert_mongo('usermeta',$data);
        if($res['n'] == 1)
        {
            return array("success"=>"false","data"=>"","error_code"=>"16001");
        }
        $result =db_id($data);
        return array("success"=>"true","data"=>$result,"error_code"=>"16002");
 
}

function update_filter($data)
{
   
    logger(1,'',$data,5);
    
    $where=array('userId'=>$data['userId']);
    if(isset($data['id']) && $data['id']!="")
    {
        $where=array('_id'=>new MongoId($data['id']));
        $id=$data['id'];
        unset($data['id']);
    }

    $data['updatedOn']=new MongoDate();
    $ret=update_mongo('usermeta',$data,$where);
    if($ret['n']>0)
    {
        return array('data'=>$data,'error_code'=>'16004','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1019','success'=>'false');
    }
}

function getHotelIdFromProdId($productId)
{
	$cond = array('_id'=> new MongoId($productId));
	$getHotelId = select_mongo('product',$cond,array());
	$getHotelId = add_id($getHotelId);
	$hotelUserId = $getHotelId[0]['hotelUserId'];
	return $hotelUserId;
}

function taxCal($data)
{
	
	$product = $data['priceinfoDetails'];
	$TotalDays = $data['TotalDays'];
	$productId = $data['id'];
	$hotelUserId = getHotelIdFromProdId($productId);
	
	// check the tax
	
	$checkCond = array('hotelUserId' => $hotelUserId);
	$isExist = select_mongo('gstTax',$checkCond,array());
	$isExist = add_id($isExist);
	$tax = 0;
	if(count($isExist)>0)
	{
		$productJsonArr = json_decode($product,true);
		$taxRates = $isExist[0]['tax'];
		
		foreach($productJsonArr as $pinfo)
		{
			$cond = array();
			$rate = $pinfo['rate'];
			$qty = $pinfo['ticket'];			
			$taxRateVal = 0;
			foreach($taxRates as  $taxRate)
			{
				if($rate >= $taxRate['min'] && $rate <= $taxRate['max'])
				{
					$taxRateVal = $taxRate['taxrate'];
					break;
				}
			}		
			$taxAmout = 0;
			$taxAmout = ($rate*$TotalDays*$qty*$taxRateVal)/100;
			$tax = $tax + $taxAmout;		
		}	
		return $tax;	
		
	}else{
		
		return $tax;
	}	
}

function check_events_availability($data)
{   
    
    $check = check_key_available($data,array('ProductType','userId','id'));   
    if($check['success'] == 'true')
    { 
            if(isset($data['ProductType']) && $data['ProductType']=='event')
            {
                $check = check_key_available($data,array('ProductType','id','bookedfor','quantity','userId'));
                if($check['success']=='true')
                {
                        $find=array('productId'=>$data['id'],'customField.second'=>floatval($data['bookedfor']),'inventory'=>array('$gte'=>intval($data['quantity'])));
                        
                        $EventAvilable=select_mongo('inventory',$find);
                        $EventAvilable=add_id($EventAvilable); 
                        if(sizeof($EventAvilable)>0)
                        {
                            $duration='1';
                            if(isset($data['deviceType']) && $data['deviceType']!="")
                            {
                                return array('success'=>'true','data'=>'Event Is Available','error_code'=>'16054');
                            }
                            else
                            {
                                foreach($EventAvilable as $ret)
                                {
                                    $totalQuentity=intval($ret['inventory'] - $data['quantity']);
                                    $warehouseId=$ret['id'];
                                    $duration=$ret['duration'];
                                }
                                 $warehousedetail=array('id'=>$warehouseId,'inventory'=>$totalQuentity);
                                 $data['bookedStatus']='1';
                                 $response=ProductOrderPlaced($data);
                                 $rsp=array('id'=>$response['data']['id'],'orderId'=>$response['data']['orderId'],'duration'=>$duration);
                                 if($response['success']=='true')
                                 {
                                    ManageWarehouse($warehousedetail);
                                 }
                                 return array('success'=>'true','data'=>$rsp,'error_code'=>'16054');
                            }
                        }
                        else
                        {
                            return array('success'=>'false','data'=>'Event Is Not Available','error_code'=>'16054');
                        }
                }
                else 
                {
                    return $check;
                } 
            }
            elseif (isset($data['ProductType']) && $data['ProductType']=='venue')
            {
                
                $check = check_key_available($data,array('ProductType','id','bookedfor','startDate','endDate','userId','priceinfoDetails','totalPrice'));

                if($check['success']=='true')
                {
                    $data['startDateInMile']=$data['startDate'];
                    $data['endDateInMile']=$data['endDate'];
                    $data['startDate']=date("Y-m-d",$data['startDate']/1000);
                    $data['endDate']=date("Y-m-d",$data['endDate']/1000);
                    $data['venueStatus']='1';
                    $data['bookedStatus']='0';
                    
                    $data['comment'] = 'approved';
                    $data['paymentExpireTime'] = (time() + 60*60*60 )+ 1000;
					
					// calculate tax 
					if(isset($data['deviceType']))
					{
						$taxValue = taxCal($data);
						$totalPrice = $data['totalPrice'] + $taxValue;
						$data['tax'] = (string)$taxValue;
						$data['totalPrice'] = (string)$totalPrice;
						
					}else{
						$data['tax'] = taxCal($data);
						$data['totalPrice'] = $data['totalPrice'] + $data['tax'];
					}
					
					
					//$venueResp=checkVenueAvailable($data);
                    $venueResp['success'] = 'false';
                    if($venueResp['success']=='true'){

                            return array('success'=>'true','data'=>$venueResp['data'],'error_code'=>'16088');
                    }
                    else
                    { 
                             $data['bookedStatus']='0';
                             $response=ProductOrderPlaced($data);
                             $cond=array(
                                        '_id'=>new MongoId($response['data']['id'])
                                        ); 
                             $resp=select_mongo('productOrder',$cond,array());
                             $getVenueDate=add_id($resp); 

                             if(sizeof($getVenueDate)>0)
                             {
                                $date=$getVenueDate[0]['createdOn']->sec * 1000;
                                $status=$getVenueDate[0]['venueStatus'];
                             }
                             $venueHistory=array('id'=>$response['data'],'timeInterval'=>$date,'status'=>$status);
                             return array('success'=>'true','data'=>$venueHistory,'error_code'=>'16099');
                   }
                }
                else
                {
                    return $check;
                }
            }
    }
    else 
    {
        return $check;
    }     
}
function checkVenueAvailable($data)
{

   $con=array('startDate'=>$data['startDate'],'endDate'=>$data['endDate'],'ProductType'=>'venue','userId'=>$data['userId']);

   $resp=select_mongo('productOrder',$con,array('createdOn','venueStatus'));
   $getVenueDate=add_id($resp);
   if(sizeof($getVenueDate)>0){

        $date=$getVenueDate[0]['createdOn']->sec * 1000;
        $id=$getVenueDate[0]['id'];
        $venueHistory=array('id'=>$id,'timeInterval'=>$date,'status'=>$getVenueDate[0]['venueStatus']);
        return array('success'=>'true','data'=>$venueHistory,'error_code'=>'16054');
   }
   else{

        return array('success'=>'false','data'=>'Free for request','error_code'=>'16054');
   }
   
}
function ProductOrderPlaced($data)
{
    $data['createdOn']=new MongoDate();
    $data['productId']=$data['id'];
    unset($data['id']);
    $id=new MongoId();
    $data['_id']=$id;
    $data['type']='3';
    $data['smid']='2';
    $data['status']=1;
    $orderId=generateOrderId(15);
    $data['orderId']=$orderId;
    $addOrder=insert_mongo('productOrder',$data);
    $datarecord['orderId']=$orderId;
    if($addOrder['n']=='0')
    {
        $datarecord['id']=$id->{'$id'};
        if($data['ProductType']=='event'){
           // insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>$data['smid'],'userId'=>$data['userId'],'itemId'=>$datarecord['id']."||".$data['userId'],'eid'=>"202","extra"=>json_encode($data)));
        }
        else{
           // insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>$data['smid'],'userId'=>$data['userId'],'itemId'=>$datarecord['id']."||".$data['userId'],'eid'=>"203","extra"=>json_encode($data)));
        }
        return array('success'=>'true','data'=>$datarecord,'error_code'=>'1600033');
    }
    else
    {
        return array('success'=>'false','data'=>'Try agin','error_code'=>'1600033');
    }
}
function ManageWarehouse($data)
{
    $id=$data['id'];
    unset($data['id']);
    $data['updatedOn']=new MongoDate();
    $inventory=$data['inventory'];
    unset($data['inventory']);
    $data['inventory']=intval($inventory);
    $ret=update_mongo('inventory',$data,array('_id'=>new MongoId($id)));
    if($ret['n']=='1')
    {
       
        return array('data'=>$id,'error_code'=>'1600052','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1600053','success'=>'false');
    }
}

function bookingHistory($data)
{
    
    $check = check_key_available($data,array('userId'));
    if($check['success']=='true')
    {
        $condition = array();  
        $deviceType = 0; 
        if(isset($data['bookedStatus']) && $data['bookedStatus']!='')
        {
            $condition['bookedStatus']= $data['bookedStatus'];
        }
        if(isset($data['deviceType']) && $data['deviceType']!='')
        {
            $deviceType = 1;
        }
        if(isset($data['userId']) && !empty($data['userId']))
        {
            $condition['userId']= $data['userId'];
        }
        if(isset($data['orderId']) && !empty($data['orderId']))
        {
            $condition['orderId'] = $data['orderId'];
        }
        if(isset($data['venueStatus']) && ($data['venueStatus']=='all'))
        {
            $venueStatus = array('0','1','2');
            $condition['venueStatus']= array('$in' => $venueStatus);
        }
        else if(isset($data['venueStatus']))
        {
            $condition['venueStatus']=$data['venueStatus'];
        }
        else
        {
            $venueStatus = array('1','2');
            $condition['venueStatus']= array('$in' => $venueStatus);
        }
        //    echo "<pre>"; print_r($condition); die;
       // $bookingData=select_mongo("productOrder",$condition,array());
        $orderby=array('createdOn'=>-1);
        $bookingData = select_sort_mongo('productOrder',$condition,array(),$orderby);
            $bookingData=add_id($bookingData);
        //echo "<pre>"; print_r($bookingData); die;
         if(sizeof($bookingData)>0)
         {      
             $bookingInfo=array();
             foreach ($bookingData as $key => $getfieldsData) 
             {

                $data=get_product_by_id(array('id'=>$getfieldsData['productId'],'fields'=>'title,address,description,location_title','image'=>'true'));
                $title='';
                $address='';
                $imgurl='';
                $description='';
                $locationtitle='';
                if(sizeof($data['data'])>0)
                {
                    $title=$data['data'][0]['title'];
                    $address=$data['data'][0]['address'];
                    $imgurl=$data['data'][0]['image'];
                    $description=$data['data'][0]['description'];
                    $locationtitle=$data['data'][0]['location_title'];
                }
                $getfieldsData['title']=$title;
                $getfieldsData['address']=$address;
                $getfieldsData['image']=$imgurl;
                $getfieldsData['description']=$description;
                $getfieldsData['location_title']=$locationtitle;
    
    
				if($deviceType)
				{
					 if(isset($getfieldsData['totalPrice']))
					 {
					  $getfieldsData['totalPrice'] = strval($getfieldsData['totalPrice']);
					 }
					 if(isset($getfieldsData['tax']))
					 {
					  $getfieldsData['tax'] = strval($getfieldsData['tax']);
					 }
				 
				}
    
    
    
                if($getfieldsData['venueStatus']=='1')
                {
                    if(isset($getfieldsData['paymetExpireTime']) && !empty($getfieldsData['paymetExpireTime']))
                    {
                        $Ctime = time() * 1000;
                        
                        if($getfieldsData['paymetExpireTime'] <= $Ctime)
                        {
                            $getfieldsData['paymentExpire']= 'true';
                        }
                        else
                        {
                            $getfieldsData['paymentExpire']= 'false';
                        }
                    }
                    else
                    {
                        $getfieldsData['paymentExpire']= 'false';
                    }
                }
                else
                {

                }
               // $bookingInfo[$key]=$getfieldsData;
                
                $bookingInfo[$key]=$getfieldsData;
             }
            return array('data'=>$bookingInfo,'error_code'=>'1600053','success'=>'true');
         }
         else
         {
            return array('data'=>'No record','error_code'=>'1600053','success'=>'false');
         }
    }
    else
    {
           return $check;
    }
    
}
function update_venue_request($data)
{

    $id=$data['id'];
    if($data['status']=='Approved')
    {
        $data['venueStatus']='1';
    }
    else
    {
        $data['venueStatus']='2';
    }
    if(isset($data['paymetExpireTime']) && !empty($data['paymetExpireTime']))
    {
        $data['paymetExpireTime'] =  (time() + 60*60*$data['paymetExpireTime'])*1000;
    }
    else
    {
        unset($data['paymetExpireTime']);
    }
    unset($data['productId']);
    unset($data['status']);
    unset($data['id']);
    $data['updatedOn']=new MongoDate();
    $ret=update_mongo('productOrder',$data,array('_id'=>new MongoId($id)));
    if($ret['n']=='1')
    {
        if($data['status']=='Approved'){
       //insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>'2','userId'=>"0",'itemId'=>$id."||".$data['userId'],'eid'=>"204","extra"=>json_encode($data)));
        }else{
             //insert_notification(array('customerId'=>"43",'mid'=>"16",'smid'=>'2','userId'=>"0",'itemId'=>$id."||".$data['userId'],'eid'=>"205","extra"=>json_encode($data)));
        }
        return array('data'=>$id,'error_code'=>'1600052','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1600053','success'=>'false');
    }
}
function quick_view_info($data)
{
    $check = check_key_available($data,array('productId'));
    if($check['success'] == 'true')
    {
        $Inventorydata=array();
        $Inventoryinfo=select_mongo('inventory',array("productId"=>$data['productId']));
        $Inventoryinfo=add_id($Inventoryinfo);
        if(sizeof($Inventoryinfo)>0)
        {
            $imageData=get_association_data('16','10','1',$data['productId']);
            $profile_picture=$imageData['media']['1'][$data['productId']][0]['mediaName'];
            if($profile_picture!='')
            {
                $img_url=ui_media_url().'images/'.$profile_picture;
            }  
            else
            {
                $img_url=ui_media_url().'image_not_available_400.png';
            }  
             $productname=get_product_by_id(array("id"=>$Inventoryinfo['productId'],'fields'=>'title,address,type'));
             $productname=$productname['data'][0]; 
             $checkcounter=0;
             $counter=0;
             if(isset($data['time'])){
                foreach ($Inventoryinfo as $value) {
                   if($value['customField']['second']==$data['time']){
                    $checkcounter=$counter;
                   }
                   $counter++;
                }
             }
             $Inventorydata=array('title'=>$productname['title'],'type'=>$productname['type'],'address'=>$productname['address'],'date'=>$Inventoryinfo[$checkcounter]['customField']['date'],'second'=>$Inventoryinfo[$checkcounter]['customField']['second'],'PriceDetail'=>$Inventoryinfo[$checkcounter]['PriceDetail'],'image'=>$img_url);
         return array('success'=>'true','data'=>$Inventorydata,'error_code'=>'100');
        }
        else
        {
            return array('success'=>'true','data'=>$Inventorydata,'error_code'=>'100');
        }
    }
    else
    {
        return $check;
    }
}
function contactSetting($data)
{
    $contactInfo=array();
    $contactInfo[]=array('call'=>'7014080493');
    return array('success'=>'true','data'=>$contactInfo,'error_code'=>'100');
}
function billingInvoice($data)
{
    $contactInfo=array();
    $link=site_url().'uploads/Invoice_Template.pdf';
    $contactInfo[]=array('invoicePdf'=>$link);
    return array('success'=>'true','data'=>$contactInfo,'error_code'=>'100');
}
function deleteEvent($data)
{
    if(isset($data['id'])){
        $condition['productId']=array('$in'=>array($data['id']));
        $counter=count_mongo("productOrder",$condition);
        if($counter>0){
            $Status=update_mongo('product',array('status'=>'0','deletedOn'=>new MongoDate()),array("_id"=>new MongoId($data['id'])));
                update_mongo('inventory',array('status'=>'0','deletedOn'=>new MongoDate()),$condition);
        }
        else{
             $Status=delete_mongo('product',array('_id'=>new MongoId($data['id'])));
                delete_mongo('inventory',$condition);
        }
    }
    return array("success"=>"true","data"=>$data['id'],"error_code"=>"16005");
}
function deletewarehouse($data){
     if(isset($data['id'])){
        $cond=array('_id'=>new MongoId($data['id'])); 
        $Inventoryinfo=select_mongo("inventory",$cond);
        $Inventoryinfo=add_id($Inventoryinfo);
        $counter=count_mongo('productOrder',array('productId'=>array('$in'=>array($Inventoryinfo[0]['productId']))));
        if($counter>0){
            return array("success"=>"false","data"=>'Please delete event/venue first',"error_code"=>"160019");
        }
        else{
            $data=delete_mongo('inventory',array('_id'=>new MongoId($data['id'])));
        }
        return array("success"=>"true","data"=>$data['id'],"error_code"=>"16000");
    }
    return array("success"=>"false","data"=>$data['id'],"error_code"=>"16005");
}
function deleteCategory($data){
    if(isset($data['id'])){
        $counter=count_mongo('product',array('category'=>array('$in'=>array($data['id']))));
        if($counter>0){
            return array("success"=>"false","data"=>'This Category Already Used in event/venue',"error_code"=>"160003");
        }
        else{
            $data=delete_mongo('productfeature',array('_id'=>new MongoId($data['id'])));
        }
        return array("success"=>"true","data"=>$data['id'],"error_code"=>"16000");
    }
    return array("success"=>"false","data"=>$data['id'],"error_code"=>"16000");
}

function deleteTax($data){
    
	if(isset($data['id']))
	{
        $data=delete_mongo('gstTax',array('_id'=>new MongoId($data['id'])));

        return array("success"=>"true","data"=>$data['id'],"error_code"=>"16000");
    }
    return array("success"=>"false","data"=>$data['id'],"error_code"=>"16000");
}


function locationfilter($data)
{
   $condition=array();
   $condition['location']=array('$near'=>array('$geometry'=>array('type'=>"Point",'coordinates'=>array(77.07,28.49)),'$maxDistance'=>10000));
  $resp=select_mongo('product',$condition);
  $result=add_id($resp);
return array("success"=>"false","data"=>$result,"error_code"=>"16000");
}
function getVenueHistory($data)
{ 
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
       $con=array('_id'=>new MongoId($data['id']));

       $resp=select_mongo('productOrder',$con,array());
       $getVenueDate=add_id($resp);
       if(sizeof($getVenueDate)>0){

           return array('success'=>'true','data'=>$getVenueDate,'error_code'=>'16054');
       }
       else{

            return array('success'=>'false','data'=>'Free for request','error_code'=>'16054');
       }
   }
   else
   {
        return $check;
   }
}

//////**********************************************////
function getTxnDetails($data)
{
   // print_r($data); die;
    //$check=check_key_available($data,array('id'));
    $check['success']='true';
    if($check['success']=='true')
    {
        $cond = array();
        if(isset($data['id']) && !empty($data['id']))
        {
            $cond['id'] = $data['id'];
        }
        if(isset($data['userId']) && !empty($data['userId']))
        {
            $cond['userId'] = $data['userId'];
        }
        if(isset($data['orderId']) && !empty($data['orderId']))
        {
            $cond['orderId'] = $data['orderId'];
        }
        if(isset($data['txnid']) && !empty($data['txnid']))
        {
            $cond['txnid'] = $data['txnid'];
        }
        if(isset($data['txnid']) && !empty($data['txnid']))
        {
            $cond['txnid'] = $data['txnid'];
        }

        $alreadyTxn = array();
       // echo "<pre>"; print_r($cond); die;
        $alreadyTxn = select_mongo('txnDetails',$cond);
    
        $alreadyTxn=add_id($alreadyTxn);
        // echo "<pre>"; print_r($alreadyTxn); die;
        if(count($alreadyTxn)>0)
        {
            //$alreadyTxn = $alreadyTxn[0];
            $userid = $alreadyTxn[0]['userId']; 
            $productData = array();
            $userData =  get_resource_by_id(array('id'=>"$userid"));
            foreach ($alreadyTxn as $key => $value) {

                //echo $value['productId']; die;
                $product_data=get_product_by_id(array('id'=>$value['productId'],'fields'=>'title,address,description,location_title','image'=>'true'));
                $title='';
                $address='';
                $imgurl='';
                $description='';
                $locationtitle='';
                if(sizeof($product_data['data'])>0)
                {
                    $title=$product_data['data'][0]['title'];
                    $address=$product_data['data'][0]['address'];
                    $imgurl=$product_data['data'][0]['image'];
                    $description=$product_data['data'][0]['description'];
                    $locationtitle=$product_data['data'][0]['location_title'];
                }
                $value['product_title']=$title;
                $value['product_address']=$address;
                $value['product_image']=$imgurl;
                $value['product_description']=$description;
                $value['product_location_title']=$locationtitle;
                $allData['txnData'][] = $value;
                
            }
            $allData['userData'] = $userData['data'][0];
            return array("success"=>"true","error_code"=>"100","data"=>$allData);
         }  
         else
         {
            return array("success"=>"false","error_code"=>"100","data"=>"User Not Exist");
         }
        
     }

}
function manage_benefit($data)
{ 
    logger(16,'',$data,5);
    $check = check_key_available($data,array('id'));
    
    if($check['success'] == 'true')
    {
        $data['updatedOn']=new MongoDate();

        switch($data['id'])
        {
            case "0":
                $manage = add_benefit($data);
            break;
            
            default:
                $manage = update_benefit($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }
}

function add_benefit($data)
{
    global $db;
    logger(16,'',$data,5);
      
        $data['createdOn']=new MongoDate();
        $data['_id']=new MongoId();
        $data['default']=0;
            $res = insert_mongo('benefits',$data);
            if($res['n'] == 1)
            {
                return array("success"=>"false","data"=>"","error_code"=>"16070");
            }
            else
            {
                $benefitId =db_id($data);
            }

            return array("success"=>"true","data"=>$benefitId,"error_code"=>"16071");
        
}

function update_benefit($data)
{
    global $db;
    logger(16,'',$data,5);      
    $cond=array('_id'=>new MongoId($data['id']));      
    $res = update_mongo('benefits',$data,$cond);
    return array("success"=>"true","data"=>$data['id'],"error_code"=>"16072");        
}

function get_benefit($data)
{
    global $db;
    logger(16,'',$data,5);
    $cond = array();
    
    if($data['id']!=0)
        {
            $id = explode("|",$data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $cond=array('_id'=>array('$in'=> $id));
        }
        
        $fetchData = select_mongo('benefits',$cond,array());

    $fetchData = add_id($fetchData,"id");
    
    if(sizeof($fetchData)>0)
    {
        return array('success'=>'true','data'=>$fetchData,'error_code'=>'1600044');
    }
    else
    {
        return array('success'=>'false','data'=>$data,'error_code'=>'1600043');
    }
}
function delete_benefit($data)
{
        $delete=delete_mongo('benefits',array("_id"=>new MongoId($data['id'])));
        if($delete['n']=='0')
        { 
            
            return array('data'=>$data,'error_code'=>'16074','success'=>'false');
        }
        else
        {
            return array('data'=>$data,'error_code'=>'16075','success'=>'true');
        }
}

/***new**/
function manage_commentbenefit($data)
{ 
    logger(16,'',$data,5);
    $check = check_key_available($data,array('id'));
    
    if($check['success'] == 'true')
    {
        $data['updatedOn']=new MongoDate();

        switch($data['id'])
        {
            case "0":
                $manage = add_commentbenefit($data);
            break;
            
            default:
                $manage = update_commentbenefit($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }
}

function add_commentbenefit($data)
{
    global $db;
    logger(16,'',$data,5);
      
        $data['createdOn']=new MongoDate();
        $data['_id']=new MongoId();
        $data['default']=0;
            $res = insert_mongo('benefitscomment',$data);
            if($res['n'] == 1)
            {
                return array("success"=>"false","data"=>"","error_code"=>"16070");
            }
            else
            {
                $benefitId =db_id($data);
            }

            return array("success"=>"true","data"=>$benefitId,"error_code"=>"16071");
        
}

function update_commentbenefit($data)
{
    global $db;
    logger(16,'',$data,5);      
    $cond=array('_id'=>new MongoId($data['id']));      
    $res = update_mongo('benefitscomment',$data,$cond);
    return array("success"=>"true","data"=>$data['id'],"error_code"=>"16072");        
}

function get_commentbenefit($data)
{
    global $db;
    logger(16,'',$data,5);
    $cond = array();
    
    if($data['id']!=0)
        {
            $id = explode("|",$data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $cond=array('_id'=>array('$in'=> $id));
        }
        
        $fetchData = select_mongo('benefitscomment',$cond,array());

    $fetchData = add_id($fetchData,"id");
    
    if(sizeof($fetchData)>0)
    {
        return array('success'=>'true','data'=>$fetchData,'error_code'=>'1600044');
    }
    else
    {
        return array('success'=>'false','data'=>$data,'error_code'=>'1600043');
    }
}
function delete_commentbenefit($data)
{
        $delete=delete_mongo('benefitscomment',array("_id"=>new MongoId($data['id'])));
        if($delete['n']=='0')
        { 
            
            return array('data'=>$data,'error_code'=>'16074','success'=>'false');
        }
        else
        {
            return array('data'=>$data,'error_code'=>'16075','success'=>'true');
        }
}
function make_paymentBk($data)
{
  
    $check=check_key_available($data,array('orderId'));
    if($check['success']=='true')
    {
        $tmp = select_mongo('productOrder',array("orderId"=>"$data[orderId]"));
        $return=add_id($tmp);
        //print_r($return); die;
        if(count($return)>0)
        {
           // print_r($return); die;
            if(isset($return[0]['userId']))
            {  $userid = $return[0]['userId']; 
               // print_r($return[0]); die;
               $userData =  get_resource_by_id(array('id'=>"$userid"));
               
               if(count($userData['data']))
               {
                  $data = array("orderData"=>$return[0],"userData"=>$userData['data'][0]);
                  return array("success"=>"true","error_code"=>"100","data"=>$data);
               }
               else
               {
                 return array("success"=>"false","error_code"=>"100","data"=>"User Not Exist");
               }
               
            }
        }
    }
}
function success_payment($data)
{
    
    $check=check_key_available($data,array('orderId','transaction'));
    if($check['success']=='true')
    { 
    	$alreadyTxnStatus = 'false';
        if(isset($data['transaction']))
        {
            $data['transaction']=json_decode($data['transaction'],true);
        }
        $TxnId = $data['transaction']['txnid'];
        $alreadyTxn = select_mongo('txnDetails',array("txnid"=>"$TxnId"));
        $alreadyTxn=add_id($alreadyTxn);

        /*if($_SESSION['txnid'] != $data['transaction']['txnid'])
        {
            return array("success"=>"false","error_code"=>"100","data"=>"txnid not valid");
        }*/
        $return = array();
        $tmp = select_mongo('productOrder',array("orderId"=>"$data[orderId]"));
        $return=add_id($tmp);
        if(count($return)>0)
        {
            $return = $return[0];
            $id = $return['id'];
            unset($return['id']);
            if($data['transaction']['error']=='E000')
            {
                $return['bookedStatus'] = '1';
            }
            else
            {
                $return['bookedStatus'] = '0';
            }
            
            $return['txnid'] = $data['transaction']['txnid'];
            $return['txnDetails'] = $data['transaction'];
            $return['txnDT'] = $data['transaction']['addedon'];
            $return['txnDT_mongo'] = new MongoDate(strtotime(date($data['transaction']['addedon'])));
            
           $TxnReturn = array();
           $TxnReturn = $return;
           
            unset($_SESSION['txnid']);
            $ret = update_mongo('productOrder',$return,array('_id'=>new MongoId($id)));
            if(count($alreadyTxn)==0)
            {
                $resultTxn = insert_mongo('txnDetails',$TxnReturn);
            }
            else
            {
            	$alreadyTxnStatus = 'true';
            }
            
            
            if($ret['n']==1)
            {
               if(isset($return['userId']))
               {  
                
                  $userid = $return['userId']; 
                  $return['alreadyTxnStatus'] = $alreadyTxnStatus;
                  $userData =  get_resource_by_id(array('id'=>"$userid"));
                   
                   if(count($userData['data']))
                   {
                      $data = array("orderData"=>$return,"userData"=>$userData['data'][0]);
                      return array("success"=>"true","error_code"=>"100","data"=>$data);
                   }
                   else
                   {
                     return array("success"=>"false","error_code"=>"100","data"=>"User Not Exist");
                   }
                }
            }
            else
            {
             return array("success"=>"false","error_code"=>"100","data"=>"User Not Exist");
            }
        }
    }
}
function updatestatus($data)
{
	global $db;
    logger(16,'',$data,5);      
    $cond=array('_id'=>new MongoId($data['id']));  
    $updateData = array('status'=>$data['status']);
    $res = update_mongo('product',$updateData,$cond);
    return array("success"=>"true","data"=>$data['id'],"error_code"=>"16072");        
}

?>