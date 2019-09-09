<div id="main">
<script>
function checkalldata(){}
</script>
 <div id="content">
  <div class="row">
   <div class="button_holder">
            <div class="popover-area-hover align-lg-right">
            <?php 
             $condition=array();
             $box1=array('name'=>$ui_string['add'],'icon'=>'glyphicon glyphicon-user','attr'=>'href="test.php"','class'=>"custom_button btn_cu btn btn-default");
             if(check_user_permission("resources","users","all")==1)
             {
               array_push($condition,$box1);
             }
             $box2=array('name'=>$ui_string['categories'],'icon'=>'glyphicon glyphicon-list-alt','attr'=>'onclick="$(\'#categories\').modal();"',"class"=>"custom_button btn btn-default btn_cu ");
                if(check_user_permission("resources","users","category_all")==1 || check_user_permission("resources","users","category_view")==1)
                {
                  array_push($condition,$box2);
                }                               
             $box3=array('name'=>$ui_string['roles'],'icon'=>'glyphicon glyphicon-user','attr'=>'onclick="$(\'#roles\').modal();"',"class"=>"custom_button btn btn-default btn_cu");
                  if(check_user_permission("resources","users","role_all")==1 || check_user_permission("resources","users","role_view")==1)
                  {
                   array_push($condition,$box3);
                  } 

                include_admin_template_params("resources","box",$condition);
            ?>
            </div>
   </div>
   <section class="panel top-gap">
    <header class="panel-heading">
      <div class="row">
        <div class="col-md-4 margn_tp_7">
          <h3><strong><?php echo $ui_string['users']; ?></strong> <?php echo $ui_string['list']; ?> </h3>
        </div>
        <?php if(check_user_permission("resources","users","all")==1){?>
            <div class="col-md-8">
            <div class="text-right select_all tooltip-area btn-grp">
                        
                        <span class="checkbox slect_aal_btn" data-color="red" >
<input type="checkbox" id="check11" onclick="checkall();" class="all_check" />
<a href="javascript:;"><strong><label for="check11" style="font-size:14px; font-weight:600; color:#AAA;"><?php echo $ui_string['select_all'];?></label></strong></a>
</span>
             <button type="button" onclick="delete_users_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
            
                        </div> 
                       
            </div>

            <?php } ?>
            
          </div>

    </header>
   <div class="panel-body panel_bg_d">
      <div class="table-responsive">
        <?php 
          if(check_user_permission("resources","users","all")==1){
             $column_head=array($ui_string['checkbox'],$ui_string['name'],$ui_string['email'],$ui_string['profile'],$ui_string['area'],$ui_string['manager'],$ui_string['profile_image'],$ui_string['status'],$ui_string['action']);    
             $show_fields=array('checkbox','name','email','category_profile','category_area','manager','user_avatar','user_status','action');
            // print_r($show_fields);
                }
                else{
                $column_head=array($ui_string['checkbox'],$ui_string['name'],$ui_string['email'],$ui_string['profile'],$ui_string['area'],$ui_string['manager'],$ui_string['profile_image']);  
                  $show_fields=array('checkbox','name','email','category_profile','category_area','manager','age','user_avatar');
                    }               
              $All_data=array("head"=>$column_head);
              $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                if(check_user_permission("resources","users","all")==1 || check_user_permission("resources","users","view")==1){
                 get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/datatable_ajax.php"); 
                        }                 
        ?>    
      </div>
    </div> 


    <?php /* ?> <div class="table-responsive">
                            
                            <?php 
                                $column_head=array('Attendance Title','Description','Max Employee','Attendance Type','Updated On','Action');  
                                
                                $button1=array("title"=>"Edit","attr"=>"onclick=go_to('user.php','id='+$(this).attr('data-id'))","icon"=>"fa fa-pencil");
                                $button2=array("title"=>"Delete","attr"=>"onclick='delete_user(this.id)'","icon"=>"fa fa-trash-o");
                                $button3=array("title"=>"Edit","attr"=>"onclick=go_to('user.php','id='+$(this).attr('data-id'))","icon"=>"fa fa-bookmark-o");
                                $rbuttons=array($button1,$button2,$button3);
                                
                                $get_users[]=array('type'=>'Daily Attendance','description'=>'Daily Checkin Checkout','max_employee'=>'20','attendance_type'=>'fixed','updatedon'=>'22/10/2016');
                                 
                                $get_users[]=array('type'=>'Daily Attendance','description'=>'Daily Checkin Checkout','max_employee'=>'20','attendance_type'=>'fixed','updatedon'=>'23/10/2016');
                               
                                $get_users[]=array('type'=>'Daily Attendance','description'=>'Daily Checkin Checkout','max_employee'=>'20','attendance_type'=>'fixed','updatedon'=>'24-10-2016');
                               
                                $row_data=array();
                                $show_fields=array('type','description','max_employee','attendance_type','updatedon','Action');
                               
                                foreach($get_users as $users)
                                {
                                    $show_info=array();
                                    foreach($show_fields as $fields)
                                    {
                                        $fields=explode("-",$fields);
                                        //print_r($fields);
                                        if($fields[0]=="Action")
                                        {
                                          $ret="Action";
                                        }
                                        else{
                                           $ret=$users[$fields[0]];
                                        }
                                       
                                        array_push($show_info,$ret);
                                    }
                                    
                                    $ar=array("id"=>$users['id'],"data"=>$show_info,"Action"=>$rbuttons);
                                    array_push($row_data,$ar);
                                }
                                
                               //print_r($row_data);
                                $All_data=array("head"=>$column_head,"rows"=>$row_data);
                                $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                
                                get_admin_datatable($table_data);
                             ?>    
              </div><?php */ ?>
            </div>
  </section>
<div id="categories" class="modal fade container" style="width: 800px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"
                aria-hidden="true">
                <i class="fa fa-times"></i>
              </button>
              <h4 class="modal-title">
                <?php echo $ui_string['category'];?>
              </h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
                         <?php if(check_user_permission("resources","users","category_all")==1 ){?>
              <a onclick="open_add_category('add')" class="right tooltip-area">
                <button type="button" class="btn btn-default bottom-gap" data-toggle="tooltip" data-placement="top" title="Add Category">
                  <i class="glyphicon glyphicon-plus-sign"></i> <!--<?php echo $ui_string['add_category'];?>-->
                </button>
              </a>
                          <?php } ?>   
              <div class="clr"></div>
              
                           <?php $dat=get_category_tree($all_cats,0); ?>
                            <table class="table table-striped table-hover">
                            <thead>
                            <tr><th colspan="" style="padding-left: 10px;">Category Name</th>
                            <th style="padding-left: 10px;">Define Hierarchy</th>
                           <?php if(check_user_permission("resources","users","category_all")==1 ){?>
                            <th style="padding-left: 10px;">Action</th>
                            <?php } ?>
                            </tr></thead>
                            <?php
                               if(check_user_permission("resources","users","category_all")==1 || check_user_permission("resources","users","category_view")==1 ){
                               show_accordian_table($dat,'',0,2,'user_category',$category_data,$user_id);
                               }
                            ?>
                           </table>      
            </div> 
        <div id="add_category" class="modal fade" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
              <h4 class="modal-title"><span id="cathead"></span></h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body ">
              <form class="form-horizontal" data-collabel="4" data-label="color" id="addCategory">
              
                    <div class="form-group">
                      <label class="control-label no_padding remove_bg"><?php echo $ui_string['select_category'];?><font color="red">*</font></label>
                      <div>
                        <select id="pcategory" class="form-control pcategory_b" name="pcategory">
                            <option value="0"><?php echo $ui_string['parent_category'];?></option>
                             <?php show_category_accordians($dat,'-',0,1,'');?>
                        </select> 
                      </div>
                    </div>
                    <input type="hidden" name="cat_add" value="cat_add"/>
                    <input type="hidden" name="cat_id" id="cat_id" value="0"/>
                     
                      <input type="hidden" name="category_code" value="profile"/>
                    <?php  echo get_data_field('text',$ui_string['name'],'categoryname','categoryname','required_field addCategory updateCategory','data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid category name" data-error-show-in="ecategoryname" data-error-setting="2" data-error-text="Please enter category name"','','',''); ?>
                   <?php  echo get_data_field('text',$ui_string['code'],'category_code','category_code','required_field addCategory updateCategory','data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid category code" data-error-show-in="ecategory_code" data-error-setting="2" data-error-text="Please enter category code"','','','','profile'); ?>
              <button type="button" class="btn btn-inverse btn_width right bottom-gap"  data-dismiss="modal">
            <i class="glyphicon glyphicon-remove-circle"></i> <?php echo $ui_string['close'];?></button>
            <span id="groupbut"></span>
              </form>
            </div>
            <!-- //modal-body-->  
    </div>
  </div>
 
 </div>
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
        
</div>
   