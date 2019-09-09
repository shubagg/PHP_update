var classidcheck;
//for action type on updatevariable handler
function actionTypeOnVariable(actionType,name,type)
{
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
    $('#updatevariable-value-box-0_'+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Variable<span style='color:red;'>*</span></label><input type='text' class='yes-var form-control mandatory_field' style='width:85%;' placeholder='Value' name='" + name + "[value]' value='' id='variablename-value-" + name + "-0' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-value-" + name + "-0' attr_handler='arithmetic_operation' attr_handler_event='" + type + "' attr_handler_event_type='value'>" + seloption + "</select>");
    $('#updatevariable-from-box-0_'+name).html("");
    $('#updatevariable-to-box-0_'+name).html("");
    if (actionType == 'assign')
    {
        $('#updatevariable-from-box-0_'+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>From<span style='color:red;'>*</span></label><input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='From' name='" + name + "[from]' value='' id='variablename-from-" + name + "-0' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-from-" + name + "-0' attr_handler='arithmetic_operation' attr_handler_event='" + type + "' attr_handler_event_type='from'>" + seloption + "</select>");
        $('#updatevariable-to-box-0_'+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>To<span style='color:red;'>*</span></label><input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='To' name='" + name + "[to]' value='' id='variablename-to-" + name + "-0' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-to-" + name + "-0' attr_handler='arithmetic_operation' attr_handler_event='" + type + "' attr_handler_event_type='to'>" + seloption + "</select>");
        $('#updatevariable-value-box-0_'+name).html("");
    } else
    {
        $('#updatevariable-from-box-0_'+name).html("");
        $('#updatevariable-to-box-0_'+name).html("");
    }
validation_variable();
}
//end action type on updatevariable

//append variable into calculator 
$(".appendVariable1").live("click", function () {
    if($(this).val()!=""){
        var classidname = $(this).attr("data-val");
        var typearray = [];
        var newArr =[];
        var oldArrData = $("#old_value_array_"+classidname).val();
        if(oldArrData!="")
        {
            newArr = oldArrData.split("|");
        }
        $('select[name^="datatype[]"]').each(function () {
            if ($(this).val() != "") {
                typearray.push($(this).val());
            }
        });
        var testlength = typearray.length;
        var oldval = "";
        var newval = "";
        if (testlength != "")
        {
            if ($(".appendVariable1").length > 0)
            {
                var variablename = $(this).attr("data-id");
                oldval += $("textarea#" + variablename).val();
                var value = $(this).val();
                if (value != '' && value !=null)
                {
                    value = "[var]" + value;
                    newval += oldval + value;
                    $("#old_value_data_"+classidname).val(oldval);
                    $("#select-calculator-" + classidname).val("");
                    $("#variablename-value-" + classidname).val(newval);
                    newArr.push(value);
                    var finalArr = newArr.join("|");
                    $("#old_value_array_"+classidname).val(finalArr);
                }
            }
        }
    }
});
// end of append variable calculator 

//add calculator functionality to Arithmetic Equation
function calculator(oprator_type,name)
{
    var classidname = name;
    var newArr =[];
    var oldArrData = $("#old_value_array_"+classidname).val();
    if(oldArrData!="")
    {
        newArr = oldArrData.split("|");
    }
    var value = $("#variablename-value-" + classidname).val();
    $("#old_value_data_"+classidname).val(value);
    newArr.push(oprator_type);
    var finalArr = newArr.join("|");
    $("#old_value_array_"+classidname).val(finalArr);
    if (value != "")
    {
        var newval = value + oprator_type;
        $("textarea#variablename-value-" + classidname).val(newval);
    }
}
//End of calculator functionality to Arithmetic Equation

//calculator delete function
function delete_cal(name)
{
    var classidcheck=name;
    var newArr=[];
    var flag=0;
    var value = $("#variablename-value-" + classidcheck).val();
    var oldvalarr=$("#old_value_array_"+classidcheck).val();
    var newOldval=oldvalarr.split('|');
    var newOldvalLen=newOldval.length;
    for(i=0;i<newOldvalLen-1;i++)
    {
        newArr.push(newOldval[i]);      
        var finalArr = newArr.join("|");
        flag=1;
    }
    $("#old_value_array_"+classidcheck).val(finalArr);
    var newfinalArr="";
    if(flag)
    {
        newfinalArr=finalArr.replace(/[|]/g,'');
    }
    $("#variablename-value-" + classidcheck).val(newfinalArr);
}
//end of calculator delete function

//add value from text box in textarea
function add_var(ele,name)
{
    //function for enter key from keyboard
    var classidcheck=name;
    if (event.key === 'Enter')
    {
        var old = $("textarea#variablename-value-" + classidcheck).val();
        $("#old_value_data_"+classidcheck).val(old);
        var newArr =[];
        var oldArrData = $("#old_value_array_"+classidcheck).val();
        if(oldArrData!="")
        {
            newArr = oldArrData.split("|");
        }
        var variable_val = ele.value;
        newArr.push($("#variables-" + classidcheck).val());
        var finalArr = newArr.join("|");
        $("#old_value_array_"+classidcheck).val(finalArr);
        var newval = old + variable_val;
        $("#variablename-value-" + classidcheck).val(newval);
        $("#variables-" + classidcheck).val("");
    }
    //end of enter key from keyboard function

    //function for only use numbers and decimal number
    if (event.shiftKey == true) {
        event.preventDefault();
    }
    if ((event.keyCode >= 48 && event.keyCode <= 57) ||
            (event.keyCode >= 96 && event.keyCode <= 105) ||
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190)
    {
    } else
    {
        event.preventDefault();
    }
    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
        event.preventDefault();
    //end of only use number and decimal function
}
//end of value from text box in textarea

//edit case
$(document).ready(function () {
    var name=classidcheck;
    var value = $("#variablename-value-" + name).val();
    if (value !== null)
    {
        var close_backet = '';
        if(value != undefined) {
            close_backet = value.substr(-1);
        }
    }
});
//End of edit case

//Work on type on excelactions
function WorkOnType(id, actionType)
{
    $("#worktype-"+id).val(actionType);
    var optiondata = '<option value="">Select Action</option>';
    if (actionType == "workbook")
    {
        optiondata += '<option value="create">Create</option>';
        optiondata += '<option value="open">Open</option>';
        optiondata += '<option value="save">Save</option>';
        optiondata += '<option value="getsheetnames">Get Sheet Names</option>';
        $("#excelactions-workbook-box-0-"+id).css("display", "block");
        $("#worksheet_name_" + id).css("display", "none");
        $("#action_workbook_" + id).html(optiondata);
    } else if (actionType == "worksheet")
    {
        optiondata += '<option value="create">Create</option>';
        optiondata += '<option value="open">Open</option>';
        optiondata += '<option value="delete">Delete</option>';
        optiondata += '<option value="fetch_sheet">Fetch Sheet</option>';
        $("#action_workbook_" + id).html(optiondata);
        $("#excelactions-workbook-box-0-"+id).css("display", "block");
        $("#worktype-"+id).val("worksheet");
        $("#workbook_path_" + id).css("display", "none");
    } else
    {
        $("#excelactions-workbook-box-0-"+id).css("display", "none");
        $("#excelactions-worksheet-box-0").css("display", "none");
        $("#workbook_path_" + id).css("display", "none");
        $("#worksheet_name_" + id).css("display", "none");
        $("#worktype-"+id).val("");
    }
}
//end Work on tyexcelactions

//Start of action type on excel actions
function actions_type(id, action_type)
{

    var selecttype = $("#worktype-"+id).val();

    if (selecttype == 'workbook' && action_type != "")
    {
        $("#action_workbook_" + id).val(action_type);
        if (action_type == 'open')
        {
            $("#workbook_path_" + id).css("display", "block");
            $("#variablename-workbook_name1-" + id).addClass("mandatory_field");
            $("#worksheet_name_" + id).css("display", "none");
            $("#variablename-worksheet_name-" + id).val("");
        } else if (action_type == 'save')
        {
            $("#workbook_path_" + id).css("display", "block");
            $("#variablename-workbook_name1-" + id).addClass("mandatory_field");
            $("#worksheet_name_" + id).css("display", "none");
            $("#variablename-worksheet_name-" + id).val("");
        } else
        {
            $("#workbook_path_" + id).css("display", "none");
            $("#variablename-workbook_name1-" + id).removeClass("mandatory_field");
            $("#variablename-worksheet_name-" + id).removeClass("mandatory_field");
            $("#worksheet_name_" + id).css("display", "none");
            $("#variablename-worksheet_name-" + id).val("");
        }
    } else if (selecttype == 'worksheet' && action_type != "")
    {
        $("#action_worksheet_" + id).val(action_type);
        if (action_type == 'open')
        {
            $("#workbook_path_" + id).css("display", "none");
            $("#worksheet_name_" + id).css("display", "block");
            $("#variablename-worksheet_name-" + id).addClass("mandatory_field");
            $("#variablename-workbook_name1-" + id).val("");
        } else if (action_type == 'create')
        {
            $("#workbook_path_" + id).css("display", "none");
            $("#worksheet_name_" + id).css("display", "block");
            $("#variablename-worksheet_name-" + id).addClass("mandatory_field");
            $("#variablename-workbook_name1-" + id).val("");
        } else if (action_type == 'delete')
        {
            $("#workbook_path_" + id).css("display", "none");
            $("#worksheet_name_" + id).css("display", "block");
            $("#variablename-worksheet_name-" + id).addClass("mandatory_field");
            $("#variablename-workbook_name1-" + id).val("");
        }else if (action_type == 'fetch_sheet')
        {
            $("#workbook_path_" + id).css("display", "none");
            $("#worksheet_name_" + id).css("display", "block");
            $("#variablename-worksheet_name-" + id).addClass("mandatory_field");
            $("#variablename-workbook_name1-" + id).val("");
        }
        else
        {
            $("#workbook_path_" + id).css("display", "none");
            $("#variablename-workbook_name1-" + id).removeClass("mandatory_field");
            $("#variablename-worksheet_name-" + id).removeClass("mandatory_field");
            $("#variablename-workbook_name1-" + id).val("");
        }
    } else
    {
        $("#excelactions-workbook-box-0-"+id).css("display", "none");
        $("#excelactions-worksheet-box-0").css("display", "none");
    }
}
//End  of action type on excel actions

// Start of action type on update data
function update_data_action(id, classidcheck, actiontype, type)
{
    if (actiontype != "")
    {
        var name = classidcheck;
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (actiontype == 'set_cell_value')
        {
            $('#updatedata-set-range-select-value-box-' + id+"-"+name).html(" ");
            $("#updatedata-set-range-box-" + id+"-"+name).html(" ");
            $('#updatedata-apply-formula-box-' + id+"-"+name).html(" ");
            $('#updatedata-append-range-box-' + id+"-"+name).html(" ");
            $('#updatedata-cell-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Cell Name<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:80%;' placeholder='' name='" + name + "[cellname][]' value='' id='updatedata-cell-name-" + id +"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-cell-name-" + id+"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='cellname'>"+seloption+"</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:80%;' name='" + name + "[cellvalue][]' value='' id='updatedata-cell-value-" + id +"-"+name+"' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-cell-value-" + id +"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='cellvalue'>"+seloption+"</select></div></div>");
        } else if (actiontype == 'set_range')
        {
            $('#updatedata-apply-formula-box-' + id+"-"+name).html(" ");
            $('#updatedata-append-range-box-' + id+"-"+name).html(" ");
            $('#updatedata-cell-box-' + id+"-"+name).html(" ");
            $("#updatedata-set-range-box-" + id+"-"+name).html("<label for='sel1' class='cell-po'>Set Range<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;' id='set_range_select_box_" + id+"_"+name + "' name='" + name + "[set_range][]' onchange='set_range_action_type(" + id + ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Action Type</option><option value='row'>Row</option><option value='column'>Column</option><option value='range'>Range</option></select>");
        } 
        else if (actiontype == 'append_range')
        {
            $('#updatedata-set-range-select-value-box-' + id+"-"+name).html(" ");
            $("#updatedata-set-range-box-" + id+"-"+name).html(" ");
            $('#updatedata-apply-formula-box-' + id+"-"+name).html(" ");
            $('#updatedata-cell-box-' + id+"-"+name).html(" ");
            $('#updatedata-append-range-box-' + id+"-"+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Variable<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:90%;' placeholder='' name='" + name + "[variable][]' value='' id='updatedata-variable-" + id + "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-variable-" + id + "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='variable'>"+seloption+"</select></div>");
        } 
        else if (actiontype == 'apply_formula')
        {
            $('#updatedata-set-range-select-value-box-' + id+"-"+name).html(" ");
            $("#updatedata-set-range-box-" + id+"-"+name).html(" ");
            $('#updatedata-cell-box-' + id+"-"+name).html(" ");
            $('#updatedata-append-range-box-' + id+"-"+name).html(" ");
            $('#updatedata-apply-formula-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Formula<span style='color:red;'>*</span></label><input type='text' class='form-control  yes-var mandatory_field' style='width:80%;' placeholder='' name='" + name + "[formula][]' value='' id='updatedata-formula-" + id+"-" +name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-formula-" + id +"-" +name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='formula'>"+seloption+"</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Column Name<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:80%;' name='" + name + "[column_name][]' value='' id='updatedata-column-name-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-column-name-" + id +"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='column_name'>"+seloption+"</div></div>");
        
    } 
    }
    validation_variable();
}
//End of action type on update data

// start set range action type
function set_range_action_type(id, checktype, actiontype,type)
{
    var set_range_val = actiontype;
    if (set_range_val != "")
    {
        var name = checktype;
        $("#updatedata-cell-box-" + id+"-"+name).html(" ");
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (set_range_val == "row")
        {
            $('#updatedata-set-range-select-value-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Row Number<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[rowname][]' value='' id='updatedata-rowname-" + id+"-"+name + "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-rowname-" + id+"-"+name + "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='rowname'>"+seloption+"</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Row Value<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[rowvalue][]' value='' id='updatedata-rowvalue-" + id+"-"+name + "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-rowvalue-" + id+"-"+name + "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='rowvalue'>"+seloption+"</select></div></div>");
        } else if (set_range_val == "column")
        {
            $('#updatedata-set-range-select-value-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Column Name<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[columnname][]' value='' id='updatedata-columnname-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-columnname-" + id+"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='columnname'>"+seloption+"</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Column Value<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[columnvalue][]' value='' id='updatedata-columnvalue-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-columnvalue-" + id+"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='columnvalue'>"+seloption+"</select></div></div>");
        } else if (set_range_val == "range")
        {
            $('#updatedata-set-range-select-value-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Start Cell<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[from][]' value='' id='updatedata-from-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-from-" + id +"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='from'>"+seloption+"</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label><input type='text' class='yes-var form-control mandatory_field' style='width:85%;' placeholder='' name='" + name + "[fromvalue][]' value='' id='updatedata-fromvalue-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='updatedata-fromvalue-" + id +"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='fromvalue'>"+seloption+"</select></div></div></div>");
        } else
        {
            $('#updatedata-set-range-select-value-box-' + id+"-"+name).html(" ");
        }
    }
    validation_variable();
}
// end of set range action type

// Add Button function in update data 
function add_update_data(name,type)
{
    var update_data_excel = $("#data-count-"+name).attr("data-count");
    update_data_excel = parseInt(update_data_excel) + 1;
    $("#data-count-"+name).attr("data-count",update_data_excel.toString());
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
    $(".section-updatedata-action-"+name).append("<div id='updatedata-box-" + update_data_excel+"-"+name+ "' class='list-st'><div style='position: absolute;right: 10px;top:10px;z-index: 99;'><span class='pull-right' onclick='delete_update_variable(" + update_data_excel+",\""+name+"\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group show-me12'><label for='sel1' class='cell-po'>Actions<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;'' name='" + name + "[action][]' id='update-data-action-" + update_data_excel +"-"+name+"' onchange='update_data_action(" + update_data_excel + ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Action Type</option><option value='set_cell_value'>Set Cell Value</option><option value='set_range'>Set Range</option><option value='append_range'>Append Range</option><option value='apply_formula'>Apply Formula</option></select></div><div class='show-me12' id='updatedata-cell-box-" + update_data_excel +"-"+name+ "'></div><div class='show-me12' id='updatedata-apply-formula-box-" + update_data_excel +"-"+name+ "'></div><div class='show-me12'id='updatedata-append-range-box-" + update_data_excel +"-"+name+ "'></div><div class='show-me12' id='updatedata-set-range-box-" + update_data_excel+"-"+name+ "'></div><div class='show-me12' id='updatedata-set-range-select-value-box-" + update_data_excel+"-"+name+ "'></div></div>");
}
// end of Add Button function in update data 

// Start delete function for update data
function delete_update_variable(k,name)
{
    $("#updatedata-box-"+k+"-"+name).remove();
}
// End delete function for update data

// Start of action type on fetch variable
function fetch_data_action(id, classidcheck, actiontype, type)
{
    if (actiontype != "")
    {
        var name = classidcheck;
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (actiontype == 'get_cell_value')
        {
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html(" ");
            $("#fetchdata-get-range-select-column-value-box-" + id+"-"+name).html(" ");
            $("#fetchdata-get-range-box-" + id+"-"+name).html(" ");
            $('#fetchdata-cell-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Cell Name<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field variablename' style='width:90%;' placeholder='' name='" + name + "[value][]' value='' id='fetchdata-cell-name-" +id+"-"+name + "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='fetchdata-cell-name-"+id+"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='value'>"+seloption+"</select></div></div>");
        }  
        else if (actiontype == 'get_range')
        {
            $("#fetchdata-get-range-select-column-value-box-" + id+"-"+name).html(" ");
            $('#fetchdata-cell-box-' + id+"-"+name).html(" ");
            $("#fetchdata-get-range-box-" + id+"-"+name).html("<label for='sel1' class='cell-po'>Get Range<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;' id='get_range_select_box_" + id+"_"+name+"' name='" + name + "[get_range][]' onchange='get_range_action_type(" +id+ ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Action Type</option><option value='row'>Row</option><option value='column'>Column</option><option value='range'>Range</option></select>");
        } 
    }
    validation_variable();
}
//End of action type on fetch variable

// start get range action type
function get_range_action_type(id, checktype, actiontype , type)
{
    var get_range_val = actiontype;
    if (get_range_val != "")
    {
        $("#fetchdata-cell-box-" + id+"-"+name).html(" ");
        var name = checktype;
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (get_range_val == "row")
        {
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html("");
            $('#fetchdata-get-range-select-column-value-box-' + id+"-"+name).html("");
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Row Number<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:90%;' placeholder='' name='" + name + "[rowname][]' value='' id='fetchdata-rowname-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='fetchdata-rowname-" + id+"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='rowname'>"+seloption +"</select>");
        } else if (get_range_val == "column")
        {
            $('#fetchdata-get-range-select-column-value-box-' + id+"-"+name).html("");
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html("");
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po'>Column Name<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;' id='columnname_select_box_" + id+"_"+name+ "' name='" + name + "[columnname][]' onchange='get_column_value(" +id+ ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Column Name</option><option value='get_by_column'>Get By Column</option><option value='get_by_name'>Get By Name</option></select><div class='show-me12' id='fetchdata-get-range-select-column-value-box-" + id +"-"+name+"'></div>");
        } else if (get_range_val == "range")
        {
            $('#fetchdata-get-range-select-column-value-box-' + id+"-"+name).html("");
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html("");
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Start Cell<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[from][]' value='' id='fetchdata-from-" + id+"-"+name+"' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='fetchdata-from-" + id+"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='from'>"+seloption +"</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Stop Cell<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[to][]' value='' id='fetchdata-to-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='fetchdata-to-" + id +"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='to'>"+seloption +"</select></div></div>");
        } else
        {
            $('#fetchdata-get-range-select-value-box-' + id+"-"+name).html(" ");
        }
    }
    validation_variable();
}
// end of get range action type

// Add Button function in Fetch data 
function add_fetch_data(name,type)
{ 
    var fetch_data_excel = $("#data-count-"+name).attr("data-count");
    fetch_data_excel = parseInt(fetch_data_excel) + 1;
    $("#data-count-"+name).attr("data-count",fetch_data_excel.toString());
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
    $(".section-fetch-data-action-"+name).append("<div class='list-st' id='fetchdata-box-" + fetch_data_excel+"-"+name+ "'><div class='form-group show-me12'><div style='position: absolute;right: 0;z-index: 99;'><span class='pull-right' onclick='delete_fetch_variable(" + fetch_data_excel+",\""+name+"\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><label for='sel1' class='cell-po'>Actions<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;'' name='" + name + "[action][]' id='fetch-data-action-" + fetch_data_excel+"-"+name+ "' onchange='fetch_data_action(" + fetch_data_excel + ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Action Type</option><option value='get_cell_value'>Get Cell Value</option><option value='get_range'>Get Range</option></select></div><div class='show-me12' id='fetchdata-cell-box-" + fetch_data_excel+"-"+name+ "'></div><div class='show-me12' id='fetchdata-get-range-box-" + fetch_data_excel+"-"+name+"'></div><div class='show-me12' id='fetchdata-get-range-select-value-box-" + fetch_data_excel+"-"+name+ "'></div><div class='show-me12' id='fetchdata-get-range-box-" + fetch_data_excel+"-"+name+"'></div><div class='show-me12' id='fetchdata-get-range-select-column-value-box-" + fetch_data_excel+"-"+name+ "'></div></div></div></div>");
}
// end of Add Button function in Fetch data 

// Start delete function for Fetch data
function delete_fetch_variable(k,name)
{
    $("#fetchdata-box-"+k+"-"+name).remove();
}
// End delete function for Fetch data

// Start of action type on delete data function
function delete_data_action(id, classidcheck, actiontype, type)
{
    if (actiontype != "")
    {
        var name = classidcheck;
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (actiontype == 'delete_cell_value')
        {
            $('#deletedata-delete-range-select-value-box-' + id+"-"+name).html(" ");
            $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html(" ");       
            $("#deletedata-delete-range-box-" + id+"-"+name).html(" ");
            $('#deletedata-cell-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Cell Name<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field variablename' style='width:90%;' placeholder='' name='" + name + "[value][]' value='' id='deletedata-cell-name-" +id+"-"+name + "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='deletedata-cell-name-"+id+"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='value'>"+seloption+"</select></div></div>");
        }  
        else if (actiontype == 'delete_range')
        {
            $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html(" ");
            $('#deletedata-cell-box-' + id+"-"+name).html(" ");
            $("#deletedata-delete-range-box-" + id+"-"+name).html("<label for='sel1' class='cell-po'>Delete Range<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;' id='delete_range_select_box_" + id+"_"+name+ "' name='" + name + "[delete_range][]' onchange='delete_range_action_type(" +id+ ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Action Type</option><option value='row'>Row</option><option value='column'>Column</option><option value='range'>Range</option></select>");
        } 
    }
    validation_variable();
}
//End of action type on delete data 

// start delete range action type function
function delete_range_action_type(id, checktype, actiontype, type)
{
    var delete_range_val = actiontype;
    if (delete_range_val != "")
    {
        $("#deletedata-cell-box-" + id+"-"+name).html(" ");
        var name = checktype;
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (delete_range_val == "row")
        {
            $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html(" ");
            $('#deletedata-delete-range-select-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Row Number<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:90%;' placeholder='' name='" + name + "[rowname][]' value='' id='deletedata-rowname-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='deletedata-rowname-" + id+"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='rowname'>"+seloption +"</select>");
        } else if (delete_range_val == "column")
        {
            $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html(" ");
            $('#deletedata-delete-range-select-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po'>Column Name<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;' id='columnname_select_box_" + id+"_"+name+ "' name='" + name + "[columnname][]' onchange='delete_column_value(" +id+ ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Column Name</option><option value='delete_by_column'>Delete By Column</option><option value='delete_by_name'>delete By Name</option></select>");
        } else if (delete_range_val == "range")
        {
            $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html(" ");
            $('#deletedata-delete-range-select-value-box-' + id+"-"+name).html("<div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Start Cell<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[from][]' value='' id='deletedata-from-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='deletedata-from-" + id+"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='from'>"+seloption +"</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Stop Cell<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:85%;' placeholder='' name='" + name + "[to][]' value='' id='deletedata-to-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='deletedata-to-" + id+"-"+name+ "' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='to'>"+seloption +"</select></div></div>");
        } else
        {
            $('#deletedata-delete-range-select-value-box-' + id+"-"+name).html(" ");
        }
    }
    validation_variable();
}
// end of delete range action type

// Add Button function in delete data 
function add_delete_data(name,type)
{
    var delete_data_excel = $("#data-count-"+name).attr("data-count");
    delete_data_excel = parseInt(delete_data_excel) + 1;
    $("#data-count-"+name).attr("data-count",delete_data_excel.toString());
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
    $(".section-delete-data-action-"+name).append("<div class='list-st' id='deletedata-box-" + delete_data_excel+"-"+name+ "'><div class='form-group show-me12'><div style='position: absolute;right: 0;z-index: 99;'><span class='pull-right' onclick='deletedata_variable("+delete_data_excel+",\""+name+"\");'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><label for='sel1' class='cell-po'>Actions<span style='color:red;'>*</span></label><select class='form-control mandatory_field' style='width: 100%;'' name='" + name + "[action][]' id='delete-data-action-" + delete_data_excel+"-"+name+ "' onchange='delete_data_action(" + delete_data_excel + ",\"" + name + "\",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Action Type</option><option value='delete_cell_value'>Delete Cell Value</option><option value='delete_range'>Delete Range</option></select></div><div class='show-me12' id='deletedata-cell-box-" + delete_data_excel+"-"+name+ "'></div><div class='show-me12' id='deletedata-delete-range-box-" + delete_data_excel+"-"+name + "'></div><div class='show-me12' id='deletedata-delete-range-select-value-box-" + delete_data_excel +"-"+name+ "'></div><div class='show-me12' id='deletedata-delete-range-select-column-value-box-" + delete_data_excel +"-"+name+ "'></div></div></div></div>");
validation_variable();
}
// end of Add Button function in delete data 

// Start delete function for Delete data
function deletedata_variable(k,name)
{
    $("#deletedata-box-" + k+"-"+name).remove();
}
// End of  delete function for Delete data

// start get column value in get range value
function get_column_value(id, checktype, actiontype , type)
{
    var get_column_val = actiontype;
    if (get_column_val != "")
    {
        var name = checktype;
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (get_column_val == "get_by_column")
        {
            $('#fetchdata-get-range-select-column-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:90%;' placeholder='' name='" + name + "[columnvalue][]' value='' id='fetchdata-columnvalue-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='fetchdata-columnvalue-" + id+"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='columnvalue'>"+seloption +"</select>");
        } else if (get_column_val == "get_by_name")
        {
           $('#fetchdata-get-range-select-column-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:90%;' placeholder='' name='" + name + "[columnvalue][]' value='' id='fetchdata-columnvalue-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='fetchdata-columnvalue-" + id+"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='columnvalue'>"+seloption +"</select>");
        }  else
        {
            $('#fetchdata-get-range-select-column-value-box-' + id+"-"+name).html(" ");
        }
    }
    validation_variable();
}
// end of get column value in get range value


// start delete column value in delete range value
function delete_column_value(id, checktype, actiontype, type)
{
    var delete_column_val = actiontype;
    if (delete_column_val != "")
    {
        var name = checktype;
        var seloption = "<option>Select Variable</option>";
        var arrval = "";
        $('input[name^="variablename"]').each(function () {
            arrval = $(this).val();
        });
        if (arrval != "")
        {
            var numbersArray = arrval.split(',');
            $.each(numbersArray, function (index, value)
            {
                seloption += "<option value=" + value + ">" + value + "</option>";
            });
        }
        if (delete_column_val == "delete_by_column")
        {
            $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:90%;' placeholder='' name='" + name + "[columnvalue][]' value='' id='deletedata-columnvalue-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='deletedata-columnvalue-" + id+"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='columnvalue'>"+seloption +"</select>");
        } else if (delete_column_val == "delete_by_name")
        {
           $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label><input type='text' class='form-control yes-var mandatory_field' style='width:90%;' placeholder='' name='" + name + "[columnvalue][]' value='' id='deletedata-columnvalue-" + id+"-"+name+ "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='deletedata-columnvalue-" + id+"-"+name+"' attr_handler='workbook' attr_handler_event='" + type + "' attr_handler_event_type='columnvalue'>"+seloption +"</select>");
        }  else
        {
            $('#deletedata-delete-range-select-column-value-box-' + id+"-"+name).html(" ");
        }
    }
    validation_variable();
}
// end of delete column value in delete range value

//Start of add url param button function 
function add_url_params_data_button(name,cname){
    var classname = cname;
    if (classname != "btn btn-primary")
    {
        $("#btn18-"+name).addClass("btn-primary");
        document.getElementById("post-url-key-value-"+name).style.display = "block";
    }
    else if(classname == "btn btn-primary")
    {
        $("#btn18-"+name).removeClass("btn-primary");
        document.getElementById("post-url-key-value-"+name).style.display = "none";
    }
    return false;
}
//end of of add url function 

//start of add url request div post
function add_url_params_data(name,type){
    url_key_total = parseInt(url_key_total) + 1;
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
    var url_key = name + "[url_key][]";
    var url_value = name + "[url_value][]";
    $(".section-post-url-action-"+name).append("<div class='col-md-12 list-st post-url-key-value-row-"+name+"' id='post-key-value-box-" + url_key_total+"-"+name+ "'><div class='row'><div class='col-md-12 '><div style='position: absolute;right: 10px;z-index: 99;'><span class='pull-right' onclick='delete_post_url_key_val(" + url_key_total+",\""+name+"\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><label for='sel1' class='cell-po' style='margin-top:0px !important;'>URL Parameter Key</label><input type='text' class='form-control' style='width:70%;'' placeholder='URL Parameter Key' name='" + name + "[url_key][]' value='' id='variablename-post-url-key-" + name + "-" + url_key_total + "'><select class='form-control appendVariable' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='urlkey' style='width: 5%;'   data-id='variablename-post-url-key-" + name + "-" + url_key_total + "'>" + seloption + "</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value</label><input type='text' class='form-control' style='width:70%;'' placeholder='Value' name='" + name + "[url_value][]' value='' id='variablename-post-url-value-" + name + "-" + url_key_total + "'><select class='form-control appendVariable' style='width: 5%;' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='urlvalue'  data-id='variablename-post-url-value-" + name + "-" + url_key_total + "'>" + seloption + "</select></div></div></div>");
    validation_variable();
    }
//end of add url request div post

// start of delete post function
function delete_post_url_key_val(k,name)
{
    $("#post-key-value-box-" + k+"-"+name).remove();
}
//end of delete post function

//start of header data button
function add_headers_data_button(name,cname)
{
    var classname = cname;
    if (classname != "btn btn-primary")
    {
        $("#btn24-"+name).addClass("btn-primary");
        document.getElementById("post-header-key-value-"+name).style.display = "block";
    } 
    else if (classname == "btn btn-primary")
    {
        $("#btn24-"+name).removeClass("btn-primary");
        document.getElementById("post-header-key-value-"+name).style.display = "none";
    }
    return false;
}
//End of header data button

//Start of ADD Header Params post function
function add_header_data(name,type) {
    header_key_total = parseInt(header_key_total) + 1;
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
    var header_key = name + "[header_key][]";
    var header_value = name + "[header_value][]";
    $(".section-post-header-action-"+name).append("<div class='col-md-12 list-st post-header-key-value-row-'"+name+" id='post-header-value-box-" + header_key_total+"-"+name+ "'><div class='row'><div class='col-md-12'><div style='position: absolute;right: 10px;z-index: 99;'><span class='pull-right' onclick='delete_post_header_key_val(" + header_key_total+",\""+name+"\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Header</label><input type='text' class='form-control' style='width:70%;'' placeholder='Header' name='" + name + "[header_key][]' value='' id='variablename-post-header-key-" + name + "-" + header_key_total + "'><select class='form-control appendVariable' style='width: 5%;' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='headerkey'  data-id='variablename-post-header-key-" + name + "-" + header_key_total + "'>" + seloption + "</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value</label><input type='text' class='form-control' style='width:70%;'' placeholder='Value' name='" + name + "[header_value][]' value='' id='variablename-post-header-value-" + name + "-" + header_key_total + "'><select class='form-control appendVariable' style='width: 5%;' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='headervalue'  data-id='variablename-post-header-value-" + name + "-" + header_key_total + "'>" + seloption + "</select></div></div></div>");
    validation_variable();
}
//end of ADD Header Params post function

//Start of Form-DATA function
function add_form_data(name,type) {
    form_key_total = parseInt(form_key_total) + 1;
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
    var form_key = name + "[form_key][]";
    var form_value = name + "[form_value][]";
    $(".section-post-form-action-"+name).append("<div class='col-md-12 list-st form-key-value-row' id='form-value-box-" + form_key_total+"-"+name+ "'><div class='row'><div class='col-md-12'><div style='position: absolute;right: 10px;z-index: 99;'><span class='pull-right' onclick='delete_form_key_val(" + form_key_total+",\""+name+"\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Key</label><input type='text' class='form-control' style='width:70%;'' placeholder='Key' name='" + name + "[form_key][]' value='' id='variablename-form-key-" + name + "-" + form_key_total + "'><select class='form-control appendVariable' style='width: 5%;' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='formkey'  data-id='variablename-form-key-" + name + "-" + form_key_total + "'>" + seloption + "</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value</label><input type='text' class='form-control' style='width:70%;' placeholder='Value' name='" + name + "[form_value][]' value='' id='variablename-form-value-" + name + "-" + form_key_total + "'><select class='form-control appendVariable' style='width: 5%;' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='formvalue'  data-id='variablename-form-value-" + name + "-" + form_key_total + "'>" + seloption + "</select></div></div></div>");
    validation_variable();
}
//End of Form-DATA function

// Start of form data  delete function
function delete_form_key_val(k,name)
{
    $("#form-value-box-" + k+"-"+name).remove();
}
// End of form data  delete function

//start of form data button
function add_form_data_type_button(name,cname,type)
{
    var classname = cname;
    form_key_total = parseInt(form_key_total) + 1;
    if(type=='form-data' && type !='')
    {  
        if (classname != "btn btn-primary")
        {
            $("#btn600-"+name).addClass("btn btn-primary");
            $("#btn601-"+name).removeClass("btn-primary");
            $("#btn602-"+name).removeClass("btn-primary");
            $('#raw-text-area-'+name).val(" ");
            $('#raw-dropdown-'+name).val(" ");
            $("#raw-dropdown-textarea-"+name).html(" ");
            document.getElementById("form-key-value-"+name).style.display = "block";
            $("#variablename-form-key-type-"+name).val(type);
        } 
        else if(classname == "btn btn-primary")
        {
            $("#btn600-"+name).removeClass("btn-primary");
            document.getElementById("form-key-value-"+name).style.display = "none";
        }  
    }
    else if(type=='x-www-form-urlencoded' && type !='')
    {
        if (classname != "btn btn-primary")
        {
            $("#btn601-"+name).addClass("btn btn-primary");
            $("#btn600-"+name).removeClass("btn-primary");
            $("#btn602-"+name).removeClass("btn-primary");
            $('#raw-text-area-'+name).val(" ");
            $('#raw-dropdown-'+name).val(" ");
            $("#raw-dropdown-textarea-"+name).html(" ");
            document.getElementById("form-key-value-"+name).style.display = "block";
            $("#variablename-form-key-type-"+name).val(type);
        } 
        else if (classname == "btn btn-primary")
        {
            $("#btn601-"+name).removeClass("btn-primary");
            document.getElementById("form-key-value-"+name).style.display = "none";
        }  
    }
     else if(type=='raw' && type !='')
    {
        if (classname != "btn btn-primary")
        {
            $("#raw-dropdown-textarea-"+name).html("");
            $("#btn602-"+name).addClass("btn btn-primary");
            $("#btn601-"+name).removeClass("btn-primary");
            $("#btn600-"+name).removeClass("btn-primary");
            $('#variablename-form-key-'+name+"-"+form_key_total).val(" ");
            $('#variablename-form-value-'+name+"-"+form_key_total).val(" ");
            document.getElementById("form-key-value-"+name).style.display = "none";
            $("#raw-dropdown-textarea-"+name).append(" <textarea rows='6' cols='100' class='form-control' style='width: 100%;' name='" + name + "[rawtext]' id='raw-text-area-"+name+"' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'></textarea><select class='form-control' style='width: 100%;'  name='" + name + "[raw]' id='raw-dropdown-"+name+"'  data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Type</option><option value='text'>Text</option><option >JSON</option><option value='xml'>XML</option><option value='html'>HTML</option></select>")
            $("#variablename-form-key-type-"+name).val(type);
        } 
        else if (classname == "btn btn-primary")
        {
            $("#btn602-"+name).removeClass("btn-primary");
            document.getElementById("form-key-value-"+name).style.display = "none";
        }  
    }
    return false;
}
//End of form data button


//Start of post  header key delete function
function delete_post_header_key_val(k,name)
{
    $("#post-header-value-box-" + k+"-"+name).remove();
}
//End  of post  header key delete function

//keyboard type on image
function add_keyboard_type_on_image_div(name,type)
{
    keybordvar = parseInt(keybordvar) + 1;
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
    var clicktype = name + "[clicktype][]";
    var path = name + "[path][]";
    var value = name + "[value][]";
    var x = '0';
    var y = '0';
    $(".section-type-on-image-action-"+name).append("<div class='list-st' id='keyboard-box-" + keybordvar+"-"+name+ "'><div style='position: absolute;right: 10px;z-index: 99;'><span class='pull-right' onclick='delete_keyboard_type_on_image(" + keybordvar +",\""+name+"\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Click Type<span class='red'>*</span></label><select class='form-control mandatory_field' style='width: 100%;' name='" + name + "[clicktype][]'  data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Click Type</option><option value='singleclick' <?php echo ($clicktype == 'singleclick') ? 'selected' : ''; ?>Single Click</option><option value='doubleclick' <?php echo ($clicktype == 'doubleclick') ? 'selected' : ''; ?>Double Click</option></select></div><div class='row'><div class='col-md-12' id='keyboard-path-box-"+ keybordvar+"-"+name+ "'><div class='row'><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Path</label><input type='text' class='form-control' style='width:80%;' placeholder='Key' name='" + name + "[path][]' value='' id='variablename-path-" + name + "-" + keybordvar + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-path-" + name + "-" + keybordvar + "' attr_handler='keyboard' attr_handler_event='" + type + "' attr_handler_event_type='path'>" + seloption + "</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value</label><input type='text' class='form-control' style='width:80%;' placeholder='Value' name='" + name + "[value][]' value='' id='variablename-value-" + name + "-" + keybordvar + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-value-" + name + "-" + keybordvar + "' attr_handler='keyboard' attr_handler_event='" + type + "' attr_handler_event_type='value'>" + seloption + "</select></div></div></div><div class='col-md-12'><div class='row'><div class='col-md-12'><div class='form-group'><label for='sel1' class='cell-po'>X-Location</label> <input type='text' value='0' name='" + name + "[x_loc][]' id='variablename-x-loc-" + name + "-" + keybordvar + "' style='width: 80%;' class='form-control variablename' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' style='width: 10%;' data-id='variablename-x-loc-" + name + "-" + keybordvar + "' attr_handler='keyboard' attr_handler_event='" + type + "' attr_handler_event_type='x_loc'>" + seloption + "</select></div></div><div class='col-md-12'><div class='form-group'><label for='sel1' class='cell-po'>Y-Location</label><input type='text' value='0' name='" + name + "[y_loc][]' id='variablename-y-loc-" + name + "-" + keybordvar + "' style='width: 80%;' class='form-control variablename' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' style='width: 10%;' data-id='variablename-y-loc-" + name + "-" + keybordvar + "' attr_handler='keyboard' attr_handler_event='" + type + "' attr_handler_event_type='y_loc'>" + seloption + "</select></div></div></div></div></div></div>");
    validation_variable();
}

//delete keyboard type on image
function delete_keyboard_type_on_image(k,name)
{
    $("#keyboard-box-"+k+"-"+name).remove();
}
//delete keyboard keystroke

/*Start of add OCR BUTTON */
function add_fetch_ocr_data(name,type) {
    total_variable_box = parseInt(total_variable_box) + 1;
    var name = name;
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
    var selectvaluename = name + "[text_box][]";
    $(".section-fetch-ocr-action-"+name).append("<div class='col-md-12 list-st' id='div-box-" + total_variable_box+"-"+name+ "'><div style='position: absolute;right: 0;z-index: 99;'><span class='pull-right' style='margin-right:10px;' onclick='delete_var_box(" + total_variable_box +",\""+name+"\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='row'><div class='col-sm-12'><label class='cell-po'>Field<span style='color:red;'>*</span></label><input type='text' name='" + name + "[variable_box][]' style='width: 85%;' id='new_var_box_" + total_variable_box+"_"+name+"' class='form-control yes-var mandatory_field' placeholder='' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' attr_handler='ocr' attr_handler_event='" + type + "' attr_handler_event_type='variablebox' style='width: 5%;' data-id='new_var_box_" + total_variable_box+"_"+name+"' >" + seloption + "</select></div><div class='col-sm-12'><label for='sel1' class='cell-po'>Label<span style='color:red;'>*</span></label><input type='text' name='" + selectvaluename + "' class='form-control width-100 mandatory_field' placeholder='' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'></div></div></div>");
    validation_variable();
}
/*End of add OCR BUTTON */

/*Start of Delete OCR BUTTON */
function delete_var_box(k,name)
{
    var name=name;
    $("#div-box-"+k+"-"+name).remove();
}
/*End of Delete OCR BUTTON */

/*Start of keyboard key stroke */
function add_keyboard_keystroke(name,type)
{
    keybord_keystroke = parseInt(keybord_keystroke) + 1;
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
    $(".section-next-action-"+name).append("<div id='keystroke-box-" + keybord_keystroke + "-" + name + "' class='list-st'><div style='position: absolute;right: 13px;top: 11px;z-index: 99;'><span class='pull-right' onclick='delete_keyboard_keystroke(" + keybord_keystroke + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group show-me12'><label for='sel1' class='cell-po'>Action<span style='color:red;'>*</span></label><select class='form-control mandatory_field actiontype' style='width: 100%;' name='" + name + "[action][]' onchange='actionType(\"" + name + "\"," + keybord_keystroke + ",this.value,\""+type+"\")' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><option value=''>Select Action Type</option><option value='type' <?php echo ($action == 'type') ? 'selected' : ''; ?>Type</option><option value='press' <?php echo ($action == 'press') ? 'selected' : ''; ?>Press</option><option value='command' <?php echo ($action == 'command') ? 'selected' : ''; ?>Command</option></select></div><div class='' id='keystroke-value-box-" + keybord_keystroke + "-" + name + "'></div><div class='' id='keystroke-count-box-" + keybord_keystroke + "-" + name + "'></div></div>");
    validation_variable();
}
/*End of keyboard key stroke */

/*Start of action type on keystroke */
function actionType(name, id, actionType,type)
{
    if (actionType != "")
    {
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
        $('#keystroke-value-box-' + id + "-" + name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label><input type='text' class='form-control mandatory_field yes-var' style='width:85%;' placeholder='Value' name='" + name + "[value][]' value='' id='variablename-value-" + name + "-" + id + "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-value-" + name + "-" + id + "' attr_handler='keyboard' attr_handler_event='" + type + "' attr_handler_event_type='value'>" + seloption + "</select>");
        $('#keystroke-count-box-' + id + "-" + name).html("");
        $('#keystroke-value-box-' + id + "-" + name).addClass('form-group show-me12');
        if (actionType == 'press')
        {
            $('#keystroke-count-box-' + id + "-" + name).html("<label for='sel1' class='cell-po' style='margin-top:0px !important;'>Number of Times[count]</label><input type='text' class='form-control yes-var' style='width:85%;' placeholder='Count' name='" + name + "[count][]' value='1' id='variablename-count-" + name + "-" + id + "' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-count-" + name + "-" + id + "' attr_handler='keyboard' attr_handler_event='" + type + "' attr_handler_event_type='count'>" + seloption + "</select>");
            $('#keystroke-count-box-' + id + "-" + name).addClass('form-group show-me12');
        } 
        else
        {
            $('#keystroke-count-box-' + id + "-" + name).html("");
        }
    } 
    else
    {
        $('#keystroke-value-box-' + id + "-" + name).html("");
        $('#keystroke-value-box-' + id + "-" + name).removeClass('form-group');
        $('#keystroke-count-box-' + id + "-" + name).html("");
        $('#keystroke-count-box-' + id + "-" + name).removeClass('form-group');
    }
    validation_variable();
}
/*End of action type on keystroke */

/*Start of Delete keystroke */
function delete_keyboard_keystroke(k, name)
{
    $("#keystroke-box-" + k + "-" + name).remove();
   
}
/*End of Delete keystroke */

/*Start of URL params Button in get */
function add_url_params_get_button(name,cname){
    var classname = cname;
    if (classname != "btn btn-primary")
    {
        $("#btn9-"+name).addClass("btn-primary");
        document.getElementById("url-key-value-"+name).style.display = "block";
    } 
    else if (classname == "btn btn-primary")
    {
        $("#btn9-"+name).removeClass("btn-primary");
        document.getElementById("url-key-value-"+name).style.display = "none";
    }
    return false;
}
/*End  of URL params Button in get */

/*Start of Header Button in get */
function add_headers_get_button(name,cname){
    var classname = cname;
    if (classname != "btn btn-primary")
    {
        $("#btn12-"+name).addClass("btn-primary");
        document.getElementById("header-key-value-"+name).style.display = "block";
    }
    else if (classname == "btn btn-primary")
    {
        $("#btn12-"+name).removeClass("btn-primary");
        document.getElementById("header-key-value-"+name).style.display = "none";
    }
    return false;
}
/*End of Header Button in get */

/*Start of add button  get handler */
function add_url_params_data_get(name,type){
        url_key_total = parseInt(url_key_total) + 1;
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
        var url_key = name + "[url_key][]";
        var url_value = name + "[url_value][]";
        $(".section-url-action-"+name).append("<div class='list-st col-md-12 url-key-value-row-"+name+"' id='key-value-box-" + url_key_total +"-"+name+"'><div class='row'><div class='col-md-12'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_url_key_val(" + url_key_total +",\""+name+"\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><label for='sel1' class='cell-po' style='margin-top:0px !important;'>URL Parameter Key</label><input type='text' class='form-control' style='width:70%;'' placeholder='URL Parameter Key' name='" + name + "[url_key][]' value='' id='variablename-url-key-" + name + "-" + url_key_total + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-url-key-" + name + "-" + url_key_total + "' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='url_key'>" + seloption + "</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value</label><input type='text' class='form-control' style='width:70%;'' placeholder='Value' name='" + name + "[url_value][]' value='' id='variablename-url-value-" + name + "-" + url_key_total + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-url-value-" + name + "-" + url_key_total + "' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='url_value'>" + seloption + "</select></div></div></div>");
     validation_variable();     
 }
/*End of add button  get handler */

/*Start of delete  button for  url get handler */
function delete_url_key_val(k,name)
{
    $("#key-value-box-"+k+"-"+name).remove();
}
/*End of delete button for  url  get handler */

/*Start of delete button header  get handler */
function delete_header_key_val(k,name)
{
    $("#header-value-box-"+k+"-"+name).remove();
}
/*End of delete button header  get handler */

/*Start of  header button  get handler */
function add_header_data_get(name,type) {
    header_key_total = parseInt(header_key_total) + 1;
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
    var header_key = name + "[header_key][]";
    var header_value = name + "[header_value][]";
    $(".section-header-action-"+name).append("<div class='col-md-12 list-st header-key-value-row-"+name+"' id='header-value-box-" + header_key_total+"-"+name+"'><div class='row'><div class='col-md-12'><div style='position: absolute;right: 10px;z-index: 99;'><span class='pull-right' onclick='delete_header_key_val(" + header_key_total +",\""+name+"\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Header</label><input type='text' class='form-control' style='width:70%;'' placeholder='Header' name='" + name + "[header_key][]' value='' id='variablename-header-key-" + name + "-" + header_key_total + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-header-key-" + name + "-" + header_key_total + "' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='header_key'>" + seloption + "</select></div><div class='col-md-12'><label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value</label><input type='text' class='form-control' style='width:70%;'' placeholder='Value' name='" + name + "[header_value][]' value='' id='variablename-header-value-" + name + "-" + header_key_total + "'><select class='form-control appendVariable' style='width: 5%;'  data-id='variablename-header-value-" + name + "-" + header_key_total + "' attr_handler='https' attr_handler_event='" + type + "' attr_handler_event_type='header_value'>" + seloption + "</select></div></div></div>");
    validation_variable();
    }
/*End of  header button  get handler */

/*Start of  Checkbox in  Check Attachment in Receivemail handler */
function checkAttachment(classid)
{
   if($('#attachment_received-'+classid).is(":checked"))
    {
        $("#attachment_received-checkbox-box-"+classid).css("display","block");
    }
    else
    {
        $("#attachment_received-checkbox-box-"+classid).css("display", "none");
    }
}
/*End of  Checkbox in Check Attachment in Receivemail handler */

/*Start of  Checkbox in  Check CallBack in Receivemail handler */
function checkCallBack(classid)
{
   if($('#check_callback_received-'+classid).is(":checked"))
    {
        $("#intends_callback-checkbox-box-"+classid).css("display","block");
    }
    else
    {
        $("#intends_callback-checkbox-box-"+classid).css("display", "none");
    }
}
/*End of  Checkbox in Check CallBack in Receivemail handler */

/*Start of add custom actions [Action 1] */
function add_custom_action1(name,type) {
    total_key_action1 = parseInt(total_key_action1) + 1;
    var name = name;
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
    $(".section-action1-action-"+name).append("<div class='col-md-12 list-st' id='div-box-" + total_key_action1+"-"+name+ "'><div style='position: absolute;right: 0;z-index: 99;'><span class='pull-right' style='margin-right:10px;' onclick='delete_var_box(" + total_key_action1 +",\""+name+"\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='row'><div class='col-sm-12'><label class='cell-po'>Field<span style='color:red;'>*</span></label><input type='text' name='" + name + "[key][]' style='width: 85%;' id='new_var_box_action1_" + total_key_action1+"_"+name+"' class='form-control yes-var mandatory_field' placeholder='' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' attr_handler='custom_actions' attr_handler_event='" + type + "' attr_handler_event_type='key' style='width: 5%;' data-id='new_var_box_action1_" + total_key_action1+"_"+name+"' >" + seloption + "</select></div><div class='col-sm-12'><label class='cell-po'>Value<span style='color:red;'>*</span></label><input type='text' name='" + name + "[value][]' style='width: 85%;' id='new_var_value_action1_" + total_key_action1+"_"+name+"' class='form-control yes-var mandatory_field' placeholder='' data-check='blank' data-error='This field is required' data-createform-id='" + name + "'><select class='form-control appendVariable' attr_handler='custom_actions' attr_handler_event='" + type + "' attr_handler_event_type='value' style='width: 5%;' data-id='new_var_value_action1_" + total_key_action1+"_"+name+"' >" + seloption + "</select></div></div></div>");
    validation_variable();
}
/*End of add custom actions [Action 1] */
/* function for if else action*/
function condition_val(condition,id)
{
    if(condition == 'is_empty')
    {
       $("#val2-"+id).css('display','none');
    }
    else if(condition == 'image_on_screen')
    {
       $("#val2-"+id).css('display','none');
    }
    else if(condition == 'is_not_empty')
    {
        $("#val2-"+id).css('display','none');
    }
    else
    {
        $("#val2-"+id).css('display','block'); 
    }
}
/*Start of text concatination */
function add_string2_text(name,type)
{
    string2_text = parseInt(string2_text) + 1;
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
    $(".add-select-variable-string2-"+name).append('<div id="string2-textbox-'+string2_text+'-'+name+'" class="list-st"><div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_string2_textbox(' + string2_text + ',\''+name+'\')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div><label for="sel1" class="cell-po">String to be appended<span style="color:red;">*</span></label><input type="text" value="" name="'+name+'[string2][]" id="variablename-string2-'+name+'-'+string2_text+'"  class="form-control variablename"/><select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="'+type+'" attr_handler_event_type="string"  data-id="variablename-string2-'+name+'-'+string2_text+'">'+seloption+'</select></div>');
    validation_variable();
}
/*End of text concatination */

/*Start of text concatination*/
function delete_string2_textbox(k,name)
{
    $("#string2-textbox-"+k+"-"+name).remove();
}
/*End of text concatination*/