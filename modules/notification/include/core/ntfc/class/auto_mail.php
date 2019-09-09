<?php
include("PHPMailerAutoload.php");
include("class.smtp.php");
include("class.phpmailer.php");
include("class.pop3.php");

class auto_mail1
{
    var $obj = null;
    var $customer = null;

    function auto_mail1($id)
    {

    }


    function get_current_action($starttime)
    {
        $cond = array();
        $endtime = $starttime + (1 * 60 * 1000);
        $cond['status'] = '0';
        //$cond['ms']=array('$lte'=>intval($endtime),'$gte'=>intval($starttime));
        $action = select_mongo("currentAction", $cond);
        $action = add_id($action, "id");

        return $action;
    }

    function send_email($to, $body, $subject, $account)
    {
        $url = 'https://api.sendgrid.com/';
        $user = 'teamerge1';
        $pass = 'mhsxelium123$';

        $json_string = array(

            'to' => array(
                $to
            ),
            'category' => 'test_category'
        );


        $params = array(
            'api_user' => $user,
            'api_key' => $pass,
            'x-smtpapi' => json_encode($json_string),
            'to' => $to,
            'subject' => $subject,
            'html' => $body,
            'text' => 'testing body',
            'from' => 'teamerge.server@gmail.com',
        );


        $request = $url . 'api/mail.send.json';

        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);
        return $response;
        curl_close($session);


        // print everything out
        //print_r($response);
    }


    function send_email1($to, $body, $subject, $account)
    {
        $to = $to;
        $subject = $subject;

        $message = $body;


        $header = "From:creamat@creamat.com \r\n";
        //$header .= "Cc:afgh@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $retval = mail($to, $subject, $message, $header);

        if ($retval == true) {
            echo "Message sent successfully...";
        } else {
            echo "Message could not be sent...";
        }
    }

    function send_email2($to, $body, $subject, $account)
    {
        //$to =explode(",",$to);
        //$to = "manoj@xeliumtech.com";
        $subject = $subject;

        $message = $body;
        $email = $account['email'];
        $name = "Admin";


        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'teamerge.server@gmail.com';                 // SMTP username
        $mail->Password = 'teamerge.server21';                           // SMTP password
        $mail->SMTPSecure = '';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 2525;                  // TCP port to connect to

        $mail->From = $email;
        $mail->FromName = $name;
        $mail->addAddress($to);    // Add a recipient
        // Name is optional
        //$mail->addReplyTo();
        //$mail->addCC();
        //$mail->addBCC();

        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }

    }

    function send_email_by_smtp($to, $body, $subject, $account)
    {

        $message = $body;
        //    $email=$account;
        $email = 'teamerge@xeliumtech.com';
        $name = $account;
        //echo  $to;

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        //echo
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = '184.164.151.234';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = ture;                               // Enable SMTP //authentication
        $mail->Username = 'teamerge.xeliumtech';                 // SMTP username
        $mail->Password = 'teamerge123$';                  // SMTP password
        $mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';                           // TCP port to connect to

        $mail->From = $email;
        $mail->FromName = $name;
        $mail->addAddress($to);    // Add a recipient
        // Name is optional
        //$mail->addReplyTo();
        //$mail->addCC();
        //$mail->addBCC();

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        if (!$mail->send()) {
            echo "<script>alert('Message could not be sent')</script>";
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "1";
        }
    }


    function send_email_accord_accType($to, $body, $subject, $account, $path ,$fileName)
    {
        $accountInfo = $account[0];
        $type = $accountInfo['type'];
        $accName = $accountInfo['accName'];
        $from_name = $accountInfo['from_name'];
        $email = $accountInfo['email'];
        $domain = $accountInfo['domain'];
        $password = $accountInfo['password'];
        $username = $accountInfo['username'];
        $port = $accountInfo['port'];
        $url = $accountInfo['url'];
        if ($type == 'sendgrid') {
            $json_string = array(

                'to' => array(
                    $to
                ),
                'category' => 'test_category'
            );

            if($path!="")
            {
                $params = array(
                'api_user' => $username,
                'api_key' => $password,
                'x-smtpapi' => json_encode($json_string),
                'to' => $to,
                'subject' => $subject,
                'html' => $body,
                'text' => $from_name,
                'from' => $email,
                'files['.$fileName.']' => file_get_contents($path.'/'.$fileName)
                );
            }
            else
            {
                $params = array(
                'api_user' => $username,
                'api_key' => $password,
                'x-smtpapi' => json_encode($json_string),
                'to' => $to,
                'subject' => $subject,
                'html' => $body,
                'text' => $from_name,
                'from' => $email
                );
            }

            $request = $url . '/api/mail.send.json';

            // Generate curl request
            $session = curl_init($request);
            // Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
            // Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
            // Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            // Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

            // obtain response
            $response = curl_exec($session);
            return $response;
            curl_close($session);
        } else if ($type == 'smtp') {
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $domain;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP //authentication
            $mail->Username = $username;                 // SMTP username
            $mail->Password = $password;                  // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = intval($port);
            $mail->CharSet = 'UTF-8';                           // TCP port to connect to

            $mail->From = $username;
            $mail->FromName = $from_name;
            $mail->addAddress($to);    // Add a recipient
            // Name is optional
            //$mail->addReplyTo();
            //$mail->addCC();
            //$mail->addBCC();
            if($path!="")
            {
                $filePath = $path.'/'.$fileName;
                $mail->addAttachment($filePath);   
            }

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $body;

            if (!$mail->send()) {
                // echo "<script>alert('Message could not be sent')</script>";
                // echo 'Message could not be sent.';  
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                $result = array('message' => 'failed', 'errors' => $mail->ErrorInfo, 'data' => 'Message could not be sent');
            } else {
                $result = array('message' => 'success', 'data' => 'mail successfully sended');
            }
            return json_encode($result);
        }

    }

    function update_status($cur_id)
    {
        update_mongo("currentAction", array("status" => "1"), array('_id' => new MongoId($cur_id)));
    }
}

?>
