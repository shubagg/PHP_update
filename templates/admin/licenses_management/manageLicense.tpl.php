<div id="main" class="dashboard">
    <?php get_breadcrumb(); ?>
    <script>
        function checkalldata() {}
    </script>
    <div id="content">
        <div class="row">
            <section class="panel">
                <header class="panel-heading overflow_hidden">
                    <span class="pull-left"><h3><strong><?php echo $ui_string['lic_manage']; ?></strong> </h3></span>
                    <span class="pull-right"><h4><?php echo $ui_string['server_expiration']; ?> : <?php echo $company_lecense_expiration; ?></h4></span>
                </header>
                <div class="panel-body">
                    <div class="table-responsive f-table">
                        <?php
                        if (check_user_permission("licenses", "clicense", "all") == 1) {
                            $column_head = array($ui_string['lno'], $ui_string['license'], $ui_string['date_of_expiry'], $ui_string['user'], $ui_string['status'], $ui_string['action']);
                            $show_fields = array('lno', 'license', 'date_of_expiry', 'userId', 'status', 'action');
                        } else {
                            $column_head = array($ui_string['sno'], $ui_string['license'], $ui_string['date_of_expiry'], $ui_string['user']);
                            $show_fields = array('sno', 'license', 'date_of_expiry', 'userId');
                        }
                        $All_data = array("head" => $column_head);
                        $table_data = array("table_id" => "data_table_1", "table_data" => $All_data);
                        //get_admin_datatable($table_data);
                        if (check_user_permission("licenses", "clicense", "all") == 1 || check_user_permission("licenses", "clicense", "view") == 1) {
                            get_ajax_datatable($table_data, $show_fields, admin_ui_url() . "licenses_management/ajax/license_datatable_ajax.php?id=" . $l_company_id);
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

<div id="make_licenses" class="modal fade in" data-width="300">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
<?php echo $ui_string['start_licenses']; ?>
        </h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">

        <form id="makeLicenses" parsley-validate="" method="post">
            <div class="form-group row">
                <div class="col-md-12">	
                    <label class="control-label"><?php echo $ui_string['no_of_licenses']; ?></label>
                    <input type="text" name="no_of_licenses" id="no_of_licenses" data-check-valid="blank" data-error-show-in="eno_of_licenses" data-error-setting="2" data-error-text="Enter No Of Licenses" class="form-control required_field startLicenses error1" >
                    <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eno_of_licenses"></li></ul>
                </div>
            </div>
<?php /* <div class="form-group row">
  <div class="col-md-12">
  <input type="hidden" name="id" id="id" value="">
  <label class="control-label"><?php echo $ui_string['po_number'];?></label>
  <input type="text" data-check-valid="blank" data-error-show-in="epo_number" data-error-setting="2" data-error-text="Enter PO Number" class="form-control required_field startLicenses error1" name="po_number" id="po_number" placeholder=""  />
  <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="epo_number"></li></ul>

  </div>
  </div>
 */ ?>
        </form></div>
    <!-- //modal-body-->
    <div class="modal-footer" id="cng-pwd">
    </div>
</div>
<!--------------------success,fail message popup---------------------------------------->
<?php echo success_fail_message_popup(); ?> 
<!------------------------end----------------------------------------------------------->
<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
