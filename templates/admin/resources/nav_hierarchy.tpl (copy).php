<?php
include_once("../../../global.php");
$managersInfo=get_category_managers(array('categoryid'=>$_POST['catid']));
if($managersInfo['success']=='true')
{
    $userId=str_replace(",", "|", $managersInfo['data']);
    $userData=get_resource_by_id(array('id'=>$userId,'fields'=>'name,designation'));
    //print_r($userData);
}
$categoryUserInfo=get_category_users(array('category_ids'=>$_POST['catid'],'fields'=>'name'));



?>
<style type="text/css">
/*#user_table_previous{display: none;}
#user_table_next{display: none;}*/
#user_table_info{display: none;}
#user_table_filter{display: none;}
#user_table_length{display: none;}
</style>

<li class="Label label-lg mm-label"><?php echo $_POST['dept'];?></li>
                        <li> </hr></li>
                        <li>
                                <span>
                                    <div class="widget-collapse dark">
                                            <header>
                                                    <a data-toggle="collapse" href="#collapseRightMenu"><i class="collapse-caret fa fa-angle-down"></i>MANAGER LIST</a>
                                            </header>
                                            <section class="collapse in" id="collapseRightMenu">
                                                    <div class="">
                                                      <ul class="manager-list mm-list mm-panel">
                                                         <?php if ($userData['success']=='true' && $userData['data']!=''){
                                                                foreach($userData['data'] as $user1) {?>          
                                                                   
                                                                    <li><a href="javascript:;"> <?php echo $user1['name']." (".$user1['designation'].")"; ?></a></li> 
                                                        <?php } }?>
                                                      
                                                        </ul>
                                                            <!-- //widget-slider-->
                                                    </div>
                                                    <!-- //collapse-boby-->
                                            </section>
                                            <!-- //collapse-->
                                    </div>
                                    <!-- //widget-collapse-->
                                </span>
                        </li>   
                        <li>
                                <span> 
                                <div class="widget-collapse dark">
                                            <header>
                                                    <a data-toggle="collapse" href="#collapseRightMenu-2"><i class="collapse-caret fa fa-angle-down"></i>MEMBER LIST</a>
                                            </header>
                                            <section class="collapse in" id="collapseRightMenu-2">
                                                    <div class="">
                                                      <ul class="manager-list mm-list mm-panel" style="max-height:400px">
                                <table id="user_table" cellpadding="0" cellspacing="0" border="0" class="table custom_tabel table-striped">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="inlineCheckbox1" value="option1"></th>
                                            <th>Name</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php if($categoryUserInfo['success']=='true' && !empty($categoryUserInfo['data']))
                                        { foreach ($categoryUserInfo['data'] as $value) {?>
                                            
                                        
                                        <tr class="odd gradeX">
                                            <td><input type="checkbox" id="inlineCheckbox1" value="option1"></td>
                                            <td><?php echo $value['name'];?></td>
                                            <td>
                                          
                                            <select  class="size-fix-select selectpicker form-control pull-right" data-style="btn-theme-inverse">
                                                    
                                                    <option>Member</option>
                                                    <option>Manager</option>
                                                    
                                                </select>

                                          </td>
                                            
                                        </tr>
                                        <?php }}?>
                                     
                                    </tbody>
                                </table>                       
                        <?php 
                            
                               /* if(check_user_permission("resources","users","all")==1){
                                    $column_head=array($ui_string['checkbox'],$ui_string['name'],$ui_string['action']);  
                                    $show_fields=array('checkbox','name','action');
                                }
                                else{
                                    $column_head=array($ui_string['checkbox'],$ui_string['name']); 
                                     $show_fields=array('checkbox','name');
                                }
                                    
                                
                                  
                                $All_data=array("head"=>$column_head);
                                $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                    
                                //get_admin_datatable($table_data);
                                
                                 if(check_user_permission("resources","users","all")==1 || check_user_permission("resources","users","view")==1){
                                     get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/hierarchy_datatable_ajax.php?categoryid=".$_POST['catid']); 
                                } */
                            
                        ?>
                            
                                 <div style="height:80px"></div> 
                                                    </ul>
                                                            <!-- //widget-slider-->
                                                    </div>
                                                    <!-- //collapse-boby-->
                                            </section>
                                            <!-- //collapse-->
                                    </div>
                                </span>

                        </li>

<script type="text/javascript">
$('#user_table').dataTable();
</script>