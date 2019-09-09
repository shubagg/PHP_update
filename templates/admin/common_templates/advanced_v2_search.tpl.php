<style>
    .dropdown-menu.select-search {
        height: 47px;
        min-width: 220px;
    }
    .mutliSelect input[type="checkbox"] {
        margin: 4px 10px 0;
    }
    .select-search .dropdown dd,
    .select-search .dropdown dt {
        margin: 0px;
        padding: 0px;
    }

    .select-search .dropdown ul {
        margin: -1px 0 0 0;
    }

    .select-search .dropdown dd {
        position: relative;
    }

    .select-search .dropdown a,
    .select-search .dropdown a:visited {
        color: #fff;
        text-decoration: none;
        outline: none;
        font-size: 12px;
    }

    .select-search .dropdown dt a {
        display: block;
        min-height: 25px;
        line-height: 24px;
        overflow: hidden;
    }

    .select-search .dropdown dt a span,
    .multiSel span {
        cursor: pointer;
        display: inline-block;
        padding: 0 3px 2px 0;
        color: #848282;
    }

    .mutliSelect ul li {
        /*border-bottom: 1px solid #b2b6b7;*/
        padding-top: 10px;
    }
    
    .mutliSelect ul li {
        padding-left: 25px;
    }
    
    .mutliSelect ul li input {
        position: absolute;
        left: 0;
    }
    
    .select-search .dropdown dd ul {
        background-color: #fdfdfc;
        border: 1px solid #c1c1c1;
        border-top: none;
        left: 0px;
        /*	display: none;*/
        padding: 2px 5px 2px 5px;
        position: absolute;
        top: -13px;
        width: 100%;
        list-style: none;
        min-height: 85px;
        max-height: 200px;
        overflow: auto;
    }

    .search_ul li:hover {
        background: #f5f5f5;
    }

    .select-search .dropdown span.value {
        display: none;
    }

    .select-search .dropdown dd ul li a {
        padding: 5px;
        display: block;
    }

    .select-search .dropdown dd ul li a:hover {
        background-color: #fff;
    }
    .input-group .icon-addon .form-control {
        border-radius: 0;
    }

    .icon-addon {
        position: relative;
        color: #555;
        display: block;
    }

    .icon-addon:after,
    .icon-addon:before {
        display: table;
        content: " ";
    }

    .icon-addon:after {
        clear: both;
    }

    .icon-addon.addon-md .glyphicon,
    .icon-addon .glyphicon, 
    .icon-addon.addon-md .fa,
    .icon-addon .fa {
        position: absolute;
        z-index: 2;
        right: 12px;
        font-size: 14px;
        width: 20px;
        margin-left: -2.5px;
        text-align: center;
        padding: 10px 0;
        top: 1px
    }
    .icon-addon.addon-md {
        padding: 0 5px;
    }
    .icon-addon.addon-lg .form-control {
        line-height: 1.33;
        height: 46px;
        font-size: 18px;
        padding: 10px 16px 10px 40px;
    }

    .icon-addon.addon-sm .form-control {
        height: 30px;
        padding: 5px 10px 5px 28px;
        font-size: 12px;
        line-height: 1.5;
    }

    .icon-addon.addon-lg .fa,
    .icon-addon.addon-lg .glyphicon {
        font-size: 18px;
        margin-left: 0;
        left: 11px;
        top: 4px;
    }

    .icon-addon.addon-md .form-control,
    .icon-addon .form-control {
        padding-right: 30px;
        float: left;
        font-weight: normal;
    }

    .icon-addon.addon-sm .fa,
    .icon-addon.addon-sm .glyphicon {
        margin-left: 0;
        font-size: 12px;
        left: 5px;
        top: -1px
    }
    .icon-addon .form-control:focus + .glyphicon,
    .icon-addon:hover .glyphicon,
    .icon-addon .form-control:focus + .fa,
    .icon-addon:hover .fa {
        color: #2580db;
    }
    a.search_loader {
    position: absolute;
    z-index: 9;
    left: calc(50% - 25px);
    }
    
    .search_ul li label {
        cursor: pointer;
        font-weight: normal;
    }

    .search_ul li label input {
        cursor: pointer;
    }

    .search_loader {
        border: 5px solid #f3f3f3;
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
        border-top: 5px solid #555;
        border-radius: 50%;
        width: 30px;
        height: 30px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<div class="col-md-10">
    <?php
    if(!empty($adv_data['adv_data'])) {
        foreach($adv_data['adv_data'] as $adv_val) {
            if($adv_val['input-type'] == 'text_box') {
                ?>
                <div style="display: inline-block">
                    <input class="form-control input-micro adv_search_text-input" id="inputsm" type="text" placeholder="Type & Press Enter Search">
                </div>
                <?php
            }else if($adv_val['input-type'] == 'button') {
                ?>
                <div style="display: inline-block">
                     <button class="btn btn-default filter_button" type="button" value=<?= $adv_val['search_name']; ?>><?= $ui_string[$adv_val['search_name']]; ?></button>
                </div>
                <?php
            } else {
                ?>
                <div class="dropdown" style="display: inline-block">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?= $ui_string[$adv_val['search_name']]; ?> <span class="caret"></span></button>
                    <ul class="dropdown-menu select-search search_val_details">
                        <li>
                            <dl class="dropdown dropdown-adv"> 
                                <dt>
                                    <a href="javascript:void(0);">
                                        <div class="form-group ">
                                            <div class="icon-addon addon-md">
                                                <input type="text" placeholder="Type to Search" class="form-control adv_search_input" data-search_type="<?= $adv_val['search_type']; ?>">
                                                <label for="search" class="fa fa-search" rel="tooltip" title="search"></label>
                                            </div>
                                        </div>   
                                        <a class="loader_space" style="position:absolute;"></a>
                                        <p class="multiSel"></p>  
                                    </a>
                                </dt>
                                <dd>
                                    <div class="mutliSelect">
                                        <ul class="search_ul">
                                            <?php
                                            if(!empty($options_values['data'][strtolower($adv_val['search_type'])])) {
                                                $search_options = $options_values['data'][strtolower($adv_val['search_type'])];
                                                echo $search_options;
                                                ?>    
                                                <?php    
                                            } else {
                                                ?>
                                                <span class="span_search_type_loading"></span> 
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <?php
            }
        }
    }
    ?>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var all_checked_seletions = {};
    var all_string_checked_selections = {};
    $(document).ready(function () {
        $('.filter_button').click(function(e) {
                var filter = $(this).val();
                all_string_checked_selections['filter'] = filter;
                make_datatable();
        });

        $('.dropdown-adv').click(function(e) {
            e.stopPropagation();
        });
        
        $('.adv_checkbox_selection').live('change', function() {
            var curr_obj = $(this);
            var current_id = curr_obj.attr('id');
            var current_id_str = '"' + current_id + '"';
            var current_status = curr_obj.attr('data-current_selector');
            if(typeof all_checked_seletions[current_status] === 'undefined' ) {
                all_checked_seletions[current_status] = [];
                all_string_checked_selections[current_status] = [];
            }
            if(curr_obj.is(":checked")) {
                all_string_checked_selections[current_status].push(current_id_str);
                all_checked_seletions[current_status].push(current_id);
            } else {
                all_checked_seletions[current_status].splice($.inArray(current_id, all_checked_seletions[current_status]), 1);
                all_string_checked_selections[current_status].splice($.inArray(current_id_str, all_string_checked_selections[current_status]), 1);
            }
            make_datatable();
        });
        
        $('.adv_search_text-input').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                all_string_checked_selections['search_text'] = [];
                var search_txt = $(this).val();
                all_string_checked_selections['search_text'] = search_txt;
                make_datatable();
            }
        });

        $('.adv_search_input').keyup(function() {
            var curr = $(this);
            curr.parents('.search_val_details').find('.loader_space').addClass('search_loader');
            var query = curr.val();
            var search_type = curr.attr("data-search_type");
            var formData = new FormData();
            formData.append('query', query);
            formData.append('type', search_type);
            if(typeof all_checked_seletions[search_type] != 'undefined' ) {
                formData.append('selected_type_selections', all_checked_seletions[search_type]);
            } else {
                formData.append('selected_type_selections', []);
            }
            xhr = new XMLHttpRequest();
            xhr.open('POST', site_url + 'ui/admin/controller/ajax/adv_v2_search_data.php', true);
            xhr.onreadystatechange = function(response) {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    respone_json = JSON.parse(xhr.responseText);
                    if(respone_json['status'] == true) {
                        var search_html = '';
                        if(respone_json['payload'] != '') {
//                            var array = $.map(respone_json['payload'], function(value, index) {
//                                search_html += "<li><input type='checkbox' value='Apple' />" + value + "</li>";
//                            });
                            curr.parents('.search_val_details').find('.search_ul').html(respone_json['payload']);
                        } else {
                            curr.parents('.search_val_details').find('.search_ul').html(respone_json['message']);
                        }
                    } else {
                        curr.parents('.search_val_details').find('.search_ul').html(respone_json['message']);
                    }
                } else {
                    curr.parents('.search_val_details').find('.search_ul').html("<li>Oops! No Matches</li>");
                }
                curr.parents('.search_val_details').find('.loader_space').removeClass('search_loader');
            }
            xhr.send(formData);
        });
    });
    
//    $(".select-search .dropdown dt a").on('click', function() {
//        $(".select-search .dropdown dd ul").slideToggle('fast');
//    });
//
//$(".select-search .dropdown dd ul li a").on('click', function() {
//  $(".select-search .dropdown dd ul").hide();
//});
//
//function getSelectedValue(id) {
//  return $("#" + id).find("dt a span.value").html();
//}
//
//$(document).bind('click', function(e) {
//  var $clicked = $(e.target);
//  if (!$clicked.parents().hasClass("dropdown")) $(".select-search .dropdown dd ul").hide();
//});
//
//$('.mutliSelect input[type="checkbox"]').on('click', function() {
//
//  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
//    title = $(this).val() + ",";
//
//  if ($(this).is(':checked')) {
//    var html = '<span title="' + title + '">' + title + '</span>';
//    $('.multiSel').append(html);
//    $(".hida").hide();
//  } else {
//    $('span[title="' + title + '"]').remove();
//    var ret = $(".hida");
//    $('.select-search .dropdown dt a').append(ret);
//
//  }
//});
</script>