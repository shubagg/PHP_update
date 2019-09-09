<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w=$_POST['imageWidth'];
	$targ_h=$_POST['imageheight'];
	//$targ_w = 800;
	//$targ_h = 600;
	$jpeg_quality = 90;

	$imagename=$_POST['imgname'];
	$resp=explode("/",$imagename);
	$imagenamecrop=end($resp);
	$path='Cropupload/'.end($resp);
	$sTempFileName = 'tempCropupload/'.end($resp);					//not use the link like:- http://wwww.as.com/uploads ( not use )

	@chmod($sTempFileName, 0644);									// change file permission to 644
    
    if(file_exists($sTempFileName))									// check file is exits or not..
    {	

		$aSize = getimagesize($sTempFileName); 						//get the image code for like:- ( $imageTypeArray = array ( 0 =>'UNKNOWN', 1 =>'GIF', 2 =>'JPEG', 3 =>'PNG',4=>'SWF'); )
			
		if (!$aSize) 												// check if file is not image then remove this file..
		{
	             @unlink($sTempFileName);
	             return;
	    }
		
		  switch($aSize[2])
		  {
	                case IMAGETYPE_JPEG:								// getting the name and check the type of image format..
	                    $sExt = '.jpg';

	                    $img_r = @imagecreatefromjpeg($sTempFileName);	// create a new image from file 
	                    break;
	                case IMAGETYPE_GIF:
	                    $sExt = '.gif';

	                    $img_r = @imagecreatefromgif($sTempFileName);
	                    break;    
	                case IMAGETYPE_PNG:
	                    $sExt = '.png';

	                    $img_r = @imagecreatefrompng($sTempFileName);
	                    break;
	                default:
	                    @unlink($sTempFileName);
	                    return;
	       }

	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	imagejpeg($dst_r,$path,$jpeg_quality);

	$files = glob('tempCropupload/*'); 									// get all file names
	foreach($files as $file)
	{ 													
        if(is_file($file))
         unlink($file); 											// delete all file( from array like variable :- $files)
    }

    /*$filescrop = glob('Cropupload/*'); 									// get all file names
	foreach($filescrop as $filename)
	{ 													
        if(is_file($filename!=$imagenamecrop))
         unlink($filename); 											// delete all file( from array like variable :- $files)
    }*/

		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		$dataArray=array("type"=>$type,"imageData"=>base64_encode($data),"showImg"=>$base64,"tmp_path"=>$path);
		echo json_encode($dataArray);
		
	}
}

?>