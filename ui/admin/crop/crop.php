<!--    /////////////////////////  Crop image  Start ////////////////////////// -->

<!--
    NOTE:-
            1. include file include_once("../crop/crop.php"); .

            2. use two hidden id in template -  <input type="hidden" id="hiddenCropData" name="hiddenCropData"> 
                                                <input type="hidden" id="hiddenCropType" name="hiddenCropType">.

            3.add class for imput type file => cropimage , for error => crop_error.

            4. add on submit => $cropimagedata=$_POST['hiddenCropData'];
                                $crpimagtype=$_POST['hiddenCropType'];

            5. to show thumbnail use class class="Cropthumbnail" or (class="thumbnail" => to find the img tag-preview).

    -->
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var imageType="";
var imagebaseType="";
var imageDummypath="<?php echo admin_ui_url()."blog/css/addg.png";?>";
var jcrop_api;
</script> 
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>crop/js/crop.js"></script>
<script src="<?php echo admin_ui_url(); ?>crop/js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="<?php echo admin_ui_url(); ?>crop/css/jquery.Jcrop.css" type="text/css" />
<script>

function checkCoords()
  { 
    
    $("#submitcrop").prop('disabled',true);
    if (parseInt($('#w').val())) 
    {
        $("#cropform").append('<input type="hidden" name="imageWidth" value="'+maxWidthAllowed+'">');
        $("#cropform").append('<input type="hidden" name="imageheight" value="'+maxHeightAllowed+'">');
        var datasubmits= $('#cropform').serialize();
        $.ajax({
                url: ui_url+"admin/crop/savecropimage.php",                // Url to which the request is send
                type: "POST",                                             // Type of request to be send, called as method
                data: datasubmits,                                        // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                success: function(datas)   
                {
                    var datas=JSON.parse(datas);
                    if(jcrop_api)
                    {
                        $('#cropbox').data('Jcrop').destroy();
                        $('#cropbox').removeAttr('style');
                        jcrop_api.destroy();
                        $('#cropbox').attr('src','');
                      
                    }
                    
                    $("#hiddenCropData").val(datas['imageData']);
                    $("#hiddenCropType").val(datas['type']);
                    $("#myCropModal").modal("hide");
                    $("#imagePreview").attr("src", datas['showImg']);
                    $("#submitcrop").prop('disabled',false);
                    $('input:file').removeAttr("disabled");
                    if(returnFunction)
                    {
                        window[returnFunction](datas);
                    }
                    else
                    {
                        $(".thumbnail").find('img').attr('src',datas['showImg']);
                        $(".Cropthumbnail").attr('src',datas['showImg']);
                        // $("#ArticleImage").prop("disabled",false);   
                    }
                            
                }
        });
    }
    else
    {
        unloading();
        alert('Please select a crop region then press submit.');
        return false;
    }
  }
function startUpload(maxWidthAllowed,maxHeightAllowed)
{   
   
    var datasubmit="imagebaseType="+imagebaseType+"&imageType="+imageType;
    $.ajax({
            url: ui_url+"admin/crop/submit.php",               // Url to which the request is send
            type: "POST",                                     // Type of request to be send, called as method
            data: datasubmit,                                 // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            async: false,
          
            success: function(data)   
            {
                setloader();
                setTimeout(function(){ allsubmit(data,maxWidthAllowed,maxHeightAllowed) },5000);    
            }
    });
}

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }
.modal-dialog{width:auto !important;}
.none-bg{background-color: transparent; overflow: inherit; box-shadow:none; border:none;}

</style>

<div class="modal fade" id="myCropModal">
    <div class="" >  
      <div class="">
            <div class="modal-header">
              <button type="button" class="closeCropBox" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><?php echo $ui_string['crop']; ?></h4>
            </div>
                <div class="modal-body">
                  <!-- This is the image we're attaching Jcrop to -->     
                    <img src="" id="cropbox" onload="$(this).data('loaded', 'loaded');"  style="max-width: none;"/>

                <!-- This is the form that our event handler fills -->
                    <form id="cropform" method="post" enctype="multipart/form-data" >
                      <input type="hidden" id="x" name="x" />
                      <input type="hidden" id="y" name="y" />
                      <input type="hidden" id="w" name="w" />
                      <input type="hidden" id="h" name="h" />
                      <input type="hidden" id="imgname" name="imgname" />
                </div>
                        <div class="modal-footer">
                          <input type="button" value="Crop Image" class="btn btn-large btn-inverse" id="submitcrop" onclick="return checkCoords();"/ >
                        </div>
                     </form>
        </div>
  </div>
</div>

<!--//////////////////////////  Crop image  End   ////////////////////////// -->