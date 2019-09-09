<?php
include("../database.php");
include("../class/auto_mail.php");
include_once('GCM.php');
$auto_mail=new auto_mail1(3);

$action=$auto_mail->get_current_action();

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
        
        $customer_id=$row->customer_id;
        $cdata=$final_data['jsondata']['customerdata'];
        
        $logo="http://www.pyksaas.com/pyksaasfiles/institute_images/".$cdata['logo'];
        $name=$cdata['name'];
        
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
        if($event_id==4 || $event_id=='Course Update' || $event_id==11 || $event_id==5 )
        { 
            
            
            if($row->crs_id!="")
            {
                $course_id=$row->crs_id;
                
                $user_enr_course_details = $final_data['jsondata']['coursedata']['user_enr_course_details'];
                
    
                $course_data = $final_data['jsondata']['coursedata']['course_data'];
                
                
                $course_name = $course_data['name'];
                
                $course_start_date = $course_data['start_date'];
                $course_end_date = $course_data['end_date'];
                $course_description = $course_data['description'];
                $course_summary .='<table  height="180" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; border:1px solid #ccc; padding:15px;"><col width="64" span="3" /><col width="73" /><col width="64" span="3" /><tr><td height="39" colspan="4" align="center" valign="middle" style="border-bottom:1px solid #ccc;"><strong>Course summary</strong></td></tr>';
                
                $course_summary .='<tr><td height="44" colspan="3" style="border-bottom:1px solid #ccc;"><strong>Course Name</strong> :'.$course_name.'</td><td width="219" style="border-bottom:1px solid #ccc;"></td></tr>';
                $course_summary .='<tr><td height="46" colspan="3" style="border-bottom:1px solid #ccc;"><strong>Start Date </strong>:'.$course_start_date.'</td><td style="border-bottom:1px solid #ccc;"><strong>End Date</strong>:'.$course_end_date.'</td></tr>';
                $course_summary .='<tr><td height="49" colspan="4"><strong>Description</strong> :'.$course_description.'</td></tr></table>';

                $course_details .='<table  cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; border:1px solid #ccc; padding:15px;"><col width="64" span="3" /><col width="73" /><col width="64" span="3" /><tr><td height="40" colspan="7" align="center" style="border-bottom:1px solid #ccc;"><strong>Course Details</strong></td></tr>';
                $course_details .='<tr><td height="38" colspan="7" style="border-bottom:1px solid #ccc;">Course Name :'.$course_data['name'].'</td></tr>';
                $course_details .='<tr><td height="40" colspan="3" style="border-bottom:1px solid #ccc;">Start Date :'.$course_data['start_date'].'</td><td colspan="4" style="border-bottom:1px solid #ccc;">End Date : '.$course_data['end_date'].'</td></tr>';
                $course_details .='<tr><td height="36" colspan="7" style="border-bottom:1px solid #ccc;">Description :'.$course_data['description'].'</td></tr>';
                $course_pdf=$final_data['jsondata']['coursedata']['course_pdf'];
                
                        
                $m=$k=$n=0;
                for($j=0;$j<sizeof($course_pdf);$j++)
                {
                    if($course_pdf[$j]['type']=='pdf')
                    {
                        if($k==0)
                        {
                            $course_details .='<tr><td height="46" colspan="7" align="center" style="border-bottom:1px solid #ccc;"><strong>PDFs</strong></td></tr>';                         $course_details .='<tr><td height="46" style="border-bottom:1px solid #ccc;">PDF'.($j+1).'</td><td colspan="6" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['name'].'</td></tr>';
                        }
                        {
                             $course_details .='<tr><td height="50" style="border-bottom:1px solid #ccc;">PDF'.($j+1).'</td><td colspan="6" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['name'].'</td></tr>';
                        }
                        $k++;
                    }
                    else if($course_pdf[$j]['type']=='test')
                    {
                        if($m==0)
                        {
                            $course_details .='<tr><td height="41" colspan="7" align="center" style="border-bottom:1px solid #ccc;"><strong>Tests</strong></td></tr>';
                            $course_details .='<tr><td height="44" colspan="2" style="border-bottom:1px solid #ccc;">Test Name</td><td width="120" style="border-bottom:1px solid #ccc;"></td><td width="176" style="border-bottom:1px solid #ccc;">Start date</td><td colspan="3" style="border-bottom:1px solid #ccc;">End Date</td></tr>';
                            $course_details .='<tr><td height="41" colspan="2" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['name'].'</td><td style="border-bottom:1px solid #ccc;"></td><td style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['start_date'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['end_date'].'</td></tr>';
                        }
                        else
                        {
                             $course_details .='<tr><td height="41" colspan="2" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['name'].'</td><td style="border-bottom:1px solid #ccc;"></td><td style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['start_date'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['end_date'].'</td></tr>';
                             $course_details .='<tr><td width="69"></td><td width="86"></td><td></td><td></td><td width="1"></td><td width="7"></td><td width="131"></td></tr>';
                        }
                        $m++;
                    }
                    else
                    {
                        if($n==0)
                        {
                            $course_details .='<tr><td height="47" colspan="7" align="center" style="border-bottom:1px solid #ccc;"><strong>Test Groups</strong></td></tr>';
                            
                            $course_details .='<tr><td height="43" colspan="7" style="border-bottom:1px solid #ccc;"><strong>Test Group Name : '.$course_pdf[$j]['name'].'</strong></td></tr>';
                            
                            $course_details .='<tr><td height="44" colspan="3" style="border-bottom:1px solid #ccc;">Start date : '.$course_pdf[$j]['start_date'].'</td><td colspan="4" style="border-bottom:1px solid #ccc;">End Date : '.$course_pdf[$j]['end_date'].'</td></tr>';
                             $course_details .='<tr><td height="46" colspan="7" style="border-bottom:1px solid #ccc;"><strong>Test details</strong></td></tr>'; 
                             $course_details .='<tr><td height="38" colspan="2" style="border-bottom:1px solid #ccc;">Test name</td><td style="border-bottom:1px solid #ccc;"></td><td style="border-bottom:1px solid #ccc;">Start Date</td><td colspan="3" style="border-bottom:1px solid #ccc;">End Date</td></tr>';
                            $tests=$course_pdf[$j]['tests'];
                            for($i=0;$i<sizeof($tests);$i++)
                            {
                               
                               
                                $course_details .='<tr><td height="42" colspan="2" style="border-bottom:1px solid #ccc;">'.$tests[$i]['name'].'</td><td style="border-bottom:1px solid #ccc;"></td><td style="border-bottom:1px solid #ccc;">'.$tests[$i]['start_date'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['end_date'].'</td></tr>';
                            } 
                        }
                        else
                        {
                           $course_details .='<tr><td height="43" colspan="7" style="border-bottom:1px solid #ccc;"><strong>Test Group Name : '.$course_pdf[$j]['name'].'</strong></td></tr>';
                            
                            $course_details .='<tr><td height="44" colspan="3" style="border-bottom:1px solid #ccc;">Start date : '.$course_pdf[$j]['start_date'].'</td><td colspan="4" style="border-bottom:1px solid #ccc;">End Date : '.$course_pdf[$j]['end_date'].'</td></tr>';
                             $course_details .='<tr><td height="46" colspan="7" style="border-bottom:1px solid #ccc;"><strong>Test details</strong></td></tr>';
                            $tests=$course_pdf[$j]['tests'];
                            for($i=0;$i<sizeof($tests);$i++)
                            {
                                
                                $course_details .='<tr><td height="42" colspan="2" style="border-bottom:1px solid #ccc;">'.$tests[$i]['name'].'</td><td style="border-bottom:1px solid #ccc;"></td><td style="border-bottom:1px solid #ccc;">'.$tests[$i]['start_date'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;">'.$course_pdf[$j]['end_date'].'</td></tr>';
                                $course_details .='<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                            }
                            $k++;
                        }
                    }
                }
            }
            echo $row->crs_id."hekl".$row->test_id;    
            if($row->test_id != "")
            {
                $test_id=$row->test_id;
                $crs_id=$row->crs_id;
                $new_test_details=$final_data['jsondata']['testdata'];
                
                
                $test_summary = '<table width="535" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; border:1px solid #ccc; padding:15px;"><col width="64" span="6" /><tr><td height="39" colspan="5" align="center" style="border-bottom:1px solid #ccc;"><strong>Test summary</strong></td></tr>';
                $test_summary .= '<tr><td width="282" height="35" style="border-bottom:1px solid #ccc;"><strong>Course Name</strong> : '.$user_enr_course_details[0]['name'].'</td><td width="246" colspan="3" style="border-bottom:1px solid #ccc;"></td></tr>';
                $test_summary .= '<tr><td height="34" style="border-bottom:1px solid #ccc;"><strong>Test Name</strong> : '.$new_test_details[0]['testname'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;"><strong>Attempted On </strong>: '.$new_test_details[0]['date'].'</td></tr>';
                $test_summary .= '<tr><td height="36" style="border-bottom:1px solid #ccc;"><strong>Marks</strong> : '.$new_test_details[0]['marks'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;"><strong>Average Marks</strong> : '.$new_test_details[0]['avg_marks'].'</td></tr>';
                $test_summary .= '<tr><td height="37" ><strong>Grade</strong> : '.$new_test_details[0]['grade'].'</td><td colspan="3"></td></tr></table>';
                
                $test_details = '<table cellspacing="0" cellpadding="0"  style="font-family:Arial, Helvetica, sans-serif; border:1px solid #ccc; padding:15px;"><col width="64" span="6" /><tr><td height="43" colspan="5" align="center" style="border-bottom:1px solid #ccc;"><strong>Test Details</strong></td></tr>';
                $test_details .= '<tr><td width="178" height="37" style="border-bottom:1px solid #ccc;">Course Name : '.$user_enr_course_details[0]['name'].'</td><td width="268" colspan="3" style="border-bottom:1px solid #ccc;"></td></tr>';
                $test_details .= '<tr><td height="42" style="border-bottom:1px solid #ccc;">Test Name :'.$new_test_details[0]['testname'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;">Attempted On :'.$new_test_details[0]['date'].'</td></tr>';
                $test_details .= '<tr><td height="41" style="border-bottom:1px solid #ccc;">Marks : '.$new_test_details[0]['marks'].'</td><td colspan="3" style="border-bottom:1px solid #ccc;">Average Marks : '.$new_test_details[0]['avg_marks'].'</td></tr>';
                $test_details .= '<tr><td height="39" colspan="5" style="border-bottom:1px solid #ccc;">Grade : '.$new_test_details[0]['grade'].'</td></tr>';
                $test_details .= '<tr><td height="45" colspan="5" align="center" style="border-bottom:1px solid #ccc;"><strong>Subject-wise Marks</strong></td></tr>';
                $test_details .= '<tr><td height="394" colspan="5" align="center" style="border-bottom:1px solid #ccc;"><table width="413" border="0"><tr><td width="149" height="42" style="border-bottom:1px solid #ccc;"><strong>Subject Name</strong></td><td width="96" style="border-bottom:1px solid #ccc;"><strong>Marks</strong></td><td width="154" style="border-bottom:1px solid #ccc;"><strong>Average Marks</strong></td></tr>';
                $sub_name=explode(",",$new_test_details[0]['sub_name']);
                $sub_id=explode(",",$new_test_details[0]['sub_id']);
                $sub_marks=explode(",",$new_test_details[0]['su_mark']);
                $sub_avg_marks=explode(",",$new_test_details[0]['su_avg_mark']);
                $sub_topic=explode(",",$new_test_details[0]['sub_topic']);
                $topic_name=explode(",",$new_test_details[0]['topic_name']);
                $topic_marks=explode(",",$new_test_details[0]['to_mark']);
                $topic_avg_marks=explode(",",$new_test_details[0]['to_avg_mark']);
                for($j=0;$j<sizeof($sub_id);$j++)
                {
                    $test_details .= '<tr><td height="35" >'.$sub_name[$j].'</td><td>'.$sub_marks[$j].'</td><td>'.$sub_avg_marks[$j].'</td></tr>';
                    $test_details .= '<tr><td height="133" colspan="3" align="center"><table width="369" border="0"  style="font-family:Arial, Helvetica, sans-serif; border:1px solid #ccc; padding:15px;" ><tr style="border-bottom:1px solid #ccc;"><td height="40" colspan="3" align="center"><strong>Topic wise Marks</strong></td></tr>';
                    $test_details .= '<tr><td width="126" height="45" style="border-bottom:1px solid #ccc;">Name</td><td width="103" style="border-bottom:1px solid #ccc;">Marks</td><td width="126" style="border-bottom:1px solid #ccc;">Average Marks</td></tr><tr>';

                    for($l=0;$l<sizeof($sub_topic);$l++)
                    { 
                        if($sub_topic[$l]==$sub_id[$j])
                        {
                            $test_details .= '<td height="42" style="border-bottom:1px solid #ccc;">'.$topic_name[$l].'</td><td style="border-bottom:1px solid #ccc;">'.$topic_marks[$l].'</td><td style="border-bottom:1px solid #ccc;">'.$topic_avg_marks[$l].'</td></tr>';
                        } 
                    }
                    $test_details .= '</table></td></tr>';
                }
                $test_details .= '</table></td></tr></table>';
            }
            if($row->job_id!="")
            {
                
                $jobdata=$final_data['jsondata']['jobdata'];
                 
                $job_details .="Type = ".$jobdata['type'];
                $job_details .="<br>Work = ".$jobdata['work'];
                $job_details .="<br>Date Time = ".$jobdata['date']." ".$jobdata['time'];
                foreach($jobdata['topic'] as $td)
                {
                     $job_details .="<br>Topic =".$td;
                }
                $job_summary=$job_details;
            }
        }
        else if($event_id==1)
        {
            
        }
        else
        {
                   
        }
        
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
                        $temp_desc=base64_decode($templaetarray[$t]['temp_desc']);
                    }
                }
                
                $mtemp_desc="";
                $mtemplaetarray=$final_data['jsondata']['mtemplatedata'];
            
                for($t=0;$t<sizeof($mtemplaetarray);$t++)
                {
                    if($mtemplaetarray[$t]['type']=="email")
                    {
                        $mtemp_desc=base64_decode($mtemplaetarray[$t]['temp_desc']);
                    }
                }
                if($final_data['datasource']=="url")
                {           
                    echo "you are here";
                    
                    echo $a=$final_data['jsondata']['customer_id'];
                    $b=$final_data['jsondata']['event_id'];
                    echo $c=json_encode($final_data['jsondata']['users']);
                    echo $response = get_web_page("$final_data[url]?A=$a&B=$b&C=$c");//ek bar
                    $utl_data = json_decode($response,true);
                    
                  
                    for($i=0;$i<sizeof($utl_data['jsondata']['userdata']);$i++)
                    {
                        
                        $pass=base64_decode($utl_data['jsondata']['userdata'][$i]['enc_pwd']);
                         
                        $sname=$utl_data['jsondata']['userdata'][$i]['sname'];
                        $fname=$utl_data['jsondata']['userdata'][$i]['fname'];
                        $mname=$utl_data['jsondata']['userdata'][$i]['mname'];
                        $email=$utl_data['jsondata']['userdata'][$i]['email'];
                        $username=$utl_data['jsondata']['userdata'][$i]['username'];
                        $gender=$utl_data['jsondata']['userdata'][$i]['gender'];
                        $dob=$utl_data['jsondata']['userdata'][$i]['dob'];
                        
                        $last_login=$utl_data['jsondata']['userdata'][$i]['last_login'];

                        $to=$utl_data['jsondata']['too'];
                    
                        $string=array("[sname]","[fname]","[mname]","[email]","[username]","[password]","[gender]","[dob]","[branch]","[last_login]","[registration_date]","[parent_email]","[long_term_goal]","[short_term_goal]","[current_sat]","[previous_sat]","[gpa]","[reward_points]","[done_qustion]","[left_qustion]","[summary_score]","[detailed_score]","[score_with_avg]","[test_date]","[course_summary]","[course_details]","[course_name]","[test_details]","[test_summary]","[job_details]");
                        $replace=array("$sname","$fname","$mname","$email","$username","$pass","$gender","$dob","testing","$last_login","testing","testing","testing","testing","testing","testing","testing","testing","testing","testing","$data","$data","$data","$test_date","$course_summary","$course_details","$course_name","$test_details","$test_summary","$job_details");
                        
                        echo "<br /><br />////////////////rplaced template////////////<br /><br />";
                        
                        echo $replace_template=str_replace($string,$replace,$temp_desc)."<br /><br />";
                        $replace_template=$header."".$replace_template."".$footer;
                        echo $subject=$final_data['jsondata']['eventdata']['subject'];
                        
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
                    
                    echo $mreplace_template=str_replace($string,$replace,$mtemp_desc)."<br /><br />";
                    $mreplace_template=$header."".$mreplace_template."".$footer;
                    
                    $account=$final_data['account'];
                    foreach($final_data['to'] as $to)
                    {
                        $ismail=$auto_mail->send_email($to,$replace_template,$subject,$account);
                        $ismail=json_decode($ismail,true);
                        sleep(2);
                    }
                    
                    
                    
                    foreach($final_data['mto'] as $mto)
                    {
                        $ismail=$auto_mail->send_email($mto,$mreplace_template,$subject,$account);
                        $ismail=json_decode($ismail,true);
                        sleep(2);
                    }
                    
                }  
            } 
            else if(in_array("sms",$final_data['notification']['type']) || $final_data['notification']['type']=="sms")
            {
                
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