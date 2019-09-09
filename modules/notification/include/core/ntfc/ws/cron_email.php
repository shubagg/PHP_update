<?php
include("../database.php");
include("../class/auto_mail.php");
include_once('GCM.php');
$auto_mail=new auto_mail1(3);

$action=$auto_mail->get_cron_action();

function get_web_page($url) 
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content  = curl_exec($ch);
    curl_close($ch);
    return $content;
}

foreach($action as $row)
{
    if($row->servername=="pyk")
    {
        echo  $row->json;
        $final_data = json_decode(str_replace("\\",'',trim($row->json)),true);
        print_r($final_data);
        echo $customer_id=$row->customer_id;
        $cdata=$final_data['jsondata']['customerdata'];
        
        $logo="http://www.pyksaas.com/pyksaasfiles/institute_images/".$cdata['logo'];
        echo $name=$cdata['name'];
        
        $header ="";
        $header .='<table width="100%" cellpadding="0" cellspacing="0">';
        $header .='<tbody>';
        $header .='<tr>';
        $header .='<td style="padding-left:50px;padding-right:50px" bgcolor="#9c9c9c">';
        $header .='<table align="center" cellpadding="0" cellspacing="0">';
        $header .='<tbody>';
        $header .='<tr>';
        $header .='<td align="center" style="width:660px">';
        $header .='<table align="center" width="100%" cellpadding="0" cellspacing="0">';
        $header .='<tbody>';
        $header .='<tr>';
        $header .='<td>';
        $header .='<table align="center" width="100%" cellpadding="0" cellspacing="0">';
        $header .='<tbody>';
        $header .='<tr>';
        $header .='<td align="center" style="padding-bottom:40px;padding-top:40px">';
        $header .='<table width="100%" cellpadding="0" cellspacing="0">';
        $header .='<tbody>';
        $header .='<tr>';
        $header .='<td style="width:30%">';
        $header .='<a href="#" target="_blank">';
        $header .='<img src="'.$logo.'" style="border-style:none;vertical-align:top" alt="SkillPages">';
        $header .='</a>';
        $header .='</td>';
        $header .='<td style="width:70%; font-size:16px; font-weight:700">';
        $header .=$name;
        $header .='</td>';
        
        $header .='</tr>';
        $header .='</tbody>';
        $header .='</table>';
        $header .='</td>';
        $header .='</tr>';
        $header .='</tr>';
        $header .='<td   bgcolor="#dfdfdf" style="padding-top:60px;padding-right:47px;padding-bottom:50px;padding-left:47px;border-radius:3px">';
        $header .='<table width="100%" cellpadding="0" cellspacing="0">';
        $header .='<tbody>';
        $header .='<tr>';
        $header .='<td align="center" style="padding-bottom:40px;border-bottom:1px solid #d7d7d7">';
        $header .='<table width="100%" cellpadding="0" cellspacing="0">';
        $header .='<tbody>';  
        $header .=' <td align="center">';   
                                                                                                    
                                                                                                    
        $footer="";
        $footer .='</td>';
        $footer .='</tr>';
        $footer .='</tbody>';
        $footer .='</table>';
        $footer .='</td>';
        $footer .='</tr>';
        $footer .='</tbody>';
        $footer .='</table>';
        $footer .='</tbody>';
        $footer .='</td>';
        $footer .='</tr>';
        $footer .='</tbody>';
        $footer .='</table>';
        $footer .='</td>';
        $footer .='</tr>';
        $footer .='</tbody>';
        $footer .='</table>';
        $footer .='</td>';
        $footer .='</tr>';
        $footer .='<tr>';
        $footer .='<td>';
        $footer .='<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" padding="10px">';
        $footer .='<tbody><tr>';
        $footer .='<td>powered By </td>';
        $footer .='<td style="padding:0in 0in 0in 0in ; width:30%;">';
        $footer .='<img src="http://www.pyksaas.com/pyksaasfiles/images/logo.png" style="border-style:none;vertical-align:top">';
        $footer .='</td>';
        $footer .="<td>World's First O2O Corporate LMS on the Go </td>";
        $footer .='</tr></tbody>';
        $footer .='</table>';
        $footer .='</td>';
        $footer .='</tr>';
        $footer .='</tbody>';
        $footer .='</table>';
        $footer .='</td>';
        $footer .='</tr>';
        $footer .='</tbody>';
        $footer .='</table> ';
  
        $event_id=$row->event_id;
        
        $resArr = array();
        
        
        
        $data=$test_date=$course_summary = $course_details =$course_name =$test_details =$test_summary =$job_summary=$job_details="";

        
        echo $final_data['notification']['type'];
       
         
        
        if($final_data['jsondata']['eventdata']!="")
        {
            if(in_array("email",$final_data['notification']['type']) || $final_data['notification']['type']=="email")
            {
                $temp_desc="";
                $templaetarray=$final_data['jsondata']['templatedata'];
            
                for($t=0;$t<sizeof($templaetarray);$t++)
                {
                    if($templaetarray[$t]['type']=="email")
                    {
                        echo $templaetarray[$t]['temp_desc'];
                        $tempdesc=str_replace(" ","+",$templaetarray[$t]['temp_desc']);
                        echo $temp_desc=base64_decode("$tempdesc");
                    }
                }
                
                if($final_data['datasource']=="url")
                {           
                    echo "you are here";
                    
                    echo $a=$final_data['jsondata']['customer_id'];
                    echo $b=$final_data['jsondata']['event_id'];
                    echo $c=$final_data['module_id'];
                    $response = get_web_page("$final_data[url]?A=$a&B=$b&C=$c");//ek bar
                    
                    
                    $utl_data = json_decode($response,true);
                    print_r($utl_data);
                  
                    for($i=0;$i<sizeof($utl_data['jsondata']['userdata']);$i++)
                    {
                        
                        $pass=base64_decode($utl_data['jsondata']['userdata'][$i]['userinfo']['enc_pwd']);
                        
                        $uid=$utl_data['jsondata']['userdata'][$i]['userinfo']['id'];
                        $sname=$utl_data['jsondata']['userdata'][$i]['userinfo']['sname'];
                        $fname=$utl_data['jsondata']['userdata'][$i]['userinfo']['fname'];
                        $mname=$utl_data['jsondata']['userdata'][$i]['userinfo']['mname'];
                        $email=$utl_data['jsondata']['userdata'][$i]['userinfo']['email'];
                        $username=$utl_data['jsondata']['userdata'][$i]['userinfo']['username'];
                        $gender=$utl_data['jsondata']['userdata'][$i]['userinfo']['gender'];
                        $dob=$utl_data['jsondata']['userdata'][$i]['userinfo']['dob'];
                        
                        $last_login=$utl_data['jsondata']['userdata'][$i]['userinfo']['last_login'];
                        
                        $to=$email;
                        //$to="vickyrighthere@gmail.com";
                        if($event_id==6)
                        {
                            $tdl=sizeof($utl_data['jsondata']['userdata'][$i]['testdata']);
                            for($td=0;$td<$tdl;$td++)
                            {
                                $test_details .=base64_decode($utl_data['jsondata']['userdata'][$i]['testdata'][$td]);
                            }
                            
                            $test_summary=$test_details;
                            echo $res=$auto_mail->insert_notification($a,$c,$uid,'','','new','','','','',5);
                        }
                        if( $event_id==10)
                        {
                            $tdl=sizeof($utl_data['jsondata']['userdata'][$i]['testdata']);
                            for($td=0;$td<$tdl;$td++)
                            {
                                $test_details .=base64_decode($utl_data['jsondata']['userdata'][$i]['testdata'][$td]);
                            }
                            
                            $test_summary=$test_details;
                            echo $res=$auto_mail->insert_notification($a,$c,$uid,'','','new','','','','',6);
                        }
                        if($event_id==17)
                        {
                            $tdl=sizeof($utl_data['jsondata']['userdata'][$i]['coursedata']);
                            for($td=0;$td<$tdl;$td++)
                            {
                                $course_details .=base64_decode($utl_data['jsondata']['userdata'][$i]['coursedata'][$td]);
                            }
                            
                            $course_summary=$course_details;
                            echo $res=$auto_mail->insert_notification($a,$c,$uid,'','','new','','','','',7);
                        }
                        
                        
                        
                        $string=array("[sname]","[fname]","[mname]","[email]","[username]","[password]","[gender]","[dob]","[branch]","[last_login]","[registration_date]","[parent_email]","[long_term_goal]","[short_term_goal]","[current_sat]","[previous_sat]","[gpa]","[reward_points]","[done_qustion]","[left_qustion]","[summary_score]","[detailed_score]","[score_with_avg]","[test_date]","[course_summary]","[course_details]","[course_name]","[test_details]","[test_summary]","[job_details]","[test_missed_details]");
                        $replace=array("$sname","$fname","$mname","$email","$username","$pass","$gender","$dob","testing","$last_login","testing","testing","testing","testing","testing","testing","testing","testing","testing","testing","$data","$data","$data","$test_date","$course_summary","$course_details","$course_name","$test_details","$test_summary","$job_details","$test_details");
                        
                        echo "<br /><br />////////////////rplaced template////////////<br /><br />";
                        
                        echo $replace_template=str_replace($string,$replace,$temp_desc)."<br /><br />";
                        $replace_template=$header."".$replace_template."".$footer;
                        $subject=$final_data['jsondata']['eventdata']['subject'];
                        
                        $account=$final_data['account'];
                        $ismail=$auto_mail->send_email($to,$replace_template,$subject,$account);
                        $ismail=json_decode($ismail,true);
                        sleep(2);
                    }
                }
                else
                {
                    echo "heyy";
                    $pass=base64_decode($final_data['jsondata']['userdata']['enc_pwd']);
                    $sname=$final_data['jsondata']['userdata']['sname'];
                    $fname=$final_data['jsondata']['userdata']['fname'];
                    $mname=$final_data['jsondata']['userdata']['mname'];
                    $email=$final_data['jsondata']['userdata']['email'];
                    $username=$final_data['jsondata']['userdata']['username'];
                    $gender=$final_data['jsondata']['userdata']['gender'];
                    $dob=$final_data['jsondata']['userdata']['dob'];
                    //$branch=$final_data['jsondata']['userdata']['branch'];
                    $last_login=$final_data['jsondata']['userdata']['last_login'];
                    //$registeration_date=$final_data['jsondata']['userdata']['registeration_date'];
                    
                
                    $string=array("[sname]","[fname]","[mname]","[email]","[username]","[password]","[gender]","[dob]","[branch]","[last_login]","[registration_date]","[parent_email]","[long_term_goal]","[short_term_goal]","[current_sat]","[previous_sat]","[gpa]","[reward_points]","[done_qustion]","[left_qustion]","[summary_score]","[detailed_score]","[score_with_avg]","[test_date]","[course_summary]","[course_details]","[course_name]","[test_details]","[test_summary]","[job_details]");
                    $replace=array("$sname","$fname","$mname","$email","$username","$pass","$gender","$dob","testing","$last_login","testing","testing","testing","testing","testing","testing","testing","testing","testing","testing","$data","$data","$data","$test_date","$course_summary","$course_details","$course_name","$test_details","$test_summary","$job_details");
                    
                    echo "<br /><br />////////////////rplaced template////////////<br /><br />";
                    
                    echo $replace_template=str_replace($string,$replace,$temp_desc)."<br /><br />";
                    $replace_template=$header."".$replace_template."".$footer;
                    echo $subject=$final_data['jsondata']['eventdata']['subject'];
                    
                    $account=$final_data['account'];
                    foreach($final_data['to'] as $to)
                    {
                        $ismail=$auto_mail->send_email($to,$replace_template,$subject,$account);
                        $ismail=json_decode($ismail,true);
                        sleep(2);
                    }
                    
                }  
            } 
            else if(in_array("push",$final_data['notification']['type']) || $final_data['notification']['type']=="push")
            {
                $gcm = new GCM();
                echo $final_data['notification']['gcmno'];
                
                $registatoin_ids = array($final_data['notification']['gcmno']);
                // print_r($registatoin_ids);
                $message ="hello";
                $message = array("price" => $message);
                
                $result = $gcm->send_notification($registatoin_ids, $message);
                $newres = json_decode($result,true);
                $abc= $newres['results'];
                $error= $abc['0']['error'];
                if($newres['success']==1)
                {              
                    $array=array("errorstring"=> "Successfull","errorcode" => "0","status" => "OK");
                }
                else
                {
                    $array=array("errorstring"=> "$error","errorcode" => "25","status" => "false"); 
                }
                
                echo  json_encode($array);
            }
        }
    }
    
    if($row->servername=="mantis")
    {
        $resArr = array();
        function get_web_page($url) 
        {
            $options = array(
                CURLOPT_RETURNTRANSFER => true,   // return web page
                CURLOPT_HEADER         => false,  // don't return headers
                CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                CURLOPT_ENCODING       => "",     // handle compressed
                CURLOPT_USERAGENT      => "test", // name of client
                CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                CURLOPT_TIMEOUT        => 120,    // time-out on response
            ); 
        
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            $content  = curl_exec($ch);
            curl_close($ch);
            return $content;
        }
        
        if($final_data['datasource']!="inline")
        {
            $a=$row->customer_id;
            $b=$row->event_id;
            $response = get_web_page("$final_data[url]?A=$a&B=$b");
            $resArr = json_decode($response,true);
        }
    }
    
    //$ismail=$auto_mail->update_status($row->id);
}
?>