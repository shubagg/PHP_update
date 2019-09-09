<?php get_admin_header(); ?>
<?php get_admin_header_menu($language); ?>
<?php get_admin_left_sidebar(); ?>
<?php 
if(check_user_permission('attendance', 'dailyAttendance', 'all')!='1' && check_user_permission('attendance', 'dailyAttendance', 'view')!='1' ) 
{

        $editPermission = true;
        $assignPermission = true;
        include_once(include_admin_template("customTemplates","unauthorised")); 
        die;
}
?>
<div id="main" class="dashboard">
<?php 
        
    $advanced_search = $this->get_advance_search(); 
    if($advanced_search){
?>
<span class="top-advance-search"><button class="btn btn-default adv_srch" style="background: transparent; border: none;" >Advance Search <i class="fa fa-plus-circle" aria-hidden="true"></i></button></span>
<?php
  include_once(include_admin_template("common_templates/default", "default_advanced_search"));   
}

?>
<ol class="breadcrumb">
 <li><?php echo $ui_string['admin'];?> </li> <li><?php echo $ui_string['attendance'];?></li><li class="active"> <?php echo $ui_string['view_attendance'];?></li></ol>
    <div id="content">
        <div class="row">
            <div class="col-lg-12">
                <!--------------------------------- Include Page Header ------------------------------------------>
        <?php 

          include_once(include_admin_template("common_templates/attendanceview", "page_header"));
        ?>
                
                <!--------------------------------- Include Advanced Search ------------------------------------------>
                
            <?php 
                    $advanced_search = $this->get_advance_search();
                    if($advanced_search)
                    {
                        include_once(include_admin_template("common_templates/attendanceview", "advanced_search"));    
                    }
                    
                    
               

            ?>
                
<!------------------------------ Include Listing Page -------------------------------------->
            
            <?php 
                $listing_data = $this->customise_listing_data();
                if(isset($listing_data['status']) && $listing_data['status']=='true')
                {
                   include_once(include_admin_template("common_templates/attendanceview", "listing1"));
                }
            ?>
                
            </div>
        </div>
        <!-- //content > row-->
    </div>
</div>
<!--<div class="modal-scrollable z-1060">-->
<?php /* ?>
<div id="table_header_setting" class="modal fade container in" tabindex="-1" aria-hidden="false" >
<div class="modal-header">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
        <?php echo $ui_string['select_fields']; ?>
        </h4>
   </div>
				</div>
				
				</div>
                        <!-- //modal-header-->
    <div class="modal-body">
                          
        <div class="clr"></div>
             <div class="modal_data" id="modal_data">
                           
 
             </div> 
        </div>
                        <!-- //modal-body-->
        </div>
<!--</div>-->
<?php */ ?>
<script type="text/javascript">
    function changeData()
    {
        var fromDate = $('#fromDate').val().trim();
        var toDate = $('#toDate').val().trim();
        
        if( typeof columns_listing != 'object' ) {

            columns_listing = JSON.parse(columns_listing);
        }
        if(fromDate=='')
        {
            $('#e_fromDate').html(ui_string['fromDate']);
            $('#fromDate').focus();
            return false;
        }
        else if(toDate=='')
        {
            $('#e_toDate').html(ui_string['toDate']);
            $('#toDate').focus();
            return false;
        }
        else if(fromDate > toDate)
        {
            $('#e_toDate').html(ui_string['toDateNotless']);
            $('#toDate').focus();
            return false;
        }
        columns_listing['api_params']['fromDate'] = fromDate;
        columns_listing['api_params']['toDate'] = toDate;
        $('#fDate').html(fromDate);
        $('#tDate').html(toDate);

        make_datatable();


    }
</script>
<?php get_admin_footer(); ?>
