<?php
/*Check User Permission*/
if(check_user_permission('rpa', 'configuration', 'all') != '1' || check_user_permission('rpa', 'configuration', 'view') != '1') {
    header("location:".site_url()."admin/404");
}
include_once("../../../global.php");
$listCount = 1;
is_user_logged_in();
check_user_permission_with_redirect("rpa", "configuration");
$companyData = get_company_data();
$id='';
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $id=$_GET['id'];
}
$icoarray = array("Application" => "#app", "Excel" => "#excel", "Exception Handling" => "flaticon-anonymous", "Wait" => "#time-1", "Clipboard" => "#survey", "Terminal" => "#process-1", "File Handle" => "", "File and Folder" => "#folder", "Execute Control" => "#process", "Mouse" => "#clicker", "Keyboard" => "#electronics", "Conditions" => "#user", "Loops" => "#refresh", "Sequences" => "flaticon-123", "Web" => "#www", "Variables" => "flaticon-variable", "Text" => "flaticon-paper", "OCR" => "#scanner", "Custom Action" => "flaticon-burger", "Arithmetic Operations" => "#formula", "Text Operation" => "#font", "Task List" => "#list-1", "Face Recognition" => "#face", "Mail" => "#mail", "Variable" => "#formula-1", "Popup" => "#internet", "API Handler" => "#api", "Date Handler" => "#calendar","Custom Actions" => "#api");
$childicoarray = array("launchapplication" => "#rocket", "getwindowname" => "#brands-and-logotypes","windowoperations" => "#microsoft","wait" => "#time-2", "waitforimage" => "#time-1", "copyfromvariable" => "#copy-option", "pastetovariable" => "#survey", "openterminal" => "#software", "executecommand" => "#null","copyfile" => "fa fa-file", "copyfolder" => "fa fa-folder-open", "stop" => "#stop", "pause" => "#pause","ifelse" => "#code", "while" => "#repeat", "foreach" => "#repeat", "openbrowser" => "#chrome", "getcontentlocation" => "#server", "webelement" => "#internet-1", "closebrowser" => "#close", "tabaction" => "#tab","assign" => "", "power" => "fa fa-superscript", "readtextfromimage" => "#news", "readtextfrompdf" => "#pdf", "fetchocrdata" => "#server", "findtextonscreen" => "#edit-tool", "textconcatenate" => "#font-1", "textlength" => "#edit-tools", "convertcase" => "#font-2", "textsplit" => "#text", "textslice" => "#text-1", "textremove" => "fa fa-text-height", "substring" => "fa fa-text-height", "replacesubstringintext" => "#replace", "findtextindex" => "#search", "texttrim" => "#null-1", "stringexistence" => "#json-file", "textbetweentext" => "#text-2", "generatedataset" => "#server", "starttraining" => "#teacher", "startrecognizing" => "#eye", "fetchfromlist" => "fa fa-bars", "fetchfromtable" => "fa fa-table", "fetchfromdictionary" => "fa fa-bars", "listoperations" => "#list", "tableoperations" => "#dictionary", "appendtodictionary" => "fa fa-bars", "sendmail" => "#send", "receivemail" => "#mail", "message" => "#mail-2", "inputbox" => "#input", "choicebox" => "#list-1", "fileexplorer" => "#folder-1", "get" => "#api-2", "post" => "#api-1", "click" => "#click", "move" => "#ui-1", "drag" => "#cursor", "scroll" => "#scroll", "keystroke" => "#keyboard", "typeonimage" => "#edit-tool", "fileactions" => '#document', "folderactions" => '#folder-1', "datetime" => '#calendar', "updatevariable" => "#system", "arithmeticequation" => "#data", "dictionaryoperations" => "#dictionary", "tableoperations" => "#grid", "excelactions" => "#repeat", "updatedata" => "#system", "fetchdata" => "#data", "deletedata" => "#ui", "action1" => "#one","action2" => "#two","action3" => "#three","action4" => "#four");
$childNameArray = array("launchapplication" => "Launch Application", "getwindowname" => "Get Window Name", "windowoperations" => "Window Operations","wait" => "Wait", "waitforimage" => "Wait For Image", "copyfromvariable" => "Copy from Variable", "pastetovariable" => "Paste to Variable", "openterminal" => "Open Terminal", "executecommand" => "Execute Command","stop" => "Stop", "pause" => "Pause","ifelse" => "If Else", "while" => "While", "foreach" => "For Each", "openbrowser" => "Open Browser","getcontentlocation" => "Get Content Location", "webelement" => "Web Element", "closebrowser" => "Close Browser", "tabaction" => "Tab Action","assign" => "Assign", "power" => "Power", "readtextfromimage" => "Read text from image", "readtextfrompdf" => "Read text from pdf", "fetchocrdata" => "Fetch OCR Data", "findtextonscreen" => "Find Text On Screen", "textconcatenate" => "Text Concatenate", "findtextindex" => "Find Text Index", "textlength" => "Text Length", "convertcase" => "Convert Case", "textsplit" => "Text Split", "textslice" => "Text Slice", "textremove" => "Text Remove", "substring" => "Sub String", "replacesubstringintext" => "Replace Sub String In Text", "findtext" => "Find Text", "texttrim" => "Text Trim", "textbetweentext" => "Text Between Text", "stringexistence" => "String Existence", "maximizewindow" => "Maximize Window", "generatedataset" => "Generate Dataset", "starttraining" => "Start Training", "startrecognizing" => "Start Recognizing", "fetchfromlist" => "Fetch From List", "fetchfromtable" => "Fetch From Table", "fetchfromdictionary" => "Fetch From Dictionary", "listoperations" => "List Operations", "tableoperations" => "Table Operations", "appendtodictionary" => "Append To Dictionary", "sendmail" => "Send Mail", "receivemail" => "Receive Mail", "message" => "Message", "inputbox" => "Input Box", "choicebox" => "Choice Box", "fileexplorer" => "File Explorer", "get" => "GET", "post" => "POST", "click" => "Click", "move" => "Move", "drag" => "Drag", "scroll" => "Scroll", "keystroke" => "Keystroke", "typeonimage" => "Type On Image", "fileactions" => "File Actions", "folderactions" => "Folder Actions", "datetime" => "Date Time", "updatevariable" => "Update Variable", "arithmeticequation" => "Arithmetic Equation", "dictionaryoperations" => "Dictionary Operations", "table_operations" => "table Operations", "excelactions" => "Excel Actions", "updatedata" => "Update Data", "fetchdata" => "Fetch Data", "deletedata" => "Delete Data", "action1" => "Action 1","action2" => "Action 2","action3" => "Action 3","action4" => "Action 4");
$childicojson = json_encode($childicoarray);
$taskList = "";
$taskId = "";
$variablelist = "";
$taskListName = "";
if (isset($_GET['id']) && $_GET['id'] != "") {
    $taskId = $_GET['id'];
    $middlejson = select_mongo("robotlist", array("_id" => new MongoId($_GET['id'])), array("nestable_structure", "variablelist"));
    $middlejson = add_id($middlejson, "id");
    $taskList = $middlejson[0]['nestable_structure'];
    $tempTaskList = json_decode($taskList, TRUE);
    #fetch the Robot name which are not defined in array
    if (!empty($tempTaskList)) {
        foreach ($tempTaskList as $val) {
            $temp_name_arr = explode('-', $val['id']);
            if (!empty($temp_name_arr)) {
                $temp_name = $temp_name_arr[0];
                if (!in_array($temp_name, array_keys($childNameArray))) {
                    $tmpmiddlejson = select_mongo("robotlist", array("_id" => new MongoId($temp_name_arr[1])), array("title"));
                    $tmpmiddlejson = add_id($tmpmiddlejson, "id");
                    $childNameArray[$temp_name] = ucwords($tmpmiddlejson[0]['title']);
                }
            }
        }
    }
    $variablelist = $middlejson[0]['variablelist'];
    $robotAssocation = select_mongo("robotlistAssociate", array("asid" => $_GET['id']), array("name"));
    $robotAssocation = add_id($robotAssocation, "id");
    $taskListName = $robotAssocation[0]['name'];
}
$childNameArray = json_encode($childNameArray);
$validationjsonArr = select_mongo("actionValidations", array());
$validationjsonArr = add_id($validationjsonArr, "id");
$validationjsonArr = json_encode($validationjsonArr[0]);
?>
<?php get_admin_header(); ?>
<div class="loader-img" id="loadertag" style="display: none;">
    <img src="<?php echo admin_assets_url() . "/img/loaders.gif"; ?>" class="i" />
</div>
<div style="display:none;" id="filediv"></div>
<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("configuration", "configuration"));
?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/css/bootstrap-clearmin.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/css/roboto.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/css/material-design.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/css/small-n-flat.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/css/style-new.css">
<link href="http://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/css/flaticon.css">

<script>
    var ui_url = '<?php echo ui_url(); ?>';
    var admin_ui_url = '<?php echo admin_ui_url(); ?>';
    var panelId = '<?php echo $_SESSION['user']['user_id']; ?>';
    var listCount = '<?php echo $listCount; ?>';
    var childicojson = '<?php echo $childicojson; ?>';
    var childNameArray = '<?php echo $childNameArray ?>';
    var validationjsonArr = jQuery.parseJSON('<?php echo $validationjsonArr ?>');
    var taskId = '<?php echo $taskId; ?>';
    var json = '<?php echo $taskList; ?>';
    var robot_id = '<?php echo $id; ?>';
     var newcreatetable="";
    var edit_counter = 0;
    //hide,show
    $(document).ready(function () {
        $(".click-section").click(function () {
            $(".show-section").slideToggle(800);
        });
         newcreatetable = $('#blacklistgrid').html();
    });

//for middle data append..
    var menu_drag_icon = 1;
    var counterfirst = 1;
    $(".middlelist").live("click",function()
     {
     var datacreateform=$(this).attr("data-createform");
     $(".dd-handle").removeClass("active-drag-menu");
     $(this).next(".dd-handle").addClass("active-drag-menu");
     $(".tab-pane").hide();
     //console.log($("#"+datacreateform).length);
     if($("#"+datacreateform).length=="0"){
     append_form(datacreateform);
     }
     $("#"+datacreateform).show();
     });


    function submittabledata(id, this_obj) {
        var this_field = $(this_obj);
        var formData = new FormData($('#' + id)[0]);
        $.ajax({
            url: admin_ui_url + "configuration/ajax/submit_table.php?type=getjson",
            data: formData,
            type: "POST",
            success: function (suc) {
                $('#'+id)[0].reset();
                var input_id = this_field.attr("data-id-table").split("-");
                $("#defaultval-" + input_id[1]).val(suc);
                var defaultvalarray = suc;
                var olddefaultvalarray=$("#variabledefaultarray").val();
                var prearrr =[];
                if(olddefaultvalarray!="")
                {
                    var newStr = olddefaultvalarray.slice(0,-1);
                    prearrr.push(newStr);
                    prearrr.push(defaultvalarray);
                    var finalvararr = prearrr.join("|");
                    $("#variabledefaultarray").val(finalvararr);
                }
                else
                {
                    $("#variabledefaultarray").val(defaultvalarray);
                }
                $('[pd-popup="popupTable"]').fadeOut(200);
            },
            cache: false,
            contentType: false,
            processData: false,
            error: function () {
                alert('error handing here');
            }
        });
    }
    var delStatus=0;
    function checkvariable(type) {
        var checkstatus = 0;
        if (type != "fun") {
            $('.variablecheck').each(function (event, element) {
                $(this).css('border-color', '');
                $(this).attr("title", "");
                if ($(this).val() == "") {
                    checkstatus = 1;
                    $(this).attr("title", "Please fill out this field");
                    $(this).css('border-color', 'red');
                }
            });
        }
        if (checkstatus == 0) {
            validation_variable();
        }
    }
    function validation_variable(count)
    {
    var namearray = [];
    var countarray = [];
    var typearray = [];
    var defaultvalarray = [];
        $('input[name^="variablename[]"]').each(function () {
            if ($(this).val() != "") {
                namearray.push($(this).val());
                countarray.push($(this).attr('id'));
                console.log( countarray);
            }
        });
        $('input[name^="variable_box[]"]').each(function () {
            if ($(this).val() != "") {
                namearray.push($(this).val());
            }
        });
        $('input[name^="url_key[]"]').each(function () {
            if ($(this).val() != "") {
                namearray.push($(this).val());
            }
        });
        $('select[name^="datatype[]"]').each(function () {
            //alert($(this).val());
            if ($(this).val() != "") {
                typearray.push($(this).val());
           var defaultvalarray = []; }

        });
        $('input[name^="defaultvariable[]"] , select[name^="defaultvariable[]"]').each(function () {
            defaultvalarray.push($(this).val());
        });
    if(count>0)
    {
        var index=countarray.indexOf('name-val-'+count);
       $('input[name^="variablename[]"]').each(function () {
           delete countarray[index];
           delete namearray[index];
        });
        $('input[name^="variable_box[]"]').each(function () {
           delete namearray[index];
        });
        $('input[name^="url_key[]"]').each(function () {
            delete namearray[index];
        });
        $('select[name^="datatype[]"]').each(function () {
          delete typearray[index];
        });
        $('input[name^="defaultvariable[]"] , select[name^="defaultvariable[]"]').each(function () {
            delete defaultvalarray[index];
        }); 
    }
        var length = namearray.length;
        if (length != "") {
            /*validate All Handlers dropdown*/
            var is_event_type_set = false;
            var attr_handler;
            var attr_handler_event;
            var attr_handler_event_type;
            $(".appendVariable").each(function () {
                is_event_type_set = false;
                attr_handler = $(this).attr('attr_handler');
                attr_handler_event = $(this).attr('attr_handler_event');
                attr_handler_event_type = $(this).attr('attr_handler_event_type');
                if (validationjsonArr[attr_handler]) {
                    if (validationjsonArr[attr_handler][attr_handler_event]) {
                        if (validationjsonArr[attr_handler][attr_handler_event]['validations'][attr_handler_event_type]) {
                            is_event_type_set = true;
                            var handler_validations_arr = validationjsonArr[attr_handler][attr_handler_event]['validations'][attr_handler_event_type];
                            var opt = "<option value=''>Select Variable</option>";
                            for (var i = 0; i < length; i++) {
                                if (jQuery.inArray(typearray[i], handler_validations_arr) !== -1) {
                                    opt += '<option value="' + namearray[i] + '">' + namearray[i] + '</option>';
                                }
                            }
                        }
                        $(this).html(opt);
                        var obj = [];
                        if (variable_box_josn != "") {
                            obj = JSON.parse(variable_box_josn);
                            $.each(obj, function (key, value) {
                                $("#new_var_box_" + key).val(value);
                            });
                        }
                    }
                }

                if (is_event_type_set == false) {
                    var opt = "<option value=''>Select Variable</option>";
                    for (var i = 0; i < length; i++) {
                        opt += '<option value="' + namearray[i] + '">' + namearray[i] + '</option>';
                    }
                    $(this).html(opt);
                }
            });
            //                var name = namearray[length - 1];
            //                if ($(".appendVariable").length > 0) {
            //                    var opt = "<option value=''>Select Variable</option>";
            //                    for (var i = 0; i < length; i++) {
            //                        opt += '<option value="' + namearray[i] + '">' + namearray[i] + '</option>';
            //                        $(".appendVariable").html(opt);
            //                    }
            //                    var obj = [];
            //                    if (variable_box_josn != "")
            //                    {
            //                        obj = JSON.parse(variable_box_josn);
            //                        $.each(obj, function (key, value) {
            //                            $("#new_var_box_" + key).val(value);
            //                        });
            //                    }
            //
            //                }

        }
        var length1 = namearray.length;
        if (length1 !== "")
        {
            if ($(".appendVariable1").length > 0)
            {
                var opt = "<option value=''>Select Variable</option>";
                for (var i = 0; i < length; i++)
                {
                    if (typearray[i] === 'number')
                    {
                        opt += '<option value="' + namearray[i] + '">' + namearray[i] + '</option>';
                    }
                    $(".appendVariable1").html(opt);
                }
            }
        }
        $("#variablenamearray").val(namearray);
        $("#variabletypearray").val(typearray);
        var finalvararr = defaultvalarray.join("|");
        $("#variabledefaultarray").val(finalvararr);
    }
    function append_form(param, index, taskId) {
        index = index || 0;
        $.ajax({
            url: admin_ui_url + "configuration/ajax/htmlform.php",
            data: {"index": index, "taskId": taskId, "type":param},
            type: "POST",
            async: false,
            success: function (suc) {
                $("#form-list").append(suc);
                $(".tab-pane").hide();
                $("#" + param).show();
                checkvariable('fun');
                $(".sortable").sortable();
                $(".sortable").disableSelection();
            }
        });
    }

    $("#btn3").live("click", function () {
        var checkstatus = 0;
        $('.variablecheck').each(function (event, element) {
            $(this).css('border-color', '');
            $(this).attr("title", "");
            if ($(this).val() == "") {
                checkstatus = 1;
                $(this).attr("title", "Please fill out this field");
                $(this).css('border-color', 'red');
            }
        });
        if (checkstatus == 0) {
            listCount++;
            $(".add-select-variable-value").append("<tr id='typecount-" + listCount + "'><td><input type='text' onchange ='checkvariable(\"page\");' id='name-val-"+listCount+"' name='variablename[]' class='form-control width-100 variablecheck' /></td><td><select class='form-control width-100 variablecheck' id='typeoption-" + listCount + "' name='datatype[]' onchange='data_type(this.value,this);'><option value='string'>Text</option><option value='number'>Number</option><option value='boolean'>Boolean</option><option value='datetime'>Date Time</option><option value='list'>List</option><option value='table'>Table</option></select></td><td class='typeoption-" + listCount + "'><input type='text' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100' onchange ='checkvariable(\"page\");' /></td><td style='font-size: 17px;cursor: pointer;'><i class='fa fa-trash' onclick='variable_del("+listCount+")'></i></td></tr>");
            
        }
    });
    function open_list_modal(t) {

        var append_list = "";
        var get_id = $(t).attr('id');
        var filedvalue = $(t).val();
        filedvalue = filedvalue.split(":");
        for (var i = 0; i < filedvalue.length; i++) {
            var count = i + 1;
            append_list += "<tr><td class='count-no td_count'>" + count + "</td><td><input type='text' value='" + filedvalue[i] + "' class='form-control td_count_value preventKeyPress' name='listArray[]' /></td><td class='count-no deletelist'><span><i class='fa fa-trash'></i></span></td></tr>";
        }
        if (append_list != "") {
            $(".appendtablelistdata").html("");
            $(".appendtablelistdata").html(append_list);
        }
        $("#list_button").attr("data-id-list", get_id);
        $('[pd-popup="popupNewlist"]').fadeIn(200);
    }

    function open_dictionary_modal(t) {
        
        var append_list = "";
        var get_id = $(t).attr('id');
        var filedvalue = $(t).val();
        filedvalue = filedvalue.split(":");
        for (var i = 0; i < filedvalue.length; i++) {
            var count = i + 1;
            append_list += "<tr><td class='count-no td_count'>" + count + "</td><td><input type='text' value='" + filedvalue[i] + "' class='form-control td_count_value' name='dictionaryArray[]' /></td><td><input type='text' value='" + filedvalue[i] + "' class='form-control td_count_value' name='dictionaryArray1[]' /></td><td class='count-no deletelist'><span><i class='fa fa-trash'></i></span></td></tr>";
        }
        if (append_list != "") {
            $(".append_table_dictionary_data").html("");
            $(".append_table_dictionary_data").html(append_list);
        }
        $("#dictionary_button").attr("data-id-dictionary", get_id);
        $('[pd-popup="popupNewDictionary"]').fadeIn(200);
    }
    function open_table_modal(t){
        var append_list = "";
        var get_id = $(t).attr('id');
        var filedvalue = $(t).val();
        try {
        var filedvalue = JSON.parse(filedvalue);
        if (filedvalue.length > 0) {
            append_list += "<tr class='add-select-variable-value-row-col' id='RowHeading'><th></th>";
            for (var i = 0; i < filedvalue[0].length; i++) {
                var counter = i + 1;
                var action_delete_column = "";
                if(i != 0) {
                    action_delete_column = "<span deta-col-id='col_" + i + "' class='deletetablecol'><i class='fa fa-trash'></i></span>";
                }
                if (filedvalue[0].length == counter) {
                    append_list += "<td class='col_" + i + "'><span class='tableheading'>" + counter + "</span>" + action_delete_column + "</td>";
                } else {
                    append_list += "<td class='col_" + i + "'><span class='tableheading'>" + counter + "</span>" + action_delete_column + "</td>";
                }
            }
            append_list += "</tr>";
        }
        for (var i = 0; i < filedvalue.length; i++) {
            var count = i + 1;
            append_list += "<tr class='add-select-variable-value-row-col-td tbl_row' id='Row" + count + "'>";
            if(count==1)
            {
                append_list += "<td class='count-no table-count'>" + count + "</td>";   }
            else
            {
                append_list += "<td class='count-no table-count'>" + count + "<span class='lastinfield deletetablerow'><i class='fa fa-trash'></i></span></td>";
            }
            for (var j = 0; j < filedvalue[i].length; j++) {
                append_list += "<td class='col_" + j + "'><input type='text' class='form-control trcounter preventKeyPress' value='" + filedvalue[i][j] + "' name='tabledata[" + i + "][]'/>";
                append_list += "";
                append_list += "</td>";
            }
            append_list += "</tr>";
        }
        $("#blacklistgrid").html("");
        $("#blacklistgrid").html(append_list);
        $("#table_list_button").attr("data-id-table", get_id);
        $('[pd-popup="popupTable"]').fadeIn(200);
        }
        catch(e){ $("#blacklistgrid").html(newcreatetable); $('[pd-popup="popupTable"]').fadeIn(200);}
    }
    function data_type(value, t) {
        var get_id = $(t).attr('id');
        var listCount = get_id.split("-");
        listCount = listCount[1];
        var htmlappend = "";
        if (value == "list") {
            htmlappend = "<input type='text' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100' onclick ='open_list_modal(this);' readonly />";
            $("." + get_id).html(htmlappend);
            $("#list_button").attr("data-id-list", get_id);
            $(".appendtablelistdata").html("");
            $(".appendtablelistdata").html("<tr><td class='count-no td_count'>1</td><td><input type='text' class='form-control td_count_value preventKeyPress' name='listArray[]' /></td><td class='count-no deletelist'><span><i class='fa fa-trash'></i></span></td></tr>");
            $('[pd-popup="popupNewlist"]').fadeIn(200);
        } else if (value == "dictionary") {
            htmlappend = "<input type='text' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100 variablecheck' onclick ='open_dictionary_modal(this);' readonly />";
            $("." + get_id).html(htmlappend);
            $("#dictionary_button").attr("data-id-dictionary", get_id);
            $(".append_table_dictionary_data").html("");
            $(".append_table_dictionary_data").html("<tr><td class='count-no_dictionary td_count_dictionary'>1</td><td><input type='text' class='form-control td_count_value' name='dictionaryArray[]' /></td><td><input type='text' class='form-control td_count_value' name='dictionaryArray1[]' /></td><td class='count-no delete_dictionary'><span><i class='fa fa-trash'></i></span></td></tr>");
            $('[pd-popup="popupNewDictionary"]').fadeIn(200);
        } else if (value == "table") {
            htmlappend = "<input type='text' style='cursor: pointer;' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100 variablecheck' onclick ='open_table_modal(this);' />";
            var vartype=$("#variabletypearray").val();
            var vararray =vartype.split(",");
            vararray[listCount-1]=value;
            $("#variabletypearray").val(vararray.toString());
            $("." + get_id).html(htmlappend); 
            $("#blacklistgrid").html(newcreatetable);
            $("#table_list_button").attr("data-id-table", get_id);
            $('[pd-popup="popupTable"]').fadeIn(200);
        } else if (value == "number") {
            htmlappend = "<input type='number' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100' onchange ='checkvariable(\"page\");' />";
            $("." + get_id).html(htmlappend);
        } else if (value == "boolean") {
            htmlappend = "<select name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100 variablecheck' onchange ='checkvariable(\"page\");'><option value='true'>True</option><option value='false'>False</option></select>";
            $("." + get_id).html(htmlappend);
            checkvariable('fun');
        } else if (value == "datetime") {
            htmlappend = "<input type='date' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100 variablecheck' onchange ='checkvariable(\"page\");' />";
            $("." + get_id).html(htmlappend);
        }else if (value == "password") {
            htmlappend = "<input type='password' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100' onchange ='checkvariable(\"page\");' />";
            $("." + get_id).html(htmlappend);
        }else {
            htmlappend = "<input type='text' name='defaultvariable[]' id='defaultval-" + listCount + "' class='form-control width-100 variablecheck' onchange ='checkvariable(\"page\");' />";
            $("." + get_id).html(htmlappend);
            $("#list_button").attr("data-id-list", "");
        }
        
        
    }
    
    /*Enter Attribute Key in input box on manual updation of next action*/
    $(document).on('click', '.enter_manual_next_action', function(event) {
        $(this).attr('attr_manual_next_action', 'true');
    });
    
    $("#btn-list").live("click", function () {
        var checkstatus = 0;
        $(".td_count_value").each(function () {
            $(this).css('border-color', '');
            if ($(this).val() == "") {
                checkstatus = 1;
                $(this).css('border-color', 'red');
            }
        });

        if (checkstatus == 0) {
            $(".add-select-variable-value-list").append("<tr><td class='count-no td_count'>1</td><td><input type='text' class='form-control td_count_value preventKeyPress' name='listArray[]' /></td><td class='count-no deletelist'><span><i class='fa fa-trash'></i></span></td></tr>");
            list_table();
        }

    });

    $("#btn-dictionary").live("click", function () {
        var checkstatus = 0;
        $(".td_count_value_dictionary").each(function () {
            $(this).css('border-color', '');
            if ($(this).val() == "") {
                checkstatus = 1;
                $(this).css('border-color', 'red');
            }
        });

        if (checkstatus == 0) {
            $(".add-select-variable-value-dictionary").append("<tr><td class='count-no td_count_dictionary'>1</td><td><input type='text' class='form-control td_count_value_dictionary' name='dictionaryArray[]' /></td><td><input type='text' class='form-control td_count_value_dictionary' name='dictionaryArray[]' /></td><td class='count-no delete_dictionary'><span><i class='fa fa-trash'></i></span></td></tr>");
            dictionary_table();
        }

    });

    function list_table() {
        var listcounter = 1;
        $(".td_count").each(function () {
            $(this).html(listcounter);
            listcounter++;
        });
    }

    function dictionary_table() {
        var dictionarycounter = 1;
        $(".td_count_dictionary").each(function () {
            $(this).html(dictionarycounter);
            dictionarycounter++;
        });
    }

    function submit_list(t) {
        var listappend = $(t).attr("data-id-list");
        var checkstatus = 0;
        $(".td_count_value").each(function () {
            $(this).css('border-color', '');
            if ($(this).val() == "") {
                //checkstatus=1;
                //$(this).css('border-color', 'red');
            }
        });
        if (checkstatus == 0) {
            var namearray = [];
            $('input[name^="listArray[]"]').each(function () {
                if ($(this).val() != "") {
                    namearray.push($(this).val());
                }
            });
            if (listappend != "") {
                listappend = listappend.split("-");
                $("#defaultval-" + listappend[1]).val(namearray.join(':'));
                $('[pd-popup="popupNewlist"]').fadeOut(200);
                checkvariable('fun');
            }
        }
    }

//submit dictionary variable
    function submit_dictionary(t) {
        var listappend1 = $(t).attr("data-id-dictionary");
        var checkstatus = 0;
        $(".td_count_value_dictionary").each(function () {
            $(this).css('border-color', '');
            if ($(this).val() == "") {
                //checkstatus=1;
                //$(this).css('border-color', 'red');
            }
        });
        if (checkstatus == 0) {
            var namearray = [];
            var namearray1 = [];
            $('input[name^="dictionaryArray[]"]').each(function () {
                if ($(this).val() != "") {
                    namearray.push($(this).val());
                }
            });
            $('input[name^="dictionaryArray1[]"]').each(function () {
                if ($(this).val() != "") {
                    namearray1.push($(this).val());
                }
            });
            if (listappend1 != "") {
                listappend1 = listappend1.split("-");
                $("#defaultval-" + listappend1[1]).val(namearray.join(':') + '|' + namearray1.join(':'));
                $('[pd-popup="popupNewDictionary"]').fadeOut(200);
                checkvariable('fun');
            }
        }
    }
///deletetablecol
    $(".deletetablecol").live("click", function () {
        var indexId = $(this).attr("deta-col-id");
        $('.' + indexId).remove();
        tableheadingcounter();
    });
    function tableheadingcounter() {
        $(".tableheading").each(function (index) {
            $(this).text(index + 1);
        });
    }
//deletetablerow
    $(".deletetablerow").live("click", function () {
        var removeId = $(this).parent().parent().attr("id");
        if(removeId!=="Row1")
        {
            
            $("#" + removeId).remove();
            tablecounter();
        }
    });

    $(".deletelist").live("click", function () {

        $(this).closest("tr").remove();
        list_table();


    });

    $(".delete_dictionary").live("click", function () {

        $(this).closest("tr").remove();
        dictionary_table();
    });

    $("#btn-row").live("click", function () {


        $(".add-select-variable-value-row").append("<tr><td class='count-no'>1</td><td><input type='text' class='form-control' placeholder='' /></td><td class='count-no'><span><i class='fa fa-trash'></i></span></td></tr>");
    });

    $("#btn-row-col").live("click", function () {


        $(".add-select-variable-value-row-col").append("<th>1</th>");
    });

    $("#btn-row-col").live("click", function () {


        $(".add-select-variable-value-row-col-td").append("<td><input type='text' class='form-control' placeholder=''></td>");
    });
    var countVar = "";
    countVar = 1;
    $("#btn1").live("click", function () {
        var name = $(this).attr("data-sum-id");
        var conditionid = $(this).attr("data-sum-id");
        name = name + '[sumvalue][]';
        //$(".add-variable");
        $(this).parent().parent().parent().append("<div class='form-group'><div class='col-sm-6'><input type='text' name='" + name + "' id='variablename-" + countVar + "-" + conditionid + "' class='form-control variablename'/></div><div class='col-sm-5'><select class='form-control appendVariable' data-id='variablename-" + countVar + "-" + conditionid + "'><option value=''>Select Variable</option></select></div><div class='col-sm-1'><i class='fa fa-minus add-element-button'></i></div></div>");
        countVar++;
        checkvariable('fun');

    });

    $(document).on("click", "#btn_add_failure_task", function() {
        var name = $(this).attr("data-type");
        var selectname = name + "[setvariablename][]";
        var selectvaluename = name + "[variablevalue][]";
        $(".add-select-variable").prepend("<div class='form-group section-failure'><div class='col-sm-6'><label class='cell-po'>Select</label><select class='form-control width-100' name='" + selectname + "'><option>Select</option><option value='wait_time'>Wait Time</option><option value='retry'>Retry</option><option value='next_action'>Next Action</option><option value='search_on_windows'>Search On Windows</option><option value='message_box'>message box</option></select></div><div class='col-sm-5'><label for='sel1' class='cell-po'>Value</label><input type='text' name='" + selectvaluename + "' class='form-control width-100' placeholder=''></div><div class='col-sm-1'><i class='fa fa-minus add-element-button transform-center btn_remove_failure_task'></i></div></div>");
    });
    
    $(document).on("click", ".btn_remove_failure_task", function() {
        $(this).parents('.section-failure').remove();
    });
//delete execute 
    function delete_execute_cmd(k, curObj)
    {
        curObj.parents('.parent_row_section').remove();
    }

//delete url request

//add command button

    function add_command_div(name,type, currObj)
    {
        cmd = parseInt(cmd) + 1;
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
       $(".section-execute-command-action-"+name).append("<div class='list-st parent_row_section'><div class='col-md-12' id='div-box-" + cmd + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_execute_cmd(" + cmd + ", $(this))'><i id='btn8' class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><label for='sel1' class='cell-po'>Command</label><br><input type='text'  name='" + name + "[cmd][]' id='variablename-executecommand1-" + name + "-" + cmd + "' style='width: 90%;' class='form-control variablename'/><select class='form-control appendVariable' attr_handler='terminal' attr_handler_event='" + type + "' attr_handler_event_type='command' style='width: 9%;' data-id='variablename-executecommand1-" + name + "-" + cmd + "'>" + seloption + "</select></div></div>");
    }
    
    //for submit form..
    function check_form_validation(type) {
        if ($("#nestable2").children().hasClass("dd-empty")) {
             $("#model_head").html("Error");
             $("#model_des").html(ui_string['nothingtosubmit']);
             $('[pd-popup="popupNew"]').fadeIn(200);
             $('.popup').find('.glyphicon-ok-circle').addClass('glyphicon-remove').removeClass('glyphicon-ok-circle').parent().css({'color':'red'});
        } else
        {
            $("#model_head").html("Confirmation");  
            $("#model_des").html("Confirmation Successful");
            $('.popup').find('.glyphicon-remove').addClass('glyphicon-ok-circle').removeClass('glyphicon-remove').parent().css({'color':'green'});
            var returncheck = check_validation('mandatory_field');
            if (returncheck == "0") {
                $('[pd-popup="popupNew1"]').fadeIn(200);
                $('#submit_type').val(type);
            } else {
                return false;
            }
        }

    }
    function submitdata() {
        $("#ecategoryname").html("");
        if ($("#categoryname").val() != "") {
            $("#loadertag").show();
            var title = $("#categoryname").val();
            var insertId = $("#insertId").val();
            var submit_type = $("#submit_type").val();
            if (insertId == undefined) {
                insertId = "";
            }

            $.ajax({
                type: "POST",
                url: admin_ui_url + "configuration/ajax/config.php?action=title",
                data: {"title": title, "insertId": insertId,"submit_type":submit_type},
                success: function (data)
                {
                    var data = data.trim();
                    if (data.trim() == '1')
                    {
                        submitform('save');
                    }
                    else if(data.trim() == '2')
                    {
                       submitform('export'); 
                    }
                    else
                    {
                        $("#loadertag").hide();
                        $("#categoryname").focus();
                        $("#ecategoryname").html("Title Is Already Exist!");
                        return false;
                    }

                }
            });

        } else {
            $("#categoryname").focus();
            $("#ecategoryname").html("Please Enter Title");
            return false;
        }
    }
    function submitform(submit_type) {
        var status = navigator.onLine;
        if(status==true)
        {
        var title = $("#categoryname").val();
        var id = $("#insertId").val();
        if (id == undefined) {
            id = "";
        }
        var manualnextactionarr = [];
        var formData = new FormData($('#form-list')[0]);
        $("input[attr_manual_next_action]").each( function (e) {
            manualnextactionarr.push($(this).attr('attr_class_id'));
        });
        formData.append('manualnextactionarr', JSON.stringify(manualnextactionarr));
        $.ajax({
            type: "POST",
            url: admin_ui_url + "configuration/ajax/submit.php?title=" + title + "&insertId=" + id+ "&submit_type=" + submit_type,
            data: formData,
            success: function (data)
            {
                var data = JSON.parse(data);
                $("#loadertag").hide();
                if(submit_type=='export')
                {
                    if (data['error_code'] == '201')
                    {

                            var res = data['data'].split("/");
                            var lastEl = res[res.length-1];
                            var anlink ='<a class="fileLink" id="fileLinkId" href="'+data['data']+'" download="'+lastEl+'">click here</a>';     
                            $("#filediv").html(anlink);
                            $(document).ready(function(){
                            $("#fileLinkId")[0].click();
                            $('[pd-popup="popupNew"]').fadeIn(200);
                            setTimeout(function () {
                                window.location = site_url + "admin/controlTower";
                            }, 1000);
                             });
                        }
                    }
                    if(submit_type=='save')
                    {
                        if (data['data'] == '3')
                        {
                            $("#model_head").html(ui_string['unsuccess']);
                            $("#model_des").html(ui_string['nothingtosubmit']);
                            $('[pd-popup="popupNew"]').fadeIn(200);
                            setTimeout(function () {
                                $('[pd-popup="popupNew"]').fadeOut(200);
                            }, 1000);
                        } else if (data['data'] == '117')
                        {
                            $("#model_head").html(ui_string['unsuccess']);
                            $("#model_des").html("Template name already exists");
                            $('[pd-popup="popupNew"]').fadeIn(200);
                            setTimeout(function () {
                                $('[pd-popup="popupNew"]').fadeOut(2000);
                            }, 2000);
                        } 
                        else
                        {
                            $('[pd-popup="popupNew"]').fadeIn(200);
                            setTimeout(function () {
                                window.location = site_url + "admin/controlTower?id=" + data['data'];
                            }, 1000);
                        }
                    }


                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (e) {
                    alert('error handing here');
                    $("#loadertag").hide();
                }
            });
        }
        else
        {
            alert('No Internet Connection Here');
            $("#loadertag").hide();
        }
    }

    $(".webelement_radio").live("click", function () {
        $("." + $(this).attr('data-class')).hide();
        $("#" + $(this).attr('data-id')).show();

    });
    $(".getcolumnradio").live("click", function () {

        $("." + $(this).attr('data-class')).hide();
        $("#" + $(this).attr('data-id')).show();

    });
    $(".webactionmode").live("click", function () {

        $("." + $(this).attr('data-class')).hide();
        if ($(this).val() != "next_tab") {
            $("." + $(this).attr('data-class')).show();
        }
    });

    $(".table_dropdown").live("change", function () {

        var optionType = $(this).val();
        $(".show-position-" + $(this).attr('data-id')).hide();
        $(".reverse-position-" + $(this).attr('data-id')).hide();
        $(".show-list-position-" + $(this).attr('data-id')).hide();
        if (optionType == "append") {
            $(".show-list-position-" + $(this).attr('data-id')).show();
        } else if (optionType == "insert") {
            $(".show-list-position-" + $(this).attr('data-id')).show();
            $(".show-position-" + $(this).attr('data-id')).show();
        } else if (optionType == "delete") {
            $(".show-position-" + $(this).attr('data-id')).show();
        } else if (optionType == "sort") {
            $(".reverse-position-" + $(this).attr('data-id')).show();
        }
    });
    $(".listoperations_dropdown").live("change", function () {
        var optionType = $(this).val();
        $(".listoperations-show-position-" + $(this).attr('data-id')).hide();
        $(".listoperations-reverse-position-" + $(this).attr('data-id')).hide();
        $(".listoperations-value-position-" + $(this).attr('data-id')).hide();
        if (optionType == "append") {
            $(".listoperations-value-position-" + $(this).attr('data-id')).show();
        } else if (optionType == "insert") {
            $(".listoperations-value-position-" + $(this).attr('data-id')).show();
            $(".listoperations-show-position-" + $(this).attr('data-id')).show();
        } else if (optionType == "delete") {
            $(".listoperations-show-position-" + $(this).attr('data-id')).show();
        } else if (optionType == "sort") {
            $(".listoperations-reverse-position-" + $(this).attr('data-id')).show();
        }
    });
    var countVars = "";
    countVars = 1;
    function add_message_fields(id, index,type) {
        var name = id;
        var conditionid = id;
        name = name + '[message][]';
        if (index == "1") {
            var className = "message_field_count_" + conditionid;
            var msg_count = $("." + className).length + 1;
            $("#inputbox-mode-" + id).val(msg_count);

        } else {
            var className = "message_field_count_" + conditionid;
            var msg_count = $("." + className).length + 1;
            $("#choicebox-mode-" + id).val(msg_count);

        }

        $(".section-input-box-action-" + id).append("<div class='show-me12 list-st' id='" + className + "'><div class='form-group'><div class='pull-right'><i class='add-element-button fa fa-minus remove_message_box' data-id='" + className + "' data-class='" + id + "'></i></div><label for='sel1' class='cell-po " + className + "'>Field-" + msg_count + "<span style='color:red;'>*</span></label></br><input type='text' name='" + name + "' id='variablename-msg-" + countVars + "-" + conditionid + "' style='width: 80%;' class='form-control variablename'/><select class='form-control appendVariable' attr_handler='popup' attr_handler_event='" + type + "' attr_handler_event_type='message' style='width: 9%;' data-id='variablename-msg-" + countVars + "-" + conditionid + "'><option value=''>Select Variable</option></select></div></div>");
        countVars++;
        checkvariable('fun');
        return false;
    }
    $(".remove_message_box").live("click", function (e) {
        var removeid_class = $(this).attr("data-class");
        var removeid = $(this).attr("data-id");
        var indexval = removeid_class.split("-");
        $(this).parents("#" + removeid).remove();
        if (indexval[0] == "inputbox") {
            var className = "message_field_count_" + removeid_class;
            $("." + className).each(function (i) {
                i=i+1;
                $(this).text("Field-" + i);
            });
            var msg_count = $("." + className).length;
            $("#inputbox-mode-" + removeid).val(msg_count);

        } else {
            var className = "message_field_count_" + removeid_class;
            $("." + className).each(function (i) {
                i=i+1;
                $(this).text("Field-" + i);
            });
            var msg_count = $("." + className).length;
            $("#choicebox-mode-" + removeid).val(msg_count);

        }
        e.preventDefault();
        return false;
    });
    /*$(".deletetab").live("click",function(event){
     event.stopImmediatePropagation();
     if($(this).siblings().hasClass("middlelist")){
     var removerightmenu=$(this).siblings().attr("data-createform");
     $("#"+removerightmenu).remove();
     }
     
     $(this).parent().remove(); 
     if($("#nestable2").children().children().length===0){
     $("#nestable2").html('<div class="dd-empty"></div>');
     }
     });*/


</script>  
<script>
</script>
<style>
    .err{
        color:red;
    }
    .red {
        color:red;
    }
    .error_color {
        background-color: #ff3b3b !important;
    }
    .loader-img{position: absolute;
                top: 0;
                z-index: 999;
                background-color: rgba(255,255,255,0.9);
                width: 100%;
                height: 100%;
    }
    .loader-img img{
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    .btn-default{
        line-height:auto;
    }
    #uploadjson{
        position: absolute;
        opacity: 0;
        font-size: 20px;
        width: 150px;
        top: inherit;
        right: inherit;
        cursor: pointer;
        z-index: 9999;
    }
</style>         

<?php get_admin_footer(); ?> 
<script type="text/javascript">
    $(".returntype_variable_opt").live("change", function () {
        var selected_value = this.value;
        var id = $(this).attr("data-id");
        var variableField = "returntype_variable_field_" + $(this).attr("data-id");
        var variableSelect = "returntype_variable_select_" + $(this).attr("data-id");
         if(selected_value != "json_response")
        {
            $('#path-to-key-get-'+classidcheck).val('');
        }
        if(selected_value == "message_box")
        {
            $('.msg_box').css('display','none');
        }
        else
        {
            $('.msg_box').css('display','block');
        }
        if (selected_value == "json") {
            $(".returntype_variable_path_to_key").css("display", "none");
            $("#" + variableField).text("Path");
            $("#" + variableSelect).html('<input type="text" name="' + id + '[variablename]" class="form-control width-100" placeholder="path">');
        } else if (selected_value == "message_box") {
            $("#" + variableField).text("");
            $("#" + variableSelect).html("");
            $(".returntype_variable_path_to_key").css("display", "none");
        }
        else if(selected_value == "json_response")
        {
            $(".returntype_variable_path_to_key").css("display", "block");
            $("#" + variableField).text("Variable");
            $("#" + variableSelect).html("<input type='text' name='" + id + "[variablename]' id='variablename-" + id + "' style='width: 75%;' class='form-control variablename'/><select class='form-control appendVariable' style='width: 21%;' data-id='variablename-" + id + "'><option value=''>Select Variable</option></select>");
        }
        else {
            $(".returntype_variable_path_to_key").css("display", "none");
            $("#" + variableField).text("Variable");
            $("#" + variableSelect).html("<input type='text' name='" + id + "[variablename]' id='variablename-" + id + "' style='width: 75%;' class='form-control variablename'/><select class='form-control appendVariable' style='width: 21%;' data-id='variablename-" + id + "'><option value=''>Select Variable</option></select>");
        }
        checkvariable('page');
    });
    $(".appendVariable").live("change", function () {
        var variablename = $(this).attr("data-id");
        var value = $(this).val();
        if (value != "") {
            value = "[var]" + value;
        }
        $("#" + variablename).val(value);
    });

    $(".appendVariableSplitby").live("change", function () {
        
        var variablename = $(this).attr("data-id");
        var variable_id = $(this).attr("data-class");
        var value = $(this).val();
        if(value == "custom")
        {
            $("#custom_check-"+variable_id).val("1");
        }
        else
        {
            $("#custom_check-"+variable_id).val("0");
            $("#variablename-custom-"+variable_id).val("");
        }
        $("#split-variable-splitby1-" + variable_id).hide();
        if (value == "space" || value == "enter" || value == "tab") {

        } else if (value == "custom") {
            $("#split-variable-splitby1-" + variable_id).show();
        }
        $("." + variablename).val(value);
        checkvariable('page');
    });
    $(".attachent_checkbox").live("change", function () {

        var attachent_checkbox_id = $(this).attr("id");
        var attach_id = $(this).attr("data-id");
        var data_show_id = $(this).attr("data-show-id");
        var assign_val = $('#' + attachent_checkbox_id).prop('checked');
        $("#" + data_show_id).hide();
        if (assign_val) {
            $("#" + data_show_id).show();
        }
        $("#" + attach_id).val(assign_val);
    });
    $(".option_receive_mail").live("change", function () {

        var receive_mail_id = $(this).attr("data-id");
        var receive_mail_val = $(this).val();
        $("#" + receive_mail_id).hide();
        if (receive_mail_val == "from" || receive_mail_val == "subject") {
            $("#" + receive_mail_id).show();
        }
    });
    $('#categoryname').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            submitdata();
            return false;
        }
    });
    //for mouse handler js

    $(document).ready(function () {
        $(document).on("keypress",".preventKeyPress",function(e) {
            if (e.which == 13)  // the enter key code
            {
                return false;
            }
        });

        if(robot_id!='')
        {
            $("#loadertag").show();
        }
        setTimeout(function () {
            var target = $('.targetClass').val();
            if (target == 'position')
            {
                $('#clickPath').hide();
                $('.clickPath').removeClass('mandatory_field');
            }
        if(robot_id!='')
        {
        $("#loadertag").hide();
        }
        }, 3000);

    });
 function variable_del(count)
 {
    delStatus++;
    if(delStatus==1)
    {
        alert("Deleting a variable will not remove use of variable in any field, user need to replace those fields manually.");
    }
    validation_variable(count);
    $("#typecount-"+count).remove();
 }
</script>
<script src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/jquery.mousewheel.min.js"></script>
<script src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/jquery.cookie.min.js"></script>
<script src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/fastclick.min.js"></script>
<script src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/clearmin.min.js"></script>
<script src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/demo/home.js"></script>
<script src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/custom.js"></script>
<script src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/control.js"></script>
<script src="<?php echo site_url() . "company/" ?>js/configuration/handlers.js"></script>
<script src="<?php echo site_url() . "company/" ?>js/configuration/handler.js"></script>
<script src="<?php echo site_url() . "company/" ?>js/configuration/email_handler.js"></script>
  
<script type="text/javascript">
// $(document).ready(function(){
// $('#cm-menu-scroller ul li a').click(function(){
// //alert('sj');
// $('.menu-comunicacao-sub').css({"display":"none"});
// $(this).next('.menu-comunicacao-sub').toggle();
// //$('#menu li ul').toggle();
// });
// });

</script>
<?php include('svgicons.php'); ?>
</body>
</html>
