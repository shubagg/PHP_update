//for edit time handler
edit_handler_data();
function edit_handler_data()
{
    if (taskId != '')
    {
        //for mouse click handler
        var target = $('.targetClass-' + classidcheck).val();
        if (target == 'position')
        {
            $('#clickPath-' + classidcheck).hide();
            $('.clickPath-' + classidcheck).removeClass('mandatory_field');
        }

        //for mouse move handler
        var target_class_move = $('.target_class_click_move_' + classidcheck).val();
        if (target_class_move == 'position')
        {
            $('#click_path_move_' + classidcheck).hide();
            $('.click_path_move_' + classidcheck).removeClass('mandatory_field');
        }

        //for mouse drag handler
        var target_class_click_drag = $('.target_class_click_drag_' + classidcheck).val();
        if (target_class_click_drag == 'position')
        {
            $('#click_path_from_drag_' + classidcheck).hide();
            $('.click_path_from_drag_' + classidcheck).removeClass('mandatory_field');

            $('#click_path_to_drag_' + classidcheck).hide();
            $('.click_path_to_drag_' + classidcheck).removeClass('mandatory_field');
        }

        //for mouse scroll handler
        var target_class_click_scroll = $('.target_class_click_scroll_' + classidcheck).val();
        if (target_class_click_scroll == 'position')
        {
            $('#click_path_to_scroll_' + classidcheck).hide();
            $('.click_path_to_scroll_' + classidcheck).removeClass('mandatory_field');
        }

        //for mouse window operation handler
        var action_to_window = $('.action_to_window_' + classidcheck).val();
        if (action_to_window != 'move')
        {
            $('#move_to_' + classidcheck).hide();
            $('.move_to_' + classidcheck).removeClass('mandatory_field');
        } else
        {
            $('#move_to_' + classidcheck).show();
            $('.move_to_' + classidcheck).addClass('mandatory_field');
        }

        //for file action handler
        var fileAction = $('.file_action_' + classidcheck).val();
        if (fileAction == 'create' || fileAction == 'open' || fileAction == 'read' || fileAction == 'delete')
        {
            $('#path_var_file_' + classidcheck).show();
            $('.path_var_file_' + classidcheck).addClass('mandatory_field');

            $('#content_var_file_' + classidcheck).hide();
            $('.content_var_file_' + classidcheck).removeClass('mandatory_field');

            $('#mode_option_' + classidcheck).hide();
            $('.mode_option_' + classidcheck).removeClass('mandatory_field');

            $('#path_option_file_' + classidcheck).hide();
            $('.path_option_file_' + classidcheck).removeClass('mandatory_field');

        } else if (fileAction == 'write')
        {
            $('#path_var_file_' + classidcheck).show();
            $('.path_var_file_' + classidcheck).addClass('mandatory_field');

            $('#content_var_file_' + classidcheck).show();
            $('.content_var_file_' + classidcheck).addClass('mandatory_field');

            $('#mode_option_' + classidcheck).show();
            $('.mode_option_' + classidcheck).addClass('mandatory_field');
        } else if (fileAction == 'copy')
        {
            $('#path_var_file_' + classidcheck).hide();
            $('.path_var_file_' + classidcheck).removeClass('mandatory_field');

            $('#path_option_file_' + classidcheck).show();
            $('.path_option_file_' + classidcheck).addClass('mandatory_field');

            $('#content_var_file_' + classidcheck).hide();
            $('.content_var_file_' + classidcheck).removeClass('mandatory_field');

            $('#mode_option_' + classidcheck).hide();
            $('.mode_option_' + classidcheck).removeClass('mandatory_field');
        } else
        {
            $('#path_var_file_' + classidcheck).hide();
            $('.path_var_file_' + classidcheck).removeClass('mandatory_field');
            $('.path_var_file_' + classidcheck).val('');
        }

        //for forlder action handler
        var folderAction = $('.folder_action_' + classidcheck).val();
        if (folderAction == 'open' || folderAction == 'get contents' || folderAction == 'delete')
        {
            $('#path_option_folder_' + classidcheck).hide();
            $('.path_option_folder_' + classidcheck).removeClass('mandatory_field');

            $('#name_var_folder_' + classidcheck).hide();
            $('.name_var_folder_' + classidcheck).removeClass('mandatory_field');

            $('#path_var_folder_' + classidcheck).show();
            $('.path_var_folder_' + classidcheck).addClass('mandatory_field');
        } else if (folderAction == 'create')
        {
            $('#path_var_folder_' + classidcheck).show();
            $('.path_var_folder_' + classidcheck).addClass('mandatory_field');

            $('#path_option_folder_' + classidcheck).hide();
            $('.path_option_folder_' + classidcheck).removeClass('mandatory_field');

            $('#name_var_folder_' + classidcheck).show();
            $('.name_var_folder_' + classidcheck).addClass('mandatory_field');

        } else if (folderAction == 'copy')
        {
            $('#name_var_folder_' + classidcheck).hide();
            $('.name_var_folder_' + classidcheck).removeClass('mandatory_field');

            $('#path_var_folder_' + classidcheck).hide();
            $('.path_var_folder_' + classidcheck).removeClass('mandatory_field');

            $('#path_option_folder_' + classidcheck).show();
            $('.path_option_folder_' + classidcheck).addClass('mandatory_field');
        } else
        {

        }

        //for list operation
        var listoperations_dropdown = $('.listoperations_dropdown_' + classidcheck).val();
        var fetchVal = $('.fetchList_' + classidcheck).val();
        if (listoperations_dropdown == 'append')
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
            
            $("#opration_type_"+classidcheck).css("display","none");
            $('.operation_type_drop_'+classidcheck).removeClass('mandatory_field');
            $('.operation_type_drop_'+classidcheck).val('');
            
            $("#list2_"+classidcheck).css("display","none");
            $('.list2_data_'+classidcheck).removeClass('mandatory_field');
            $('.list2_data_'+classidcheck).val('');
            
            $('#listoperations_reverse_position_' + classidcheck).hide();
        } else if (listoperations_dropdown == 'insert')
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
            
            $("#opration_type_"+classidcheck).css("display","none");
            $('.operation_type_drop_'+classidcheck).removeClass('mandatory_field');
            $('.operation_type_drop_'+classidcheck).val('');
            
            $("#list2_"+classidcheck).css("display","none");
            $('.list2_data_'+classidcheck).removeClass('mandatory_field');
            $('.list2_data_'+classidcheck).val('');
            
            $('#listoperations_reverse_position_' + classidcheck).hide();
        } else if (listoperations_dropdown == 'delete')
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
            
            $("#opration_type_"+classidcheck).css("display","none");
            $('.operation_type_drop_'+classidcheck).removeClass('mandatory_field');
            $('.operation_type_drop_'+classidcheck).val('');
            
            $("#list2_"+classidcheck).css("display","none");
            $('.list2_data_'+classidcheck).removeClass('mandatory_field');
            $('.list2_data_'+classidcheck).val('');
        } else if (listoperations_dropdown == 'sort')
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
            $('.fetchList_' + classidcheck).val('')
            
            $("#opration_type_"+classidcheck).css("display","none");
            $('.operation_type_drop_'+classidcheck).removeClass('mandatory_field');
            $('.operation_type_drop_'+classidcheck).val('');
            
            $("#list2_"+classidcheck).css("display","none");
            $('.list2_data_'+classidcheck).removeClass('mandatory_field');
            $('.list2_data_'+classidcheck).val('');

        } else if (listoperations_dropdown == 'fetch')
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
            
            $("#opration_type_"+classidcheck).css("display","none");
            $('.operation_type_drop_'+classidcheck).removeClass('mandatory_field');
            $('.operation_type_drop_'+classidcheck).val('');
            
            $("#list2_"+classidcheck).css("display","none");
            $('.list2_data_'+classidcheck).removeClass('mandatory_field');
            $('.list2_data_'+classidcheck).val('');

            $('#listoperations_reverse_position_' + classidcheck).hide();
            if (fetchVal == 'list')
            {
                $('#listIndex_' + classidcheck).show();
                $('.listIndex_' + classidcheck).addClass('mandatory_field');

                $('#fetchSlice_' + classidcheck).hide();
                $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');

            } else
            {
                $('#fetchSlice_' + classidcheck).show();
                $('.fetchSlice_' + classidcheck).addClass('mandatory_field');
                $('#listIndex_' + classidcheck).hide();
                $('.listIndex_' + classidcheck).removeClass('mandatory_field');

            }
        } 
        else if(listoperations_dropdown == 'set_operation')
        {
            $("#opration_type_"+classidcheck).css("display","block");
            $('.operation_type_drop_'+classidcheck).addClass('mandatory_field');
            
            $("#list2_"+classidcheck).css("display","block");
            $('.list2_data_'+classidcheck).addClass('mandatory_field');
            
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

            $('#listIndex_' + classidcheck).hide();
            $('.listIndex_' + classidcheck).removeClass('mandatory_field');
            $('.listIndex_' + classidcheck).val('');


            $('#fetchSlice_' + classidcheck).hide();
            $('.fetchSlice_' + classidcheck).removeClass('mandatory_field');
            $('.fetchSlice_' + classidcheck).val('');
            $('#fetchList_' + classidcheck).hide();
            $('.fetchList_' + classidcheck).removeClass('mandatory_field');
            $('.fetchList_' + classidcheck).val('');
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
            $('.operation_type_drop_'+classidcheck).removeClass('mandatory_field');
            $('.operation_type_drop_'+classidcheck).val('');
            
            $("#list2_"+classidcheck).css("display","none");
            $('.list2_data_'+classidcheck).removeClass('mandatory_field');
            $('.list2_data_'+classidcheck).val('');
        }

        //for table operation
        var table_operations_dropdown = $('.table_operations_dropdown_' + classidcheck).val();
        if (table_operations_dropdown == 'append')
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
        } else if (table_operations_dropdown == 'insert')
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
        } else if (table_operations_dropdown == 'fetch')
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
            //var fetchDropdown = $('.fetchDropdown_' + classidcheck).val();
            //select_table_fetch_type(fetchDropdown, classidcheck);
        } else if (table_operations_dropdown == 'delete')
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
        }

        //for dictionary operation
        var dictionary_operations_dropdown = $('.dictionary_operations_dropdown_' + classidcheck).val();
        if (dictionary_operations_dropdown == 'fetch')
        {
            $('#appendDictionary_' + classidcheck).hide();
            $('.appendDictionary_' + classidcheck).removeClass('mandatory_field');
            $('.appendDictionary_' + classidcheck).val('');
            $('#deleteKey_' + classidcheck).hide();
            $('.deleteKey_' + classidcheck).removeClass('mandatory_field');
            $('.deleteKey_' + classidcheck).val('');

            $('#fetchList_' + classidcheck).show();
            $('.fetchList_' + classidcheck).addClass('mandatory_field');
        } else if (dictionary_operations_dropdown == 'append')
        {
            $('#appendDictionary_' + classidcheck).show();
            $('.appendDictionary_' + classidcheck).addClass('mandatory_field');

            $('#fetchList_' + classidcheck).hide();
            $('.fetchList_' + classidcheck).removeClass('mandatory_field');
            $('.fetchList_' + classidcheck).val('');

            $('#deleteKey_' + classidcheck).hide();
            $('.deleteKey_' + classidcheck).removeClass('mandatory_field');
            $('.deleteKey_' + classidcheck).val('');
        } else if (dictionary_operations_dropdown == 'delete')
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
}

//for changes in according to fetch type dropdown of table opeartion in variable handler
function select_table_fetch_type(name, id, val,type)
{
     if (val != "")
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
        if (val == 'row')
        {
            $('#fetchRow_' + id + "_" + name).html('<label>Row<span style="color:red;">*</span></label><br><input type="text" value="" name="'+name+'[row][]" id="variablename-row-'+name+'-'+id+'" style="width: 75%;" class="form-control fetchRow-'+name+'" placeholder="Row" data-check="blank"   data-error="This field is required" data-createform-id="'+name+'"><select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="'+type +'" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-row-'+name+'-'+id+'">'+seloption+'</select>');
        $('#fetchColumn_' + id + "_" + name).html("");
        $('#fetchRow_' + id + "_" + name).addClass('form-group show-me12');
        $('#fetchKey_' + id + "_" + name).html("");
        $('#fetchValue_' + id + "_" + name).html("");
        $('#fetchKey_' + id + "_" + name).removeClass('form-group show-me12');
        $('#fetchValue_' + id + "_" + name).removeClass('form-group show-me12');
        $('#fetchColumn_' + id + "_" + name).removeClass('form-group show-me12');
        } else if (val == 'column')
        {
            $('#fetchColumn_' + id + "_" + name).html('<label>Column<span style="color:red;">*</span></label><br><input type="text" value="" name="'+name+'[column][]" id="variablename-column-'+name+'-'+id+'" style="width: 75%;" class="form-control fetchRow-'+name+'" placeholder="Column" data-check="blank"   data-error="This field is required" data-createform-id="'+name+'"><select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="'+type +'" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-column-'+name+'-'+id+'">'+seloption+'</select>');
            $('#fetchRow_' + id + "_" + name).html("");
            $('#fetchColumn_' + id + "_" + name).addClass('form-group show-me12');
            $('#fetchKey_' + id + "_" + name).html("");
            $('#fetchValue_' + id + "_" + name).html("");
            $('#fetchKey_' + id + "_" + name).removeClass('form-group show-me12');
            $('#fetchValue_' + id + "_" + name).removeClass('form-group show-me12');
             $('#fetchRow_' + id + "_" + name).removeClass('form-group show-me12');
        } else if (val == 'element')
        { 
            $('#fetchKey_' + id + "_" + name).html('<label>Row<span style="color:red;">*</span></label><br><input type="text" value="" name="'+name+'[key][]" id="variablename-key-'+name+'-'+id+'" style="width: 75%;" class="form-control fetchRow-'+name+'" placeholder="Row" data-check="blank"   data-error="This field is required" data-createform-id="'+name+'"><select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="'+type +'" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-key-'+name+'-'+id+'">'+seloption+'</select>');
            $('#fetchValue_' + id + "_" + name).html('<label>Column<span style="color:red;">*</span></label><br><input type="text" value="" name="'+name+'[value][]" id="variablename-value-'+name+'-'+id+'" style="width: 75%;" class="form-control fetchRow-'+name+'" placeholder="Column" data-check="blank"   data-error="This field is required" data-createform-id="'+name+'"><select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="'+type +'" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-value-'+name+'-'+id+'">'+seloption+'</select>');
            $('#fetchKey_' + id + "_" + name).addClass('form-group show-me12');
            $('#fetchValue_' + id + "_" + name).addClass('form-group show-me12');
            $('#fetchColumn_' + id + "_" + name).html("");
            $('#fetchRow_' + id + "_" + name).html("");
            $('#fetchColumn_' + id + "_" + name).removeClass('form-group show-me12');
            $('#fetchRow_' + id + "_" + name).removeClass('form-group show-me12');
        }
        else
        {
            $('#fetchColumn_' + id + "_" + name).html("");
            $('#fetchRow_' + id + "_" + name).html("");
            $('#fetchKey_' + id + "_" + name).html("");
            $('#fetchValue_' + id + "_" + name).html("");
            $('#fetchColumn_' + id + "_" + name).removeClass('form-group show-me12');
            $('#fetchRow_' + id + "_" + name).removeClass('form-group show-me12');
            $('#fetchKey_' + id + "_" + name).removeClass('form-group show-me12');
            $('#fetchValue_' + id + "_" + name).removeClass('form-group show-me12');
        }
    }
}
/*Start of add button in fetch dropdown Table Operations */
function add_fetch_dropdown(name,type){
        fetch_dropdown_key = parseInt(fetch_dropdown_key) + 1;
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
        $(".section-add-fetch-dropdown-action-"+name).append('<div class="list-st" id="fetch-drop-box-'+fetch_dropdown_key+'-'+name+'"><div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="delete_fetch_drop('+ fetch_dropdown_key + ',\'' + name + '\')"><i  class="add-element-button fa fa-minus" data-type=" '+ name +'"></i></span></div><div class="form-group"><label for="sel1" class="cell-po">Fetch<span style="color:red;">*</span></label><br><select class="form-control width-100 fetchDropdown_'+name+'" name="'+name+'[fetch_type][]" data-check="blank" data-error="This field is required"  onclick="select_table_fetch_type(\'' + name + '\',' + fetch_dropdown_key + ',this.value,\''+type+'\')" data-createform-id="'+name+'"><option value="">Select Type</option><option value="row">Row</option><option value="column">Column</option><option value="element">Element</option></select></div><div class="" id="fetchRow_' + fetch_dropdown_key + '_' + name + '"></div><div class="" id="fetchColumn_' + fetch_dropdown_key + '_' + name + '"></div><div class="" id="fetchKey_' + fetch_dropdown_key + '_' + name + '"></div><div class="" id="fetchValue_' + fetch_dropdown_key + '_' + name + '"></div></div></div>');
     validation_variable();     
 }
/*End of add button in fetch dropdown Table Operations  */

/*Start of Delete Fetch in table opertaion */
function delete_fetch_drop(k, name)
{
    $("#fetch-drop-box-" + k + "-" + name).remove("");
}
/*End of Delete Fetch in table opertaion */