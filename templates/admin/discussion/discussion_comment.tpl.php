<div id="main">

			<div id="content">
				<div class="row">
					<div class="button_holder">
						<div class="popover-area-hover align-lg-center">

							

						</div>
					</div>

					

					<section class="panel">
						<div class="panel-body">
                            <section class="long_search_bar2 top-gap">
        						  <ul>
        							<li><span  class="checkbox"  data-color="red" >
        									<input type="checkbox" id="check11" onclick="checkall()" />
        									<a href="javascript:;"><strong><label for="check11" style="font-size:14px; font-weight:bold;">Select All</label></strong></a>
        							   </span>
                                    </li>
        		                        
                                     <li>
        							
        							 <button type="button" onclick="delete_users_temp()" class="btn btn-theme-inverse"><i class="glyphicon glyphicon-trash"></i> <?php echo $ui_string['delete']; ?></button>
        							
        							 </li> 
                              
                                    
        						  </ul>   
        		             </section>
                        
                        
                        
							<div class="table-responsive">
                            
                            <?php 
                                $column_head=array('checkbox','Comment','status','Action');  
                                
                                
                                $button1=array("title"=>"Delete","attr"=>"onclick='delete_user(this.id)'","icon"=>"fa fa-trash-o");
                               
                               
                                //$button2=array("title"=>"Status","attr"=>"onclick=change_status(this.id)","icon"=>"glyphicon glyphicon-off");
                                
                                $rbuttons=array($button1);
                                
                                $id=$_REQUEST['id'];
                                
                                $get_users=curl_post("/get_comments",array("amid"=>6,"asmid"=>1,"aiid"=>$id));   ///get comment list..
                                

                                logger_ui("blog_tpl","",$get_users,5);     //logger
                                
                                $row_data=array();
                                $show_fields=array('checkbox','comment','status','Action');
                              
                                foreach($get_users['data'] as $users)
                                {

                                    $show_info=array();
                                    foreach($show_fields as $fields)
                                    {
                                        $fields=explode("-",$fields);
                                        switch($fields[0])
                                        {
                                            case "checkbox":
                                                $ret="checkbox";
                                            break;
                                            case "Action":
                                                $ret="Action";
                                            break;
                                          case "status":
                                                $ret="status-".$users['status'];
                                            break;
                                            default :
                                                $ret=$users[$fields[0]];
                                            break;
                                        }
                                        array_push($show_info,$ret);
                                    }
                                    
                                    $ar=array("id"=>$users['id'],"data"=>$show_info,"Action"=>$rbuttons);
                                    array_push($row_data,$ar);
                                }
                               
                  
                                $All_data=array("head"=>$column_head,"rows"=>$row_data);
                                $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                
                                get_admin_datatable($table_data);
                             ?>    
							</div>
						</div>
					</section>

					<div id="add" class="modal fade" data-width="300">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<i class="glyphicon glyphicon-plus-sign"></i> Add
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body center_button">
							<a href="student_info_form.html">
								<div class="popup_button_1">
									 Add Student
								</div>
							</a> <a href="#">
								<div class="popup_button_2">
								    Add Employee
								</div>
							</a>
						</div>
						<!-- //modal-body-->
					</div>

					

					<div id="roles" class="modal fade container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<i class="glyphicon glyphicon-plus-sign"></i> Add Role
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
							<a onclick="open_add_role('add')" class="right">
								<button type="button" class="btn btn-theme-inverse bottom-gap">
									<i class="glyphicon glyphicon-plus-sign"></i> Add Role
								</button>
							</a>
							<div class="clr"></div>
							 
                           <?php
                                $get_roles=$get_roles['roles'];
                                
                                $column_head=array('Name','Action');  
                                $row_data=array();
                                
                                $button1=array("title"=>"Edit","attr"=>"onclick='open_add_role(\"update\",this.id)'","icon"=>"fa fa-pencil");
                                $button2=array("title"=>"Delete","attr"=>"onclick='delete_role(this.id)'","icon"=>"fa fa-trash-o");
                                $buttons=array($button1,$button2);
                                
                                foreach($get_roles as $roles)
                                {
                                    array_push($row_data,array("id"=>$roles['id'],"data"=>array($roles['name'],'Action'),"Action"=>$buttons));
                                }
                                
                                
                                
                                $All_data=array("head"=>$column_head,"rows"=>$row_data);
                                $data=array("table_id"=>"data_table_3","table_data"=>$All_data);
                                get_admin_datatable($data);
                            ?>  
                             
                             
						</div>
						<!-- //modal-body-->
					</div>
					<!-- //Role popup ends-->
					<div id="add_roles" class="modal fade"
						data-header-color="#736086">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								 <span id="rolehead"></span>
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
							<form class="form-horizontal" data-collabel="2" data-label="color" id="addRole">
								<div class="form-group">
									<label class="control-label remove_bg">Role Name</label>
									<div>
                      	<input type="hidden" name="role_add" value="role_add">
                      	<input type="hidden" name="role_id" id="role_id">
                        <input type="text" class="form-control txt required_field addRole" data-check-valid="blank" data-error-show-in="erole" data-error-setting="2" data-error-text='Please enter role name' id="rolename" name="rolename"/> <span style="color: red;" id="groupname1"> </span>
                        <span id="erole" class="error"></span>
                      </div>
								</div>
                                
                               <?php  if(!empty($get_modules)){foreach($get_modules as $key => $element){
								            
                                            foreach($element as $subkey => $subelement){
                                            ?>
								<div class="form-group">
									<label class="control-label remove_bg"><?php echo $subelement['name'];?></label>
									<div>
										<ul class="" data-color="red">
                                        <?php 
                                        $permissions=$subelement['permissions'];
                                        if($permissions!=''){ $per=explode(",",$permissions);
                                        foreach($per as $v){
                                        ?>
											<li><input class="ads_Checkbox" type="checkbox" id="ich-<?php echo $subelement['id']."-".$v; ?>" name="permissions[]" value="<?php echo $subelement['id']."-".$v; ?>" /> <label><?php echo $v;?></label></li>
											
										<?php } } ?>
											
										</ul>
									</div>
								</div>
                                
                                
                                <?php } } } ?>
								
								

								<button type="button" data-dismiss="modal"
									class="btn btn-inverse btn_width right bottom-gap">
									<i class="glyphicon glyphicon-remove-circle"></i> Close
								</button>
								
                                <span id="grouprole"></span>
							</form>
						</div>
						<!-- //modal-body-->
					</div>

                    <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
        				<div class="modal-header">
        						<button  type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        						
              
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



					<div id="categories" class="modal fade container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<i class="glyphicon glyphicon-list-alt"></i> Categories
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
							<a onclick="open_add_category('add')" class="right">
								<button type="button" class="btn btn-theme-inverse bottom-gap">
									<i class="glyphicon glyphicon-plus-sign"></i> Add Category
								</button>
							</a>
							<div class="clr"></div>
							
                            <?php
                                $categories=$categories['category'];
                                
                                $column_head=array('Name','Action');  
                                $row_data=array();
                                
                                $button1=array("title"=>"Edit","attr"=>"onclick='open_add_category(\"update\",this.id)'","icon"=>"fa fa-pencil");
                                $button2=array("title"=>"Delete","attr"=>"onclick='delete_category(this.id)'","icon"=>"fa fa-trash-o");
                                $buttons=array($button1,$button2);
                                
                                foreach($categories as $category)
                                {
                                    array_push($row_data,array("id"=>$category['id'],"data"=>array($category['name'],'Action'),"Action"=>$buttons));
                                }
                                
                                
                                
                                $All_data=array("head"=>$column_head,"rows"=>$row_data);
                                $data=array("table_id"=>"data_table_2","table_data"=>$All_data);
                                get_admin_datatable($data);
                            ?>
                            
                            
						</div>
						<!-- //modal-body-->
					</div>
				</div>
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<!-- //main-->


            
        
        
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
                            <?php $dat=get_category_tree($all_cats,0); ?>
                            
                             <?php show_category_accordians($dat,'-',0,1);?>
                        </select> 
                      </div>
                    </div>
              
                   <div class="form-group">
                      <label class="control-label no_padding remove_bg"><?php echo $resourse['name'];?> <font color="red">*</font></label>
                      <div>
                      	<input type="hidden" name="cat_add" value="cat_add">
                      	<input type="hidden" name="cat_id" id="cat_id">
                        <input type="text" class="form-control txt required_field addCategory" data-check-valid="blank" data-error-show-in="ecategory" data-error-setting="2" data-error-text='Please enter category name' id="categoryname" name="categoryname"/> <span style="color: red;" id="groupname1"> </span>
                        <span id="ecategory" class="error"></span>
                      </div>
                   </div>
                   
                   <div class="form-group top-gap c_textarea">
        				<label class="control-label no_padding remove_bg"><?php echo $resourse['description'];?> <font color="red">*</font></label>
        				<div>
        				 	<input type="text" class="form-control txt required_field addCategory"  id="category_code" name="category_code" data-check-valid="blank" data-error-show-in="ecode" data-error-setting="2" data-error-text='Please enter category code' placeholder=""/>
        				    <span id="ecode" class="error"></span>
                        </div>
                  </div>
                
        	   
        	   	<button type="button" data-dismiss="modal" class="btn btn-inverse btn_width right bottom-gap">
        		<i class="glyphicon glyphicon-remove-circle"></i> <?php echo $resourse['close'];?></button>
        		<span id="groupbut"></span>
              </form>
            </div>
            <!-- //modal-body-->
            
            
    </div>

	
        
                 <div id="success_modal" class="modal fade"
						data-header-color="#736086">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title" id="model_head">
								<i class="glyphicon glyphicon-ok-circle"></i> Confirmation
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body text_alignment">
							<div class="confirmation_successful">
								<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
								<span id="model_des">Confirmation Successful</span>
							</div>
						</div>
						<!-- //modal-body-->
					</div> 
                    
                    
                    
            <div id="sure_to_delete" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Are you sure?</h4>
                    </div>
                    <!-- //modal-header-->
                    <form class="form-horizontal" data-collabel="2" data-label="color" id="deleteData">
                    <div class="modal-body text_alignment">
                    <div class="button_holder"> 
                    
                    <div id="deletType">
                    
                    					</div>
                    				    </div>
                    				</div>
                    </form>                
				<!-- //modal-body-->
		    </div> 
            
            <div id="basic_search" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="del1"><i class="fa fa-times"></i></button>
						<h3><i class="glyphicon glyphicon-search"></i> Search</h3>
				</div>
				<div class="modal-body text_alignment">
                <span class="searcherrorcat" style="color: red;" class="error"></span>
                       <form id="catsearchform"> 
                        
				                
				        
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
