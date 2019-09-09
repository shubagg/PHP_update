<div id="main" class="dashboard">
   <?php get_breadcrumb(); ?>
   <script>
      function checkalldata(){}
   </script>
<!--   <style type="text/css">li [href^="#licenses"] {
    display: none !important;
}
li [href^="#clicense"] {
    display: none !important;
}</style>-->
   <div id="content">
      <div class="row">
         <section class="panel">
            <header class="panel-heading panel-updated" style="margin-bottom:0px !important;">
                     <div class="row">
                     <div class="col-md-6"> <h3><strong><?php echo $ui_string['users']; ?></strong> <?php echo $ui_string['details']; ?> </h3></div>
                     <div class="col-md-6">
                     <div class="align-lg-right">
               <?php 
                  $condition=array();
                  $box1=array('name'=>$ui_string['add'],'icon'=>'glyphicon glyphicon-user','attr'=>'href="addUser"',"class"=>"btn btn-default");
                  if(check_user_permission("resources","users","all")==1){
                     array_push($condition,$box1);
                  }
                  
                  $box2=array('name'=>$ui_string['department'],'icon'=>'glyphicon glyphicon-list-alt','attr'=>'onclick="$(\'#categories\').modal();"',"class"=>"btn btn-default");
                  if(check_user_permission("resources","users","category_all")==1 || check_user_permission("resources","users","category_view")==1){
                     array_push($condition,$box2);
                  }
                  
                  // $box3=array('name'=>$ui_string['roles'],'icon'=>'glyphicon glyphicon-user','attr'=>'onclick="$(\'#roles\').modal();"',"class"=>"btn btn-primary");
                  // if(check_user_permission("resources","users","role_all")==1 || check_user_permission("resources","users","role_view")==1){
                  //    array_push($condition,$box3);
                  // }
                  include_admin_template_params("resources","box",$condition); 
                  ?>
                    </div>
                    </div>
                </div>
                     
            </header>


            <div class="panel-body">
            <div class="row">

                  <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12" >
                     
                    
                  </div>
                  <?php if(check_user_permission("resources","users","all")==1){?>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="select_all">

                        <span class="checkbox" data-color="red" style="padding-left:0px;">
                        <input type="checkbox" id="check11" onclick="checkall();" class="all_check" />

                        <a href="javascript:;"><strong><label for="check11"  class="select-color"><?php echo $ui_string['select_all'];?></label></strong></a>

                        </span>
                        <!--<button type="button" class="btn btn-primary btn-transparent">-->
                        <!--</button>-->
                        <!--<span  class="checkbox"  data-color="red" >
                           <input type="checkbox" id="check11" onclick="checkall();" />
                           <a href="javascript:;"><strong><label for="check11" style="font-size:14px; font-weight:bold;"><?php echo $ui_string['select_all'];?></label></strong></a>
                            </span>-->
                  
                     </div>
                  </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                        <button type="button" onclick="delete_users_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="glyphicon glyphicon-trash"></i> <!--<?php echo $ui_string['delete']; ?>-->
                        </button>
                    </div>
                  </div>
                  </div>
                  <?php } ?>
               </div>

               <div class="">
                  <?php 
                     $column_head=$fileds;  
                     $show_fields=$field_value; 
                     $All_data=array("head"=>$column_head);
                     $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                     if(check_user_permission("resources","users","all")==1 || check_user_permission("resources","users","view")==1){
                         get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/datatable_ajax.php"); 
                        }
                     ?>    
               </div>
            </div>
         </section>
            <div>
                <!-- Nav tabs -->
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

                    <div class="modal-body">

                        <a href="student_info_form.html">
                            <div class="popup_button_1">
                                Add Student
                            </div>
                        </a>
                        <a href="#">
                            <div class="popup_button_2">
                                Add Employee
                            </div>
                        </a>
                    </div>
                    <!-- //modal-body-->
                </div>

                <div id="roles" class="modal fade">

                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="modal-title">
                                    <?php echo $ui_string['add_role']; ?>
                                </h4>
                            </div>
                            <div class="col-md-2 pading-lft-right-0 text-right">
                                <a onclick="open_add_role('add')">
                                    <button type="button" data-toggle="tooltip" data-placement="left" title="Add Role" class="btn btn-default role-add-btn" >
                                        <i class="glyphicon glyphicon-plus-sign"></i> <!--<?php echo $ui_string['add_role']; ?>-->
                                    </button>
                                </a>

                            </div>
                            <div class="col-md-1">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>

                        </div>

                    </div>
                    <!-- //modal-header-->
                    <div class="modal-body">
                        <?php if (check_user_permission("resources", "users", "role_all") == 1) { ?>  

                        <?php } ?>    
                        <div class="clr"></div>
                        <div class="">
                            <?php
                            $get_roles = $roles;
                            if (check_user_permission("resources", "users", "role_all") == 1) {
                                $column_head = array($ui_string['name'], $ui_string['action']);
                            } else {
                                $column_head = array($ui_string['name']);
                            }
                            $row_data = array();

                            $button1 = array("title" => "Edit", "attr" => "onclick='open_add_role(\"update\",this.id)'", "icon" => "fa fa-pencil");
                            $button2 = array("title" => "Delete", "attr" => "onclick='delete_role(this.id)'", "icon" => "fa fa-trash-o");
                            $buttons = array($button1, $button2);
                            $button = array($button1);

                            if (isset($get_roles)) {
                                foreach ($get_roles as $roles) {
                                    if (!in_array($roles['id'], array('5914012c6d95579a643c986a', '5ce0fc3390941bde153c9879', '5cefe4b890941ba7393c986a'))) {
                                        if (check_user_permission("resources", "users", "role_all") == 1) {
                                            if ($roles['deletable'] == 1) {
                                                if ($roles['id'] == '56b87fb06d9557be063c986a') {
                                                    array_push($row_data, array("id" => $roles['id'], "data" => array($roles['title'], 'Action'), "Action" => $button));
                                                } else {
                                                    array_push($row_data, array("id" => $roles['id'], "data" => array($roles['title'], 'Action'), "Action" => $buttons));
                                                }
                                            } else {
                                                array_push($row_data, array("id" => $roles['id'], "data" => array($roles['title'], 'Action'), "Action" => $button));
                                            }
                                        } else {

                                            array_push($row_data, array("id" => $roles['id'], "data" => array($roles['title'], 'Action')));
                                        }
                                    }
                                }
                            }
                            $All_data = array("head" => $column_head, "rows" => $row_data);
                            $data = array("table_id" => "data_table_4", "table_data" => $All_data);
                            //print_r($data);

                            if (check_user_permission("resources", "users", "role_all") == 1 || check_user_permission("resources", "users", "role_view") == 1) {
                                get_datatable($data);
                            }
                            ?>  
                        </div>
                    </div>
                    <!-- //modal-body-->
                </div>
                <!-- //Role popup ends-->
                <div id="add_roles" class="modal fade"
                     data-header-color="#736086" data-backdrop="static" data-keyboard="false" data-width="70%">
                    <div class="modal-header">
                        <button type="button" class="close" onClick="close_role_model();">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4 class="modal-title">
                            <span id="rolehead"></span>
                        </h4>
                    </div>
                    <!-- //modal-header-->
                    <div class="modal-body">
                        <form class="form-horizontal" data-collabel="3" data-label="color" id="addRole">
                            <?php
                            $csrf = new CSRF_Protect();
                            $csrf->echoInputField();
                            ?>
                            <input type="hidden" name="role_id" id="role_id" value="0"/>
                            <input type="hidden" name="role_add" value="role_add"/>

<?php echo get_data_field('text', $ui_string['role'], 'rolename', 'rolename', 'required_field addRole updateRole', 'data-check-valid="blank" data-valid-nospecial-error="' . $ui_string['1301'] . '" data-error-show-in="erolename" data-error-setting="2" data-error-text="' . $ui_string['1302'] . '"', '', '', '', '', 'font'); ?>

                            <div class="form-group ">
                                <label class="control-label remove_bg col-md-3"><?php echo $ui_string['specific_to'] ?></label> 
                                <div class="col-md-4 role">


                                    <select class="form-control" name="specific_to" id="specific_to" >
                                        <option value=""><?php echo $ui_string['role_option'] ?></option>
                                        <?php if (!empty($user_role)) {
                                            foreach ($user_role as $element) {
                                                foreach ($element['submodule'] as $r) { ?>
                                                    <option value="<?php echo $r['id']; ?>" ><?php echo $r['name']; ?></option><?php }
                                            }
                                        } ?> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label remove_bg col-md-3"><?php echo $ui_string['deleteable'] ?></label> 
                                <div class="col-md-9 radio-space">
                                    <input type="radio" name="deletable" id= "deletable-1" value="1"> <?php echo $ui_string['yes'] ?></input>
                                    <input type="radio" name="deletable" id="deletable-0" value="0"> <?php echo $ui_string['no'] ?></input>

                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label remove_bg col-md-3"><?php echo $ui_string['apply_to_hirarchy']; ?></label> 
                                <div class="col-md-9 radio-space">
                                    <input type="radio" name="applyToHirarchy" id= "applyToHirarchy1" value="1"> <?php echo $ui_string['yes'] ?></input>
                                    <input type="radio" name="applyToHirarchy" id="applyToHirarchy2" value="0"> <?php echo $ui_string['no'] ?></input>

                                </div>
                            </div>
                            <!-- <div class="col-md-9">
                               <input type="checkbox" name="applyToHirarchy" id= "applyToHirarchy" value="1">
                            </div>
                         </div> -->

                            <div class="form-group ">

                                <label class="control-label remove_bg col-lg-3 col-md-3 col-sm-3 col-xs-12" ><?php echo $ui_string['permission']; ?><font class="color">*</font></label> 

                                <div id="exTab1"  class="col-lg-9 col-md-9 col-sm-9 col-xs-12 role-assign-nav">
                                    <ul  class="nav nav-pills bg-white btn-color " >
                                        <?php if (!empty($user_role)) {
                                            foreach ($user_role as $element) {
                                                foreach ($element['submodule'] as $r) { ?>
                                                    <li <?php if ($r['smval'] == 'users') {
                                                            echo 'class="active"';
                                                        } else {
                                                            echo 'class=""';
                                                        } ?>>
                                                        <a  href="#<?php echo $r['smval']; ?>" data-toggle="tab"><?php echo $r['name']; ?></a>
                                                    </li>
                                                <?php }
                                            }
                                        } ?>  
                                    </ul>
                                    <div class="tab-content">
                                        <?php if (!empty($user_role)) {
                                            foreach ($user_role as $element) {
                                                foreach ($element['submodule'] as $r) { ?>
                                                    <div  <?php if ($r['smval'] == 'users') {
                                                        echo 'class="tab-pane active"';
                                                    } else {
                                                        echo 'class="tab-pane "';
                                                    } ?> id="<?php echo $r['smval']; ?>">
                                                        <?php foreach ($r['permission'] as $v) {
                                                            ?> 
                                                            <span>
                                                                <label class="" style="font-weight:normal; " for="ich-<?php echo $element['moduleVal'] . '-' . $r['smval'] . '-' . $v['pid']; ?>">

                                                                    <input class="ads_Checkbox chk required_field addRole updateRole" type="checkbox" id="ich-<?php echo $element['moduleVal'] . '-' . $r['smval'] . '-' . $v['pid']; ?>" <?php if ($v['pid'] == 'all') { ?> onClick='Get_Role_Id("ich-<?php echo $element['moduleVal'] . '-' . $r['smval'] . '-' . $v['pid']; ?>", "<?php echo $r['smval']; ?>")' <?php } ?> name="permission[]" value="<?php echo $element['moduleVal'] . '-' . $r['smval'] . '-' . $v['pid']; ?>"  data-error-setting="2" data-error-show-in="eroleper" data-error-text="<?php echo $ui_string['permission_error']; ?>" data-check-valid="blank"  />
                                                                    &nbsp;<?php echo $v['name']; ?>
                                                                </label>
                                                            </span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                <?php }
                                            }
                                        } ?> 
                                    </div>
                                    <span id="eroleper" class="error"></span>       
                                </div>
                            </div>
                            <div class="pull-right margn-btm-20">
                                <span id="grouprole"></span>
                                <button type="button" onClick="close_role_model();" class="btn btn-inverse btn_width right bottom-gap">
                                    <?php echo $ui_string['cancel']; ?>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- //modal-body-->
                </div>
                <div id="categories" class="modal fade">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="modal-title">
                                    <?php echo $ui_string['department']; ?>
                                </h4>
                            </div>
                            <div class="col-md-2 pading-lft-right-0 text-right">
                                <a onclick="open_add_category('add')" >
                                    <button type="button" class="btn btn-default role-add-btn" data-toggle="tooltip" data-placement="top" title="Add Category">
                                        <i class="glyphicon glyphicon-plus-sign"></i> <!--<?php echo $ui_string['add_category']; ?>-->
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- //modal-header-->
                    <div class="modal-body">
                        <?php if (check_user_permission("resources", "users", "category_all") == 1) { ?>
                        <?php } ?>   
                        <div class="clr"></div>
                        <?php $dat = get_category_tree($all_cats, 0); ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="" style="padding-left: 10px;"><?php echo $ui_string['deptName']; ?></th>
                                        <?php if (check_user_permission("resources", "users", "category_all") == 1) { ?>
                                        <th style="padding-left: 10px;"><?php echo $ui_string['action']; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <?php
                            if (check_user_permission("resources", "users", "category_all") == 1 || check_user_permission("resources", "users", "category_view") == 1) {
                                show_accordian_table($dat, '', 0, 2, 'user_category', $category_data, $user_id);
                            }
                            ?>
                        </table>
                    </div>
                    <!-- //modal-body-->
                </div>
            </div>
            <!-- //content > row-->
        </div>
        <!-- //content-->
    </div>
    <!-- //main-->
    <div id="add_category" class="modal fade" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
            <h4 class="modal-title"><span id="cathead"></span></h4>
        </div>
        <!-- //modal-header-->
        <div class="modal-body ">
            <form class="form-horizontal" data-collabel="4" data-label="color" id="addCategory">
                <div class="form-group">

                    <label class="control-label remove_bg col-md-4"><?php echo $ui_string['select_department']; ?><font color="red">*</font></label>

                    <div>
                        <select id="pcategory" class="form-control pcategory_b" name="pcategory" onchange="admSelectCheck(this.value);">e
                            <option value="0"><?php echo $ui_string['parent_department']; ?></option>
<?php show_category_accordians($dat, '-', 0, 1, ''); ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="cat_add" value="cat_add"/>
                <input type="hidden" name="cat_id" id="cat_id" value="0"/>
                <input type="hidden" name="category_code" value="profile"/>
                <input type="hidden" name="root_parent_id" id="root_parent_id" value=""/>
<?php echo get_data_field('text', $ui_string['name'], 'categoryname', 'categoryname', 'required_field addCategory updateCategory', 'data-check-valid="blank" data-valid-nospecial-error="' . $ui_string['1303'] . '"  data-error-show-in="ecategoryname" data-error-setting="2" data-error-text="' . $ui_string['1304'] . '"', '', '', '', '', 'font'); ?>
<?php echo get_data_field('text', $ui_string['code'], 'category_code', 'category_code', 'required_field addCategory updateCategory', 'data-check-valid="blank" data-valid-nospecial-error="' . $ui_string['1305'] . '" readonly="readonly" data-error-show-in="ecategory_code" data-error-setting="2" data-error-text="' . $ui_string['1306'] . '"', '', '', '', 'profile', 'font'); ?>
                <div class="col-md-12 text-right margn-btm-20">
                    <span id="groupbut"></span>

                    <span><button type="button" class="btn btn-inverse bottom-gap"  data-dismiss="modal">
<?php echo $ui_string['cancel']; ?></button></span>
                </div>
                <br>
            </form>
        </div>
        <!-- //modal-body-->  
    </div>
    <div id="basic_search" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="del1"><i class="fa fa-times"></i></button>
            <h3><i class="glyphicon glyphicon-search"></i> <?php echo $ui_string['search']; ?></h3>
        </div>
        <div class="modal-body">
            <span class="searcherrorcat" style="color: red;" class="error"></span>
            <form id="catsearchform">
                <table>
                    <?php
                    if (isset($category_data, $user_id)) {
                        show_accordian($dat, '', 0, 1, 'user_category', $category_data, $user_id);
                    }
                    ?>
                </table>
                <div class="clr"></div>
                <button type="button" data-dismiss="modal" class="btn btn-inverse">
                    <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
                <button onclick="get_category_user()" type="button" class="btn btn-theme-inverse" >
                    <i class="glyphicon glyphicon-search"></i> Search</button>  
            </form>
        </div>
    </div>
    <div id="import_modal" class="modal fade" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
            <h4 class="modal-title"><span>Import</span></h4>
        </div>
        <!-- //modal-header-->
        <div class="modal-body ">
            <form class="form-horizontal" data-collabel="4" data-label="color" id="importuser" name="importuser">
                <div class="form-group">
                    <label class="control-label no_padding remove_bg">File xls</label>
                    <input type="file" name="xls_file" id="xls_file" >
                    <input type="hidden" name="xls_file1" id="xls_file1" class="required_field importuser" data-check-valid="blank" data-error-show-in="exls_file" data-error-setting="2" data-error-text="Please upload a xls file">
                    <span id="exls_file" class="error"></span>
                </div>
                <div class="form-group">
                    <label class="control-label no_padding remove_bg">Upload media</label>
                    <input type="file" name="media_file" id="media_file" class="required_field importuser" data-check-valid="blank" data-error-show-in="emedia_file" data-error-setting="2" data-error-text="Please upload a zip file">
                    <input type="hidden" name="media_file1" id="media_file1">
                    <span id="emedia_file" class="error"></span>
                </div> 
                <button type="button" class="btn btn-theme-inverse" onclick="return validation('importuser')"> <?php echo $ui_string['submit']; ?></button>
                <button type="button" class="btn btn-inverse"  data-dismiss="modal">
                <?php echo $ui_string['cancel']; ?></button>
                <?php
                $file = server_path() . 'uploads/demo.xls';
                ?>
            </form>
            <button  class="btn btn-inverse " onclick="export_users_demo()" class="">click here to see xls demo </button>
        </div>
        <!-- //modal-body-->
    </div>   
<?php echo delete_confirmation_popup(); ?> 
</div>