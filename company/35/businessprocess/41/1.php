<?php

$process = array(

	"add"=>array("create"=>
		array('action'=>array("notification"=>array("user"=>array(array("code"=>"user","key"=>"mngr","eid"=>"154","level"=>"1"))),
							  
							  "webservice"=>array("manage_approvalprocess"=>array("action_done"=>"create","action"=>"send_for_approval","condition"=>"general","data_value"=>array("update_by"=>"update_by","iid"=>"id","mid"=>"mid","smid"=>"smid","cid"=>"cid","title"=>"title")))
			))),
	
	"update"=>array(
		"priority"=>array(
		"1"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"153"),														   array("key"=>"current_user","eid"=>"153"),
																         array("key"=>"creator","eid"=>"153"),
																         array("key"=>"current_user","eid"=>"153")),
														"category"=>array(array("code"=>"manager1","key"=>"mngr","level"=>"1","eid"=>"153"))))),
		"2"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"153"),
																		 array("key"=>"creator","eid"=>"153"),
																		 array("key"=>"current_user","eid"=>"153"))))),
		"3"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"153"),
																		 array("key"=>"creator","eid"=>"153"),
																		 array("key"=>"current_user","eid"=>"153")
			)))),
		"4"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"153"),
																		 array("key"=>"creator","eid"=>"153"),
																		 array("key"=>"current_user","eid"=>"153")
			)))),
		"5"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"153"),
																		 array("key"=>"creator","eid"=>"153"),
																		 array("key"=>"current_user","eid"=>"153")
			))))),

	"assign"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"from_user","eid"=>"173"),
			   															    array("key"=>"current_user","eid"=>"19"),
			   															    array("key"=>"creator","eid"=>"160"))))),
	"reassign"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"from_user","eid"=>"173"),
			   															    array("key"=>"current_user","eid"=>"19"),
			   															    array("key"=>"creator","eid"=>"160"))))),
	
	
	"status"=>array(
		"1"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155"))))),
		"2"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155"))))),
		"3"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155"))))),
		"4"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155"))))),
		"5"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155"))))),
		"6"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155"))))),
		"7"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155"))))),
		"8"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"current_user","eid"=>"151"),array("key"=>"creator","eid"=>"155")))))),
		

	
	"severity"=>array(
	"1"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))),
	"2"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))),
	"3"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))),
	"4"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))),
	"5"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))),
	"6"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))),
	"7"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))),
	"8"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"152"),array("key"=>"creator","eid"=>"156"))))))

	));



	/*"jobcategory"=>array('action'=>array("notification"=>array("ticket"=>array(array("key"=>"participant","eid"=>"151"),
																			   array("key"=>"creator","eid"=>"151")
		)))),*/



/*/


project['code']['creator']
project['code']['users']

ticket['participant']
category['code']['users']
category['code']['mngr']

"status"=>array("0"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),"1"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),"2"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),"3"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),"4"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),"5"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),"6"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1"))))),

"type"=>array("1"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),
				"2"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1")))),
				"3"=>array('action'=>array("notification"=>array("ticket"=>array("code"=>"participant","key"=>"users","level"=>"1"))))),
/*/
//echo "<pre>"; print_r($process); die;
$bp_data = json_encode($process); 


?>