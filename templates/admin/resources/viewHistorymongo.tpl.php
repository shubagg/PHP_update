<div id="main">

        <div id="content">
      <section class="panel" >
        <header class="panel-heading">
          <div class="row">
            <div class="col-md-6 margn_tp_7">
              <h3><strong>View History</strong></h3>
            </div>

        </header>
       

        <div class="panel-body panel_bg_d">
                       
                        
                        
                                <div class="table-responsive table table-striped table-hover dataTable detail-table tooltip-area">
                      
                                <?php 

                                $column_head=array('name','age','action');  
                                $show_fields=array('name','age','action');
                          
                           
                                $All_data=array("head"=>$column_head);
                                $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                    
                                
                                get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/history_datatable_ajax_mongo1.php");

                                ?>


                                </div>
                        </div>
      </section>
    </div>
</div>
