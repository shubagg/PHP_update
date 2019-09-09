<div id="main" class="dashboard">
    <?php get_breadcrumb(); ?>
    <div id="content">
        <div class="row">
            <section class="panel">
                <header class="panel-heading">
                    <div class="row">
                        <?php
                        $user_roles = $user_role;
                        // print_r($user_roles); 
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php
                            if (isset($user_id)) {
                                if ($user_id != '') {
                                    ?>
                                    <h3><strong><?php echo $ui_string['update']; ?></strong> <?php echo $ui_string['user']; ?></h3>
                                    <?php
                                }
                            } else {
                                ?>
                                <h3><strong><?php echo $ui_string['create']; ?></strong> <?php echo $ui_string['new'] . " " . $ui_string['user']; ?></h3>
                            <?php } ?>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form id="addUser" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                            <?php
                            $csrf = new CSRF_Protect();
                            $csrf->echoInputField();
                            ?>
                            <p id="pid"></p>
                            <div class="form-group">
                                <label class="control-label remove_bg"><?php echo $ui_string['department']; ?><font class="color">*</font></label>
                                <div>
                                    <?php
                                    $dat = get_category_tree($all_cats, 0);
                                    $final_category = array();
                                    foreach ($dat as $category_data) {
                                        if ($category_data['code'] != 'licenses') {
                                            array_push($final_category, $category_data);
                                        }
                                    }
                                    ?>
                                    <table>
                                    <?php
                                    show_accordian($final_category, '', 0, 1, 'category', $category, $id, 'required_field');
                                    ?>
                                    </table>
                                    <span id="ecats" class="error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label remove_bg"><?php echo $ui_string['role']; ?><font class="color">*</font></label>
                                <div>
                                    <button type="button" class="btn btn-default" onclick="open_add_roles()"> <?php echo $ui_string['viewRole']; ?> </button><p id="selected_role"></p>
                                    <span id="erole" class="error clearfix"></span> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label remove_bg"><?php echo $ui_string['user_type']; ?><font class="color">*</font></label>
                                <div>
                                        <?php if ($get_user_login['role'] == '5cf4c668518be4001e000032') { ?>
                                        <div id="attender_div">
                                            <input type='radio' id='attender' name='type' value="attender" onclick="open_machine(this.value)" checked > <?php echo $ui_string['attender']; ?> 
                                        </div>
                                        <?php } else { ?>
                                        <div id="attender_div">
                                            <input type='radio' id='attender' name='type' value="attender" onclick="open_machine(this.value)" <?php
                                            if (isset($user['type']) && $user['type'] == 'attender') {
                                                echo "checked";
                                            } else {

                                            }
                                            ?> > <?php echo $ui_string['attender']; ?> 
                                        </div>
                                        <div id="machine_div">
                                            <input type='radio' id="machine" name='type' value="machine" onclick="open_machine(this.value)" <?php
                                        if (isset($user['type']) && $user['type'] == 'machine') {
                                            echo "checked";
                                        } else {
                                            
                                        }
    ?>> <?php echo $ui_string['machine']; ?>
                                        </div>


<?php } ?>
                                </div>
                                <span id="eattender" class="error clearfix"></span>
                            </div>
<?php
if (isset($user_id)) {
    if ($user_id != '') {
        $read = 'readonly="readonly"';
    }
} else {
    $read = "";
}
?> 
                            <?php
                            if (isset($cat_name)) {
                                if (in_array('writter', $cat_name)) {
                                    $style = 'style="display: inherit;"';
                                } else {
                                    $style = 'style="display: none;"';
                                }
                                if (in_array('narrator', $cat_name)) {
                                    $style1 = 'style="display: inherit;"';
                                } else {
                                    $style1 = 'style="display: none;"';
                                }
                            }
                            ?>
                            <?php echo get_data_field('text', $ui_string['name'], 'name', 'name', 'required_field addUser editUser', 'data-check-valid="blank,no_special" data-valid-nospecial-error="Please Enter Valid Name" data-error-show-in="ename" data-error-setting="2" data-error-text="' . $ui_string['1201'] . '"', isset($user['name']) ? $user['name'] : '', '', '', '', 'font'); ?>
                            <?php echo get_data_field('text', $ui_string['email'], 'email', 'email', 'required_field addUser editUser', 'autocomplete="off" data-check-valid="blank,email" data-valid-email-error="' . $ui_string['12045'] . '" data-error-show-in="eemail" data-error-setting="2" data-error-text="' . $ui_string['12026'] . '" ' . $read, isset($user['email']) ? $user['email'] : '', '', '', '', 'font'); ?>
                            <?php if ($id == '') { ?>
                                <?php echo get_data_field('password', $ui_string['password'], 'password', 'password', 'required_field addUser editUser', 'data-check-valid="blank,gt-8" data-valid-gt-error="' . $ui_string['12017'] . '" data-error-show-in="epassword" data-error-setting="2" data-error-text="' . $ui_string['1209'] . '"', isset($user['password']) ? $user['password'] : '', '', '', '', 'font'); ?>
                                <?php echo get_data_field('password', $ui_string['confirm_password'], 'confirm_password', 'confirm_password', 'required_field addUser editUser', 'data-match-with="password" data-valid-match-error="' . $ui_string['12022'] . '" data-check-valid="blank,match,gt-8" data-valid-gt-error="' . $ui_string['12017'] . '" data-error-show-in="econfirm_password" data-error-setting="2" data-error-text="' . $ui_string['12019'] . '"', '', '', '', '', 'font'); ?>
                            <?php } ?>

                            <?php echo get_data_field('text', $ui_string['designation'], 'designation', 'designation', 'required_field addUser editUser', 'data-check-valid="blank" data-valid-nospecial-error="Please enter valid designation" data-error-show-in="edesignation" data-error-setting="2" data-error-text="' . $ui_string['12073'] . '"', isset($user['designation']) ? $user['designation'] : '', '', '', '', 'font'); ?>

                            <div> <?php echo get_data_field_for_img('file', $ui_string['profile_picture'], 'profile_picture', 'profile_picture', '', '', $img_url, '', '', '100', '100'); ?>  </div>     
                            <input  type="hidden" name="user_profile_picture" value="<?php echo $profile_picture; ?>"/>  

                            <input type="hidden" name="user_add" value="user_add"/>
<?php
$userId = 0;
if (!empty($id)) {
    $userEncyInfo = encrypt_decrypt($id, 'encrypt', 'nikky', '');
    $userId = !empty($userEncyInfo['data']) ? $userEncyInfo['data'] : '';
}
?>
                            <input type="hidden" name="user_id" value="<?php echo $userId; ?>"/>
                            <input type="hidden" name="login_type" value="<?php echo $login_type; ?>"/>
                            <input  type="hidden" name="user_profile_picture" value="<?php echo $profile_picture; ?>"/>  
<?php
if (isset($user_id)) {
    if ($user_id != '') {
        ?>
                                    <button  onclick="return validation('editUser')" type="button" class="btn btn-theme-inverse pull-right">
                                    <?php
                                    echo $ui_string['update'];
                                    ?>
                                    </button>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="pull-right">
                                            <button  onclick="return validation('addUser')" type="button" class="btn btn-theme-inverse"> <?php echo $ui_string['submit']; ?> </button>

                                        </div>
                                    </div>
                                </div>
<?php } ?>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div id="user_roles" class="modal fade"
     data-header-color="#736086" data-backdrop="static" data-keyboard="false" data-width="30%">
    <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" id="roles_mdal_cancel">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
            <span id="rolehead"></span>
        </h4>
    </div>
    <div class="modal-body">
        <div class="clr"></div>
        <div>
<?php
$column_head = array($ui_string['checkbox'], $ui_string['role']);

$row_data = array();
foreach ($role as $roles) {
    if (!in_array($roles['id'], array('5914012c6d95579a643c986a', '5ce0fc3390941bde153c9879', '5cefe4b890941ba7393c986a'))) {
        if ($get_user_login['role'] == '5cf4c668518be4001e000032') {
            if ($roles['id'] == '5cf4c684518be4b40900003b') {
                array_push($row_data, array("id" => $roles['id'], "title" => $roles['title']));
            }
        } else {
            array_push($row_data, array("id" => $roles['id'], "title" => $roles['title']));
        }
    }
}
?>
            <ul class="list-group">
            <?php
            foreach ($row_data as $role) {
                if ($get_user_login['role'] == '5cf4c668518be4001e000032') {
                    ?>
                        <li class="list-group-item"><input id="ch_<?php echo $role['id']; ?>" class="check_box_role ads_permission ads_Checkbox chk addUser editUser" value="<?php echo $role['id']; ?>" data-error-setting="2" data-error-show-in="erole" data-error-text="Please Select A Role" name="numbers[]" onclick="select_user_type(this.value, 'admin', '<?php echo ucfirst($role['title']); ?>')" type="radio" checked > <label><?php echo ucfirst($role['title']); ?></label>
                        </li>
        <?php
    } else {
        ?>
                        <li class="list-group-item"><input id="ch_<?php echo $role['id']; ?>" class="check_box_role ads_permission ads_Checkbox chk addUser editUser" value="<?php echo $role['id']; ?>" data-error-setting="2" data-error-show-in="erole" data-error-text="Please Select A Role" name="numbers[]" onclick="select_user_type(this.value, 'superadmin', '<?php echo ucfirst($role['title']); ?>')" type="radio"> <label><?php echo ucfirst($role['title']); ?></label>
                        </li>

        <?php
    }
}
?>  
            </ul> 
        </div>
        <button type="button" data-dismiss="modal" class="btn btn-theme-inverse pull-right" style="margin-top: 10px; margin-bottom: 10px;">OK</button>
    </div>
</div>

<div id="user_machine" class="modal fade"
     data-header-color="#736086" data-backdrop="static" data-keyboard="false" data-width="30%">
    <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
            <span id="machinehead">Machine</span>
        </h4>
    </div>
    <div class="modal-body">
        <div class="clr"></div>
        <div>
<?php
$column_head_machine = array($ui_string['checkbox'], $ui_string['machine']);

$row_data_machine = array();
$get_machine = get_resource_by_id(array('type' => 'machine', 'fields' => 'name'));
if (isset($get_machine['success']) && $get_machine['success'] == 'true') {
    foreach ($get_machine['data'] as $machine_data) {
        if ($machine_data['id'] != $user_id) {
            array_push($row_data_machine, array("id" => $machine_data['id'], "name" => $machine_data['name']));
        }
    }
}
?>
            <ul class="list-group">
                <?php foreach ($row_data_machine as $machine_data) { ?>
                    <li class="list-group-item"><input id="ch_<?php echo $machine_data['id']; ?>" class="ads_permission ads_Checkbox_machine chk addUser editUser" value="<?php echo $machine_data['id']; ?>" name="machine[]" type="checkbox" <?php if (isset($machine) && !empty($machine)) {
                    if (in_array($machine_data['id'], $machine)) {
                        echo "checked";
                    }
                } ?> > <label><?php echo ucfirst($machine_data['name']); ?></label>
                    </li>

                    <?php
                }
                ?>  
            </ul>
        </div>
        <button type="button" data-dismiss="modal" class="btn btn-theme-inverse pull-right">OK</button>
    </div>
</div>
<style type="text/css">

</style>