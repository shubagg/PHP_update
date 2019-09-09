<?php
class Json
{
    var $obj=null;
    var $data=null;
    Var $customer=null;
    function Json()
    {
    }

    function send_push_on_device($userId,$message)
    {
        $users = implode("|", $userId);
        //$resourceInfo = get_resource_by_id(array("id"=>$users,'fields'=>'gcm,deviceType'));
        $resourceInfo = get_resource_by_id(array("id"=>$users,'fields'=>'gcm,oldGCM,deviceType'));
        $resourceInfo = $resourceInfo['data'];
    	if(isset($message['cdata']) && $message['cdata']!='')
    	{
    		$cdata = json_decode($message['cdata'],true);
    		$message['cdata'] = $cdata;
    	}
        if(isset($message['uiSetting']) && $message['uiSetting']!='')
        {
            $uiSetting = json_decode($message['uiSetting'],true);
            $message['uiSetting'] = $uiSetting;
        }
        foreach($resourceInfo as $key => $value) 
        {
            if(isset($value['gcm']))
            {
                $gcmno = $value['gcm'];
                if($message['eid']=='71')
                {
                    $gcmno = $value['oldGCM'];
                }
    	        $message['u1'] = $value['id'];
                if($value['deviceType'] == 'android')
                {
                    $registatoin_ids =  array($gcmno);
                    $this->send_push($registatoin_ids,$message);
                }
                else
                {
                    $this->send_ios_push($gcmno,$message);
                }
            }
        }
    }
    
    function send_ios_push($registatoin_id,$message)
    {

        $companyInfo=get_company_data();
        $pem_file=$companyInfo['pem_file'];
        $passphrase=$companyInfo['passphrase'];
        $title="Push Notification";
        if(isset($message['t']) && $message['t']!="")
        {
            $title=$message['t'];
        }
        $pempath = server_path()."modules/notification/include/core/ntfc/ws/".$pem_file;
        //$pempath = server_path()."modules/notification/include/core/ntfc/ws/BES.pem";

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $pempath);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
       //stream_context_set_option($ctx, 'ssl', 'passphrase', 'xelium@123');

        // Open a connection to the APNS server
        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
        exit("Failed to connect: $err $errstr" . PHP_EOL);

        echo 'Connected to APNS' . PHP_EOL;

        //echo 'Connected to APNS' . PHP_EOL;

        // Create the payload body

        /*if($bd=='1')
        {
            //****************silent push****************
            $body['aps'] = array(
            'content-available' => '1',
            'alert' => 'Message from Island Groceries',
            'sound' => 'default',
            'action' => $message,
            );
            
        }
        else
        {*/
            $body['aps'] = array(
            'alert' => $title,
            'sound' => 'default',
            'action' => $message,
            );

        //}

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $registatoin_id) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        echo $result;

        if (!$result)
        echo 'Message not delivered' . PHP_EOL;
        else
        echo 'Message successfully delivered' . PHP_EOL;

        // Close the connection to the server
        fclose($fp);
    }

    function send_push($registatoin_ids,$message,$return=false)
    {
        $companyInfo=get_company_data();
        $API_ACCESS_KEY=$companyInfo['API_ACCESS_KEY'];
        //print_r($registatoin_ids);
        define( 'API_ACCESS_KEY', $API_ACCESS_KEY);
        
        $newarr=array_chunk($registatoin_ids,100);
        for($i=0;$i<sizeof($newarr);$i++)
        {
            $registrationIds=$newarr[$i];
            // prep the bundle
            $msg = array("data"=>$message);
            
            $fields = array
            (
            'registration_ids' => $registrationIds,
            'data'	 => $msg
            );
            //echo json_encode($fields);
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
            $result = curl_exec($ch );
           //print_r($result);
            logger("3","",array("data"=>$result),5);
            curl_close( $ch );
	       if($return){ return $result;  }else{ echo $result; }
        }
    }

    function send_sms($contacts,$msg)
    {
        //sens sms api code will be here
    }
    
    function create_emailNotification($type,$customer_id,$module_id,$submoduleid,$event_id,$uid1,$uid2,$uid3,$uid4,$uid5,$url,$ms,$extra,$extra_data)
    {

        if(sizeof($uid1)>0)
        {
            foreach($uid1 as $userid)
            {
                if($type=="url")
                {
                    $all_data=$this->get_all_urldata($customer_id,$module_id,$submoduleid,$event_id,$userid,$uid2,$uid3,$uid4,$uid5,$url);
                }
                else
                {
                    $all_data=$this->get_all_data($customer_id,$module_id,$submoduleid,$event_id,$userid,$uid2,$uid3,$uid4,$uid5);
                }

                
                if($all_data['success']!="false")
                {
                    $jsondata=array(
                        "customerId" => $customer_id,
                        "event_id" => $event_id,
                        "module_id" => $module_id,
                        "user_id" =>$userid,
                        "uid2" => $uid2,
                        "uid3" => $uid3,
                        "ctg_id" => '',
                        "uid4" => $uid4,
                        "json" => $all_data,
                        "servername"=>"teammerge",
                        "ms"=>$ms,
                        "extra"=>$extra,
                        "extra_data"=>$extra_data
                    );
                    //print_r($jsondata);die;
                     $jsondata=json_encode($jsondata);
                   
                    include("ntfc/ws/action.php"); //you have to check here for email notification
                }
            }
        }    
    }
    
    function add_notification($jsondata,$e,$p,$s,$n)
    {     

       //echo "jsondata= ".$jsondata;die;
        
        //logger("3","",array("data"=>$jsondata),5);
        $arr=json_decode($jsondata,true);
         
        if($e==1)
        {
            // here you will handle email notification
            $this->create_emailNotification($arr[0]['reqtype'],$arr[0]['customer_id'],$arr[0]['moduleid'],$arr[0]['submoduleid'],$arr[0]['eventid'],$arr[0]['uid1'],$arr[0]['uid2'],$arr[0]['uid3'],$arr[0]['uid4'],$arr[0]['uid5'],$arr[0]['requrl'],$arr[0]['ms'],$arr[0]['data'],$arr[0]['extra_data']);    
        }
        
        if($p==1 || $n==1)
        {
            if(isset($arr[0]['ctgUsers']) && $arr[0]['ctgUsers'] != '')
            {

                $ctgusers = get_category_users(array("category_ids"=>$arr[0]['ctgUsers']));
                $ctgusers = $ctgusers['data'];
                
                foreach ($ctgusers  as $user) {
                   array_push($arr[0]['uid1'],$user);
                }
            }

            include("ntfc/ws/ntfc.php");///Max this file is for push and desktop notification
       
        }
        
        if($s==1)
        {
            //Max here you will handle sms notification
        }
        
        return array("success"=>"true","data"=>$jsondata,"error_code"=>"100");
    }
    
    //max this function is for creating json for email
    function get_all_data($customer_id,$module_id,$submoduleid,$event_id,$uid1,$uid2,$uid3,$uid4,$uid5)
    {       
         global $db;
        $fet_customer_data=array();
        /*$con2 = new mysqli("127.0.0.1","pyksaas_pyk_main","4n(zIsJBhy!W", "pyksaas_pyk_main") ;
        
        $q1=$con2->query("select name,logo,address from customers where id=$customer_id");
        if(mysqli_num_rows($q1)>0)
        {
            $fet_customer_data = mysqli_fetch_object($q1);
        }*/
        
        $too=array();
        $mtoo=array();
        $account_data=array();
        $type1=array();
        $type2=array();
        $type3=array();
        $template_array=array();
        $mtemplate_array=array();
        $muser_arr=array();
        $eventdata="";
        $user_info = get_resource_by_id(array("id"=>$uid1));
        $user_info = $user_info['data'][0];
        unset($user_info['role']);
        unset($user_info['manager']);
        //$user_info=$this->get_user_info($customer_id,$uid1);
        //$user_info=json_decode($user_info,true);
		if($event_id=='203' && $user_info['user_type']=='hotel')
		{
			array_push($too,$user_info['booking_req_email']);
		}
		else
		{
			array_push($too,$user_info['email']);
		}
        
             
       
        $get_trigger_data=$db->triggers->find(array("mid"=>"$module_id","smid"=>"$submoduleid","eid"=>"$event_id","type"=>"email"));
       
        if(count(data_array($get_trigger_data))>0)
        {
            $fet_trigger_data=add_id($get_trigger_data,"id");
            foreach($fet_trigger_data as $res)
            {
                
                $eventdata=$res;
                if(isset($user_info['currentLang']) && $user_info['currentLang']!="")
                {
                   $eventdata['subject']=base64_encode($res['subject_'.$user_info['currentLang']]);

                }
                $get_data=$db->accounts->find(array('_id'=>new MongoId($res['accId'])));
                if(count(data_array($get_data))>0)
                {
                    $fet_data=add_id($get_data,"id");
                    array_push($account_data,array("accName"=>$fet_data[0]['accName'],"type"=>$fet_data[0]['accType'],"from_name"=> $fet_data[0]['from_name'],"email"=> $fet_data[0]['email'],"domain"=>$fet_data[0]['domain'],"password" => $fet_data[0]['password'],"username" => $fet_data[0]['username'],"port" => $fet_data[0]['port'],"url" => $fet_data[0]['url']));
                }
                
                $to_arr=explode(",",$res['ctg_id']);

                for($t=0;$t<sizeof($to_arr);$t++)
                {
                    if($to_arr[$t]!="" && $to_arr[$t]!=0)
                    {
                        $muser_info=$this->get_ctg_user_info($customer_id,$to_arr[$t]);
                        foreach($muser_info as $uinfo)
                        {
                            array_push($muser_arr,$uinfo);                            
                            array_push($mtoo,$uinfo['email']);
                        }
                    }
                } 
                
        
                if($res['type']=="email")
                {
                    $type1=array("type"=>"email");

                    $get_template = get_template_by_id(array('id'=>$res['tempId']));
                    //print_r($get_template);die;
                    $temp_desc=$get_template['data'][0]['tempDesc'];
                    if(isset($user_info['currentLang']) && $user_info['currentLang']!="")
                    {

                       $temp_desc=$get_template['data'][0]['tempDesc_'.$user_info['currentLang']];

                    }
                    //array_push($template_array,array("type"=>"email","temp_desc"=>base64_encode($temp_desc)));
                    array_push($template_array,array("type"=>"email","temp_desc"=>$temp_desc));
                    if($res['mtempId']!='' && $res['mtempId']!=0 )
                    {
                        $get_template=$db->templates->find(array('_id'=>new MongoId($res['mtempId']),"tempFor"=>"email"),array("tempDesc"));
                        $fet_template=add_id($get_template,"id");
                       // array_push($mtemplate_array,array("type"=>"email","temp_desc"=>base64_encode($fet_template[0]['tempDesc'])));
                        array_push($mtemplate_array,array("type"=>"email","temp_desc"=>$fet_template[0]['tempDesc']));
                    }
                }

            }
            $typearr=array_merge_recursive($type1,$type2);
        }
        else
        {
            return json_encode(array("success"=>"false"));
        }
        
        $user_details=$job_details=$blog_details=$forum_details=$contact_details=$product_details="";
        
        //now work according to moduleid and eventid
        
        if($uid2!="" && ($event_id==7 || $event_id==8 || $event_id==32))
        {
            $blog_details = get_blog_by_id(array("id"=>$uid2));
            $blog_details = $blog_details['data'][0];
        }
        
        if($uid2!="" && ($event_id==20 || $event_id == 21 ))
        {
            $job_details = get_job_by_id(array("id"=>$uid2));
            $job_details = $job_details['data'][0];
        }

        if($uid2!="" && ($event_id==27))
        {
            $forum_details = get_forum_by_id(array("id"=>$uid2));
            $forum_details = $forum_details['data'][0];
        }

        if($uid2!="" && $event_id==5)
        {
            $contact_details = get_contactus_by_id(array("id"=>$uid2));
            $contact_details = $contact_details['data'];
            //array_push($too,$uid3);
        }

        //print_r($template_array);die;
        $jsonarray=array(
                            "userdata"=>$user_info,
                            "eventdata"=>$eventdata,
                            "templatedata"=>$template_array,
                            "mtemplatedata"=>$mtemplate_array,
                            "customerdata"=>$fet_customer_data,
                            "resourcedata"=>$user_details,
                            "contactdata"=>$contact_details,
                            "jobdata"=>$job_details,
                            "forumdata"=>$forum_details,
                            "blogdata"=>$blog_details
                        );
        
        $final_array=array("success"=>"true","to"=>$too,"mto"=>$mtoo,"notification"=>$typearr,"account"=>$account_data,"event_id"=>$event_id,"module_id"=>$module_id,"datasource"=>"inline","url"=>"","jsondata"=>$jsonarray);
        //echo   json_encode($final_array);die;
        logger("3","",array("data"=>$final_array),5);
        return $final_array;
    }
    
    /*function get_all_data($customer_id,$module_id,$event_id,$uid1,$uid2,$uid3,$uid4,$uid5)//in mysql
    {
        global $db;
        $fet_customer_data=array();
        $con2 = new mysqli("127.0.0.1","pyksaas_pyk_main","4n(zIsJBhy!W", "pyksaas_pyk_main") ;
        
        $q1=$con2->query("select name,logo,address from customers where id=$customer_id");
        if(mysqli_num_rows($q1)>0)
        {
            $fet_customer_data = mysqli_fetch_object($q1);
        }
        
        $too=array();
        $account_data=array();
        
        $user_info=$this->get_user_info($customer_id,$uid1);
        $user_info=json_decode($user_info,true);
        array_push($too,$user_info['email']);
       
        
        //$get_trigger_data=mysql_query("select subject,types,ctg_id,acc_id from triggers where module_id=$module_id and event_id=$event_id");
        if(mysql_num_rows($get_trigger_data)>0)
        {
           
            $fet_trigger_data=mysql_fetch_object($get_trigger_data);
            
            $get_data=mysql_query("select * from emails where id=$fet_trigger_data->acc_id");
            if(mysql_num_rows($get_data)>0)
            {
                $fet_data=mysql_fetch_object($get_data);
                $account_data=array("email"=> $fet_data->email,"domain"=>$fet_data->domain,"password" => $fet_data->password,"username" => $fet_data->username);
            }
            $mail_types=explode(",",$fet_trigger_data->types);
            $to_arr=explode(",",$fet_trigger_data->ctg_id);
          
            for($t=0;$t<sizeof($to_arr);$t++)
            {
                if($to_arr[$t]!="")
                {
                    //$user_email=$this->get_user_email_only($customer_id,$to_arr[$t]);
                    //for($e=0;$e<sizeof($user_email);$e++)
                    //{
                        //array_push($too,$user_email[$e]);
                    //}
                }
            }   
        }
        else
        {
            echo mysql_error();
            return json_encode(array("success"=>"false"));
        }
 
        
        $type1=array();
        $type2=array();
        $type3=array();
        $template_array=array();
        
        for($e=0;$e<sizeof($mail_types);$e++)
        {
            if($mail_types[$e]=="email")
            {
                $type1=array("type"=>"email");
                $get_template=mysql_query("select temp_desc from mail_template where event_id=$event_id and temp_for='email'");
                $fet_template=mysql_fetch_object($get_template);
                array_push($template_array,array("type"=>"email","temp_desc"=>base64_encode($fet_template->temp_desc)));
            }
            if($mail_types[$e]=="sms")
            {
                $type3=array("type"=>"sms","contact"=>"955569885");
                $get_template=mysql_query("select temp_desc from mail_template where event_id=$event_id and temp_for='sms'");
                $fet_template=mysql_fetch_object($get_template);
                array_push($template_array,array("type"=>"sms","temp_desc"=>base64_encode($fet_template->temp_desc)));
            }
        }
        
                
        $typearr=array_merge_recursive($type1,$type2,$type3);
        
        $user_enr_course_details=$course_data=$course_pdf="";
        
        //now work according to moduleid and eventid
        
        if($uid2!="" && $module_id==2)
        {
            //$user_enr_course_details=$this->get_user_enr_course_details($customer_id,$uid2);
            //$course_data=json_decode($this->get_course_json($customer_id,$uid2),true);
            //$course_pdf=$this->get_course_pdf($customer_id,$uid2);
        }
        
        $new_test_details=array();
        if($uid3!="" && $module_id==2 && $event_id==5)
        {
            //$new_test_details=$this->get_new_test_details($customer_id,$uid2,$uid3,$uid1);
        }
        
        $job_details=array();
        if($uid2!="" && $module_id==5)
        {
            //$job_details=$this->get_job_details($customer_id,$uid2,$uid1); 
        }
       
        $course_array=array("user_enr_course_details"=>$user_enr_course_details,"course_data"=>$course_data,"course_pdf"=>$course_pdf);
        
        $jsonarray=array("userdata"=>$user_info,"eventdata"=>$fet_trigger_data,"templatedata"=>$template_array,"customerdata"=>$fet_customer_data,"coursedata"=>$course_array,"testdata"=>$new_test_details,"jobdata"=>$job_details);
        
        $final_array=array("success"=>"true","to"=>$too,"notification"=>$typearr,"account"=>$account_data,"event_id"=>$event_id,"module_id"=>$module_id,"datasource"=>"inline","url"=>"","jsondata"=>$jsonarray);
        //echo   json_encode($final_array);
       
        return $final_array;
    }*/
    
    function get_user_info($customer_id,$user_id)
    {
        global $db;
        $get=$db->user->find(array('_id' => new MongoId($user_id)));
        $res=add_id($get,"id");
        return json_encode($res[0]);
    }
    
    function get_user_email_only($customer_id,$ctg_id)
    {
        $array=array();
        global $db;
        $sel_user=$db->user->find(array('category' => $ctg_id));
        $res=add_id($sel_user,"id");
        return $res[0];
    }
    
    function get_ctg_user_info($customer_id,$ctg_id)
    {
        $array=array();
        global $db;
        $sel_user=$db->user->find(array('cate_id'=>array('$regex'=>$ctg_id)));
        $res=add_id($sel_user,"id");
        return $res;
    }
}
?>
