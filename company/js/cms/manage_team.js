var allcheckedvalues = '';
function checkAll(ele) 
{
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
}

function getallcheckedvalues()
{
  allcheckedvalues="";
  $("input:checkbox[class=check_box]:checked").each(function () {

      allcheckedvalues+=$(this).val()+"|";
  });
  
  if(allcheckedvalues != '')
  {
    allcheckedvalues = allcheckedvalues.slice(0, -1);
  }

  if(allcheckedvalues == '')
  {
    $("#model_head").html("Error");
    $("#model_des").html("Please select at least one");
    $('#success_modal').modal();
  }
  else
  {
    $("#md-effect3").modal();
  }
}

function deleteallbn()
{
  var datastring="id="+allcheckedvalues;
  $.ajax({
      url:  admin_ui_url+"cms/ajax/manage_team.php?action=team",
      data: datastring,
      type: "POST",
      success: function (data)
      {
        if(data==1)
        {
            $("#model_head").html("Success");
            $("#model_des").html("Deleted successfully");
            $('#success_modal').modal();
            setTimeout(function(){ location.reload(); },1000);
        }
        
      }
    })
}

function addpopup_blank()
{
    $(".error_press").html("");
    var appendnewimg="";
    $("#teamadd")[0].reset();
    $("#team_id").val("");
    $("#conditionpress").html('Add');
    $("#changeicon").attr("class","fa fa-plus");
    appendnewimg +='<div class="fileinput fileinput-new" data-provides="fileinput">';
    appendnewimg +='<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img data-src="assets/plugins/holder/holder.js/100%x100%/text:Preview" alt="..."> </div>';
    appendnewimg +='<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>';
    appendnewimg +='<div> <span class="btn btn-inverse btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>';
    appendnewimg +='<input type="file" name="pressimage" id="pressimage"><input type="hidden" id="previous_pressimage"></span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" id="removepress"> <i class="fa fa-trash-o"></i>Remove </a> </div><span class="error_press" id="imgerror" style="color:red"></span></div>';
    $("#append_image").html(appendnewimg);

}
function delte_team_popup(id)
{
	$("#md-effect2").modal();
	$("#teamid").val(id);
}

function deleteteam()
{
	var id=$("#teamid").val();
	var datastring="id="+id;

	$.ajax({
			url: admin_ui_url+"cms/ajax/manage_team.php?action=team",
			data: datastring,
			type: "POST",
			success: function (data)
			{
				var rec="";
				if(data==1)
				{
						$("#model_head").html("Success");
            $("#model_des").html("Deleted successfully");
            $('#success_modal').modal();
            setTimeout(function(){ location.reload(); },1000);
				}
				
			}
		})
	
}

function addteamdata()
{

               var name=$("#name").val().trim();
               var description=$("#description").val().trim();
               var designation=$("#designation").val().trim();
               var img_press=$("#pressimage").val(); 
               var previous_pressimage=$("#previous_pressimage").val();
               $(".error_press").html("");

                if(img_press=="" && previous_pressimage=="")
                {
                    $("#imgerror").html(ui_string['plzchooseimgfile']);
                    $("#pressimage").val("");
                    return false;
                }
                else if(name=="")
                {
                      $("#nameerror").html("Please enter name");
                      $("#name").focus();
                      return false;
                }
                else if(designation=="")
                {
                      $("#designationerror").html("Please enter designation");
                      $("#designation").focus();
                      return false;
                }
                else if(description=="")
                {
                      $("#descriptionerror").html("Please enter description");
                      $("#description").focus();
                      return false;
                }
                else
                {
                  var formData = new FormData($('#teamadd')[0]);
                  
                  $.ajax({
                              type: "POST",
                              url:  admin_ui_url+"cms/ajax/manage_team.php?action=addteam",
                              data: formData,
                              async: false,
                              success: function(data) 
  							              {
  								
                                 $("#md-effect-add").modal('hide');
  							 
                                  if(data)
  				                        {   
                                      $("#model_head").html("Success");
                                      $("#model_des").html("Team submitted successfully");
                                      $('#success_modal').modal();
                                      setTimeout(function(){ location.reload(); },1000);
                                  }
                  								
                              },
                              cache: false,
                              contentType: false,
                              processData: false,
                              error: function(){
                                    alert('error handing here');
                              }
                  }); 
                } 
                
}


function edit_team(id)
{
    $("#teamadd")[0].reset();
    $(".error_press").html("");
    var datastring="id="+id;
    var imagedata ="";
    
    $("#md-effect-add").modal();
    $.ajax({
            url: admin_ui_url+"cms/ajax/manage_team.php?action=editteam",
            data: datastring,
            type: "POST",
            success: function (data)
            {
               
               dt1=JSON.parse(data);
               var team_id = dt1['data'][0].id;
               var image=dt1['data'][0].association_data['media']['1'][team_id][0]['mediaName'];
               var img_path=site_url+"uploads/media/images/"+image;

               $("#team_id").val(team_id);
               $("#name").val(dt1['data'][0].name);
               $("#description").val(dt1['data'][0].description);
               $("#designation").val(dt1['data'][0].designation);

               imagedata +='<div class="fileinput fileinput-exists" data-provides="fileinput"><input type="hidden" value="" name="pressimage"><input type="hidden" value="" name="">';
               imagedata +='<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">';
               imagedata +='<img data-src="assets/plugins/holder/holder.js/100%x100%/text:Preview" alt="..."> </div>';
               imagedata +='<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">';
               imagedata +='<img src="'+img_path+'" style="max-height: 140px;"></div>';
               imagedata +='<div> <span class="btn btn-inverse btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>';
               imagedata +='<input type="file" name="pressimage" id="pressimage"><input type="hidden" id="previous_pressimage">';
               imagedata +='</span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" id="removepress"> <i class="fa fa-trash-o"></i>Remove</a></div><span class="error_press" id="imgerror" style="color:red"></span></div>';
               $("#append_image").html(imagedata);
               $("#previous_pressimage").val(image);
               $("#conditionpress").html('Edit');
               $("#changeicon").attr("class","fa fa-pencil");

               
               
            }
        })
    
}
var _URL = window.URL || window.webkitURL; 
$("#pressimage").live("change", function()
{

    $(".error_press").html("");
     var fileExtension = ["jpg","JPG","PNG","png","JPEG","jpeg","gif","GIF"];
     if ($.inArray($("#pressimage").val().split('.').pop().toLowerCase(), fileExtension) == -1) 
     {
        $("#imgerror").html(ui_string['plzimage']);
        $("#removepress").click();
        $("#previous_pressimage").val("");

     }
    else if(this.files[0].size > 8388608)
    {
        $("#imgerror").html(ui_string['plzlessimg']);
        $("#removepress").click();
        $("#previous_pressimage").val("");
    }
     else if((file = this.files[0])) {
        img = new Image();
        img.onload = function ()
        {
            var w=this.width;
            var h=this.height;
            var file, img;
            var wi = 500;
            var hi = 500;
            var ratio =Math.round((500*h)/500);
            if(w < wi)
            {

                $("#imgerror").html("please select image greater than 500 * 500");
                 $("#removepress").click();
            }
            else if(h < hi)
            {

                $("#imgerror").html("please select image greater than 500 * 500");
                $("#removepress").click();
            }
            else if(ratio==w)
            {
                $("#imgerror").html("");  
                 
            }
            else
            {
                $("#imgerror").html("please select image greater than 500 * 500 ratio");
                $("#removepress").click();
            }
        };
        img.src = _URL.createObjectURL(file);
    }

   else{

        $("#imgerror").html("");

   } 
});

$("#removepress").live("click", function()
{
  $("#previous_pressimage").val("");
});