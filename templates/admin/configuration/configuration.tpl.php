<div id="main">
    <?php get_breadcrumb(); ?>
    <script>
        function checkalldata() {}
    </script>
    <div id="content">
        <div id="global">
            <div class="" id="tabs">
				
                <div class="row cm-fix-height">
                    <div class="col-sm-3">
                        <div id="cm-menu-scroller"  class="cf nestable-lists simplebar">
                            <?php
                            $menutab = get_data_by_table(array("table" => "controltower"));
                            $json = $menutab['data'][0]['Menu'];

                            //Ascending order menu
                            function json_sort(&$json, $ascending = true) {
                                $names = [];

                                // Creating a named array for sorting
                                foreach ($json AS $name => $value) {
                                    $names[] = $name;
                                }

                                if ($ascending) {
                                    asort($names);
                                } else {
                                    arsort($names);
                                }

                                $result = [];

                                foreach ($names AS $index => $name) {
                                    // Sorting Sub-Data
                                    if (is_array($json[$name]) || is_object($json[$name])) {
                                        json_sort($json[$name], $ascending);
                                    }

                                    $result[$name] = $json[$name];
                                }

                                $json = $result;
                            }

                            json_sort($json, true); // Ascending order
                            //Ascending order menu close

                            $menutab['data'][0]['Menu'] = $json;

                            $counter = 1;
                            //get User Task
                            $tasklist = getUserTaskList(array('userId' => $_SESSION['user']['user_id']));

                            foreach ($tasklist['data'] as $value) {
                                $menutab['data'][0]['Menu']['Task List'][$value['asid']] = $value['name'];
                            }
                            ?>
                            <ul class="cm-menu-items cm-1-navbar cm-custom-menu" id="nestable">
                                <?php
                                foreach ($menutab['data'][0]['Menu'] as $key => $menuename) {
                                    $tabcounter = 1;
                                    echo "<li class='cm-submenu'><a class='" . $key . "'><svg class='icon'><use xlink:href='" . $icoarray[$key] . "'/></svg>" . $key . "<span class='fa fa-angle-right'></span></a><ul class='dd-list menu-comunicacao-sub'>";
                                    foreach ($menutab['data'][0]['Menu'][$key] as $keys => $value) {
                                        $tabtype = str_replace('/', ' ', $value);
                                        $tabtype = trim(preg_replace('/\s+/', '', $tabtype));
                                        $tabtype = strtolower($tabtype);

                                        //tasklist
                                        $tabtasklist = str_replace('/', ' ', $key);
                                        $tabtasklist = trim(preg_replace('/\s+/', '', $tabtasklist));
                                        $tabtasklist = strtolower($tabtasklist);

                                        echo "<li class='" . $key . '-sub' . $counter . " dd-item clone leftmenu data " . $tabtype . "' data-icon='" . $childicoarray[$tabtype] . "' data-id='" . $tabtype . '-' . $keys . "'><i title='Delete' class='pull-right fa fa-trash deletetab'></i><i class='fa fa-copy copy-nestable-entity middlelist pull-right' data-createform=''></i><i  title='View' class='pull-right fa fa-eye middlelist' data-param-tasklist='" . $tabtasklist . "' data-icon='" . $icoarray[$key] . "' data-createform='false'></i><a class='dd-handle dd-label-". $tabtype . '-' . $keys .'-'.$counter."' href='javascript:void(0)'><svg class='icon'><use xlink:href='" . $childicoarray[$tabtype] . "'/></svg>" . $value . "</a></li>";

                                        $counter++;
                                        $tabcounter++;
                                    }
                                    echo "</ul></li>";
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12">
                            <div class="all-buttons">
                                <div class="align-xs-right" id="buttons-icon">
                                    <div class="btn-group tooltip-area1">

                                        <a href="#" data-placement="bottom" onclick="check_form_validation('save');" class="btn btn-primary custom-toltip" title="Publish to control Tower"><i class="flaticon-upload"></i></a>
                                    </div>
                                    <div class="btn-group tooltip-area1">
                                        <a href="#" data-placement="bottom" onclick="check_form_validation('export');" class="btn btn-primary custom-toltip" title="Code Export"><i class="flaticon-browser"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-block" id="tab-block">
                            <div class="col-sm-6">
                                <div class="panel panel-default panel-height">
                                    <div class="col-sm-12 actions-main">
                                        <ul class="tabs">
                                            <li class="col-md-5 tab-link current" data-tab="tab-1">Actions flow</li>
                                            <li class="col-md-5 tab-link" data-tab="tab-2">Variable</li>
                                        </ul>
                                    </div>

                                    <div class="cf nestable-lists simplebar" id="action-variable">

                                        <div id="tab-1" class="tab-content current">
                                            <div class="dd nestable-dropable-zone" id="nestable2">
                                                <div class="dd-empty"></div>
                                            </div>
                                        </div>
                                        <div id="tab-2" class="tab-content">
                                            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name.</th>
                            <th>Type</th>
                            <th>Default Value</th>
                            <th style="width:30px !important;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody align="center" class="add-select-variable-value">
                        <?php
                        if ($taskId != "") {
                            $ignoreVariabel = array("temp_return_result","__retry", "loop_obj", "next_action", "excel_obj", "sheet", "while", "for_each1");
                             $variablesize = sizeof($variablelist);
                            foreach ($variablelist as $variableArray) {
                                if (in_array($variableArray['name'], $ignoreVariabel) || (strpos($variableArray['name'], 'for_each') !== false)) {
                                    continue;
                                }
                                ?>
                            <?php if(!empty($variableArray['name'])){   ?>
                                <tr id="typecount-<?php echo $listCount; ?>">
                                    <td><input type="text" onchange ="checkvariable('page');" class="form-control width-100 variablecheck" id="name-val-<?php echo $listCount; ?>" name="variablename[]"  value="<?php echo $variableArray['name'] ?>"  /></td>
                                    <td><select class="form-control width-100 variablecheck" id="typeoption-<?php echo $listCount; ?>" name="datatype[]" onchange="data_type(this.value, this);">
                                            <option value="string" <?php echo ($variableArray['type'] == "string") ? "selected" : ''; ?>>Text</option>
                                            <option value="number" <?php echo ($variableArray['type'] == "number") ? "selected" : ''; ?>>Number</option>
                                            <option value="boolean" <?php echo ($variableArray['type'] == "boolean") ? "selected" : ''; ?>>Boolean</option>
                                            <option value="datetime" <?php echo ($variableArray['type'] == "datetime") ? "selected" : ''; ?>>Date Time</option>
                                            <option value="list" <?php echo ($variableArray['type'] == "list") ? "selected" : ''; ?>>List</option>
                                            <option value="table" <?php echo ($variableArray['type'] == "table") ? "selected" : ''; ?>>Table</option>
                                            <option value="dictionary" <?php echo ($variableArray['type'] == "dictionary") ? "selected" : ''; ?>>Dictionary</option>
                                             <option value="password" <?php echo ($variableArray['type'] == "password") ? "selected" : ''; ?>>Password</option>
                                        </select></td>
                                    <?php
                                    $onchangefn = "onchange='checkvariable(\"page\");'";
                                    $variableValue = $variableArray['value'];    
                                    $displayStatus = "";
                                    if ($variableArray['type'] == "list") {
                                        $onchangefn = 'onclick="open_list_modal(this);"';
                                        $variableValue = implode(":", $variableArray['value']);
                                        $displayStatus = "readonly";
                                    } else if ($variableArray['type'] == "dictionary") {
                                        $onchangefn = 'onclick="open_dictionary_modal(this);"';
                                        $variableValue = implode(":", $variableArray['value']);
                                        $displayStatus = "readonly";
                                    }
                                    else if ($variableArray['type'] == "table") {
                                        $variableValue=json_encode($variableValue);
                                        $onchangefn = 'onclick="open_table_modal(this);"';
                                        $displayStatus = "readonly";
                                    }
                                    ?>
                                    <?php if($variableArray['type']=='password') {?>
                                        <td class="typeoption-<?php echo $listCount; ?>" ><input type="password" class="form-control width-100" id="defaultval-<?php echo $listCount; ?>" value="<?php echo htmlspecialchars($variableValue, ENT_QUOTES, 'UTF-8'); ?>" name="defaultvariable[]" <?php echo $onchangefn;
                            echo $displayStatus;
                                    ?>/></td>
                                    <?php } else { ?>
                                    <td class="typeoption-<?php echo $listCount; ?>" ><input type="text" class="form-control width-100" id="defaultval-<?php echo $listCount; ?>" value="<?php echo htmlspecialchars($variableValue, ENT_QUOTES, 'UTF-8'); ?>" name="defaultvariable[]" <?php echo $onchangefn;
                            echo $displayStatus;
                                    ?>/></td>
                                    <?php } ?>
                                    <td style="font-size: 17px;cursor: pointer;"><i class="fa fa-trash" onclick="variable_del('<?php echo $listCount; ?>')"></i></td>
                                </tr>
                                <?php
                                $listCount++;
                            }
                            if(isset($variableArray))
                            {
                                $listCount=sizeof($variableArray);
                            }
                            if ($variablesize == $listCount) {
                                echo "<script>checkvariable('fun');</script>";
                            }
                            }
                        } else {
                            ?>
                            <tr id="typecount-<?php echo $listCount; ?>">
                                <td><input type="text" onchange ="checkvariable('page');" class="form-control width-100 variablecheck" id="name-val-<?php echo $listCount; ?>" name="variablename[]"  /></td>
                                <td><select class="form-control width-100 variablecheck" id="typeoption-<?php echo $listCount; ?>" name="datatype[]" onchange="data_type(this.value, this);">
                                        <option value="string">Text</option>
                                        <option value="number">Number</option>
                                        <option value="boolean">Boolean</option>
                                        <option value="datetime">Date Time</option>
                                        <option value="list">List</option>
                                        <option value="table">Table</option>
                                        <option value="dictionary">Dictionary</option>
                                        <option value="password">Password</option>
                                    </select></td>
                                <td class="typeoption-<?php echo $listCount; ?>" ><input type="text" class="form-control width-100" id="defaultval-<?php echo $listCount; ?>" name="defaultvariable[]" onchange ="checkvariable('page');"/></td>
                                <td style="font-size: 17px;cursor: pointer;"><i class="fa fa-trash" onclick="variable_del('<?php echo $listCount; ?>')"></i></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border:1px solid #f3f3f3 !important;" id="btn3"><div class="btn btn-default btn-lg btn-block" style="border:none;"><i class="fa fa-plus" aria-hidden="true"></i> Add Variable</div> </td>
                            <td style="border:1px solid #f3f3f3 !important;"><input type="file" id="uploadjson" onchange="handleFileSelect();"><div class="btn btn-default btn-lg btn-block" style="border:none;"><i class="fa fa-upload" aria-hidden="true"></i> Upload Variable</div>  </td>
                        </tr>
                    </tfoot>

                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="panel panel-default simplebar panel-height" id="details-show">
                                    <div class="details-show" style="padding:10px;">
                                        <form class="form-inline" id="form-list" method="post" enctype="multipart/form-data" >
                                            <input type="hidden" name="variablenamearray" id="variablenamearray">
                                            <input type="hidden" name="variabletypearray" id="variabletypearray">
                                            <input type="hidden" name="variabledefaultarray" id="variabledefaultarray">
                                            <textarea name="nestable_structure" id="nestable2-output" style="display: none;" readonly></textarea> 
                                            <button type="button" name="submit" style="display: none;" id="submitform" onclick="submitform();"></button>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Variable -->
<!--popup-->
<div class="popup" pd-popup="popupNew1">
    <div class="popup-inner">
        <div class="model-headeer">
            <h4 class="modal-title"> Title
            </h4>
            <a class="popup-close" pd-popup-close="popupNew1" href="#"> </a>
        </div>
        <div class="modal-body ">
            <form class="form-horizontal labelcustomize">

                <div class="form-group ">
                    <label class="control-label remove_bg col-md-4"><span class="color">Title<font class="color">*</font></span></label>
                    <div class="col-md-8">
                        <input type="hidden" id="submit_type" name="submit_type" class="form-control">
                        <input type="text" id="categoryname" name="categoryname" class="form-control" value="<?php echo $taskListName; ?>">
                        <?php if ($taskId != "") { ?>
                            <input type="hidden" id="insertId" name="insertId" class="form-control" value="<?php echo $taskId; ?>">
                        <?php } ?>
                        <span id="ecategoryname" class="err"></span>
                    </div>
                </div>    <div class="col-md-12 text-right margn-btm-20">
                    <span id="groupbut">
                        <button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" onclick="submitdata();">Confirm</button>
                    </span>
                    <span><button type="button" class="btn btn-inverse bottom-gap" pd-popup-close="popupNew1">Cancel</button></span>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
<div class="popup" pd-popup="popupNew">
    <div class="popup-inner">
        <div class="model-headeer">
            <h4 class="modal-title" id="model_head">
                <i class="glyphicon glyphicon-ok-circle"></i> Confirmation
            </h4>
            <a class="popup-close" pd-popup-close="popupNew" href="#"> </a>
        </div>
        <div class="modal-body text_alignment">
            <div class="confirmation_successful">
                <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
                <span id="model_des">Confirmation Successful</span>
            </div>
        </div>
    </div>
</div>
<div class="popup" pd-popup="popupNewlist">
    <div class="popup-inner">
        <div class="model-headeer">
            <h4 class="modal-title"> Value
            </h4>
            <a class="popup-close" pd-popup-close="popupNewlist" href="#"> </a>
        </div>
        <div class="modal-body ">
            <form class="form-horizontal labelcustomize">
                <table class="table table-bordered add-select-variable-value-list appendtablelistdata" style="border:none;">
                    <tr>
                        <td class="count-no td_count">1</td>
                        <td><input type="text" class="form-control td_count_value preventKeyPress"  name="listArray[]" placeholder="" /></td>
                        <td class='count-no deletelist'><span><i class="fa fa-trash"></i></span></td>
                    </tr>
                </table>
                <div class="btn btn-default" id="btn-list"><i class="fa fa-plus" aria-hidden="true"></i> Add Value</div>
                <div class="col-md-12 text-right margn-btm-20">
                    <span id="groupbut">
                        <button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" id="list_button" onclick="submit_list(this);">Confirm</button>
                    </span>
                    <span><button type="button" class="btn btn-inverse bottom-gap" pd-popup-close="popupNewlist">Cancel</button></span>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
<div class="popup" pd-popup="popupNewDictionary">
    <div class="popup-inner">
        <div class="model-headeer">
            <h4 class="modal-title"> Value
            </h4>
            <a class="popup-close" pd-popup-close="popupNewDictionary" href="#"> </a>
        </div>
        <div class="modal-body ">
            <form class="form-horizontal labelcustomize">
                <table class="table table-bordered add-select-variable-value-dictionary append_table_dicationary_data" style="border:none;">
                    <tr>
                        <td class="count-no_dictionary td_count_dictionary">1</td>
                        <td><input type="text" class="form-control td_count_value_dictionary"  name="dictionaryArray[]" placeholder="" />
                        </td>
                        <td><input type="text" class="form-control td_count_value_dictionary"  name="dictionaryArray[]" placeholder="" />
                        </td>
                        <td class='count-no delete_dictionary'><span><i class="fa fa-trash"></i></span></td>
                    </tr>
                </table>
                <div class="btn btn-default" id="btn-dictionary"><i class="fa fa-plus" aria-hidden="true"></i> Add Value</div>
                <div class="col-md-12 text-right margn-btm-20">
                    <span id="groupbut">
                        <button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" id="dictionary_button" onclick="submit_dictionary(this);">Confirm</button>
                    </span>
                    <span><button type="button" class="btn btn-inverse bottom-gap" pd-popup-close="popupNewDictionary">Cancel</button></span>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
<div class="popup" pd-popup="popupTable">
    <div class="popup-inner">
        <div class="model-headeer">
            <h4 class="modal-title"> Configure table variable</h4>
            <a class="popup-close handler_tbl_popup" pd-popup-close="popupTable" href="#"> </a>
        </div>
        <div class="modal-body ">
            <form class="form-horizontal labelcustomize" id="tabledatasubmit">
                <table class="table table-bordered add-select-variable-value-row" style="border:none;" id="blacklistgrid">
                    <tr class="add-select-variable-value-row-col tbl_row" id="RowHeading">
                        <th></th>
                        <th><span class="tableheading">1</span></th>
                    </tr>
                    <tr class="add-select-variable-value-row-col-td tbl_row" id="Row1">
                        <td class="count-no table-count">1</td>
                        <td><input type="text" class="form-control trcounter preventKeyPress" name="tabledata[0][]"/> </td>
                    </tr>
                </table>
                <div class="btn btn-default" id="btnAddRow"><i class="fa fa-plus" aria-hidden="true" ></i> More Rows</div>
                <div class="btn btn-default" id="btnAddCol"><i class="fa fa-plus" aria-hidden="true" ></i> More Columns</div>
                <div class="col-md-12 text-right margn-btm-20">
                    <span id="groupbut"><button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" id="table_list_button" onclick="submittabledata('tabledatasubmit', this);">Confirm</button></span>
                    <span><button type="button" class="btn btn-inverse bottom-gap handler_tbl_popup" pd-popup-close="popupTable">Cancel</button></span>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.dropboxx li a').click(function () {
            $('.dropboxx li a').removeClass('activelink');
            $(this).addClass('activelink');
            var tagid = $(this).data('tag');
            $('.list').removeClass('active').addClass('hide');
            $('#' + tagid).addClass('active').removeClass('hide');
        });
        table_counter_no = 2;
        $('#btnAddRow').click(function () {
            var count = 1,
            first_row = $('#Row1');
            var myform = $('#blacklistgrid');
            var trlength = myform.find('tr').length;
            while (count-- > 0) {
                var $clone = first_row.clone();
                $clone.attr("id", "Row" + trlength);
                var indexlength = trlength - 1;
                $clone.find(".trcounter").attr("name", "tabledata[" + indexlength + "][]");
                $clone.find(".trcounter").attr("value", "");
                //$clone.find(".lastinfield").css("display", "block");
                $clone.appendTo('#blacklistgrid');
                //first_row.clone().appendTo('#blacklistgrid');
            }
            table_counter_no++;
            tablecounter();
        });
        var myform = $('#blacklistgrid'), iter = 2;
        $('#btnAddCol').click(function () {
            //$(".lastinfield").addClass('deletetablerow');
            myform.find('tr').each(function (index) {
                var trow = $(this);
                if (trow.index() === 0) {
                    trow.append('<td class="col_add' + iter + '"><span class="tableheading">' + iter + '</span><span deta-col-id="col_add' + iter + '" class="deletetablecol"><i class="fa fa-trash" ></i></span></td>');
                } else {
                    index = index - 1;
                    trow.append('<td class="col_add' + iter + '"><input type="text" class="form-control trcounter preventKeyPress" name="tabledata[' + index + '][]" /></i></span></td>');
                }
            });
            iter += 1;
            tableheadingcounter();
        });
    });
    function tablecounter() {
        $(".table-count").each(function (index) {
            if(index!=0)
            {
                $(this).html(index + 1+'<span class="lastinfield deletetablerow" style="display: block;"><i class="fa fa-trash"></i></span>');
            }
            else
            {
                $(this).html(index + 1);
            }
        
        });
    }
</script>
<script>
    $(document).ready(function () {
        $(".dropdown-toggle").dropdown();
    });
    $(function () {
        //----- OPEN
        $('[pd-popup-open]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('pd-popup-open');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);

            e.preventDefault();
        });

        //----- CLOSE
        $('[pd-popup-close]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('pd-popup-close');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);

            e.preventDefault();
        });
    });
</script>

<script>
    $(function () {
        //----- OPEN
        $('[pd-popup-open]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('pd-popup-open');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);

            e.preventDefault();
        });

        //----- CLOSE
        $('[pd-popup-close]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('pd-popup-close');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);

            e.preventDefault();
        });
    });
</script>

<script>
    $(document).ready(function ()
    {
        var lastId = 22;
        var updateOutput = function (e)
        {
            var list = e.length ? e : $(e.target),
                    output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };
        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        })
                .on('change', updateOutput);
        // activate Nestable for list 2
        $('#nestable2').nestable({
            group: 1
        })
                .on('change', updateOutput);
        //for add json..
        $('.middlelist').nestable({
            group: 1
        })
                .live('click', function () {
                    if ($(this).closest('li').hasClass('Task'))
                    {
                        if ($(this).closest('li').find('ol').length == 0)
                        {
                            var li = $(this).closest('li');
                            var id = $(this).attr("data-createform").split('-')[1];
                            $.ajax({
                                url: site_url + "/ui/admin/configuration/ajax/getRobot.php?id=" + id,
                                dataType: "JSON",
                                success: function (suc) {
                                    suc = JSON.parse(suc);
                                    taskId = id;
                                    makeNestableListUsingJSONArray(suc, li);
                                    li.find('.clone').removeClass('clone');
                                }
                            })
                        }
                    } else
                    {
                        var datacreateform = $(this).attr("data-createform");
                        $(".dd-handle").removeClass("active-drag-menu");
                        $(this).next(".dd-handle").addClass("active-drag-menu");
                        $(".tab-pane").hide();
                        if ($("#" + datacreateform).length == "0") {
                            append_form(datacreateform, "", taskId);
                        }
                        $("#" + datacreateform).show();
                        updateOutput($('#nestable2').data('output', $('#nestable2-output')));
                    }
                });
        // delete on click..
        $('.deletetab').nestable({
            group: 1
        }).live('click', function () {

            /*if($(this).siblings().hasClass("middlelist")){
             var removerightmenu=$(this).siblings().attr("data-createform");
             $("#"+removerightmenu).remove();
             }*/

            $(this).parent().remove();
            if ($("#nestable2").children().children().length === 0) {
                $("#nestable2").html('<div class="dd-empty"></div>');
            }
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));
            var jsonArray = JSON.parse($("#nestable2-output").val());
            var formArray = [];
            $(".tab-pane").each(function () {
                if ($(this).attr("id") != "") {
                    formArray.push($(this).attr("id"));
                }
            });
            if (jsonArray.length > 0)
            {
                DeleteNestableListUsingJSONArray(jsonArray, formArray);
            }
            function DeleteNestableListUsingJSONArray(jsonArray, formArray) {
                for (var i = 0; i < jsonArray.length; i++) {
                    var index = jQuery.inArray(jsonArray[i].id, formArray);
                    if (index !== false) {
                        formArray.splice(index, 1);
                    }
                    if (typeof jsonArray[i].children !== 'undefined') {
                        DeleteNestableListUsingJSONArray(jsonArray[i].children, formArray);
                    }
                }
            }
            for (var i = 0; i < formArray.length; i++) {
                $("#" + formArray[i]).remove();
            }
        });


        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
        updateOutput($('#nestable2').data('output', $('#nestable2-output')));
        $('#nestable-menu').live('click', function (e)
        {
            var target = $(e.target),
                    action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
            /*if(action === 'add-item') {
             var newItem = {
             "id": ++lastId,
             "content": "Item " + lastId,
             "children": [
             {
             "id": ++lastId,
             "content": "Item " + lastId,
             "children": [
             {
             "id": ++lastId,
             "content": "Item " + lastId
             }
             ]
             }
             ]
             };
             $('#nestable').nestable('add', newItem);
             }*/
        });
        $('#nestable3').nestable();
        var newparse = JSON.parse(childicojson);
        var childNameList = JSON.parse(childNameArray);
        var edit_counter = 0;
        edit_main_counter =0;
        function makeNestableListUsingJSONArray(jsonArray, root) {
            if (jsonArray.length > 0) {
                $("#nestable2").children().removeClass("dd-empty");
                if (typeof root === 'undefined') {
                    root = $('#nestable2');
                }
                var diiv = $('<ol class="dd-list"></ol>');
                root.append(diiv);
                for (var i = 0; i < jsonArray.length; i++) {
                    var name_file = jsonArray[i].id;
                    name_file = name_file.split("-");
                    name_file = name_file[0];
                    var activedragmenu = "";
                    if (jsonArray.length - 1 == i) {
                        activedragmenu = "active-drag-menu";
                    }
                    var collapsebutton='';
                    if(typeof jsonArray[i].children !== 'undefined'){
                        collapsebutton='<button data-action="collapse" type="button" >Collapse</button><button data-action="expand" style="display: none;" type="button">Expand</button>';
                    }
                    var newLabelClass="dd-label-"+jsonArray[i].id;
                    var $li = $("<li class='dd-item leftmenu data' data-id='" + jsonArray[i].id + "' data-icon='" + newparse[name_file] + "'>"+collapsebutton+"<i class='pull-right fa fa-trash deletetab'></i><i class='fa fa-copy copy-nestable-entity middlelist pull-right' data-createform='" + jsonArray[i].id + "'></i><i class='pull-right fa fa-eye middlelist' data-param-tasklist='' data-icon='" + newparse[name_file] + "' data-createform='" + jsonArray[i].id + "'></i><a class='dd-handle " + activedragmenu +" "+newLabelClass+ "' href='javascript:void(0)'><svg class='icon'><use xlink:href='" + newparse[name_file] + "'/></svg>" + childNameList[name_file] + ":<span style='vertical-align: middle;top: -1px !important;'>[<span class='lable-input-bind label-"+jsonArray[i].id+"'></span>]</span></a></li>");
                    root.find('ol.dd-list:first').append($li);
                    /*(robot_id!="")
                    {
                        if(edit_counter % 2 == 1){
                            append_form(jsonArray[i].id,edit_main_counter, taskId);
                            edit_main_counter++;   
                        }
                        else
                        {
                           append_form(jsonArray[i].id, edit_counter, taskId);   
                        }
                        
                    }
                    else
                    {
                        append_form(jsonArray[i].id, 0, taskId);
                    }*/
                   // alert(edit_counter);
                    append_form(jsonArray[i].id, edit_counter, taskId);
                    menu_drag_icon++; //for change new add tab..
                    edit_counter++;
                    if (typeof jsonArray[i].children !== 'undefined') {
                        //console.log(jsonArray[i].children);
                        makeNestableListUsingJSONArray(jsonArray[i].children, $li);
                    }
                }

                setTimeout(function () {
                    $('.label-entity').each(function () {
                        var boxId = $(this).attr('id').split('-');
                        boxId.splice(0, 1);
                        $('[data-id="' + boxId.join('-') + '"]').find('.label-'+boxId.join('-')).html($(this).val());
                    });
                }, 5000);



                updateOutput($('#nestable2').data('output', $('#nestable2-output')));
            }
        }
        /*
         var json = [{"id":"ifelse-5b7184052ceb1ee42f000037-1","children":[{"id":"while-5b7184242ceb1ee42f000038-2","children":[{"id":"createworkbook-5b7178ca2ceb1e881c00002b-3"},{"id":"setcellvalue-5b473a0f2ceb1ea40700002d-4"},{"id":"saveworkbook-5b3c8f682ceb1e1c3e00002b-5"}]}]}];
         */
        if (json != "") {
            var jsonArray = JSON.parse(json);
            makeNestableListUsingJSONArray(jsonArray);
        }
    });
</script>
<script>
    $(document).ready(function () {

        $('ul.tabs li').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })

    });

    function handleFileSelect() {
        input = document.getElementById('uploadjson');
        var fileExtension = ['json', 'JSON'];
        if ($.inArray($("#uploadjson").val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : .Json");
        } else if (!input) {
            alert("Couldn't find the fileinput element.");
        } else if (!input.files) {
            alert("This browser doesn't seem to support the `files` property of file inputs.");
        } else if (!input.files[0]) {
            alert("Please select a file before clicking 'Load'");
        } else {

            var file = input.files[0];
            var reader = new FileReader();
            reader.onload = function () {
                var filedata = reader.result;
                var jsondata = JSON.parse(filedata);
                var namearray = [];
                $('input[name^="variablename[]"]').each(function () {
                    if ($(this).val() != "") {
                        namearray.push($(this).val());
                    }
                });
                $.each(jsondata, function (key, data) {
                    if (key != "") {
                        if (jQuery.inArray(key, namearray) == -1) {

                            namearray.push(key);
                            var data_type = typeof (data);
                            var listtype = "";
                            var display_none = "";
                            var function_name = "onchange ='checkvariable(\"page\");'";
                            if (data_type == "object") {
                                listtype = "selected";
                                display_none = "readonly";
                                function_name = 'onclick="open_list_modal(this);"';
                                data = data.join(':');
                            }
                            listCount++;
                            $(".add-select-variable-value").append("<tr><td><input type='text' onchange ='checkvariable(\"page\");' value='" + key + "' id='name-val-"+listCount+"' name='variablename[]'  class='form-control width-100 variablecheck' /></td><td><select class='form-control width-100 variablecheck' id='typeoption-" + listCount + "' name='datatype[]' onchange='data_type(this.value,this);'><option value='string'>Text</option><option value='number'>Number</option><option value='boolean'>Boolean</option><option value='datetime'>Date Time</option><option value='list' " + listtype + ">List</option><option value='table'>Table</option></select></td><td class='typeoption-" + listCount + "'><input type='text' name='defaultvariable[]' value='" + data + "' id='defaultval-" + listCount + "' class='form-control width-100' " + function_name + "  " + display_none + "/></td></tr>");
                        }
                    }
                });
                checkvariable("fun");
            };
            reader.readAsText(file);
            $("#uploadjson").val("");
        }
    }

    var uniqueNumber = 0;
    $(document).ready(function () {
        $('body').on('click', '.copy-nestable-entity', function () {
            var dataId = $(this).parent().attr('data-id');
            var getName = dataId.split('-');
            var lastEl = getName[getName.length-1];
            var totalAvailableForSameCategory = $('.' + getName[0]).length;

            var id = getName[0] + '-' + getName[1] + '-' + menu_drag_icon;
            var textWritten = $(this).parent().find('a:first').text();
            var newtext=textWritten.match(":")
            if(newtext==null)
            {
                var lablelhtml='<span style="vertical-align: middle;top: -1px !important;">[<span class="lable-input-bind label-'+id+'"></span>]</span>';
            }
            else
            {
                var tempTextWritten = textWritten.split(':');
                textWritten = tempTextWritten[0] + '<span style="vertical-align: middle;top: -1px !important;">[<span class="lable-input-bind label-'+id+'">'+tempTextWritten[1]+'</span>]</span>'
                var lablelhtml='';
            }
            var icon = $(this).parent().attr('data-icon');
            var nestableFieldHtml = '<li class="Application-sub1 dd-item leftmenu data ' + getName[0] + '"  data-icon="' + icon + '" data-id="' + id + '"><i title="Delete" class="pull-right fa fa-trash deletetab"></i><i class="fa fa-copy copy-nestable-entity middlelist pull-right" data-createform="' + id + '"></i><i title="View" class="pull-right fa fa-eye middlelist" data-param-tasklist="application" data-icon="flaticon-software" data-createform="' + id + '"></i><a class="dd-handle dd-label-'+id+'" href="javascript:void(0)"><svg class="icon"><use xlink:href="' + icon + '"/></svg>' + textWritten+'</a></li>';
            $(this).parent().after(nestableFieldHtml);
            
            $.ajax({
                url: site_url + "/ui/admin/configuration/ajax/htmlform.php?type=" + id,
                type: "POST",
                async: false,
                data: {"index": lastEl-1, "taskId": taskId},
                success: function (suc) {
                    if ($('#' + dataId))
                    {
                        menu_drag_icon++;
                        $('#details-show').find('form').append(suc);
                        var values = [];
                        var i = 0;
                        $('[name^=' + dataId + ']').each(function () {
                            if(taskId) {
                                values.push($(this).val());
                            } else {
                                if($(this).prop('onchange')) {
                                    values.push('');
                                } else {
                                    values.push($(this).val());
                                }
                            }
                        });
                        $('[name^=' + id + ']').each(function () {
                            $(this).val(values[i]);
                            i++;
                        });
                        validation_variable();
                        $(".sortable").sortable();
                        $(".sortable").disableSelection();
                    }
                }
            });
        });
        $('body').on('keydown', '.label-entity', function () {
            var that = $(this);
            setTimeout(function () {
                var boxId = that.attr('id').split('-');
                boxId.splice(0, 1);
                if ($('[data-id="' + boxId.join('-') + '"]').find('.label-'+boxId.join('-')).length == 0)
                {
                    $('[data-id="' + boxId.join('-') + '"]').find('.active-drag-menu').append('<span style="vertical-align: middle;top: -1px !important;">[<span class="lable-input-bind label-'+boxId.join('-')+'">' + that.val() + '</span>]</span>');
                } else
                {
                    if(that.val() != '') {
                        $('[data-id="' + boxId.join('-') + '"]').find('.label-'+boxId.join('-')).html(that.val());
                    } else {
                        $('[data-id="' + boxId.join('-') + '"]').find('.label-'+boxId.join('-')).remove();
                        $('[data-id="' + boxId.join('-') + '"]').find('span').remove();
                        
                    } 
                }
            }, 100);
        });
    });
</script>