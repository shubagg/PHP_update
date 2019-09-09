<?php
function user_signup()
{
	global $app;
	$postVar = get_post_data();
	if(isset($postVar['email'])&&isset($postVar['username'])&&isset($postVar['fullname'])&&isset($postVar['password']))
	{
		if(filter_var($postVar['email'], FILTER_VALIDATE_EMAIL))
			rs(array('ID'=>1));
		else
			rs("",'121',"false");

	}
	else
	{
		rs("",'116',"false");
	}
}

function user_signin()
{
	global $app;
	$postVar = get_post_data();
	$user = new User();
	if(isset($postVar['email'])&&isset($postVar['password']))
	{
		if(filter_var($postVar['email'], FILTER_VALIDATE_EMAIL))
			rs($user->get_profile());
		else
			rs("",'121',"false");
	}
	else
	{
		rs("",'116',"false");
	}
}

function user_update_profile()
{
	$postVar = get_post_data();
	if((isset($postVar['ID']))&&(isset($postVar['email'])||isset($postVar['username'])||isset($postVar['fullname'])||isset($postVar['image'])))
	{
		rs('');
	}
	else
	{
		rs("",'116',"false");
	}

}

function user_update_profile()
{
	$postVar = get_post_data();
	if(isset($postVar['ID'])&&isset($postVar['image']))
	{
		rs('');
	}
	else
	{
		rs("",'116',"false");
	}

}

function user_profile_pic()
{
	$postVar = get_post_data();
	if(isset($postVar['ID']))
	{
		$user = new User();
		rs(array("ID"=>$postVar['ID'],"image"=>$user->profile_pic));
	}
	else
	{
		rs("",'116',"false");
	}

}

function user_listened()
{
	$postVar = get_post_data();
	if(isset($postVar['ID'])&&isset($postVar['article_id']))
	{
		rs("");
	}
	else
	{
		rs("",'116',"false");
	}
}

function user_recommended()
{
	$postVar = get_post_data();
	if(isset($postVar['ID'])&&isset($postVar['article_id']))
	{
		rs("");
	}
	else
	{
		rs("",'116',"false");
	}
}

function user_shared()
{
	$postVar = get_post_data();
	if(isset($postVar['ID'])&&isset($postVar['article_id']))
	{
		rs("");
	}
	else
	{
		rs("",'116',"false");
	}
}

function user_exists()
{
	$postVar = get_post_data();
	if(isset($postVar['email'])&&isset($postVar['username']))
	{
		rs("",'116',"false");
	}
	else if(isset($postVar['email']))
	{
		rs("");
	}
	else if(isset($postVar['username']))
	{
		rs("");
	}
	else
	{
		rs("",'116',"false");
	}
}


function reset_password()
{
	global $app;
	$postVar = get_post_data();
	if(isset($postVar['email']))
	{
		if(filter_var($postVar['email'], FILTER_VALIDATE_EMAIL))
			rs("");
		else
			rs("",'121',"false");
	}
	else
	{
		rs("",'116',"false");
	}

}
function interest_list()
{
	global $app;
	$arr = array();
	for ($i=1; $i < 6; $i++) {
		array_push($arr,array("interest_id"=>$i,"channel"=>"interest".$i));
	}

	rs($arr);

}

function channel_list()
{
	global $app;
	$arr = array();
	$channel = new Channel();
	for ($i=1; $i < 6; $i++) {
		array_push($arr,$channel->get_channel($i));
	}

	rs($arr);

}

function search_channel()
{
	global $app;
}

function user_get_channel()
{
	$arr = array();
	$postVar = get_post_data();
	$channel = new Channel();
	if(!isset($postVar['ID']))
		rs("","116",false);

	for ($i=1; $i < 3; $i++) {
		array_push($arr,$channel->get_channel($i));
	}

	rs($arr);
}

function user_set_channel()
{
	$postVar = get_post_data();
	if(!isset($postVar['ID']))
		rs("","116",false);
	rs("");

}
function user_set_interest()
{
	$postVar = get_post_data();
	if(!isset($postVar['ID']))
		rs("","116",false);
	rs("");

}

function user_playlist()
{
	$postVar = get_post_data();
	if(!isset($postVar['ID']))
		rs("","116",false);

	$playlist = new Playlist();
	rs($playlist->get_playlist());
}



//artivle functions
function article_list()
{
	global $app;
	$postVar = $app->request->post();
	//if(!isset($postVar['ID']))
	//	rs("","116",false);
	$article = new Article();
	$arr = array();
	for ($i=1; $i < 5; $i++) { 
		array_push($arr,$article->get_article($i));
	}
	rs($arr);
}

function article_details()
{
	$postVar = get_post_data();
	if(isset($postVar['article_id']))
	{
		$arr = array();
		$article = new Article();
		$article_id = explode(",",$postVar['article_id']);
		foreach ($article_id as $key => $val) {
			array_push($arr,$article->get_article($val));
		}
		rs($arr);
	}
	else
	{
		rs("",'116',"false");
	}
}

/*function user_signup()
{
	global $postVar;
}*/


function get_post_data()
{
	global $app;
	$postVar = $app->request->post();

	//return $postVar;
	//
	//print_r($postVar);
	//print_r(json_decode($postVar['key'],ARRAY_A));
	if($postVar['key']!="")
		return json_decode($postVar['key'],ARRAY_A);
	return "";

}
function error_code()
{


  //fields incorrect
  $array[100]="Ok";
  $array[121]="Email not valid";
  $array[103]="User Not registered";

  $array[116]="Parameter Incorrect";




  $array=array();
  $array[100]="Ok";
  $array[102]="Username or password is incorrect";
  $array[115]="User is deactivated";
  $array[111]="User approval already in pending state";
  $array[101]="IMEI number is already assigned";
  $array[113]="Updation failed";
  
  $array[115]="User is deactivated";
  $array[114]="GPS coordinates incorrect";
  $array[108]="Checkin Failed due to distance";   
  $array[104]="Checkin Failed due to wifi-id or distance";
  $array[105]="DeviceId not found";
  $array[115]="User is deactivated";
  $array[114]="GPS coordinates incorrect";
  $array[109]="Checkout Failed due to distance";
  $array[106]="Checkout failed due to wifi-id or distance ";
  $array[105]="DeviceId not found";

  $array[404]="Page not found";
  $array[500]="Generic error";
}
?>