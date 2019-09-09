<?php
function get_left_sidebar()
{
	global $pagename,$server_path,$site_url,$ui_string;
	//echo $server_path."templates/header.php";
	require_once ($server_path."templates/left_sidebar.php");
}

function get_breadcrumb2()
{
  global $pagename,$server_path,$site_url,$ui_string;
  require_once ($server_path."templates/breadcrumb.php");
}
function get_breadcrumb($type='backend')
{
    global $pagename,$server_path,$site_url,$ui_string,$advance_search_json;
    if($type=='frontend')
    {
        require_once ($server_path."templates/breadcrumb.php");
    }
    else
    {
       require_once ($server_path."templates/admin_breadcrumb.php");
    }
}

function get_datatable($data)
{
    global $pagename,$template_path,$ui_string;
	include($template_path."datatable.php");
}

function get_enroll_users_popup($language,$all_cats,$popupId,$setting,$data,$returnVal=false)
{
    // setting 1 means save data
    // setting 2 means get enrolled data
    // $data['mid','smid'];
    global $pagename,$server_path,$site_url,$resouce_mod,$ui_string;
    require_once ($server_path."templates/admin/enroll_users_popup.php");
}


function get_action_button($data,$id,$unique_id)
{
    global $pagename,$template_path,$ui_string;
	include($template_path."action_button.php");
}
function get_ajax_datatable($data,$show_fields,$url)
{
    global $template_path;
	include($template_path."datatable_ajax.php");
}
function success_fail_message_popup()
{
    global $pagename,$server_path,$ui_string;
    include ($server_path."templates/success_fail_message_popup.php");
}
function delete_confirmation_popup()
{
    global $pagename,$server_path,$ui_string;
    include ($server_path."templates/delete_confirmation_popup.php");
}

function get_data_field($type,$label,$name,$id,$classes,$attributes,$value,$class1,$condition,$placeholder,$manSymbol="")
{
    global $pagename,$server_path,$ui_string;
    if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }

    return $html;
}
function get_select_box($data)
{
    global $pagename,$server_path;
    extract($data);

    if($type=='select'){  include ($server_path."templates/select_box.php");  }

   
    return $html;
}

function get_data_field_for_img($type,$label,$name,$id,$classes,$attributes,$value,$class1,$condition,$w,$h)
{
    global $pagename,$server_path;
    if($type=='file'){  include ($server_path."templates/image_type.php");  }

    return $html;
}

function get_check_box($type,$label,$checkBoxResult,$class,$error_show_in)
{
    global $pagename,$server_path;
    if($type=='checkbox'){  include ($server_path."templates/check_box.php");  }
    return $html;
}
function get_checkbox($type,$label,$checkBoxResult,$name,$error_show_in)
{

    global $pagename,$server_path;
    if($type=='checkbox'){
    include ($server_path."templates/get_checkbox.php");  }
    return $html;
}


function get_radio_button($type,$label,$radioButtonResult,$name,$error_show_in)
{

    global $pagename,$server_path;
    if($type=='radio'){  include ($server_path."templates/radio_button.php");  }
    return $html;
}



function get_admin_header()
{
	global $pagename,$server_path,$site_url,$resouce_mod;
	//echo $server_path."templates/header.php";
	require_once ($server_path."templates/admin/header.php");
}

function get_admin_footer()
{
	global $pagename,$server_path,$site_url,$ui_string,$db;
	require_once ($server_path."templates/admin/footer.php");
    //$db->close();
}

function get_admin_header_menu($language='en')

{
    global $pagename,$server_path,$site_url,$resouce_mod,$ui_string;
	require_once ($server_path."templates/admin/header_menu.php");
}


function get_admin_left_sidebar($language='en')

{
    global $pagename,$server_path,$site_url,$resouce_mod,$ui_string;
	require_once ($server_path."templates/admin/left_sidebar.php");
}

function get_admin_datatable($data)
{
global $pagename,$admin_template_path,$ui_string;
include($admin_template_path."datatable.php");
}


function get_admin_action_button($data,$id,$unique_id)
{
global $pagename,$admin_template_path,$ui_string;
include($admin_template_path."action_button.php");
}



//====================================chandan ======================================

function get_header($global_words)
{
	global $pagename,$server_path,$site_url,$resouce_mod,$meta_description,$meta_title,$meta_image,$meta_url,$metatags,$ui_string;
	require_once ($server_path."templates/header.php");
}
function get_footer($global_words)
{
	global $pagename,$server_path,$site_url,$ui_string,$db;
	require_once ($server_path."templates/footer.php");
    //$db->close();
}
//--------------job add----------

function get_job_add_popup()   //add jobs..
{
        global $pagename,$admin_template_path,$ui_string;
		require_once ($admin_template_path."job/add_job.tpl.php");
}
function get_job_description_popup($get_jobs_listing,$setting_array)    //job description..
{           
        global $pagename,$admin_template_path,$ui_string;
		require_once ($admin_template_path."job/detail_listing_job.tpl.php");
 
}

//================ Start Code by Swati gupta ===============
 

function get_date_picker()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/datepicker.php");
    return $html;
}

function get_chart_date_picker($label,$name,$val)
{

    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/chart_date_picker.php");
    return $html;
}


function get_tabs()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/tabs.php");
    return $html;
}
function get_accordion()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/accordion.php");
    return $html;
}
function get_progress_bar()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/progress_bar.php");
    return $html;
}
function get_pagination()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/pagination.php");
    return $html;
}

 function get_badge()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/badge.php");
    return $html;
}



 function get_well()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/well.php");
    return $html;
}
 
 function get_collapse()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/collapse.php");
    return $html;
}


 function get_collapse_listview()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/collapse_listview.php");
    return $html;
}

 function get_collapse_panel()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/collapse_panel.php");
    return $html;
}


 function get_popover()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/popover.php");
    return $html;
}



 function get_tooltip()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/tooltip.php");
    return $html;
}

 function get_pager()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/pager.php");
    return $html;
}


 function get_panel()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/panel.php");
    return $html;
}



 function get_list_group()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/list-group.php");
    return $html;
}

 function get_media_object()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/media-object.php");
    return $html;
}
 function get_carousel()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/carousel.php");
    return $html;
}


 function get_profile_card()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/profile-card.php");
    return $html;
}
 function get_animated_search()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/animated-search.php");
    return $html;
}

 function get_contact_chip()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/contact-chip.php");
    return $html;
}


 function get_loader()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/loader.php");
    return $html;
}
 function get_previous_next()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/previous-next.php");
    return $html;
}

 function get_snackbar()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/snackbar.php");
    return $html;
}

 function get_filter_list()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/filter-list.php");
    return $html;
}
 function get_form_validation()
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    include ($server_path."templates/form-validation.php");
    return $html;
}

function get_image($type)
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
 //include ($server_path."templates/submit_button.php"); 
 
 switch ($type) {
    case 'image-responsive':
       include ($server_path."templates/image-responsive.php");
        break;
    case 'image-rounded':
       include ($server_path."templates/image-rounded.php");
        break;
    case 'image-circle':
       include ($server_path."templates/image-circle.php");
        break;
         case 'image-thumbnail':
       include ($server_path."templates/image-thumbnail.php");
        break;
    default:
       include ($server_path."templates/image-thumbnail.php");
}
 return $html;
}






//=============  End Code by Swati gupta =====================
//=============Aman code start==========

function get_form_button($cssclass, $width, $type)
{
    global $pagename,$server_path,$ui_string;
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    //include ($server_path."templates/submit_button.php"); 
    
    switch ($type) {
    case 'dropdowngroup':
       include ($server_path."templates/new_button_dropdown_nesting.php");
        break;
    case 'grouped':
       include ($server_path."templates/new_button_group.php");
        break;
    case 'droupdown':
       include ($server_path."templates/new_button_dropdown.php");
        break;
    default:
       include ($server_path."templates/new_button.php");
}
    return $html;
}
function get_form_inputs($data)
{

    global $pagename,$server_path,$ui_string;
    extract($data);
   // if($type=='text' || $type=='password'){  include ($server_path."templates/text_box.php");  }
    //include ($server_path."templates/submit_button.php"); 
    
    switch ($type) {
    case 'icon_form':
       include ($server_path."templates/get_icon_form.php");
        break;
    case 'textarea':
       include ($server_path."templates/get_textarea.php");
        break;
    case 'textbox_group':
       include ($server_path."templates/get_textbox_group.php");
        break;
    case 'segmented':
       include ($server_path."templates/get_segmented.php");
        break;
    case 'radio':
       include ($server_path."templates/get_radio_box.php");
        break;
    case 'checkbox':
       include ($server_path."templates/get_check_box.php");
        break;
    case 'textbox':
       include ($server_path."templates/text_box.php");
        break;
    case 'date':
       include ($server_path."templates/datepicker_select.php");
        break;
    default:
       include ($server_path."templates/get_select_box.php");
}
    return $html;
}
//=============Aman code end============
// Crop Start--//
function get_crop_popup($data)
{
    global $pagename,$server_path,$site_url,$resouce_mod,$ui_string;
    require_once ($server_path."ui/admin/crop/crop.php");
}
// Crop End--//
function get_banners_popup($data)
{
    global $pagename,$server_path,$site_url,$resouce_mod,$ui_string;
    require_once ($server_path."templates/admin/banner_popup.php");
}
function get_associated_image_name($data)
{
    $imageData=get_association_data($data['mid'],$data['amid'],$data['smid'],$data['aiid']);
    $profile_picture=$imageData['media']['1'][$data['aiid']][0]['mediaName'];
    if($profile_picture!='')
    {
        $img_url=ui_media_url().'images/'.$profile_picture;
    }  
    else
    {
        $img_url=ui_media_url().'image_not_available_400.png';
    }  
   return $img_url;
}
function get_listing_page_box($data)
{
    global $pagename,$server_path,$site_url,$ui_string;
    require_once ($server_path."ui/listingBox.php");
}
function get_listing_page_box_all($filterdata)
{
    global $pagename,$server_path,$site_url,$ui_string;
    require_once ($server_path."ui/listingBoxList.php");
}
function showPagination($data)
{
    global $server_path,$site_url,$ui_string;
    require_once ($server_path."ui/Pagination.php");
}
function get_enroll_users_popup_rpa($language,$all_cats,$popupId,$setting,$data,$returnVal=false)
{
    // setting 1 means save data
    // setting 2 means get enrolled data
    // $data['mid','smid'];
    global $pagename,$server_path,$site_url,$resouce_mod,$ui_string;
    require_once ($server_path."templates/admin/enroll_users_popup_rpa.php");
}

function get_enroll_user_for_license($language,$all_cats,$popupId,$setting,$data,$returnVal=false)
{
    // setting 1 means save data
    // setting 2 means get enrolled data
    // $data['mid','smid'];
    global $pagename,$server_path,$site_url,$resouce_mod,$ui_string;
    require_once ($server_path."templates/admin/enroll_assign_license_to_user.php");
}
?>
