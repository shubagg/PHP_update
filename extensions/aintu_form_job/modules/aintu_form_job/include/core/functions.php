<?php

/******Aintu Work Start******/
function create_extension_form_job($data)
{
  if(isset($data['cid']) && !empty($data['cid']))
  {
    $companyId = $data['cid'];
  }
  else
  {
    $company_data = get_company_data();
    $companyId = $company_data['cid'];
  }
   
   $approval_data = array();
   if(isset($data['approval_id']) && !empty($data['approval_id']))
   {
     $approval_id = $data['approval_id'];
     $approval_data['id'] = $approval_id;
     unset($data['approval_id']);
   }
   if(isset($data['action_ts']))
   {
     $approval_data['action_ts'] = $data['action_ts'];
   }
   if(isset($data['action_by']))
   {
     $approval_data['update_by'] = $data['action_by'];
   }
   if(isset($data['action_comment']))
   {
     $approval_data['comment'] = $data['action_comment'];
     $fa_action_comment = $data['action_comment'];
   }
   if(isset($data['action_ts']))
   {
     $approval_data['action_ts'] = $data['action_ts'];
   }
   if(isset($data['action_by']))
   {
     $approval_data['update_by'] = $data['action_by'];
   }
   if(isset($data['action']))
   {
     $fa_action = $data['action'];
    // unset($data['action']);
   }

   if(($data['deviceType']=='android') || ($data['deviceType']=='ios'))
   {
      $validate = validateForm($data);
     if($validate['success']=='false')
     {
       return $validate; 
     } 
   }
   
   $data['approval_data'] = $approval_data;

   $result_job = curl_post('/create_approval_form_job',$data);
   
   
   if(($result_job['success']=='true') && count($result_job['data']['data']))
   {
       $result_job = $result_job['data']['data'];
       $jobId = $result_job['id'];
        if(empty($data['id']))
        {
          $approval_data = curl_post('/get_approval_by_id',array("id"=>0,"request_by"=>$approval_data['update_by'],"iid"=>$jobId, "order_column"=>"id","order_by"=>"desc", "limit"=>1));
           
           
            if($approval_data['success']=='true')
            {   
                
                $attributes = array();
                $current_value = array();
                $approval_data = $approval_data['data']['result'][0];
                $result_job['approval_id'] = $approval_data['id'];

                
                if(isset($approval_data['action']))
                {
                   array_push($attributes,"status");
                   array_push($current_value,$approval_data['action']);
                }
                if(isset($approval_data['request_to']) && !empty($approval_data['request_to']))
                {
                   array_push($attributes,"assign");
                   array_push($current_value,$approval_data['request_to']);
                }
            }
            if(count($attributes) && count($current_value))
            {
                $attributes = implode(",", $attributes);
                $current_value = implode(",", $current_value);

               
                $temp_update_data = array("id"=>$jobId,"attributes"=>$attributes,"current_value"=>$current_value,"smid"=>$data['smid']);
                $update_res =curl_post('/manage_job',$temp_update_data);
               
            }
        }
        else
        {
            $job_data_temp = get_job_by_id(array("id"=>$data['id'],"smid"=>"3"));
            if(isset($job_data_temp['success']) && $job_data_temp['success']=='true')
            {
                $creator =  $job_data_temp['data'][0]['creator'];
                $form_id =  $job_data_temp['data'][0]['form_id'];
            }
            $attributes = array();
            $current_value=array();
            if((!isset($approval_id) || empty($approval_id)) &&($fa_action=='1'))
            {

                   $approval_data['cid'] = $companyId;
                   $approval_data['mid'] = "5";
                   $approval_data['smid'] = "3";
                   $approval_data['iid'] = $data['id'];
                   
                   $approval_data['title'] = $data['title'];
                   $approval_data['form_id'] = $form_id;
                   $approval_data['comment'] = $fa_action_comment;
                   $approval_data['update_by'] = $creator;

                   $approval_data['action_done'] = "create";
                   $approval_data['action'] = "send_for_approval";
                   $approval_data['condition'] = "general";

                  //return array("data"=>$approval_data,"success"=>"true","error_code"=>"50311-1");
                   $approvalResult = curl_post('/fn_send_for_approval',$approval_data);
                  
                   if($approvalResult['success']=='true')
                   {
                        
                      if(isset($approvalResult['data'][0]) && count($approvalResult['data'][0]))
                      {
                           $approvalResult = $approvalResult['data'][0];
                      }
                      else if(isset($approvalResult['data']))
                      {
                           $approvalResult = $approvalResult['data'];
                      }
                      else
                      {
                          $approvalResult = $approvalResult;
                      }
                    
                      if(isset($approvalResult['approval_id']))
                      {
                          $currentAppData = curl_post('/get_approval_by_id',array("id"=>$approvalResult['approval_id']));
                      }
                      
                      $request_to = $currentAppData['data']['result'][0]['request_to'];
                      $action_to = $currentAppData['data']['result'][0]['action_to'];
                        
                        
                        array_push($attributes,"assign");
                        array_push($current_value,$request_to);
                        array_push($attributes,"status");
                        array_push($current_value,'1');
                    }
                    $update_data = array();
                    if(count($attributes) && count($current_value))
                    {
                        $update_data['attributes'] = implode(",",$attributes);
                        $update_data['current_value'] = implode(",",$current_value);
                    }
                    $update_data['id'] = $data['id'];
                    $update_data['smid'] = $data['smid'];
                    $adds = array($attributes,$current_value);
                    
                    $update_res = curl_post('/manage_job',$update_data);
                    //$update_res = update_job($update_data);

            }
            if(isset($approval_id) && !empty($approval_id))
            {
              if(isset($fa_action) && $fa_action=='1')
              {
                 $currentAppData = curl_post('/get_approval_by_id',array("id"=>$approval_data['id']));
                 $parent_id = $currentAppData['data']['result'][0]['parent_id'];
                 $approval_data['cid'] = $companyId;
                 $approval_data['mid'] = "5";
                 $approval_data['smid'] = "3";
                 $approval_data['iid'] = $data['id'];
                 $approval_data['title'] = $data['title'];
                 $approval_data['form_id'] = $form_id;
                 $approval_data['parent_id'] = $parent_id;
                 $approval_data['comment'] = $fa_action_comment;
                 $approval_data['update_by'] = $creator;
                 $approval_data['action_done'] = "create";
                 $approval_data['action'] = "send_for_approval";
                 $approval_data['condition'] = "general";

                 if(isset($approval_data['id'])) { unset($approval_data['id']); }
               //  return array("data"=>$approval_data,"success"=>"true","error_code"=>"50311-2");
                 $approvalResult = curl_post('/fn_send_for_approval',$approval_data);

                 if($approvalResult['success']='true')
                 {
                    if($approvalResult['success']='true')
                    {
                        if(isset($approvalResult['data'][0]) && count($approvalResult['data'][0]))
                        {
                             $approvalResult = $approvalResult['data'][0];
                        }
                        else if(isset($approvalResult['data']))
                        {
                             $approvalResult = $approvalResult['data'];
                        }
                        else
                        {
                          $approvalResult = $approvalResult;
                        }
                      
                        if(isset($approvalResult['approval_id']))
                        {
                          $currentAppData = curl_post('/get_approval_by_id',array("id"=>$approvalResult['approval_id']));
                        }
                        
                        $request_to = $currentAppData['data']['result'][0]['request_to'];
                        $action_to = $currentAppData['data']['result'][0]['action_to'];
                    }
                    array_push($attributes,"assign");
                    array_push($current_value,$request_to);
                    array_push($attributes,"status");
                    array_push($current_value,'1');
                  }
              }
              else if(isset($fa_action) && $fa_action=='2')
              {
                 $approval_data['comment'] = $fa_action_comment;
                // return array("data"=>$approval_data,"success"=>"true","error_code"=>"50311-3");
                 $approvalResult = curl_post('/fn_approved',$approval_data);

                  if($approvalResult['success']='true')
                  {
                      if(isset($approvalResult['data'][0]) && count($approvalResult['data'][0]))
                      {
                           $approvalResult = $approvalResult['data'][0];
                      }
                      else
                      {
                           $approvalResult = $approvalResult['data'];
                      }
                    
                      if(!empty($approvalResult))
                      {
                          $currentAppData = curl_post('/get_approval_by_id',array("id"=>$approvalResult['approval_id']));
                      }
                      else
                      {
                          $currentAppData = curl_post('/get_approval_by_id',array("id"=>$approval_id));
                          $approvalResult['action']='approved';
                      }
                      
                      $request_to = $currentAppData['data']['result'][0]['request_to'];
                      $action_to = $currentAppData['data']['result'][0]['action_to'];
                      
                      if($approvalResult['action']=='send_for_approval')
                      {
                          array_push($attributes,"assign");
                          array_push($current_value,$request_to);
                          array_push($attributes,"status");
                          array_push($current_value,'1');
                      }
                      else if($approvalResult['action']=='approved')
                      {
                          array_push($attributes,"assign");
                          array_push($current_value,$creator);
                          array_push($attributes,"status");
                          array_push($current_value,'2');
                      }
                  }
              }
              else if(isset($fa_action) && $fa_action=='3')
              {
                $approval_data['comment'] = $fa_action_comment;    
                $attributes = array();
                $current_value = array();
                $approvalResult = array();
               // return array("data"=>$approval_data,"success"=>"true","error_code"=>"50311-4");
                  $approvalResult = fn_rejected($approval_data);
                  if($approvalResult['success']='true')
                  {
                      if(isset($approvalResult['data'][0]) && count($approvalResult['data'][0]))
                      {
                           $approvalResult = $approvalResult['data'][0];
                      }
                      else if(isset($approvalResult['data']))
                      {
                           $approvalResult = $approvalResult['data'];
                      }
                      else
                      {
                        $approvalResult = $approvalResult;
                      }
                    
                      if(isset($approvalResult['approval_id']))
                      {
                        $currentAppData = curl_post('/get_approval_by_id',array("id"=>$approvalResult['approval_id']));
                      }
                      else
                      {
                        $currentAppData = curl_post('/get_approval_by_id',array("id"=>$approval_id));
                          $approvalResult['action']='rejected';
                      }
                      $request_to = $currentAppData['data']['result'][0]['request_to'];
                      $action_to = $currentAppData['data']['result'][0]['action_to'];
                      
                      if($approvalResult['action']=='send_for_approval')
                      {
                          
                          array_push($attributes,"assign");
                          array_push($current_value,$request_to);
                          array_push($attributes,"status");
                          array_push($current_value,'1');
                      }
                      else if($approvalResult['action']=='rejected')
                      {
                          array_push($attributes,"assign");
                          array_push($current_value,$creator);
                          array_push($attributes,"status");
                          array_push($current_value,'3');
                      }
                  }
              }
              $update_data = array();
              if(count($attributes) && count($current_value))
              {
                  $update_data['attributes'] = implode(",",$attributes);
                  $update_data['current_value'] = implode(",",$current_value);
              }
              $update_data['id'] = $data['id'];
              $update_data['smid'] = $data['smid'];
              $update_res = curl_post('/manage_job',$update_data);
            }
        }
          $result_job['current_user'] ='';
          $currentUser = curl_post('/get_current_assigne',array("id"=>$result_job['id']));
		  if($currentUser['success']=='true')
            {
              $result_job['current_user'] = $currentUser['data'][0]['userid'];
            }  
            return array("data"=>$result_job,"success"=>"true","error_code"=>"50311");
         /* if($update_res['success']=='true')
          {
            
          }
          else
          {
            global $new_log_file_url;
            $filePath = $new_log_file_url.'aintu.csv';
            $handle = fopen($filePath, "a");
            $result_job['fa_action'] = $fa_action;
            fputcsv($handle, json_encode($result_job)); # $line is an array of string values here
            //Then close the handle (fclose­Docs):
            fclose($handle);
            return array("data"=>$result_job,"success"=>"false","error_code"=>"50311");
          }*/
    }
    else
    {
      return array("data"=>$result_job,"success"=>"false","error_code"=>"50311");
    }
   
}
function validateForm($data)
{
   $formJson = get_form_by_id(array('id'=>$data['form_id']));
   if($formJson['success']=='true')
   {
      $formFields = $formJson['data'][0]['field'];

      $formData = stripcslashes($data['form_data']);
      $formData = str_replace("\n","\\n",$formData);
      $formData = str_replace("\r","",$formData);
      $formData = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":',$formData);
      $formData = preg_replace('/(,)\s*}$/','}',$formData);
      $formData = json_decode($formData,true);
      $emptyFileds = array();

      $check1 = array('image','file','signature');
      $allTypes = array();
      foreach ($formFields as $ffk => $ffv) {
        if($ffv['validation']['required']=='true')
        {
          $fields = $formData[$ffk]['fields'];
          if(in_array($ffv['type'], $check1))
          {
            foreach ($fields as $fk => $fv) {
               if(isset($fv['l_id']) && $fv['l_id']=='')
               {
                  array_push($emptyFileds,$fv['id']);
               }
            }
          }
          else
          {
            foreach ($fields as $fk => $fv) {
               if($fv['val']=='')
               {
                  array_push($emptyFileds,$fv['id']);
               }   
            }
          }
        }
      }
      if(count($emptyFileds))
      {
        return array('success'=>'false','data'=>$emptyFileds,'error_code'=>'50511');
      }
      else
      {
        return array('success'=>'true','data'=>$emptyFileds,'error_code'=>'50512');
      }
    }
}
function get_extension_all_jobs($data)
{
    //pr($data); die;
    global $ui_string;
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') 
    {
        $deviceType = isset($data['deviceType']) ? $data['deviceType']:'web';
        $total_count = 0;
        $JobIds = array();
        if(isset($data['hierarchy']) && $data['hierarchy']=='true')
        {   
            $userId_data = array();
            if(isset($data['userId']) && !empty($data['userId']))
            {
                $user_id = $data['userId'];
            }
            else
            {
                $user_id = $_SESSION['user']['user_id'];   
            }
            $userId_data = get_user_hirarchy(array("userId"=>$user_id,"object"=>true));
            
            $user_data = curl_post('/get_resource_by_id',array("id"=>$user_id));
            if($user_data['success']=='true')
            {
                $user_data = $user_data['data'][0];
                $userId_data['data'][$user_data['id']] = $user_data;
            }
           
            foreach ($userId_data['data'] as $key => $value) {
            
                $userIds .= "'".$key."'".",";
            }
            $userIds = trim($userIds,",");
            
        }
        
        $userId_data = $userId_data['data'];
        $select  = " j.*,j.id as jobId,ja.userid,ja.status ";
        $from = "  job as j INNER JOIN jobassignedstatus AS ja ON ja.iid = j.id ";
        $cond  = " 1 AND j.smid = 3 AND j.creator in (".$userIds.")"; 
        if(isset($data['status']))
        {
            $cond .= " AND ja.status in (". $data['status'] .") ";
        }
        if(isset($data['id']) && !empty($data['id']))
        {
            $cond .= " AND j.id = ". $data['id'] ;
        }
        if(isset($data['creator']) && !empty($data['creator']))
        {
            $cond .= " AND j.creator = ". "'".$data['creator']."'" ;
        }
        if (!empty($data['query_str'])) 
        {
            $cond .= " AND " . $data['query_str'];
        }


        $cond .= " GROUP BY j.id ";
        $cond .= " ORDER BY lastUpdate desc ";
        $fet_data_count = Select_Some($select, $from, $cond);
        if (!is_array($fet_data_count)) 
        {
            $total_count = mysqli_num_rows($fet_data_count);
        }
        if(isset($data['offset']) && isset($data['limit']))
        {
             $cond .= " limit ".$data['offset'] .','. $data['limit'];

        }
        //echo "select ". $select . ' from '. $from . ' where '. $cond; die;
        $fet_data = Select_Some($select, $from, $cond);

        $job_data = array();
        if (!is_array($fet_data)) 
        {
            $paramJson = array();
            $paramJson['mid']='5';
            $paramJson['smid']='3';
            $paramJson['request_type']='status';
            //$paramJson['status']='L';
           
            include_once(framework_doc_path() . 'internalApi/settings/setting_mgmt_lib.php');
            $statusData = get_setting($paramJson);
            $statusData = $statusData['data'];
            //pr($statusData); die;
            while ($user_ass_data = mysqli_fetch_assoc($fet_data))
            {
                $link = site_url().'admin/form/filledformdetails?formtype=pendingform&jobId='.$user_ass_data['jobId'].'&formid='.$user_ass_data['form_id'];
               $user_ass_data['jobId'] =  '<a href="'.$link.'">'.$user_ass_data['jobId'].'</a>';

               if(isset($userId_data[$user_ass_data['creator']]))
               {
                    $user_ass_data['creator_name'] = $userId_data[$user_ass_data['creator']]['name'];
               }
               else
               {
                $userData = curl_post('/get_resource_by_id',array("id"=>$user_ass_data['creator']));
                if($userData['success']=='true')
                {
                    $userData = $userData['data'][0];
                    $userId_data[$userData['id']] = $userData;
                    $user_ass_data['creator_name'] = '';
                }
                else
                {
                    $user_ass_data['creator_name'] = $ui_string['n/a'];
                }
                    
               } 
               if(isset($userId_data[$user_ass_data['userid']]))
               {
                    $user_ass_data['assinee_name'] = $userId_data[$user_ass_data['userid']]['name'];
               }
               else
               {
                  $userData = curl_post('/get_resource_by_id',array("id"=>$user_ass_data['userid']));
                  if($userData['success']=='true')
                  {
                    $userData = $userData['data'][0];
                    $userId_data[$userData['id']] = $userData;
                    $user_ass_data['assinee_name'] = $userData['name'];
                  }
                  else
                  {
                    $user_ass_data['assinee_name'] = $ui_string['n/a'];
                  }
               }
               
               $user_ass_data['status_name'] = isset($statusData[$user_ass_data['status']]) ? $statusData[$user_ass_data['status']]:$ui_string['n/a'];
               array_push($job_data, $user_ass_data);
            }     
        }
        $final_data = array('job_data'=>$job_data,'total_count'=>$total_count);
        if($deviceType=='android' || $deviceType=='ios')
        {
            return array("data"=>$job_data,"success"=>"true","error_code"=>"5085");
        }
        else
        {
            return array("data"=>$final_data,"success"=>"true","error_code"=>"5085");
        }
        
    }
    else
    {
        return $check;
    }
}

function get_aintu_myincomplete_jobs($data)
{
    global $ui_string;
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') 
    {
        $total_count = 0;
        $JobIds = array();
        $userId_data = array();
           
          
        $user_data = curl_post('/get_resource_by_id',array("id"=>$data['userId']));
        if($user_data['success']=='true')
        {
            $user_data = $user_data['data'][0];
            $userId_data['data'][$user_data['id']] = $user_data;
        }
       
        

        foreach ($userId_data['data'] as $key => $value) {
        
            $userIds .= "'".$key."'".",";
        }
        $userIds = trim($userIds,",");
            
        
        
        $userId_data = $userId_data['data'];
        $select  = " j.*,j.id as jobId,ja.* ";
        $from = "  job as j INNER JOIN jobassignedstatus AS ja ON ja.iid = j.id ";
        $cond  = " 1 AND j.smid = 3 AND j.creator in (".$userIds.")"; 
        $cond .= " AND ja.status = 4 ";
        $cond .= " GROUP BY j.id ";

        $fet_data_count = Select_Some($select, $from, $cond);
        if (!is_array($fet_data_count)) 
        {
            $total_count = mysqli_num_rows($fet_data_count);
        }
        if(isset($data['offset']) && isset($data['limit']))
        {
             $cond .= " limit ".$data['offset'] .','. $data['limit'];

        }
        //echo "select ". $select . ' from '. $from . ' where '. $cond; die;
        $fet_data = Select_Some($select, $from, $cond);


        $job_data = array();
        if (!is_array($fet_data)) 
        {   
            $paramJson = array();
            $paramJson['mid']='5';
            $paramJson['smid']='3';
            $paramJson['request_type']='status';
            //$paramJson['status']='L';
           
            include_once(framework_doc_path() . 'internalApi/settings/setting_mgmt_lib.php');
            $statusData = get_setting($paramJson);
            $statusData = $statusData['data'];
           // pr($statusData); die;
            while ($user_ass_data = mysqli_fetch_assoc($fet_data))
            {
               if(isset($userId_data[$user_ass_data['creator']]))
               {
                    $user_ass_data['creator_name'] = $userId_data[$user_ass_data['creator']]['name'];
               }
               else
               {
                $userData = curl_post('/get_resource_by_id',array("id"=>$user_ass_data['creator']));
                if($userData['success']=='true')
                {
                    $userData = $userData['data'][0];
                    $userId_data[$userData['id']] = $userData;
                    $user_ass_data['creator_name'] = '';
                }
                else
                {
                    $user_ass_data['creator_name'] = $ui_string['n/a'];
                }
                    
               } 
               if(isset($userId_data[$user_ass_data['userid']]))
               {
                    $user_ass_data['assinee_name'] = $userId_data[$user_ass_data['userid']]['name'];
               }
               else
               {
                  $userData = curl_post('/get_resource_by_id',array("id"=>$user_ass_data['userid']));
                  if($userData['success']=='true')
                  {
                    $userData = $userData['data'][0];
                    $userId_data[$userData['id']] = $userData;
                    $user_ass_data['assinee_name'] = '';
                  }
                  else
                  {
                    $user_ass_data['assinee_name'] = $ui_string['n/a'];
                  }
               }
               
               $user_ass_data['status_name'] = '';
               array_push($job_data, $user_ass_data);
            }     
        }
        $final_data = array('job_data'=>$job_data,'total_count'=>$total_count);
        return array("data"=>$final_data,"success"=>"true","error_code"=>"5085");
    }
    else
    {
        return $check;
    }
}
/*
function getformstatus($status){
            global $ui_string;
            
            if($status=='0')      { $statusString=$ui_string['new']; }
            elseif($status=='1')  { $statusString=$ui_string['send_for_approval']; }
            elseif($status=='2')  { $statusString=$ui_string['approved']; }
            elseif($status=='3')  { $statusString=$ui_string['rejected']; }
            elseif($status=='4')  { $statusString=$ui_string['incomplete']; }
            elseif($status=='5')  { $statusString=$ui_string['closed']; }
            elseif($status=='6')  { $statusString=$ui_string['closenotified'];}
            elseif($status=='7')  { $statusString=$ui_string['editdone']; }
            elseif($status=='8')  { $statusString=$ui_string['tobeedit']; }
            else                  { $statusString='---';}
       
            return $statusString;
}*/
function get_jobStatus($data)
{
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') 
    {
        $fet_data = array();
        $Select = " * ";
        $from = "jobassignedstatus";
        $cond = " 1 AND iid = ". $data['id']. " order by id limit 0,1  ";

        $get_data = Select_Some($Select, $from, $cond);
        
        if (mysqli_num_rows($get_data)) {
            $fet_data = mysqli_fetch_assoc($get_data);
           return array("data"=>$fet_data,"success"=>"true","error_code"=>"5087");
        }
        else
        {
            return array("data"=>$fet_data,"success"=>"false","error_code"=>"5086");
        }

    }
    else
    {
        return $check;
    }
}
function extension_approval_process($data)
{
    $check = check_key_available($data, array('id','update_by','current_value'));
    if ($check['success'] == 'true') 
    {
        $attributes = "";
        $current_value = "";
        if($data['current_value']=='1')
        {
            $attributes .= "status";
            $current_value .= "1";

            $attributes .= ",assign";
            $current_value .= ",".$data['update_by'];
            
        }
        else if($data['current_value']=='2')
        {
            $attributes .= ",assign";
            $current_value .= ",".$data['update_by'];

            $attributes = "status";
            $current_value = "2";

            $attributes .= ",assign";
            $current_value .= ",".$data['jobData']['creator'];
        }
        else if($data['current_value']=='3')
        {
            $attributes .= ",assign";
            $current_value .= ",".$data['update_by'];

            $hist_cond = array("status"=>"assign","record"=>"1","iid"=>$data['id'],"current_status"=>"1","to_id"=>"'".$data['update_by']."'");
            $hist_data = get_history($hist_cond);
            if($hist_data['success']=='true' && is_array($hist_data['data']) && count($hist_data['data']))
            {
                $hist_data = $hist_data['data'][0];
                $attributes .= ",assign";
                $current_value .= ",".$hist_data['from_id'];
            }
            else
            {
                $attributes .= ",assign";
                $current_value .= ",".$data['jobData']['creator'];
            }
        }
        
        if(isset($data['jobData']))
        {
            unset($data['jobData']);
        }
        $res = array();
        if(count($data))
        {
            $data['attributes'] = $attributes;
            $data['current_value'] = $current_value;
            //pr($data); die('lolp');
            $res = manage_job($data);
            if($res['success']=='true')
            {
                return array("data"=>$res,"success"=>"true","error_code"=>"50311");
            }
            else
            {
                return array("data"=>$res,"success"=>"false","error_code"=>"50311");
            }
            
        }
        else
        {
            return array("data"=>$res,"success"=>"false","error_code"=>"50311");
        }

    }
    else
    {
        return $check;
    }
}
function extensionjob_approval_done_process($data)
{
     
    $check = check_key_available($data, array('id','action'));
    if ($check['success'] == 'true') 
    {
        if($data['action']=='send_for_approval')
        {

        }

    }
    else
    {
        return $check;
    }


}
function ex_fetch_collection($data)
{
    $check = check_key_available($data, array('table'));
    if ($check['success'] == 'true') 
    {
        $table = $data['table'];
        unset($data['table']);
        if(isset($data['index']))
        {
          $index = $data['index'];
          unset($data['index']);
        }
        if(isset($data['nor']))
        {
          $index = $data['nor'];
          unset($data['nor']);
        }
        if(isset($data['orderby']))
        {  
          $order_by = array();
          $orderby[$data['orderby']]=-1;  
          unset($data['orderby']);

        }
        if(!count($data))
        {
           $data = array();
        }
        if(isset($index) && isset($nor))
        {
            $tmp = select_sort_limit_mongo($table,$data,array(),$orderby,$index,$nor);
        }
        else
        {
          $tmp=select_mongo($table,$data);
        }
        $return=add_id($tmp,"id");    
        return array('data'=>$return,'success'=>'true','error_code'=>'check');
    }
    else
    {
        return $check;
    }
}
function ex_drop_collection($data)
{
   $check = check_key_available($data, array('table'));
   if($check)
   {
     $table = $data['table'];
     $condition = array();
     $res = delete_mongo($table,$condition);
     return array('data'=>$res,'success'=>'true','error_code'=>'delete');
   }
   else
   {
     return $check;
   }
  
   
}
function manageAppLogs($data)
{

   $check = check_key_available($data, array('url','dateTime','request','response'));
   if($check['success']=='true')
   {
     $data['serverTime'] = time();
     $res = insert_mongo('appLogs',$data);
     return array('data'=>'','success'=>'true','error_code'=>'100');
   }
   else
   {
     return $check;
   }
  
   
}
?>