<div id="main">
<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li><a href="#">Library</a></li>
						<li class="active" onclick="export_data('user')">Data</li>
				</ol>
			

			<div id="content" style="padding:15px;" >

	<section class="panel">
							<div class="display_block" onclick="export_data('user')">
                <div class="custom_button btn btn-default">
                  
                  <i class="glyphicon glyphicon-export"></i><br /> <span><?php echo $ui_string['export_list'];?></span>
                </div>
              </div>
			<div class="panel-body " id="reportdata">

				<?php 
                   
                         
                    $column_head=array($ui_string['name'],'Total Devices','Running','Idle','Stop','Inactive');  
         			$show_fields=array('name','total_devices','running','idle','stop','inactive');
                    
                    
                      
                    $All_data=array("head"=>$column_head);
                    $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                        
                    get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/datatable_ajax.php?user_type=user&ucheck=report&allUsers=true"); 
                        
                   ?> 
	</div>

<div id="map" style="" style="display:none">
                                                        
                                                        </div>
                                                        
                                                        
                                                    
                                                                                                                
</section>
    
		
    
  </div>
  
			<!-- //content-->



		</div>
	
		<!-- //main-->


            
        
        
        <?php 
        /*$field='
        <div class="form-group">
                      <label class="control-label no_padding remove_bg">'.$resourse["select_category"].'<font color="red">*</font></label>
                      <div>
                        <select id="pcategory" class="form-control" name="pcategory">
                            <option value="0">'.$resourse["parent_category"].'</option>
                            '.$dat=get_category_tree($all_cats,0).
                            show_category_accordians($dat,"-",0,1).'
                        </select> 
                      </div>
                    </div>
        ';
        
        $field1='
        
        ';*/
        
       // echo show_popup('add_category1','addCategory1',$resourse['close'],$field);
        
        
        ?>


<div id="add_category" class="modal fade" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" id="close_group">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
              <h4 class="modal-title"><span id="cathead"></span></h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
              <form class="form-horizontal" data-collabel="2" data-label="color" id="addCategory">
              
                    <div class="form-group">
                      <label class="control-label no_padding remove_bg"><?php echo $resourse['select_category'];?><font color="red">*</font></label>
                      <div>
                        <select id="pcategory" class="form-control" name="pcategory">
                            <option value="0"><?php echo $resourse['parent_category'];?></option>
                            
                            
                             <?php show_category_accordians($dat,'-',0,1,'');?>
                        </select> 
                      </div>
                    </div>
              
                   
                   	<input type="hidden" name="cat_add" value="cat_add"/>
                   	<input type="hidden" name="cat_id" id="cat_id" value="0"/>
                     
                    	<input type="hidden" name="category_code" value="profile"/>
                    <?php  echo get_data_field('text',$resourse['name'],'categoryname','categoryname','required_field addCategory updateCategory','data-check-valid="blank,no_special" data-valid-nospecial-error="Please enter valid category name" data-error-show-in="ecategoryname" data-error-setting="2" data-error-text="Please enter category name"','','',''); ?>
                   
                   
                  
                   <?php  //echo get_data_field('text',$resourse['code'],'category_code','category_code','required_field addCategory updateCategory','data-check-valid="blank,no_special" data-valid-nospecial-error="Please enter valid category code" data-error-show-in="ecategory_code" data-error-setting="2" data-error-text="Please enter category code"','','','','profile'); ?>
                
        	   
        	   	<button type="button" class="btn btn-inverse btn_width right bottom-gap"  data-dismiss="modal">
        		<i class="glyphicon glyphicon-remove-circle"></i> <?php echo $resourse['close'];?></button>
        		<span id="groupbut"></span>
              </form>
            </div>
            <!-- //modal-body-->
            
            
    </div>
	
        <!--------------------success,fail message popup---------------------------------------->
        
        
                 <?php echo success_fail_message_popup();?> 
                 
                    
        <!------------------------end----------------------------------------------------------->
        
        
        <!--------------------delete_confirmation popup---------------------------------------->
        
        
                 <?php echo delete_confirmation_popup();?> 
                 
                    
        <!------------------------end----------------------------------------------------------->
        
                    
                    
             
            
            <div id="basic_search" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="del1"><i class="fa fa-times"></i></button>
						<h3><i class="glyphicon glyphicon-search"></i> Search</h3>
				</div>
				<div class="modal-body text_alignment">
                <span class="searcherrorcat" style="color: red;" class="error"></span>
                       <form id="catsearchform"> 
                        
                        <table>
                       	<?php
                            
                            show_accordian($dat,'',0,1,'user_category',$category_data,$user_id);
                        ?>
                        </table>       
				        
					  <div class="clr"></div>
					  
					
					<button type="button" data-dismiss="modal" class="btn btn-inverse top-gap bottom-gap right left-gap">
					  <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
					  <button onclick="get_category_user()" type="button" class="btn btn-theme-inverse top-gap bottom-gap right" >
					  <i class="glyphicon glyphicon-search"></i> Search</button> 		
					 </form> 
				</div>
		  </div>
	</div>
	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
