var returnFunction='';
var maxWidthAllowed='';
var maxHeightAllowed='';
$(".crop_error").html("");
var croperrorshow='';
var imageDataNotcrop=new Array();
var cropClass='';

var _URL = window.URL || window.webkitURL;
$(document).ready(function(e) {
 $('.cropimage').on("change",function () {
   if(!($("#"+this.id).attr('data-width')))
   {
      alert("Please add Meta tag data-width=''");
      return false;
   }
   else if(!($("#"+this.id).attr('data-height')))
   {
      alert("Please add Meta tag data-height=''");
      return false;
   }

     maxWidthAllowed=$("#"+this.id).attr('data-width');
     maxHeightAllowed=$("#"+this.id).attr('data-height');

    if($("#"+this.id).attr('data-returnfunction')){ returnFunction=$("#"+this.id).attr('data-returnfunction'); }
    if($("#"+this.id).attr('data-showcrop')){ cropClass=$("#"+this.id).attr('data-showcrop'); }
    if($("#"+this.id).attr('data-error')){ croperrorshow=$("#"+this.id).attr('data-error'); }
      setloader();

      $("#hiddenCropData").val("");
      $("#hiddenCropType").val("");
      $(".crop_error").html("");
      if((croperrorshow!='') && (croperrorshow!=undefined))
      {
        $("."+croperrorshow).html("");
      }

    var fileExtension = ["jpg","JPG","PNG","png","JPEG","jpeg"];
        imageDataNotcrop['tmp_path']=$(this).val();
     if($(this).val()=="")
    { 
	     unloading();
       $("#blah").attr('src',imageDummypath);
    }
    else if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1)
    {   
        unloading();
        
        $(".cropimage").val("");
        $(".crop_error").html("Please upload only images");
    }
    else if(this.files[0].size > 104857600)
    {
        unloading();
        $(".cropimage").val("");
        $(".crop_error").html("Please upload less than 100mb images");

   }
   else if((file = this.files[0])) {

	if (this.files && this.files[0]) 
        {
            var FR= new FileReader();
            FR.onload = function(e) {
            
             imagebaseType= e.target.result;
          };       
          FR.readAsDataURL( this.files[0] );

          imageType=this.files[0].type;
        }	

        img = new Image();
        img.onload = function ()
        {
            var w=this.width;
            var h=this.height;
            var file, img;
            var wi = parseInt(maxWidthAllowed);
            var hi = parseInt(maxHeightAllowed);
            if(maxWidthAllowed){
              var ratio =Math.round((maxWidthAllowed*h)/maxHeightAllowed);
            }
            else{
            var ratio =Math.round((800*h)/600);
            }
            /*if(returnFunction)
            {
             // imageDataNotcrop['showImg']=imagebaseType;
             // window[returnFunction](imageDataNotcrop);
            }
            else
            {
              $("#showimage1").find('img').attr('src',imagebaseType);
            }*/
            $(".crop_error").html("");
            unloading();
            var fnew="(W-800 & H-600)";
	          $("#writerratio").html(fnew);
             if(ratio==w)
            {   
                if(returnFunction)
                {
                  imageDataNotcrop['showImg']=imagebaseType;
                  
                  window[returnFunction](imageDataNotcrop);
                }
                else
                {
                $("#showimage1").find('img').attr('src',imagebaseType);
                }
                $(".crop_error").html("");
                unloading();
                
            }
            else if(w > wi && h > hi) 
            {
                startUpload(maxWidthAllowed,maxHeightAllowed);
            }
            else
            {
		           unloading();
               
               if(croperrorshow){
                  $(".cropimage").val("");
                  $("#hiddenCropData"+cropClass).val('');
                  $("#hiddenCropType"+cropClass).val('');
                  $("."+croperrorshow).html("Please Select Image Greater Then (W-"+maxWidthAllowed+" & H-"+maxHeightAllowed+")");
               }
               else{
                  $(".cropimage").val("");
               $("#hiddenCropData").val('');
               $("#hiddenCropType").val('');
                  $(".crop_error").html("Please Select Image Greater Then Or Exact (W-800 & H-600)");
               $("#showimage1").find('img').attr('src',imageDummypath);
               }
               
              
            }
            
	    };
        img.src = _URL.createObjectURL(file);
    }
   else
   {
	       unloading();
        $(".crop_error").html("");
   }
 
 });
});

function allsubmit(img,maxWidthAllowed,maxHeightAllowed)
{

  var currentUrls=img;
  $("#cropbox").attr("src","");
  $("#cropbox").attr("src",currentUrls);
  $("#imgname").val(img);

  $('#cropbox').Jcrop({
        aspectRatio: 0,
        boxWidth: 460, 
        boxHeight: 350,
        maxSize: [parseInt(maxWidthAllowed), parseInt(maxHeightAllowed)],
        allowResize: false,
        allowSelect:false,
        setSelect: [($('#cropbox').width() / 2) - parseInt(maxWidthAllowed),
                            ($('#cropbox').height() / 2) - parseInt(maxHeightAllowed),
                            ($('#cropbox').width() / 2) + parseInt(maxWidthAllowed),
                            ($('#cropbox').height() / 2) + parseInt(maxHeightAllowed)
                            ],
        onSelect: updateCoords 

      },function(){           
            jcrop_api = this;
            });
        
		$("#cropbox").one("load", function() 
			{
			  $("#myCropModal").modal();
			  unloading();
        $("#loader").hide();
			}).each(function() {
			  if(this.complete) $(this).load();
			});

}

function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
    
  };
  
$(document).ready(function(e) {
    $(".closeCropBox").click(function (){
      if (jcrop_api)
      {
        $('#cropbox').data('Jcrop').destroy();
        $('#cropbox').removeAttr('style');
        jcrop_api.destroy();
        $('#cropbox').attr('src','');
        $(".thumbnail").find('img').attr('src',"");
        $(".cropimage").val(""); // blank choose image..
      }
    });
});


