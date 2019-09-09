<?php 

is_user_logged_in();

$get_blog_setting=curl_post("/get_setting_by_mid",array("mid"=>7,"smid"=>1));

 $get_blog_setting_json = $get_blog_setting['data'][0]['json'];
 
 

$discuss_id=isset($_GET['id'])?$_GET['id']:'';
$get_discuss=curl_post("/get_forum_by_id",array("id"=>$discuss_id));

logger_ui("add_blog/blog_listing","",$get_discuss,5);     //logger

$title="";
$des="";
$id="";

    if($discuss_id!="")
    {
      
    if(!empty($get_discuss))
    {        
            $title=$get_discuss['data'][0]['title'];
            $des=$get_discuss['data'][0]['desc'];
            $id=$get_discuss['data'][0]['id'];
	        $user_id=$get_discuss['data'][0]['userId'];
    }
 }




?>


<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("discussion","manage_discussion")); ?>

<!--

////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->


<link href="<?php echo admin_ui_url(); ?>blog/css/datepicker.css" rel="stylesheet">
<link href="<?php echo admin_ui_url(); ?>blog/css/timepicker.css" rel="stylesheet">
<?php get_admin_footer(); ?>  

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';

</script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>discussion/js/discussion_manage.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/vi_validation.js"></script>

