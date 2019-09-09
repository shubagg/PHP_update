<?php 

include_once("../../../global.php");
is_user_logged_in();
get_admin_header(); 
get_admin_header_menu();
get_admin_left_sidebar();
$currentLanguageCode=$_SESSION['user']['lang'];
$userId=$_SESSION['user']['user_id'];
$companyData = get_company_data();
$logo = '';
if(isset($companyData['logo']))
{
  $logo = site_url().$companyData['logo'];
}

if(isset($_GET['formtype']) && $_GET['formtype']=="pendingform") {
  $getPendingdata=curl_post('/get_pending_formjob',array('id'=>$_GET['jobId'],'userid'=>$userId));

    if($getPendingdata['data']['0']['read_status']=='0'){
      $readstatus=curl_post('/mark_formjob_read_status_change',array('id'=>$_GET['jobId'],'approval_data_id'=>$getPendingdata['data']['0']['approval_data_id'],'read_status'=>'1','action_by'=>$userId));
    }
}
elseif(isset($_GET['formtype']) && $_GET['formtype']=="openform") {
  $getPendingdata=curl_post('/get_open_formjob',array('id'=>$_GET['jobId'],'userid'=>$userId));
}
elseif(isset($_GET['formtype']) && $_GET['formtype']=="trackform") {
   $getPendingdata=curl_post('/get_track_formjob',array('id'=>$_GET['jobId'],'userId'=>$userId));
}
elseif(isset($_GET['formtype']) && $_GET['formtype']=="queryform") {
    $getPendingdata=curl_post('/get_job_by_id',array('id'=>$_GET['jobId'],'smid'=>'3','user_id'=>$userId,'formtype'=>'queryform'));
}
//pr($getPendingdata);die;
$getPendingdata=$getPendingdata['data']['0'];

$form_data=$getPendingdata['form_data'];

$status=getformstatus($getPendingdata['status']);



$signStatus=$getPendingdata['sign_status'];
if($signStatus) {  $signed=$ui_string['signed']; }
else{ $signed=$ui_string['unsigned']; }

$readStatus=$getPendingdata['read_status'];
if($readStatus) {  $read=$ui_string['read']; }
else{ $read=$ui_string['unread']; }



$trackStatusdetails=check_track_status_formjob(array('jobId'=>$getPendingdata['id'],'userId'=>$userId));
$trackStatus=$trackStatusdetails['data'];

$formValueJSON=$getPendingdata['form_data']; //die;

$formValueJSON = str_replace("\n","\\n",$formValueJSON);
$formValueJSON = str_replace("\r","",$formValueJSON);
$formValueJSON = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":',$formValueJSON);
$formValueJSON = preg_replace('/(,)\s*}$/','}',$formValueJSON);


$formValueJSON=json_decode($formValueJSON,true);


$formdetail='';
$formdetailarray=get_form_by_id(array('id'=>$_GET['formid']));
if(isset($formdetailarray['data']['0']) && $formdetailarray['data']['0']!=''){
    $formdetail=$formdetailarray['data']['0'];
    //print_r($formdetail);	
}



$catid=$getPendingdata['category'];
$categoryName='N/A';
if($catid) {
	$categorydetails = curl_post("/get_category",array("id" => $catid));
	if (isset($categorydetails['data'][0]) && $categorydetails['data'][0]!='')  {
		$categoryName = $categorydetails['data'][0]['title'];
	}
}

if($_GET['formtype']=="trackform") {
    $senderid=$getPendingdata['userId'];
}
else {
    $senderid=$getPendingdata['request_by'];
}
$sender='N/A';
if($senderid) {
	$sender_details = curl_post("/get_user_info_by_id", array("id" => $senderid));
	if(isset($sender_details['data'][0]) && $sender_details['data'][0]!='') {
      $sender = $sender_details['data'][0]['name'];
     }
		
}

$creatorid=$getPendingdata['creator'];
$creator='N/A';
if($creatorid) {
	$creator_details = curl_post("/get_user_info_by_id", array("id" => $creatorid));
	if(isset($creator_details['data'][0]) && $creator_details['data'][0]!='') {
      $creator = $creator_details['data'][0]['name'];
     }
		
}


if(isset($_GET['formtype']) && $_GET['formtype']=="queryform"){
	$currentuser=$getPendingdata['currentuser'];
}else{
	$currentuser=$getPendingdata['current_user'];
}
$current_owner='N/A';
if($creatorid) {
	$current_owner_details = curl_post("/get_user_info_by_id", array("id" => $currentuser));
	if(isset($current_owner_details['data'][0]) && $current_owner_details['data'][0]!='') {
      $current_owner = $current_owner_details['data'][0]['name'];
     }
		
}


if($creatorid==$userId) {
     $formcomment=$getPendingdata['request_by_comment'];
}else {
      $formcomment=$getPendingdata['request_to_comment'];
}

//$getUsers=curl_post("/get_users",array('category'=>$formdetail['category']));
//$userId='569f7faa7c3d68011e3c9869';
//print_r($getUsers);
?>
<style>
.mediaThumbs {
	float: left;
	padding: 2px;
	border: 1px solid;
	margin-bottom: 10px;
}
.right {
	margin: 0 5px;
}
#courseDatatable_filter {
	display: none;
}
</style>
<div id="main">
  <div id="content">
    <div class="row">
    <section class="panel"> 
      
      <!-- <?php if(isset($_GET['formtype']) && $_GET['formtype']=="pendingform"){ ?>

				<header class="panel-heading">
			    <h3><strong><?php echo $ui_string['pending_form']?></strong> </h3>
				
				</header>
			<?php } elseif(isset($_GET['formtype']) && $_GET['formtype']=="openform")  { ?>
			   
				<header class="panel-heading">
				 
				<h3><strong><?php echo $ui_string['open_form']?></h3>
				
				</header>
				
			<?php } elseif(isset($_GET['formtype']) && $_GET['formtype']=="trackform")  { ?>
         
        <header class="panel-heading">
         
        <h3><strong><?php echo $ui_string['track_form']?></h3>
        
        </header>
        
      <?php } ?> -->
      <div >
        <header class="panel-heading">
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <h3><strong><?php echo $getPendingdata['title'];?></strong></h3>
            </div>
           <!--  <div class="col-md-6 col-xs-12"> <a href="javascript:;" data-original-title="" id="" onclick="openWin('print_div')" class="btn btn-default btn-sm pull-right" title="<?php echo $ui_string['print'];?>"><i class="fa fa-print"></i></a> 

            <a href="javascript:;" data-original-title="" id="" onclick="export_form()" class="btn btn-default btn-sm pull-right" title="<?php echo $ui_string['print'];?>"><i class="fa fa-external-link-square"></i></a>
            </div> -->
          </div>
        </header>
        <div class="panel-body" id="print_div">
        <!-- form/createpersonnel.php?jobId=<?php echo $_GET['jobId']?>&actiontype=sendforapproval&formid=<?php echo $_GET['formid']?>&formtype=<?php echo $_GET['formtype']; ?> -->
        
        <form id="addnewform" class="form-horizontal" method="post" action="<?php echo admin_ui_url()?>form/submit.php"  enctype="multipart/form-data" >
          <input type="hidden" name="jobId" id="jobId" value="<?php echo $_GET['jobId']; ?>">
          <input type="hidden" name="form_data" id="form_data" value='<?php echo $form_data; ?>'>
          <input type="hidden" name="formId" id="formId" value="<?php echo $_GET['formid']; ?>">
          <input type="hidden" name="smid" id="jobsmid" value="3">
          <input type="hidden" name="userId" id="userId" value="<?php echo $userId; ?>">
          <?php if($senderid!=$userId) {?>
          <input type="hidden" name="senderid" id="senderid" value="<?php echo $senderid; ?>">
          <?php } ?>
          <input type="hidden" name="editMode" id="editMode" value="0">
          <input type="hidden" name="action_ts" id="action_ts" value="<?php echo time(); ?>">
          <input type="hidden" name="title" id="formtitle" value='<?php echo $getPendingdata['title']; ?>'>
          <!--
           
            
           
            <input type="hidden" name="description" id="formdescription" value='<?php echo $getPendingdata['title']; ?>'>-->
            <div class="col-md-12 col-xs-12">
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label for="inputOne"><?php echo $ui_string['department'];?> - <?php echo $categoryName;?></label>
              </div>
            </div>
            <div class="col-md-6 col-xs-12 ">
              <div class="form-group pull-right">
                <label for="inputOne"><?php echo $ui_string['form_no'];?> - <?php echo $getPendingdata['id']?></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label for="inputOne"><?php echo $ui_string['form_status'];?> - <?php echo $status;?></label>
              </div>
            </div>
            <div class="col-md-6 col-xs-12 ">
              <div class="form-group pull-right">
                <label for="inputOne"><?php echo $ui_string['status'];?> - <?php echo $signed ;?></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label for="inputOne"><?php echo $ui_string['read_status'];?> - <?php echo $read;?></label>
              </div>
            </div>
            <div class="col-md-6 col-xs-12 ">
              <div class="form-group pull-right">
                <label for="inputOne"><?php echo $ui_string['currentowner'];?> - <?php echo $current_owner;?></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label for="inputOne"><?php echo $ui_string['sender'];?> - <?php echo $sender;?></label>
              </div>
            </div>
            <div class="col-md-6 col-xs-12 ">
              <div class="form-group pull-right">
                <label for="inputOne"><?php echo $ui_string['fillperson'];?> - <?php echo $creator;?></label>
              </div>
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <?php 
                      $formJson=array();
                      $currentId=1;
                      $disablestatus='none';
                   /*   if($getPendingdata['status']=='4' || $getPendingdata['status']=='8' && $_GET['formtype']=="pendingform"){ $disablestatus='on'; }

                      elseif($getPendingdata['status']=='1' || $getPendingdata['status']=='6' || $_GET['formtype']!="pendingform"){ $disablestatus='none'; }*/

                      if(isset($formdetail) && $formdetail!='') {
                         displayForm($formdetail,$formValueJSON,$disablestatus);  
                      }
                      
                ?>
            </div>
          </div>

          <?php if(isset($_GET['formtype']) && $_GET['formtype']=='queryform') { ?>
          <?php if(check_user_permission("job","forms","comment")==1){ ?>
          <div class="form-group">
            <label class="control-label remove_bg"><?php echo $ui_string['comment'];?></label>
            <div>
              <textarea name="action_comment" id="action_comment" data-check-valid="blank" data-error-text="Please Enter Description" data-error-show-in="e_pg_content" data-error-setting="2" class="form-control addnewform required_field " ><?php if($formcomment) {echo $formcomment;}?>
</textarea>
              <span id="eaction_comment" class="error"></span> </div>
          </div>
          <?php } ?>

          
          <button type="reset" class="btn btn-inverse right left-gap pull-right" onclick="location.href='<?php echo site_url()?>controller/?type=<?php if($_GET['formtype']=='trackform'){echo 'track_listing';}else{echo 'form_listing';} ?>&formtype=<?php echo $_GET['formtype']; ?>&job=3'"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?php echo $ui_string['cancel'];?> </button>

        

          <?php if(check_user_permission("job","forms","view")==0  || check_user_permission("job","forms","all")==0){ ?>
          <button type="button" class="btn btn-theme-inverse right left-gap pull-right" id="myelement"> <i class="fa fa-history" aria-hidden="true"></i> <?php echo $ui_string['viewHistory'];?> </button>
          <?php } ?>

          
          <?php if(check_user_permission("job","forms","view")==0  || check_user_permission("job","forms","all")==0){ ?>
          <button type="button" class="btn btn-theme-inverse right left-gap pull-right" id="myelement"> <i class="fa fa-history" aria-hidden="true"></i> <?php echo $ui_string['viewHistory'];?> </button>
          <?php } ?>
<?php } ?>


          <?php if(isset($_GET['formtype']) && $_GET['formtype']=='pendingform1' || $_GET['formtype']=='openform') { ?>
            <?php if(check_user_permission("job","forms","closeNotify")==1  || check_user_permission("job","forms","all")==1){ ?>
            <button type="button" class="btn btn-theme-inverse right left-gap pull-right" onclick="submitForApproval('closenotify')"><i class="icon  fa fa-bell"></i> <?php echo $ui_string['closenotify'];?> </button>
            <?php } ?>
            <?php if(check_user_permission("job","forms","close")==1  || check_user_permission("job","forms","all")==1 && $getPendingdata['status']=='6'){ ?>
            <button type="button" class="btn btn-theme-inverse right left-gap pull-right" onclick="submitForApproval('closeform')"><i class="icon  fa fa-times"></i> <?php echo $ui_string['close'];?> </button>
            <?php } ?>
          <?php  }  ?>
          
          <?php if((isset($_GET['formtype']) && $_GET['formtype']=='pendingform1' || $_GET['formtype']=='openform') && $getPendingdata['status']!='6') { ?>
                <?php if(!$trackStatus) {?>
                <?php if(check_user_permission("job","forms","addToTrack")==1  || check_user_permission("job","forms","all")==1){ ?>
                <button type="button" class="btn btn-theme-inverse right left-gap pull-right" onclick="submitForApproval('addtotrack')"><i class="icon  fa fa-thumb-tack"></i> <?php echo $ui_string['addtotrack'];?> </button>
                <?php } ?>
                <?php } ?>
          <?php } ?>

          <?php if(isset($_GET['formtype']) && $_GET['formtype']=='pendingform1' && $getPendingdata['status']!='6') { ?>
            <?php if($getPendingdata['status']!='1' && $getPendingdata['status']!='8') { ?>
              <?php if(check_user_permission("job","forms","sendForApproval")==1  || check_user_permission("job","forms","all")==1){ ?>
              <button  type="button" onclick="submitForApproval('sendforapproval');" class="btn btn-theme-inverse right left-gap pull-right"><i class="icon  fa fa-send"></i> <?php echo $ui_string['sendforapproval'];?> </button>
              <?php } ?>
            <?php } ?>
            <?php if($creatorid!=$userId && $getPendingdata['status']!='8') { ?>
              <?php if(check_user_permission("job","forms","rejected")==1  || check_user_permission("job","forms","all")==1){ ?>
              <button  onclick="submitForApproval('reject');" type="button" class="btn btn-theme-inverse right left-gap pull-right"><i class="icon  fa fa-thumbs-down"></i> <?php echo $ui_string['reject'];?> </button>
              <?php } ?>
            <?php } ?>
            <?php if($getPendingdata['status']!='8' && $getPendingdata['status']!='2' && $getPendingdata['status']!='4'  && $getPendingdata['status']!='1' && $getPendingdata['status']!='7') { ?>
              <?php if(check_user_permission("job","forms","approved")==1  || check_user_permission("job","forms","all")==1){ ?>
              <button  onclick="submitForApproval('approval');" type="button" class="btn btn-theme-inverse right left-gap pull-right"><i class="icon  fa fa-thumbs-up"></i> <?php echo $ui_string['approval'];?> </button>
              <?php } ?>
            <?php } ?>
            <?php  //if($getPendingdata['status']=='4') { ?>
              <?php if(check_user_permission("job","forms","edit")==1 || check_user_permission("job","forms","all")==1){ ?>
              <button onclick="submitForApproval('save');" type="button" class="btn btn-theme-inverse right pull-right"  > <i class="fa fa-download" aria-hidden="true"></i> <?php echo $ui_string['save'];?> </button>
              <?php } ?>
            <?php //} ?>
            <?php  if($getPendingdata['status']=='8') { ?>
              <?php if(check_user_permission("job","forms","edit")==1 || check_user_permission("job","forms","all")==1){ ?>
              <button onclick="submitForApproval('editdone');" type="button" class="btn btn-theme-inverse right pull-right"  > <i class="fa fa-check-square" aria-hidden="true"></i> <?php echo $ui_string['editdone'];?> </button>
              <?php } ?>
            <?php } ?>
            <?php  if($getPendingdata['status']=='8' || $getPendingdata['status']=='4') { ?>
              <?php if(check_user_permission("job","forms","edit")==1 || check_user_permission("job","forms","all")==1){ ?>
              <button onclick="submitForApproval('sendedit');" type="button" class="btn btn-theme-inverse right pull-right"  > <i class="fa fa-send" aria-hidden="true"></i> <?php echo $ui_string['sendedit'];?> </button>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </form>
      </div>
      </div>
      <div class="row"  id="another-element" style="display:none;">
        <div class="col-md-12 col-xs-12">
          <div class="table-responsive table table-striped table-hover dataTable detail-table tooltip-area">
            <table id="courseDatatable"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
              <thead>
                <tr>
                  <th><?php echo $ui_string['userA'];?></th>
                  <th><?php echo $ui_string['userB'];?></th>
                  <th><?php echo $ui_string['date'];?></th>
                  <th><?php echo $ui_string['time'];?></th>
                  <th><?php echo $ui_string['status'];?></th>
                  <th><?php echo $ui_string['action'];?></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div id="commentModal" class="modal fade md-slideUp" tabindex="-1" data-width="650">
        <div class="modal-header bd-theme-inverse-darken" style="overflow:hidden;">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
          <h4 class="modal-title" style="width: 82%; float:left;"><i class="fa fa-inbox"></i> <?php echo $ui_string['comments'];?></h4>
        </div>
        <!-- //modal-header-->
        <div class="modal-body" style="padding:0">
          <div class="panel-body">
            <div class="form-group row">
              <div class="col-md-12 text-center ">
                <label id="commentTxt"> </label>
              </div>
              <!-- //modal-body--> 
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
<?php include_once(include_admin_template("form","formAttributes")); ?>

<script>
var site_url='<?php echo site_url();?>';
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var formsmid="1";
var currentTime='<?php echo time(); ?>';
var currentUserId='<?php echo $_SESSION['user']['user_id'] ?>';
var languageStrings='<?php if(isset($formdetail) && $formdetail!=''){echo json_encode($formdetail['strings'][$currentLanguageCode]);} ?>';
var panelId     ="<?php echo $_GET['jobId'];?>";
var redirectUrlcreateform="<?php echo get_url('createpersonnel');?>";
var redirectUrlcloseform="<?php echo get_url('closenotify').'/'.$_GET['jobId'].'/'.$_GET['formid']; ?>";
var actionType="";

</script> 
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/vi_validation.js"></script> 
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>form/js/formCustom.js"></script> 
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>job/js/formcustom.js"></script> 
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/checkbox_multiple_datatable.js"></script> 
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.form.js"></script> 
<script type="text/javascript">

(function() {
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
    $('form').ajaxForm({
        beforeSend: function() {
            $('body').modalmanager('loading');
            $('.modal-scrollable').css('pointer-events','none');
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            
        },
        success: function() {
           var percentVal = '100%';
        },
        complete: function(xhr) {
            var success=xhr.responseText.trim();
            console.log(success);
            $('.modal-scrollable').css('pointer-events','auto');
            $('body').modalmanager('loading');
        	setTimeout(function(){  $('#upload-file').modal("toggle"); },1000);
          
            
			/*$("#model_head").html(ui_string['confirm']);
			$("#model_des").html(ui_string['formupdatedsuccessfully']);
			$('#success_modal').modal();*/

			

            if(actionType=='sendforapproval'){ 
                setTimeout(function(){
             window.location=redirectUrlcreateform+"/"+$('#jobId').val()+"/sendforapproval/"+$('#formId').val()+"/pendingform" },1000); }
            else if(actionType=='approval'){  
                approval(); } 
	        else if(actionType=='reject'){ 
	            reject(); } 
	        else if(actionType=='closeform'){ 
	            closeform(); } 
	        else if(actionType=='closenotify'){ 
	            setTimeout(function(){ window.location=redirectUrlcloseform },1000); }
	        else if(actionType=='addtotrack'){ 
	            addtotrack(); }
	        else if(actionType=='save'){
	            setTimeout(function(){location.reload();},1000); }
            else if(actionType=='sendedit'){ 
                setTimeout(function(){
             window.location=redirectUrlcreateform+"/"+$('#jobId').val()+"/sendforapproval/"+$('#formId').val()+"/pendingform" },1000); }
            else if(actionType=='editdone'){
	            setTimeout(function(){ editdone(); },1000); }


	        } 

    });

})();

$( "#myelement" ).click(function() {     
   $('#another-element').toggle("slide", { direction: "up" }, 1000);
});

var currentCategoryId=0;
function checkdataForDatatable(){ }

$(document).ready(function() {
    historyDatatableFunction(panelId);
} );

function historyDatatableFunction(categoryId)
{
    currentCategoryId=categoryId;
    $("#courseDatatable").dataTable().fnDestroy();
    $('#courseDatatable')
    .on('xhr.dt', function ( e, settings, json ) {
        if(e['type']){
            checkdataForDatatable();
        }
    } )
    .dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": admin_ui_url+"/history/ajax/history_datatable_ajax.php?categoryId="+categoryId,
        
    } );
}

function show_comment(id)
{
    var data="id="+id;
    $.ajax({
        url:admin_ui_url+"/history/ajax/history.php?action=getData",
        type:"post",
        data:data,
        success:function(response)
        {
            
            response = JSON.parse(response);
            $("#commentTxt").html(response['data'][0]['request_by_comment']);
        }

    })
    $("#commentModal").modal();
}
</script>
<?php get_admin_footer(); ?>
<script type="text/javascript">
	
 /* function openWin(div_id)
  {
  	var printContents = document.getElementById(div_id).innerHTML;
    var html_start = '<html><head>';
  
  html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/mmenu.css" />';
	html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/bootstrap/bootstrap.min.css" />';
 	html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/bootstrap/bootstrap-themes.css" />';
	html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/plugins/datable/dataTables.bootstrap.css" />';
    html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/style.css" />';
  html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/custom_assets/css/style.css" />'; 
  html_start += '<link rel="stylesheet" href="'+site_url+'/assets/admin/css/nice-select.css">';


    html_start += '</head><body>';
    var html_end = '</body></html>';
    var myWindow=window.open();
    console.log(html_start);
    myWindow.document.write(html_start);
    myWindow.document.write(printContents);
    myWindow.document.write(html_end);
    
    myWindow.document.close();

	
	
	setTimeout(function(){ 
	myWindow.focus();
	myWindow.print();
	myWindow.close();
		 }, 300);
	
    
  }*/

</script> 
<script type="text/javascript">
  
function openWin(div_id)
{
  var title = "<?php echo $getPendingdata['title']?>";
  var logo = "<?php echo $logo ?>";
  var printContents = document.getElementById(div_id).innerHTML;
  var header_part = '<header class="panel-heading">';
  header_part += '<div class="row"><div class="col-md-6 col-sm-6 col-xs-6" style="padding-top: 20px;"><strong>'+title+'</strong></div>';
  header_part += '<div class="col-md-6 col-sm-6 col-xs-6 pull-right text-right"><img class="pull-right" src="'+logo+'"/></div></div></header>';
  var html_start = '<html><head>';

  html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/mmenu.css" />';
	html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/bootstrap/bootstrap.min.css" />';
 	html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/bootstrap/bootstrap-themes.css" />';
	html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/plugins/datable/dataTables.bootstrap.css" />';
    html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/assets/admin/css/style.css" />';
  html_start += '<link type="text/css" rel="stylesheet" href="'+site_url+'/custom_assets/css/style.css" />'; 
  html_start += '<link rel="stylesheet" href="'+site_url+'/assets/admin/css/nice-select.css">';
  

    html_start += '</head><body>';
    var html_end = '</body></html>';

    var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    if(isChrome)
    {
        var contents = html_start + header_part + $('#'+div_id).html() + html_end;
      //  console.log(contents);
        
        
        // show the modal div
        $('#modal2345').css({'display':'block'});
        var frame = $('#printframe')[0].contentWindow.document;
        console.log(frame);
        // open the frame document and add the contents
        frame.open();
        frame.write(contents);
        setTimeout(function(){ 
        
       
        //frame.close();
        $('#printframe')[0].contentWindow.print();
        return false
         }, 300);
        
        
        // print just the modal div
        
    }
    else
    {
       var myWindow = window.open('','_blank','resizable=1,scrollbars=1');
        myWindow.document.write(html_start);
        myWindow.document.write(header_part);
        myWindow.document.write(printContents);
        myWindow.document.write(html_end);
        

        myWindow.document.close();

      
      
      setTimeout(function(){ 
      myWindow.focus();
      myWindow.print();
      myWindow.close();
         }, 300);

    }

    
  
    
  }

  function export_form()
  {
    $.ajax({
      url:admin_ui_url+"form/ajax/export_form_fields.php",
      data:"formId=<?php echo $_GET['formid']; ?>&jobId=<?php echo $_GET['jobId']; ?>",
      type:"POST",
      success:function(suc)
              {
                suc=JSON.parse(suc);
                window.location=suc['path'];
              }
    })
  }

</script>
<div id="modal2345" style="display: none">
  <iframe id="printframe"></iframe>
</div>
