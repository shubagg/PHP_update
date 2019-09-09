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
 
.zoom.fa-commenting
{
	color: #fff;
	font-size: 18px;
}

.zoom {
  position: fixed;
  bottom: 45px;
  right: 24px;
  height: 70px;
  z-index: 99999;
}

.zoom-fab {
  display: inline-block;
  width: 40px;
  height: 40px;
  line-height: 40px;
  border-radius: 50%;
  background-color: #009688;
  vertical-align: middle;
  text-decoration: none;
  text-align: center;
  transition: 0.2s ease-out;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  color: #FFF;
}

.zoom-fab:hover {
  background-color: #4db6ac;
  box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.14), 0 1px 7px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -1px rgba(0, 0, 0, 0.2);
}

.zoom-btn-large {
  width: 60px;
  height: 60px;
  line-height: 60px;
}
.comment-box-modal
{
	background: none;
	    -webkit-box-shadow: none;
    box-shadow: none;
}
</style>

<?php if(check_user_permission("job","forms","comment")==1){ ?>
<span class="zoom" data-toggle="modal" data-target="#formCommentModal" data-backdrop="static" data-keyboard="false"><a class="zoom-fab zoom-btn-large"><i class="icon fa fa-commenting"></i></a></span>
<?php } ?>

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
			<form id="formadd" class="form-horizontal" method="post" action='<?php echo extensions_url()."aintu_form_job/ui/admin/submit.php" ?>' enctype="multipart/form-data" >
			
			
		
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
              <!--<label class="control-label remove_bg"><?php echo $ui_string['comments'];?></label>-->
              <div>
              <input type="hidden" name="action_comment" id="action_comment" value="">
             <!-- <textarea name="action_comment" id="action_comment" data-check-valid="blank" data-error-text="Please Enter Description" data-error-show-in="eaction_comment" data-error-setting="2" class="form-control addnewform required_field " ></textarea>-->
              <span id="eaction_comment" class="error"></span>
              </div>
            </div>
            <?php } ?>

			

				 <button type="reset" class="btn btn-inverse pull-right right left-gap" onclick="location.href='<?php echo site_url()?>admin/form/fillup'"><i class="fa fa-arrow-left" aria-hidden="true"></i>
					<?php echo $ui_string['cancel'];?>
				</button> 

        		    <!--  onclick="saveform();" -->
        <button type="button" class="btn btn-theme-inverse right pull-right" onclick="formSubmit('0');" >
					<i class="fa fa-download" aria-hidden="true"></i> <?php echo $ui_string['sendsave'];?>
				</button>	 
	


				</form>
			</div>

		<section>
	</div>
	</div>
</div>

    
  <!-- Modal -->
  <?php if(check_user_permission("job","forms","comment")==1){ ?>
  <div class="modal comment-box-modal fade" id="formCommentModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="" onclick="closeModal()">X</button>
          <h4 class="modal-title">Comment</h4>
        </div>
        <div class="modal-body">
       
			      <label for="comment">Comment:</label>
			      <textarea name="temp_action_comment" class="form-control addnewform required_field" rows="5" id="temp_action_comment" data-check-valid="blank" data-error-text="Please Enter Description" data-error-show-in="etemp_action_comment" data-error-setting="2"></textarea>
            
            <span id="eaction_comment" class="error"></span>
			    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="" onclick="closeModal()">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <?php } ?>
