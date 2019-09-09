<div id="main">
<?php get_breadcrumb(); ?>
<script>
function checkalldata(){}
</script>
            <div id="content">
                <div class="row">
                
                <div class=""><?php
                if(check_user_permission("dashboard","dashboard","add")==1 || check_user_permission("dashboard","dashboard","all")==1){ ?>
                        <div class="popover-area-hover align-lg-right">
<a onclick="manage_dashboard('addDashboard','')">
<div class="display_block">
        <div class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
            <span><?php echo $ui_string['create_new_dash'];?></span>
        </div>
</div>
</a>

                        </div>
                        <?php }
                        ?>
                    </div>
               
                <section class="panel">
                    <header class="panel-heading">
                    <div class="row">
                    
                    <div class="col-md-4 margn_tp_7">
                        
                                <h3><strong></strong><?php echo $ui_string['dashboard'];?></h3>
                                
                        
                        </div>
            <?php if(check_user_permission("resources","users","all")==1){?>
                        <div class="col-md-8">
                 
                       
                        </div>

            <?php } ?>
                        
                    </div>
                    </header>
   

             <div class="panel-body panel_bg_d">
             <?php 
             if(check_user_permission("dashboard","dashboard","view")==1 || check_user_permission("dashboard","dashboard","all")==1){ ?>
                       
             <div class="table-responsive">
                            
                            <?php 
                            $column_head=array($ui_string['name'],$ui_string['created_on'],$ui_string['template_type'],$ui_string['action']);
                            $show_fields=array('dash_name','creation_date','template_type','action');   
                            $All_data=array("head"=>$column_head);
                            $table_data=array("table_id"=>"dashboard","table_data"=>$All_data);
                                
                            //get_admin_datatable($table_data);
                            
                             // if(check_user_permission("resources","users","all")==1 || check_user_permission("resources","users","view")==1){
                                 get_ajax_datatable($table_data,$show_fields,admin_ui_url()."dashboard/ajax/dash_datatable_ajax.php"); 
                                //}
                            
                            
                           ?>    
              </div>
              <?php }  else {
               $companyData=get_company_data();  
               $company_name=ucfirst($companyData['cname']); ?>
              <div class="col-md-12 margn_tp_7 text-center margn-tp-20">
                <h3>Welcome To  <?php echo $company_name; ?></h3>
                                 <h4 class="margn-tp-10">No Dashboard To Display</h4>
              </div>
              <?php } ?>     
                        </div>

                    </section>
                  <div>
  
                    </div>
                    <div id="dashboard_popup" class="modal fade" data-width="800" data-backdrop="static" data-keyboard="false">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">
                                <i class="fa fa-times"></i>
                            </button>
                            <h4 class="modal-title" id='DashTitle'>
                           <?php //echo $ui_string['create_new_dash'];?>
                            </h4>
                        </div>
                        <!-- //modal-header-->
                        <div class="modal-body">
                         
                            <form class="form-horizontal labelcustomize" data-collabel="4" data-label="color" name="addCategory" id="addCategory" method="post">
                     <div class="form-group ">
    <label class="control-label remove_bg col-md-4"><span class="color"><?php echo $ui_string['name'];?><font color="red">*</font></span></label>
    <div class="col-md-4">
        <input type="text" id="categoryname" name="categoryname" data-check-valid="blank,nospecial" data-valid-nospecial-error="Please Enter Valid Dashboard Name" data-error-show-in="ecategoryname" data-error-setting="2" data-error-text="Please Enter Dashboard Name" class="form-control required_field addCategory updateCategory" value="" placeholder="">
        <span id="ecategoryname" class="error"></span>
    </div>
</div> 

<!-- ////////////////////   USER_ID    /////////////////////// -->

    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user']['user_id'] ?>" >
    <input type="hidden" id="dashid" name="dashid" value="" >

<div class="form-group ">
  <label class="control-label remove_bg col-md-4"><span class="color"><?php echo $ui_string['desc'];?><font color="red">*</font></span></label>
  <div class="col-md-4">
    <textarea rows="4" cols="50" id="categorydescription" name="categorydescription" data-check-valid="blank"data-error-show-in="ecategorydescription" data-error-setting="2" data-error-text="Please Enter Description" class="form-control required_field addCategory updateCategory" value="" placeholder=""></textarea>
      <span id="ecategorydescription" class="error"></span>
    </div>
</div> 
<?php
if(check_user_permission("dashboard","dashboard","global_dashboard")==1 || check_user_permission("dashboard","dashboard","all")==1){ ?>
<div data-type="DASH_TYPE" class="renderComponents" data-html-label="<?php echo $ui_string['dash_type'];?>" data-html-name="priglob" data-html-type="radio" data-html-item="<?php echo $ui_string['private']; ?>:1:pri:checked:onclick=RemoveButton()|<?php echo $ui_string['global']; ?>:0:glob::onclick=GetButton();"></div>
<div id="manageDash" style="display: none;">
        <div data-type="CHECK_BOX" class="renderComponents"  data-html-name="manage_dashboard[]" data-html-type="checkbox" data-html-item="<?php echo $ui_string['man_dashboard']; ?>:1:manage_dashboard|<?php echo $ui_string['man_widget']; ?>:0:manage_gadget"></div>
        </div>
                  
                        <?php } ?>

                   <div class="col-md-12">
<div class="col-md-4">
  <label style="font-weight: normal;font-size: 15px; margin-left: -6px;">
<?php echo $ui_string['choose_dash_layout'];?>
  </label>
</div>

              <div class="col-md-8 text-right">
               <div class="row">
              <script>
              function setVal(val)
              {
                
                  $("#tplType").val(val);

                  if(val==1)
                  {
                    $("#2").removeClass("active");
                    $("#3").removeClass("active");
                    $("#1").addClass("active");                    
                  }
                  else if(val==2)
                  {                    
                    $("#1").removeClass("active");                   
                    $("#3").removeClass("active");
                    $("#2").addClass("active");                    
                  }
                   else if(val==3)
                  {
                    $("#1").removeClass("active");
                    $("#2").removeClass("active");
                    $("#3").addClass("active");
                 
                  }
              }
              </script>


              <input type="hidden" name="tplType" id="tplType" value='1'>

              <div class="col-md-4 border-chart-div active" onclick="setVal('1')" id="1">
              
              <div class="col-md-12  border-chart chartTpl"></div>
                              
              </div>
               <div class="col-md-4 border-chart-div" onclick="setVal('2')" id="2" >
             
              <div class="col-md-12  border-chart1 chartTpl"></div>
                              </div>
                <div class="col-md-4 border-chart-div" onclick="setVal('3')" id="3">
             
              <div class="col-md-12  border-chart2 chartTpl"></div>
                              </div>
              
              <!-- <div class="col-md-4 border-chart-div">
             
              <div class="col-md-12  border-chart3"></div>
                              </div> -->
               <!-- <div class="col-md-4 border-chart-div">
             
              <div class="col-md-12  border-chart4"></div>
                              </div> -->
                               
               </div>
              </div>
              
              </div>
              
                                   
              </form>       
<div class="col-xs-12 text-right margn-tp-20" id="dashSub"><!-- <button type="button" class="btn btn-theme-inverse" id="create_dash" onclick="return validation('addCategory');"> <?php echo $ui_string['submit'] ?><button> -->
</div>
              
                            <div class="clr"></div>
                            
                           
                        </div>
                        <!-- //modal-body-->
                    </div>
                    
                </div>
                <!-- //content > row-->
            </div>
            <!-- //content-->
              
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?>

    </div>
