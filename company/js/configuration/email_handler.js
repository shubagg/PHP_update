    function select_receive_mail(id,val,type)
{
    var classid=classidcheck;
    var seloption = "<option>Select Variable</option>";
    var arrval = "";
    $('input[name^="variablename"]').each(function () {
        arrval = $(this).val();

    });

    if (arrval != "") {

        var numbersArray = arrval.split(',');
        $.each(numbersArray, function (index, value) {
            seloption += "<option value=" + value + ">" + value + "</option>";

        });
    }
    if (val == 'since' || val == 'before')
    {
        if( $("#search_criteria_lable-"+id+"-"+classid).text().length == 0)
        {
           $("#search_criteria_lable-"+id+"-"+classid).append("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>");
        }  
        var sincebefore='<input id="variablename-from-'+id+'-'+classid+'" type="text" class="form-control mandatory_field receive_list_append" style="width:80%;" placeholder="YYYY-MM-DD" name="'+classid+'[from][]" value=""  data-check="blank" data-error="This field is required" data-createform-id="'+classid+'"><select class="form-control appendVariable" attr_handler="mail" attr_handler_event="'+ type + '" attr_handler_event_type="value" style="width: 5%;"  data-id="variablename-from-'+id+'-'+classid+'">'+seloption+'</select>';
        $("#search_criteria-"+id+"-"+classid).html(sincebefore);
    }
    else
    {
        $("#receive_list-value-box-from-"+id).css('display','block');
        if( $("#search_criteria_lable-"+id+"-"+classid).text().length == 0)
        {
           $("#search_criteria_lable-"+id+"-"+classid).append("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>");
        }
        var sincebefore='<input id="variablename-from-'+id+'-'+classid+'" type="text" class="form-control mandatory_field receive_list_append" style="width:80%;" placeholder="Value" name="'+classid+'[from][]" value=""  data-check="blank" data-error="This field is required" data-createform-id="'+classid+'"><select class="form-control appendVariable" attr_handler="mail" attr_handler_event="'+ type + '" attr_handler_event_type="value" style="width: 5%;"  data-id="variablename-from-'+id+'-'+classid+'">'+seloption+'</select>';
        $("#search_criteria-"+id+"-"+classid).html(sincebefore);
    }
    if(val == 'unseen' || val == 'new')
    {
        var sincebefore='';
        $("#search_criteria_lable-"+id+"-"+classid).html("");
        $("#search_criteria-"+id+"-"+classid).html(sincebefore);
        $("#receive_list-value-box-from-"+id).css('display','none');
        $("#receive_list-value-box-from-"+id+"-"+classid).css('display','block');
    }
    else
    {
        $("#receive_list-value-box-from-"+id).css('display','block');
        if( $("#search_criteria_lable-"+id+"-"+classid).text().length == 0)
        {
      $("#search_criteria_lable-"+id+"-"+classid).append("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>"); 
        }
    }
    validation_variable();
}

//add new search criteria
function add_receive_list(name,type)
{
    receive_list = parseInt(receive_list) + 1;
    var seloption = "<option>Select Variable</option>";
    var arrval = "";
    $('input[name^="variablename"]').each(function () {
        arrval = $(this).val();

    });

    if (arrval != "") {

        var numbersArray = arrval.split(',');
        $.each(numbersArray, function (index, value) {
            seloption += "<option value=" + value + ">" + value + "</option>";

        });
    }
    var search_criteria='<div class="list-st" id="receive_list-box-'+receive_list+'-'+name+'"><div class="row"><div class="col-md-12"><div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="delete_receive_list(' + receive_list + ',\''+name+'\')"><i  class="add-element-button fa fa-minus" dat></i></span></div></div><div class="col-md-12" id="receive_list-value-box-'+receive_list+'-'+name+'"><div class="form-group"><label for="sel1" class="cell-po">Action</label><select class="form-control mandatory_field receive_mail_dropdown" name="'+name+'[type][]" data-check="blank" data-error="This field is required" onchange="select_receive_mail(\''+receive_list+'\',this.value,\''+type+'\')" data-createform-id="'+name+'"><option value="">Select Type</option><option value="from">From</option><option value="subject">Subject</option><option value="since">Since</option><option value="before">Before</option><option value="unseen">Unseen</option><option value="new">New</option></select></div></div><div class="col-md-12  receive_list-box-'+receive_list+'" id="receive_list-value-box-from-'+receive_list+'"><div class="form-group"><label style="width:20%;" for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label><div id="search_criteria-'+receive_list+'-'+name+'"><input id="variablename-from-'+receive_list+'-'+name+'" type="text" class="form-control receive_list_append" style="width:80%;" placeholder="Value" name="'+name+'[from][]" value=""  data-check="blank" data-error="This field is required" data-createform-id="'+name+'"><select class="form-control appendVariable" attr_handler="mail" attr_handler_event="'+ type + '" attr_handler_event_type="value" style="width: 5%;"  data-id="variablename-from-'+receive_list+'-'+name+'">'+seloption+'</select></div></div></div></div>';

    $(".section-receivemail-action-"+name).append(search_criteria);
    validation_variable();
}

//delete search criteria
function delete_receive_list(k,classidcheck) 
{     
    $("#receive_list-box-" + k+"-"+classidcheck).remove();
}

// add new intends
function add_intends(name,type)
{
    intends = parseInt(intends) + 1;
  
    var seloption = "<option>Select Variable</option>";
    var arrval = "";
    $('input[name^="variablename"]').each(function () {
        arrval = $(this).val();

    });

    if (arrval != "") {

        var numbersArray = arrval.split(',');
        $.each(numbersArray, function (index, value) {
            seloption += "<option value=" + value + ">" + value + "</option>";

        });
    }
var intendsdata='<div class="list-st" id="intends-box-'+intends+'-'+name+'"><div  style="width:94%;float:left;"><input type="text" style="width:49% !important;" id="intends-'+intends+'-'+name+'"  name="'+name+'[intends][]" class="form-control" data-check="blank" data-error="This field is required" value="" data-createform-id="'+name+'" placeholder="Intends" style="width: 90%;"/> <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="'+ type + '" attr_handler_event_type="intends" style="width: 9%;" data-id="intends-'+intends+'-'+name+'"><option value="">Select Variable</option></select></div><div class="pull-right" style="margin-top: 4px;"><span class="pull-right" onclick="delete_intends_list(' + intends + ',\''+name+'\')"><i  class="add-element-button fa fa-minus" dat=""></i></span></div></div>';
    $(".section-add-intends-action-"+name).append(intendsdata);
    validation_variable();
}

//delete intends
function delete_intends_list(id,classidcheck)
{
    $("#intends-box-"+id+"-" + classidcheck).remove();
}

//add new intends callback
function add_intends_callback(name,type)
{
    intends_callback = parseInt(intends_callback) + 1;
    var seloption = "<option>Select Variable</option>";
    var arrval = "";
    $('input[name^="variablename"]').each(function () {
        arrval = $(this).val();

    });

    if (arrval != "") {

        var numbersArray = arrval.split(',');
        $.each(numbersArray, function (index, value) {
            seloption += "<option value=" + value + ">" + value + "</option>";

        });
    }
    var intends_callbackdata='<div class="list-st" id="intends_callback-box-'+intends_callback+'-'+name+'"><div  style="width:94%; float:left;"><input type="text" name="'+name+'[intends_callback_key][]" class="form-control" data-check="blank" data-error="This field is required" value="" data-createform-id="'+name+'" placeholder="Key" style="width: 100% !important;"/><input type="text" style="width:49% !important;" id="intends_callback-'+intends_callback+'-'+name+'"  name="'+name+'[intends_callback_value][]" class="form-control" data-check="blank" data-error="This field is required" value="" data-createform-id="'+name+'" placeholder="Value" style="width: 47%;"/><select class="form-control appendVariable" attr_handler="mail" attr_handler_event="'+ type + '" attr_handler_event_type="intends" style="width: 9%;" data-id="intends_callback-'+intends_callback+'-'+name+'"><option value="">Select Variable</option></select></div><div class="pull-right" style="margin-top: 4px;"><span class="spull-right" onclick="delete_intends_callback_list(' + intends_callback + ',\''+name+'\')"><i  class="add-element-button fa fa-minus" dat></i></span></div></div>'; 
    $(".section-add-intends-callback-action-"+name).append(intends_callbackdata);
}


//delete intends callback
function delete_intends_callback_list(id,classidcheck)
{
    $("#intends_callback-box-"+id+"-" + classidcheck).remove();
}