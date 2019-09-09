<?php

$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
$notiftime=$_POST['starttime']/1000;

$InfoData=get_job_approval_data_for_notification(array('read_status'=>'0'));
//print_r($InfoData);

if(!empty($InfoData['data']))
{
	foreach ($InfoData['data'] as $key => $value) 
	{
		 $newdata=array();
		
		$notiftimeGtime=$notiftime+ ($value['notification_send_after_time']*60);
		if($value['lastremindercount']<$value['no_of_notification'] && $value['lastremindertime']<=$notiftime && $value['lastremindertime']<=$notiftimeGtime)
		{
			    $eid="124";

			    $extra=array('action_comment'=>$value['action_comment'],'action_ts'=>$value['action_ts'],'action_geo'=>$value['action_geo'],'request_by_comment'=>$value['request_by_comment'],'request_by_ts'=>$value['request_by_ts'],'urgency'=>$value['urgency']);

	            $newdata['lastremindertime']=$notiftimeGtime;
	            $newdata['lastremindercount']=$value['lastremindercount']+1;

	            $updatetUserData=update_mysql($newdata,'job_approval','id="'.$value['id'].'"');
	            
				$notification=insert_notification(array('customerId'=>"43",'mid'=>"5",'smid'=>"3",'userId'=>$value['request_to'],'itemId'=>$value['iid']."|".$value['request_by'],'eid'=>$eid,'extra'=>json_encode($extra),'ms'=>$notiftimeGtime*1000));

				//print_r($notification);
		}
	}
}

if(isset($notification)) 
{
	if($notification['success']=='true')
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