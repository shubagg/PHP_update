<?php 
include_once("../../../global.php");
is_user_logged_in();
get_admin_header();
get_admin_header_menu($language); 
get_admin_left_sidebar($language); 
get_crop_popup(array("id"=>'1'));
?> 
<div id="main">
<script>
var site_url="<?php echo site_url(); ?>";
var media_url = "<?php echo media_url(); ?>";
var defaultimage=site_url+"/assets/admin/img/addg.png";
var extensions_ui_url= site_url+'/extensions/events_and_venues/ui/admin/';

function checkalldata() {}


</script>
<div id="content">
<div class="row">
<div class="button_holder">
<div class="popover-area-hover align-lg-right">
<?php 
$condition=array();
$box1=array('name'=>'Add Benefits Comment','icon'=>'glyphicon glyphicon-user','attr'=>'data-toggle="modal" data-target="#md-message"',"class"=>"custom_button btn_cu btn btn-default");
array_push($condition,$box1);
include_admin_template_params("resources","box",$condition); 
?>

</div>
</div>

<section class="panel top-gap">
<header class="panel-heading">
<div class="row">
<div class="col-md-4 margn_tp_7">
<h3><strong>Benefits Comment</strong> List</h3>
</div>
<div class="col-md-8">
<div class="text-right select_all tooltip-area btn-grp">

<button type="button" onclick="resetSearch()" data-toggle="tooltip" data-placement="top" title="Refresh" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></button>
</div> 
</div>
</div>
</header>

<div class="panel-body panel_bg_d">
<div class="table-responsive">
<?php 

$column_head=array('client name','comment','Action');  
$show_fields=array('cname','comment','action');
$All_data=array("head"=>$column_head);
$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
get_ajax_datatable($table_data,$show_fields,extensions_url()."events_and_venues/ui/admin/cms/ajax/datatable_ajax_benefitcomment.php"); 

?>    
</div>
</div>
</section>
<div>

<div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
<div class="modal-header">
<button  type="button" class="close"></button>
<h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>
</div>
<!-- //modal-header-->
<div class="modal-body text_alignment">
<div class="button_holder"> 
<p><strong id="error_body"></strong></p>
</div>
</div>
<!-- //modal-body-->
</div>



</div>
<!-- //content > row-->
</div>
<!-- //content-->
</div>
<!-- //main-->


<div class="modal fade in" id="md-message" role="dialog" data-backdrop="static" data-width="900" data-keyboard="false">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"  data-dismiss="modal">&times;</button>
<h4 class="modal-title" id="benefithead">Add Benefits Comment</h4>
</div>
<div class="modal-body new_panel">


<form id="benefitCSubmit" class="form-horizontal" method="post" enctype="multipart/form-data">
<div class="form-group "><input type="hidden" name="id" id="cid" value="0">
<label class="control-label remove_bg col-md-2">Comment *</label>
<div class="col-md-10">
<textarea class="form-control required_field benefitCSubmit" data-check-valid="blank" data-error-show-in="eDescription" data-error-text="Please enter comment" id="comment" name="comment" rows="3"></textarea>
<span id="eDescription" class="error"></span>
</div>
</div>
<div class="form-group ">
<label class="control-label remove_bg col-md-2">Client Name *</label>
<div class="col-md-10">
<input type="text" id="client" name="cname" class="form-control required_field benefitCSubmit" data-check-valid="blank" data-error-show-in="eclient" data-error-text="Please enter client name" id="comment" name="comment"/>
<span id="eclient" class="error"></span>
</div>
</div>
<div class="modal-footer">
<div id="benefitbut">
<button type="button" class="btn btn-default"  onclick="return validation('benefitCSubmit');">Submit</button>
</div>
</div>
</form>


</div>

</div>
</div>

<?php //echo success_fail_message_popup();?> 

<?php echo delete_confirmation_popup(); ?> 

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
</script>
<script type="text/javascript" src="<?php echo extensions_url(); ?>events_and_venues/ui/admin/cms/js/benefitcomment.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js">
  </script>
<?php get_admin_footer(); ?> 
