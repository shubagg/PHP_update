<?php
function manage_geofence($data)
{   
    global $db;
	logger(16,'',$data,5);
    $check = check_key_available($data,array('userId','mid',smid,'iid'));
    if($check['success'] == 'true')
    {
    	$checkAvialable=count_mongo("vehicleGeofence",array('userId'=>$data['userId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'iid'=>$data['iid']));
    	if($checkAvialable>0)
    	{
    		$id=$data['userId'];
            unset($data['userId']);
    		$manage=update_mongo('vehicleGeofence',$data,array('userId'=>$id,'mid'=>$data['mid'],'smid'=>$data['smid'],'iid'=>$data['iid']));
    		if($manage['n']=='1')
    		{
    			return array("success"=>"true","data"=>"","error_code"=>"16020");
    		}
    		else
    		{
    			return array("success"=>"false","data"=>"","error_code"=>"16021");
    		}
    	}
    	else
    	{
            
    		$manage=insert_mongo('vehicleGeofence',$data);
    		return array("success"=>"true","data"=>"","error_code"=>"16022");
    	}
    }
    else
    {
    	return $check;
    }
}


function get_geofence($data)
{
    global $db;
	logger(16,'',$data,5);
    $check = check_key_available($data,array('userId','mid',smid,'iid'));
    
    if($check['success'] == 'true')
    {

    	$checkAvialable=count_mongo("vehicleGeofence",array('userId'=>$data['userId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'iid'=>$data['iid']));
    	if($checkAvialable>0)
    	{
    		$getData=select_mongo("vehicleGeofence",array('userId'=>$data['userId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'iid'=>$data['iid']));
            $getData=add_id($getData,'id');
            
            /*$start_date = "";
            $end_date = "";

            if($data['mid']=='31')
            {
               // $get_tracking_Data=select_mongo("vehicleGeofence",array('userId'=>$data['userId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'iid'=>$data['iid']));
            }
            else
            {
                if($data['iid'])
                {
                    $get_tracking_Data=select_mongo("attendance",array('userId'=>$data['userId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'iid'=>$data['iid'],'type'=>'tracking'));    

                }
                else
                {
                    $get_tracking_Data=select_mongo("attendance",array('userId'=>$data['userId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'type'=>'tracking'));    
    
                }
                            }
            $get_tracking_Data = add_id($get_tracking_Data,'id');

    		$getData['tracking_data']  = $get_tracking_Data;*/
    		return array("success"=>"true","data"=>$getData,"error_code"=>"16024");
    	}
    	else
    	{
    		return array("success"=>"false","data"=>"","error_code"=>"16023");
    	}
    }
    else
    {
        return array("success"=>"false","data"=>"","error_code"=>"16023");
    	return $check;
    }
}
function get_all_active_geofence($data)
{
    global $db;
    logger(16,'',$data,5);
    $check = check_key_available($data,array('status'));
    
    if($check['success'] == 'true')
    {

        $checkAvialable=count_mongo("vehicleGeofence",array('status'=>$data['status']));
        if($checkAvialable>0)
        {
            $getData=select_mongo("vehicleGeofence",array('status'=>$data['status']));
            $getData=add_id($getData,'id');
            return array("success"=>"true","data"=>$getData,"error_code"=>"16024");
        }
        else
        {
            return array("success"=>"false","data"=>"","error_code"=>"16023");
        }
    }
    else
    {
        return array("success"=>"false","data"=>"","error_code"=>"16023");

        return $check;
    }
}

function get_poi_air_distance($data)
{
    global $db;
    logger(16,'',$data,5);
    $check = check_key_available($data,array('userId','lat','lng'));
    if($check['success'] == 'true')
    {
        $geoData=get_geofence(array('userId'=>$data['userId']));
        $dataAvailable=json_decode($geoData['data'][0]['poiData'],true);
        $newData=array();
        $old_distance='-1';
        foreach ($dataAvailable as $key => $value) {
            $distance= find_location_lat_long($data,$value,'air');
            $value['distance']=$distance;
            if($data['show']=='nearest')
            {
                $distance_integer=substr($distance,0,-3);
                if($old_distance=='-1')
                {
                    $old_distance=$distance_integer;
                }

                if($old_distance > $distance_integer)
                {
                    $old_distance=$distance_integer;
                }
                if(substr($value['distance'],0,-3)==$old_distance)
                {
                    $newData=array();
                    array_push($newData,$value);
                }
            }
            else
            {
                array_push($newData,$value);
            }
        }
        return array("success"=>"true","data"=>$newData,"error_code"=>"16027");
    }
    else
    {
        return $check;
    }
}

function manage_geofence_report($data)
{
    global $db;
    $addReport=insert_mongo('geofenceData',$data);
}

?>