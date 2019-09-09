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
					<section class="panel">
						<div class="panel-body">
                        
							<div class="table-responsive">
                            <?php 
                            if($userwiserecord!="")
                            {
	                            if(check_user_permission("blog","all")==1)
								{
			                        $column_head=array('Sno','Question','Answer','Status');  
						            
			                        //$button1=array("attr"=>"onclick='delete_user(this.id)'","icon"=>"fa fa-trash-o");
			                        
			                        //$rbuttons=array($button1);
	                            }
							    else
								{
					 				$column_head=array('Sno','Question','Answer','Status');  
									$rbuttons="";
								}
	                                $srno=1;
	                                $row_data=array();
	                                $show_fields=array('sno','question','answer','status');

	                            foreach($get_users['data'] as $users)
                                {
                                    
                                    switch ($users['status']) 
                                    {
                                        case '0':
                                                $statusques="Pending";
                                            break;
                                        case '1':
                                                $statusques="Approved";
                                            break;
                                        case '2':
                                                $statusques="Rejected";
                                            break;
                                        default:
                                            
                                            break;
                                    }
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
                                                $ret=$statusques;
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
                            }
                            else
                            {
                            	
								if(check_user_permission("blog","all")==1)
								{
			                        $column_head=array('Sno','User Name','Action');  
						            
			                        $button1=array("attr"=>"onclick='userwiserecord(this.id)'","icon"=>"fa fa-list");
			                        
			                        $rbuttons=array($button1);
	                            }
							    else
								{
					 				$column_head=array('Sno','User Name');  
									$rbuttons="";
								}
                                $srno=1;
                                $row_data=array();
                                $show_fields=array('sno','name','Action');

                                foreach($get_users as $users)
                                {
                                    $show_info=array();
                                    foreach($show_fields as $fields)
                                    {
                                        $fields=explode("-",$fields);
                                        switch($fields[0])
                                        {
                                            case "sno":
                                                $ret=$srno++;
                                            break;
                                          	case "Action":
                                                $ret="Action";
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

                            }
                  
                                $All_data=array("head"=>$column_head,"rows"=>$row_data);
                                $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                
                                get_admin_datatable($table_data);
                             ?>       
							</div>
						</div>
					</section>


				</div>
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<!-- //main--> 
	</div>
	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
