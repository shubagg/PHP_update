<?php 
include_once("../../../global.php");
is_user_logged_in();
check_user_permission_with_redirect("rpa","invoicepdf");

$companyData=get_company_data();
$getuserip=$_SESSION['user']['email'];
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<link rel="stylesheet" type="text/css" href="<?php echo site_url()."company/".$companyData['cid']."/"; ?>assets/css/style-new.css">

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';
var useripaddress='<?php echo $getuserip; ?>';
</script>  
<style type="text/css">
table {
 border-collapse: collapse;
}        
td {
 border: 1px solid #ccc;
 padding: 0 0.5em;
}        
.form-box {
    box-shadow: 0 0 25px #ccc !important;
    background-color: #fff;
    margin-bottom: 20px;
    min-height: 90vh;
    max-height: 90vh;
    overflow-y: scroll;
    padding: 15px;
}
.form-box-l {
   box-shadow: 0 0 25px #ccc !important;
    background-color: #fff;
    margin-bottom: 20px;
    padding: 15px;
    height: 340px;
    overflow: hidden;
    overflow-y: scroll;
}

.tdclass{
  cursor: move;
}
.ui-draggable-dragging{
    background: transparent !important;
    padding: 4px;
    width:20%;
    color: lightblue;
    border: 1px dotted blue !important;
    font-size: 10px !important;
}
.form-box-2 {
   box-shadow: 0 0 25px #ccc !important;
    background-color: #fff;
    margin-bottom: 20px;
    padding: 15px;
    height: 500px;
    overflow: hidden;
    overflow-y: scroll;
}

.form-box-l img{
  width: 100%;
}
.droppable_table{
    border: 1px solid #ccc;
    height: 42px;
    margin-bottom: 20px;
    box-shadow: 3px 2px 25px #ccc;
}
.ui-droppable.hovered {
    background: #c5cacc5c;
}
.pdf-mrgg{
    margin-bottom: 20px;
}
.btn-pdf{
	padding: 12px 35px;
    border: 1px solid rgb(169, 169, 169);
    margin-right: 10px;
    font-size: 16px !important;
    font-weight: 600;
    text-transform: uppercase;
}
.btn-pdf-button{
	    padding: 0px 7px;
    border: 1px solid rgb(169, 169, 169);
    margin-right: 10px;
    font-size: 24px !important;
    font-weight: 400;
	float: right;
    text-transform: uppercase;
}
#field_list_input .input-group{
	margin-bottom: 10px;
  width: 100%;
}
#field_list_input .input-group span{
	padding: 15px 20px;
    background-color: #4f6e88;
    color: #fff;
}
#field_list_input .input-group .form-control{
	    padding: 15px 20px;
		height:44px;
}

.action-active{
    background-color: lightblue !important;
}
</style>

<div id="main" class="dashboard">
<?php get_breadcrumb();

      $csv_file_path="";
      if(isset($_GET['invoiceid']) && $_GET['invoiceid']!=""){
        
          $csv_file_name="";
          $json_file_name="";
          $get_media_list= get_media(array('aiid'=>$_GET['invoiceid']));        
            
          if(isset($get_media_list['success']) && $get_media_list['success']=="true"){
              foreach ($get_media_list['data'] as $mediavalue){
                        if($mediavalue['extension']=="xls"){
                          $csv_file_name=$mediavalue['mediaName'].".".$mediavalue['extension'];
                        }
                        else if($mediavalue['extension']=="json"){
                          $json_file_name=$mediavalue['mediaName'].".".$mediavalue['extension'];
                        }else{}
                        
              }
              if($json_file_name!=""){
                    $json_path=media_url()."others/".$json_file_name;
                    $jsonfilecontent=file_get_contents($json_path);
                    $json['data']=json_decode($jsonfilecontent, true);
              }
              if($csv_file_name!=""){
                 $csv_file_path=server_path().'uploads/28/media/others/'.$csv_file_name;
              }
          }
      }
      
      /*echo $csv_file= server_path().'uploads/28/media/others/'.$csv_file_name;
      if (is_readable($csv_file))  
      { 
          echo ' is readable'; 
          echo file_get_contents($csv_file);
      }  
      else 
      { 
          echo ' is not readable'; 
          
      } */
      $user_id=$_SESSION['user']['user_id'];
      $get_media_list= get_media(array("aiid"=>$user_id));
?>
<div id="content">
      <div class="row">
	  
	  <div class="col-md-12">
	  <div class="text-right pdf-mrgg">
                        <select class="load_invoice_data btn-pdf">
                          <option value="">Select File To Load</option>
                          <?php $pdf_file_path=""; $counter=1; foreach ($get_media_list['data'] as $mediavalues) {
                                $selected=""; 
                              if(isset($_GET['invoiceid']) && $mediavalues['id']==$_GET['invoiceid']){
                                $selected="selected";
                                $pdf_file_path=media_url()."others/".$mediavalues['mediaName'];
                              }
                          ?>
                            <option value="<?php echo $mediavalues['id'];?>" <?php echo $selected; ?>>Invoice - <?php echo $counter;?></option>
                          <?php $counter++; } ?>
                        </select>
                        <button class="btn btn-default btn-pdf" onclick="upload_invoice()" >Upload</button>
                       <button class="btn btn-default btn-pdf" onclick="submit_invoice()" >Submit</button>
					   </div>
					   </div>
        <section class="">
          <header class="">
            
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-box" id="field_list_input">
				  <!--<div class="input-group">
						<span class="input-group-addon">NAME</span>
						<input id="msg" type="text" class="form-control" name="msg" placeholder="Additional Info">
					  </div>-->
            <div class="input-group">

                      <button class="btn btn-default btn-pdf-button" data-toggle="modal" data-target="#add_fields"><i class="fa fa-plus"></i></button>
                    </div>
                    <?php foreach ($json as $key => $value) { ?>
                      
					   <div class="input-group">
						<span class="input-group-addon">NAME</span>
						<input id="name" type="text" class="form-control droppable_table" name="Name" placeholder="Name" value="<?php echo $value['Name']; ?>">
						
					 </div>
					  
                      <div class="input-group">
						<span class="input-group-addon">Invoice No</span>
						<input id="invoice_no" type="text" class="form-control droppable_table" name="invoice_no" placeholder="Invoice No" value="<?php echo $value['invoice_no']; ?>">
						
					 </div>

                      <div class="input-group">
						<span class="input-group-addon">Total Amount</span>
						<input id="total_amount" type="text" class="form-control droppable_table" name="total_amount" placeholder="Total Amount" value="<?php echo $value['Total_Amount']; ?>">
						
					 </div>

                      <div class="input-group">
						<span class="input-group-addon">Description</span>
						<input id="description" type="text" class="form-control droppable_table" name="Description" placeholder="Description" value="<?php echo $value['Description']; ?>">
						
					 </div>

                      
					 <div class="input-group">
						<span class="input-group-addon">Address</span>
						<input id="address" type="text" class="form-control droppable_table" name="Address" placeholder="Address" value="<?php echo $value['Address']; ?>">
						
					 </div>
					 
                      <div class="input-group">
						<span class="input-group-addon">PO Number</span>
						<input id="po_number" type="text" class="form-control droppable_table" name="PO_Number" placeholder="PO Number" value="<?php echo $value['PO_Number']; ?>">
						
					 </div>

                    
					<div class="input-group">
						<span class="input-group-addon">GST Number</span>
						<input id="gst_number" type="text" class="form-control droppable_table" name="gst_number" placeholder="GST Number" value="<?php echo $value['GST_Number']; ?>">
						
					 </div>
					 
                    <div class="input-group">
						<span class="input-group-addon">Order Number</span>
						<input id="Order_Number" type="text" class="form-control droppable_table" name="Order_Number" placeholder="Order Number" value="<?php echo $value['Order_Number']; ?>">
						
					 </div>

                      
					<div class="input-group">
						<span class="input-group-addon">PAN Number</span>
						<input id="PAN_Number" type="text" class="form-control droppable_table" name="PAN_Number" placeholder="PAN Number" value="<?php echo $value['PAN_Number']; ?>">
						
					 </div>
					 
                      <div class="input-group">
						<span class="input-group-addon">Invoice Date</span>
						<input id="invoice_date" type="text" class="form-control droppable_table" name="invoice_date" placeholder="Invoice Date" value="<?php echo $value['invoice_date'][0]; ?>">
						
					 </div>

                      

                    <?php }?>

                  </div>

              </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-box-l">
                  <?php if($pdf_file_path!=""){?>
                  <img src="<?php echo $pdf_file_path; ?>" >
                <?php } ?>
                </div>
                <div class="form-box-2 simplebar" id="draggable_table"></div>
              </div>
            </div>
            </div>
          </header>
        </section>
      </div>
    </div>
    <div id="add_fields" class="modal fade in" data-width="300">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-times"></i>
              </button>
              <h4 class="modal-title">
                <?php echo $ui_string['add']." ".$ui_string['fields'];?>
              </h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
              <form method="post">
               <div class="form-group row">
                  <div class="col-md-12"> 
                          <label class="control-label"><?php echo $ui_string['field_name'];?>*</label>
                          <input type="text" id="f_key" name="f_key" class="form-control">
                          <span id="ef_key" class="error"></span>
                  </div>
                </div>
            </form>
          </div>
            <div class="modal-footer">
            <button class="btn btn-default" onclick="add_more();">Submit</button>       
            </div>
          </div>
</div>

<script type="text/javascript">
  var csv_path=<?php echo json_encode($csv_file_path); ?>;
  $.ajax({
    url: admin_ui_url+"invoicePdf/table_content.php",
    type:"post",
    data:{"id":1,"path":csv_path},
    success:function(res){
        $("#draggable_table").html(res);
        setTimeout(function(){
          $(".drag").draggable({
                  appendTo: 'body',
                  containment: 'window',
                  scroll: false,
                   stack: '.drag',
                  cursor: 'move',
                  revert: true,
                   helper: 'clone',
                   cursorAt: { top: 0, left: 0 },
                   start: function( event, ui ) {
                    if($(this).hasClass('action-active'))
                    {
                      if($('.action-active').length){
                          var text=[];
                          $('.action-active').each(function(){
                              if(!$(this).hasClass('ui-draggable-dragging'))
                              {
                                text.push($(this).text());
                              }
                          });
                          
                          text=text.join('<br/>');
                          
                          $('.ui-draggable-dragging').css('color','black');
                          $('.ui-draggable-dragging').html(text);
                      }
                    }
                    else
                    {
                      $('.action-active').removeClass('action-active');
                    }
                   },
                   drag:function(event,ui){
                      $('.ui-draggable-dragging').css('position','fixed');
                      $('.ui-draggable-dragging').show();
                   }
                });

              $('.droppable_table').droppable({
                  accept: '.drag',
                  hoverClass: 'hovered',
                  drop: handleCardDrop,
                  over:function(){ console.log('over'); }
                });
              }, 3000);
    }
  });


  function handleCardDrop( event, ui ){
    //var slotNumber = $(this).data( 'number' );
    //var cardNumber = ui.draggable.data( 'number' );
    ui.draggable.addClass( 'correct' );
    //ui.draggable.draggable( 'disable' );
    // $(this).droppable( 'disable' );
   // ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
    ui.draggable.draggable( 'option', 'revert', false );
    var previous_value=$("#"+event.target.id).val();
    if(previous_value!=""){
      previous_value +=" "+$(ui.draggable).text();  
    }else{
      previous_value =$(ui.draggable).text();
    }

    if($('.action-active').length)
    {
        var text=[];
          $('.action-active').each(function(){
              if(!$(this).hasClass('ui-draggable-dragging'))
              {
                text.push($(this).text());
              }
          });
        $("#"+event.target.id).val(text.join('  '));
    }
    else
    {
      $("#"+event.target.id).val(previous_value); 
    }
  }
function add_more(){
  var f_key=$("#f_key").val().trim();
  var placeholder=f_key;
  var myarray = [];
  if(f_key==""){
      $("#f_key").focus();
      $("#ef_key").html(ui_string['Plz_field_name']);
      setTimeout(function(){ $("#ef_key").html(""); },2000);
      return false;
  }else{
    
    $( ".droppable_table" ).each(function() {
        myarray.push($( this ).attr("id"));
    });
    
      f_key=f_key.replace(/ /g,"_").toLowerCase();
      var checkindex=jQuery.inArray(f_key, myarray);
      if(checkindex=="-1"){
        
          $('<div class="input-group"><span class="input-group-addon">'+placeholder+'</span><input id="invoice_date" type="text" class="form-control droppable_table"placeholder="'+placeholder+'" type="text" name="'+f_key+'" id="'+f_key+'"></div>').appendTo("#field_list_input").droppable({
                accept: '.drag',
                hoverClass: 'hovered',
                drop: handleCardDrop
          });
          $("#add_fields").modal("hide");

      }else{
        $("#f_key").focus();
            $("#ef_key").html(ui_string['field_name_already']);
            setTimeout(function(){ $("#ef_key").html(""); },2000);
            return false;                           
      }
  }
}
function submit_invoice(){
    var fields_array = {};
    $(".droppable_table").each(function() {
        fields_array[$(this).attr("id")]=$(this).val();
    });
    $.ajax({
      url: admin_ui_url+"invoicePdf/submit_field.php?action=submit",
      type:"post",
      data: fields_array,
      success:function(res){
          $("#model_head").html(ui_string['success']);
          $("#model_des").html("Successully Submitted");
          $('#success_modal').modal();
          setTimeout(function(){ window.location=admin_ui_urls+'invoicePdf'; },2000);

      }
    });
}
function upload_invoice(){
      setloader();
      $.ajax({
              url: admin_ui_url+"invoicePdf/submit_field.php?action=upload_request",
              type:"post",
              data: {"ip":useripaddress,"userid":currentUserId},
              success:function(res){
                var datajson=JSON.parse(res);
                setTimeout(function(){ processing_of_invoice(datajson['data']); },3000);
              }
    });
}
function processing_of_invoice(id){
      $.ajax({
              url: admin_ui_url+"invoicePdf/submit_field.php?action=uploading_process",
              type:"post",
              data: {"id":id},
              success:function(res){
                var datajson=JSON.parse(res);
                if(datajson['data'][0]['status']=="1"){
                    unloading();
                    $("#model_head").html(ui_string['success']);
                    $("#model_des").html("File Upload Successully.");
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                }else{
                  setTimeout(function(){ processing_of_invoice(id); },3000);
                }
            }
    });
}
$(".load_invoice_data").change(function(){
    var id=$(this).val();
    window.location=admin_ui_urls+'invoicePdf?invoiceid='+id;
});
var cntrlIsPressed = false;
$(document).keydown(function(event){
    if(event.which=="17")
        cntrlIsPressed = true;
});

$(document).keyup(function(){
    cntrlIsPressed = false;
});

$(document).ready(function(){
  $('.tdclass').on('click',function(){
      if(cntrlIsPressed)
      {
         $(this).addClass('action-active');
      }
      else
      {
          $('.action-active').removeClass('action-active');
      }
  });
});

</script>
<script src="<?php echo site_url()."company/".$companyData['cid']."/"; ?>assets/js/custom.js"></script>
<?php get_admin_footer(); ?> 