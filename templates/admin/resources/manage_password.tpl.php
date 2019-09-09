<div id="main" class="dashboard">
    <?php get_breadcrumb(); ?>
    <script>
        function checkalldata() {
        }
    </script>
    <div id="content">
        <div class="row">
            <section class="panel">
                <header class="panel-heading">
                    <h3><strong><?php echo $ui_string['accountmanagement']; ?></strong> </h3>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        if (check_user_permission("resources", "users", "all") == 1) {
                            $column_head = array($ui_string['name'], $ui_string['email'], $ui_string['password'], $ui_string['action']);
                            $show_fields = array('name', 'email', 'password', 'action');
                        } else {
                            $column_head = array($ui_string['name'], $ui_string['email'], $ui_string['password']);
                            $show_fields = array('name', 'email', 'password');
                        }
                        $All_data = array("head" => $column_head);
                        $table_data = array("table_id" => "data_table_1", "table_data" => $All_data);

                        //get_admin_datatable($table_data);

                        if (check_user_permission("resources", "users", "all") == 1 || check_user_permission("resources", "users", "view") == 1) {
                            get_ajax_datatable($table_data, $show_fields, admin_ui_url() . "resources/ajax/pwd_datatable_ajax.php");
                        }
                        ?>    

                    </div>	
                </div>
            </section>
            <!-- //content > row-->
        </div>
        <!-- //content-->
    </div>
    <!-- //main-->
</div>
<div id="editPwd" class="modal fade in" data-width="300">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
            <?php echo $ui_string['edit']; ?>
        </h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">

        <form id="changePwd" parsley-validate="">
            <?php
            $csrf = new CSRF_Protect();
            $csrf->echoInputField();
            ?>
            <div class="form-group row">
                <div class="col-md-12">	
                    <label class="control-label"><?php echo $ui_string['username']; ?></label>
                    <input type="text" readOnly="readOnly" id="uname" class="form-control parsley-validated" parsley-required="true">
                    <input type="hidden" id="uId" name="uId"> 
                </div>
            </div>
            <div class="form-group row">

                <div class="col-md-12">
                    <label class="control-label"><?php echo $ui_string['password']; ?></label>
                    <input type="text" data-check-valid="blank,gt-5" data-valid-gt-error="<?php echo $ui_string['12017']; ?>" data-error-show-in="epwd" data-error-setting="2" data-error-text="<?php echo $ui_string['1209']; ?>" class="form-control required_field changePwd error1" name="pwd" id="pwd" placeholder=""  />
                    <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="epwd"></li></ul>
                </div> 
            </div>
        </form>
    </div>
    <!-- //modal-body-->
    <div class="modal-footer" id="cng-pwd">				
    </div>
</div>
<!--------------------success,fail message popup---------------------------------------->
<?php echo success_fail_message_popup(); ?> 
<!------------------------end----------------------------------------------------------->
<!--------------------delete_confirmation popup---------------------------------------->
<?php echo delete_confirmation_popup(); ?> 
<!------------------------end----------------------------------------------------------->
<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
