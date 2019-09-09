<?php
include_once '../../../../global.php';
global $companyId;
$time=time()*1000;
$file=server_path().'uploads/temp/';
$newfile=$file.$time;
 mkdir($newfile, 0777 );
 chmod($newfile, 0777 );
 $show_data=array();
 $hierarchy=get_user_hirarchy(array('userId'=>$_SESSION['user']['user_id']));

if($hierarchy['success']=='true')
{
	$ids=$hierarchy['data'];
	$ids=implode('|',$ids);
	$data=array('id'=>$ids);
	$get_users=get_resource_by_id($data);
	//$get_users=get_resource_by_id(array('id'=>'595f80f91e4abb88243c9869'));
	$head=array();
	foreach($get_users['data'] as $users)
	{
		$status="Activated";
		$user_type="User ";
		if($users['user_type']!='super admin')
		{
			if(isset($users['user_type']) && $users['user_type']=="admin"){
				$user_type="Admin";
			}
			
			if(isset($users['status']) && $users['status']==0){
				$status="Deactived";	
			}
			$id=$users['id'];
			$imageData=get_media(array('smid'=>'1','asmid'=>'1','amid'=>'1','aiid'=>$id,'object'=>'true'));

		   if(isset($imageData['data'][0]['mediaName']))
		   {
				$profile_picture=$imageData['data'][0]['mediaName'];
				$url_image=$imageData['data'][0]['url'];
		   }
		   else
		   {
				$profile_picture='';
				$url_image="";
		   }

			if($profile_picture!='')
			{
				$move=$newfile.'/'.$profile_picture;
				copy($url_image,$move);
			}  
			else
			{
			    $img_url=admin_assets_url().'img/avatar.png';
			    $profile_picture='';
			    $des='';
			}  
			if(isset($users['designation']))
			{
				$des=$users['designation'];
			}
			$data=array("Name"=>$users['name'],'Email'=>$users['email'],'designation'=>$des,'status'=>$status,'image'=>$profile_picture);
			array_push($show_data,$data);
		}
	}
}
$header_fields=array('Name','Email','Designation','Status','Image');
if(sizeof($show_data)>0)
{
	$ex=export_user_xls(array("header_fields"=>json_encode($header_fields),"show_data"=>json_encode($show_data),"time"=>$time,"dirpath"=>$file));
	if(isset($ex['success']) && $ex['success']=='true')
	{
		$result=array("success"=>"true","data"=>$time,"path"=>$file,"error_code"=>'201');
		echo json_encode($result);
		
	}
}
else
{
	$ret=array('success'=>'false','error_code'=>'120','data'=>'');
	echo json_encode($ret);
}
?>