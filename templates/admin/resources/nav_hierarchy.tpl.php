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
            <a data-toggle="collapse" href="#collapseRightMenu"><i class="collapse-caret fa fa-angle-down"></i><?php echo $ui_string['managerList'];?></a>
         </header>
         <section class="collapse in" id="collapseRightMenu">
            <div class="">
               <ul class="manager-list mm-list mm-panel">
                  <?php if (isset($userData['success']) && $userData['success']=='true' && $userData['data']!=''){
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
      <div class="widget-collapse dark" id="memtbl" >
         <header>
            <a data-toggle="collapse" href="#collapseRightMenu-2"><i class="collapse-caret fa fa-angle-down"></i><?php echo $ui_string['memberList'];?></a>
         </header>
         <section class="collapse" id="collapseRightMenu-2">
            <div class="">
               <ul class="manager-list mm-list mm-panel">
                  <?php 
                     $column_head=array($ui_string['name'],$ui_string['action']);  
                     $show_fields=array('name','action');    
                     $All_data=array("head"=>$column_head);
                     $table_data=array("table_id"=>"user_table","table_data"=>$All_data);
                     
                      get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/hierarchy_datatable_ajax.php?categoryid=".$_POST['catid']."&catName=".$_POST['dept']); 
                     
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
   $("#user_table").addClass("custom_tabel");
   
   setTimeout(function(){ $("#user_table_previous").html("<i class='fa fa-chevron-left' aria-hidden='true'></i>"); }, 1000);
    setTimeout(function(){ $("#user_table_next").html("<i class='fa fa-chevron-right' aria-hidden='true'></i>"); }, 1000);
   
    /*$('#loading_spinner').show();
     $('#memtbl').hide();
   
    $(function() {
       setTimeout(function() {
           $("#loading_spinner").hide()
       }, 2000);
        setTimeout(function() {
           $("#memtbl").show()
       }, 2000);
      
   
   });
    */

</script>

