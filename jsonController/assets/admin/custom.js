
function submit_job()
{

// var datastring=$("#validate-wizard").serialize();
 
 var datastring = new FormData($('#validate-wizard')[0]);
        //alert(formData);

   
        $.ajax({
            url:admin_url+"job/ajax/job_manage.php?action=job_add&jobsmid="+jobsmid,
            type:"post",
            data:datastring,
            success:function(suc)
            {
              // alert(suc); 
            }
});
return false;

}





 // var files=1;
  function addRow(type) {
      //  files++;
        $( '.'+'custom-'+type.replace("[]","")).append( '<div class="row"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="fileinput fileinput-new" data-provides="fileinput" >\
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 100px;"></div>\
                            <div><span class="btn btn-default btn-file">\
                                <span class="fileinput-new">Select More</span><span class="fileinput-exists">Change</span>\
                             <input type="file" name="'+ type +'" class="allFiles" onclick="addRow(this.name)" onchange="ValidateSingleInput(this);"></span>\
                             <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>\
                             </div></div></div></div>' );
        }


   
function ValidateSingleInput(oInput) {

    if (oInput.name == "attachmnt"){
    var _validFileExtensions = [".doc", ".docx", ".pdf", ".acrobat", ".png", ".jpeg", ".jpg"];     
    }
    else if (oInput.id == "pdfid") {
    var _validFileExtensions = [".pdf", ".x-pdf", ".acrobat", ".vnd.pdf", ".x-bzpdf", ".x-gzpdf"]; 
    }
    else if (oInput.id == "docid"){
    var _validFileExtensions = [".JPG", ".JPEG", ".jpeg", ".jpg"];     
    }
    else if (oInput.id == "audioid"){
    var _validFileExtensions = [".aac", ".wav", ".mp3", ".amr", ".m4p"];     
    }
    else if (oInput.id == "videoid"){
    var _validFileExtensions = [".3gp", ".avi", ".flv", ".mp4", ".mpeg"];     
    }
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
  }



function myjobs(ele){
          setloader();
        var countter=1;  
        var datastring="jobsmid="+jobsmid+"&count="+countter; 
        var joblisttype=$(ele).attr('id');
        // for scroll function
        $('#moue_click').attr('onclick',"moredata_append('"+joblisttype+"')");

        if(joblisttype=="myjob"){
         var urltype=admin_url+"job/ajax/job_manage.php?action=myjobs";
        }
        else if(joblisttype=="assignjob"){
          urltype=admin_url+"job/ajax/job_manage.php?action=assignjobs"; 
        }
        else{
          urltype=admin_url+"job/ajax/job_manage.php?action=userjobs";
        } 
        //alert(urltype);     
        $.ajax({
              url: urltype,
              type:"post",
              data: datastring,
              success:function(suc)
                {
                 //alert(suc);
                console.log(suc);
                unloading();
                var setting_file=new Array();
    
                setting_file['media_file']=1;
                countter++;
                var poritys=1;
                var priority_active="";
                var loops=0;
                var media_setting="";
                var json=JSON.parse(suc);
              
                

                var ui_value="";
                if(json['detailjob'])
                {
                var lengthof=json['detailjob']['data'].length;
                for (loops=0;loops<lengthof;loops++)
                {   
                    var id= json['detailjob']['data'][loops]['id'];
                    //json['data'][loops]['associated_data'];
                    //json['data'][loops]['associated_data'][0]['location'][1];
                    var date = new Date(json['detailjob']['data'][loops]['time']*1000);
                    var new_date =  formatDate(date);
                    var lng=json['detailjob']['data'][loops]['meta_job_address_long'];
                    var lat=json['detailjob']['data'][loops]['meta_job_address_lat'];
                    var title=json['detailjob']['data'][loops]['title'];
                    var address=json['detailjob']['data'][loops]['meta_job_address'];
                    var desc=json['detailjob']['data'][loops]['description']
                    //console.log(json['detailjob']);

                    //var favour=getfavorites(id);
                    var favor=json['fav'][loops]['val'];
                    if(favor==poritys)
                     {
                        priority_active="active";
                     }
                     else
                     {
                        priority_active="";
                     }
                     if(setting_file['media_file']!=0)
                     {
                        media_setting="fa-paperclip";
                     }

                    if(!json['detailjob']['data'][loops]['status'])
                    { 
                          json['detailjob']['data'][loops]['status']=4;
                    }                     
                    var class_status="";
                    var userstatus=json['detailjob']['data'][loops]['status'][0]['status']; 
                    var status=json['detailjob']['data'][loops]['status'][0]['status'];  
                    //console.log(status);
                    if(status==4)
                    {
                    status=0;
                    }
                    else if(status==0)
                    {
                    status=1;
                    }
                    else
                    {
                    status=2;
                    }
                    for(var seting_status=0;seting_status <setting_array.length;seting_status++)
                    {   
                       if(status==seting_status)
                        {
                         class_status=setting_array[seting_status];
                        }
                    }
                   if(class_status=="New"){
                      active="new_col active";
                    }
                    else if (class_status=="Pending") {
                      active="panding_col active";
                    }
                    else{
                      active="approve_col active";
                    }
                     
                   
                    ui_value+='<li id="'+id+'" class="lilist" ><div class="iCheck"  data-style="minimal"  data-color="red"><input type="checkbox"></div><a href="#" class="mail-favourite '+priority_active+'" onclick="makefavourite('+id+');"><i class="glyphicon glyphicon-star"></i></a> <span><h5><a href="#" onclick="getdetailjob('+id+'),getjobcomment('+id+')">'+title+'</a></h5><p><strong>'+ desc.substr(0,20)+'</strong> ,'+ desc.substr(0,20)+'</p><time>'+new_date+'</time><label class="'+active+'" data-color="'+class_status+'"></label><input type="hidden" class="statusjob" name="statusjob" id="statusjob'+userstatus+'" value="'+userstatus+'"/><div class="mail-tools"></div></span></li>';
                    
                    //$('.iCheck').icheck('update');  
      
                    // console.log(ui_value);
                     add_marker(id,lat,lng,title,address);
                   
                }
                }
                if(joblisttype=="assignjob"){
                     $("#assignjoblist").html(ui_value);
                     $('#assignjoblist').show();
                     $('#myjoblist').hide();
                     $('#userjoblist').hide();
                     $("#job").show();
                     $("#jobDetail").hide();
                     $('#assignjoblist').addClass("active");
                     $('#userjoblist').removeClass("active");
                     $('#myjoblist').removeClass("active");
                }
                else if(joblisttype=="myjob"){
                    $("#myjoblist").html(ui_value);
                    $('#myjoblist').show();
                    $('#assignjoblist').hide();
                    $('#userjoblist').hide();
                    $("#job").show();
                    $("#jobDetail").hide();
                    $('#myjoblist').addClass("active");
                    $('#assignjoblist').removeClass("active");
                    $('#userjoblist').removeClass("active");
                }
                else{
                    $("#userjoblist").html(ui_value);
                    $('#userjoblist').show();
                    $('#assignjoblist').hide();
                    $('#myjoblist').hide();
                    $("#job").show();
                    $("#jobDetail").hide();
                    $('#userjoblist').addClass("active");
                    $('#assignjoblist').removeClass("active");
                    $('#myjoblist').removeClass("active");
                } 
                
                }


                });
        
   }  



/* function assignjobslist()
 {  
        setloader();
        var datastring="jobsmid="+jobsmid;
        //alert(datastring);     
        $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=assignjobs",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                unloading();
                var setting_file=new Array();
    
                setting_file['media_file']=1;
                countter++;
                var poritys=1;
                var priority_active="";
                var loops=0;
                var media_setting="";
                var json=JSON.parse(suc);
                 //console.log(suc);
                var lengthof=json['detailjob']['data'].length;

                var ui_value="";
                if(json['detailjob']['data']!=undefined)
                 {
                for (loops=0;loops<lengthof;loops++)
                {
                    var id= json['detailjob']['data'][loops]['id'];
                    //json['data'][loops]['associated_data'];
                    //json['data'][loops]['associated_data'][0]['location'][1];
                    var date = new Date(json['detailjob']['data'][loops]['time']*1000);
                    var new_date =  formatDate(date);
                    var lng=json['detailjob']['data'][loops]['meta_job-address-long'];
                    var lat=json['detailjob']['data'][loops]['meta_job-address-lat'];
                    var title=json['detailjob']['data'][loops]['title'];
                    var address=json['detailjob']['data'][loops]['meta_job-address'];
                    var desc=json['detailjob']['data'][loops]['description']
                    //console.log(json['data'][loops]['priority']);

                    //var favour=getfavorites(id);
                    var favor=json['fav'][loops]['val'];
                    if(favor==poritys)
                     {
                        priority_active="active";
                     }
                     else
                     {
                        priority_active="";
                     }
                     if(setting_file['media_file']!=0)
                     {
                        media_setting="fa-paperclip";
                     }
                    var class_status="";
                    
                    var userstatus=json['detailjob']['data'][loops]['status'][0]['status']; 
                    var status=json['detailjob']['data'][loops]['status'][0]['status'];  
                    //console.log(status);
                    if(status==4)
                    {
                    status=0;
                    }
                    else if(status==0)
                    {
                    status=1;
                    }
                    else
                    {
                    status=2;
                    }
                    for(var seting_status=0;seting_status <setting_array.length;seting_status++)
                    {   
                       if(status==seting_status)
                        {
                         class_status=setting_array[seting_status];
                        }
                    }
                    if(class_status=="New"){
                      active="new_col active";
                    }
                    else if (class_status=="Pending") {
                      active="panding_col active";
                    }
                    else{
                      active="approve_col active";
                    }
                     
                     ui_value+='<li id="'+id+'" class="lilist" ><div class="iCheck"  data-style="minimal"  data-color="red"><input type="checkbox"></div><a href="#" class="mail-favourite '+priority_active+'" onclick="makefavourite('+id+');"><i class="glyphicon glyphicon-star"></i></a> <span><h5><a href="#" onclick="getdetailjob('+id+'),getjobcomment('+id+')">'+title+'</a></h5><p><strong>'+ desc.substr(0,20)+'</strong> ,'+ desc.substr(0,20)+'</p><time>'+new_date+'</time><label class="'+active+'" data-color="'+class_status+'"></label><input type="hidden" class="statusjob" name="statusjob" id="statusjob'+userstatus+'" value="'+userstatus+'"/><div class="mail-tools"></div></span></li>';
                     //alert(ui_value);
                     add_marker(id,lat,lng,title,address);              
                   
                }
                }
               $("#assignjoblist").html(ui_value);
               $('#myjoblist').hide();
               $('#assignjoblist').show();
               $("#job").show();
               $("#jobDetail").hide();
                //$('#assignjoblist').removeClass("active");
                //$('#myjoblist').addClass("active");
                }


                });

 }     */   
  
  
 function add_job(){ 
    
                        //clear all fields
                        $('.error').html('');
                        $('#jobtitle').val('');
                        $('#jobid').val('0');
                        $('#description').val('');
                        $('#jobcategory').val('');
                        $('#jobtype').val('');
                        $('#jobpriority').val('');
                        $('#jobassogned').tagsinput('removeAll');
                        //$('#jobassogned').val('');
                        //$('.bootstrap-tagsinput').html('');
                        $('#jobduration_date').val('');
                        $('#jobduration_end').val('');
                        $('#jobduration').val('');
                        $('[name=track]').val();
                        $('#trackhrs').val('');
                        $('#trackmins').val('');
                        $('#job_customer_name').val('');
                        $('#job_contact_no').val('');
                        $('#job_address').val('');
                        $('#job_address_lat').val('');
                        $('#job_address_long').val('');
                        $('#note').val('');
                        $('#signature').html('');
                        $('#signature_badge').html('');
                        $('#signature_one').html('');
                        $('#prview_pdf').html('');
                        $('#prview_pdf_one').html('');
                        $('#pdf_badge').html('');
                        $('#prview_doc').html('');
                        $('#prview_doc_one').html('');
                        $('#doc_badge').html('');
                        $('#prview_audio').html('');
                        $('#prview_audio_one').html('');
                        $('#audio_badge').html('');
                        $('#prview_video').html('');
                        $('#prview_video_one').html('');
                        $('#video_badge').html('');
                        $('#prview_feedback').html('');
                        $('#feedback_badge').html('');
                        $('#prview_tracking').html('');
                        $('#tracking_badge').html('');
    $('#validate-wizard').bootstrapWizard('first');                    
    jQuery("#md-messages").modal("show");
    
  }  
  
  function edit_job(type){ 
    setloader();
    //fill all fields
    //var id_val = type.id;
    //alert(jobsmid);
    var id_val = $('.edit-button').attr('id');
    var datastring = $('#md-messages').serialize();
    //alert(id_val) ;
    
    $.ajax({
            type: "POST",
            url:  admin_url+"job/ajax/job_manage.php?action=edit_job&jobsmid="+jobsmid+"&id="+id_val,
            data: datastring,
            async: false,
            success: function(data)
            {    
                 unloading(); 
                 //alert(data);
                 var new_data = $.parseJSON(data);
                 console.log(new_data);
                 //alert(new_data['job_data']['data'][0]['id']);
                 var jobid = new_data['job_data']['data'][0]['id'];
                 $('input#jobid').val(new_data['job_data']['data'][0]['id']);
                 $('input#jobtitle').val(new_data['job_data']['data'][0]['title']);
                 $('#description').val(new_data['job_data']['data'][0]['description']);
                 $('#jobcategory').val(new_data['job_data']['data'][0]['jobcategory']);
                 $('#jobtype').val(new_data['job_data']['data'][0]['type']);
                 $('#jobpriority').val(new_data['job_data']['data'][0]['priority']);
               
                 // $('#jobduration').val(new_data['job_data']['data'][0]['expectedEndTime']);
                 // $('#jobcategory').html('<option value="'+ new_data['data'][0]['jobcategory'] +'">' + new_data['data'][0]['jobcategory'] + '</option>'); 
                 // $('#jobtype').prepend('<option value='+new_data['data'][0]['type']+'>' + new_data['data'][0]['type'] + '</option>'); 
                 // $('#jobpriority').prepend('<option value='+new_data['data'][0]['priority']+'>' + new_data['data'][0]['priority'] + '</option>'); 
                 // $('.bootstrap-tagsinput').text(new_data['job_data']['data'][0]['meta_job-assogned']);
                 // $('#jobassogned').tagsinput('add', { id: 'tag id', label: new_data['job_data']['data'][0]['meta_job-assogned'] });
                 // $('#jobassogned').addTag('foo');
                 // $("#jobassogned").destroyTagsInput();
                 // $('#jobassogned').importTags('foo,bar,baz');
                 //$('#jobassogned').tagsinput('remove', '');
                 $('#jobassogned').tagsinput('removeAll');
                 var str = new_data['job_data']['data'][0]['meta_job_assogned'];  
                 $('#jobassogned').tagsinput('add', str);

                /*countryArray = str.split(',');
                 var span ="";
                  for (var i = 0; i < countryArray.length; i++) {
                  //span +='<span class="tag label label-default">'+countryArray[i]+'<span data-role="remove"></span></span>';   
                  //alert(countryArray[i]);
                  // $('#jobassogned').value="hello";
                    }
                 // var spantag = $('.bootstrap-tagsinput').html(span);
                 //$('#jobassogned').attr('value', str);
                
                 //$('#jobassogned').val(str);
                 //var input_asssign = $('<input type="text" class="form-control parsley-validated" name="jobassogned" id="jobassogned" data-provide="typeahead" parsley-required="true" value="">').val(new_data['job_data']['data'][0]['meta_job-assogned']); 
                 //$('#assigndiv').html(input_asssign);*/
                var expectedStartTime = new Date(new_data['job_data']['data'][0]['expectedStartTime']*1000);
                var expectedStartTime =  formatDate(expectedStartTime);
                console.log(expectedStartTime);
                var expectedEndTime = new Date(new_data['job_data']['data'][0]['expectedEndTime']*1000);
                var expectedEndTime =  formatDate(expectedEndTime);
                console.log(expectedEndTime);
                /*var hours = Math.floor( new_data['job_data']['data'][0]['duration'] / 60);          
                var minutes = new_data['job_data']['data'][0]['duration'] % 60; 
                if(hours!="0")
                {
                   var jobduration = hours+':'+minutes+'0';
                }
                else
                {
                   var jobduration = hours+':'+minutes;
                }
                console.log(jobduration);*/
                 
                 $('#jobduration_date').val(expectedStartTime);
                 $('#jobduration_end').val(expectedEndTime);
                 $('#jobduration').val(new_data['job_data']['data'][0]['duration']);
                 // $('#jobduration').prepend('<option value='+new_data['data'][0]['expectedEndTime']+'>' + new_data['data'][0]['expectedEndTime'] + '</option>'); 
                 var editValue = { track: new_data['job_data']['data'][0]['meta_track']  };
                 $('[name=track]').val([editValue.track]);
                 //$('#track').val(new_data['job_data']['data'][0]['meta_track']);
                 //console.log(new_data['job_data']['data'][0]['meta_track']);
                 if(new_data['job_data']['data'][0]['meta_track']=="On")
                 {
                     $('#trackhrs').val(new_data['job_data']['data'][0]['meta_trackhrs']);
                     $('#trackmins').val(new_data['job_data']['data'][0]['meta_trackmins']);
                 }
                 else
                 {
                     $('#trackhrs').removeClass('validate-wizard');
                     $("#trackhrs").prop('disabled', true); 
                     $('#trackmins').removeClass('validate-wizard');
                     $("#trackmins").prop('disabled', true);    
                 }
                 $('#job_customer_name').val(new_data['job_data']['data'][0]['meta_job_customer_name']);
                 $('#job_contact_no').val(new_data['job_data']['data'][0]['meta_job_contactno']);
                 $('#job_address').val(new_data['job_data']['data'][0]['meta_job_address']);
                 $('#job_address_lat').val(new_data['job_data']['data'][0]['meta_job_address_lat']);
                 $('#job_address_long').val(new_data['job_data']['data'][0]['meta_job_address_long']);

                 $('#horizontal-navtab a:first').tab('show');
                 var _href = $("a#prview_tracking").attr("href");
                 $("a#prview_tracking").attr("href", _href + '&iid='+jobid);
                 //$('#prview_tracking').find('a').attr('href').append(jobid);
                 
                 $('#prview_feedback').html('');
                 $('#feedback_badge').html('');
                 if(new_data['job_media']['data']!=undefined)
                 {

                     var countfeedback = 1;
                     for(var i=0;i<new_data['job_media']['data'].length;i++)
                     {
                             if(new_data['job_media']['data'][i]['type']=="note")
                             { 
                                $('#note').val(new_data['job_media']['data'][i]['note']);
                             }   
                             if(new_data['job_media']['data'][i]['type']=="feedback")
                             { 
                                //var mediatype = new_data['job_media']['data'][i]['type'];
                               
                                var mediaid = new_data['job_media']['data'][i]['id'];
                                var img_src = site_url+'uploads/media/images/txt.png';  
                                var img = $('<img width="75px" height="75px">').attr('src',img_src );

                                //var input_value = $('<input type="hidden" name="feedback" class="feedback" id="'+mediaid+'">').val(mediaid); 
                                //var job_value = $('<input type="hidden" name="jobid" class="jobid" id="'+mediaid+'">').val(jobid); 
                                var url = admin_url+'/survey/survey_view.php?id='+mediaid+'&jobid='+jobid;
                                var anchor = $('<a target="_blank" href="'+url+'">').html(img);
                                var div = $('<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 100px;">');
                                div.append(anchor);
                                //div.append(input_value);
                                var span = $('<span>'+countfeedback+'');
                                var parentdiv = $('<div id="'+i+'" style="margin-bottom:10px;" class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer;">').append(div);
                                //parentdiv.append(span);
                                $('#prview_feedback').prepend(parentdiv);
                                $('#feedback_badge').html(countfeedback);
                                countfeedback++;
                             }
                     }
                 }

                 $('#prview_tracking').html('');
                 $('#tracking_badge').html('');
                  if(new_data['job_tracking']['data']!=undefined)
                 {

                         var counttracking = 1;
                         for(var i=0;i<new_data['job_tracking']['data'].length;i++)
                         {
                                 if(new_data['job_tracking']['data'][i]['action']=="tracking_start")
                                 { 
                                    //var mediatype = new_data['job_media']['data'][i]['type'];
                                   
                                    var userId = new_data['job_tracking']['data'][i]['userId'];
                                    var img_src = site_url+'uploads/media/images/Apps-Google-Maps-icon.png';  
                                    var img = $('<img width="75px" height="75px">').attr('src',img_src );

                                    //var input_value = $('<input type="hidden" name="feedback" class="feedback" id="'+mediaid+'">').val(mediaid); 
                                    //var job_value = $('<input type="hidden" name="jobid" class="jobid" id="'+mediaid+'">').val(jobid); 
                                    var url = admin_url+'/map/track.php?amid=5&asmid=1&aiid='+jobid+'&userid='+userId;
                                    var anchor = $('<a target="_blank" href="'+url+'">').html(img);
                                    var div = $('<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 100px;">');
                                    div.append(anchor);
                                    //div.append(input_value);
                                    var span = $('<span>'+counttracking+'');
                                    var parentdiv = $('<div id="'+i+'" style="margin-bottom:10px;" class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer;">').append(div);
                                    //parentdiv.append(span);
                                    $('#prview_tracking').prepend(parentdiv);
                                    $('#tracking_badge').html(counttracking);
                                    counttracking++;
                                 }
                         }
                 }  
                 /*if(new_data['job_media']['data'][0]){
                 $('#note').val(new_data['job_media']['data'][0]['note']);
                 $('#note_one').val(new_data['job_media']['data'][0]['note']);
                 }
                 
                 for(var i=0;i<new_data['job_media']['data'].length;i++)
                 { 
                  if(new_data['job_media']['data'][i]['note']==""){
                 $('#note').val(new_data['job_media']['data'][i]['note']);
                 }}  */ 
                 /*if(signature!='')
                  {$('#signature').html(signature); }
                 else{signature=$('#signature').html();}
                 
                  if(prview_pdf!='')
                  {$('#prview_pdf').html(prview_pdf); }
                 else{signature=$('#prview_pdf').html();}
                 
                  if(prview_doc!='')
                 {$('#prview_doc').html(prview_doc); }
                 else{signature=$('#prview_doc').html();}
                 
                  if(prview_audio!='')
                  {$('#prview_audio').html(prview_audio); }
                 else{signature=$('#prview_audio').html();}
                 
                  if(prview_video!='')
                 {$('#prview_video').html(prview_video); }
                 else{signature=$('#prview_video').html();}*/
                 //alert(new_data['edit_media']['data']);
                 $('.thumbnail').html('');
                 $('#signature').html('');
                 $('#signature_one').html('');
                 $('#signature_badge').html('');
                 $('#prview_pdf').html('');
                 $('#prview_pdf_one').html('');
                 $('#pdf_badge').html('');
                 $('#prview_doc').html('');
                 $('#prview_doc_one').html('');
                 $('#doc_badge').html('');
                 $('#prview_audio').html('');
                 $('#prview_audio_one').html('');
                 $('#audio_badge').html('');
                 $('#prview_video').html('');
                 $('#prview_video_one').html('');
                 $('#video_badge').html('');
                 //$('#attopener').html('<i style="color:#f35958; font-size:18px;" class="fa fa-paperclip"></i>'+new_data['edit_media']['data'].length);
                 
                 var countsign = 1;
                 var countpdf = 1;
                 var countdoc = 1;
                 var countaudio = 1;
                 var countvideo = 1;
                 
                 if(new_data['edit_media']['data']!=undefined)
                 {
                         for(var i=0;i<new_data['edit_media']['data'].length;i++)
                         {   
                                 //alert(new_data['edit_media']['data'][i]['mediaName']);  
                                 //var ext = new_data['edit_media']['data'][i]['extension'];
                                 var medianame = new_data['edit_media']['data'][i]['mediaName'];
                                 var ext = medianame.split('.').pop(); 
                                 var mediatype = new_data['edit_media']['data'][i]['mediaType'];
                                 var mediaid = new_data['edit_media']['data'][i]['id'];
                                 if(mediatype=="image")
                                 {
                                 var img_src = site_url+'uploads/media/'+mediatype+'s/'+medianame;   
                                 }
                                 else if(mediatype=="audio")
                                 {
                                 var img_src = site_url+'uploads/media/'+mediatype+'s/audiolr.png'; 
                                 }
                                 else if(mediatype=="video")
                                 {
                                 var img_src = site_url+'uploads/media/'+mediatype+'s/'+medianame;   
                                 }
                                 else{
                                 var img_src = site_url+'uploads/media/'+mediatype+'/pdfimage.png';
                                 }
                                 var img = $('<img width="75px" height="75px">').attr('src',img_src );
                                 var input_value = $('<input type="hidden" class="media" id="'+mediaid+'">').val(mediaid); 

                                 if(ext=="png"){ 
                                 var div = $('<div class="fileinput-preview thumbnail sign_bg" data-trigger="fileinput" style="width: 150px; height: 100px;">');
                                 }
                                 else
                                 {
                                 var div = $('<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 100px;">');  
                                 }   
                                 div.append(img);
                                 div.append(input_value);
                                 var span = $('<a href="#" id="'+mediaid+'" class="btn btn-default fileinput-exists" data-dismiss="fileinput" onclick="$(this).parent().remove();getmediaid(this);">Remove</a>');
                                 var parentdiv = $('<div id="'+i+'" style="margin-bottom:10px;" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">').append(div);
                                 parentdiv.append(span);     
                                 
                                   
                                 if(ext=="png"){
                                 $('#signature,#signature_one').prepend(parentdiv);
                                 $('#signature_badge,#signature_badge_one').html(countsign);
                                 countsign++;
                                 }
                                 if(ext=="pdf" ||  ext=="x-pdf" || ext=="acrobat" || ext=="vnd.pdf" || ext=="x-bzpdf" || ext=="x-gzpdf"){
                                 $('#prview_pdf,#prview_pdf_one').prepend(parentdiv);
                                 $('#pdf_badge,#pdf_badge_one').html(countpdf);
                                 countpdf++;
                                 }
                                 if(ext=="doc" ||  ext=="docx" || ext=="dot" || ext=="docm" || ext=="dotx" ||  ext=="jpeg" || ext=="jpg"){
                                 $('#prview_doc,#prview_doc_one').prepend(parentdiv);
                                 $('#doc_badge,#doc_badge_one').html(countdoc);
                                 countdoc++;
                                 }
                                 if(ext=="aac" ||  ext=="wav" || ext=="mp3" || ext=="amr" || ext=="m4p"){

                                 $('#prview_audio,#prview_audio_one').prepend(parentdiv);
                                 $('#audio_badge,#audio_badge_one').html(countaudio);
                                 countaudio++;
                                 }
                                 if(ext=="3gp" ||  ext=="avi" || ext=="flv" || ext=="mp4" || ext=="mpeg"){
                                 $('#prview_video,prview_video_one').prepend(parentdiv);
                                 $('#video_badge,#video_badge_one').html(countvideo);
                                 countvideo++;
                                 }
                        
                         
                         }
                 }
                $('#validate-wizard').bootstrapWizard('first');
                jQuery("#md-messages").modal("show");
            }
            
        });
 
  } 
  
  var definejob="";
  function getdetailjob(idss){
          setloader();
          definejob=idss; 
         //var ele_id = element;
         //var ele_val = $('#jobstatus').val();
          //console.log($('.mlist').attr('id'));


         var datastring ="id="+idss+"&jobsmid="+jobsmid;
         //alert(datastring);     
         
       $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=getdetail",
              type:"post",
              data: datastring,
              success:function(suc)
                {   
                 unloading(); 
                // alert(suc);
                 var job_data = $.parseJSON(suc);
                 //console.log(job_data);
                 //alert(job_data['data'][0]['id']);
                 //$("jobDetail").val(job_data['data'][0]['id']);
                 if(job_data['job_tracking']['data']!='')
                 {   
                     var status=0;
                     for(var i=0;i<job_data['job_tracking']['data'].length;i++)
                     {
                        //console.log(job_data['job_tracking']['data'][i]['action']);
                         if(job_data['job_tracking']['data'][i]['action']=='tracking_start')   
                         {
                            status=1;
                         
                         }   
                         else if(job_data['job_tracking']['data'][i]['action']=='tracking_stop')
                         {
                            status=2;
                          
                         }          
                     }
                         if(status==0)
                         {
                             $('#stoptracking').hide();
                             $('#starttracking').show(); 
                             $('#checktracking').hide();
                             
                         }
                         else if(status==1)
                         {
                             $('#starttracking').hide();
                             $('#stoptracking').show();
                             $('#checktracking').hide();
                            
                         }
                         else
                         {
                             $('#stoptracking').hide();
                             $('#starttracking').hide(); 
                             $('#checktracking').show();
                         }
                 }
                 else
                 {
                 $('#stoptracking').hide();   
                 $('#starttracking').show(); 
                 $('#checktracking').hide();   
                 } 
                 if(job_data['jobs_listing']['data']!=undefined)
                 {   //console.log(job_data['jobs_listing']['data'][0]['status']);
                     for(var i=0;i<job_data['jobs_listing']['data'][0]['status'].length;i++)
                     {
                         var userid = job_data['jobs_listing']['data'][0]['status'][i]['userid']; 
                         
                         var sepid=userid.split('~');
                         var strng=job_data['jobs_listing']['data'][0]['status'][i]['status_string'];
                         strng=strng.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
                         //console.log(sepid);
                         if(userid == get_logged_user )
                         {  
                         //console.log(job_data['jobs_listing']['data'][0]['status'][i]); 
                         $("#status_result").html(strng);
                         }
                         else
                         {
                         $("#status_result").html(strng);   
                         }
                     }
                

                 $("#jobtitles").html(job_data['jobs_listing']['data'][0]['title']);
                 $("#jobids").html('#'+job_data['jobs_listing']['data'][0]['id']);
                 $('.jobstatuss').attr('id', job_data['jobs_listing']['data'][0]['id']);
                 var date = new Date(job_data['jobs_listing']['data'][0]['time']*1000);
                 var new_date =  formatDate(date);
                 //alert(new_date);
                 // var newDate = date.format("y-m-d ,H:i:s"); // apply date format 
                 $("#jobtimes").html(','+new_date);
                 $("#jobdescriptions").html(job_data['jobs_listing']['data'][0]['description']);
                 $("#jobassigns").html(job_data['jobs_listing']['data'][0]['meta_job_assogned']);
                

                 
                // var sepids=useridss.split('~');
                var str = job_data['jobs_listing']['data'][0]['meta_job_assogned']; 
                countryArray = str.split(',');
                var option ='';

                  for (var i = 0; i < countryArray.length; i++) {
                     if(job_data['jobs_listing']['data'][0]['status'][i]!=undefined)
                 {
                  var useridss = job_data['jobs_listing']['data'][0]['status'][i]['userid'];   

               option +='<li><a href="#" onclick="userstatuschange(this);" data-id="'+useridss+'" id="'+job_data['jobs_listing']['data'][0]['id']+'" class=""><input type="hidden" name="jobassignuserstatus" id="jobassignuserstatus" class="form-control" value="'+useridss+'"/>'+countryArray[i]+'</a></li>'; 
                     }
                    }
                 $("#assign_status").html(option);


                 $("#jobcreatebys").html(job_data['jobs_listing']['data'][0]['meta_job_customer_name']);
                 $("#jobcreateons").html(new_date);
                 $('.edit-button').attr('id', job_data['jobs_listing']['data'][0]['id']);
                 $('.delete-button').attr('data-id', job_data['jobs_listing']['data'][0]['id']);
                 

                 $("#jobid").val(job_data['jobs_listing']['data'][0]['id']);
                 $('#commentjobid').attr('data-id', job_data['jobs_listing']['data'][0]['id']);
                 $('#starttracking').attr('data-id',job_data['jobs_listing']['data'][0]['id']);
                 $('#stoptracking').attr('data-id',job_data['jobs_listing']['data'][0]['id']);
                }
                }
                });  
                 $("#job").hide();
                  $('.mlist').click(function() {
                   var funname=$(this).attr('id');
                    //console.log(funname);
                    if(funname=='myjoblist'){
                    $('#assignjoblist').hide();
                    }
                  });
                 jQuery("#jobDetail").show();
   
     }
  
   function getjobcomment(idss){

         
         // var ele_id = element;
         //var ele_val = $('#jobstatus').val();
          
         var datastring ="id="+idss+"&jobsmid="+jobsmid;
         //setloader();
         //alert(datastring);     
         $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=getcomment",
              type:"post",
              data: datastring,
              success:function(response)
                {
                 //alert(response);
                 //unloading(); 
                 var commnet_data = $.parseJSON(response);
                 //$.parseJSON(suc);
                 //alert($.parseJSON(response));
                 var div = '';
                 
                 
                 //var admin_assets_url = site_url;
                 if(commnet_data['job_comment']['data']!=undefined)
                 {
                     for(var i=0;i<commnet_data['job_comment']['data'].length;i++)
                     { 

                      var date = new Date(commnet_data['job_comment']['data'][i]['datetime']['sec']*1000);
                      var new_date =  formatDate(date);
                      div +='<div class="comment" style="margin:15px 0;">\
                             <img alt="" src="'+admin_assets_url+'img/avatar2.png" class="circle">\
                             <div class="comment-content">  <p class="author"><strong>"'+commnet_data['comment_user']['data'][i]['name']+'"</strong> - "'+new_date+'"</p>\
                             <span>"'+commnet_data['job_comment']['data'][i]['comment']+'"</span> </div>\
                             </div>'; 
                     }
                 }
                 $("#jobcommentcount").html(commnet_data['job_comment']['data'].length)                 
                 $("#jobcommentdetail").html(div);
                }

                });  
   
     }

 /*function getfavorites(id){
     
        var datastring="id="+id+"&jobsmid="+jobsmid;
        //.alert(datastring);     
        $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=getfavourite",
              type:"post",
              data: datastring,
              async:false,
              success:function(suc)
                {
                //console.log(suc);
                return suc;
                }
        });

   }      */  

 function makefavourite(id){
         
         // var funnamee=$(this).class();
         var datastring="id="+id+"&jobsmid="+jobsmid;
       //  console.log(funnamee); 
       $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=favourite",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                //alert(suc);
                }
        });
       $('.mlist').click(function() {
          var funname=$(this).attr('id');
             if(funname=="assignjoblist"){
                ///assignjobslist();
             }
             else{
                // myjobs();   
             }
        });
   }     

 function userstatuschange(ele){
        
        var jobid = $(ele).attr('id');
        var id = $(ele).attr('data-id');
        //var id = $('#jobassignuserstatus').val();
        var datastring="jobid="+jobid+"&jobsmid="+jobsmid;
        //alert(id);     
        $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=statuschangebyuser1",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                  //alert(suc);
                var status_data = $.parseJSON(suc);
                //console.log(status_data);

                var status=status_data['data'][0]['status'];
                $.each(status,function(key,val){
                  if(id==val['userid'])
                  {
                  //console.log(key,val);
                  $('#status_result').html(val['status_string']);
                  $('#jobstatus').val(val['status']);
                  }
                });
              
                }
        });
   }     


  function getmediaid(element){
     
      var mediaids=element.id;
        
      var datastring="id="+mediaids;
         //alert(datastring);     
        $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=remove_media",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                //alert(suc);
                }
        }); 


     /* var parent = element.parentNode;
      alert(mediaids);
      var content = parent.querySelector("input");
      var values = content.value;
      values = values+"|";
      //alert(values);*/
     }

   function enabletracking(){
 
   $('#trackhrs').addClass('validate-wizard');
   $("#trackhrs").prop('disabled', false); 
   $('#trackmins').addClass('validate-wizard');
   $("#trackmins").prop('disabled', false); 
  }      

  function disabletracking(){
 
   $('#trackhrs').removeClass('validate-wizard');
   $("#trackhrs").prop('disabled', true);
   $('#trackhrs').val(''); 
   $('#trackmins').removeClass('validate-wizard');
   $("#trackmins").prop('disabled', true);
   $('#trackmins').val(''); 
  }   
  
  function strtrack(ele){
     
      var id = $(ele).attr('data-id');
      var datastring="id="+id+"&jobsmid="+jobsmid;

     // $('.starttracking').hide();
     // $('.stoptracking').show();
         //alert(datastring);     
        $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=starttracking",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                 //alert(suc);
                             $('#starttracking').hide();
                             $('#stoptracking').show();
                             $('#checktracking').hide();
                }
        });
    }

    function stoptrack(ele){
     
      var id = $(ele).attr('data-id');
      var datastring="id="+id+"&jobsmid="+jobsmid;
       //$('.stoptracking').hide();
       //$('.starttracking').show();
         //alert(datastring);     
        $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=stoptracking",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                //alert(suc);
                             $('#stoptracking').hide();
                             $('#starttracking').hide(); 
                             $('#checktracking').show();
                }
        });
    }


   function change_status(element,idss){

         var ele_id = $('.jobstatuss').attr('id');
         if(idss==2)
         {
           if(survey_form!="")
           {

            $("body").append("<a href='"+survey_form+definejob+"' target='_blank' id='temp_link'><span id='tmp_span'>asd</span></a>");
            //console.log($("#temp_link"));
            $("#tmp_span").click();
            
            $("#temp_link").remove();
            //alert(survey_form);
           }
         }
         var datastring ="id="+ele_id+"&jobstatus="+idss;
         //alert(datastring);     
        $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=update_status",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                // alert(suc);
                }
                });  
   
     }


function filterbystatus(element){

var filterid = element ;
    if(filterid==0)
    {
        filterid=4;
    }
    else if(filterid==1)
    {
        filterid=0;
    }
    else if(filterid==2)
    {
        filterid=5;
    }
    else
    {
        filterid=6;
    }


$('.mlist.active .lilist').each(function(){

 var searchstatus = $(this).find(".statusjob").val();
  console.log(searchstatus);
 if(filterid == searchstatus||filterid==6){
        $(this).show();
    } 
    else {
        $(this).hide();
    }

});

}


function DateCheck()
{  

     /* $("#due_date").datetimepicker({
          
          numberOfMonths: 1,
          onSelect: function (selected) {
              var dt = new Date(selected);
              

              dt.setDate(dt.getDate() + 1);
              $("#due_date2").datetimepicker("option", "minDate", dt);
          }
      });

      $("#due_date2").datetimepicker({
          numberOfMonths: 1,
          onSelect: function (selected) {
              var dt = new Date(selected);
              dt.setDate(dt.getDate() - 1);
              $("#due_date").datetimepicker("option", "maxDate", dt);
          }
      });



      var startDate;
         $("#due_date").datetimepicker({
                     timepicker:true,
                     closeOnDateSelect:false,
                     closeOnTimeSelect: true,
                     initTime: true,
                     format: 'd-m-Y H:m',
                     minDate: 0,
                     roundTime: 'ceil',
                     onChangeDateTime: function(dp,$input){
                               startDate = $("#due_date").val();
                                                           }
                                                           });
        $("#due_date2").datetimepicker({
                     timepicker:true,
                     closeOnDateSelect:false,
                     closeOnTimeSelect: true,
                     initTime: true,
                     format: 'd-m-Y H:m',
                     onClose: function(current_time, $input){
                            var endDate = $("#due_date2").val();
                            if(startDate>endDate){
                                   alert('Please select correct date');
                             }
             }
              }); 

   
  var StartDate= document.getElementById('jobduration_date').value;
  var EndDate= document.getElementById('jobduration_end').value;
  var eDate = new Date(EndDate);
  var sDate = new Date(StartDate);
  if(StartDate!= '' && StartDate!= '' && sDate> eDate)
    {
    alert("Please ensure that the End Date is not less than or equal to the Start Date.");
    return false;
    $('.input-group date').html('');
    //$('#due_date2').html('');
    }*/
}

 /*function assignjobs()
 {
   $('#myjoblist').hide();
   $('#assignjoblist').show();
   $("#job").show();
   $("#jobDetail").hide();
   

 }        
*/

jQuery(document).ready(function($){
    
      $("#trackhrs").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
      {
        //display error message
        $("#etrackhrs").html("Please Enter Digits Only").show().fadeOut("slow");
        return false;
      }
   });

    $("#trackmins").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
      {
        //display error message
        $("#etrackmins").html("Please Enter Digits Only").show().fadeOut("slow");
        return false;
      }
   });
  

    $("#job_customer_name").keypress(function (e){
     var code =e.keyCode || e.which;
       if(code != 8 && code != 32 && code != 0 && (code<65 || code>90) &&(code<97 || code>122) && code!=32 && code!=46 )  
      {
       $("#ejob_customer_name").html("Please Enter Character Only").show().fadeOut("slow");
       return false;
      }
    });

    $("#job_contact_no").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
      {
        //display error message
        $("#ejob_contact_no").html("Please Enter Digits Only").show().fadeOut("slow");
        return false;
      }
   });

   $('.jobactive').click(function(){
    $('.jobactive').removeClass("active");
    $(this).addClass("active");
   });

     
    $("#addcommment").submit(function(e){
        e.preventDefault();
    })


});


function searchtext()
{


$('.mlist.active .lilist').each(function(){
        console.log($(this).attr('data-search-term', $(this).text().toLowerCase()));
       $(this).attr('data-search-term', $(this).text().toLowerCase());
    });

    $('.live-search-box').on('keyup', function(){

    var searchTerm = $(this).val().toLowerCase();
        
        $('.mlist.active .lilist').each(function(){
        
            
            if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                 console.log(($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) );
                $(this).show();
            } else {
                $(this).hide();
            }

        });

    });

}

function confirmDelete(id)
   {
    


    var  id=$('#delete-button').attr('data-id');
     //alert(id);
     //var id = $('.delete-button').attr('id');
     var datastring ="id="+id;
    // var com = confirm("Are you sure to delete this ?");
    
        
           
    $.ajax({
          url: admin_url+"job/ajax/job_manage.php?action=delete_job",
          type:"post",
          data: datastring,
            success:function(suc)
            {
                
                if(suc=='0')
                {   
                   // $("#model_head").html(ui_string['unsuccess']);
                  //  $("#model_des").html(ui_string['blog_not_success']);
                  //  $('#success_modal').modal();
                    setTimeout(function(){ window.location=admin_url+"job/job.php?job="+jobsmid; },1000);
                }
                else
                {
                   // $("#model_head").html(ui_string['success']);
                   // $("#model_des").html(ui_string['blog_success']);
                   // $('#success_modal').modal();
                    setTimeout(function(){ window.location=admin_url+"job/job.php?job="+jobsmid; },1000);
                }
            }
            });  
              
}


function confirm()
{
    $("#sure_to_delete").modal('show');
}


 function advance_search_byname(){
                
         var chkurl=$('.mlist.active').attr('id');
         var ele_val = $('#jobname').val();
         var datastring ="value="+ele_val+"&jobsmid="+jobsmid;
         //alert(datastring);     
         $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=searchbyname",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                unloading();
                var setting_file=new Array();
    
                setting_file['media_file']=1;
                countter++;
                var poritys=1;
                var priority_active="";
                var loops=0;
                var media_setting="";
                var json=JSON.parse(suc);
                 //console.log(suc);
                var lengthof=json['detailjob']['data'].length;

                var ui_value="";
                if(json['detailjob']['data']!=undefined)
                 {
                for (loops=0;loops<lengthof;loops++)
                {
                    var id= json['detailjob']['data'][loops]['id'];
                    //json['data'][loops]['associated_data'];
                    //json['data'][loops]['associated_data'][0]['location'][1];
                    var date = new Date(json['detailjob']['data'][loops]['time']*1000);
                    var new_date =  formatDate(date);
                    var lng=json['detailjob']['data'][loops]['meta_job_address_long'];
                    var lat=json['detailjob']['data'][loops]['meta_job_address_lat'];
                    var title=json['detailjob']['data'][loops]['title'];
                    var address=json['detailjob']['data'][loops]['meta_job_address'];
                    var desc=json['detailjob']['data'][loops]['description']
                    //console.log(json['data'][loops]['priority']);

                    //var favour=getfavorites(id);
                    var favor=json['fav'][loops]['val'];
                    if(favor==poritys)
                     {
                        priority_active="active";
                     }
                     else
                     {
                        priority_active="";
                     }
                     if(setting_file['media_file']!=0)
                     {
                        media_setting="fa-paperclip";
                     }
                    var class_status="";
                    
                    var userstatus=json['detailjob']['data'][loops]['status'][0]['status'];                 
                    var status=json['detailjob']['data'][loops]['status'][0]['status'];  
                    //console.log(status);
                    if(status==4)
                    {
                    status=0;
                    }
                    else if(status==0)
                    {
                    status=1;
                    }
                    else
                    {
                    status=2;
                    }
                    for(var seting_status=0;seting_status <setting_array.length;seting_status++)
                    {   
                       if(status==seting_status)
                        {
                         class_status=setting_array[seting_status];
                        }
                    }
                    if(class_status=="New"){
                      active="new_col active";
                    }
                    else if (class_status=="Pending") {
                      active="panding_col active";
                    }
                    else{
                      active="approve_col active";
                    }
                     
                     ui_value+='<li id="'+id+'" class="lilist" ><div class="iCheck"  data-style="minimal"  data-color="red"><input type="checkbox"></div><a href="#" class="mail-favourite '+priority_active+'" onclick="makefavourite('+id+');"><i class="glyphicon glyphicon-star"></i></a> <span><h5><a href="#" onclick="getdetailjob('+id+'),getjobcomment('+id+')">'+title+'</a></h5><p><strong>'+ desc.substr(0,20)+'</strong> ,'+ desc.substr(0,20)+'</p><time>'+new_date+'</time><label class="'+active+'" data-color="'+class_status+'"></label><input type="hidden" class="statusjob" name="statusjob" id="statusjob'+userstatus+'" value="'+userstatus+'"/><div class="mail-tools"></div></span></li>';
                     //alert(ui_value);
                     add_marker(id,lat,lng,title,address);
                   
                }
                }
                $("#job").show();
                $("#jobDetail").hide();
                $("#md-advance-search").modal('hide');
                
                if(chkurl=="assignjoblist"){
                     $('#assignjoblist').html(ui_value);
                     $('#assignjoblist').show();
                     $('#myjoblist').hide();
                     $('#userjoblist').hide();
                     $('#assignjoblist').addClass("active");
                     $('#userjoblist').removeClass("active");
                     $('#myjoblist').removeClass("active");
                }
                else if(chkurl=="myjoblist"){
                    $('#myjoblist').html(ui_value);
                    $('#myjoblist').show();
                    $('#assignjoblist').hide();
                    $('#userjoblist').hide();
                    $('#myjoblist').addClass("active");
                    $('#assignjoblist').removeClass("active");
                    $('#userjoblist').removeClass("active");
                }
                else{
                    $('#userjoblist').html(ui_value);
                    $('#userjoblist').show();
                    $('#assignjoblist').hide();
                    $('#myjoblist').hide();
                    $('#userjoblist').addClass("active");
                    $('#assignjoblist').removeClass("active");
                    $('#myjoblist').removeClass("active");
                } 
                }
                });  
                 
   
     }


 function advance_search_bydate(){

         var chkurl=$('.mlist.active').attr('id');
         var startdate = $('#startdate').val();
         var enddate = $('#enddate').val();  
         var datastring ="value1="+startdate+"&value2="+enddate+"&jobsmid="+jobsmid;
           
         $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=searchbydate",
              type:"post",
              data: datastring,
              success:function(suc)
                {
               unloading();
                var setting_file=new Array();
    
                setting_file['media_file']=1;
                countter++;
                var poritys=1;
                var priority_active="";
                var loops=0;
                var media_setting="";
                var json=JSON.parse(suc);
                 //console.log(suc);
                var lengthof=json['detailjob']['data'].length;

                var ui_value="";
                if(json['detailjob']['data']!=undefined)
                 {
                for (loops=0;loops<lengthof;loops++)
                {
                    var id= json['detailjob']['data'][loops]['id'];
                    //json['data'][loops]['associated_data'];
                    //json['data'][loops]['associated_data'][0]['location'][1];
                    var date = new Date(json['detailjob']['data'][loops]['time']*1000);
                    var new_date =  formatDate(date);
                    var lng=json['detailjob']['data'][loops]['meta_job_address_long'];
                    var lat=json['detailjob']['data'][loops]['meta_job_address_lat'];
                    var title=json['detailjob']['data'][loops]['title'];
                    var address=json['detailjob']['data'][loops]['meta_job_address'];
                    var desc=json['detailjob']['data'][loops]['description']
                    //console.log(json['data'][loops]['priority']);

                    //var favour=getfavorites(id);
                    var favor=json['fav'][loops]['val'];
                    if(favor==poritys)
                     {
                        priority_active="active";
                     }
                     else
                     {
                        priority_active="";
                     }
                     if(setting_file['media_file']!=0)
                     {
                        media_setting="fa-paperclip";
                     }
                    var class_status="";
                    
                    var userstatus=json['detailjob']['data'][loops]['status'][0]['status'];
                    var status=json['detailjob']['data'][loops]['status'][0]['status'];  
                    //console.log(status);
                    if(status==4)
                    {
                    status=0;
                    }
                    else if(status==0)
                    {
                    status=1;
                    }
                    else
                    {
                    status=2;
                    }
                    for(var seting_status=0;seting_status <setting_array.length;seting_status++)
                    {   
                       if(status==seting_status)
                        {
                         class_status=setting_array[seting_status];
                        }
                    }
                    if(class_status=="New"){
                      active="new_col active";
                    }
                    else if (class_status=="Pending") {
                      active="panding_col active";
                    }
                    else{
                      active="approve_col active";
                    }
                     
                     ui_value+='<li id="'+id+'" class="lilist" ><div class="iCheck"  data-style="minimal"  data-color="red"><input type="checkbox"></div><a href="#" class="mail-favourite '+priority_active+'" onclick="makefavourite('+id+');"><i class="glyphicon glyphicon-star"></i></a> <span><h5><a href="#" onclick="getdetailjob('+id+'),getjobcomment('+id+')">'+title+'</a></h5><p><strong>'+ desc.substr(0,20)+'</strong> ,'+ desc.substr(0,20)+'</p><time>'+new_date+'</time><label class="'+active+'" data-color="'+class_status+'"></label><input type="hidden" class="statusjob" name="statusjob" id="statusjob'+userstatus+'" value="'+userstatus+'"/><div class="mail-tools"></div></span></li>';
                     //alert(ui_value);
                     add_marker(id,lat,lng,title,address);
                   
                }
                }
                $("#job").show();
                $("#jobDetail").hide();
                $("#md-advance-search").modal('hide');
                
                if(chkurl=="assignjoblist"){
                     $('#assignjoblist').html(ui_value);
                     $('#assignjoblist').show();
                     $('#myjoblist').hide();
                     $('#userjoblist').hide();
                     $('#assignjoblist').addClass("active");
                     $('#userjoblist').removeClass("active");
                     $('#myjoblist').removeClass("active");
                }
                else if(chkurl=="myjoblist"){
                    $('#myjoblist').html(ui_value);
                    $('#myjoblist').show();
                    $('#assignjoblist').hide();
                    $('#userjoblist').hide();
                    $('#myjoblist').addClass("active");
                    $('#assignjoblist').removeClass("active");
                    $('#userjoblist').removeClass("active");
                }
                else{
                    $('#userjoblist').html(ui_value);
                    $('#userjoblist').show();
                    $('#assignjoblist').hide();
                    $('#myjoblist').hide();
                    $('#userjoblist').addClass("active");
                    $('#assignjoblist').removeClass("active");
                    $('#myjoblist').removeClass("active");
                } 
                }
                });  
     }



   function commentjob(id)
    {


          var  id=$('#commentjobid').attr('data-id');
      
        var formData = new FormData($('#addcommment')[0]);
        //alert(formData);
   
       $.ajax({
                    type: "POST",
                    url:  admin_url+"job/ajax/job_manage.php?action=comment_job&jobsmid="+jobsmid,
                    data: formData,
                    async: false,
                    success: function(data) 
                    {
                     // alert(data);
                     //alert("Your comment submitted successfully");
                     getjobcomment(id);
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    error: function(){
                          alert('error handing here');
                    }
        });  
                
    $("#addcommment")[0].reset();
            
       
       
    }


/*   function cmntjob(id){

         
         //var ele_id = element;
         var message = $("#cmnttxt"+id).val();
         var attachmnt = $("#attachmnt"+id).val();
        
         var datastring ="id="+id+"&message="+message+"&attachmnt="+attachmnt;
          alert(datastring);     
         $.ajax({
              url: admin_url+"job/ajax/job_manage.php?action=comment_jobsss",
              type:"post",
              data: datastring,
              success:function(suc)
                {
                 alert(suc);
                }
                });  
   
     }
*/