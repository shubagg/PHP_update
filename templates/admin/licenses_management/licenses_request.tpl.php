<div id="main" class="dashboard">
    <?php get_breadcrumb(); ?>
    <script>
        function checkalldata() {}
    </script>
    <div id="content">
        <div class="row">
            <section class="panel">
                <header class="panel-heading panel-updated">
                    <h3><strong><?php echo $ui_string['lic_req']; ?></strong> </h3>
                </header>
                <div class="panel-body">
                    <div class="table-responsive f-table">
                        <?php
                        if (check_user_permission("licenses", "licenses", "all") == 1) {
                            $column_head = array($ui_string['company'], $ui_string['email'], $ui_string['lic_required'], $ui_string['company_industry'], $ui_string['po_verify'], $ui_string['po_number'], $ui_string['licenses_type'], $ui_string['ip_address'],$ui_string['server_expiry_date'],$ui_string['action']);
                            $show_fields = array('company', 'email', 'lic_required', 'company_industry', 'po_verify', 'po_number', 'licenses_type', 'ip_address', 'server_expiry_date', 'action');
                        } else {
                            $column_head = array($ui_string['company'], $ui_string['email'], $ui_string['lic_required'], $ui_string['company_industry'], $ui_string['po_verify'], $ui_string['po_number'], $ui_string['licenses_type'], $ui_string['ip_address'], $ui_string['server_expiry_date']);
                            $show_fields = array('company', 'email', 'lic_required', 'company_industry', 'po_verify', 'po_number', 'licenses_type', 'ip_address', 'server_expiry_date');
                        }
                        $All_data = array("head" => $column_head);
                        $table_data = array("table_id" => "data_table_1", "table_data" => $All_data);

                        //get_admin_datatable($table_data);
                        //if(check_user_permission("licenses","licenses","all")==1 || check_user_permission("licenses","licenses","view")==1){
                        get_ajax_datatable($table_data, $show_fields, admin_ui_url() . "licenses_management/ajax/datatable_ajax.php");
                        // }
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

<div id="update_ip_address" class="modal fade in" data-width="300">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
            <?php echo $ui_string['title_ip_address']; ?>
        </h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <form id="updateIpAddress" parsley-validate="" method="post">
            <div class="form-group row">
                <div class="col-md-12">	
                    <label class="control-label"><?php echo $ui_string['ip_address']; ?></label>
                    <input type="hidden" name="license_req_id" id="license_req_id" value="">
                    <input type="text" name="ip_address" id="ip_address" data-check-valid="blank" data-error-show-in="eno_of_licenses" data-error-setting="2" data-error-text="Enter IP Address" class="form-control required_field ipAddress error1" >
                    <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eno_of_licenses"></li></ul>
                </div>
            </div>
<?php /* <div class="form-group row">
  <div class="col-md-12">

  <label class="control-label"><?php echo $ui_string['po_number'];?></label>
  <input type="text" data-check-valid="blank" data-error-show-in="epo_number" data-error-setting="2" data-error-text="Enter PO Number" class="form-control required_field startLicenses error1" name="po_number" id="po_number" placeholder=""  />
  <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="epo_number"></li></ul>

  </div>
  </div>
 */ ?>
        </form></div>
    <!-- //modal-body-->
    <div class="modal-footer" id="cng-ip">
    </div>
</div>

<div id="update_server_configuration" class="modal fade in" data-width="300">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
            <?php echo $ui_string['title_server_configuration']; ?>
        </h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <form id="updateServerConfiguration" parsley-validate="" method="post">
            <div class="form-group row">
                <div class="col-md-12">	
                    <label class="control-label"><?php echo $ui_string['server_expiry_date']; ?></label>
                    <input type="hidden" name="company_id" id="company_id" value="">
                    <input type="text" data-check-valid="blank" data-error-show-in="eno_of_licenses" data-error-setting="2" data-error-text="Enter date" class="form-control required_field error1 updateServerConfiguration" name="server_expiry_date" id="server_expiry_date" placeholder="yyyy-mm-dd">
                    <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eno_of_licenses"></li></ul>
                </div>
            </div>
        </form>
    </div>
    <!-- //modal-body-->
    <div class="modal-footer" id="footer_company_server_configuration">
    </div>
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
                    <input type="hidden" name="id" id="id" value="">
                    <input type="text" name="no_of_licenses" id="no_of_licenses" data-check-valid="blank" data-error-show-in="eno_of_licenses" data-error-setting="2" data-error-text="Enter No Of Licenses" class="form-control required_field startLicenses error1" >
                    <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eno_of_licenses"></li></ul>
                </div>
            </div>
<?php /* <div class="form-group row">
  <div class="col-md-12">

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
