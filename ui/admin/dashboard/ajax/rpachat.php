<?php
include_once '../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']="chatrpa"){
	if(isset($_POST['msg']) && $_POST['msg']!=""){
		$question = trim(strtolower($_POST['msg']));
		global $con;
	    $query="Select * from chatboat where question=LOWER('$question')";
	    $get_data=mysqli_query($con,$query);
	    if(mysqli_num_rows($get_data)>0){
	    	$row=mysqli_fetch_array($get_data,MYSQLI_ASSOC);
	    	echo $row['answer'];
	    }else{
	    	echo "Sorry question is out of the memory.";
	    }
	}
}

?>
