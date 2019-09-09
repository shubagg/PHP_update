<?php
require_once "../global.php";
function handleRenderComponents($action,$params,$html){
	switch ($action) {
		case 'PROJECT_LIST':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson = array_merge($paramJson,$params);

			$data = curl_post("/get_project_by_type",$paramJson);
			$data = $data['data'];

			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="conf_projectId";
			$htmlParams['label']="Project List";
			$htmlParams['name']="conf_projectId";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="" >All</option>';
			}
			
			foreach($data as $project)
			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$project['id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$project['id'].'" '.$selected.'>'.$project['name'].'</option>';
				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;
		case 'JOBSTATUS':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson['id']='0';
			$paramJson = array_merge($paramJson,$params);
			$get_jobs_module_setting=curl_post("/get_module_setting_by_mid",array("mid"=>'5',"smid"=>'1'));
    		$json_setting=$get_jobs_module_setting["data"][0]["uiSetting"]; 
    		//pr($json_setting);
			$htmlParams=[];
			$htmlParams = array_merge($htmlParams,$html);
			//pr(count($json_setting['status']));
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="all" >All</option>';
			}
			for($i=0;$i<count($json_setting['status']);$i++)

			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$json_setting['statusId'][$i])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$json_setting['statusId'][$i].'" '.$selected.'>'.$json_setting['status'][$i].'</option>';				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;
		case 'JOB_CATEGORY':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson['id']='0';
			$paramJson = array_merge($paramJson,$params);
			$get_jobs_module_setting=curl_post("/get_module_setting_by_mid",array("mid"=>'5',"smid"=>'1'));
    		$json_setting=$get_jobs_module_setting["data"][0]["uiSetting"]; 
    		$htmlParams=[];
    		$htmlParams['id']="conf_category";
			$htmlParams['label']="Category";
			$htmlParams['name']="conf_category";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="all" >All</option>';
			}
			for($i=0;$i<count($json_setting['jobcategory']);$i++)

			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$json_setting['jobcategoryId'][$i])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$json_setting['jobcategoryId'][$i].'" '.$selected.'>'.$json_setting['jobcategory'][$i].'</option>';				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;
				case 'JOB_CATEGORY':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson['id']='0';
			$paramJson = array_merge($paramJson,$params);
			$get_jobs_module_setting=curl_post("/get_module_setting_by_mid",array("mid"=>'5',"smid"=>'1'));
    		$json_setting=$get_jobs_module_setting["data"][0]["uiSetting"]; 
    		$htmlParams=[];
    		$htmlParams['id']="conf_category";
			$htmlParams['label']="Category";
			$htmlParams['name']="conf_category";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="all" >All</option>';
			}
			for($i=0;$i<count($json_setting['jobcategory']);$i++)

			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$json_setting['jobcategoryId'][$i])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$json_setting['jobcategoryId'][$i].'" '.$selected.'>'.$json_setting['jobcategory'][$i].'</option>';				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;
		case 'JOB_PRIORITY':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson['id']='0';
			$paramJson = array_merge($paramJson,$params);
			$get_jobs_module_setting=curl_post("/get_module_setting_by_mid",array("mid"=>'5',"smid"=>'1'));
    		$json_setting=$get_jobs_module_setting["data"][0]["uiSetting"]; 
    		$htmlParams=[];
    		$htmlParams['id']="conf_priority";
			$htmlParams['label']="Priority";
			$htmlParams['name']="conf_priority";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="all" >All</option>';
			}
			for($i=0;$i<count($json_setting['priority']);$i++)

			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$json_setting['priorityId'][$i])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$json_setting['priorityId'][$i].'" '.$selected.'>'.$json_setting['priority'][$i].'</option>';				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;
		case 'ASSIGN':
			$paramJson=[];
			$paramJson = array_merge($paramJson,$params);
			$paramJson['user_type']='user';
			$paramJson['fields']='name,email';
			$data = curl_post("/get_resource_by_id",$paramJson);
			$data = $data['data'];

			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="conf_userId";
			if(isset($html['default']) && ($html['default']=='no'))
			{
				$htmlParams['label']="Employee Name";
			}
			else
			{
				$htmlParams['label']="Assign To";
			}
			$htmlParams['name']="conf_userId";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = '<option value="all" '.$selected.'>All</option>';
			}
			else
			{
				$option ='';
			}
			foreach($data as $assign)
			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$assign['id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$assign['id'].'" '.$selected.'>'.$assign['name'].' ('.$assign['email'].')</option>';
				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;

		case 'FORM_LIST':
			$paramJson=[];
			$paramJson = array_merge($paramJson,$params);
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['label']="Form List";
			$htmlParams['name']="conf_formid";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="" >All</option>';
			}
			$query = "SELECT DISTINCT form_id FROM job";

            $getformlist=mysql_query($query);
            $formid="";
            while($gdata = mysql_fetch_assoc($getformlist))
            {
            	$formid.=$gdata['form_id']."|";
            }
            if($formid!=""){
            	$formid=substr($formid,0,-1);
            }
           	$getformName=get_form_by_id(array('id'=>$formid,'fields'=>'title'));
			if(sizeof($getformName['data'])>0){
				$dataa=$getformName['data'];	
				foreach ($dataa as $data) {
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$data['id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
			
				$option .= '<option value="'.$data['id'].'" '.$selected.'>'.$data['title'].'</option>';
				}
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			
			$html = get_select_box($htmlParams);

		break;

		case 'GET_QUERY':

			$data = curl_post("/get_saved_queries",array('userId'=>$html['userid']));
			$data = $data['data'];
			

			//Render Dropdown
			$htmlParams=[];
			$htmlParams['name']="conf_query";
			$htmlParams = array_merge($htmlParams,$html);
			
			foreach($data as $query)
			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$query['id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$query['id'].'" '.$selected.'>'.$query['name'].'</option>';
				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;
		case 'PRODUCT_LIST':
			$paramJson=[];
			$paramJson['id']='0';
			$paramJson = array_merge($paramJson,$params);

			$data = get_product_by_id(array('id'=>'0','fields'=>'title'));
			$data = $data['data'];
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="conf_projectId";
			$htmlParams['label']="Project List";
			$htmlParams['name']="conf_projectId";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="" >Select Product</option>';
			}
			
			foreach($data as $project)
			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$project['id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$project['id'].'" '.$selected.'>'.$project['title'].'</option>';
				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';

			$html = get_select_box($htmlParams);
			
		break;
		case 'UI_SETTING':
			$paramJson=[];
			$paramJson['mid']='5';
			$paramJson['smid']='2';
			$paramJson['request_type']='status';
			//$paramJson['status']='L';
			$paramJson = array_merge($paramJson,$params);
			include_once(framework_doc_path() . 'internalApi/settings/setting_mgmt_lib.php');
			$data = get_setting($paramJson);
			$data = $data['data'];
			
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="cr-".$request_type;
			$htmlParams['label']= $request_type;
			$htmlParams['name']="cr-".$request_type;
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="-1" >All</option>';
			}
			
			foreach($data as $key => $value)
			{
				$option.= "<option value='".$key."'".">".$value."</option>"; 
				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'VENDOR_LIST':
			$paramJson=[];
			
			$data = get_category_users(array('category_ids'=>'594cb47bd88bfde81b000029','fields'=>'name'));
			$data = $data['data'];

			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="cr-user_list_hierarchy";
			$htmlParams['label']="USER LIST HIERARCHY";
			$htmlParams['name']="cr-user_list_hierarchy";
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			
			$option = '<option value="" >Select User</option>';
			foreach($data as $user_key => $user_value)
			{
				$option.="<option value='".$user_value['id']."'>".$user_value['name']."</option>";
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'WAREHOUSE_USERS':
			$data = get_all_users_by_enrollment(array('mid'=>'41','smid'=>'1','itemId'=>$params['warehouse'],'proj_group_id'=>STORE_USER_ROLE_ID));
			$data = $data['data'];

			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="cr-user_list_hierarchy";
			$htmlParams['label']="USER LIST HIERARCHY";
			$htmlParams['name']="cr-user_list_hierarchy";
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			
			$option = '<option value="" >Select User</option>';
			foreach($data as $user_key => $user_value)
			{
				$option.="<option value='".$user_value['id']."'>".$user_value['name']."</option>";
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'USER_LIST_HIERARCHY':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson['smid']='1';
			
			
			$paramJson = array_merge($paramJson,$params);
			if(isset($paramJson['userid']))
			{
				$paramJson['userId'] = $paramJson['userid'];
				unset($paramJson['userid']);
			}
			$data = curl_post("/get_user_hirarchy",$paramJson);
			$data = $data['data'];

			//pr($paramJson['userId']);
			if(!isset($data[$paramJson['userId']]))
			{
			  $cur_user = curl_post("/get_resource_by_id",array("id"=>$paramJson['userId']));
			  $cur_user_data = $cur_user['data'][0];
			  $data[$cur_user_data['id']] = $cur_user_data;
			}
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="cr-user_list_hierarchy";
			$htmlParams['label']="USER LIST HIERARCHY";
			$htmlParams['name']="cr-user_list_hierarchy";
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="-1" >All</option>';
			}
			
			foreach($data as $user_key => $user_value)
			{
				
				$option.="<option value='".$user_key."'>".$user_value['name']."</option>";
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'USERS_LIST':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson['smid']='1';
			
			
			$paramJson = array_merge($paramJson,$params);
			if(isset($paramJson['userid']))
			{
				$paramJson['userId'] = $paramJson['userid'];
				unset($paramJson['userid']);
			}
			$data = curl_post("/get_resource_by_id",array('id'=>0));
			$data = $data['data'];
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="cr-users_list";
			$htmlParams['label']="USERS LIST";
			$htmlParams['name']="cr-users_list";
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="-1" >All</option>';
			}
			
			foreach($data as $user_key => $user_value)
			{
				
				$option.="<option value='".$user_value['id']."'>".$user_value['name']."</option>";
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'JOB':
			$paramJson=[];
			$paramJson['mid']='5';
			$paramJson['smid']='1';
			
			//$paramJson['status']='L';
			$paramJson = array_merge($paramJson,$params);

			//$data = curl_post("/get_job_by_id",$paramJson);
			
			$data = get_adv_jobs($paramJson);
			$data1 = $data['data']['data'];
			
			
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="cr-job";
			$htmlParams['label']= "cr-job-lable";
			$htmlParams['name']="cr-job-name";
			$htmlParams['attributes']='';
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="" >Select Job</option>';
			}
			
			foreach($data1 as $key => $value)
			{
				$option.= "<option value='".$value['jobId']."'".">".$value['title']."</option>"; 
				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'JOB_ASSIGN_OR_CREATOR':
			$paramJson=[];
			$paramJson['id']=0;
			$paramJson['mid']='5';
			$paramJson['smid']='1';
			
			//$paramJson['status']='L';
			$paramJson = array_merge($paramJson,$params);
			if(isset($paramJson['userid']))
			{
				$paramJson['query_str'] = " j.creator = "."'".$paramJson['userid']."'" ." OR ja.userid = ". "'".$paramJson['userid']."'";
				unset($paramJson['userid']);
			}
			
			//$data = curl_post("/get_adv_jobs",$paramJson);
			$data = get_adv_jobs($paramJson);
			$data1 = $data['data']['data'];
			//pr($data); die;
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="cr-job";
			$htmlParams['label']= "cr-job-lable";
			$htmlParams['name']="cr-job-name";
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			if(isset($htmlParams['default']) && ($htmlParams['default']=='no'))
			{
				$option = ' ';
			}
			else
			{
				$option = '<option value="" >Select Job</option>';
			}
			
			foreach($data1 as $key => $value)
			{
				$option.= "<option value='".$value['jobId']."'".">".$value['title']."</option>"; 
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'TEXTAERA':
			
			//Render Dropdown

			$htmlParams=[];
			$htmlParams['id']="cr-textarea";
			$htmlParams['label']="textarea";
			$htmlParams['name']="cr-textarea";
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);
			
			
			
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='textarea';

			$html = get_form_inputs($htmlParams);
			
		break;
		case 'TEXTBOX':
			
			//Render Dropdown

			$htmlParams=[];
			$htmlParams['id']="cr-textbox";
			$htmlParams['label']="textbox";
			$htmlParams['name']="cr-textbox";
			$htmlParams['classes']="";
			$htmlParams['value']="";
			$htmlParams['textbox_type']="";
			
			$htmlParams = array_merge($htmlParams,$html);
			
			
			
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='textbox';

			$html = get_form_inputs($htmlParams);
			
		break;

		case 'DATE':
			
			//Render Dropdown

			$htmlParams=[];
			$htmlParams['id']="cr-date";
			//$htmlParams['label']="date";
			$htmlParams['name']="cr-date";
			$htmlParams['classes']="";
			$htmlParams['value']="";
			$htmlParams['textbox_type']="";
			
			$htmlParams = array_merge($htmlParams,$html);
			
			
			
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='date';

			$html = get_form_inputs($htmlParams);
			
		break;

		case 'STATUSES':
			$paramJson=[];
			$paramJson['smid']='1';
			$paramJson = array_merge($paramJson,$params);

			$data = curl_post("",$paramJson);
			$data = $data['data'];

			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="conf_status";
			$htmlParams['name']="conf_status";
			$htmlParams['classes']="";
			$htmlParams = array_merge($htmlParams,$html);

			$option = '<option value="-1" >All</option>';
			foreach($data as $project)
			{
				if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					if($html['selected_value']==$project['id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}

			$option .= '<option value="'.$project['id'].'" '.$selected.'>'.$project['name'].'</option>';				
			}
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'STATICTYPE':
			$htmlParams=[];
			$htmlParams['id']="conf_statsticType";
			$htmlParams['label']="Static type";
			$htmlParams['name']="conf_statsticType";
			$htmlParams = array_merge($htmlParams,$html);
				if($html['selected_value'] == 'priority')
            {
                $selected1 = 'selected="selected"';
            }
            if($html['selected_value'] == 'type')
            {
                $selected2 = 'selected="selected"';
            }
            if($html['selected_value'] == 'severity')
            {
                $selected3 = 'selected="selected"';
            }
            if($html['selected_value'] == 'status')
            {
                $selected4 = 'selected="selected"';
            }
 			$option .= '<option value="priority" '.$selected1.'>Priority</option>';
            $option .= '<option value="type" '.$selected2.'>Type</option>';
            $option .= '<option value="severity" '.$selected3.'>Severity</option>';
            $option .= '<option value="status" '.$selected4.'>Status</option>';
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;

		
			case 'SORTDIR':
			$htmlParams=[];
			$htmlParams['id']="conf_period";
			$htmlParams['label']="Sort Direction";
			$htmlParams['name']="conf_sort_dir";
			if($html['selected_value'] == 'asc')
            {
                $selected1 = 'selected="selected"';
            }
            if($html['selected_value'] == 'desc')
            {
                $selected2 = 'selected="selected"';
            }
 			$option .= '<option value="asc" '.$selected1.'>Acsending</option>';
            $option .= '<option value="desc" '.$selected2.'>Decending</option>';

			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
		case 'DATEPICKER':
			
			//Render Dropdown

			$htmlParams=[];
			$htmlParams['id']="cr-textbox";
			$htmlParams['label']="textbox";
			$htmlParams['name']="cr-textbox";
			$htmlParams['classes']="";
			$htmlParams['value']="";
			$htmlParams['textbox_type']="";
			$htmlParams['mandatory']="false";
			
			$htmlParams = array_merge($htmlParams,$html);			
			
			$htmlParams['option_result'] = $option;
			$htmlParams['boxtype'] ='text';
			
				$htmlParams['type'] ='date_picker';
		
			$html = get_form_inputs($htmlParams);
			
		break;

		case 'ATTENDANCE':
			$htmlParams=[];
			$htmlParams['id']="conf_day";
			$htmlParams['label']="Day Of Attendance";
			$htmlParams['name']="conf_day";
			if($html['selected_value'] == 'today')
            {
                $selected1 = 'selected="selected"';
            }
            if($html['selected_value'] == 'yesterday')
            {
                $selected2 = 'selected="selected"';
            }
 			$option .= '<option value="today" '.$selected1.'>Current day</option>';
            $option .= '<option value="yesterday" '.$selected2.'>Previous Day</option>';

			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;
			case 'PERIOD':
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="conf_period";
			$htmlParams['label']="Period";
			$htmlParams['name']="conf_period";
			$html['selected']="period";
		
            if($html['selected_value'] == 'W')
            {
                $selected2 = 'selected="selected"';
            }
            if($html['selected_value'] == 'M')
            {
                $selected3 = 'selected="selected"';
            }
            
			$htmlParams = array_merge($htmlParams,$html);
            $option .= '<option value="W" '.$selected2.' >Weekly</option>';
            $option .= '<option value="M" '.$selected3.' >Monthly</option>';

			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;

		case 'RESOURCE_PERIOD':
			//Render Dropdown
			$htmlParams=[];
			$htmlParams['id']="conf_period";
			$htmlParams['label']="Period";
			$htmlParams['name']="conf_period";
			$html['selected']="period";
			if($html['selected_value'] == 'D')
            {
                $selected1 = 'selected="selected"';
            }
            if($html['selected_value'] == 'W')
            {
                $selected2 = 'selected="selected"';
            }
            if($html['selected_value'] == 'M')
            {
                $selected3 = 'selected="selected"';
            }

            
			$htmlParams = array_merge($htmlParams,$html);
			$option .= '<option value="D" '.$selected1.' >Daily</option>';
            $option .= '<option value="W" '.$selected2.' >Weekly</option>';
            $option .= '<option value="M" '.$selected3.' >Monthly</option>';

			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
		break;

	
		case 'DASH_TYPE':
			//Render Dropdown
			$htmlParams=[];
			$name=$html['name'];
			$type=$html['type'];
			$label=$html['label'];
			$array=array();
			$item=explode('|', $html['item']);
					foreach($item as $items)
					{
                          array_push($array,$items);
					}
                     $radioButtonResult=  json_encode($array,JSON_FORCE_OBJECT);
			$html = get_radio_button($type,$label,$radioButtonResult,$name,'');
			break;

			case 'CHECK_BOX':
			$htmlParams=[];
			$name=$html['name'];
			$type=$html['type'];
			$label=$html['label'];
			$array=array();
			$item=explode('|', $html['item']);
					foreach($item as $items)
					{
                          array_push($array,$items);
					}
                     $radioButtonResult=  json_encode($array,JSON_FORCE_OBJECT);
			$html = get_checkbox($type,$label,$radioButtonResult,$name,'');
			break;


		case 'DAYS_PREV':
		//Render Dropdown
			$htmlParams=[];
			$name=$html['name'];
			$label=$html['label'];
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$class='form-control required_field addChart';
			
			if(isset($html['selected_value']) && $html['selected_value'] !='')
				{
					
						$value =$html['selected_value'];	
				}
				else
				{
						$value = '';
				}
			$html="<div class='form-group'>
<label class='control-label remove_bg'>".$label."</label><div><input type='text' id='".$name."'  name='".$name."' value='".$value."' class='".$class."' data-check-valid='blank,numeric,nospecial' data-error-text='Field Required'  data-valid-nospecial-error='Please enter valid Previous Days' data-valid-numeric-error='Enter a Numeric Value' data-error-show-in='eprevdays' data-error-setting='2'></div></div>";
		break;


		case 'AVG_DURATION':
		    $htmlParams=[];
			$htmlParams['id']="conf_avg_dur";
			$htmlParams['label']="average duration in status";
			$htmlParams['name']="conf_avg_dur";
			$htmlParams['selected']="period";
			$htmlParams = array_merge($htmlParams,$html);
			if($html['selected_value'] == 'hourly')
            {
                $selected1 = 'selected="selected"';
            }
            if($html['selected_value'] == 'daily')
            {
                $selected2 = 'selected="selected"';
            }
			$option .= '<option value="hourly" '.$selected1.'>Hourly</option>';
 			$option .= '<option value="daily" '.$selected2.'>Daily</option>';
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);
			break;

		case 'DATA_TYPE':
		    $htmlParams=[];
		    if($html['selected_value'] == 'created')
            {
                $selected1 = 'selected="selected"';
            }
            if($html['selected_value'] == 'resolved')
            {
                $selected2 = 'selected="selected"';
            }
			$htmlParams = array_merge($htmlParams,$html);
			$option .= '<option value="created" '.$selected1.'>Created</option>';
 			$option .= '<option value="resolved" '.$selected2.'>Resolved</option>';
			$htmlParams['option_result'] = $option;
			$htmlParams['type'] ='select';
			$html = get_select_box($htmlParams);

		
				default:
			# code...
	}
	return $html;
}
$params = [];
$action="";
$htmlParams=[];
if(!isset($_REQUEST['action'])){
		return "no action";
	}
if(isset($_REQUEST['params'])){
	$params=json_decode($_REQUEST['params'],true);
}
if(isset($_REQUEST['html'])){
	$htmlParams=json_decode($_REQUEST['html'],true);
}
echo handleRenderComponents($_REQUEST['action'],$params,$htmlParams);

?>