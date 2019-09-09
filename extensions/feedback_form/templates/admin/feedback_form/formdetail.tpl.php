<?php 

$currentLanguageCode=$_SESSION['user']['lang'];
$urgency_setting_json=curl_post("/get_module_setting_by_mid",array("mid"=>'5',"smid"=>'3'));
$urgency_setting_json = $urgency_setting_json['data'][0]['urgency'];
$userId=$_SESSION['user']['user_id'];
$getUsers=curl_post("/get_users",array('category'=>$formdetail['category'],'status'=>'1'));



?>
<style type="text/css">
  
  .right{
   margin:0 5px;
}
</style>
<div id="main">
	<div id="content"> 
	<div class="row">
		<section class="panel">
	     
	    <header class="panel-heading">
			<div class="row">
				<div class="col-md-6 margn_tp_7">
				<h3><strong><?php echo $ui_string['new_form'];?> - <?php echo $formdetail['title'];?></strong> </h3>
				</div>
			</div>
		</header>
                
			<div class="panel-body">
				<!-- <?php echo admin_ui_url()?>form/createpersonnel.php?actiontype=savesendapproval&formid=<?php echo $_GET['formid']?> -->
				<?php $abc=extensions_url();?>
			<form id="formadd" class="form-horizontal" method="post" action='<?php echo extensions_url()."feedback_form/ui/admin/submit.php" ?>' enctype="multipart/form-data" >

			<input type="hidden" name="jobId" id="jobId" value="0">
            <input type="hidden" name="formId" id="formId" value="<?php echo $_GET['formid']; ?>">
            <input type="hidden" name="userId" id="userId" value="<?php echo $userId; ?>">
            <input type="hidden" name="action_ts" id="action_ts" value="<?php echo time(); ?>">
            <input type="hidden" name="form_data" id="form_data" value='<?php echo $formjson; ?>'>
            <input type="hidden" name="formValue" id="formValue" value=''>
            <input type="hidden" name="editMode" id="editMode" value='0'>
            <input type="hidden" name="title" id="formtitle" value='<?php echo $formdetail['title']; ?>'>
            <input type="hidden" name="description" id="formdescription" value='<?php echo $formdetail['title']; ?>'>

	
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php
                    $formValueJSON=array();
                    $currentId='1';
                    if(isset($_GET['formid']) && $_GET['formid']!='') {   
                         displayForm($formdetail,$formValueJSON,'on');
                    }
                    ?>
                </div>
            </div>
			
            <?php if(check_user_permission("job","forms","comment")==1){ ?>
            <div class="form-group">
              <label class="control-label remove_bg"><?php echo $ui_string['comments'];?></label>
              <div>
              <textarea name="action_comment" id="action_comment" data-check-valid="blank" data-error-text="Please Enter Description" data-error-show-in="eaction_comment" data-error-setting="2" class="form-control addnewform required_field " ></textarea>
              <span id="eaction_comment" class="error"></span>
              </div>
            </div>
            <?php } ?>

			

				 <button type="reset" class="btn btn-inverse pull-right right left-gap" onclick="location.href='<?php echo site_url()?>admin/feedbackform/listing?type=form_listing&formtype=pendingform&job=3'><i class="fa fa-arrow-left" aria-hidden="true"></i>
					<?php echo $ui_string['cancel'];?>
				</button> 

        		    <!--  onclick="saveform();" -->
		        <button type="button" class="btn btn-theme-inverse right pull-right" onclick="formSubmit('0');" >
							<i class="fa fa-download" aria-hidden="true"></i> <?php echo $ui_string['save'];?>
				</button>	 
	


				</form>
			</div>

		<section>
	</div>
	</div>
</div>
	
        

        
	</div>
    
  
