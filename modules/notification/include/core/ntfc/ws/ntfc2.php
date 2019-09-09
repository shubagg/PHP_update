<?php


include("../database.php");

//$data=json_decode(stripcslashes($_POST['jsondata']),true);
function send_push($registatoin_ids,$message)
{
    define( 'API_ACCESS_KEY', 'AIzaSyDRB-tY9bYCCfbeHumHWxO3DfDQM5ycQY8' );
    $registrationIds = array($registatoin_ids);
   
    // prep the bundle
    $msg = array
    (
    'message' => $message
    
    );
    
    $fields = array
    (
    'registration_ids' => $registrationIds,
    'data'	 => $msg
    );
    print_r($fields);
    $headers = array
    (
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
    );
    
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    echo $result = curl_exec($ch );
    curl_close( $ch );
}


$maindata=json_decode(str_replace("\\",'',trim($_POST['jsondata'])),true);

$tm=time();
$l=sizeof($maindata);
for($i=0;$i<$l;$i++)
{
    $len=sizeof($maindata[$i]['uid1']);
    $data=$maindata[$i];
 /*   $q="CREATE TABLE IF NOT EXISTS `notification_$data[customer_id]` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `string_id` int(11) NOT NULL,
          `moduleid` int(11) NOT NULL,
          `eventid` int(11) NOT NULL,
          `uid1` int(11) NOT NULL,
          `uid2` int(11) NOT NULL,
          `uid3` int(11) NOT NULL,
          `uid4` int(11) NOT NULL,
          `uid5` int(11) NOT NULL,
          `url1` text NOT NULL,
          `url2` text NOT NULL,
          `seen` int(11) NOT NULL,
          `download` int(11) NOT NULL,
          `ms` text NOT NULL,
          `status` int(11) NOT NULL,
          PRIMARY KEY (`id`)
        )";
    mysql_query($q);*/
    
    if($data['used_for']="desk")
    {
        $dwn=1;
    }
    else
    {
        $dwn=0;
    }
    
    
    $c=0;
    foreach($maindata[$i]['uid1'] as $userid)
    {
        $str=stripcslashes("insert into notification_$data[customer_id] (string_id,moduleid,eventid,uid1,uid2,uid3,uid4,uid5,url1,url2,seen,download,ms,status) values('$data[stringid]','$data[moduleid]','$data[eventid]','$userid','$data[uid2]','$data[uid3]','$data[uid4]','','$data[url1]','$data[url2]','0','$dwn','$tm','0')");
        
        

        $ins_qry2=mysql_query($str);
        
        for($j=0;$j<sizeof($data['uid5'][$c]);$j++)
        {
            $uid=$data['uid5'][$c][$j];
            $str1=stripcslashes("insert into notification_$data[customer_id] (string_id,moduleid,eventid,uid1,uid2,uid3,uid4,uid5,url1,url2,seen,download,ms,status) values('$data[mstringid]','$data[moduleid]','$data[eventid]','$uid','$data[uid2]','$data[uid3]','$data[uid4]','$data[uid5]','$data[url1]','$data[url2]','0','$dwn','$tm','0')");
            $ins_qry=mysql_query($str1);
            if($ins_qry)
            {
                $fet=mysql_query("select id from triggers_$data[customer_id] where module_id=$data[moduleid] and event_id=$data[eventid] and type='push'");
                if(mysql_num_rows($fet)>0)
                {
                    $gcmfet=mysql_query("select gcmno from user_$data[customer_id] where id=$userid");
                    $gcmget=mysql_fetch_object($gcmfet);
                    
                    $sfet=mysql_query("select txt from strings where id=$data[stringid]");
                    $sget=mysql_fetch_object($sfet);
                    //push code start
                    
                    $arr=array("moduleid"=>$data['moduleid'],"eventid"=>$data['eventid'],"uid1"=>$uid,"uid2"=>$data['uid2'],"uid3"=>$data['uid3'],"uid4"=>$data['uid4'],"uid5"=>"","txt"=>$sget->txt);
                
                    send_push($gcmget->gcmno,$arr);
                    
                    //ends here
                }
            }
            else
            {
                echo mysql_error();
            }
        }
        $c++;
        
        if(!$ins_qry2)
        {
            echo $err= mysql_error();
            $modulename="Notification";
            $event="Add";
            $errorstring=$err;
            $timedate=date("Y-m-d h:i:s");
            $filename="ntfc.php";
            $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
            
            $file=fopen("errorlogfile.txt","a");
            fwrite($file,"$data");
            fclose($file);
        }
        else
        {
            
            
            
            //push send code
            $fet=mysql_query("select id from triggers_$data[customer_id] where module_id=$data[moduleid] and event_id=$data[eventid] and type='push'");
            if(mysql_num_rows($fet)>0)
            {
                $gcmfet=mysql_query("select gcmno from user_$data[customer_id] where id=$userid");
                $gcmget=mysql_fetch_object($gcmfet);
                
                $sfet=mysql_query("select txt from strings where id=$data[stringid]");
                $sget=mysql_fetch_object($sfet);
                //push code start
                $arr=array("moduleid"=>$data['moduleid'],"eventid"=>$data['eventid'],"uid1"=>$userid,"uid2"=>$data['uid2'],"uid3"=>$data['uid3'],"uid4"=>$data['uid4'],"uid5"=>"","txt"=>$sget->txt);
                
                send_push($gcmget->gcmno,$arr);
                //ends here
            }
        }
    }
}
mysql_close($link1);
    $vars = array_keys(get_defined_vars());
    foreach($vars as $var)
    {
        unset($$var);
    }
?>
