<?php
include("../../../../../../global.php");
$logo = site_url() . "company/media/logo.png";
$companyInfo = get_company_data();
if (!empty($companyInfo)) {
    $logo = site_url() . "company/" . $companyInfo['cid'] . "/" . $companyInfo['company_logo'];
}
$newBaseUrl = site_url() . "admin/";
$attachedUrl = server_path()."uploads/".$companyId."/media/others";
$auto_mail = new auto_mail1(3);
$starttime = $_POST['starttime'];
$date =date("Y");
$action = $auto_mail->get_current_action($starttime);
if (empty($action)) {
    echo "2";
    exit();
}

$sender = "teamerge@xeliumtech.com";
foreach ($action as $row) {

    if ($row['servername'] == "teammerge") {
        $json = str_replace('&quot;', '"', $row['json']);
        $jsonData = rtrim($json, "\0");
        $final_data = json_decode(str_replace("\\", '', trim($json)), true);

        $customer_id = $row['customer_id'];
        $header = "";
        $footer = "";

        $event_id = $row['event_id'];

        $module_id = $row['module_id'];
        $uid2 = $row['uid2'];
        $uid3 = $row['uid3'];
        $uid4 = $row['uid4'];
        $formName = $row['uid3'];
        $rmessage = $row['uid3'];
        $rtime = $row['uid3'];
        $JobID = $row['uid2'];
        $ticketID = $row['uid2'];
        $ticketTitle = $row['uid3'];
        $ms = date("Y"); //date('F d Y', $row['ms'] / 1000);
        $resArr = array();
        $attachedFile = $row['uid2'];
        $forgot = $ticket_summary = $order_details = $link = '';
        // include("tpl/header_tpl.php");
        //include("tpl/footer_tpl.php");
        $header = $header_tpl;
        $footer = $footer_tpl;
        switch ($row['event_id']) {
            /*case 1: //signup
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
               // include("tpl/signup_tpl.php");
                break;
            case 2: //profile update
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/profile_tpl.php");
                break;
            case 3: //Forgot password
                $link = $site_url.'ui/admin/forget?i='.base64_encode($row['user_id']).'&k='.$row['uid2'];
                //include("tpl/forgot_tpl.php");
                break;
            case 4: //Change password
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/change_tpl.php");
                break;
            case 5: //Contact Us
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/contact_tpl.php");
                break;
            case 6: //Email Subscription
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/subscribeEmail_tpl.php");
                break;
            case 7: //Blog add
                $link = '<a href='.$site_url.'ui/admin/blog/user_blog.php?id='.$row['uid2'].'>Click here</a>';
                include("tpl/blogAdd_tpl.php");
                break;
            case 8: //Blog update
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/blogUpdate_tpl.php");
                break;
            case 19: //Job Assign
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/jobAssign_tpl.php");
                break;
            case 21: //Job update
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/jobUpdate_tpl.php");
                break;
            case 27: //Forum add
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/forumAdd_tpl.php");
                break;
            case 32: //Blog Comment
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/blogComment_tpl.php");
                break;
            case 35: //Forum Comment
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/forumComment_tpl.php");
                break;
	    case 36: //Job Comment
                $link = '<a href='.$site_url.'ui/admin>Click here</a>';
                include("tpl/jobComment_tpl.php");
                break;
            default:
                # code...
                break;*/
        }
        $JobDescription = "";
        $JobTitle = "";
        $code = "";
        $ticketPriority = "";
        $ticketStatus = "";
        $ticketSeverity = "";
        $b_description = "";
        $address = "";
        $phone = "";
        $hotel_email = "";
        $from_date = "";
        $to_date = "";
        $customer_name = "";
        $contact = "";
        $user_email = "";
        $hotel_logo = "";
        $company ="";
        if (isset($row['extra_data']) && !empty($row['extra_data'])) {
            $extra_data = json_decode($row['extra_data'], true);
            if (isset($extra_data['description'])) {
                $JobDescription = $extra_data['description'];
            }
            if (isset($extra_data['title'])) {
                $JobTitle = $extra_data['title'];
            }
            if (isset($extra_data['action_done'])) {
                $ticketPriority = $extra_data['action_done'];
                $ticketStatus = $extra_data['action_done'];
                $ticketSeverity = $extra_data['action_done'];
            }
            if (isset($extra_data['b_description'])) {
                $b_description = base64_decode(str_replace(" ", "+", $extra_data['b_description']), true);
            }
            if (isset($extra_data['address'])) {
                $address = $extra_data['address'];
            }
            if (isset($extra_data['phone'])) {
                $phone = $extra_data['phone'];
            }
            if (isset($extra_data['hotel_email'])) {
                $hotel_email = $extra_data['hotel_email'];
            }
            if (isset($extra_data['from_date'])) {
                $from_date = $extra_data['from_date'];
            }
            if (isset($extra_data['to_date'])) {
                $to_date = $extra_data['to_date'];
            }
            if (isset($extra_data['customer_name'])) {
                $customer_name = $extra_data['customer_name'];
            }
            if (isset($extra_data['contact'])) {
                $contact = $extra_data['contact'];
            }
            if (isset($extra_data['user_email'])) {
                $user_email = $extra_data['user_email'];
            }
            if (isset($extra_data['hotel_image'])) {
                $hotel_image = $extra_data['hotel_image'];
            }
            if (isset($extra_data['product_title'])) {
                $product_title = $extra_data['product_title'];
            }
        }
        if (!empty($row['extra'])) {
            $extra = json_decode($row['extra'], true);
            if (isset($extra['code'])) {
                $code = $extra['code'];
            }
            if (isset($extra['description'])) {
                $JobDescription = $extra['description'];
            }
            if (isset($extra['title'])) {
                $JobTitle = $extra['title'];
            }
            if (isset($extra['action_done'])) {
                $ticketPriority = $extra['action_done'];
                $ticketStatus = $extra['action_done'];
                $ticketSeverity = $extra['action_done'];
            }
            if (isset($extra['company'])) {
                $company = $extra['company'];
            }
            if (isset($extra['lic_required'])) {
                $lic_required = $extra['lic_required'];
            }
            if (isset($extra['time_period'])) {
                $time_period = $extra['time_period'];
            }
            if (isset($extra['licenses_type'])) {
                $licenses_type = $extra['licenses_type'];
            }
            if (isset($extra['company_name'])) {
                $company = $extra['company_name'];
            }

        }
        if ($event_id == '116') {
            $messageDescription = base64_decode(str_replace(" ", "+", $uid4));
        }
        if ($final_data['jsondata']['eventdata'] != "") {
            if (in_array("email", $final_data['notification']['type']) || $final_data['notification']['type'] == "email") {
                $temp_desc = "";
                $templaetarray = $final_data['jsondata']['templatedata'];

                for ($t = 0; $t < sizeof($templaetarray); $t++) {
                    if ($templaetarray[$t]['type'] == "email") {
                        $temp_desc = base64_decode(str_replace(" ", "+", $templaetarray[$t]['temp_desc']));
                    }
                }

                $mtemp_desc = "";
                $mtemplaetarray = $final_data['jsondata']['mtemplatedata'];

                for ($t = 0; $t < sizeof($mtemplaetarray); $t++) {
                    if ($mtemplaetarray[$t]['type'] == "email") {
                        $mtemp_desc = base64_decode($mtemplaetarray[$t]['temp_desc']);
                    }
                }

                $pass = $final_data['jsondata']['userdata']['password'];
                $sname = $final_data['jsondata']['userdata']['name'];
                $email = $final_data['jsondata']['userdata']['email'];
                $username = $final_data['jsondata']['userdata']['username'];
                $business_email = $final_data['jsondata']['userdata']['business_email'];


                $string = array("[cname]", "[link]", "[name]", "[email]", "[username]", "[password]", "[forgot_details]", "[job_details]", "[contact_details]", "[user_details]", "[blog_details]", "[forum_details]", "[formName]", "[message]", "[time]", "[sender]", "[title]", "[date]", "[to]", "[JobTitle]", "[JobDescription]", "[JobID]", "[ticketID]", "[logo]", "[newBaseUrl]", "[code]", "[ticketStatus]", "[ticketTitle]", "[ticketSeverity]", "[ticketPriority]", "[b_description]", "[address]", "[phone]", "[hotel_email]", "[from_date]", "[to_date]", "[customer_name]", "[contact]", "[user_email]", "[hotel_image]", "[product_title]", "[company]", "[lic_required]", "[time_period]", "[licenses_type]", "[date]");
                $replace = array("$cname", "$link", "$sname", "$email", "$username", "$pass", "$forgot_tpl", "$job_tpl", "$contact_tpl", "$user_tpl", "$blog_tpl", "$forum_tpl", "$formName", "$rmessage", "$rtime", "$sender", "$formName", "$ms", "$email", "$JobTitle", "$JobDescription", "$JobID", "$ticketID", "$logo", "$newBaseUrl", "$code", "$ticketStatus", "$ticketTitle", "$ticketSeverity", "$ticketPriority", "$b_description", "$address", "$phone", "$hotel_email", "$from_date", "$to_date", "$customer_name", "$contact", "$user_email", "$hotel_image", "$product_title", "$company", "$lic_required", "$time_period", "$licenses_type", "$date");
                //echo "<br /><br />////////////////rplaced template////////////<br /><br />";

                if ($event_id == '116') {
                    $subject = base64_decode(str_replace(" ", "+", $uid3));
                } else {
                    $subject = base64_decode(str_replace(" ", "+", $final_data['jsondata']['eventdata']['subject']));
                }

                $replace_template = str_replace($string, $replace, $temp_desc) . "<br /><br />";
                $replace_template = $header . "" . $replace_template . "" . $footer;

                $mreplace_template = str_replace($string, $replace, $mtemp_desc) . "<br /><br />";
                $mreplace_template = $header . "" . $mreplace_template . "" . $footer;

                $account = $final_data['account'];

               // print_r($replace_template);

                $ismail = $auto_mail->update_status($row['id']);

                foreach ($final_data['to'] as $to) {
                    $mailData = array('message' => 'sending mail to -: ' . $to, 'subject' => $subject);
                    logger("3", '', $mailData, 5);
                    if ($_SERVER['HTTP_HOST'] != 'localhost:81' && $_SERVER['HTTP_HOST'] != 'localhost') {
                       if($final_data['event_id']=='305' && $companyId=='28')
                        {
                            $to =$business_email;
                            $ismail = $auto_mail->send_email_accord_accType($to, $replace_template, $subject, $account,$attachedUrl,$attachedFile);
                        }elseif($final_data['event_id']=='306') 
                        {
                            $to =$business_email;
                            $ismail = $auto_mail->send_email_accord_accType($to, $replace_template, $subject, $account,"","");
                        }
                        else
                        {
                            $ismail = $auto_mail->send_email_accord_accType($to, $replace_template, $subject, $account,"","");
                        }
                        $ismail = json_decode($ismail, true);
                        if (isset($ismail['message']) && $ismail['message'] == 'success') {
                            $result = "1";
                        } else {
                            $result = "0";
                        }
                        $errors = "";
                        if (isset($ismail['errors'])) {
                            $errors = $ismail['errors'];
                        }
                        $mailData = array('message' => $ismail['message'], 'error' => $errors);
                        logger("3", '', $mailData, 5);
                        sleep(1);
                    }

                }
                foreach ($final_data['mto'] as $mto) {
                    /*$ismail=$auto_mail->send_email_by_smtp($mto,$mreplace_template,$subject,$account);
                    $ismail=json_decode($ismail,true);
                    sleep(1);*/
                }
                if (isset($result)) {
                    echo $result;
                } else {
                    echo "0";
                }
            }
        }
    }


}
?>
