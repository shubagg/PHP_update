<?php

$process = array(

	"add"=>array("create"=>
					array('action'=>array(
						"notification"=>array("ticket"=>array(
												array("key"=>"creator","eid"=>"20"))),
						"webservice"=>array("manage_approvalprocess"=>array("action_done"=>"create","action"=>"send_for_approval","condition"=>"general","attributes"=>"status","current_value"=>"1","data_value"=>array("update_by"=>"update_by","iid"=>"id","mid"=>"mid","smid"=>"smid","cid"=>"cid","title"=>"title","form_id"=>"form_id","comment"=>"comment")))
			))),
	"update"=>array(

	"assign"=>array('action'=>array("notification"=>array("approvalprocess"=>array(array("key"=>"intrestedusers","eid"=>"21"))))),
	

	"reassign"=>array('action'=>array("notification"=>array("approvalprocess"=>array(array("key"=>"intrestedusers","eid"=>"21"))))),
	
	
	"status"=>array(
		//"1"=>array('action'=>array("notification"=>array("approvalprocess"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"21"))))),
		"2"=>array('action'=>array("notification"=>array("ticket"=>array(
										array("key"=>"creator","eid"=>"24"))))),
		"3"=>array('action'=>array("notification"=>array("ticket"=>array(
										array("key"=>"creator","eid"=>"25"))))),
		),
		

	
	
	));


$bp_data = json_encode($process); 


?>