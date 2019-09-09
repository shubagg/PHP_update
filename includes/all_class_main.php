<?php 
include("$path/includes/database_main.php");
class Api
{
    function Select_All($table_name)
    {
          $query = "Select * from ".$table_name;
        $result = mysql_query($query);
        return $result;
    }
    function Select_Some_One($table_name,$condition)
    {
        $query = "Select ".$condition." from ".$table_name;
        $result = mysql_query($query);
        return $result;
    }
    function Select_Some_One_Order($table_name,$condition,$orderby)
    {
        $query = "Select ".$condition." from ".$table_name." ORDER BY ".$orderby;
        $result = mysql_query($query);
        return $result;
    }
     function Select_Some($table_name,$field,$condition)
    {
            $query = "Select ".$field." from ".$table_name." where ".$condition;
           $result = mysql_query($query);
           return $result;
      // return $query;
    }
     function Drop($table_name)
    {
       $query = "drop table ".$table_name;
           $result = mysql_query($query);
           return $result;
      
    }
    
	function Select_con($table_name,$field,$condition1,$condition2)
    {
   $query = "Select ".$field." from ".$table_name." where ".$condition1." AND ".$condition2;
      $result = mysql_query($query);
       return $result;
    }
	function Select_order($table_name,$field,$condition1,$condition3)
    {
   $query = "Select ".$field." from ".$table_name." where ".$condition1." ORDER BY ".$condition3;
   //$query = "Select ".$field." from ".$table_name." where ".$condition1." ORDER BY ".$condition3." DESC ";
      $result = mysql_query($query);
       return $result;
    }
    function Select_Within_Tables($table_name1,$table_name2,$fields,$condition)
    {
        $query = "Select ".$fields." from ".$table_name1.", ".$table_name2." where ".$condition;
        $result = mysql_query($query);
        return $result;
    }
    function Current_Date()
    {
        date_default_timezone_set('Asia/Kolkata'); 
        $date = date("y-m-d");
        return $date;
    }
    
    function update_category($table,$field1,$field2,$field3,$condition)
    {
        $query = "update ".$table." set name=".$field1.", p_cid=".$field2.",image='".$field3."' where ".$condition;
        $result = mysql_query($query);
        return $result;
    }
    
    function delete($table,$condition)
    {
     $query = "delete from ".$table." where ".$condition;
        $result = mysql_query($query);
       return $result;
    }
    
     function insert($table,$fields,$values)
    {
       $query = "insert into ".$table." ". $fields."  VALUES".$values;
      $result = mysql_query($query);
       return $result;
       //return $query;
    }
    
    function update($table,$value,$condition)
    {
      $query = "update ".$table." set ".$value." where ".$condition;
        $result = mysql_query($query);
       return $result;
       //return $query;
    }
    
    function create_table($table_name,$fields)
    {
        $query="CREATE TABLE IF NOT EXISTS $table_name($fields) ";
        $result = mysql_query($query);
        return $result;
    }
    

    
    public function get_qualification_name($qual_id)
    {
        $myobj=new Api();
        $sel_topic=$myobj->Select_Some("qualification","*","id='$qual_id'");
        $fet_topic=mysql_fetch_array($sel_topic);
        return $fet_topic['qname'];
        
    }
    
    public function returnDates($start_date,$end_date) {
       $begin = new DateTime($start_date);
        $end = new DateTime($end_date);
        
        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
        
        foreach($daterange as $date){
            $ret.=$date->format("Y-m-d").",";
        }
        
        return substr($ret,0,-1);
    }
    
    public function get_category_id($cat_name,$customer_id)
    {
        $myobj=new Api();
        $cat=$myobj->Select_Some("category_$customer_id","id","name='$cat_name'");
        $fet=mysql_fetch_array($cat);
        return $fet['id'];
    }
    
    public function get_subject_name($customer_id,$course_id,$id)
    {
        $myobj=new Api();
        $table="subject_$customer_id"."_".$course_id;
        $sub_name=$myobj->Select_Some("$table","name","id='$id'");
        $fet=mysql_fetch_array($sub_name);
        return $fet['name'];
    }
    
    public function get_topic_name($customer_id,$course_id,$id)
    {
        $myobj=new Api();
        $table="topic_$customer_id"."_".$course_id;
        $sub_name=$myobj->Select_Some("$table","name","id='$id'");
        $fet=mysql_fetch_array($sub_name);
        return $fet['name'];
    }
    
    public function get_subject_id($customer_id,$course_id,$sub_name)
    {
        $myobj=new Api();
        $table="subject_$customer_id"."_$course_id";
        $sub_name=$myobj->Select_Some("$table","id","name='$sub_name'");
        $fet=mysql_fetch_array($sub_name);
        return $fet['id'];
        
    }
    
    public function get_topics_subject_id($customer_id,$course_id,$topic_id)
    {
        $myobj=new Api();
        $table="topic_$customer_id"."_".$course_id;
        $sub_id=$myobj->Select_Some("$table","subject_id","id='$topic_id'");
        $fet=mysql_fetch_array($sub_id);
        return $fet['subject_id'];
    }
    
    public function get_topic_id($customer_id,$course_id,$topic_name)
    {
        $myobj=new Api();
        $table="topic_$customer_id"."_$course_id";
        $topic_name1=$myobj->Select_Some("$table","id","name='$topic_name'");
        $fet=mysql_fetch_array($topic_name1);
        return $fet['id'];
        
    }
    
    public function get_category_name($customer_id,$id)
    {
        $myobj=new Api();
        $sub_name=$myobj->Select_Some("category_$customer_id","name","id='$id'");
        $fet=mysql_fetch_array($sub_name);
        return $fet['name'];
    }
    
    public function get_days_of_week($startDate,$endDate,$day)
    {
        
        $endDate = strtotime($endDate);
        $dates='';
        for($i = strtotime("$day", strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
        {
        $dates.=date('Y-m-d', $i).",";
        }
        return substr($dates,0,-1);
    }
    
    public function monthly_dates($start_date,$end_date,$day)
    {
        $begin = new DateTime($start_date);
        $end_date=date("Y-m-d",strtotime($end_date."+1 days") );
        $end = new DateTime($end_date);
        
        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
        
        foreach($daterange as $date){
            
            if($date->format("d")==$day)
            {
            $ret.=$date->format("Y-m-d").",";
            }
        }
        
        return substr($ret,0,-1);
    }
    
    
    public function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}
    
    
    public function create_zip_file($source_folder,$zip_name)
    {
        $the_folder = $source_folder;
        $zip_file_name = $zip_name;
        $za = new FlxZipArchive;
        $res = $za->open($zip_file_name, ZipArchive::CREATE);
        if($res === TRUE) 
        {
            $ret=array("success"=>"true");
            $za->addDir($the_folder, basename($the_folder));
            $za->close();
        }
        else  { 
                $ret=array("success"=>"false");
              }
       return $ret; 
    } 
    
  public  function DelDir($dir) { 
  
  $dirHandle = opendir($dir);

   while ($file = readdir($dirHandle)) {
   
       if(!is_dir($file)) {
           unlink ("$dir"."$file"); 
       }
     }
  }
    
    public function copy_files($source,$target)
    {
        if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                $this->copy_files( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
    }else {
        copy( $source, $target );
    }
    } 
    
    
    
    public function getDirectorySize($path)
    {
      $totalsize = 0;
      $totalcount = 0;
      $dircount = 0;
     if($handle = opendir($path))
     {
        while (false !== ($file = readdir($handle)))
        {
          $nextpath = $path . '/' . $file;
          if($file != '.' && $file != '..' && !is_link ($nextpath))
          {
            if(is_dir($nextpath))
           {
             $dircount++;
             $result = $this->getDirectorySize($nextpath);
             $totalsize += $result['size'];
              $totalcount += $result['count'];
             $dircount += $result['dircount'];
           }
           else if(is_file ($nextpath))
           {
              $totalsize += filesize ($nextpath);
              $totalcount++;
           }
         }
       }
     }
     closedir($handle);
     $total['size'] = $totalsize;
     $total['count'] = $totalcount;
     $total['dircount'] = $dircount;
     return $total;
    }
    
    
      
}


   class FlxZipArchive extends ZipArchive
     {
       
    
        public function addDir($location, $name) {
            $this->addEmptyDir($name);
    
            $this->addDirDo($location, $name);
         } // EO addDir;
    
        
        
        private function addDirDo($location, $name) {
            $name .= '/';
            $location .= '/';
    
            // Read all Files in Dir
            $dir = opendir ($location);
            while ($file = readdir($dir))
            {
                if ($file == '.' || $file == '..') continue;
                // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
                $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
                $this->$do($location . $file, $name . $file);
            }
        } // EO addDirDo();
    }
  

?>