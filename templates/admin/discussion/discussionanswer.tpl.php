<div id="main">

			<div id="content">
				<div class="row">
					<div class="button_holder">
						<div class="popover-area-hover align-lg-center">

							<?php 

								$condition=array();
                                $box1=array('name'=>$ui_string['myview'],'icon'=>'glyphicon glyphicon-user','attr'=>'href="discussion.php"');
                                $box2=array('name'=>$ui_string['forapp'],'icon'=>'glyphicon glyphicon-user','attr'=>'href="discussionanswer.php"');
                                $box3=array('name'=>$ui_string['byuser'],'icon'=>'glyphicon glyphicon-user','attr'=>'href="discussionuserby.php"');

                                array_push($condition,$box1,$box2,$box3);
								include_admin_template_params("blog","box",$condition); 
                            ?>

						</div>
					</div>

					<?php if(check_user_permission("blog","all")==1){?>

					<section class="panel">
						<div class="panel-body">
                            <section class="long_search_bar2 top-gap">
        						  <ul>
        							  
                                     <li>
        							
        							<!-- <button  type="button" onclick="askquestion_pop()" class="btn btn-theme-inverse" ><i class="fa fa-pencil"></i> <?php echo $ui_string['askqus']; ?></button> -->
        							
        							 </li> 
                                    
                                    
        						  </ul>   
        		             </section>
                        
                        <?php } ?>
                        
							<div class="table-responsive">
                            
                            <?php 
							if(check_user_permission("blog","all")==1)
							{
		                        $column_head=array('Sno','Question','User','Reject','Action');  
					            $button1=array("attr"=>"onclick='askanswer_pop(this.id)'","icon"=>"fa fa-pencil");
		                        //$button2=array("attr"=>"onclick='delete_user(this.id)'","icon"=>"fa fa-trash-o");
		                        
		                        $rbuttons=array($button1);
                            }
						    else
							{
				 				$column_head=array('Sno','Question','User','Reject');  
								$rbuttons="";
							}
                                
                                
                                $user_id=$_SESSION['user']["user_id"];
                                $get_users=curl_post("/get_approval_list",array("userId"=>$user_id,"type"=>"forum"));
                                logger_ui("blog_tpl","",$get_users,5);     //logger
                                $srno=1;
                                $row_data=array();
                                $show_fields=array('sno','question','userId','status','Action');
                                
                                foreach($get_users['data'] as $users)
                                {
                                    

				                    $userdata= get_resource_by_id(array("id"=>$users['userId']));
			                        $username=$userdata['data'][0]['name'];
                                    
                                    $show_info=array();
                                    foreach($show_fields as $fields)
                                    {
                                        $fields=explode("-",$fields);
                                        switch($fields[0])
                                        {
                                             case "sno":
                                                $ret=$srno++;
                                            break;
                                            case "status":
                                                $ret="status-"."1";
                                            break;
                                            
                                          	case "Action":
                                                $ret="Action";
                                            break;
                                            case "userId":
												 $ret=$username;
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


				</div>
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<!-- //main-->


            

	
        
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
            
            <div id="addanswer" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="del1"><i class="fa fa-times"></i></button>
						<h3><?php echo $ui_string['addanswer']?></h3>
				</div>
				<div class="modal-body text_alignment">
                
                <form id="catsearchform"> 
                        
				                
				    <?php echo $ui_string['answer']?>    
					  <div class="clr">
					<textarea name="answer" id="answer" rows="8" cols="60"></textarea>
					<input type="hidden" name="questionid" id="questionid">
					  </div>
					<button type="button" data-dismiss="modal" class="btn btn-inverse top-gap bottom-gap right left-gap">
					  <i class="glyphicon glyphicon-remove-sign"></i>Cancel</button>
					  <button onclick="addanswer();" type="button" class="btn btn-theme-inverse top-gap bottom-gap right" >
					  <i class="fa fa-check-circle"></i> Add</button> 		
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
