//for changes in accrording to selection of dropdown in dictionary variable handler
function select_dictionary_type(val, classidcheck)
{
    if (val == 'fetch')
    {
        $('#appendDictionary_' + classidcheck).hide();
        $('.appendDictionary_' + classidcheck).removeClass('mandatory_field');
        $('.appendDictionary_' + classidcheck).val('');
        $('#deleteKey_' + classidcheck).hide();
        $('.deleteKey_' + classidcheck).removeClass('mandatory_field');
        $('.deleteKey_' + classidcheck).val('');

        $('#fetchList_' + classidcheck).show();
        $('.fetchList_' + classidcheck).addClass('mandatory_field');
    } else if (val == 'append')
    {
        $('#appendDictionary_' + classidcheck).show();
        $('.appendDictionary_' + classidcheck).addClass('mandatory_field');

        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');

        $('#deleteKey_' + classidcheck).hide();
        $('.deleteKey_' + classidcheck).removeClass('mandatory_field');
        $('.deleteKey_' + classidcheck).val('');
    } else if (val == 'delete')
    {
        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');

        $('#appendDictionary_' + classidcheck).hide();
        $('.appendDictionary_' + classidcheck).removeClass('mandatory_field');
        $('.appendDictionary_' + classidcheck).val('');

        $('#deleteKey_' + classidcheck).show();
        $('.deleteKey_' + classidcheck).addClass('mandatory_field');
    } else
    {
    }
}
//append add fetch list text box of dictionary variable handler
function add_fetch_list(name, type)
{
    fetch_list = parseInt(fetch_list) + 1;
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
    $(".section-fetch-dictionary-action-" + name).append("<div class='list-st' id='fetchList-box-" + fetch_list + "_" + name + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_fetch_list(" + fetch_list + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Key</label><br> <input type='text' value='' name='" + name + "[fetch_list][]' placeholder='Key' id='variablename-list1-" + name + "-" + fetch_list + "' style='width: 80%;' class='form-control variablename fetchListAppend_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='list' style='width: 10%;' data-id='variablename-list1-" + name + "-" + fetch_list + "'>" + seloption + "</select></div></div></div></div>");
}

//delete fetch list box of dictionary variable handler
function delete_fetch_list(k, name)
{
    $("#fetchList-box-" + k + "_" + name).remove();
}

//add append dictionary text box of dictionary variable handler
function add_append_dictionary(name, type)
{
    appendDictionary = parseInt(appendDictionary) + 1;
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
    $(".section-add-append-dictionary-action-" + name).append("<div class='list-st' id='appendDictionary-box-" + appendDictionary + "_" + name + "'><div style='position: absolute;right:11px;z-index: 99;'><span class='pull-right' onclick='delete_append_dictionary(" + appendDictionary + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Dictionary</label><br> <input type='text' value='' name='" + name + "[dictionary][]' placeholder='Dictionary' id='variablename-dictionary-" + name + "-" + appendDictionary + "' style='width: 80%;' class='form-control variablename fetchListAppend_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='dictionary' style='width: 10%;' data-id='variablename-dictionary-" + name + "-" + appendDictionary + "'>" + seloption + "</select></div></div></div></div>");
}
//delete dictionary box of dictionary variable handler
function delete_append_dictionary(k, name)
{
    console.log("#appendDictionary-box-" + k + "_" + name);
    $("#appendDictionary-box-" + k + "_" + name).remove();
}

//add delete keys text box of dictionary variable handler
function add_delete_keys(name, type)
{
    delete_keys = parseInt(delete_keys) + 1;
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
    $(".section-add-delete-keys-action-" + name).append("<div class='list-st' id='deleteKey-box-" + delete_keys + "_" + name + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_delete_keys(" + delete_keys + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Keys</label><br> <input type='text' value='' name='" + name + "[keys][]' placeholder='Keys' id='variablename-keys-" + name + "-" + delete_keys + "' style='width: 80%;' class='form-control variablename deleteKeyAppend_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='key' style='width: 10%;' data-id='variablename-keys-" + name + "-" + delete_keys + "'>" + seloption + "</select></div></div></div></div>");
}

//delete keys text box of dictionary variable handler
function delete_delete_keys(k, name)
{
    $("#deleteKey-box-" + k + "_" + name).remove();
}

//add table append list text box of table opeartion in variable handler
function add_table_append_list(name, type)
{
    table_append_list = parseInt(table_append_list) + 1;
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
    $(".section-table-append-list-action-" + name).append("<div class='list-st' id='table_append_list-box-" + table_append_list + "_" + name + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_table_append_list(" + table_append_list + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>List</label><br> <input type='text' value='' name='" + name + "[list][]' placeholder='List' id='variablename-table_list-" + name + "-" + table_append_list + "' style='width: 80%;' class='form-control variablename table_append_list_append_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='list' style='width: 10%;' data-id='variablename-table_list-" + name + "-" + table_append_list + "'>" + seloption + "</select></div></div></div></div>");
}

// delete append list box of table opeartion in variable handler
function delete_table_append_list(k, name)
{
    $("#table_append_list-box-" + k + "_" + name).remove();
}
//for changes in according to dropdown selection of table opeartion in variable handler
function select_table_type(val, classidcheck)
{
    if (val == 'append')
    {
        $('#insert_table_list_' + classidcheck).hide();
        $('.insert_table_list_' + classidcheck).removeClass('mandatory_field');
        $('.insert_table_list_' + classidcheck).val('');
        $('#table_delete_position_' + classidcheck).hide();
        $('.table_delete_position_' + classidcheck).removeClass('mandatory_field');
        $('.table_delete_position_' + classidcheck).val('');
        $('#fetchDropdown_' + classidcheck).hide();
        $('.fetchDropdown_' + classidcheck).removeClass('mandatory_field');
        $('.fetchDropdown_' + classidcheck).val('');
        $('#table_append_list_' + classidcheck).show();
        $('.table_append_list_' + classidcheck).addClass('mandatory_field');
        $('#fetchColumn_' + classidcheck).hide();
        $('.fetchColumn-' + classidcheck).removeClass('mandatory_field');
        $('#fetchRow_' + classidcheck).hide();
        $('.fetchRow-' + classidcheck).removeClass('mandatory_field');
    } else if (val == 'insert')
    {
        $('#table_append_list_' + classidcheck).hide();
        $('.table_append_list_' + classidcheck).removeClass('mandatory_field');
        $('.table_append_list_' + classidcheck).val('');
        $('#table_delete_position_' + classidcheck).hide();
        $('.table_delete_position_' + classidcheck).removeClass('mandatory_field');
        $('.table_delete_position_' + classidcheck).val('');
        $('#fetchDropdown_' + classidcheck).hide();
        $('.fetchDropdown_' + classidcheck).removeClass('mandatory_field');
        $('.fetchDropdown_' + classidcheck).val('');
        $('#insert_table_list_' + classidcheck).show();
        $('.insert_table_list_' + classidcheck).addClass('mandatory_field');
        $('#fetchColumn_' + classidcheck).hide();
        $('.fetchColumn-' + classidcheck).removeClass('mandatory_field');
        $('#fetchRow_' + classidcheck).hide();
        $('.fetchRow-' + classidcheck).removeClass('mandatory_field');
    } else if (val == 'fetch')
    {
        $('#fetchDropdown_' + classidcheck).show();
        $('.fetchDropdown_' + classidcheck).addClass('mandatory_field');
        $('#table_append_list_' + classidcheck).hide();
        $('.table_append_list_' + classidcheck).removeClass('mandatory_field');
        $('.table_append_list_' + classidcheck).val('');
        $('#insert_table_list_' + classidcheck).hide();
        $('.insert_table_list_' + classidcheck).removeClass('mandatory_field');
        $('.insert_table_list_' + classidcheck).val('');
        $('#table_delete_position_' + classidcheck).hide();
        $('.table_delete_position_' + classidcheck).removeClass('mandatory_field');
        $('.table_delete_position_' + classidcheck).val('');
        $('#fetchColumn_' + classidcheck).hide();
        $('.fetchColumn-' + classidcheck).removeClass('mandatory_field');
        $('#fetchRow_' + classidcheck).hide();
        $('.fetchRow-' + classidcheck).removeClass('mandatory_field');
    } else if (val == 'delete')
    {
        $('#table_append_list_' + classidcheck).hide();
        $('.table_append_list_' + classidcheck).removeClass('mandatory_field');
        $('.table_append_list_' + classidcheck).val('');
        $('#insert_table_list_' + classidcheck).hide();
        $('.insert_table_list_' + classidcheck).removeClass('mandatory_field');
        $('.insert_table_list_' + classidcheck).val('');
        $('#fetchDropdown_' + classidcheck).hide();
        $('.fetchDropdown_' + classidcheck).removeClass('mandatory_field');
        $('.fetchDropdown_' + classidcheck).val('');
        $('#table_delete_position_' + classidcheck).show();
        $('.table_delete_position_' + classidcheck).addClass('mandatory_field');
        $('#fetchColumn_' + classidcheck).hide();
        $('.fetchColumn-' + classidcheck).removeClass('mandatory_field');
        $('#fetchRow_' + classidcheck).hide();
        $('.fetchRow-' + classidcheck).removeClass('mandatory_field');
    } else
    {
        $('#table_append_list_' + classidcheck).hide();
        $('.table_append_list_' + classidcheck).removeClass('mandatory_field');
        $('.table_append_list_' + classidcheck).val('');
        $('#fetchDropdown_' + classidcheck).hide();
        $('.fetchDropdown_' + classidcheck).removeClass('mandatory_field');
        $('.fetchDropdown_' + classidcheck).val('');
        $('#insert_table_list_' + classidcheck).hide();
        $('.insert_table_list_' + classidcheck).removeClass('mandatory_field');
        $('.insert_table_list_' + classidcheck).val('');
        $('#table_delete_position_' + classidcheck).hide();
        $('.table_delete_position_' + classidcheck).removeClass('mandatory_field');
        $('.table_delete_position_' + classidcheck).val('');
        $('#fetchColumn_' + classidcheck).hide();
        $('.fetchColumn-' + classidcheck).removeClass('mandatory_field');
        $('#fetchRow_' + classidcheck).hide();
        $('.fetchRow-' + classidcheck).removeClass('mandatory_field');
    }
}

//add table insert list text box of table opeartion in variable handler
function add_insert_table_list(name, type)
{
    table_insert_list = parseInt(table_insert_list) + 1;
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
    $(".section-insert-table-list-action-" + name).append("<div class='list-st' id='insert_table_list-box-" + table_insert_list + "_" + name + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_table_insert_list(" + table_insert_list + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>List</label><br> <input type='text' value='' name='" + name + "[list][]' placeholder='List' id='variablename-list2-" + name + "-" + table_insert_list + "' style='width: 80%;' class='form-control variablename table_insert_list_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='list' style='width: 10%;' data-id='variablename-list2-" + name + "-" + table_insert_list + "'>>" + seloption + "</select></div></div></div></div>");
}

//delete table insert list box of table opeartion in variable handler
function delete_table_insert_list(k, name)
{
    $("#insert_table_list-box-" + k + "_" + name).remove();
}

//add table delete position text box of table opeartion in variable handler
function add_table_delete_position(name, type)
{
    table_delete_position = parseInt(table_delete_position) + 1;
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
    $(".section-table-delete-position-action-" + name).append("<div class='list-st' id='table_delete_position-box-" + table_delete_position + "_" + name + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_table_delete_position(" + table_delete_position + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Position</label><br> <input type='text' value='' name='" + name + "[position][]' placeholder='Position' id='variablename-position2-" + name + "-" + table_delete_position + "' style='width: 80%;' class='form-control variablename table_delete_position_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='position' style='width: 10%;' data-id='variablename-position2-" + name + "-" + table_delete_position + "'>" + seloption + "</select></div></div></div></div>");
}

//delete table delete position of table opeartion in variable handler
function delete_table_delete_position(k, name)
{
    $("#table_delete_position-box-" + k + "_" + name).remove();
}

//for changes in according to selection of mouse click handler
function selecetTarget(val, class_id) {
    if (val == 'image')
    {
        $('#clickPath-' + class_id).show();
        $('.clickPath-' + class_id).addClass('mandatory_field');
    } else
    {
        $('#clickPath-' + class_id).hide();
        $('.clickPath-' + class_id).removeClass('mandatory_field');
    }
}

//for changes in according to selection of mouse move handler
function select_target_click_move(val, class_id) {
    if (val == 'image')
    {
        $('#click_path_move_' + class_id).show();
        $('.click_path_move_' + class_id).addClass('mandatory_field');
    } else
    {
        $('#click_path_move_' + class_id).hide();
        $('.click_path_move_' + class_id).removeClass('mandatory_field');
    }
}

//for changes in according to selection of drag click handler
function select_target_click_drag(val, class_id) {
    if (val == 'image')
    {
        $('#click_path_from_drag_' + class_id).show();
        $('.click_path_from_drag_' + class_id).addClass('mandatory_field');
        $('#click_path_to_drag_' + class_id).show();
        $('.click_path_to_drag_' + class_id).addClass('mandatory_field');

    } else
    {
        $('#click_path_from_drag_' + class_id).hide();
        $('.click_path_from_drag_' + class_id).removeClass('mandatory_field');
        $('#click_path_to_drag_' + class_id).hide();
        $('.click_path_to_drag_' + class_id).removeClass('mandatory_field');
    }
}

//for changes in according to selection of mouse scroll handler
function select_target_click_scroll(val, class_id) {
    if (val == 'image')
    {
        $('#click_path_to_scroll_' + class_id).show();
        $('.click_path_to_scroll_' + class_id).addClass('mandatory_field');
    } else
    {
        $('#click_path_to_scroll_' + class_id).hide();
        $('.click_path_to_scroll_' + class_id).removeClass('mandatory_field');
    }
}

//end mouse handler js

//strt window operation js
//for changes in according to selection of window opeartion in application handler
function select_move_to(val, class_id) {
    if (val == 'move')
    {
        $('#move_to_' + class_id).show();
        $('.move_to_' + class_id).addClass('mandatory_field');
    } else
    {
        $('#move_to_' + class_id).hide();
        $('.move_to_' + class_id).removeClass('mandatory_field');
        $('.move_to_' + class_id).val('');
    }
}

//for changes in according to selection of dropdwon file actions in file & folder actions handler
function select_dropdown_file(val, classidcheck) {
    if (val == 'create' || val == 'open' || val == 'read' || val == 'delete')
    {
        $('#content_var_file_' + classidcheck).hide();
        $('.content_var_file_' + classidcheck).removeClass('mandatory_field');
        $('.content_var_file_' + classidcheck).val('');

        $('#mode_option_' + classidcheck).hide();
        $('.mode_option_' + classidcheck).removeClass('mandatory_field');
        $('.mode_option_' + classidcheck).val('');

        $('#path_option_file_' + classidcheck).hide();
        $('.path_option_file_' + classidcheck).removeClass('mandatory_field');
        $('.path_option_file_' + classidcheck).val('');

        $('#path_var_file_' + classidcheck).show();
        $('.path_var_file_' + classidcheck).addClass('mandatory_field');
    } else if (val == 'write')
    {
        $('#path_var_file_' + classidcheck).show();
        $('.path_var_file_' + classidcheck).addClass('mandatory_field');

        $('#content_var_file_' + classidcheck).show();
        $('.content_var_file_' + classidcheck).addClass('mandatory_field');

        $('#mode_option_' + classidcheck).show();
        $('.mode_option_' + classidcheck).addClass('mandatory_field');
    } else if (val == 'copy')
    {
        $('#path_var_file_' + classidcheck).hide();
        $('.path_var_file_' + classidcheck).removeClass('mandatory_field');
        $('.path_var_file_' + classidcheck).val('');

        $('#content_var_file_' + classidcheck).hide();
        $('.content_var_file_' + classidcheck).removeClass('mandatory_field');

        $('#mode_option_' + classidcheck).hide();
        $('.mode_option_' + classidcheck).removeClass('mandatory_field');

        $('#path_option_file_' + classidcheck).show();
        $('.path_option_file_' + classidcheck).addClass('mandatory_field');
    } else
    {
        $('#path_var_file_' + classidcheck).hide();
        $('.path_var_file_' + classidcheck).removeClass('mandatory_field');
        $('.path_var_file_' + classidcheck).val('');
    }
}

//for changes in according to selection of dropdwon folder actions in file & folder actions handler
function select_dropdown_folder(val, classidcheck) {
    if (val == 'open' || val == 'get contents' || val == 'delete')
    {
        $('#path_option_folder_' + classidcheck).hide();
        $('.path_option_folder_' + classidcheck).removeClass('mandatory_field');
        $('.path_option_folder_' + classidcheck).val('');

        $('#name_var_folder_' + classidcheck).hide();
        $('.name_var_folder_' + classidcheck).removeClass('mandatory_field');
        $('.name_var_folder_' + classidcheck).val('');

        $('#path_var_folder_' + classidcheck).show();
        $('.path_var_folder_' + classidcheck).addClass('mandatory_field');
    } else if (val == 'create')
    {
        $('#path_var_folder_' + classidcheck).show();
        $('.path_var_folder_' + classidcheck).addClass('mandatory_field');

        $('#path_option_folder_' + classidcheck).hide();
        $('.path_option_folder_' + classidcheck).removeClass('mandatory_field');
        $('.path_option_folder_' + classidcheck).val('');

        $('#name_var_folder_' + classidcheck).show();
        $('.name_var_folder_' + classidcheck).addClass('mandatory_field');
    } else if (val == 'copy')
    {
        $('#name_var_folder_' + classidcheck).hide();
        $('.name_var_folder_' + classidcheck).removeClass('mandatory_field');
        $('.name_var_folder_' + classidcheck).val('');

        $('#path_var_folder_' + classidcheck).hide();
        $('.path_var_folder_' + classidcheck).removeClass('mandatory_field');
        $('.path_var_folder_' + classidcheck).val('');

        $('#path_option_folder_' + classidcheck).show();
        $('.path_option_folder_' + classidcheck).addClass('mandatory_field');
    } else
    {
        $('#path_var_folder_' + classidcheck).hide();
        $('.path_var_folder_' + classidcheck).removeClass('mandatory_field');
        $('.path_var_folder_' + classidcheck).val('');
    }
}

//add more value text box of list operation in variable handler
function add_value_listopt(name, type)
{
    listvar = parseInt(listvar) + 1;
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
    $(".section-add-value-listopt-action-" + name).append("<div class='list-st' id='valuList-box-" + listvar + "_" + name + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_value_listopt(" + listvar + ",\"" + name + "\")'><i  class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Value</label><br> <input type='text' value='' name='" + name + "[value][]' placeholder='Value' id='variablename-value1-" + name + "-" + listvar + "' style='width: 80%;' class='form-control variablename valuelistAppend_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='value' style='width: 10%;' data-id='variablename-value1-" + name + "-" + listvar + "'>>" + seloption + "</select></div></div></div></div>");
}

//delete value text box of list operation in variable handler
function delete_value_listopt(k, name)
{
    $("#valuList-box-" + k + "_" + name).remove();
}
//add insert text box of list operation in variable handler
function add_insert_listopt(name, type)
{
    listvarInsert = parseInt(listvarInsert) + 1;
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
    $(".section-add-insert-listopt-action-" + name).append("<div class='list-st' id='valuelistInsert-box-" + listvarInsert + "_" + name + "'><div style='position: absolute;right: 11px;z-index: 99;'><span class='pull-right' onclick='delete_insert_listopt(" + listvarInsert + ",\"" + name + "\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Value</label><br> <input type='text' value='' name='" + name + "[value][]' placeholder='Value' id='variablename-value2-" + name + "-" + listvarInsert + "' style='width: 80%;' class='form-control variablename valuelistInsert_" + name + "' data-check='blank'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='value' style='width: 10%;' data-id='variablename-value2-" + name + "-" + listvarInsert + "'>" + seloption + "</select></div></div></div></div>");
}

//delete insert text box of list operation in variable handler
function delete_insert_listopt(k, name)
{
    $("#valuelistInsert-box-" + k + "_" + name).remove();
}

//add position text box of list operation in variable handler
function add_position(name, type)
{
    positionDelete = parseInt(positionDelete) + 1;
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
    $(".section-add-position-action-" + name).append("<div class='list-st' id='valuelistDelete-box-" + positionDelete + "_" + name + "'><div style='position: absolute;right:11px;z-index: 99;'><span class='pull-right' onclick='delete_position(" + positionDelete + ",\"" + name + "\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Position</label><br> <input type='text' value='' name='" + name + "[position][]' id='variablename-position-" + name + "-" + positionDelete + "' style='width: 80%;' class='form-control variablename valuelistInsert_" + name + "' data-check='blank' placeholder='Position'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='position' style='width: 10%;' data-id='variablename-position-" + name + "-" + positionDelete + "'>>" + seloption + "</select></div></div></div></div>");
}

//delete position text box of list operation in variable handler
function delete_position(k, name)
{
    $("#valuelistDelete-box-" + k + "_" + name).remove();
}

//for changes in accrording to selection of dropdown in list opeartion handler
function select_list_opt_type(val, classidcheck) {

    if (val == 'append')
    {
        $('#valuelistInsert_' + classidcheck).hide();
        $('#valuelistDelete_' + classidcheck).hide();
        $('.valuelistInsert_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistDelete_' + classidcheck).removeClass('mandatory_field');


        $('#valuelistAppend_' + classidcheck).show();
        $('.valuelistAppend_' + classidcheck).addClass('mandatory_field');
        $('.valuelistInsert_' + classidcheck).val('');
        $('.valuelistDelete_' + classidcheck).val('');

        $('#listIndex_' + classidcheck).hide();
        $('.listIndex_' + classidcheck).removeClass('mandatory_field');
        $('.listIndex_' + classidcheck).val('');

        $('#fetchSlice_' + classidcheck).hide();
        $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');
        $('.fetchSlice_' + classidcheck).val('');
        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');
        $('#listoperations_reverse_position_' + classidcheck).hide();
        $('.listoperations_reverse_position_' + classidcheck).val('');
        
        $("#opration_type_"+classidcheck).css("display","none");
        $('.opration_type_drop_' + classidcheck).removeClass('mandatory_field');
        $('.opration_type_drop_' + classidcheck).val('');
        
        $("#list2_"+classidcheck).css("display","none");
        $('.list2_data_'+classidcheck).removeClass('mandatory_field');
        $('.list2_data_'+classidcheck).val('');

    } else if (val == 'insert')
    {
        $('#valuelistInsert_' + classidcheck).show();
        $('.valuelistInsert_' + classidcheck).addClass('mandatory_field');

        $('#valuelistAppend_' + classidcheck).hide();
        $('#valuelistDelete_' + classidcheck).hide();
        $('.valuelistAppend_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistDelete_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistAppend_' + classidcheck).val('');
        $('.valuelistDelete_' + classidcheck).val('');


        $('#listIndex_' + classidcheck).hide();
        $('.listIndex_' + classidcheck).removeClass('mandatory_field');
        $('.listIndex_' + classidcheck).val('');

        $('#fetchSlice_' + classidcheck).hide();
        $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');
        $('.fetchSlice_' + classidcheck).val('');
        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');
        $('#listoperations_reverse_position_' + classidcheck).hide();
        $('.listoperations_reverse_position_' + classidcheck).val('');
        
        $("#opration_type_"+classidcheck).css("display","none");
        $('.opration_type_drop_' + classidcheck).removeClass('mandatory_field');
        $('.opration_type_drop_' + classidcheck).val('');
        
        $("#list2_"+classidcheck).css("display","none");
        $('.list2_data_'+classidcheck).removeClass('mandatory_field');
        $('.list2_data_'+classidcheck).val('');
    } else if (val == 'delete')
    {
        $('#valuelistDelete_' + classidcheck).show();
        $('.valuelistDelete_' + classidcheck).addClass('mandatory_field');

        $('#valuelistAppend_' + classidcheck).hide();
        $('.valuelistAppend_' + classidcheck).removeClass('mandatory_field');
        $('#valuelistInsert_' + classidcheck).hide();
        $('.valuelistInsert_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistInsert_' + classidcheck).val('');
        $('.valuelistAppend_' + classidcheck).val('');


        $('#listIndex_' + classidcheck).hide();
        $('.listIndex_' + classidcheck).removeClass('mandatory_field');
        $('.listIndex_' + classidcheck).val('');

        $('#fetchSlice_' + classidcheck).hide();
        $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');
        $('.fetchSlice_' + classidcheck).val('');
        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');
        $('#listoperations_reverse_position_' + classidcheck).hide();
        $('.listoperations_reverse_position_' + classidcheck).val('');
        
        $("#opration_type_"+classidcheck).css("display","none");
        $('.opration_type_drop_' + classidcheck).removeClass('mandatory_field');
        $('.opration_type_drop_' + classidcheck).val('');
        
        $("#list2_"+classidcheck).css("display","none");
        $('.list2_data_'+classidcheck).removeClass('mandatory_field');
        $('.list2_data_'+classidcheck).val('');
        
    } else if (val == 'sort')
    {
        $('#listoperations_reverse_position_' + classidcheck).show();

        $('#valuelistAppend_' + classidcheck).hide();
        $('.valuelistAppend_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistAppend_' + classidcheck).val('');

        $('#valuelistInsert_' + classidcheck).hide();
        $('.valuelistInsert_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistInsert_' + classidcheck).val('');

        $('#valuelistDelete_' + classidcheck).hide();
        $('.valuelistDelete_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistDelete_' + classidcheck).val('');


        $('#listIndex_' + classidcheck).hide();
        $('.listIndex_' + classidcheck).removeClass('mandatory_field');
        $('.listIndex_' + classidcheck).val('');

        $('#fetchSlice_' + classidcheck).hide();
        $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');
        $('.fetchSlice_' + classidcheck).val('');
        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');
        
        $("#opration_type_"+classidcheck).css("display","none");
        $('.opration_type_drop_' + classidcheck).removeClass('mandatory_field');
        $('.opration_type_drop_' + classidcheck).val('');
        
        $("#list2_"+classidcheck).css("display","none");
        $('.list2_data_'+classidcheck).removeClass('mandatory_field');
        $('.list2_data_'+classidcheck).val('');
    } else if (val == 'fetch')
    {

        $('#fetchList_' + classidcheck).show();
        $('.fetchList_' + classidcheck).addClass('mandatory_field');

        $('#valuelistAppend_' + classidcheck).hide();
        $('.valuelistAppend_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistAppend_' + classidcheck).val('');

        $('#valuelistInsert_' + classidcheck).hide();
        $('.valuelistInsert_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistInsert_' + classidcheck).val('');

        $('#valuelistDelete_' + classidcheck).hide();
        $('.valuelistDelete_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistDelete_' + classidcheck).val('');

        $('#listoperations_reverse_position_' + classidcheck).hide();
        $('.listoperations_reverse_position_' + classidcheck).val('');
        
        $("#opration_type_"+classidcheck).css("display","none");
        $('.opration_type_drop_' + classidcheck).removeClass('mandatory_field');
        $('.opration_type_drop_' + classidcheck).val('');
        
        $("#list2_"+classidcheck).css("display","none");
        $('.list2_data_'+classidcheck).removeClass('mandatory_field');
        $('.list2_data_'+classidcheck).val('');
    }
    else if (val == 'set_operation')
    {
        $("#opration_type_"+classidcheck).css("display","block");
        $('.operation_type_drop_'+classidcheck).addClass('mandatory_field');
        
        $("#list2_"+classidcheck).css("display","block");
        $('.list2_data_'+classidcheck).addClass('mandatory_field');
        
        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');
        $('#valuelistAppend_' + classidcheck).hide();
        $('.valuelistAppend_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistAppend_' + classidcheck).val('');

        $('#valuelistInsert_' + classidcheck).hide();
        $('.valuelistInsert_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistInsert_' + classidcheck).val('');

        $('#valuelistDelete_' + classidcheck).hide();
        $('.valuelistDelete_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistDelete_' + classidcheck).val('');

        $('#listoperations_reverse_position_' + classidcheck).hide();
        $('.listoperations_reverse_position_' + classidcheck).val('');
    }
    else
    {
        $('#valuelistAppend_' + classidcheck).hide();
        $('.valuelistAppend_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistAppend_' + classidcheck).val('');

        $('#valuelistInsert_' + classidcheck).hide();
        $('.valuelistInsert_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistInsert_' + classidcheck).val('');

        $('#valuelistDelete_' + classidcheck).hide();
        $('.valuelistDelete_' + classidcheck).removeClass('mandatory_field');
        $('.valuelistDelete_' + classidcheck).val('');

        $('#listoperations_reverse_position_' + classidcheck).hide();
        $('.listoperations_reverse_position_' + classidcheck).val('');

        $('#listIndex_' + classidcheck).hide();
        $('.listIndex_' + classidcheck).removeClass('mandatory_field');
        $('.listIndex_' + classidcheck).val('');


        $('#fetchSlice_' + classidcheck).hide();
        $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');
        $('.fetchSlice_' + classidcheck).val('');
        $('#fetchList_' + classidcheck).hide();
        $('.fetchList_' + classidcheck).removeClass('mandatory_field');
        $('.fetchList_' + classidcheck).val('');
        
        $("#opration_type_"+classidcheck).css("display","none");
        $('.opration_type_drop_' + classidcheck).removeClass('mandatory_field');
        $('.opration_type_drop_' + classidcheck).val('');
        
        $("#list2_"+classidcheck).css("display","none");
        $('.list2_data_'+classidcheck).removeClass('mandatory_field');
        $('.list2_data_'+classidcheck).val('');
    }
    validation_variable();
}

//for changes in accrording to selection of fetch dropdown in list operation handler
function selectFetchType(val, classidcheck)
{
    if (val == 'list')
    {
        $('#fetchSlice_' + classidcheck).hide();
        $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');

        $('#listIndex_' + classidcheck).show();
        $('.listIndex_' + classidcheck).addClass('mandatory_field');
        $('.fetchSlice_' + classidcheck).val('');
    } else if (val == 'slice')
    {

        $('#listIndex_' + classidcheck).hide();
        $('.listIndex_' + classidcheck).removeClass('mandatory_field');

        $('#fetchSlice_' + classidcheck).show();
        $('.fetchSlice_' + classidcheck).addClass('mandatory_field');
        $('.listIndex_' + classidcheck).val('');
    }

}

//for add list index text box in list operation handler
function add_list_index(name, type)
{
    list_index = parseInt(list_index) + 1;
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
    $(".section-add-list-index-action-" + name).append("<div class='list-st' id='listIndex-box-" + list_index + "_" + name + "'><div style='position: absolute;right:11px;z-index: 99;'><span class='pull-right' onclick='delete_list_index(" + list_index + ",\"" + name + "\")'><i class='add-element-button fa fa-minus' data-type='" + name + "'></i></span></div><div class='form-group'><label for='sel1' class='cell-po'>Index</label><br> <input type='text' value='' name='" + name + "[index][]' id='variablename-index-" + name + "-" + list_index + "' style='width: 80%;' class='form-control variablename listIndex_" + name + "' data-check='blank' placeholder='Index'  data-error='This field is required' data-createform-id='" + name + "'/><select class='form-control appendVariable' attr_handler='variable_handler' attr_handler_event='" + type + "' attr_handler_event_type='index' style='width: 10%;' data-id='variablename-index-" + name + "-" + list_index + "'>>" + seloption + "</select></div></div></div></div>");
}

//for delete list index text box in list operation handler
function delete_list_index(k, name)
{
    $("#listIndex-box-" + k + "_" + name).remove();
}
