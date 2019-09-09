
<style type="text/css">
  .videoThumbs{
    float: left;
    padding:2px;
    border:1px solid;
  }

  .disableField{
    pointer-events: none;
  }

  .button{
      display: inline-block;
      vertical-align: middle;
      margin: 0px 5px;
      padding: 5px 12px;
      cursor: pointer;
      outline: none;
      font-size: 13px;
      text-decoration: none !important;
      text-align: center;
      color:#fff;
      background-color: #4D90FE;
      background-image: linear-gradient(top,#4D90FE, #4787ED);
      background-image: -ms-linear-gradient(top,#4D90FE, #4787ED);
      background-image: -o-linear-gradient(top,#4D90FE, #4787ED);
      background-image: linear-gradient(top,#4D90FE, #4787ED);
      border: 1px solid #4787ED;
      box-shadow: 0 1px 3px #BFBFBF;
    }
    a.button{
      color: #fff;
    }
    .button:hover{
      box-shadow: inset 0px 1px 1px #8C8C8C;
    }
    .button.disabled{
      box-shadow:none;
      opacity:0.7;
    }
    .audioRecorderCanvas{
      display: block;
    }
    .js-signature canvas{width:600px;}
    .moreRadioCheck{
      display: block;
      border:1px dotted;
      padding: 10px;
    }

    input[type=range] {
  -webkit-appearance: none;
  margin: 10px 0;
  width: 100%;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 1px 1px 1px #d1d4d6, 0px 0px 1px #d1d4d6;
  background: #0aa699;
  border-radius: 1.3px;
  border: 0.2px solid #010101;
}

.range-result-text{
  font-size:20px;
}

input[type=range]::-webkit-slider-thumb {
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 1px solid #000000;
  height: 36px;
  width: 16px;
  border-radius: 3px;
  background: #ffffff;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -14px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #0aa699;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 1px 1px 1px #d1d4d6, 0px 0px 1px #d1d4d6;
  background: #0aa699;
  border-radius: 1.3px;
  border: 0.2px solid #010101;
}
input[type=range]::-moz-range-thumb {
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 1px solid #000000;
  height: 36px;
  width: 16px;
  border-radius: 3px;
  background: #ffffff;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  animate: 0.2s;
  background: transparent;
  border-color: transparent;
  border-width: 16px 0;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #2a6495;
  border: 0.2px solid #010101;
  border-radius: 2.6px;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
}
input[type=range]::-ms-fill-upper {
  background: #0aa699;
  border: 0.2px solid #010101;
  border-radius: 2.6px;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
}
input[type=range]::-ms-thumb {
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 1px solid #000000;
  height: 36px;
  width: 16px;
  border-radius: 3px;
  background: #ffffff;
  cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
  background: #0aa699;
}
input[type=range]:focus::-ms-fill-upper {
  background: #0aa699;
}
</style>


<script type="text/javascript">
var currentExtentionUrl='<?php echo admin_ui_url(); ?>form/';
</script>

<script src="<?php echo admin_ui_url(); ?>form/src/recorder.js"></script>
<script src="<?php echo admin_ui_url(); ?>form/src/Fr.voice.js"></script>
<script src="<?php echo admin_ui_url(); ?>form/js/app.js"></script>
<div class="modal fade in" id="videoRecord" role="dialog" data-backdrop="static" data-width="1100" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Record Video</h4>
    </div>
    <div class="modal-body new_panel">
        <div id="container">


              <div style = "text-align:center;">
              <input type="hidden" name="deletedMedia" id="deletedMedia" value="">
              <input type="hidden" name="recordVideoId" id="recordVideoId" />
              <input type="hidden" name="recordVideoMediaId" id="recordVideoMediaId" />
                <video src="" id="recordedVideo" controls style="width: 50%;height: 397px;border:1px solid;"></video><br>
                <button class="button" id="rec" onclick="onBtnRecordClicked()">Record</button>
                <button class="button" id="pauseRes"   onclick="onPauseResumeClicked()" disabled>Pause</button>
                <button class="button" id="stop" style="display:none;" onclick="onBtnStopClicked()" donPauseResumeClickedisabled>Stop</button>
               </div>
              <a id="downloadLink" download="mediarecorder.webm" name="mediarecorder.webm" href></a>
              <p id="data" style="display:none;"></p>
              </div>
       <div style="clear:both;"></div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-default"  onclick="onBtnStopClicked()">Submit</button>
    </div>
  </div>
</div>

<div class="modal fade in" id="audioRecord" role="dialog" data-backdrop="static" data-width="" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Record Audio</h4>
    </div>
    <div class="modal-body new_panel" style="text-align: center;">
    <div id="container">  
    <canvas id="level" class="audioRecorderCanvas" height="200" style="width: 100%;"></canvas>
    <audio controls id="audio"></audio>
    <br/>
    
    <div data-type="mp3" style="">
      <p>MP3 Controls:</p>
      <input type="hidden" name="recordAudioId" id="recordAudioId" />
      <input type="hidden" name="recordAudioMediaId" id="recordAudioMediaId" />
      <a class="button disabled one" id="play">Play</a>
      <a class="button disabled one" id="pause">Pause</a>
      <a class="button recordButton" id="record">Record</a>
      <a class="button disabled one" id="download">Download</a>
      <a class="button disabled one" id="stop">Reset</a>
    </div>
    </div>
       <div style="clear:both;"></div>
    </div>
    <div class="modal-footer">
              <a class="button disabled one" id="save">Submit</a>
    </div>
  </div>
</div>

<div class="modal fade in" id="signaturePopup" role="dialog" data-backdrop="static" data-width="1100" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Signature</h4>
    </div>
    <div class="modal-body new_panel">
    <input type="hidden" id="signatureId" value="">
    <input type="hidden" id="signatureMediaId" value="">
    
        <div class="col-xs-12" style="margin-top:15px; padding:0;">
            <div class="js-signature" data-width="600" data-height="200" data-border="1px solid #1ABC9C" data-background="#16A085" data-line-color="#fff" data-auto-fit="true"></div>      
        </div>
       <div style="clear:both;"></div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-default"  onclick="addSignature()">Submit</button>
            <button type="button" class="btn btn-default"  onclick="$('.js-signature').jqSignature('clearCanvas');">Reset</button>
    </div>
  </div>
</div>

<div class="modal fade in" id="gpsPopup" role="dialog" data-backdrop="static" data-width="1100" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">GPS Location</h4>
    </div>
    <div class="modal-body new_panel">
       <div id="map" style="width:100%;height:500px"></div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo admin_ui_url(); ?>form/js/recorder.js"></script> 
<script src="<?php echo assets_url(); ?>admin/js/jq-signature.js"></script>
<script src="<?php echo admin_ui_url(); ?>form/js/bootstrap-timepicker.js"></script>

<script type="text/javascript">
  $( window ).load(function() {
   
   $('.timepicker-default').timepicker({defaultTime: '',showMeridian:false});

}); 
</script>
<script type="text/javascript">
var voiceRecordedFormData=[];
  $(document).on("click", "#save:not(.disabled)", function(){
    setloader();
    $('#audioRecord').modal('toggle');
    function upload(url,blob){
      var rFieldId=$('#recordAudioId').val();
      var rMediaId=$('#recordAudioMediaId').val();

      var thisDataId=rFieldId+"_"+rMediaId;
      var checkMi=$('#'+thisDataId).attr('data-mi'); 
      if(checkMi=='true')
      {
          $('#button_'+rFieldId+"_1").html('Record More');
          var totalFields=parseInt($('#totalFields_'+rFieldId).val());
          var itemId=totalFields+1;
          $('#totalFields_'+rFieldId).val(itemId);
          var rNewMediaId=parseInt(rMediaId)+1;
          $('#button_'+rFieldId+"_1").attr('onclick',"recordPopup('audio','"+rFieldId+"','"+rNewMediaId+"')");
          $('#files_'+rFieldId).append('<input type="hidden" class="customField hidden notValid" data-mi="true" name="'+rFieldId+'[]" id="'+rFieldId+"_"+rNewMediaId+'"/>');
      }
      else
      {
          var totalFields=1;
          $('#button_'+thisDataId).addClass('Update');
          $('#button_'+thisDataId).html('Update');

          $('#files_'+rFieldId).html('');
      }


      $('#recordAudioId').val('');
      $('#recordAudioMediaId').val('');
      var formData = new FormData();
      formData.append('file', blob);
      $.ajax({
        url: "<?php echo admin_ui_url(); ?>form/ajax/getFormFile.php",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(dt) {
          $('#'+rFieldId+"_"+rMediaId).val(dt);
          unloading();
          addAudioRecorded(url,rFieldId,dt);
        }
      });
    }
    Fr.voice.exportMP3(upload, "URL");
    restore();
  });

var audioId=1;var videoId=1;var signId=1;
function addAudioRecorded(data,rFieldId,json)
{
  audioId=$('#totalFields_'+rFieldId).val();
  var audioHtml='';
  audioHtml+='<div class="videoThumbs" id="audioData-'+audioId+'">';
      audioHtml+='<div>';
        audioHtml+='<audio controls="" style="width: 200px;" src="'+data+'"></audio>';
      audioHtml+='</div>';
      audioHtml+='<div>';
        audioHtml+='<span>Audio '+audioId+' :</span> ';
        audioHtml+='<a data-original-title="Delete" onclick="deleteRecordedAudio('+audioId+')" class="btn btn-default btn-sm right" title=""><i class="fa fa-trash-o"></i></a>';
      audioHtml+='</div>';
   audioHtml+='</div>';
  $('.audioRecordList_'+rFieldId).append(audioHtml);
  audioId++;
}
function deleteRecordedAudio(id)
{
  $('#audioData-'+id).remove();
}

function uploadVideoTmp(blob)
{
      var rFieldId=$('#recordVideoId').val();
      var rMediaId=$('#recordVideoMediaId').val();
      setloader();
      var thisDataId=rFieldId+"_"+rMediaId;
      var checkMi=$('#'+thisDataId).attr('data-mi'); 
      
      if(checkMi=='true')
      {
          $('#button_'+rFieldId+"_1").html('Record More');
          var totalFields=parseInt($('#totalFields_'+rFieldId).val());
          var itemId=totalFields+1;
          $('#totalFields_'+rFieldId).val(itemId);
          var rNewMediaId=parseInt(rMediaId)+1;
          $('#button_'+rFieldId+"_1").attr('onclick',"recordPopup('video','"+rFieldId+"','"+rNewMediaId+"')");
          $('#files_'+rFieldId).append('<input type="hidden" class="customField hidden notValid" data-mi="true" name="'+rFieldId+'[]" id="'+rFieldId+"_"+rNewMediaId+'"/>');
      }
      else
      {
          var totalFields=1;
          rMediaId=1;
          $('#button_'+thisDataId).addClass('Update');
          $('#button_'+thisDataId).html('Update');
          $('#files_'+rFieldId).html('<a id="button_id-10_1" data-original-title="record" onclick="recordPopup(\'video\',\''+rFieldId+'\',\'1\')" class="btn btn-default btn-sm" title="view">'+ui_string['update']+'</a><input type="hidden" class="customField hidden notValid" data-mi="false" name="'+rFieldId+'[]" id="'+rFieldId+"_"+rMediaId+'"/>');
          $('.videoRecordList_'+rFieldId).html('');
      }
      $('#recordVideoId').val('');
      $('#recordVideoMediaId').val('');
      var formData = new FormData();
      formData.append('file', blob);
      $.ajax({
        url: "<?php echo admin_ui_url(); ?>form/ajax/getFormFile.php",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(dt) {
          $('#'+rFieldId+"_"+rMediaId).val(dt);
          addVideoRecorded(rMediaId,rFieldId);
          unloading();
        }
      });
}

function addVideoRecorded(rFieldId,fId)
{
  $('#videoRecord').modal('toggle');
    var data=$('#recordedVideo').attr('src');
    var videoHtml='';
    videoHtml+='<div class="videoThumbs" id="videoData-'+rFieldId+'">';
        videoHtml+='<div>';
          videoHtml+='<video controls="" style="width: 200px;" src="'+data+'"></video>';
        videoHtml+='</div>';
        videoHtml+='<div>';
          videoHtml+='<span>Video '+rFieldId+' :</span> ';
          videoHtml+='<a data-original-title="Delete" onclick="deleteVideoRecorded('+rFieldId+')" class="btn btn-default btn-sm right" title=""><i class="fa fa-trash-o"></i></a>';
        videoHtml+='</div>';
     videoHtml+='</div>';
    $('.videoRecordList_'+fId).append(videoHtml);
}

function deleteVideoRecorded(id)
{
  $('#videoData-'+id).remove();
}

function addSignature()
{
  var data = $('.js-signature').jqSignature('getDataURL');
       
       // dataUrl = dataUrl.replace(/data:image\/png;base64,/, "");
        //alert(dataUrl);
        
        //var input_value = $('<input name="signature[]" type="hidden">').val(dataUrl); 
  var rFieldId=$('#signatureId').val();
  var signatureMediaId=$('#signatureMediaId').val();
  var mi=$('#button_'+rFieldId+"_1").attr('data-mi');
  signId=parseInt($('#totalFields_'+rFieldId).val());
  if(mi=='true'){ $('#button_'+rFieldId+"_1").html('Add More');  }else{ $('.signatureList_'+rFieldId).html(''); signId=1; $('#button_'+rFieldId+"_1").html('Update'); }
  signId=signId+1;
  $('#totalFields_'+rFieldId).val(signId);
  if(signatureMediaId==1){ signId=signId-1; }

  
  $('#canvasimg').hide();
  var signHtml='';
  signHtml+='<div class="videoThumbs " id="signData-'+signId+'">';
      signHtml+='<input id="signature_'+rFieldId+'_'+signId+'" name="signature_'+signId+'" value="'+data+'" type="hidden" class="customField sign_'+rFieldId+'">';
      signHtml+='<div class="sign_bg">';
        signHtml+='<img style="width: 200px;height: 150px;border:1px solid" src="'+data+'"/>';
      signHtml+='</div>';
      signHtml+='<div>';
        signHtml+='<span>Signature '+signId+' :</span> ';
        signHtml+='<a data-original-title="Delete" onclick="deleteSign('+signId+')" class="btn btn-default btn-sm right" title=""><i class="fa fa-trash-o"></i></a>';
      signHtml+='</div>';
   signHtml+='</div>';
   signId++;
   $('.signatureList_'+rFieldId).append(signHtml);
   $('#signaturePopup').modal('toggle');
   $('.js-signature').jqSignature('clearCanvas');
}

$(document).on('ready', function() {
    $('.js-signature').jqSignature();
});

function deleteSign(id)
{
  $('#signData-'+id).remove();
}

function recordPopup(type,id,mediaId)
{
    if(type=='audio')
    {
        $('#recordAudioId').val(id);
        $('#recordAudioMediaId').val(mediaId);
        $('#audioRecord').modal();
    }
    if(type=='video')
    {
        $('#recordedVideo').attr('src','');
        $('#recordedVideo').removeAttr('controls');
        $('#recordVideoId').val(id);
        $('#recordVideoMediaId').val(mediaId);
        $('#videoRecord').modal();
    }
    if(type=='sign')
    {
        $('#signatureId').val(id);
        $('#signatureMediaId').val(mediaId);
        $('#signaturePopup').modal();
    }
}

function deleteMedia(fieldId,mediaId,type)
{
  var fieldValue=JSON.parse($('#'+fieldId+"_"+mediaId).val());
  var mediaDeleted=[];
  if($('#deletedMedia').val()!=''){ mediaDeleted=$('#deletedMedia').val().split(","); }
  mediaDeleted.push(fieldValue['mediaId']);
  $('#deletedMedia').val(mediaDeleted.toString());
 // alert($('#deletedMedia').val());
  //$('#'+fieldId+"_"+mediaId).addClass('deletedMedia');
  if(type=='uploadVideo')
  {
    $('.videoUploadList_'+fieldId+' #videoData-'+mediaId).remove();
  }
  if(type=='image')
  {
    $('.imageUploadList_'+fieldId+' #imageData-'+mediaId).remove();
  }
  if(type=='uploadAudio')
  {
    $('#audioData-'+fieldId+'_'+mediaId).remove();
  }
  if(type=='signature')
  {
    $('.signatureList_'+fieldId+'  #imageData-'+mediaId).remove();
  }
  if(type=='recordVideo')
  {
    $('.signatureList_'+fieldId+'  #imageData-'+mediaId).remove();
  }
}

var map='';
function show_map(lat,lng)
{
  $('#gpsPopup').modal();
  //setloader();
  setTimeout(function(){ var myCenter = new google.maps.LatLng(lat,lng);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 14};
  map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);

  // Zoom to 9 when clicking on marker
  google.maps.event.addListener(marker,'click',function() {
    map.setZoom(18);
    map.setCenter(marker.getPosition());
  });

  //unloading();
  },1000);
}

function updateTextInput(val,id) {
          $('#textInput_'+id).html(val); 
        }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY; ?>"></script>