<?php

class process {
   
   var $dynamic_export_data = '';
   var $dynamic_export_json_data = '';
   var $dynamic_json_data = '';
   var $advance_seach_json_data = '';
   var $listing_data = '';
   var $userId = "";
   var $table_header = array();
   
   //$custom_buttons = "";
    function __construct() {
        global $ui_string;

    }
    function call_process($data) {
        $this->process_data($data);
    }
    
    function process_data($data) {
        global $ui_string,$webservice_url;

        $template = !empty($data['template']) ? $data['template'] : 'default';
        
        $where = '';
        $qry_where = '';
        if(!empty($data['advanced_search_data'])) {
            if(!empty($data['advanced_search_data']['adv_search_key'])) {
                foreach($data['advanced_search_data']['adv_search_key'] as $k => $v) {
                    if(!empty($data['advanced_search_data']['adv_search_equivalent'][$k]) && !empty($data['advanced_search_data']['adv_search_value'][$k])) {
                        $qry_where .= '`'. $v . '` ' . $ui_string['db_' . $data['advanced_search_data']['adv_search_equivalent'][$k]] . ' "' . $data['advanced_search_data']['adv_search_value'][$k] . '" ' . $data['advanced_search_data']['adv_conditional_operator'][$k] . ' ';
                        $where .= $v . ' ' . $ui_string['db_' . $data['advanced_search_data']['adv_search_equivalent'][$k]] . ' ' . $data['advanced_search_data']['adv_search_value'][$k] . ' ' . $data['advanced_search_data']['adv_conditional_operator'][$k] . ' ';
                    }
                }
            }
        }
        $data['adv_search_qry_where'] = $qry_where;
        $data['adv_search_where'] = $where;
        $this->custom_buttons = $this->custom_buttons(); 
        //$this->customise_listing_data();
        $this->set_template($template, $data);
        
    }
    function get_advance_search()
    {
        global $ui_string,$webservice_url;
        $search_data = isset($this->dynamic_json_data['advanced_search']['status']) ? $this->dynamic_json_data['advanced_search']['status'] : 'false';
        $adv_search_details = false;

        if($search_data=='true')
        {
            $listing_data = $this->dynamic_json_data['advanced_search']['adv_search_col_listing'];//$this->customise_listing_data();
           // echo "<pre>"; print_r($listing_data); die;
            if(is_array($listing_data) && count($listing_data))
            {  
                $select_list = array();
                $adv_search_equivalent = array();
                foreach ($listing_data as $key => $value) {
                    
                   array_push($select_list,$value);
                    
                }
                if(isset($this->dynamic_json_data['advanced_search']['search_equivalent']) && is_array($this->dynamic_json_data['advanced_search']['search_equivalent']))
                {
                    $adv_search_equivalent = $this->dynamic_json_data['advanced_search']['search_equivalent'];
                }
                $adv_call_func = '';
                if(isset($this->dynamic_json_data['advanced_search']['adv_call_func']))
                {
                    $adv_call_func = $this->dynamic_json_data['advanced_search']['adv_call_func'];
                }
                $adv_callBack_func = '';
                if(isset($this->dynamic_json_data['advanced_search']['adv_callBack_func']))
                {
                    $adv_callBack_func = $this->dynamic_json_data['advanced_search']['adv_callBack_func'];
                }
                $adv_div_id = 'stadd';
                if(isset($this->dynamic_json_data['advanced_search']['div_id']))
                {
                    $adv_div_id = $this->dynamic_json_data['advanced_search']['div_id'];
                }
                $adv_search_details = array('adv_search_listing'=>$select_list,'adv_search_equivalent'=>$adv_search_equivalent,'adv_call_func'=>$adv_call_func,'adv_callBack_func'=>$adv_callBack_func,'div_id'=>$adv_div_id);
            }
            // echo "<pre>"; print_r($adv_search_details); die;
            
            $this->advance_seach_json_data = json_encode($adv_search_details); 
           // pr($adv_search_details); die;
            return $adv_search_details;
        }
        else
        {
            $this->advance_seach_json_data = json_encode($adv_search_details);
            return $adv_search_details;
        }
    }
    function get_advance_search_heading()
    {
        global $ui_string,$webservice_url;
        $search_data = isset($this->dynamic_json_data['advanced_search']['status']) ? $this->dynamic_json_data['advanced_search']['status'] : 'false';
        $adv_search_details = false;
        $adv_search_heading = '';
        if($search_data=='true')
        {
            $adv_search_heading = $this->dynamic_json_data['advanced_search']['page_heading'];
        }
        
        return $adv_search_heading;


    }
    function customise_listing_data()
    {
        global $ui_string,$webservice_url;
        if($this->listing_data=='')
        {
            
            $listing_data = isset($this->dynamic_json_data['listing_details']) ? $this->dynamic_json_data['listing_details'] : false;
            
            $columns_listing_cookies = $listing_data['columns_listing'];
            if(isset($_COOKIE[$this->userId]))
            {
                $cookies_data = json_decode($_COOKIE[$this->userId],true);
                
            }
            //echo "<pre>"; print_r($cookies_data); die;
            //$_COOKIE[$_REQUEST['type']] = $columns_listing_cookies;
            $cl_Temp_array = array();
            if(isset($listing_data['column_setting']) && $listing_data['column_setting'] =='true' && isset($cookies_data[$_REQUEST['type']]))
            {   
               for($i=0; $i<count($listing_data['columns_listing']); $i++)
               {
                    
                   if(in_array($listing_data['columns_listing'][$i]['column_heading'],$cookies_data[$_REQUEST['type']]))
                   {
                    
                      array_push($cl_Temp_array, $listing_data['columns_listing'][$i]);
                   } 
               }
               $listing_data['columns_listing'] = $cl_Temp_array;
            }
            
            $request_url_params = array();
            $request_url_params_temp = $listing_data['request_url_params']; 
            if(is_array($request_url_params_temp) && count($request_url_params_temp))
            {   
                foreach ($request_url_params_temp as $key => $value) {
                    if(isset($_REQUEST[$key]))
                    {
                        $request_url_params[$value] = $_REQUEST[$key]; 
                    }
                    
                }

            }
            $columns_listing = $listing_data['columns_listing'];
            $listing_data['request_url_params'] = $request_url_params; 
            $columns_listing_json = json_encode($listing_data);

            return $this->listing_data = $listing_data;
            
        }
        else
        {
            return $this->listing_data;
        }
    }
    function get_table_header()
    {
        global $ui_string,$webservice_url;
        if(isset($this->listing_data['columns_listing']) && is_array($this->listing_data['columns_listing']))
        {
            foreach ($this->listing_data['columns_listing'] as $key => $value) {
               // print_r($value); die;
                array_push($this->table_header,$value['column_heading']);
            }
        }
        else
        {
            $this->customise_listing_data();
            if(isset($this->listing_data['columns_listing']) && is_array($this->listing_data['columns_listing']))
            {
                foreach ($this->listing_data['columns_listing'] as $key => $value) {
                    
                    array_push($this->table_header,$value['column_heading']);
                }
            }
        }
        return $this->table_header;
    }
    function set_template($template, $request_data) {
        global $site_url;
        global $ui_string;
        global $server_path;
        global $webservice_url;
        
        if(isset($request_data['templatePath']) && $request_data['templatePath']!='')
        {
            include_once($server_path.$request_data['templatePath'].$template.'.tpl.php');
            
        }
        else
        {
            
        include_once(include_admin_template("common_templates", $template));
        }
        
        $columns_listing_json = json_encode($this->customise_listing_data());
        $advance_seach_data = $this->advance_seach_json_data;
        require_once($server_path.'ui/admin/controller/script.php');
    }
    
    function adv_version2($adv_data) {
        if(!empty($adv_data['status']) && $adv_data['status'] == 'true') {
            global $ui_string, $webservice_url;
            include_once(framework_doc_path() . 'internalApi/settings/setting_mgmt_lib.php');
            $options_values = get_setting(array("mid" => '5', "smid" => '2', 'request_type' => 'allsetting', 'label' => 1, 'setting_type' => array('jobtype', 'status', 'priority', 'severity')));
            include_once(include_admin_template("common_templates", 'advanced_v2_search'));
        }
    }
    
    function adv_version2_charts($adv_data) {
        if(!empty($adv_data['status']) && $adv_data['status'] == 'true') {
            global $ui_string, $webservice_url;
            include_once(framework_doc_path() . 'internalApi/settings/setting_mgmt_lib.php');
            $options_values = get_setting(array("mid" => '5', "smid" => '2', 'request_type' => 'allsetting', 'label' => 1, 'setting_type' => array('jobtype', 'status', 'priority', 'severity')));
            include_once(include_admin_template("common_templates", 'advanced_v2_chart_search'));
        }
    }
    
    function custom_buttons()
    {
        global $ui_string,$webservice_url;
        
        $listing_data = isset($this->dynamic_json_data['listing_details']) ? $this->dynamic_json_data['listing_details'] : false;

        if($listing_data)
        {
            if(isset($listing_data['custom_buttons']) && $listing_data['custom_buttons']=='true')
            {
                if(isset($listing_data['custom_buttons_setting']) && is_array($listing_data['custom_buttons_setting']) && count($listing_data['custom_buttons_setting']))
                {
                    $custom_buttons_data = '';
                    foreach ($listing_data['custom_buttons_setting'] as $key => $value) {
                            
                         $button_data = $this->make_feild($value); 
                         if($button_data)
                         {
                            $custom_buttons_data .= $button_data . '&nbsp';
                         } 
                    }
                    return $custom_buttons_data;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        
    }
    function make_feild($data)
    {
        global $ui_string,$webservice_url;
    switch (strtolower($data['type'])) {
    case 'input_button':
        
        
        $id = isset($data['id']) ? $data['id'] : '';
        $class = isset($data['class']) ? $data['class'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $name = isset($data['name']) ? $data['name'] : '';
        $title = isset($data['title']) ? $data['title'] : '';
        $type = isset($data['type']) ? $data['type'] : '';
        $fa_icon = isset($data['fa_icon']) ? $data['fa_icon'] : '';    



        $on_event = isset($data['on_event']) ? $data['on_event'] : '';
        $callback_function = isset($data['callback_function']) ? $data['callback_function'] : '';
        
        $button = "<button ";
        $button .= "id =" . "'".$id."'" ;
        $button .= "class =" . "'".$class."'" ;
        
        $button .= "name =" . "'".$name."'" ;
        $button .= "title =" . "'".$title."'" ;
       // $button .= "type =" . "'".$type."'" ;
        $button .= $on_event.'='."'".$callback_function.'()'."'";
       
        $button .= " > ";
        $button .= $value ;
        if(count($fa_icon)>0)
        {
            $button .= "<span><i " ;
            foreach ($fa_icon as $fa_key => $fa_val) {

                 $button .=  $fa_key. " = " . "'".$fa_val."'" ;
            }
            $button .= " ></i></span>"; 
           
        }


       
        $button .= " </button>";
        return $button;

    case 'button':
        
        
        $id = isset($data['id']) ? $data['id'] : '';
        $class = isset($data['class']) ? $data['class'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $name = isset($data['name']) ? $data['name'] : '';
        $title = isset($data['title']) ? $data['title'] : '';
        $type = isset($data['type']) ? $data['type'] : '';
        $span = isset($data['span']) ? $data['span'] : '';  
        
        $on_event = isset($data['on_event']) ? $data['on_event'] : '';
        $callback_function = isset($data['callback_function']) ? $data['callback_function'] : '';
        
        $button = "<input ";
        $button .= "id =" . "'".$id."'" ;
        $button .= "class =" . "'".$class."'" ;
        $button .= "value =" . "'".$value."'" ;
        $button .= "name =" . "'".$name."'" ;
        $button .= "title =" . "'".$title."'" ;
        $button .= "type =" . "'".$type."'" ;
        $button .= $on_event.'='."'".$callback_function.'()'."'";
       
        $button .= " />";


        return $button;

        
    case 'input':
         
         $id = isset($data['id']) ? $data['id'] : '';
        $class = isset($data['class']) ? $data['class'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $name = isset($data['name']) ? $data['name'] : '';
        $title = isset($data['title']) ? $data['title'] : '';
        $type = isset($data['type']) ? $data['type'] : '';
        $span = isset($data['span']) ? $data['span'] : '';  
        
        $on_event = isset($data['on_event']) ? $data['on_event'] : '';
        $callback_function = isset($data['callback_function']) ? $data['callback_function'] : '';
        
        $button = "<input ";
        $button .= "id =" . "'".$id."'" ;
        $button .= "class =" . "'".$class."'" ;
        $button .= "value =" . "'".$value."'" ;
        $button .= "name =" . "'".$name."'" ;
        $button .= "title =" . "'".$title."'" ;
        $button .= "type =" . "'".$type."'" ;

        $button .= $on_event.'='."'".$callback_function.'()'."'";
       
        $button .= " />";


        return $button;
        

    case 'checkbox':
        
        $id = isset($data['id']) ? $data['id'] : '';
        $class = isset($data['class']) ? $data['class'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $name = isset($data['name']) ? $data['name'] : '';
        $title = isset($data['title']) ? $data['title'] : '';
        $type = isset($data['type']) ? $data['type'] : '';
        $span = isset($data['span']) ? $data['span'] : '';  
        
        $on_event = isset($data['on_event']) ? $data['on_event'] : '';
        $callback_function = isset($data['callback_function']) ? $data['callback_function'] : '';
        
        $button = "<input ";
        $button .= "id =" . "'".$id."'" ;
        $button .= "class =" . "'".$class."'" ;
        $button .= "value =" . "'".$value."'" ;
        $button .= "name =" . "'".$name."'" ;
        $button .= "title =" . "'".$title."'" ;
        $button .= "type =" . "'".$type."'" ;
        $button .= $on_event.'='."'".$callback_function.'()'."'";
       
        $button .= " />";


        return $button;
        

    case 'radio':
        
        $id = isset($data['id']) ? $data['id'] : '';
        $class = isset($data['class']) ? $data['class'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $name = isset($data['name']) ? $data['name'] : '';
        $title = isset($data['title']) ? $data['title'] : '';
        $type = isset($data['type']) ? $data['type'] : '';
        $span = isset($data['span']) ? $data['span'] : '';  
        
        $on_event = isset($data['on_event']) ? $data['on_event'] : '';
        $callback_function = isset($data['callback_function']) ? $data['callback_function'] : '';
        
        $button = "<input ";
        $button .= "id =" . "'".$id."'" ;
        $button .= "class =" . "'".$class."'" ;
        $button .= "value =" . "'".$value."'" ;
        $button .= "name =" . "'".$name."'" ;
        $button .= "title =" . "'".$title."'" ;
        $button .= "type =" . "'".$type."'" ;
        $button .= $on_event.'='."'".$callback_function.'()'."'";
       
        $button .= " />";


        return $button;
        
    
    default:
    return false;
    }
  }

}

$process_class = new process();
?>