<?php

function random_password_generator( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function manage_licenses_request($data)
{
    logger("55",$data,"",5,"/manage_licenses_request");
    $check=check_key_available($data,array('id'));
    if($check['success']=='true')
    {
        if($data['id']=='0' || $data['id']=='')
        {
            $check=check_key_available($data,array('company','email'));
            if($check['success']=='true')
            {
                
                $manage_user=insert_licenses_request($data);
            }
            else
            {
                return $check;
            }        
        }
        else
        {
            $manage_user=update_licenses_request($data); 
        }   
        return $manage_user;
    }
    else
    {
        return $check;
    }
    
}

function insert_licenses_request($data)
{
    global $companyId;
    unset($data['id']);
    $data['_id']=new MongoId();
    $data['uploadedOn']=new MongoDate();
    $data['lrequest']='0';
    $data['request_date']=date("Y-m-d");
    // check customer previous request for license
    $tmp = select_mongo('licensesRequest',array('email'=>$data['email']),array());
    $return=add_id($tmp,"id");
    if(isset($return[0]))
    {
        $lid=$return[0]['id'];
        // update no.of license required 
        update_mongo('licensesRequest',array('lic_required'=>$data['lic_required']+$return[0]['lic_required']),array('_id'=>new MongoId($lid)));

        // license request history
        insert_mongo('licensesRequestHistory',$data);
        return array('data'=>$userId,'error_code'=>'55016','success'=>'true');
    }
    else
    {
        $ret=insert_mongo('licensesRequest',$data);
        if($ret['n']=='0')
        {
            $id=$data['_id']->{'$id'};
            $rand =rand(10,10000);
           
            // random password generator
            $password = random_password_generator(8); 

             // license manager creation for license requester comapny
            $oputput = manage_user(array('id'=>'0','name'=>$data['fname']." ".$data['lname'],'email'=>$data['fname'].".".$data['lname'].$rand."@nikky.tech",'username'=>$data['email'],'business_email'=>$data['email'],'category'=>'5ce0fbf590941ba86a3c9871','role'=>'5cefe4b890941ba7393c986a','password'=>$password,'l_company_id'=>$id,'user_type'=>'license manager','status'=>'1','parentId'=>'0','login_type'=>'normal'));
            if($oputput['success']=='true')
            {
                // mail to nikky licenses manager for new license request information
                insert_notification(array('customerId'=>$companyId,'mid'=>'55','smid'=>'1','userId'=>"5ce1397990941b89583c986f",'itemId'=>"",'eid'=>"304",'extra'=>json_encode($data)));
                update_mongo('licensesRequest',array('userId'=>$oputput['data']),array('_id'=>new MongoId($id)));
            }
            else
            {
                delete_mongo('licensesRequest',array('_id'=>new MongoId($id)));
            }
            // PO Number Verification
            if(isset($data['po_number']) && !empty($data['po_number']))
            {
                $query['po_number'] = $data['po_number'];
                $fields = array();
                $tmp = select_mongo('poRequest',$query,$fields);
                $return=add_id($tmp,"id");
                if(isset($return[0]) && $return[0]>0)
                {
                    $cond['po_verify'] ='1';
                    update_mongo('licensesRequest',$cond,array('_id'=> new MongoId($id)));
                }
            }
            // end
            return $oputput;
        }
        else
        {
            return array('data'=>$data,'error_code'=>'55002','success'=>'false');
        } 
    }
    
}

function update_licenses_request($data)
{
    global $companyId;
    $id=$data['id'];
    unset($data['id']);
    $ret=update_mongo('licensesRequest',$data,array('_id'=>new MongoId($id)));
    if($ret['n']=='1')
    {
        return array('data'=>$id,'error_code'=>'55003','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'55004','success'=>'false');
    }
}

function get_licenses_request($data)
{
    logger("55",$data,"",5,"/get_licenses_request");
    $fields=array();
    if(isset($data['fields'])){ $fields=explode(",",$data['fields']); }

    $query=array();

    //$index=""; $nor="";
    $orderby=array();
    $orderby['name']=1;

    if(isset($data['index'])&&isset($data['nor'])){
        $pagi=true;
        $index=$data['index'];
        $nor=$data['nor'];
    }
    if(isset($data['id']))
    {
        if($data['id']!='0')
        {

            $user_id=explode("|",$data['id']);
            $userIds=array();
            foreach($user_id as $uid)
            {
                if(MongoId::isValid ($uid))
                {
                    array_push($userIds,new MongoId($uid)); 
                }
            }
            $query['_id']=array('$in'=>$userIds);
        }
    }


    if(isset($data['search']))
    {
        $search_string=$data['search'];
        if(isset($data['searchBy']))
        {
            $query[$data['searchBy']] =new MongoRegex("/^$search_string/i");
        }
        else
        {
            $query['name'] =new MongoRegex("/^$search_string/i");
        }
    }

    if(isset($data['orderby']))
    {
        $orderby['uploadedOn']=-1;  
    }
    
    if(isset($index) && isset($nor))
    {
        $tmp = select_sort_limit_mongo('licensesRequest',$query,$fields,$orderby,$index,$nor);
        $return=add_id($tmp,"id");    
    }
    else
    {
    
        $tmp = select_mongo('licensesRequest',$query,$fields);
        $return=add_id($tmp,"id");    
    }
    if(isset($return[0]))
    {
        $alldata=array();
        foreach($return as $ret)
        {
            array_push($alldata,$ret);
        }
        return array('data'=>$alldata,'error_code'=>'55005','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'55006','success'=>'false');
    }  
}


function status_update($data)
{
    $getstatus = select_mongo('licensesRequest', array('_id'=> new MongoId($data['id'])),array('status'));
    $getstatus = add_id($getstatus,'id');
    $getstatusdata = $getstatus['0'];
    $newstatus = '1';
    if($getstatusdata['status'] == '1')
    {
        $newstatus = '0';
    }
    $update = update_mongo('licensesRequest',array('status'=>$newstatus),array('_id'=> new MongoId($data['id'])));
    if($update['n'] == 1)
    {
        return array('data'=>'','error_code'=>'55007','success'=>'true');
    }
    else
    {
        return array('data'=>'','error_code'=>'55008','success'=>'false');
    }
}

function ip_address_update($data) {
    $update = update_mongo('licensesRequest', array('ip_address' => $data['ip_address']), array('_id' => new MongoId($data['license_req_id'])));
    if ($update['n'] == 1) {
        return array('data' => '', 'error_code' => '55007', 'success' => 'true');
    } else {
        return array('data' => '', 'error_code' => '55008', 'success' => 'false');
    }
}

function update_server_configuration($data) {
    $check = check_key_available($data, array('server_expiry_date', 'company_id'));
    if ($check['success'] == 'true') {
        $checkStatus = select_mongo('licensesRequest', array('_id' => new MongoId($data['company_id'])));
        $checkStatus = add_id($checkStatus, 'id');
        if(!empty($checkStatus[0]) && !empty($checkStatus[0]['ip_address'])) {
            $date_of_expiry = encrypt_decrypt($data['server_expiry_date'], 'encrypt', 'opensesame3', '');
            $fields = array(
                'type' => 'serverConfiguration',
                'company_id' => $data['company_id'],
                'server_expiry_date' => $date_of_expiry['data']
            );
            $headers = array(
                'Authorization: key='.API_ACCESS_KEY
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $checkStatus[0]['ip_address'] . '/webservices/verify_license_status');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            $result = curl_exec($ch);
            curl_close($ch);
            $curl_result = json_decode($result, true);
            if($curl_result['success'] == 'true') {
                $update = update_mongo('licensesRequest', array('server_expiry_date' => $date_of_expiry['data']), array('_id' => new MongoId($data['company_id'])));
                return array('data' => '', 'error_code' => '55007', 'success' => 'true');
            } else {
                return array('data' => '', 'error_code' => '55008', 'success' => 'false');
            }
        } else {
            return array('data' => '', 'error_code' => '55002', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_license_expiration() {
    $getStatus = select_mongo('licensesServerConfiguration', array());
    $getStatus = add_id($getStatus, 'id');
    return array('data' => $getStatus, 'error_code' => '55012', 'success' => 'true');
}

function verify_license_status($data) {
    logger("55", $data, "", 5, "/verify_license_status");
    $check = check_key_available($data, array('type'));
    if ($check['success'] == 'true') {
        if($data['type'] == 'GET') {
            $getstatus = select_mongo('company_licenses', array('company_id' => $data['company_id']));
            $getstatus = add_id($getstatus, 'id');
            return array('data'=>$getstatus,'error_code'=>'55005','success'=>'true');
        }
        if($data['type'] == 'verifyServerConfiguration') {
            /*Check Server Configuration*/
            $serverConfInfo = select_mongo("licensesServerConfiguration", array());
            $serverConfInfo = add_id($serverConfInfo, "id");
            if(!empty($serverConfInfo) && !empty($serverConfInfo[0]['server_expiry_date'])) {
                $date_of_server_expirys_inf = encrypt_decrypt('', 'decrypt', 'opensesame3', $serverConfInfo[0]['server_expiry_date']);
                $date_of_server_expirys = strtotime(htmlentities(str_replace(array('"', "'"), '', $date_of_server_expirys_inf['data'])) . " 23:59:59");
                $curr_date = !empty($data['server_time']) ? $data['server_time'] : time();
                if($curr_date > $date_of_server_expirys) {
                    update_mongo('user', array('status' => '0'), array('status' => array('$ne' => '10')));
                } else {
                    update_mongo('user', array('status' => '1'), array('_id'=> new MongoId('569f7faa7c3d68011e3c9869')));
                }
            }
            if(!empty($data['request_from']) && $data['request_from'] == 'cron') {
                $mediaInfo = select_mongo("company_licenses", array("estatus" => array('$exists' => false)), array());
                $mediaInfo = add_id($mediaInfo, "id");
                if (count($mediaInfo) > 0) {
                    foreach ($mediaInfo as $value) {
                        $date_of_expirys = encrypt_decrypt('', 'decrypt', 'opensesame', $value['date_of_expiry']);
                        if ($date_of_expirys['success'] == 'true') {
                            $date_of_expiry = str_replace("'", "", $date_of_expirys['data']);
                            $exdate = $date_of_expiry . " 23:59:59";
                            $fexdate = strtotime($exdate);
                            $cdate = $curr_date;
                            $dateDiff = getDateDiffInDays($fexdate, $cdate);
                            $days_remaining = encrypt_decrypt($dateDiff, 'encrypt', 'opensesame', '');
                            $response = update_mongo('company_licenses', array('dateDiff' => $days_remaining['data'], 'updatedOn' => new MongoDate()), array('_id' => new MongoId($value['id'])));
                            if ($fexdate < time() || $dateDiff <= 0) {
                                delete_mongo('company_licenses', array('_id' => new MongoId($value['id'])));
                                if(!empty($value['userId'])) {
                                    update_mongo('user', array('license' => '', 'status' => '0'), array('_id' => new MongoId($value['userId'])));
                                }
                            }
                            $bIsConnected = check_internet_connection();
                            if ($bIsConnected) {
                                // inform to server1 for license 
                                send_data_to_server_for_verification($value);
                            }
                        }
                    }
                }
            }
            return array('data' => array(), 'error_code' => '55012', 'success' => 'true');
        }
        
        if($data['type'] == 'serverConfiguration') {
            $getStatus = select_mongo('licensesServerConfiguration', array('company_id' => $data['company_id']));
            $getStatus = add_id($getStatus, 'id');
            if(empty($getStatus)) {
                // insert server configuration 
                unset($data['type']);
                $output = insert_mongo('licensesServerConfiguration', $data);
                if ($output['n'] == '0') {
                    verify_license_status(array('type' => 'verifyServerConfiguration'));
                    $id = $lparam['_id']->{'$id'};
                    return array('data' => $id, 'error_code' => '55012', 'success' => 'true');
                } else {
                    return array('data' => "Not Submitted", 'error_code' => '55011', 'success' => 'false');
                }
            } else {
                $update = update_mongo('licensesServerConfiguration', array('server_expiry_date' => $data['server_expiry_date']), array('company_id' => $data['company_id']));
                if ($update['n'] == 1) {
                    verify_license_status(array('type' => 'verifyServerConfiguration'));
                    return array('data' => '', 'error_code' => '55007', 'success' => 'true');
                } else {
                    return array('data' => '', 'error_code' => '55008', 'success' => 'false');
                }
            }
        }
    } else {
        return $check;
    }
}

function getDateDiffInDays($date1, $date2) {
    // Calulating the difference in timestamps 
    $diff = $date2 - $date1;

    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400));
}

//serverLicenseConfiguration

function company_active_status($data)
{
    $update = update_mongo('company_licenses',array('assign_status'=>'1' ,'active_status'=>'1','userId'=>$data['userId']),array('_id'=> new MongoId($data['asid'])));
    $updateuser = update_mongo('user',array('license'=>'1'),array('_id'=> new MongoId($data['userId'])));
    if($update['n'] == 1)
    {
        return array('data'=>'','error_code'=>'55007','success'=>'true');
    }
    else
    {
        return array('data'=>'','error_code'=>'55008','success'=>'false');
    }
}
function company_deactive_status($data)
{ 
    $getstatus = select_mongo('company_licenses', array('_id'=> new MongoId($data['mid'])),array('active_status','userId'));
        $getstatus = add_id($getstatus,'id');
        $getstatusdata = $getstatus['0'];
    $cond=array();
    if(isset($data['status']) && $data['status'] == 'del')
    {
        $cond['assign_status'] = '10';
        $cond['active_status'] = '10';
        $cond['userId'] = '';
        $updateuser = update_mongo('user',array('license'=>''),array('_id'=> new MongoId($getstatusdata['userId'])));
    }
    if(isset($data['status']) && $data['status'] == 'upd')
    {
        $cond['assign_status'] = '1';
        $cond['active_status'] = '1';
        
        if($getstatusdata['active_status'] == '1' || $getstatusdata['active_status'] == '10')
        {
            $cond['assign_status'] = '0';
            $cond['active_status'] = '0';
        }
    }
    $update = update_mongo('company_licenses',$cond,array('_id'=> new MongoId($data['mid'])));
    
    if($update['n'] == 1)
    {
        $deleteenroll = delete_mongo('enrollments',array('itemId'=>$data['mid']));
        return array('data'=>'','error_code'=>'55007','success'=>'true');
    }
    else
    {
        return array('data'=>'','error_code'=>'55008','success'=>'false');
    }
}

// check user license and insert new licenses
function check_user_licenses($data)
{
    logger("55",$data,"",5,"/check_user_licenses");
    $check=check_key_available($data,array('email'));
    if($check['success']=='true')
    {
        
        $userInfo = get_resource_by_id(array('business_email'=>$data['email']));
        if($userInfo['success']=='true')
        {

            $userLicense = get_user_license(array('licenses_no'=>$data['licenses_no'],'email'=>$data['email']));
            if($userLicense['success']=='true')
            {
                return array('data'=>"Already Exists",'error_code'=>'55010','success'=>'false');
            }
            else
            {

                if($userLicense['errorcode']=='116')
                {
                    return $userLicense;
                }
                else
                {
                    $licenses_no=encrypt_decrypt($data['licenses_no'],'encrypt','opensesame','');
                    $date_of_generation=encrypt_decrypt($data['date_of_generation'],'encrypt','opensesame0','');
                    $date_of_expiry=encrypt_decrypt($data['date_of_expiry'],'encrypt','opensesame1','');
                    $time_period=encrypt_decrypt($data['time_period'],'encrypt','opensesame2','');
                    $lparam = array('company_id'=>$userInfo['data'][0]['l_company_id'],'date_of_generation'=>$date_of_generation['data'],'createdOn'=>new MongoDate(),'date_of_expiry'=>$date_of_expiry['data'],'time_period'=>$time_period['data'],'email'=>$data['email'],'product'=>$data['product'],'_id'=>new MongoId(),'licenses_no'=>md5($data['licenses_no']),'data'=>$licenses_no['data']);

                    // insert company licenses 
                    $output = insert_mongo('company_licenses',$lparam);
                    if($output['n']=='0')
                    {
                        $id=$lparam['_id']->{'$id'};
                        return array('data'=>$id,'error_code'=>'55012','success'=>'true');
                    }
                    else
                    {
                        return array('data'=>"Not Submitted",'error_code'=>'55011','success'=>'false');
                    }
                }
            }
        }
        else
        {
            return array('data'=>$data,'error_code'=>'55009','success'=>'false');
        }
        
    }
    else
    {
        return $check;
    }
}


// get user license according email, licenses number and etc.
function get_user_license($data)
{
    logger("55",$data,"",5,"/get_user_license");
    $check=check_key_available($data,array('licenses_no'));
    if($check['success']=='true')
    {
        $fields=array();
        if(isset($data['fields'])){ $fields=explode(",",$data['fields']); }

        $query=array();

        //$index=""; $nor="";
        $orderby=array();
        $orderby['name']=1;

        if(isset($data['index'])&&isset($data['nor'])){
            $pagi=true;
            $index=$data['index'];
            $nor=$data['nor'];
        }
        if(isset($data['id']))
        {
            if($data['id']!='0')
            {

                $user_id=explode("|",$data['id']);
                $userIds=array();
                foreach($user_id as $uid)
                {
                    if(MongoId::isValid ($uid))
                    {
                        array_push($userIds,new MongoId($uid)); 
                    }
                }
                $query['_id']=array('$in'=>$userIds);
            }
        }


        if(isset($data['search']))
        {
            $search_string=$data['search'];
            if(isset($data['searchBy']))
            {
                $query[$data['searchBy']] =new MongoRegex("/^$search_string/i");
            }
            else
            {
                $query['name'] =new MongoRegex("/^$search_string/i");
            }
        }

        if(isset($data['email']))
        {
            $query['email'] =$data['email'];
        }

        if(isset($data['licenses_no']))
        {
            $query['licenses_no'] =md5($data['licenses_no']);
        }

        if(isset($data['orderby']))
        {
            $orderby['createdOn']=-1;  
        }
        if(isset($index) && isset($nor))
        {
            $tmp = select_sort_limit_mongo('company_licenses',$query,$fields,$orderby,$index,$nor);
            $return=add_id($tmp,"id");    
        }
        else
        {
        
            $tmp = select_mongo('company_licenses',$query,$fields);
            $return=add_id($tmp,"id");    
        }
        if(isset($return[0]))
        {
            $alldata=array();
            foreach($return as $ret)
            {
                array_push($alldata,$ret);
            }
            return array('data'=>$alldata,'error_code'=>'55007','success'=>'true');
        }
        else
        {
            return array('data'=>$data,'error_code'=>'55008','success'=>'false');
        }  
    }
    else
    {
        return $check;
    }
}

function encrypt_decrypt($message,$type,$password,$msg_bundle)
{
    if($type=='encrypt')
    {
        $message = escapeshellarg( $message );
        //$message = 'This is my very secret data SSN# 009-68-1234';  

        // Set to some reasonable limit for DB.
        // Make sure to size DB column +60 chars 
        $max_msg_size = 1000;
        $message = substr($message, 0, $max_msg_size);

        // User's password (swap for actual form post)
        $password = escapeshellarg( $password );
        //$password = 'opensesame';

        // Salt to add entropy to users' supplied passwords
        // Make sure to add complexity/length requirements to users passwords!
        // Note: This does not need to be kept secret
        $salt = sha1(mt_rand());

        // Initialization Vector, randomly generated and saved each time
        // Note: This does not need to be kept secret
        $iv = substr(sha1(mt_rand()), 0, 16);

        //echo "\n Password: $password \n Message: $message \n Salt: $salt \n IV: $iv\n";

        $encrypted = openssl_encrypt(
          "$message", 'aes-256-cbc', "$salt:$password", null, $iv
        );

        $msg_bundle = "$salt:$iv:$encrypted";
        //echo " Encrypted bundle = $msg_bundle \n\n ";
        
        return array('data'=>$msg_bundle,'success'=>'true','error_code'=>'100');
    }
    else
    {
        //$password = 'opensesame';
        $password = escapeshellarg( $password );
        // Swap with actual db retrieval code here
        //$saved_bundle = db_read( "select encrypted_msg from sensitive_table" );
        //$saved_bundle = "4073fbcab0d54bf9f64a9cf49cf1a3c6e33b5ae7:82e4671dd1cf1f02:HX2JtJaiclJDfcjpFoChSQ==";
        $saved_bundle = $msg_bundle;

        // Parse iv and encrypted string segments
        $components = explode( ':', $saved_bundle );;

        //var_dump($components);

        $salt          = $components[0];
        $iv            = $components[1];
        $encrypted_msg = $components[2];

        $decrypted_msg = openssl_decrypt(
          "$encrypted_msg", 'aes-256-cbc', "$salt:$password", null, $iv
        );

        if ( $decrypted_msg === false ) {
          //die("Unable to decrypt message! (check password) \n");
          return array('data'=>"",'success'=>'false','error_code'=>'100');
        }

        $msg = substr( $decrypted_msg, 41 );
       // echo "\n Decrypted message: $decrypted_msg \n";
        //$alldata['data1'] =$decrypted_msg;
        return array('data'=>$decrypted_msg,'success'=>'true','error_code'=>'100');
    }
    
}

function add_customer_license_information($data)
{
    global $companyId;
    unset($data['id']);
    $data['_id']=new MongoId();
    $ret=insert_mongo('customer_license_info',$data);
    if($ret['n']=='0')
    {
        $id=$data['_id']->{'$id'};
        return array('data'=>$id,'error_code'=>'55014','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'55015','success'=>'false');
    } 
}

function manage_po_request($data)
{
    logger("55",$data,"",5,"/manage_po_request");
    $check=check_key_available($data,array('id'));
    if($check['success']=='true')
    {
        if($data['id']=='0' || $data['id']=='')
        {
            $check=check_key_available($data,array('po_number'));
            if($check['success']=='true')
            {
                
                $manage_user=insert_po_request($data);
            }
            else
            {
                return $check;
            }        
        }
        else
        {
            $manage_user=update_po_request($data); 
        }   
        return $manage_user;
    }
    else
    {
        return $check;
    }
    
}

function insert_po_request($data)
{
    global $companyId;
    unset($data['id']);
    $data['_id']=new MongoId();
    $data['uploadedOn']=new MongoDate();
    $data['request_date']=date("Y-m-d");
    $ret=insert_mongo('poRequest',$data);
    if($ret['n']=='0')
    {
        $id=$data['_id']->{'$id'};
        $rand =rand(10,10000);
        return array('data'=>$id,'error_code'=>'55050','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'55051','success'=>'false');
    } 
    
}

function update_po_request($data)
{
    global $companyId;
    $id=$data['id'];
    unset($data['id']);
    $ret=update_mongo('poRequest',$data,array('_id'=>new MongoId($id)));
    if($ret['n']=='1')
    {
        return array('data'=>$id,'error_code'=>'55053','success'=>'true');
    }
    else
    {
        return array('data'=>$data,'error_code'=>'55052','success'=>'false');
    }
}

?>