<?php include_once '../../../../../global.php';

$stateId=$_POST['stateId'];

?>

<div class="modal fade in" id="cityPopup" role="dialog" data-backdrop="static" data-width="900" data-keyboard="false">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php 
                                      $condition=array();
                                      $box1=array('name'=>'Add Location','icon'=>'glyphicon glyphicon-user','attr'=>'data-toggle="modal" data-target="#cityaddPopup"',"class"=>"custom_button btn_cu btn btn-default btn-adjesent-to-close");
                                      array_push($condition,$box1);
                                      include_admin_template_params("resources","box",$condition); 
                                  ?>

            <h4 class="modal-title">Location</h4>
    </div>
    <div class="modal-body new_panel">
        <div class="table-responsive">
                                <?php 
                                     
                                  $column_head=array('checkbox','Title','Action');  
                                  $show_fields=array('checkbox','title','action');
                                	$All_data=array("head"=>$column_head);
                                	$table_data=array("table_id"=>"data_table_2","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_ui_url()."/events_and_venues/ui/admin/ajax/datatable_ajax_city.php?stateId=".$stateId); 
                                    
                               ?>    
    							</div>
         
       <div style="clear:both;"></div>
    </div>
    <div class="modal-footer">
         
    </div>
</div>
