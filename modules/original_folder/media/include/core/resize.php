<?php
define("ADAPT_DT","1");
class SimpleImage 
{ 
var $image; 
var $image_type; 
	var $image_width;
    var $adapt_width;
    var $adapt_height;
    var $image_height;
    var $ratio_height;
    var $ADAPT_DT_WIDTH;
    var $ADAPT_DT_H1;
	var $ADAPT_DT_H2;
    
 function SimpleImage($w,$h,$h2)
 {
    $this->ADAPT_DT_WIDTH = $w;
    $this->ADAPT_DT_H1 = $h;
 	$this->ADAPT_DT_H2 = $h2;

 }
public function loadimage($filename)
   {
$image_info = getimagesize($filename);
	if($image_info)
	{
		$this->width=$image_info[0];
		$this->height=$image_info[1]; 
 $this->image_type = $image_info[2]; 
if( $this->image_type == IMAGETYPE_JPEG )
	   {
	    $this->image = imagecreatefromjpeg($filename);
		  }
		    elseif( $this->image_type == IMAGETYPE_GIF ) 
			{
			   $this->image = imagecreatefromgif($filename); 
			   }
			    elseif( $this->image_type == IMAGETYPE_PNG ) 
				{
				   $this->image = imagecreatefrompng($filename); 
				   }
		else
			return false;

		return true; 
	}

	return false;	
}

public function adaptsize($adapttype=ADAPT_DT)
{
	
	if($adapttype == ADAPT_DT) 
	{
		$this->adapt_width=$this->ADAPT_DT_WIDTH;
		$ratio = $this->ADAPT_DT_WIDTH/$this->width; 
	       
    	if($this->width>$this->adapt_width)
		{
			$this->ratio_height = $this->height * $ratio; 
			if($this->ratio_height<$this->ADAPT_DT_H1)
			{
				$this->adapt_height=$this->ADAPT_DT_H1;
			}
			else if($this->ratio_height<$this->ADAPT_DT_H2)
			{
				$this->adapt_height=$this->ADAPT_DT_H2;
			}
			else
			{
				$this->adapt_height = $this->ratio_height;
			}
            
		}
		else
		{
			if($this->height<$this->ADAPT_DT_H1)
			{
				$this->adapt_height=$this->ADAPT_DT_H1;
			}
			else if($this->height<$this->ADAPT_DT_H2)
			{
				$this->adapt_height=$this->ADAPT_DT_H2;
			}
else
			{
				$this->adapt_height = $this->height;
			}
            $this->ratio_height = $this->height;

		}
		return true;
	}

	return false;
}


public function resizetoadaptedsize($destfilename)
{
	$noerror=false;
	$new_image=false;

    $new_image=@imagecreatetruecolor($this->adapt_width, $this->adapt_height);



    
	if($new_image)
    {
        if($this->adapt_width>$this->width)
        {
            $xcoord=($this->adapt_width-$this->width)/2;
            $copywidth=$this->width;
        }
   else
   {
            $xcoord=0;
            $copywidth=$this->adapt_width;
            
        }
        $copyheight=$this->ratio_height;
        if($this->adapt_height>$this->ratio_height)
	   {
           $ycoord=($this->adapt_height-$this->ratio_height)/2;
		  
		   }
        else
			{
            $ycoord=0;
            
			   }
        
    	if(($this->adapt_width>$this->width) || ($this->adapt_height>$this->ratio_height))
				{
    		$color=imagecolorallocate($new_image, 255, 255, 255);
            imagefill($new_image, 0, 0, $color);
				   }
 
        if(imagecopyresampled($new_image , $this->image , $xcoord, $ycoord, 0, 0,  $copywidth, $copyheight, 
                    $this->width, $this->height))
        {
	         $noerror=true;
        }
        else
        {
            imagedestroy($new_image);
            $new_image=false;
 }
 
 }
					
	if($noerror)
		$this->save($new_image, $destfilename, $this->image_type,100);
					
	if($new_image)
		imagedestroy($new_image);
	return $noerror;
}

function save($imagehandle, $filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) 
{  

 if( $image_type == IMAGETYPE_JPEG )
  { 
		imagejpeg($imagehandle,$filename,$compression);
   }
    elseif( $image_type == IMAGETYPE_GIF ) 
	{  
		imagegif($imagehandle,$filename); 
	 } 
	elseif( $image_type == IMAGETYPE_PNG )
	  { 
	  imagepng($imagehandle,$filename); 
		} 
		if( $permissions != null) 
		{   
		chmod($filename,$permissions); 
		}
		 } 
	 
function getresizeWidth() 
		 {  
	return $this->adapt_width;
		  } 
		  
function getresizetHeight() 
		  { 
	return $this->adapt_height;
			} 
		  
			 } 
			 
			
			  
		
	


?>
