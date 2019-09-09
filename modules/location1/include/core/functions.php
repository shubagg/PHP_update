<?php
include("geofence.php");
function manage_location($data)
{
    logger("11",$data,"",5,"/manage_location");
    switch ($data['type']) {
        case 'coordinates':
            $check = check_key_available($data,array('id','smid','lat','lng'));
        break;

        case 'address':
            $check = check_key_available($data,array('id','smid','address'));
        break;

        case 'cell_id':
            $check = check_key_available($data,array('id','smid','cell_id'));
        break;
        
        default:
            return array("success"=>"false","data"=>"","error_code"=>"11001");
            break;
    }
    
    if($check['success'] == 'true')
    {
        switch($data['id'])
        {
            case "0":
                $manage = add_location($data);
            break;
            
            default:
                $manage = update_location($data);
            break;
        }
        add_in_buffer($data,$data['type']);
        return $manage;
    }
    else
    {
        return $check;
    }
    
}

function add_in_buffer($data,$type)
{
    global $db;
    logger("11",$data,"",5,"/add_in_buffer");
    switch ($type) {
        case 'coordinates':
            $arr = $db->bufferlocation->count(array('lat'=>floatval($data['lat']),'lng'=>floatval($data['lng'])));
            if($arr==0)
            {
                $arr = $db->bufferlocation->insert(array('chk'=>'0','cell_id'=>'','lng'=>floatval($data['lng']),'lat'=>floatval($data['lat']),'address'=>''));
            }
        break;

        case 'address':
            $arr = $db->bufferlocation->count(array('address'=>str_replace("+"," ",$data['address'])));
            if($arr==0)
            {
                $arr = $db->bufferlocation->insert(array('chk'=>'0','cell_id'=>'','lng'=>'','lat'=>'','address'=>str_replace("+"," ",$data['address'])));
            }
        break;

        case 'cell_id':
            $arr = $db->bufferlocation->count(array('cell_id'=>$data['cell_id']));
            if($arr==0)
            {
                $arr = $db->bufferlocation->insert(array('chk'=>'0','cell_id'=>$data['cell_id'],'lng'=>'','lat'=>'','address'=>''));
            }
        break;
        
        default:
            # code...
            break;
    }
}
function add_location($data)
{
    global $db;
    logger("11",$data,"",5,"/add_location");
    $data['uploadedOn'] = new MongoDate();
    unset($data['id']);
    if($data['type']=="coordinates"){
        $data['loc']=array(floatval($data['lng']),floatval($data['lat']));
        unset($data['lng']);
        unset($data['lat']);
    }
    $res = insert_mongo('location',$data);
    if($res['n'] == 1)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"11002");
    }
    else
    {
        $loc_id =db_id($data);
        if(isset($data['amid'])&&$data['amid']!="")
            associate_module(11,$loc_id,$data['amid'],$data['asmid'],$data['aiid'],array(),'add');
    }
    return array("success"=>"true","data"=>$loc_id,"error_code"=>"11002");
}

function update_location($data)
{
    global $db;
    logger("11",$data,"",5,"/update_location");
    $data['uploadedOn'] = new MongoDate();
    $id = $data['id'];
    unset($data['id']);
    if($data['type']=="coordinates"){
        $data['loc']=array(floatval($data['lng']),floatval($data['lat']));
        unset($data['lng']);
        unset($data['lat']);
    }
    
    $res = $db->location->update(array('_id'=> new MongoId($id)),array('$set'=>$data));
    if($res['n'] == 0)
    {
        return array("success"=>"false","data"=>"","error_code"=>"11004");
    }
    else
    {
        if(isset($data['amid'])&&$data['amid']!="")
            associate_module(11,$id,$data['amid'],$data['asmid'],$data['aiid'],array(),'add');
        return array("success"=>"false","data"=>"","error_code"=>"11005");
    }
}

function delete_location($data)
{
    logger("11",$data,"",5,"/delete_location");
    global $db;

    $arr = array(
            'mid'=>$data['mid'],
            'smid'=>$data['smid'],
            '_id'=>new MongoId($data['iid'])
        );

    $arr = $db->location->remove($arr);
    return array("success"=>"success","data"=>"","error_code"=>"11006");
}

/*function find_location($module,$item,$item_id)
{
    //print_r(array('module'=>$module,'item'=>$item,'item_id'=>$item_id));
    global $db;
    $tmp = $db->location->find(array('module'=>$module,'item'=>$item,'item_id'=>$item_id));
    $arr = data_array($tmp);
    //print_r($arr);
    if(count($arr)>0)
        return $arr[0];
}

function find_location_two($module1,$item1,$item_id1,$module2,$item2,$item_id2,$mode="road")
{
    $data1 = find_location($module1,$item1,$item_id1);
    $data2 = find_location($module2,$item2,$item_id2);

    $origin = get_lat_long($data1);
    $destination = get_lat_long($data2);
    return find_location_lat_long($origin,$destination,$mode);
}

function find_location_lat_long($origin,$destination,$mode="road")
{
    switch ($mode) {
        case 'road':
            $ret = get_road_distance($origin,$destination);
            break;

        case 'air':
            $ret = get_air_distance($origin,$destination);
            break;

        default:
            $ret =  411;
            break;
    }
    return $ret;
}*/
function find_location_radius($data)
{
   // if(!module_item_exists($module,$item))
    //    return "module/item not exsits";
    global $db;
    logger("11",$data,"",5,"/find_location_radius");
    $check = check_key_available($data,array('amid','asmid','lat','lng','radius'));
    $tmp = array();
    if($check['success'] == 'true')
    {
        $amid = explode("|",$data['amid']);
        $asmid = explode("|",$data['asmid']);
        $final = array();
        for ($i=0; $i <count($asmid) ; $i++) { 
            $tmp_asmid = explode(";",$asmid[$i]);
            foreach ($tmp_asmid as $key => $val) {
                array_push($tmp,array('amid'=>$amid[$i],'asmid'=>$val));
            }
        }


        $arr = array(
            '$or'=>$tmp
         );  

      
        $arr1 = $db->locationAssociate->find($arr);
        $arr1 = add_id($arr1,'id');
        $loc_id = array();

        foreach ($arr1 as $key => $val) {
            array_push($loc_id,new MongoId($val['iid']));
        }
        $arr = array(
            '_id'=>array('$in'=>$loc_id),
            'loc'=>array('$near'=>array(floatval($data['lng']),floatval($data['lat'])),'$maxDistance'=>intval($data['radius']))
        );

        $arr1 = $db->location->find($arr);
        
        $arr = add_id($arr1,'id');
        foreach ($arr as $key => $val) {
            $type = $val['type'];
            $arr1 = array();
            switch ($type) {
                case 'coordinates':
                    $arr1['lat']=floatval($val['loc'][1]);
                    $arr1['lng']=floatval($val['loc'][0]);
                break;

                case 'address':
                    $arr1['address']=str_replace("+"," ",$val['address']);
                break;

                case 'cell_id':
                    $arr1['cell_id']=$val['cell_id'];
                break;
                
                default:
                    # code...
                    break;
            }
            $bffr = $db->bufferlocation->find($arr1);
            $bffr = add_id($bffr,"id");
            if(count($bffr)>0)
                $arr[$key]['extra']=$bffr[0];
            else
                $arr[$key]['extra']=array();
        }
        //print_r($arr1);
        return array("success"=>"true","data"=>$arr,"error_code"=>"11007");
    }
    else
    {
        return $check;
    }

}

function validate_lat_long($origin,$destination)
{
    if($origin['lat']>90||$origin['lat']<-90||$destination['lat']>90||$destination['lat']<-90)
    {
       return true;
    }

    if($origin['lng']>180||$origin['lng']<-180||$destination['lng']>180||$destination['lng']<-180)
    {
       return true;
    }
    return false;
}/*
function get_road_distance($origin,$destination)
{
    if(validate_lat_long($origin,$destination))
        return 409;
    
    $origin = $origin['lat'].",".$origin['lng'];
    $destination = $destination['lat'].",".$destination['lng'];
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin."&destinations=".$destination."&key=AIzaSyD-QLCXuRzbBnGFJ5uYz1CWEmqpYQ8LJOE";
    $tmp = curl_get($url);
    if($tmp!="")
    {
        $data = json_decode($tmp);
        if(isset($data->rows))
            if(isset($data->rows[0]->elements))
                if(isset($data->rows[0]->elements[0]->distance->text))
                    return $data->rows[0]->elements[0]->distance->text;
    }
    return 410;
}*/

function get_air_distance($origin,$destination) 
{
    if(validate_lat_long($origin,$destination))
        return 409;

    $lat1=$origin['lat'];
    $lng1=$origin['lng'];
    $lat2=$destination['lat'];
    $lng2=$destination['lng'];
    
    return ceil(air_distance($lat1, $lng1, $lat2, $lng2, $unit="K"))." km";
}

function air_distance($lat1, $lon1, $lat2, $lon2, $unit="K") 
{

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
/*
function get_lat_long($data)
{
    if(!isset($data['loc']))
        return false;
    $tmp =array();
    $tmp['lat'] = $data['loc'][1];
    $tmp['lng'] = $data['loc'][0];
    return $tmp;
}
*/
//********Vipin Chagne function**********************
function get_address_buffer($lat,$lng)
{
    global $db,$ex_location_url;
    logger(11,'',array('lat'=>$lat,'lng'=>$lng),5);
    $lng=floatval($lng);
    $lat=floatval($lat);
    
    $url = $ex_location_url."?lat=".$lat."&lng=".$lng."&getaddressby=latlng";
    $data = send_curl_get($url);
    //$arr = $db->bufferlocation->find(array('lng'=>$lng,'lat'=>$lat,'chk'=>'1'));
    //$arr = add_id($arr,"id");
    $data = json_decode($data,true);
    if(count($arr)>0)
        return $data[0]['address'];
    return '';
}



//**************************************************//
/*function get_address_buffer($lat,$lng)
{
    global $db;
    logger(11,'',array('lat'=>$lat,'lng'=>$lng),5);
    $lng=floatval($lng);
    $lat=floatval($lat);
    $arr = $db->bufferlocation->find(array('lng'=>$lng,'lat'=>$lat,'chk'=>'1'));
    $arr = add_id($arr,"id");
    if(count($arr)>0)
        return $arr[0]['address'];
    return '';
}
*/
/*function add_address_buffer($lat,$lng,$address)
{
    global $db;
    logger(11,'',array('lat'=>$lat,'lng'=>$lng,'address'=>$address),5);
    $lng=floatval($lng);
    $lat=floatval($lat);
    
    $db->bufferlocation->update(array('lng'=>$lng,'lat'=>$lat),array('chk'=>'1','cell_id'=>'','lng'=>$lng,'lat'=>$lat,'address'=>$address),array("upsert" => true));
}*/
//------------Vipin Chagne function--------------//
function add_address_buffer($lat,$lng,$address)
{
    global $db;
    logger(11,'',array('lat'=>$lat,'lng'=>$lng,'address'=>$address),5);
    $lng=floatval($lng);
    $lat=floatval($lat);
    
   // $db->bufferlocation->update(array('lng'=>$lng,'lat'=>$lat),array('chk'=>'1','cell_id'=>'','lng'=>$lng,'lat'=>$lat,'address'=>$address),array("upsert" => true));
    $url = $ex_location_url."?lat=".$lat."&lng=".$lng."&address=".$address."&updateaddress";
    $data = send_curl_get($url);
}
//*************************************************//
function get_coordinates_buffer($address)
{
    global $db;
    logger("11",$address,"",5,"/find_location_radius");
    $arr = $db->bufferlocation->find(array('address'=>$address,'chk'=>'1'));
    $arr = add_id($arr,"id");
    if(count($arr)>0)
        return array('lat'=>$arr[0]['lat'],'lng'=>$arr[0]['lng']);
    return '';
}

function add_coordinates_buffer($lat,$lng,$address)
{
    global $db;
    logger(11,'',array('lat'=>$lat,'lng'=>$lng,'address'=>$address),5,"/find_location_radius");

    $lng=floatval($lng);
    $lat=floatval($lat);
    $db->bufferlocation->update(array('address'=>$address),array('chk'=>'0','cell_id'=>'','lng'=>$lng,'lat'=>$lat,'address'=>$address),array("upsert" => true));
}

function getaddress($data)
{
    logger("11",$data,"",5,"/getaddress");
    $check = check_key_available($data,array('lat','lng'));
    
    if($check['success'] != 'true')
    {
        return $check;
    }
    global $db;
    $data['lat'] = intval(($data['lat']*1000000))/1000000;
    $data['lng'] = intval(($data['lng']*1000000))/1000000;
    get_address_buffer($data['lat'],$data['lng']);
    if($loc!='')
    {
        return array("success"=>"true","data"=>$loc,"error_code"=>"11008");
    }
    else
    {
    //AIzaSyDJxZscwO0EscZgwuCvGjcddu_vPXRJO1g
        $data1 = get_google_api('latlng='.trim($data['lat']).','.trim($data['lng']),$api_key="");
    
        if(isset($data1['status'])&&$data1['status']=="OK")
        {
            $addr = $data1['results'][0]['formatted_address'];
            add_address_buffer($data['lat'],$data['lng'],$addr);
            return array("success"=>"true","data"=>$addr,"error_code"=>"11008");
        }
        else
        {
        
            //query over limit
            return $data1;
        }

    }
}

function getcoordinates($data)
{
   logger("11",$data,"",5,"/getcoordinates");
    $check = check_key_available($data,array('address'));
    if($check['success'] != 'true')
    {
        return $check;
    }
    global $db;
    $loc = get_coordinates_buffer(str_replace("+"," ",$data['address']));
    if($loc!='')
    {
        return array("success"=>"true","data"=>$loc,"error_code"=>"11011");
    }
    else
    {
        
        $data1 = get_google_api('address='.trim(str_replace(" ","+",$data['address'])),$api_key="AIzaSyDJxZscwO0EscZgwuCvGjcddu_vPXRJO1g");
    
        if(isset($data1['status'])&&$data1['status']=="OK")
        {
            $coord = $data1['results'][0]['geometry']['location'];

            add_coordinates_buffer($coord['lat'],$coord['lng'],str_replace("+"," ",$data['address']));
            return array("success"=>"true","data"=>$coord,"error_code"=>"11011");
        }
        else
        {
            //query over limit
            return $data1;
        }

    }
}

function queue_get_address()
{
    logger("11",'',"",5,"/queue_get_address");
    global $db;
    $request_count=10;
    $arr = $db->locationSettings->count(array('get_address_from_google'=>'1'));
    if($arr>0){
        $request_limit = $db->locationSettings->find(array('get_address_request_limit'=>array('$ne'=>'')));
        $request_limit = add_id($request_limit,"id");
        if(count($request_limit)>0)
            $request_limit = intval($request_limit[0]['get_address_request_limit']);
        else
            $request_limit =$request_count;
        $arr = $db->bufferlocation->find(array('lat'=>array('$ne'=>''),'lng'=>array('$ne'=>''),'chk'=>'0'))->limit($request_limit);
        foreach ($arr as $key => $val) {
            $data['lat']=$val['lat'];
            $data['lng']=$val['lng'];
            $address = getaddress($data);
            if($address['success']=='true'){
                $val['address']=$address['data'];
                $id = db_id($val);
                unset($val['_id']);
                $val['chk']='1';
                $db->bufferlocation->update(array('lat'=>$val['lat'],'lng'=>$val['lng'],'chk'=>'0'),array('$set'=>$val),array("multiple"=>true));
            }
        }
    }
    else
    {
        echo "settings off";
    }
}

function queue_get_coordinates()
{   logger("11",'',"",5,"/queue_get_coordinates");
    global $db;
    $request_count=10;
    $arr = $db->locationSettings->count(array('get_coordinates_from_google'=>'1'));
    if($arr>0){
        $request_limit = $db->locationSettings->find(array('get_coordinates_request_limit'=>array('$ne'=>'')));
        $request_limit = add_id($request_limit,"id");
        if(count($request_limit)>0)
            $request_limit = intval($request_limit[0]['get_coordinates_request_limit']);
        else
            $request_limit =$request_count;

        $arr = $db->bufferlocation->find(array('address'=>array('$ne'=>''),'lng'=>'','lat'=>'','chk'=>'0'))->limit($request_limit);
        foreach ($arr as $key => $val){
            $data['address']=$val['address'];
            $coord = getcoordinates($data);
            if($coord['success']=='true'){
                $val['lat']=$coord['data']['lat'];
                $val['lng']=$coord['data']['lng'];
                $id = db_id($val);
                unset($val['_id']);
                $val['chk']='1';
                $db->bufferlocation->update(array('address'=>$val['address'],'chk'=>'0'),array('$set'=>$val),array("multiple"=>true));
            }
        }
    }
    else
    {
        echo "settings off";
    }
}

$google_api_key_counter=0;
$google_api_key=array();
function get_api_key($next=false)
{
    global $google_api_key_counter,$db,$google_api_key;
    if($next)
    {
        $google_api_key_counter++;
    }

    if(count($google_api_key)==0)
    {
        $arr = $db->locationSettings->find(array('google_key'=>array('$ne'=>'')));
    $arr = add_id($arr,'id');
    
        foreach ($arr as $key => $val) {
       if(isset($val['google_key']))
       {
                array_push($google_api_key,$val['google_key']);
       }
        }
    }
    //echo $google_api_key_counter." -- ".count($google_api_key);   
    if($google_api_key_counter>count($google_api_key))
    {
        return false;
    }
    else
    {
    $index = $google_api_key_counter-1;
        return $google_api_key[$index];
    }
    
}
/** Vipin function  **/
function get_google_api($paramter,$api_key,$api_key_data = array())
{
    global $db;
    if(!count($api_key_data))
    {
            $api_key_data = get_api_key_new(true);
    }
        
     $k = array_rand($api_key_data);
     $api_key = $api_key_data[$k];
        
        
        

        
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?'.$paramter.'&sensor=false&key='.$api_key;
    
    $json = curl_get($url,array());

    $data1=json_decode($json,true);
    $status = $data1['status'];
    $black='OVER_QUERY_LIMIT';
    $denied='REQUEST_DENIED';
    $zero='ZERO_RESULTS';
    if(strtolower("$black")==strtolower("$status") || strtolower("$status")==strtolower("$denied"))
    {
       // $api_key
        if(!empty($api_key))
        {
            if(($key = array_search($api_key, $api_key_data)) !== false) {
                unset($api_key_data[$key]);
               
                   
                $arr = $db->locationSettings->update(array('google_key'=>$api_key),array('$set'=>array('dt'=>date('Y-m-d')))); 
            }
            
        }   
        if($api_key===false)
        {
            return array("success"=>"false","data"=>"","error_code"=>"11010");
        }
        else
        {
            return get_google_api($paramter,$api_key,$api_key_data);
        }
    }
    else if(strtolower("$status")==strtolower("$zero"))
    {
        return array("success"=>"false","data"=>"","error_code"=>"11013");
    }
    else
    {
         return $data1;
    }
}

/** Manoj function   
 * function get_google_api($paramter,$api_key)
{
    
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?'.$paramter.'&sensor=false&key='.$api_key;
    $json = curl_get($url,array());

    $data1=json_decode($json,true);
    //print_r($data1);
    $status = $data1['status'];
    $black='OVER_QUERY_LIMIT';
    $denied='REQUEST_DENIED';
    if(strtolower("$black")==strtolower("$status")  || strtolower("$status")==strtolower("$denied"))
    {
       // $api_key
        $api_key = get_api_key(true);
    //print_r($api_key);
        if($api_key===false)
        {
            return array("success"=>"false","data"=>"","error_code"=>"11010");
        }
        else
        {
            return get_google_api($paramter,$api_key);
        }
    }
    else
    {
        return $data1;
    }
}**/

function get_location_by_id($data)
{
    global $db;
    logger("11",$data,"",5,"/get_location_by_id");
    $id = explode("|",$data['id']);
    if(!is_array($id))
        $id = array($id);
    foreach ($id as $key => $val) {
        $id[$key]=new MongoId($val);
    }
    $arr = $db->location->find(array('_id'=>array('$in'=>$id)));
    $arr = add_id($arr,"id");
    foreach ($arr as $key => $val) {
        $type = $val['type'];
        $arr1 = array();
        switch ($type) {
            case 'coordinates':
                $arr1['lat']=floatval($val['loc'][1]);
                $arr1['lng']=floatval($val['loc'][0]);
            break;

            case 'address':
                $arr1['address']=str_replace("+"," ",$val['address']);
            break;

            case 'cell_id':
                $arr1['cell_id']=$val['cell_id'];
            break;
            
            default:
                # code...
                break;
        }
        $bffr = $db->bufferlocation->find($arr1);
        $bffr = add_id($bffr,"id");
        if(count($bffr)>0)
            $arr[$key]['extra']=$bffr[0];
        else
            $arr[$key]['extra']=array();
    }
    return array("success"=>"true","data"=>$arr,"error_code"=>"11012");
}
//********Vipin Changes******************//
function get_api_key_new($next=false)
{
    global $google_api_key_counter,$db,$google_api_key;
    if($next)
    {
        $google_api_key_counter++;
    }

    if(count($google_api_key)==0)
    {
         
        $arr = $db->locationSettings->find(array('google_key'=>array('$ne'=>''),'dt'=>array('$lt'=>date('Y-m-d'))));
        
        foreach ($arr as $key => $val) {
            array_push($google_api_key,$val['google_key']);
        }

    }
    if(count($google_api_key))
    {
        return $google_api_key;
    }
    else
    {
        return false;
    }
    /*if($google_api_key_counter>=count($google_api_key))
    {
        return false;
    }
    else
    {   
        return $google_api_key;
    }*/
    
}
function get_country($data)
{   logger("11",$data,"",5,"/get_country");
    $check=check_key_available($data,array('countryId'));
    if($check['success']=='true')
    {
        $query=array();
        if(isset($data['search']))
        {
            $search_string=$data['search'];
            $query = array(
                    'title' => new MongoRegex("/^$search_string/i"),
                    );
        }
       
        if($data['countryId']!='0')
        {
            $id=explode("|",$data['countryId']);
            $query=array('countryId'=>array('$in'=>$id));
        }
        $getCountry=select_mongo('country',$query);
        $fetCountry=add_id($getCountry);

        return array("success"=>"true","data"=>$fetCountry,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function get_states($data)
{   
    logger("11",$data,"",5,"/get_states");
    $check=check_key_available($data,array('countryId'));
    if($check['success']=='true')
    {
        $query=array();
        if($data['countryId']!='0')
        {   
            $query=array('countryId'=>$data['countryId']);
        }
        if(isset($data['searchText']))
        {
            $search_string=$data['searchText'];
            $query = array(
                    'title' => new MongoRegex("/^$search_string/i"),
                    );
        }
        if(isset($data['stateId'])){ $query['stateId']=$data['stateId']; }
        if(isset($data['id']) && $data['id']!='0' && $data['id']!='')
        {     
            $query=array('_id'=>new MongoId($data['id']));
            $id=$data['id'];
            unset($data['id']);
        }
        $getStates=select_mongo('states',$query);
        $fetStates = array();
        $fetStates=add_id($getStates);

        if(count($fetStates))
        {
            foreach ($fetStates as $key => $value) {
                $media = get_media_by_id(array('aiid'=>$value['id'],'id'=>'0'));
                if($media['success']=='true')
                {
                    $fetStates[$key]['image'] = media_url().'images/'.$media['data'][0]['mediaName'];
                }
            }
        }

        return array("success"=>"true","data"=>$fetStates,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}
function manage_states($data)
{
    $query=array();
    if(isset($data['id']) && $data['id']=='0')
    {   
        $check=check_key_available($data,array('countryId','title','id'));
        if($check['success']=='true')
        {
            $count = count_mongo("states",array('countryId'=>$data['countryId']));
            $countercheck = $count +1;
            $countcheckstate = count_mongo("states",array('stateId'=>$countercheck));
            if($countcheckstate)
            {
                $countercheck=$countercheck +1;
            }
            $data['stateId'] = $countercheck;
            unset($data['id']);
            $updateState=insert_mongo('states',$data);
            if($updateState['n']==1)
            {
                return array("success"=>"false","data"=>$data,"error_code"=>"101");
            }
            else
            {
                $loc_id =db_id($data);
                return array("success"=>"true","data"=>$loc_id,"error_code"=>"100");
            }   
        }
        else
        {
            return $check;
        }
    } 
    if(isset($data['id']) && $data['id']!='0')
    {     
        $query=array('_id'=>new MongoId($data['id']));
         $id=$data['id'];
        unset($data['id']);
    }
    if(isset($data['countryId']))
    { $query['countryId']=$data['countryId']; unset($data['countryId']); }
    if(isset($data['stateId']))
    { $query['stateId']=$data['stateId']; if($query['stateId']=='0'){ unset($query['stateId']); } unset($data['stateId']); }

    $updateState=update_mongo('states',$data,$query);
    if($updateState['n']>0){
        return array("success"=>"true","data"=>$id,"error_code"=>"100");
    }else{
        return array("success"=>"false","data"=>array(),"error_code"=>"101");
    }
}
function get_cities($data)
{       logger("11",$data,"",5,"/get_cities");
        $query=array();
        if($data['stateId'])
        {   
            $query=array('stateId'=>$data['stateId']);
        }
		if($data['id'])
        {   
            $query=array('_id'=>new MongoId($data['id']));
        }
        if(isset($data['cityId'])){ $query['cityId']=$data['cityId']; }
        $getCities=select_mongo('cities',$query);
        $fetCities=add_id($getCities);

        return array("success"=>"true","data"=>$fetCities,"error_code"=>"100");
}
function delete_country_state_cities_by_tablename($data)
{
    $check=check_key_available($data,array("id","tablename"));
    if($check['success']=="true")
    {
        if($data['id']!="" && $data['tablename']!="")
        {
            $rec_id=explode("|",$data['id']);
            $idsToDelete = array();
            foreach($rec_id as $res )
            {
                $idsToDelete[] = new MongoId($res);
            }

            $delete=delete_mongo($data['tablename'],array("_id"=>array('$in'=>$idsToDelete)));
            if($delete['n']=='1')
            { 
                return array('data'=>$data['id'],'error_code'=>'100','success'=>'true');  
            }
            else
            {
                return array('data'=>$data,'error_code'=>'100','success'=>'false');  
            }
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"101");
        }

    }
    else
    {
        return $check;
    }
}
function manage_city($data)
{
      
        $check=check_key_available($data,array('stateId','title','id'));
        if($check['success']=='true')
        {
            if(isset($data['id']) && $data['id']!='0')
            {     
                $query=array('_id'=>new MongoId($data['id']));
                unset($data['id']);
                $updateState=update_mongo('cities',$data,$query);
                if($updateState['n']>0)
                {
                    return array("success"=>"true","data"=>$data,"error_code"=>"100");
                }
                else
                {
                    return array("success"=>"false","data"=>$data,"error_code"=>"101");
                }
            }
            else
            {
                $count = count_mongo("cities",array('stateId'=>$data['stateId']));
                $data['cityId'] = $count +1;
                unset($data['id']);
                $updateState=insert_mongo('cities',$data);
                if($updateState['n']==1)
                {
                    return array("success"=>"false","data"=>$data,"error_code"=>"101");
                }
                else
                {
                    $data['insertedId'] =db_id($data);
                    return array("success"=>"true","data"=>$data,"error_code"=>"100");
                }
            }   
        }
        else
        {
            return $check;
        }
    
}
?>
