<?php
function get_vehicle_status($data)
{   logger("20",$data,"",5,"/get_vehicle_status");
    $vehicle_list = get_user_device(array("userId"=>$data['userId']));
    //$vehicle_list = array('565045709c76841c0d0f4240','5650459b9c7684f40d1e8480','565045b39c7684bc050f6950','565045b39c7684bc050f6951');
    //print_r($vehicle_list);die;
    $lenght_vehicle = sizeof($vehicle_list['data']);
    $running = $idle = $stop = $inactive = 0;
    $dt = date('Y-m-d', strtotime("+0 days")). " 00:00";
    $dt1 = date('Y-m-d', strtotime("+0 days")). " 24:00";
    $start = new MongoDate(strtotime($dt));
    $end = new MongoDate(strtotime($dt1));
    
    for($i=0;$i<$lenght_vehicle;$i++)
    {
        
        $cond = array('vehicleId'=>$vehicle_list['data'][$i]['vehicleId'],'timestamp'=>array('$gte'=>$start,'$lt'=>$end));
        $params = array('ignition','timestamp','speed');
        $sortcond = array('timestamp'=>-1);
        $res = select_sort_limit_mongo('vehicleData',$cond,$params,$sortcond,0,1);
        $res = add_id($res,'id');
        //print_r($res);
        
        if(count($res)>0)
        {
            if($res[0]['speed']>0 && $res[0]['ignition']==1)
            {
                $running++;
            }
            else if($res[0]['speed']==0 && $res[0]['ignition']==1)
            {
                $idle++;
            }
            else
            {
                $realtime =  time();
                $current_time = $res[0]['timestamp']->sec;
                if(($realtime - $current_time) >=  3600)
                {
                    $inactive++;
                }
                else
                {
                    $stop++;
                }
            }
        }
        else
        {
            $inactive++;
        }
    }
    $arr[0]=array("status" => "running" , "n_r" => $running);
    $arr[1]=array("status" => "idle" , "n_r" => $idle);
    $arr[2]=array("status" => "stop" , "n_r" => $stop);
    $arr[3]=array("status" => "inactive" , "n_r" => $inactive);
  
    return array("success"=>"true","data"=>$arr,"error_code"=>"100");
}

function get_vehicle_data($data)
{   logger("20",$data,"",5,"/get_vehicle_data");
    $vehicle_list = get_user_device(array("userId"=>$data['userId']));
    $vehicle_list = $vehicle_list['data'];
    //$vehicle_list = array("vehicleid"=>array('565045709c76841c0d0f4240','5650459b9c7684f40d1e8480','565045b39c7684bc050f6950','565045b39c7684bc050f6951'));//here you need all details of vehicle
    
    /*$vehicle_list = array(
                            array("vehicleId"=>"565045709c76841c0d0f4240","company"=>"abc","poi"=>"abc","title"=>"vehicle1"),
                            array("vehicleId"=>"5650459b9c7684f40d1e8480","company"=>"abc","poi"=>"abc","title"=>"vehicle2"),
                            array("vehicleId"=>"565045b39c7684bc050f6950","company"=>"abc","poi"=>"abc","title"=>"vehicle3"),
                            array("vehicleId"=>"565045b39c7684bc050f6951","company"=>"abc","poi"=>"abc","title"=>"vehicle4")
                        );*/
    
    
    $dt = date('Y-m-d', strtotime("+0 days")). " 00:00";
    $dt1 = date('Y-m-d', strtotime("+0 days")). " 24:00";
    $start = new MongoDate(strtotime($dt));
    $end = new MongoDate(strtotime($dt1));
    $final_array =  array();
    
    foreach($vehicle_list as $vehicle)
    {
        $cond = array('timestamp'=>array('$gt'=>$start,'$lt'=>$end),'vehicleId'=>$vehicle['vehicleId']);
        $params = array();
        $sortcond = array('timestamp'=>+1);
        $res = select_sort_mongo('vehicleData',$cond,$params,$sortcond);
        $res = add_id($res,'id');
  
        //echo "records are=".count($res);
        
        if(count($res)>0)
        {
            $get_vehicle_details = get_vehicle_details($res);
            $get_vehicle_details['vehicleId'] = $vehicle['vehicleId'];
            $get_vehicle_details['poi'] = $vehicle['poi'];
            $get_vehicle_details['title'] = $vehicle['title'];
            
            array_push($final_array,$get_vehicle_details);
        }
        else
        {
		date_default_timezone_set("Asia/Kolkata");
		$seconds = time() - strtotime("today");
		$cond = array('vehicleId'=>$vehicle_list['data'][$i]['vehicleId']);
	    $params = array();
	    $sortcond = array('timestamp'=>-1);
	    $res = select_sort_limit_mongo('vehicleData',$cond,$params,$sortcond,0,1);
	    $res = add_id($res,'id');
	    $datetime = date("Y-m-d H:i",$res[0]['timestamp']->sec);
	    $address = get_memcache_address("".$vehicle['lat'],"".$vehicle['lng']);
	    $location = ($address==false)? '' : $address;

            $get_vehicle_details = array(
                    "status"=>'inactive',
                    "distance"=>'0',
                    "running"=>'0',
                    "idle"=>'0',
                    "stop"=>'0',
                    "speed"=>'0',
                    "odometer"=>'0',
		    "inactive"=>$seconds,
                    "ac"=>$res[0]['ac'],
                    "gps"=>$res[0]['ant'],
                    "fuel"=>$res[0]['fuel'],
                    "alert"=>$res[0]['panic'],
                    "ign"=>$res[0]['ignition'],
                    "ss"=>$res[0]['ss'],
                    "bv"=>$res[0]['bv'],
                    "lat"=>$res[0]['lat'],
                    "lng"=>$res[0]['lng'],
                    "id"=>$res[0]['id'],
		    "datetime" => $datetime,
		    "location"=>$location
                    );
            $get_vehicle_details['company'] = $vehicle['company'];
            $get_vehicle_details['vehicleId'] = $vehicle['vehicleId'];
            $get_vehicle_details['poi'] = $vehicle['poi'];
            $get_vehicle_details['title'] = $vehicle['title'];
            $get_vehicle_details['millisecond'] = $res[0]['timestamp']->sec;
            
            array_push($final_array,$get_vehicle_details);
        }
    }
    return array("success"=>"true","data"=>$final_array,"error_code"=>"100");
}

function get_vehicle_details($data)
{   logger("20",$data,"",5,"/get_vehicle_details");
    $speed = $distance = $running = $idle = $stop = 0;
    $c = 0;
    $status = '';
    $len = sizeof($data);
    $array = array();
    $last_status = $current_status = '';
    $last_time = '';
    
    foreach($data as $vehicle)
    {
        $current_time = $vehicle['timestamp']->sec;
     
        Switch($last_status)
        {
            case 'running':
                $running = $running + ($current_time - $last_time);
            break;
            case 'idle':
                $idle = $idle + ($current_time - $last_time);
            break;
            case 'stop':
                $stop = $stop + ($current_time - $last_time);
            break;            
        }
        
        //echo "last status = $last_status , ";
        
        if($vehicle['speed']>0 && $vehicle['ignition']==1)
        {
            $last_status = 'running';
        }
        else if($vehicle['speed']==0 && $vehicle['ignition']==1)
        {
            $last_status = 'idle';
        }
        else
        {
            $last_status = 'stop';
        }
        
        //echo "current status = $last_status , current time = ".$current_time." - last time = ".$last_time." = ".($current_time - $last_time);
        
        $last_time = $current_time;
        //echo "\n";
        $distance = $distance + $vehicle['dist'];
        $c++;
        if($c==$len)
        {
            //print_r($vehicle);
            if($vehicle['speed']>0 && $vehicle['ignition']==1)
            {
                $status = 'running';
            }
            else if($vehicle['speed']==0 && $vehicle['ignition']==1)
            {
                $status = 'idle';
            }
            else
            {
                $realtime =  time();
                if(($realtime - $current_time) >=  3600)
                {
                    $status = 'inactive';
                }
                else
                {
                    $status = 'stop';
                }
            }
            $address = get_memcache_address("".$vehicle['lat'],"".$vehicle['lng']);
	    $location = ($address==false)? '' : $address;
		date_default_timezone_set("Asia/Kolkata");
            $speed = $vehicle['speed'];
            $odometer = 'no data';
            $ac = $vehicle['ac'];
            $gps = $vehicle['ant'];
            $fuel = $vehicle['fuel'];
            $alert = $vehicle['panic'];
            $ign = $vehicle['ignition'];
            $power = $vehicle['ss'];
            $datetime = date("Y-m-d H:i",$current_time);
            $bv = $vehicle['bv'];
	    $lat = $vehicle['lat'];
	    $lng = $vehicle['lng'];
	    $id = $vehicle['id'];
        }
    }
    $seconds = time() - strtotime("today");
    $ctime = $seconds - ($running+$idle+$stop);
    $array = array(
                    "status"=>$status,
                    "distance"=>$distance,
                    "running"=>$running,
                    "idle"=>$idle,
                    "stop"=>$stop,
		    "inactive"=>$ctime,
                    "speed"=>$speed,
                    "odometer"=>$odometer,
                    "location"=>$location,
                    "ac"=>$ac,
                    "gps"=>$gps,
                    "fuel"=>$fuel,
                    "alert"=>$alert,
                    "ign"=>$ign,
                    "ss"=>$power,
                    "bv"=>$bv,
		    "lat"=>"".$lat,
		    "lng"=>"".$lng,
		    "id"=>$id,
                    "datetime" => $datetime
                    );
    
    return $array;
}

function get_vhTracking_data($data)
{   logger("20",$data,"",5,"/get_vhTracking_data");
    $vehicle_list = get_user_device(array("userId"=>$data['userId']));
    $vehicle_list = $vehicle_list['data'];    
    
    $dt = date('Y-m-d', strtotime("+0 days")). " 00:00";
    $dt1 = date('Y-m-d', strtotime("+0 days")). " 24:00";
    $start = new MongoDate(strtotime($dt));
    $end = new MongoDate(strtotime($dt1));
    $final_array =  array();
    
    foreach($vehicle_list as $vehicle)
    {
        $cond = array('timestamp'=>array('$gt'=>$start,'$lt'=>$end),'vehicleId'=>$vehicle['vehicleId']);
        $params = array();
        $sortcond = array('timestamp'=>+1);
        $res = select_sort_mongo('vehicleData',$cond,$params,$sortcond);
        $res = add_id($res,'id');
  
        //echo "records are=".count($res);
        
        if(count($res)>0)
        {
            $get_vhTracking_details = get_vhTracking_details($res);
            $get_vhTracking_details['driverName'] = $vehicle['driverName'];
            $get_vhTracking_details['vehicleId'] = $vehicle['vehicleId'];
            $get_vhTracking_details['poi'] = $vehicle['poi'];
            $get_vhTracking_details['title'] = $vehicle['title'];
	    $get_vhTracking_details['vehicleType'] = $vehicle['vehicleType'];
        }
        else
        {
            $cond = array('vehicleId'=>$vehicle['vehicleId']);
            $params = array();
            $sortcond = array('timestamp'=>+1);
            $res = select_sort_limit_mongo('vehicleData',$cond,$params,$sortcond,0,1);
            $res = add_id($res,'id');
            if(count($res)>0)
            {
                $get_vhTracking_details = get_vhTracking_details($res);
                $get_vhTracking_details['driverName'] = $vehicle['driverName'];
                $get_vhTracking_details['vehicleId'] = $vehicle['vehicleId'];
                $get_vhTracking_details['poi'] = $vehicle['poi'];
                $get_vhTracking_details['title'] = $vehicle['title'];
                $get_vhTracking_details['status'] = 'inactive';
		$get_vhTracking_details['vehicleType'] = $vehicle['vehicleType'];
                $get_vhTracking_details['ign'] = '0';
                $get_vhTracking_details['ac'] = '0';
                $get_vhTracking_details['gps'] = '0'; 
            }
            else
            {
                $get_vhTracking_details = array(
                    "status"=>'inactive',
                    "distance"=>'0',
                    "cdistance"=>'0',
                    "ldistance"=>'0',
                    "running"=>'00:00:00',
                    "lastStop" =>'00:00:00', 
                    "crunning" =>'00:00:00',
                    "lrunning" =>'00:00:00',
                    "idle"=>'00:00:00',
                    "stop"=>'00:00:00',
                    "speed"=>'0',
                    "mspeed"=>'0',  
                    "aspeed"=>'0',
                    "lat"=>'0.0',
                    "lng"=>'0.0',
                    "location"=>'NA',
                    "ac"=>'0',
                    "gps"=>'0',
                    "fuel"=>'0',
                    "alert"=>'0',
                    "ign"=>'0',
                    "ss"=>'0',
                    "angle"=>'0',
                    "panic_lat" =>'0.0',
                    "panic_lng" => '0.0',
                    "datetime" => 'NA',
                    "lastStopTime" => 'NA'
                    );

                $get_vhTracking_details['driverName'] = '';
                $get_vhTracking_details['vehicleId'] = $vehicle['vehicleId'];
                $get_vhTracking_details['poi'] = '';
                $get_vhTracking_details['title'] = $vehicle['title'];
                $get_vhTracking_details['status'] = 'inactive';
		$get_vhTracking_details['vehicleType'] = $vehicle['vehicleType'];
                $get_vhTracking_details['ign'] = '0';
                $get_vhTracking_details['ac'] = '0';
                $get_vhTracking_details['gps'] = '0';
            }
        }
         array_push($final_array,$get_vhTracking_details);
    }
    return array("success"=>"true","data"=>$final_array,"error_code"=>"100");
}

function get_vhTracking_details($data)
{   logger("20",$data,"",5,"/get_vhTracking_details");
    $speed = $distance = $running = $idle = $stop = $mspeed = $cdistance = 0;
    $c = 0;
    $status = '';
    $len = sizeof($data);
    $array = array();
    $msarr = array();
    $last_status = $current_status = '';
    $last_time = '';
    $panic_lat = $panic_lng = '';
    $lastStop = $lflag = $laststoptime = 0;
    $lastRun = $rflag = 0;
    $datetime = '';

    foreach($data as $vehicle)
    {
        $current_time = $vehicle['timestamp']->sec;
     
        Switch($last_status)
        {
            case 'running':
                $lflag = 1;
                $lastRun = $lastRun + ($current_time - $last_time);
                $cdistance = $cdistance + $vehicle['dist'];
                $running = $running + ($current_time - $last_time);
            break;
            case 'idle':
                $lflag = 1;
                $lastRun = $cdistance = 0;
                $idle = $idle + ($current_time - $last_time);
            break;
            case 'stop':
                $lastRun = $cdistance = 0;
                if($lflag == 1)
                {
                    $lastStop = $lflag = 0;
                }
                $lastStop = $lastStop + ($current_time - $last_time);
                $stop = $stop + ($current_time - $last_time);
                $laststoptime = $current_time;
            break;            
        }
        
        //echo "last status = $last_status , ";
        
        if($vehicle['speed']>0 && $vehicle['ignition']==1)
        {
            $last_status = 'running';
        }
        else if($vehicle['speed']==0 && $vehicle['ignition']==1)
        {
            $last_status = 'idle';
        }
        else
        {
            $last_status = 'stop';
        }
        date_default_timezone_set("Asia/Kolkata");
        $last_time = $current_time;
        $distance = $distance + $vehicle['dist'];
        $aspeed = $aspeed + $vehicle['speed'];
        if($vehicle['panic'] == 1)
        {
            $panic_lat = $vehicle['lat'];
            $panic_lng = $vehicle['lng'];
        }
        array_push($msarr,$vehicle['speed']);

        $c++;
        if($c==$len)
        {
            if($vehicle['speed']>0 && $vehicle['ignition']==1)
            {
                $status = 'running';
            }
            else if($vehicle['speed']==0 && $vehicle['ignition']==1)
            {
                $status = 'idle';
            }
            else
            {
                $status = 'stop';
            }
		$address = get_memcache_address("".$vehicle['lat'],"".$vehicle['lng']);
	    $location = ($address==false)? '' : $address;

            $aspeed = intval($aspeed/$len);
            $angle = $vehicle['angle'];
            $speed = $vehicle['speed'];
            $lat = $vehicle['lat'];
            $lng = $vehicle['lng'];
            $id = $vehicle['id'];
         
            $ac = $vehicle['ac'];//need to confirm key and data
            $gps = $vehicle['ant'];//need to confirm key and data
            $fuel = $vehicle['fuel'];//need to confirm key and data
            $alert = $vehicle['panic'];//need to confirm key and data
            $ign = $vehicle['ignition'];//need to confirm key and data
            $ss = $vehicle['ss'];//need to confirm key and data
            $datetime = $last_time;
            $laststoptime = ($laststoptime == "0")? date("Y-m-d H:i",$datetime) : $laststoptime ;
        }
    }
    
    $array = array(
                    "status"=>$status,
                    "distance"=>$distance,
                    "cdistance"=>$cdistance,
                    "ldistance"=>($distance - $cdistance),
                    "running"=>$running,
                    "lastStop" =>$lastStop, 
                    "crunning" =>$lastRun,
                    "lrunning" =>($running - $lastRun),
                    "idle"=>$idle,
                    "stop"=>$stop,
                    "speed"=>$speed,
                    "mspeed"=>max($msarr),
                    "aspeed"=>$aspeed,
                    "lat"=>"".$lat,
                    "lng"=>"".$lng,
                    "location"=>$location,
                    "ac"=>$ac,
                    "gps"=>$gps,
                    "fuel"=>$fuel,
                    "alert"=>$alert,
                    "ign"=>$ign,
                    "ss"=>$ss,
                    "angle"=>$angle,
                    "panic_lat" =>$panic_lat,
                    "panic_lng" => $panic_lng,
                    "datetime" => date("Y-m-d H:i",$datetime),
                    "lastStopTime"=>date("Y-m-d H:i",$laststoptime),
		    "id" => $id
                    );
    
    return $array;
}


function get_vhPath_data($data)
{   logger("20",$data,"",5,"/get_vhPath_data");
    $vehicle_list = get_user_device(array("userId"=>$data['userId']));
    $vehicle_list = $vehicle_list['data'];
    
    /*$vehicle_list = array(
                            array("vehicleId"=>"5650459b9c7684f40d1e8480","driverName"=>"abc2","poi"=>"abc2","title"=>"vehicle2"),
                            array("vehicleId"=>"565045709c76841c0d0f4240","driverName"=>"abc1","poi"=>"abc1","title"=>"vehicle1"),
                            array("vehicleId"=>"565045b39c7684bc050f6950","driverName"=>"abc3","poi"=>"abc3","title"=>"vehicle3"),
                            array("vehicleId"=>"565045b39c7684bc050f6951","driverName"=>"abc4","poi"=>"abc4","title"=>"vehicle4")
                        );*/
    $dt = date('Y-m-d', strtotime("+0 days")). " 00:00";
    $dt1 = date('Y-m-d', strtotime("+0 days")). " 24:00";
    $start = new MongoDate(strtotime($dt));
    $end = new MongoDate(strtotime($dt1));
    $final_array =  array();
    
date_default_timezone_set("Asia/Kolkata");
    foreach($vehicle_list as $vehicle)
    {
	
        $dist = 0;
        $lat_lng_arr = array();
        $cond = array('timestamp'=>array('$gt'=>$start,'$lt'=>$end),'vehicleId'=>$vehicle['vehicleId']);
        $params = array('lat','lng','timestamp','speed','ignition','dist','angle','address');
        $sortcond = array('timestamp'=>+1);
        $res = select_sort_mongo('vehicleData',$cond,$params,$sortcond);
        $res = add_id($res,'id'); 
        foreach ($res as $key => $value) {
            $status= 'running';
            $datetime = date("Y-m-d H:i",$value['timestamp']->sec);
            $address = get_memcache_address("".$rec['lat'],"".$rec['lng']);
	    $address = ($address==false)? '' : $address;
            $dist+=$value['dist'];
            if($value['speed']==0 && $value['ignition']==0)
            {
		$lat_lng_arr = array();
                $status= 'stoppage';    
            }
            if($value['speed']==0 && $value['ignition']==1)
            {
                $status= 'idle';      
            }
           array_push($lat_lng_arr,array("".$value['lat'],"".$value['lng'],$vehicle['title'],$value['speed'],$datetime,$status,$address,$dist,$value['angle']));
        }
        array_push($final_array,array("vehicleId"=>$vehicle['vehicleId'],"pathdata"=>$lat_lng_arr));
    }
     
    return array("success"=>"true","data"=>$final_array,"error_code"=>"100");
}

function get_vehiclePath_data($data)
{
    logger("20",$data,"",5,"/get_vehiclePath_data");
    $dt = date('Y-m-d', strtotime("+0 days")). " 00:00";
    $dt1 = date('Y-m-d', strtotime("+0 days")). " 24:00";
    $start = new MongoDate(strtotime($dt));
    $end = new MongoDate(strtotime($dt1));
    $final_array =  array();
    
    $dist = 0;
    $lat_lng_arr = array();
    $cond = array('timestamp'=>array('$gt'=>$start,'$lt'=>$end),'vehicleId'=>$data['vehicleId']);
    $params = array('lat','lng','timestamp','speed','ignition','dist','angle','address');
    $sortcond = array('timestamp'=>+1);
    $res = select_sort_mongo('vehicleData',$cond,$params,$sortcond);
    $res = add_id($res,'id'); 

date_default_timezone_set("Asia/Kolkata");
    foreach ($res as $key => $value) 
    {
        $status= 'running';
        $datetime = date("Y-m-d H:i",$value['timestamp']->sec);
        $address =(!isset($value['address']))? 'Testing Address' : $value['address'];
        $dist+=$value['dist'];
        if($value['speed']==0 && $value['ignition']==0)
        {
            $lat_lng_arr = array();
            $status= 'stoppage';    
        }
        if($value['speed']==0 && $value['ignition']==1)
        {
            $status= 'idle';      
        }
       array_push($lat_lng_arr,array($value['lat'],$value['lng'],"testing",$value['speed'],$datetime,$status,$address,$dist,$value['angle']));
    }
    array_push($final_array,array("vehicleId"=>$data['vehicleId'],"pathdata"=>$lat_lng_arr));
    
    return array("success"=>"true","data"=>$final_array,"error_code"=>"100");
}

function convertSecToTime($seconds)
{   logger("20",$seconds,"",5,"/convertSecToTime");
    $hours = floor($seconds / 3600);
    $mins = floor(($seconds - ($hours*3600)) / 60);
    $secs = floor($seconds % 60);
    $hours = ($hours<10)? "0".$hours : $hours;
    $mins = ($mins<10)? "0".$mins : $mins;
    $secs = ($secs<10)? "0".$secs : $secs;
    return $hours.":".$mins.":".$secs;
}

function get_dashboard_pdf_data($data)
{
    logger("20",$data,"",5,"/get_dashboard_pdf_data");
    $vehicle_list = get_user_device(array("userId"=>$data['userId']));
    $vehicle_list = $vehicle_list['data'];

    $userInfo = get_resource_by_id(array("id"=>$data['userId']));
    $userInfo = $userInfo['data'];
    $status = '';
    Switch($data['status'])
    {
        case 1:
            $status = 'running';
        break;
        case 2:
            $status = 'idle';
        break;
        case 3:
            $status = 'stop';
        break;
    }

    $dt = date('Y-m-d', strtotime("+0 days")). " 00:00";
    $dt1 = date('Y-m-d', strtotime("+0 days")). " 24:00";
    $start = new MongoDate(strtotime($dt));
    $end = new MongoDate(strtotime($dt1));
    $final_array =  array();
    $head = array();
    //  print_r(array("userId"=>$data['userId'],"pagename"=>"dashboard"));
    $columns = get_page_setting(array("userId"=>$data['userId'],"pagename"=>"dashboard"));
    
    foreach ($columns['data'][0] as $key => $value)     
    {
        if($value[$key]==1){ array_push($head,$key); }
    }
    //print_r($columns);
    foreach($vehicle_list as $vehicle)
    {
        $cond = array('timestamp'=>array('$gt'=>$start,'$lt'=>$end),'vehicleId'=>$vehicle['vehicleId']);
        $params = array();
        $sortcond = array('timestamp'=>+1);
        $res = select_sort_mongo('vehicleData',$cond,$params,$sortcond);
        $res = add_id($res,'id');
  
        //echo "records are=".count($res);
        
        if(count($res)>0) 
        {

            $get_vehicle_details = get_vehicle_details($res);
            $get_vehicle_details['company'] = $vehicle['company'];
            $get_vehicle_details['vehicleId'] = $vehicle['vehicleId'];
            $get_vehicle_details['poi'] = $vehicle['poi'];
            $get_vehicle_details['title'] = $vehicle['title'];
           
            if($get_vehicle_details['status'] == $status || $data['status'] == 0 )
            {
                array_push($final_array,$get_vehicle_details);
            }
        }
        else
        {
            if($data['status']==4 || $data['status']==0)
            {
		date_default_timezone_set("Asia/Kolkata");
		$seconds = time() - strtotime("today");
                $cond = array('vehicleId'=>$vehicle['vehicleId']);
		    $params = array();
		    $sortcond = array('timestamp'=>-1);
		    $res = select_sort_limit_mongo('vehicleData',$cond,$params,$sortcond,0,1);
		    $res = add_id($res,'id');
		    $datetime = date("Y-m-d H:i",$res[0]['timestamp']->sec);
		    $address = get_memcache_address("".$vehicle['lat'],"".$vehicle['lng']);
		    $location = ($address==false)? '' : $address;

            	$get_vehicle_details = array(
                    "status"=>'inactive',
                    "distance"=>'0',
                    "running"=>'0',
                    "idle"=>'0',
                    "stop"=>'0',
                    "speed"=>'0',
                    "odometer"=>'0',
		    "inactive"=>$seconds,
                    "ac"=>$res[0]['ac'],
                    "gps"=>$res[0]['ant'],
                    "fuel"=>$res[0]['fuel'],
                    "alert"=>$res[0]['panic'],
                    "ign"=>$res[0]['ignition'],
                    "ss"=>$res[0]['ss'],
                    "bv"=>$res[0]['bv'],
                    "lat"=>$res[0]['lat'],
                    "lng"=>$res[0]['lng'],
                    "id"=>$res[0]['id'],
		    "datetime" => $datetime,
		    "location"=>$location
                    );
                $get_vehicle_details['company'] = $vehicle['company'];
                $get_vehicle_details['vehicleId'] = $vehicle['vehicleId'];
                $get_vehicle_details['poi'] = $vehicle['poi'];
                $get_vehicle_details['title'] = $vehicle['title'];
                
                
                array_push($final_array,$get_vehicle_details);
            }     
        }
    }

    //print_r($final_array);die;
    $rows = array();
    foreach ($final_array as $value) 
    {
        $arr = array();
        foreach ($head as $key => $val) {
            if(isset($value[$val]) || $val=='vehicle' || $val=='dtime' || $val=='gsm' || $val=='temp' )
            {
                $newval ='';
                switch ($val) {
                    case 'running':
                        $newval = convertSecToTime($value[$val]);
                        break;
                    case 'idle':
                        $newval = convertSecToTime($value[$val]);
                        break;
                    case 'stop':
                        $newval = convertSecToTime($value[$val]);
                        break;
		    case 'inactive':
			$seconds = time() - strtotime("today");
    			$ctime = $seconds - ($value['running']+$value['idle']+$value['stop']);
                        $newval = convertSecToTime($ctime);
                        break;
                    case 'dtime':
                        $newval = date("Y-m-d h:i:s A",$value['datetime']->sec);
                        break;
                    case 'speed':
                        $newval = $value[$val]." km/hr";
                        break;
                    case 'gsm':
                        $newval = $value['gps'];
                        break; 
                    case 'temp':
                        $newval = $value['power'] ."C";
                        break; 
                    case 'distance':
                        $newval = $value[$val]." km";
                        break;
                    case 'vehicle':
                        $newval = $value['title'];
                        break;
                    case 'ac':
                        $newval = ($value[$val]==1)? 'On' : 'Off';
                        break;
                    case 'ign':
                        $newval = ($value[$val]==1)? 'On' : 'Off';
                        break;
                    default:
                        $newval = $value[$val];
                        break;
                }
                array_push($arr,$newval);
            }
            else
            {
                unset($head[$key]);
            }
        }
        array_push($rows, $arr);
    }

    $ar = array_values($head);
    if(in_array('dtime', $ar))
    {
        $index =  array_search('dtime', $ar);
        $ar[$index] = "Date Time";
    }

    $pdf_arr = array("head" => $ar,"rows" =>$rows,"vehicleInfo"=>$vehicle_list,"userInfo"=>$userInfo);
    return array("success"=>"true","data"=>$pdf_arr,"error_code"=>"100");
}


////////////////////////////////    CUSTOM DASHBOARD      //////////////////////////////////////




function create_dashboard($data)
{ 
    logger("1",$data,"",5,"/create_dashboard");
  $check=check_key_available($data,array('dash_name','user_id','dash_type','template_type'));    if($check['success']=='true')
    {
        if($data['id']=='' || $data['id']=='0')
        {
            unset($data['id']);
            $data['_id']=new MongoId();
            $return=insert_dashboard($data);
        }
        else
        {
            $return=update_dashboard($data);
        }
        return $return;
    }
    else
    {
        return $check;
    }
}
function insert_dashboard($data)
{
    $data['_id']=new MongoId();
    $data['creation_date']=new MongoDate();
    $success=insert_mongo('dashboard',$data);

    if($success['n']=='0')
    {
        $id=$data['_id']->{'$id'};
       // prepare_send_notification("1","1","$_SESSION[user_id]",$id,'40');

        return array('data'=>$id,'error_code'=>'1001','success'=>'true');  
    }
    else
    {

        return array('data'=>$data,'error_code'=>'1002','success'=>'false');  
    }
 }
function update_dashboard($data)
{
    $id=$data['id'];
    $update=update_mongo('dashboard',$data,array('_id'=>new MongoId($id)));
    if($update['n']=='1')
    {   
        return array('data'=>$id,'error_code'=>'1026','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1027','success'=>'false');
    }
}


 function create_widget_association($data)
{
    logger("1",$data,"",5,"/create_widget_association");
    $data['_id']=new MongoId();
    $success=insert_mongo('widgetAssociate',$data);
   // print_r($data);die;
    if($success['n']=='0')
    {
        $id=$data['_id']->{'$id'};
        prepare_send_notification("1","1","$_SESSION[user_id]",$id,'41');
        return array('data'=>$id,'error_code'=>'1001','success'=>'true');  
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1002','success'=>'false');  
    }
 }



function create_basic_widget($data)
{
    logger("1",$data,"",5,"/create_basic_widget");
    $data['_id']=new MongoId();
    $success=insert_mongo('basicWidget',$data);
   // print_r($data);die;
    if($success['n']=='0')
    {
        $id=$data['_id']->{'$id'};
        prepare_send_notification("1","1","$_SESSION[user_id]",$id,'41');
        return array('data'=>$id,'error_code'=>'1001','success'=>'true');  
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1002','success'=>'false');  
    }
 }


function create_widget_detail($data)
{
   logger("1",$data,"",5,"/create_widget_detail");
    $data['_id']=new MongoId();
    $success=insert_mongo('widgetDetail',$data);
   // print_r($data);die;
    if($success['n']=='0')
    {
        $id=$data['_id']->{'$id'};
        prepare_send_notification("1","1","$_SESSION[user_id]",$id,'41');
        return array('data'=>$id,'error_code'=>'1001','success'=>'true');  
    }
    else
    {
        return array('data'=>$data,'error_code'=>'1002','success'=>'false');  
    }
 }

function delete_widget($data)
{
        logger("1",$data,"",5,"/delete_widget");
        $condition=array('_id'=> new MongoId($data['id']));


            $tmp = delete_mongo('widgetDetail',$condition);
          
        if($tmp['n']=='1')
        {
            return array("success"=>"true","data"=>$data,"error_code"=>"22015");
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"22016");
        }     
}

function update_widget_detail($data)
{   logger("1",$data,"",5,"/update_widget_detail");
    $id=$data['id'];
    unset($data['id']);
    $success=update_mongo('widgetDetail',$data,array('_id'=>new MongoId($id)));
    if($success['n']=='1')
    {
       // prepare_send_notification("1","1","$_SESSION[user_id]",$id,'30');
        return array('data'=>$id,'error_code'=>'1003','success'=>'true');  
    }
    else
    {
        return array('data'=>$id,'error_code'=>'1004','success'=>'false');  
    }
}




function get_dashboard($data)
{ 
    logger("1",$data,"",5,"/get_dashboard");
        $dashboards='';
        $dashids=explode("|",$data['_id']);
        
            $condition=array();
            if(isset($data['dash_type']))
            {
            $condition['$or']=array(array('user_id'=>$data['user_id']),array('dash_type'=>$data['dash_type']));
            }
            else if(isset($data['id']))
            {
             $condition=array('_id'=>new MongoId($data['id']));             
            }
            else
            {
              $condition=array('user_id'=>$data['user_id']); 
            }
            
            $tmp= select_mongo('dashboard',$condition,array());

            $data=add_id($tmp,"id");

        if($data)
        {
            return array('data'=>$data,'error_code'=>'1007','success'=>'true');  
        }
        else
        {    
            return array('data'=>$data,'error_code'=>'1008','success'=>'false');
        }      
}

function get_module_count()
{
    //logger("1",$data,"",5,"/get_module_count");
    $condition = array('mid'=>array('$ne'=>0));
    $data = select_groupby_mongo('basicWidget',$condition,array('mid'=>'$mid','smid'=>'$smid'),10000000);
    if(!empty($data['result']))
    {
        $dt = array();
        foreach ($data['result'] as $key => $val) {
            $mid = $val['_id']['mid'];
            $smid = $val['_id']['smid'];
            $count = $val['count'];
            $dt[$mid."-".$smid]=$count;
        }
        return array('data'=>$dt,'error_code'=>'1009','success'=>'true');  
    }
    else
    {    
        return array('data'=>array(),'error_code'=>'1010','success'=>'false');
    }      
}

function get_basic_widget($data)
{
    logger("1",$data,"",5,"/get_basic_widget");
   $check=check_key_available($data,array('mid','smid'));
   if($check['success']=='true')
    {   
        $dashboards='';
      
        
        $condition = array('mid'=>$data['mid'],'smid'=>$data['smid']);

        if(isset($data['widget_id']))
        {
            $condition['_id'] =  new MongoId($data['widget_id']);
        }

            $tmp = select_mongo('basicWidget',$condition,array());
            $data=add_id($tmp,"id");

        if($data)
        {
            return array('data'=>$data,'error_code'=>'1007','success'=>'true');  
        }
        else
        {    
            return array('data'=>$data,'error_code'=>'1008','success'=>'false');
        }      
   }
   else
   {
       return $check;
   }
}

function get_basic_widget_detail($data)
{
   logger("1",$data,"",5,"/get_basic_widget_detail");
   $check=check_key_available($data,array('widget_id'));
   if($check['success']=='true')
    {   
            $dashboards='';
            $condition['_id'] =  new MongoId($data['widget_id']);
            $tmp = select_mongo('basicWidget',$condition,array());
            $data=add_id($tmp,"id");
            if($data)
            {
                return array('data'=>$data,'error_code'=>'1007','success'=>'true');  
            }
            else
            {    
                return array('data'=>$data,'error_code'=>'1008','success'=>'false');
            }      
   }
   else
   {
       return $check;
   }
}


function get_dashboard_widget($data)
{

    logger("1",$data,"",5,"/get_dashboard_widget");
    $check=check_key_available($data,array('category_ids','code'));
    if($check['success']=='true')
    {   
        $categories='';
        $catids=explode("|",$data['category_ids']);
        $code=$data['code'];
        foreach($catids as $catid)
        {
            $catid = new MongoId($catid);
            $tmp = select_mongo('category',array('_id'=>$catid,'code'=>$code),array('title1'));
            $data=add_id($tmp,"id");
        if(isset($data[0]['title1'])){
            $categories.=$data[0]['title1']." | ";}
        }
        $allCategory=substr($categories,0,-3);
        if($allCategory)
        {
            return array('data'=>$allCategory,'error_code'=>'1007','success'=>'true');  
        }
        else
        {    
            return array('data'=>$data,'error_code'=>'1008','success'=>'false');
        }      
    }
    else
    {
        return $check;
    }
}

function get_widget_detail($data)
{
    logger("1",$data,"",5,"/get_widget_detail");

        $condition = array('dash_id'=>$data['dash_id']);
        if(isset($data['widget_id']))
        {
            $condition['_id'] =  new MongoId($data['widget_id']);
        }
   
            $tmp = select_mongo('widgetDetail',$condition,array());
           
            $data = add_id($tmp,"id");

        if($data)
        {
            return array('data'=>$data,'error_code'=>'1007','success'=>'true');  
        }
        else
        {    
            return array('data'=>$data,'error_code'=>'1008','success'=>'false');
        }      
}

function delete_dashboard($data)
{
        logger("1",$data,"",5,"/delete_dashboard");
        $condition=array('_id'=> new MongoId($data['id']));


            $tmp = delete_mongo('dashboard',$condition);
          
        if($tmp['n']=='1')
        {
            return array("success"=>"true","data"=>$data,"error_code"=>"22015");
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"22016");
        }     
}
function get_chart_detail($data)
{
   logger("1",$data,"",5,"/get_chart_detail");
   $check=check_key_available($data,array('widget_id'));
   if($check['success']=='true')
    {   
            $dashboards='';
            $condition['_id'] =  new MongoId($data['widget_id']);
            $tmp = select_mongo('widgetDetail',$condition,array());
            $data=add_id($tmp,"id");
            if($data)
            {
                return array('data'=>$data,'error_code'=>'1007','success'=>'true');  
            }
            else
            {    
                return array('data'=>$data,'error_code'=>'1008','success'=>'false');
            }      
   }
   else
   {
       return $check;
   }
}

function async_update($data)
{
        logger("1",$data,"",5,"/delete_dashboard");
        $check=check_key_available($data,array('table'));
   if($check['success']=='true')
    {   

            $data = update_mongo($data['table'],array("async"=>"true"),array());
            if($data)
            {
                return array('data'=>$data,'error_code'=>'1007','success'=>'true');  
            }
            else
            {    
                return array('data'=>$data,'error_code'=>'1008','success'=>'false');
            }      
   }
   else
   {
       return $check;
   }   
}
?>
