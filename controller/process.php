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
        //echo "<pre>"; print_r($data); die;
        global $ui_string;

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
        global $ui_string;
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
                $adv_search_details = array('adv_search_listing'=>$select_list,'adv_search_equivalent'=>$adv_search_equivalent);
            }
            // echo "<pre>"; print_r($adv_search_details); die;
            
            $this->advance_seach_json_data = json_encode($adv_search_details); 
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
        global $ui_string;
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
            
            
            $request_url_params_temp = $listing_data['request_url_params']; 
            if(is_array($request_url_params_temp) && count($request_url_params_temp))
            {   $request_url_params = array();
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

        
        include_once(include_admin_template("common_templates", $template));
        $columns_listing_json = json_encode($this->customise_listing_data());
        $advance_seach_data = $this->advance_seach_json_data;
        require_once($server_path.'controller/script.php');
    }
    function custom_buttons()
    {
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
        
    switch (strtolower($data['type'])) {
    case 'button':
        
        
        $id = isset($data['id']) ? $data['id'] : '';
        $class = isset($data['class']) ? $data['class'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $name = isset($data['name']) ? $data['name'] : '';
        $title = isset($data['title']) ? $data['title'] : '';
        $type = isset($data['type']) ? $data['type'] : '';
        
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

?>