<?php

/******Feedback Form Work Start******/
function create_extension_feedback_form($data)
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
   $data['approval_data'] = $approval_data;

   $result_job = curl_post('/create_form_job',$data);
   
   if(($result_job['success']=='true') && count($result_job['data']['data']))
   {
     	 $result_job = $result_job['data']['data'];
       return array("data"=>$result_job,"success"=>"true","error_code"=>"50311");
    }
    else
    {
   	  return array("data"=>$result_job,"success"=>"false","error_code"=>"50311");
    }
   
}
function get_feedback_jobs($data)
{
    //pr($data); die;
    global $ui_string;
    $new_data = array();
    $job_data = array();
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
            
                $userIds .= $key.",";
            }
            $userIds = trim($userIds,",");
            
        }
        if(!isset($data['id']))
        {
          $new_data['id'] = 0;
        }
        else
        {
           $new_data['id'] = $data['id'];
        }
        if(isset($data['offset']))
        {
          $new_data['index'] = $data['offset'];
        }
        if(isset($data['query_str']))
        {
          $new_data['query_str'] = $data['query_str'];
        }
        if(isset($data['limit']))
        {
          $new_data['nor'] = $data['limit'];
        }
        $new_data['smid'] = 3;
        $new_data['creator'] = $userIds;
        //pr($new_data); die;
        $fet_data = curl_post('/get_job_by_id',$new_data); 
        $fet_data = $fet_data['data'];
       
        if (is_array($fet_data)) 
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
            foreach ($fet_data as $key => $user_ass_data) {
           // pr($user_ass_data); die;
                $link = site_url().'admin/feedbackform/filledformdetails?formtype=pendingform&jobId='.$user_ass_data['id'].'&formid='.$user_ass_data['form_id'];
               $user_ass_data['jobId'] =  '<a href="'.$link.'">'.$user_ass_data['id'].'</a>';
               
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
                    $user_ass_data['creator_name'] = $userData['name'];
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
              // pr($job_data); die;
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
/*
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


}*/
?>