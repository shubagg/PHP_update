<?php
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
$cond=array();
$extra_data=array();
$starttime =   time();
$getRecords = select_mongo("schedule",$cond,array());
$row = add_id($getRecords,"id");
if(!empty($row) && count($row)>0)
{
	foreach ($row as $value) 
	{
		$getRecords=select_mongo('user',array('_id'=>new MongoId($value['machine_id']),'status'=>'1'),array('name','status'));
		$checkdata = add_id($getRecords,"id");

		$robot = explode("-", $value['robot']);
		$getRecords=select_mongo('robotlist',array('_id'=>new MongoId($robot[0])),array('title'));
		$checkdata2 = add_id($getRecords,"id");
		if(!empty($checkdata) && count($checkdata)>0 && !empty($checkdata2) && count($checkdata2)>0)
		{

			$email = "";
			$userInfo = get_resource_by_id(array('id'=>$value['user'],'fields'=>'email,name'));
			if($userInfo['success']=='true')
			{
				$email = $userInfo['data'][0]['email'];
			}
			$crontime = $starttime;
			$cronGTime = $crontime + (5*60);
			if($value['scheduletype']=='1-Hourly')
			{
				$robotlastruntime = $value['lastUpdatedCron']+(intval($value['every'])*60*60);
			}
			else if($value['scheduletype']=='2-Daily')
			{
				
				$robotlastruntime = $value['lastUpdatedCron']+(1*24*60*60);
			}
			else if($value['scheduletype']=='3-Weekly')
			{
				$robotlastruntime = $value['lastUpdatedCron']+(7*24*60*60);
			}
			else if($value['scheduletype']=='4-Monthly')
			{
				$robotlastruntime = $value['lastUpdatedCron']+(30*24*60*60);
			}
			else if($value['scheduletype']=='5-Yearly')
			{
				$robotlastruntime = $value['lastUpdatedCron']+(365*24*60*60);
			}
			else
			{
				$robotlastruntime = time();
			}
			//echo date("Y-m-d h:i",$value['lastUpdatedCron'])." >= ".date("Y-m-d h:i",$crontime)." ++ ".date("Y-m-d h:i",$value['lastUpdatedCron'])." <= ".date("Y-m-d h:i",$cronGTime)."<br>";
			if($value['scheduletype']=='4-Monthly' || $value['scheduletype']=='5-Yearly')
			{
				$d = date("d",strtotime($value['startdate']));
				$cd = date("d");
				$schm = date("m",strtotime($value['startdate']));
				$m = date("m");
				$y = date("Y");
				$month_end = strtotime('last day of this month', time());
				$med=date("d",$month_end);
				if($value['scheduletype']=='4-Monthly')
				{
					
					if($d=='28')
					{
						$sdatech = date("Y")."-".date("m")."-".$d." ".$value['starttime'];
					}
					else
					{
						if($d=='29')
						{
							if($med=='28')
							{
								$sdatech = date("Y")."-".date("m")."-".$med." ".$value['starttime'];
							}
							else
							{
								$sdatech = date("Y")."-".date("m")."-".$d." ".$value['starttime'];
							}
						}
						else if($d=='30')
						{
							if(date("d")=='28')
							{
								$sdatech = date("Y")."-".date("m")."-28 ".$value['starttime'];
							}
							if(date("d")=='29')
							{
								$sdatech = date("Y")."-".date("m")."-29 ".$value['starttime'];
							}
							else
							{
								$sdatech = date("Y")."-".date("m")."-".$d." ".$value['starttime'];
							}
						}
						else if($d=='31')
						{
							
							if($med=='28' || $med=='29' || $med=='30')
							{
								$sdatech = date("Y")."-".date("m")."-".$med." ".$value['starttime'];
							}
							else
							{
								$sdatech = date("Y")."-".date("m")."-".$d." ".$value['starttime'];
							}
						}
						else
						{
							$sdatech = date("Y")."-".date("m")."-".$d." ".$value['starttime'];
						}
					}
				}
				else
				{
					if($d=='29')
					{
						if(date('L')=='0')
						{
							$sdatech = date("Y")."-".$schm."-28 ".$value['starttime'];
						}
						else
						{
							$sdatech = date("Y")."-".$schm."-".$d." ".$value['starttime'];
						}
					}
					else
					{
						$sdatech = date("Y")."-".$schm."-".$d." ".$value['starttime'];
					}
					
				}
				$lastUpdatedCron = strtotime($sdatech);
				if($lastUpdatedCron>=$crontime && $lastUpdatedCron<=$cronGTime)
				{
						$robot = explode("-", $value['robot']);
						$getRecords=select_mongo('robotrunstatus',array('asid'=>$robot[0],'status'=>'0'),array('name','status'));
						$checkdata = add_id($getRecords,"id");
						if(isset($checkdata) && count($checkdata)>0){}
						else
						{
							$data =  array();
							$data['createDate'] = new MongoDate();
					        $data['status'] = "0";
					        $data['asid'] = $robot[0];
					        $data['map_id'] = $robot[1];
					        $data['ip'] = $email;
					        $data['userId'] = $value['id'];
					        $data['run_by'] =$value['run_by'];
					        $data['run_user_id'] = $value['run_user_id'];
					        $data['machine_id'] = $value['machine_id'];
					        $data['title'] = $value['title'];
					        //print_r($data);die;
					        $res = insert_mongo('robotrunstatus',$data);
					        $resp = update_mongo('robotlistAssociate',array("status"=>'0'),array('_id'=>new MongoId($robot[1])));

					        $response = update_mongo('schedule',array("lastUpdatedCron"=>$robotlastruntime),array('_id'=>new MongoId($value['id'])));
						}
						
				       
				}
			}
			else
			{

				if($value['lastUpdatedCron']>=$crontime && $value['lastUpdatedCron']<=$cronGTime)
				{

						$robot = explode("-", $value['robot']);
						$getRecords=select_mongo('robotrunstatus',array('asid'=>$robot[0],'status'=>'0'),array('name','status'));
						$checkdata = add_id($getRecords,"id");
						if(isset($checkdata) && count($checkdata)>0){}
						else
						{
							$data =  array();
							$data['createDate'] = new MongoDate();
					        $data['status'] = "0";
					        $data['asid'] = $robot[0];
					        $data['map_id'] = $robot[1];
					        $data['ip'] = $email;
					        $data['userId'] = $value['id'];
					        $data['run_by'] =$value['run_by'];
					        $data['run_user_id'] = $value['run_user_id'];
					        $data['machine_id'] = $value['machine_id'];
					        $data['title'] = $value['title'];
					        //print_r($data);die;
					        $res = insert_mongo('robotrunstatus',$data);
					        $resp = update_mongo('robotlistAssociate',array("status"=>'0'),array('_id'=>new MongoId($robot[1])));

					        $response = update_mongo('schedule',array("lastUpdatedCron"=>$robotlastruntime),array('_id'=>new MongoId($value['id'])));

						}
						if($value['scheduletype']=='6-One Time')
				        {
				        	delete_mongo('schedule',array('_id'=>new MongoId($value['id'])));
				        }
				       
				}
				else
				{
					if($value['lastUpdatedCron']<time())
					{
						if($value['scheduletype']=='1-Hourly')
						{
							$endtime =strtotime(date("Y-m-d")." 23:59:59");
							$houres=get_schdeule_data_hourly_cron($value['lastUpdatedCron'], $endtime, $value['every'], date('Y-m-d'));
							if(!empty($houres[date("Y-m-d")]))
							{
								$lastcrontime = strtotime(date("Y-m-d")." ".$houres[date("Y-m-d")][0]);
								$response = update_mongo('schedule',array("lastUpdatedCron"=>$lastcrontime),array('_id'=>new MongoId($value['id'])));

							}
						}
						else
						{
							$schedultdate = $value['startdate'];
							if($value['scheduletype']=='2-Daily')
							{
								$robotlastruntime = strtotime(date("Y-m-d")." ".$value['starttime']);
								$response = update_mongo('schedule',array("lastUpdatedCron"=>$robotlastruntime),array('_id'=>new MongoId($value['id'])));
							}
							else if($value['scheduletype']=='3-Weekly')
							{
								$endtime= time() + (168*60*60);
								$houres=get_scheduler_date_cron($value['lastUpdatedCron'], $endtime, 168, date('Y-m-d'),$value['scheduletype'],$schedultdate);
								if(array_key_exists(date("Y-m-d"), $houres))
								{
									$robotlastruntime = strtotime($houres[date("Y-m-d")][0]);
									$response = update_mongo('schedule',array("lastUpdatedCron"=>$robotlastruntime),array('_id'=>new MongoId($value['id'])));
								}
							}
						}
						
					}
				}
			}
		}
		else
		{
			if(empty($checkdata2))
			{
				$response = delete_mongo('schedule',array('_id'=>new MongoId($value['id'])));
			}
		}
	}
	//foreach complete
}// if complete


if(isset($response)) 
{
	if($response['n']=='1')
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
}
else
{
	echo "2";
}

function get_schdeule_data_hourly_cron($startdate, $enddate, $hour, $date) {
    $sdate = $startdate;
    $edate = $enddate;
    $dataArray = array();
    while ($sdate <= $edate) {
        $ndate = date("Y-m-d", $sdate);
        if ($date == $ndate) {
        	if($sdate>time()){
        		$dataArray[date("Y-m-d", $sdate)][] = date("h:i A", $sdate);	
        	}
            
        }

        $sdate = $sdate + (intval($hour)*60*60);
    }
    return $dataArray;
}

function get_scheduler_date_cron($startdate, $enddate, $hour, $date, $type, $schedultdate) {
    
    $sdate = $startdate;
    $edate = $enddate;
    $dataArray = array();
    if($type=='3-Weekly')
    {
    	while ($sdate <= $edate) {
	        $dataArray[date("Y-m-d", $sdate)][] = date("Y-m-d h:i A", $sdate);

	        $sdate = $sdate + (intval($hour)*60*60);
    	}
    }
    return $dataArray;
}




?>
