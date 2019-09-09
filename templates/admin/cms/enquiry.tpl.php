<div id="main">
<script>
function checkalldata(){}
</script>
      <div id="content">
        <div class="row">
                
                
                <section class="panel top-gap">
          <header class="panel-heading">
          <div class="row">
          
            <div class="col-md-4 margn_tp_7">
            
                <h3><strong>Enquiry</strong> <?php echo $ui_string['list']; ?> </h3>
                
            
            </div>
            
            
          </div>
          </header>
          
            <div class="panel-body panel_bg_d">
                       
                        
              <div class="table-responsive">
                            
                            <?php
                        if(check_user_permission("cms","enquiry","all")==1)
                        {
                              
                            $column_head=array($ui_string['name'],$ui_string['email'],$ui_string['mobile'],$ui_string['message'],$ui_string['action']);  
                            $show_fields=array('name','email','mobile','message','action');
                        }
                        else
                        {
                             $column_head=array($ui_string['name'],$ui_string['email'],$ui_string['mobile'],$ui_string['message']);  
                            $show_fields=array('name','email','mobile','message');
                            
                        }
               
                    $All_data=array("head"=>$column_head);
                    $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                            
                             
                                 get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/enquiry_datatable_ajax.php"); 
                                
                            
                            
                           ?>    
              </div>
            </div>
          </section>
                  <div>

  <!-- Nav tabs -->

              
          

        





             <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
                <div class="modal-header">
                    <button  type="button" class="close"></button>
                    
              
                                <h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>
                </div>
                <!-- //modal-header-->
              <div class="modal-body text_alignment">
                    <div class="button_holder"> 
                           <p><strong id="error_body"></strong></p>
                    </div>
                </div>
                <!-- //modal-body-->
                </div>



                    
        </div>
        <!-- //content > row-->
      </div>
      <!-- //content-->
    </div>
    <!-- //main-->


            
        
 

        
        
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
        
                    
             
            
         
  </div>
