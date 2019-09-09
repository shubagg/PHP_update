<div id="main">
  <?php get_breadcrumb(); ?>
  <div id="content" style="padding:15px;">
    <section class="box">
      <h2 class="title">Privacy Statement</h2>
    </section>
    <section class="panel margin-bottom-20">
      <div class="panel-body" style="padding: 20px 10px 3px 20px;">
        <form id="reportrecord" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
                        <label for="inputOne"> Heading  </label>
                        <input type="text" class="form-control" id="inputOne" name="Privacy Statement_heading">
                        <span id="report3" style="color:red"></span>
                     </div>
                     
                     
                     
                  <div class="form-group">
                        <label for="inputOne">DESCRIPTION </label>
                        <textarea class="form-control " id="editorCk" rows="3"></textarea>
                        <span id="report3" style="color:red"></span>
                     </div>
                     
                         
          
                      <div class="form-group">
           <button type="button" class="hvr-bounce-to-bottom btn " data-toggle="modal" data-target="#add_category">Save</button>
          </div>
                     
                     </div>
        
        	
			
		
       
        
      </form>
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
    <button type="button" class="btn btn-inverse btn_width right bottom-gap"  data-dismiss="modal"> <i class="glyphicon glyphicon-remove-circle"></i> <?php echo $resourse['close'];?></button>
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
  <div class="modal-body text_alignment"> <span class="searcherrorcat" style="color: red;" class="error"></span>
    <form id="catsearchform">
      <table>
        <?php
                            
                            show_accordian($dat,'',0,1,'user_category',$category_data,$user_id);
                        ?>
      </table>
      <div class="clr"></div>
      <button type="button" data-dismiss="modal" class="btn btn-inverse top-gap bottom-gap right left-gap"> <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
      <button onclick="get_category_user()" type="button" class="btn btn-theme-inverse top-gap bottom-gap right" > <i class="glyphicon glyphicon-search"></i> Search</button>
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
