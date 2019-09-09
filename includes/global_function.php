<?php

function format_date($milliseconds)
{
    return date("Y-m-d H:i:s",$milliseconds);
}

function getformstatus($status){
            global $ui_string;
            
            if($status=='0')      { $statusString=$ui_string['new']; }
            elseif($status=='1')  { $statusString=$ui_string['approved']; }
            elseif($status=='2')  { $statusString=$ui_string['rejected']; }
            elseif($status=='3')  { $statusString=$ui_string['pending']; }
            elseif($status=='4')  { $statusString=$ui_string['new']; }
            elseif($status=='5')  { $statusString=$ui_string['closed']; }
            elseif($status=='6')  { $statusString=$ui_string['closenotified'];}
            elseif($status=='7')  { $statusString=$ui_string['editdone']; }
            elseif($status=='8')  { $statusString=$ui_string['tobeedit']; }
            else                  { $statusString='---';}
       
            return $statusString;
}
function ex_getformstatus($status){
            global $ui_string;
            
            if($status=='0')      { $statusString=$ui_string['new']; }
            elseif($status=='1')  { $statusString=$ui_string['sendforapproval']; }
            elseif($status=='2')  { $statusString=$ui_string['approved']; }
            elseif($status=='3')  { $statusString=$ui_string['rejected']; }
            
            else                  { $statusString='---';}
       
            return $statusString;
}
function no_image()
{
    return site_url()."company/".COMPANY_ID."/noImage.jpg";
}

function json_encode_advanced($struct) {
   return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($struct));
}
function get_course_image($thumbnailId)
{
    global $companyId,$coursePath;
    $sel_thumbnail=Select_Some("*","course_thumbnails_$companyId","id='$thumbnailId'");
    $fet_thumbnail=mysqli_fetch_assoc($sel_thumbnail);
    return $coursePath."/icons/".$fet_thumbnail['name'];
}
function get_diff_between_time($stime,$etime='')
{
    if(empty($etime))
    {
        $etime = time();
    }
    return $result = secondsToTime($etime-$stime);
}

function current_date_time() {
    $date = date("Y-m-d");
    $time = date("H:i:s");
    return array('date' => $date, 'time' => $time, 'mills' => time());
}
function secondsToTime($seconds) {
    
    $dtF = new DateTime("@0"); 
    $dtT = new DateTime("@$seconds"); 
    $s =  $dtF->diff($dtT)->format('%s');
    $m =  $dtF->diff($dtT)->format('%i');
    $h =  $dtF->diff($dtT)->format('%h');
    $d =  $dtF->diff($dtT)->format('%a');
    $diff = array();
    if(isset($d) && !empty($d))
    {
        $diff['d'] = $d; 
    }
    if(isset($h) && !empty($h))
    {
        $diff['h'] = $h; 
    }
    if(isset($m) && !empty($m))
    {
        $diff['m'] = $m; 
    }
    if(isset($s) && !empty($s))
    {
        $diff['s'] = $s; 
    }

    if(count($diff))
    {
        return array("success"=>"true","data"=>$diff);
    }
    else
    {
        return array("success"=>"false","data"=>"");    
    }
    //  echo $d."--".$h."--".$m."--".$s;
    //%a days, %h hours, %i minutes and %s seconds
}

/*function get_product_image($productId,$size='200')
{
      $getImage=get_association_data('16','10','1',$productId);
      $logo=$getImage['media'][1][$productId][0]['mediaName'];
      if($logo)
      {
          $imageName=explode(".",$logo);
          $imageName200=$imageName[0]."_200.".$imageName[1];
          $imageName400=$imageName[0]."_400.".$imageName[1];
          if($size=='200')
          {
            return get_upload_dir_uri()."media/images/".$imageName200;
          }
          else
          {
            return get_upload_dir_uri()."media/images/".$imageName400;
          }
       }
       else
       {
            return "http://www.coastwidelabs.com/premier/pics/not_available.jpg";
       }
       
}*/


// Get Client IP Address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}
// Get user session ID
function get_session_id()
{
    return session_id();

}
function set_session_history($data)
{  
    logger(16,'',$data,5);
    $table_name = "customerSessionHistory";
    $check = check_key_available($data,array('sessionId','userId','mod'));

    if($check)
    {
        $ipAddress=get_client_ip();

        $sessionId = $data['sessionId'];
        $user_id = $data['userId'];

        // check session is exist or not
        $mod = $data['mod'];
        if($mod == 'mobile')
        {
             $currStartDate = date("Y-m-d"). " 00:00";
             $currStartDate = new MongoDate(strtotime($currStartDate));

             $currEndDate = date("Y-m-d"). " 24:00";
             $currEndDate = new MongoDate(strtotime($currEndDate));

             $condition['orderedOn'] = array('$gte'=>$currStartDate,'$lt'=>$currEndDate);
             $condition['sessionId'] = $sessionId;

        }
        else if($mod == 'web')
        {
             $condition = array("sessionId"=>$sessionId);
        }
       
        $checkSession=count_mongo($table_name,$condition);
        if($checkSession==0) // insert into table
        {
            $id=new MongoId();
            $insert_data['_id']=$id;            
            $history_id = db_id($insert_data); 

            $insert_data['sessionId'] =  $sessionId;
            $insert_data['ipAddress'] =  $ipAddress;
            $insert_data['dateOn']=new MongoDate(); 
            $insert_data['userId'] =  $user_id;
            
            if(isset($data['productId']))
            {
                $insert_data['productView'] =  '1' ;
                $insert_data['productViewData'] =  array($data['id']);
            }
            else
            {
                $insert_data['productView'] =  '0' ;
                $insert_data['productViewData'] =  array();
            }
           
            $insert_data['removeCartData']=array();
            $insert_data['productRemoveCart'] =  '0';
            $insert_data['productAddCart'] =  '0';
            $insert_data['cartData'] =  array();

            $insert_data['orderPlacedStatus'] =  'no';
            $insert_data['sessionStatus'] =  'open';

            insert_mongo($table_name,$insert_data);
            
            return array('success'=>'true','data'=>$history_id,'error_code'=>'1600010');
        }
        else
        { // update into table

            $rec = select_mongo($table_name,array("sessionId"=>$sessionId),array());
            $rec = add_id($rec,"id");$rec=$rec[0];
            $update_data['userId'] =  $user_id;

            // check Product
            if(isset($data['viewProductId']))
            {
                $update_data['productView'] =  $rec['productView']+1;
                array_push($rec['productViewData'], $data['viewProductId']);
                $update_data['productViewData'] =  $rec['productViewData'];
            }
            
            //check add to cart
            if(isset($data['cartProductId']))
            {
                $update_data['productAddCart'] =  $rec['productAddCart']+1;
                array_push($rec['cartData'], $data['cartProductId']);
                $update_data['cartData'] = $rec['cartData'];
            }

            if(isset($data['removeCartProductId']))
            {
                $update_data['productRemoveCart'] =  $rec['productRemoveCart']+1;
                array_push($rec['removeCartData'], $data['removeCartProductId']);
                $update_data['removeCartData'] = $rec['removeCartData'];
            }

            //check add to orderPlacedStatus
            if(isset($data['orderPlacedStatus']))
            {
                $update_data['orderPlacedStatus'] =  'yes';
            }
            
            

            //check add to sessionStatu
            if(isset($data['sessionStatus']))
            {
                $update_data['sessionStatus'] =  'close';
                unset($update_data['userId']);
            }
            

            $condition =array('sessionId'=>$sessionId);    
            update_mongo($table_name,$update_data,$condition);
        }
    }
    else
    {
        return $check;
    }
}
function get_material_icon($data)
{
    if(isset($data['type']))
    {
        unset($data['type']);
        $mediaData=get_media($data);
        if(isset($mediaData[0]['mediaName'])){
            return $mediaData[0]['mediaName'];
        }else{
            return '0';
        }
    }
    else
    {
        $mediaData=get_media($data);
        if(isset($mediaData[0]['mediaUrl'])){
            return $mediaData[0]['mediaUrl'];
        }else{
            return get_default_material_icon();
        }
    }
}

function get_default_material_icon()
{
  return site_url()."company/".COMPANY_ID."/login-logo.png";
}

function get_current_langauge()
{
    if(isset($_SESSION['engine-language']))
    {
        return $_SESSION['engine-language'];
    }
    else
    {
        return '';
    }
}

function is_user_logged_in() {
    if (isset($_SESSION['user']['user_id'])) {
        $user_id = $_SESSION['user']['user_id'];
        $checkUser = select_mongo('user', array('_id' => new MongoId($user_id), 'status' => '1'));
        $checkUser = add_id($checkUser);
        if(empty($checkUser)) {
            unset($_SESSION['user']);
            $url = admin_ui_url();
            echo '<script>window.location="' . $url . '";</script>';
        } else {
            update_mongo('user', array('last_activity_update' => time()),array('_id'=>new MongoId($_SESSION['user']['user_id'])));
            return $_SESSION['user']['user_id'];
        }
    } else {
        $url = admin_ui_url();
        echo '<script>window.location="' . $url . '";</script>';
    }
}

function is_logged_in()
{
    if(isset($_SESSION['userId']))   
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function current_logged_in_userid()
{
    return $_SESSION['userId'];
}

function get_logged_user_info(){
    //session user object
    if(isset($_SESSION['user'])){
    return $_SESSION['user'];
    }
    else{
        return false;
    }
}


function get_logged_user(){
    //session user object
    if(isset($_SESSION['user']['user_id'])){
    return $_SESSION['user']['user_id'] ;
    }
    else{
        return false;
    }
}



function access_role(){
    
   $user=is_user_logged_in();
   
}

function url_redirect($url_to_redirect){
    
    header("Location:".$url_to_redirect);
}


function check_user_permission($mid,$smid,$val)
{
    //return true;
    $status=get_module_status(array('name'=>$mid,'id'=>'0'));
    //if($status)
if($status)
    {
    $permissionarr=$_SESSION['user']['permission'];
    if(!isset($permissionarr[$mid]))
        return false;
    if(!isset($permissionarr[$mid][$smid]))
        return false;
    if(!in_array($val,$permissionarr[$mid][$smid]))
        return false;
    return true;
    }
    else
    {
     return false;   
    }
}

function check_user_smid_permission($mid,$smid)
{
    
    $status=get_module_status(array('name'=>$mid,'id'=>''));
    if($status)
    {
    $permissionarr=$_SESSION['user']['permission'];
    if(!isset($permissionarr[$mid]))
        return false;
    if(!isset($permissionarr[$mid][$smid]))
        return false;
    return true;
    }
    else
    {
     return false;   
    }
}
function search_val_in_array($array, $key, $val) {
    foreach ($array as $item)
        if (isset($item[$key]) && $item[$key] == $val)
            return true;
    return false;
}

function my_custom_function($search,$source) {
   return (count(array_intersect($search, $source)) == count($search));
}


function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..  
    return false;
}


function get_lat_long($address)
{

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
    $json = json_decode($json);
    if($json->{'status'}==OK){
        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        return $lat.','.$long;
        
    }
    else
    {
        return "0";
    }
    
}


function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}

function getStartAndEndDate($start_date,$week, $year)
{ //echo "start date--".$start_date;

    if(date("n",strtotime($start_date))==1 && $week == 53)
    {
      $year = $year - 1;

    }
    
    $time = strtotime("1 January $year", time());
    $day = date('w', $time);
    $time += ((7*$week)-$day)*24*3600;
    $return[0] = date('Y-m-d', $time);
    //$return[0];
    $time += 6*24*3600;
    $return[1] = date('Y-m-d', $time);
   
    return $return;
}

function getWeekDatesBetweenDates($date, $enddate, &$return = array()) {
    $week = date('W', strtotime($date));
    $year = date('Y', strtotime($date));
    $from = date("Y-m-d", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
    $to = date("Y-m-d", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week
    $Edate = strtotime($enddate);
    $Sdate = strtotime($to);
    if ($Edate <= $Sdate) 
    {
        $return[] = array(0 => $from, 1 => $enddate);
        return $return;
    } 
    else 
    {
        $return[] = array(0 => $from, 1 => $to);
        $to = date("Y-m-d", strtotime("$to +1days")); //Returns the date of monday in week
        getWeekDatesBetweenDates($to, $enddate, $return);
    }
     return $return;
}

function getTotalDaysBetweenDates($from_date, $to_date) {
    $now = strtotime($from_date);
    $your_date = strtotime($to_date);
    $datediff = $your_date - $now;
    return floor($datediff / (60 * 60 * 24));
}
function getMonthDatesBetweenDates($start_date, $end_end) {
    $start  = strtotime($start_date);
    $end    = strtotime($end_end); 

    $months = array();
     $count=1;
    for ($i = $start; $i <= $end; $i = get_next_month($i)) 
    {
        if($count==1)
        {
            $temp_date = $start_date;
        }else
        {
          $temp_date = date('Y-m-01', $i);  
        }
       
        $months[] = array($temp_date,date("Y-m-t", strtotime($temp_date)));
        $count++; 
    }
     $arr_last_index = count($months)-1;
     $months[$arr_last_index][1] = $end_end;

    return $months; 
}

function getAllWeeksDate($start_date,$end_date)
{
  
    //Get the weeks date from start date and end date
    $startWeekNo = date("W",strtotime($start_date)); 
    $endWeekNo   = date("W",strtotime($end_date));
    $week_Array = array();
   
    for($i=-3;$i<=20;$i++)
    {
        $week = getStartAndEndDate($start_date,date("W",strtotime($start_date)),date("Y",strtotime($start_date)));
        if($i==$startWeekNo)
        {
            $week[0] = $start_date;
        }
        if($i==$endWeekNo)
        {
            $week[1] = $end_date;
        }

        $start_date = date('Y-m-d', strtotime('+1 day', strtotime($week[1])));
        $week_Array[] = $week;

    }
    return $week_Array;  
}

function get_date_by_days($days) {
    return date('Y-m-d', strtotime('-' . $days . ' days'));
}

function get_next_month($tstamp) {
    return (strtotime('+1 months', strtotime(date('Y-m-01', $tstamp)))); 
}

function getAllMonthDate($start_date, $end_end)
{
    $start  = strtotime($start_date);
    $end    = strtotime($end_end); 

    $months = array();
     $count=1;
    for ($i = $start; $i <= $end; $i = get_next_month($i)) 
    {
        if($count==1)
        {
            $temp_date = $start_date;
        }else
        {
          $temp_date = date('Y-m-01', $i);  
        }
       
        $months[] = array($temp_date,date("Y-m-t", strtotime($temp_date)));
        $count++; 
    }
     $arr_last_index = count($months)-1;
     $months[$arr_last_index][1] = $end_end;

    return $months; 
}

function get_id_from_title_url($data)
{ 
   
    if(isset($data['urlTitle']))
    {
    if(isset($data['parentId'])){
        $getId=select_mongo($data['table'],array('urlTitle'=>$data['urlTitle'],'parentId'=>$data['parentId']),array('_id'));
        $getId=add_id($getId);
    }
    else
    {
        $getId=select_mongo($data['table'],array('urlTitle'=>$data['urlTitle']),array('_id'));
        $getId=add_id($getId);
    }
    
   if(!$getId[0]['id']){ 
   echo "<script>window.location='".site_url()."404';</script>"; 
  
   }else{ return $getId[0]['id'];  }
   
    }
    else{
        return false;
    }
}

function get_title_from_id($data)
{
  $getId=select_mongo($data['table'],array('_id'=>new MongoId($data['id'])),array('urlTitle'));
  $getId=add_id($getId);
  return $getId[0]['urlTitle'];
}

function sanitize_title($data)
{
  $check=check_key_available($data,array('title','dbField','table'));
  if($check['success']=='true')
  {
    $urlTitle=$data['title'];
    $dbField=$data['dbField'];
    $table=$data['table'];
    
    $sanitizedTitle=str_replace(array(' ','&','/','+','%','@'), array('-','-','','','','-'), trim($urlTitle));
    
    $sanitizedTitleTemp=$sanitizedTitle;
    $totalCounts=count_mongo($table,array($dbField=>$urlTitle));
    $totalCountsTemp=count_mongo($table,array('urlTitleTemp'=>$sanitizedTitleTemp));
    if($totalCountsTemp>0){
      $sanitizedTitle=$sanitizedTitle."-".sprintf("%02d", $totalCountsTemp);
    }
    return array('sanitizedTitle'=>$sanitizedTitle,'urlTitleTemp'=>$sanitizedTitleTemp);
  }
  else
  {
    return $check;
  }
}

function update_user_title($table)
{
  $selectUser=select_mongo($table,array(),array('title'));
  $userTitle=add_id($selectUser);
  foreach($userTitle as $title)
  {
      $sanitizedTitle=sanitize_title(array('table'=>$table,'title'=>$title['title'],'dbField'=>'title'));
      
      update_mongo($table,array('urlTitle'=>$sanitizedTitle['sanitizedTitle'],'urlTitleTemp'=>$sanitizedTitle['urlTitleTemp']),array('_id'=>new MongoId($title['id'])));
  }
}
  //print_r($getUser);
function get_curl_cron_response($url,$postData)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
function get_lastmonth_date($num,$value = 0)
{
    if($value)
    {
        $end_date = date("Y-m-d");
        $start_date = strtotime(date("Y-m-d", strtotime($end_date)) ."-". $num."months");
        $start_date = date("Y-m-d",$start_date);
        return array('start_date'=>$start_date,'end_date'=>$end_date);
    }
    else
    {
        //$num = 2;
        $a=date("Y-m-d");
        $date = new DateTime($a);
        $date->modify('-'.$num.'month');
        //echo $date->format('Y-m-t'); // 2016-04-30
        $start_date = $date->format('Y-m-01');
        $end_date = date("Y-m-t", strtotime("last day of previous month"));
        return array('start_date'=>$start_date,'end_date'=>$end_date);
    }
}
function get_lastweek_date($num,$value = 0)
{
    if($value)
    {
        $num = $num*7;
        $end_day = date("Y-m-d");
        $start_day = strtotime(date("Y-m-d", strtotime($end_day)) ."-". $num."days");
        $start_day = date("Y-m-d",$start_day);
        return array('start_day'=>$start_day,'end_day'=>$end_day);
    }
    else
    {
        $num++;
        $start = date( "Y-m-d", strtotime("-".$num." weeks sunday"));
         $end = date( "Y-m-d", strtotime("-1 weeks sunday"));
         //echo $start . ' - ' . $end;
         return array('start_day'=>$start,'end_day'=>$end);
    }
}
function generate_barcode($text,$code_type="code128",$title="",$size="40",$width_scale=1.0,$orientation="horizontal"){
        global $media_url;
        if($title==""){
            $title = $text;
        }
        // Get pararameters that are passed in through $_GET or set to the default value
        // Translate the $text into barcode the correct $code_type
        if(strtolower($code_type) == "code128")
        {
            $chksum = 104;
            // Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for($X = 1; $X <= strlen($text); $X++)
            {
                $activeKey = substr( $text, ($X-1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum=($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

            $code_string = "211214" . $code_string . "2331112";
        }
        elseif(strtolower($code_type) == "code39")
        {
            $code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

            // Convert to uppercase
            $upper_text = strtoupper($text);

            for($X = 1; $X<=strlen($upper_text); $X++)
            {
                $code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
            }

            $code_string = "1211212111" . $code_string . "121121211";
        }
        elseif(strtolower($code_type) == "code25")
        {
            $code_array1 = array("1","2","3","4","5","6","7","8","9","0");
            $code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

            for($X = 1; $X <= strlen($text); $X++)
            {
                for($Y = 0; $Y < count($code_array1); $Y++)
                {
                    if(substr($text, ($X-1), 1) == $code_array1[$Y])
                        $temp[$X] = $code_array2[$Y];
                }
            }

            for($X=1; $X<=strlen($text); $X+=2)
            {
                $temp1 = explode( "-", $temp[$X] );
                $temp2 = explode( "-", $temp[($X + 1)] );
                for($Y = 0; $Y < count($temp1); $Y++)
                    $code_string .= $temp1[$Y] . $temp2[$Y];
            }

            $code_string = "1111" . $code_string . "311";
        }
        elseif(strtolower($code_type) == "codabar")
        {
            $code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
            $code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

            // Convert to uppercase
            $upper_text = strtoupper($text);

            for($X = 1; $X<=strlen($upper_text); $X++)
            {
                for($Y = 0; $Y<count($code_array1); $Y++)
                {
                    if(substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
                        $code_string .= $code_array2[$Y] . "1";
                }
            }
            $code_string = "11221211" . $code_string . "1122121";
        }

        // Pad the edges of the barcode
        $code_length = 10;
        for($i=1; $i <= strlen($code_string); $i++)
            $code_length = $code_length + (integer)(substr($code_string,($i-1),1));

        if(strtolower($orientation) == "horizontal")
        {
            $img_width = $code_length * $width_scale;
            $img_height = $size;
        }
        else
        {
            $img_width = $size;
            $img_height = $code_length * $width_scale;
        }
        
        $image = imagecreate($img_width, $img_height + 20);
        $black = imagecolorallocate ($image, 0, 0, 0);
        $white = imagecolorallocate ($image, 255, 255, 255);

        imagefill( $image, 0, 0, $white );

        $location = 5;
        for($position = 1 ; $position <= strlen($code_string); $position++)
        {
            $cur_size = $location + ( substr($code_string, ($position-1), 1) );
            if(strtolower($orientation) == "horizontal")
                imagefilledrectangle( $image, $location * $width_scale, 0, $cur_size * $width_scale, $img_height, ($position % 2 == 0 ? $white : $black) );
            else
                imagefilledrectangle( $image, 0, $location * $width_scale, $img_width, $cur_size * $width_scale, ($position % 2 == 0 ? $white : $black) );
            $location = $cur_size;
        }
        
          imagestring($image, 5, 4, $img_height, $title, $black);
        
        // Draw barcode to the screen
        ob_start();
        imagepng($image);
        imagedestroy($image);
        $image1 = ob_get_clean();
        file_put_contents($media_url."images/barcode-".$text.".png", $image1);
        }
function check_user_permission_with_redirect($mid,$smid)
{
    global $site_url;
    $url_to_redirect=$site_url."admin/access_denied";
    $status=get_module_status(array('name'=>$mid,'id'=>''));
    if($status)
    {
        $permissionarr=$_SESSION['user']['permission'];
        if(!isset($permissionarr[$mid])){
           url_redirect($url_to_redirect);
        }
        if(!isset($permissionarr[$mid][$smid]))
        {
            url_redirect($url_to_redirect);
        }else{
            return true;
        }
    }
    else
    {
       url_redirect($url_to_redirect);
    }
}

function nikky_curl_post_execute($path,$params)
{
   $post_data=$params;
   //print_r($post_data);die;
   //$url="https://api.stripe.com/v1/coupons";
    $url = $path;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));   
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $result = curl_exec($ch);
    curl_close($ch);
    if($result!="" && !is_array($result)){
        return json_decode($result,'ARRAY_A');
    }else{
        return $result;
    }
}

function check_internet_connection($sCheckHost = 'www.google.com') 
{
    return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
}

function send_data_to_server_for_verification($postData)
{
    // SET URL HERE FOR LICENSE INFORMATION
    $url ="http://111.93.125.78/RPA/webservices/add_customer_license_information";
    $ch = curl_init(); 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
 
    $output=curl_exec($ch);
    curl_close($ch);
    return $output;
}

function stripAllFields(&$fields) {
    foreach ($fields as $key => $value) {
        if (is_array($fields[$key])) {
            stripAllFields($fields[$key]);
        } else {
            $dataType = gettype($value);
            $value = preg_replace('/[^A-Za-z0-9\-_[]{}"\'#,:]/', '', preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', html_entity_decode($value)));
            $strRep = array('%', '<', '>');
            if($dataType == 'integer') {
                $fields[$key] = (integer) str_replace($strRep, "", strip_tags($value));
            } else {
                $fields[$key] = str_replace($strRep, "", strip_tags($value));
            }
        }
    }
}

?>
