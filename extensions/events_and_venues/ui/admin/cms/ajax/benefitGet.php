<?php 
include_once '../../../../../../global.php'; 

$id=$_POST['id'];
$output=get_benefit(array("id"=>$id));

$imageData=get_association_data("24","10","1",$id);

    $profile_picture=$imageData['media']['1'][$id][0]['mediaName'];
    if($profile_picture!='')
      {
        $img_url=site_url().'uploads/media/images/'.$profile_picture;
      }  
    else
      {
        $img_url=admin_assets_url().'img/avatar.png';
      }  

        $user_avatar="<img src='$img_url' width='50' height='50'/>";
          foreach ($output['data'] as $key => $value) 
  {
    $newDataArray=array("title"=>$value['title'],"description"=>$value['description'],"image"=>$img_url,"id"=>$id);
  }

    echo json_encode($newDataArray); 

?>
