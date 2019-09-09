<?php 
include_once("../../../global.php");
include(lang_url()."global_en.php");
//include("formui.php");
 is_user_logged_in();
 
 

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);


 $formdetail=get_form_by_id(array('id'=>$_GET['formid']));
 $formdetail=$formdetail['data']['0'];
 $formjson=json_encode($formdetail['field']);
?>
<link type="text/css" rel="stylesheet" href="<?php echo admin_ui_url(); ?>form/css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_ui_url(); ?>form/css/timepicker.css" />
<?php
 include_once(include_admin_extensions_template("aintu_form_job","aintu_form_job","formAttributes"));
 include_once(include_admin_extensions_template("aintu_form_job","aintu_form_job","formdetail"));



  ?>



	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->


<style>
.mediaThumbs {
    float: left;
    padding: 2px;
    border: 1px solid;
    margin-bottom: 10px;
}
</style>
<script>
var site_url='<?php echo site_url();?>';
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var formsmid="1";
var currentTime='<?php echo time(); ?>';
var currentUserId='<?php echo $_SESSION['user']['user_id'] ?>';
var languageStrings=<?php echo json_encode($formdetail['strings'][$currentLanguageCode]); ?>;
var redirectUrlcreateform="<?php echo get_url('createpersonnel');?>";
</script>

<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/vi_validation.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>form/js/formCustom.js"></script>  
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>form/js/bootstrap-timepicker.js"></script> 
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>job/js/formcustom.js"></script>  
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.form.js"></script>



<script>

$(".nav-tabs li a").on("click", function() {
	
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var rclick= ( $(e.target).closest('li').index() + 1 );
  $("#userquestion").hide();
if(rclick==3)
{
	$("#userquestion").show();
}
})

	setTimeout(function(){
	
		$('.sorting').trigger('click');
			
	},200);

});


var formType='';
function formSubmit(key)
{   
    
    var formData=getCustomFormData('form_data');
    formType=key;
    if(formType==2){
        
            $('#editMode').val('1');
    }
	if(formData)
	{
        $('#formValue').val(formData);
	    $('#formadd').submit();
	}
}


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
            //alert(success);
            $('.modal-scrollable').css('pointer-events','auto');
            $('body').modalmanager('loading');
            console.log(success);
            //return;
            
            setTimeout(function(){  $('#upload-file').modal("toggle"); },900);


            

            if(formType=='0')
            {       
                    $("#model_head").html(ui_string['confirm']);
                    $("#model_des").html(ui_string['formsavedsuccessfully']);
                    $('#success_modal').modal();
                    setTimeout(function(){ window.location=site_url+'admin/form_job_report'; },1000);



                  //  setTimeout(function(){ window.location=site_url+'admin/controller/index.php?type=incompleteJobs'; },1000);

            }
            else
            {         
                    //setTimeout(function(){ window.location=redirectUrlcreateform+'/savesendapproval/<?php echo $_GET['formid']?>'; },1000);
                   //setTimeout(function(){ window.location=site_url+'admin/controller/index.php?type=incompleteJobs'; },1000);
                   setTimeout(function(){ window.location=site_url+'admin/form_job_report'; },1000);

            }
            
        }
    });

})();
</script>

<script type="text/javascript">
$( window ).load(function() {
   $('.datetimepicker').datetimepicker({
    
    format: 'dd/mm/yyyy',
    pickTime: false,
    altFieldTimeOnly: false,
    altField: "#hiddenField",
    autoClose: true,
    minView: 2
});
   
});  

</script>
<script type="text/javascript">
    function closeModal()
    {

       $('#formCommentModal').modal('hide');
       var comment = $('#temp_action_comment').val().trim();
       $('#action_comment').val(comment);

    }
</script>
<?php get_admin_footer(); ?>