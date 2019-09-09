<?php
include("../global.php");
$getSubscribedEmails = get_email_by_id(array("id"=>"0","status"=>"1"));
//print_r($getSubscribedEmails['data']);

$getTriggers = get_trigger_by_id(array("id"=>"0","mid"=>"23"));
foreach($getTriggers['data'] as $key => $value) 
{
	$fromdate = date("Y-m-d"). " 00:00";
    $todate = date("Y-m-d"). " 23:59";
    $start = new MongoDate(strtotime($fromdate));
    $end = new MongoDate(strtotime($todate));
            
	$count = count_mongo('triggeredEmail',array('timestamp'=>array('$gte'=>$start,'$lt'=>$end),"type"=>$value['mailType']));
	$auto_mail=new auto_mail1(3);

	if($value['mailType'] == "day" && $count == 0)
	{
		$mailtime = date("Y-m-d")." $value[mailInterval]";
		//echo "time is:".strtotime($mailtime);
		//echo "<br>current time=".time();
		$currenttime = time();

		if($currenttime > $mailtime)
		{
			Switch($value['type'])
			{
				case "email":
					$subject = $value['subject'];
                    $account = get_account_by_id(array("id"=>$value['accId']));
                    $account = $account['data'];
                    $replace_template = get_template_by_id(array("id"=>$value['tempId']));
					$replace_template = $replace_template['data'][0]['tempDesc'];
					foreach ($getSubscribedEmails['data'] as $emaildata) 
					{
						//$ismail=$auto_mail->send_email($emaildata['email'],$replace_template,$subject,$account[0]);
					}
					insert_mongo('triggeredEmail',array("timestamp"=>new MongoDate(),"type"=>$value['mailType']));
				break;
				case "sms":
					//send_sms($contacts,$data['txt']);
				break;
				case "push":
					//send_push($gcmno,$data['txt']);
				break;
			}
		}
	}

 	if($value['mailType'] == 'weekly' && $count == 0)
	{

		$weekday = $value['mailInterval'];
		if(date("N") == $weekday)
		{
			Switch($value['type'])
			{
				case "email":
					
					$subject = $value['subject'];
                    $account = get_account_by_id(array("id"=>$value['accId']));
                    $account = $account['data'];
                   
                    $replace_template = get_template_by_id(array("id"=>$value['tempId']));
					$replace_template = $replace_template['data'][0]['tempDesc'];
				
					
					foreach ($getSubscribedEmails['data'] as $emaildata) 
					{
						echo "mailed to".$emaildata['email'];
						//$ismail=$auto_mail->send_email($emaildata['email'],$replace_template,$subject,$account[0]);
						
					}
					insert_mongo('triggeredEmail',array("timestamp"=>new MongoDate(),"type"=>$value['mailType']));
				break;
				case "sms":
					//send_sms($contacts,$data['txt']);
				break;
				case "push":
					//send_push($gcmno,$data['txt']);
				break;
			}
		}
	}
	
	if($value['mailType'] == 'month' && $count == 0)
	{
		$monthdate = $value['mailInterval'];
		if(date("d") == $date)
		{
			Switch($value['type'])
			{
				case "email":
					$subject = $value['subject'];
                    $account = get_account_by_id(array("id"=>$value['accId']));
                    $account = $account['data'];
                    $replace_template = get_template_by_id(array("id"=>$value['tempId']));
					$replace_template = $replace_template['data'][0]['tempDesc'];
					foreach ($getSubscribedEmails['data'] as $emaildata) 
					{
						//$ismail=$auto_mail->send_email($emaildata['email'],$replace_template,$subject,$account[0]);
					}
					insert_mongo('triggeredEmail',array("timestamp"=>new MongoDate(),"type"=>$value['mailType']));
				break;
				case "sms":
					//send_sms($contacts,$data['txt']);
				break;
				case "push":
					//send_push($gcmno,$data['txt']);
				break;
			}
		}
	}
}
?>