function getCustomFormData()
{
  var formValueJson=[];
  var checkValid=[];
  $('.error').html('&nbsp;');

    $('.formContainer').each(function(){ 
          var customFieldId=this.id; 
          var currentFieldId=$('#'+customFieldId).attr('data-id');
          var dataType=$('#'+customFieldId).attr('data-type');
          var required=$('#'+customFieldId).attr('data-required');
          var fieldsJson=[];
              switch(dataType)
              {
                case "checkbox":
                  
                    $("."+currentFieldId).each( function () {
                        var checkValue=0;
                        var ID=this.id;

                        var tmpJson={"id":ID,"tm":currentTime,"uid":currentUserId};
                        if($('#'+ID).attr('data-uid')){  tmpJson['uid']=$('#'+ID).attr('data-uid'); }
                        if($('#'+ID).attr('data-ms')){  tmpJson['ms']=$('#'+ID).attr('data-ms'); }

                        var valueJson=[];
                        $('.'+ID).each(function(){
                              if($('#'+this.id).prop('checked')){ valueJson.push(this.value); checkValue=1;  }
                        })
                        tmpJson['val']=valueJson.toString();
                        fieldsJson.push(tmpJson);
                        if(required=='true' && !$('#'+ID).hasClass('notValid'))
                        {
                          if(checkValue==0)
                          {
                            var er=languageStrings[$('#errorMessage_'+currentFieldId).val()];
                            if(!er){ er=ui_string['default_error']; }
                            checkValid.push(currentFieldId);  $('#error_'+ID).html(er);
                          }
                       }
                    });
                    
                break;
                case "radio":
                  $("."+currentFieldId).each( function () {
                        var checkValue=0;
                        var ID=this.id;
                        var tmpJson={"id":ID,"tm":currentTime,"uid":currentUserId};
                        if($('#'+ID).attr('data-uid')){  tmpJson['uid']=$('#'+ID).attr('data-uid'); }
                        if($('#'+ID).attr('data-ms')){  tmpJson['ms']=$('#'+ID).attr('data-ms'); }
                        var valueJson=[];
                        $('.'+ID).each(function(){
                              if($('#'+this.id).prop('checked')){ valueJson.push(this.value); checkValue=1;  }
                        })
                        tmpJson['val']=valueJson[0];
                        fieldsJson.push(tmpJson);
                        if(required=='true' && !$('#'+ID).hasClass('notValid'))
                        {
                            if(checkValue==0)
                            {
                              var er=languageStrings[$('#errorMessage_'+currentFieldId).val()];
                              if(!er){ er=ui_string['default_error']; }
                              checkValid.push(currentFieldId);  $('#error_'+ID).html(er);
                            }
                        }
                    });
                break;
                case "signature":
                  var checkValue=0;
                  if(required=='true')
                  {
                      var ID=this.id;
                      if(required=='true' && !$('#'+ID).hasClass('notValid'))
                      {
                        $('.sign_'+currentFieldId).each(function(){ checkValue++; });
                          if(checkValue==0)
                          {
                            var er=languageStrings[$('#errorMessage_'+currentFieldId).val()];
                            if(!er){ er=ui_string['default_error']; }
                            checkValid.push(currentFieldId);  
                            $('#error_'+currentFieldId+"_1").html(er);
                          }
                      }
                  }
                  var lc=1;
                    $('#'+customFieldId+' .customField').each(function(){
                        var ID=this.id;

                        if(isJson($('#'+ID).val()))
                        {
                          var fieldJsonDt=JSON.parse($('#'+ID).val());
                          if(fieldJsonDt['mediaId']==''){ delete fieldJsonDt['mediaId'];  }
                          fieldsJson.push(fieldJsonDt);
                        }
                        else
                        {
                            var valueVariable=$('#'+ID).val().split("\\");
                            var  vr=valueVariable[valueVariable.length-1];
                            var jsd={"id":currentFieldId+"_"+lc,"val":vr,"tm":currentTime,"uid":currentUserId};
                            fieldsJson.push(jsd);
                        }
                     lc++;
                    });
                break;
                default:
                    var lc=1;
                    $('#'+customFieldId+' .customField').each(function(){
                        var ID=this.id;
                         if(required=='true' && !$('#'+ID).hasClass('notValid'))
                          {
                              if($('#'+ID).val().trim()==''){ 
                                  checkValid.push(ID);
                                  var er=languageStrings[$('#errorMessage_'+currentFieldId).val()];
                                  if(!er){ er=ui_string['default_error']; }
                                  $('#error_'+ID).html(er);
                              }
                          }
                          if(dataType=='email' && $('#'+ID).val().trim()!=''){ 
                              var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                              if(!regex.test($('#'+ID).val().trim()))
                              {
                                checkValid.push(ID);
                                $('#error_'+ID).html("Enter valid email id");
                              }
                          }
                          
                          if(dataType=='numeric' && $('#'+ID).val().trim()!=''){ 
                              if(isNaN($('#'+ID).val().trim()))
                              {
                                checkValid.push(ID);
                                $('#error_'+ID).html("Enter only numeric digits");
                              }
                              else
                              {
                                 var maxlength=$('#'+ID).attr('max');var minlength=$('#'+ID).attr('min');
                                 if(minlength){ if(minlength>$('#'+ID).val().length){ 
                                    checkValid.push(ID);
                                    $('#error_'+ID).html("Minimum number of digits should be greater than or equal to "+minlength); 
                                  } }

                                 if(maxlength){ if(maxlength<$('#'+ID).val().length){ 
                                    checkValid.push(ID);
                                    $('#error_'+ID).html("Maximum number of digits should be less than or equal to "+maxlength); 
                                  } }
                              }
                          }
                          
                          if($('#'+ID).attr('data-stored')=='true')
                          { 
                            fieldsJson.push(JSON.parse($('#'+ID).val())); 
                          }
                          else
                          {

                            if($('#'+ID).val())
                            {
                                if(dataType!='recordVideo'){
                                  var valueVariable=$('#'+ID).val().split("\\");
                                  valueVariable=valueVariable[valueVariable.length-1];
                                }else{
                                  valueVariable=$('#'+ID).val();
                                }
                                valueVariable=valueVariable.replace(/\n/g, "\\n");
                                valueVariable=valueVariable.replace(/\"/g, "\\\"");
                                valueVariable=valueVariable.replace(/\t/g, "\\t");

                                var pushJson={"id":currentFieldId+"_"+lc,"val":valueVariable,"tm":currentTime,"uid":currentUserId};
                                if($('#'+ID).attr('data-uid')){  pushJson['uid']=$('#'+ID).attr('data-uid'); }
                                if($('#'+ID).attr('data-ms')){  pushJson['ms']=$('#'+ID).attr('data-ms'); }
                                fieldsJson.push(pushJson);

                            }
                          }
                       lc++;
                    });
                break;
              }
              
          formValueJson.push({'id':currentFieldId,'type':dataType,'fields':fieldsJson});
    });
    
    if(checkValid.length==0)
    {         
      var formValueJsonFinal = JSON.stringify(formValueJson);
      formValueJsonFinal=formValueJsonFinal.replace(/'/g, " ");

      $('#form_data').val(formValueJsonFinal);
      return formValueJsonFinal;
    }
    else
    {
      $('#'+checkValid[0]).focus();
      return false;
    }
    
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}


function saveform()
{  
  

  $('#eformtitle').html(''); 
  $('#eformdescription').html('');
  $('#eaction_comment').html('');      
  var formData=getCustomFormData();
  var formtitle=$('#formtitle').val();
  var formdescription=$('#formdescription').val();
  var action_comment=$('#action_comment').val();
 
  if(formData && formtitle && formdescription && action_comment)
  { 

  var datastring='id=0&smid=3&title='+formtitle+'&description='+formdescription.val()+'&action_by='+$('#userId').val()+'&form_id='+$('#formId').val()+'&action_comment='+action_comment+'&form_data='+formData;
   
   $.ajax({
           url:site_url+'webservices/create_form_job',
           method:'POST',
           data:datastring,
           success:function(data)
           {

              console.log(data);
              if(data['errorcode']=='5010')
              {
                  
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Add Successfully');
                  $('#success_modal').modal();
                 //$('#e_pg_content').html('Add Successfully');
                  setTimeout(function(){  window.location=site_url+'controller/?type=form_listing&formtype=pendingform&job=3'; },100);
                   
              }
              else
              {
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Something Went Wrong');
                  $('#success_modal').modal();
                 // $('#e_pg_content').html('Something Went Wrong');     
              }
           }
   });
 }   
 else
 {
            if(!formtitle){ $('#eformtitle').html('Please Enter Title'); }
            if(!formdescription){ $('#eformdescription').html('Please Enter Description'); }
            if(!action_comment){ $('#eaction_comment').html('Please Enter Comment'); }
 }
}





function savesendapproval()
{  
  $('#eformtitle').html(''); 
  $('#eformdescription').html('');
  $('#eaction_comment').html('');      
  var formData=getCustomFormData();
  var formtitle=$('#formtitle').val();
  var formdescription=$('#formdescription').val();
  var action_comment=$('#action_comment').val();
 
  if(formData && formtitle && formdescription && action_comment)
  { 
   var datastring='id=0&smid=3&title='+formtitle+'&description='+formdescription+'&fa='+$('#assignuser').val()+'&action_by='+$('#userId').val()+'&form_id='+$('#formId').val()+'&action_ts='+$('#action_ts').val()+'&action_comment='+action_comment+'&form_data='+formData;

   $.ajax({
           url:site_url+'webservices/create_form_job',
           method:'POST',
           data:datastring,
           success:function(data)
           {

              console.log(data);
              if(data['errorcode']=='5010')
              {
                  
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Add Successfully');
                  $('#success_modal').modal();
                 //  $('#e_pg_content').html('Add Successfully');
                  setTimeout(function(){  window.location=site_url+'/controller/?type=form_listing&formtype=openform&job=3'; },100);
                   
              }
              else
              {
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Something Went Wrong');
                  $('#success_modal').modal();
                 // $('#e_pg_content').html('Something Went Wrong');     
              }
           }
   });
 }
 else
 {
            if(!formtitle){ $('#eformtitle').html('Please Enter Title'); }
            if(!formdescription){ $('#eformdescription').html('Please Enter Description'); }
            if(!action_comment){ $('#eaction_comment').html('Please Enter Comment'); }
 }
   
}

function approval()
{  

  $('#eaction_comment').html('');      
  var formData=getCustomFormData();
  var action_comment=$('#action_comment').val();
 
  if(formData && action_comment)
  {  
   var datastring='id='+$('#jobId').val()+'&action_by='+$('#userId').val()+'&jobsmid=3&action=1&action_ts='+$('#action_ts').val()+'&action_comment='+action_comment+'&form_data='+formData;
   
   //console.log(datastring);
   $.ajax({
           url:site_url+'webservices/mark_formjob_action',
           method:'POST',
           data:datastring,
           success:function(data)
           {

              console.log(data);
              if(data['errorcode']=='5075')
              {
                  //$('#e_pg_content').html('Update Successfully');
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Approve Successfully');
                  $('#success_modal').modal();
                  setTimeout(function(){  window.location=site_url+'/controller/?type=form_listing&formtype=pendingform&job=3'; },100);
                  //setTimeout(function(){  location.reload(); },100);
                   
              }
              else
              {
                  //$('#e_pg_content').html('Something Went Wrong');     
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Something Went Wrong');
                  $('#success_modal').modal();
              }
           }
   });
  }
 else
 {
            if(!action_comment){ $('#eaction_comment').html('Please Enter Comment'); }
 }
}

function reject()
{  
   var datastring='id='+$('#formId').val()+'&action_by='+$('#userId').val()+'&jobsmid='+$('#jobsmid').val()+'&action=2'+'&action_ts='+$('#action_ts').val()+'&action_comment='+$('#action_comment').val();
   
   $.ajax({
           url:site_url+'webservices/mark_formjob_action',
           method:'POST',
           data:datastring,
           success:function(data)
           {
              if(data['errorcode']=='5077')
              {
                  //$('#e_pg_content').html('Update Successfully');
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Reject Successfully');
                  $('#success_modal').modal();
                  setTimeout(function(){  window.location=site_url+'/controller/?type=form_listing&formtype=pendingform&job=3'; },100);
                  //setTimeout(function(){  location.reload(); },100);
                   
              }
              else
              {
                  //$('#e_pg_content').html('Something Went Wrong');     
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Something Went Wrong');
                  $('#success_modal').modal();
              }
           }
   });  

}


function sendforapproval()
{  
    
   var datastring='id='+$('#jobId').val()+'&fa='+$('#assignuser').val()+'&action_by='+$('#userId').val()+'&jobsmid=3&action=3&action_ts='+$('#action_ts').val()+'&action_comment='+$('#action_comment').val();
   
   console.log(datastring);
   $.ajax({
           url:site_url+'webservices/mark_formjob_action',
           method:'POST',
           data:datastring,
           success:function(data)
           {

              console.log(data);
              if(data['errorcode']=='5075')
              {
                  //$('#e_pg_content').html('Update Successfully');
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Send for Approval Successfully');
                  $('#success_modal').modal();
                  setTimeout(function(){  window.location=site_url+'/controller/?type=form_listing&formtype=openform&job=3'; },100);
                  //setTimeout(function(){  location.reload(); },100);
                   
              }
              else
              {
                  //$('#e_pg_content').html('Something Went Wrong');     
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Something Went Wrong');
                  $('#success_modal').modal();
              }
           }
   });
   
}



function addtotrack()
{  
    
   var datastring='jobId='+$('#jobId').val()+'&userId='+$('#userId').val();
  
   //alert(datastring)
   $.ajax({
           url:site_url+'webservices/manage_track_formjob',
           method:'POST',
           data:datastring,
           success:function(data)
           {

              console.log(data);
              if(data['success']=='true')
              {
                
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Add Successfully');
                  $('#success_modal').modal();
                 //  $('#e_pg_content').html('Add Successfully');
                 // setTimeout(function(){  location.reload(); },100);
                  setTimeout(function(){  window.location=site_url+'/controller/?type=form_listing&formtype=trackform&job=3'; },100);
                   
              }
              else
              {
                  $("#model_head").html('Confirm');
                  $("#model_des").html('Something Went Wrong');
                  $('#success_modal').modal();
                 // $('#e_pg_content').html('Something Went Wrong');     
              }
           }
   });
   
}
function submitForApproval(type)
{  
  var formData=getCustomFormData('form_data');

  if(formData)
  {
     if(type=='sendforapproval'){ actionType='sendforapproval'; 
     $("#action").val('1');
      }
     else if(type=='approval'){ actionType='approval'; 
    $("#action").val('2');
       }
         else if(type=='reject'){ actionType='reject'; 
    $("#action").val('3');
       }
         else if(type=='closeform'){ actionType='closeform'; 
    $("#action").val('1');
       }
         else if(type=='closenotify'){ actionType='closenotify'; 
    $("#action").val('1');
       }
         else if(type=='addtotrack'){ actionType='addtotrack'; 
    $("#action").val('1');
       }
         else if(type=='save'){ actionType='save'; 
    $("#action").val('1');
       }
         else if(type=='sendedit'){ 
                  $('#editMode').val('1');
                 actionType='sendedit'; 
                 $("#action").val('1');
          }
         else if(type=='editdone'){ actionType='editdone'; 
    $("#action").val('1');
       }

     $('#addnewform').submit();
  }
  else if(type=='reject')
  { 
    actionType='reject'; 
    $("#action").val('3');
    $('#addnewform').submit();
  }
}
