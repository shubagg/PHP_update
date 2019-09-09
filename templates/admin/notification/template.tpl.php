<body class="leftMenu nav-collapse in">
	
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->

    	<?php
         get_admin_header_menu($language); ?>   	

		<div id="main">
          <?php get_breadcrumb(); ?>

			<div id="content">
			<div class="row">
				<section class="panel">
				<header class="panel-heading">
                        <h3><strong><?php if(isset($_GET['id']) && $_GET['id']!=""){echo $ui_string['edit'];}else{echo $ui_string['add'];}?>  <?php echo $ui_string['template'];?> </strong></h3>
                    </header>
					<div class="panel-body">
						<form name="frm" id="frm" action="" class="form-horizontal" method="post" onSubmit="return validate1();">
                        <?php $csrf = new CSRF_Protect(); $csrf->echoInputField();?>	
                                <div class="form-group">
                                    <label class="control-label text-left col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['template_name'];?> <font color='red'>*</font></label>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                    <?php
                                    $dat='';
                                     if(isset($get_template['data'][0]['tempName']))
                                    {
                                        $dat=$get_template['data'][0]['tempName'];
                                    }
                                    ?>
                                        <input type="text" class="form-control" id="temp_name"  name="tempName" value="<?php echo $dat; ?>">
                                        <input type="hidden" name="id" id="id" value="<?php echo $get_id;?>" />
                                        <!--<input type="hidden" name="ty" id="email" value="email" />-->
                                        <span id="name" class="valid_error error"></span>  
                                    </div>
                                </div>
                            

                          
                                <div class="form-group" style="display:none">
                                    <label class="control-label col-md-3" for="inputTwo" style="text-align: left; "><?php //echo $ui_string['template_send_by'];?><font color='red'></font></label>
                                    <div class="col-md-9">
                                        <input type="radio" class="" id="email" checked  name="tempFor" value="email" <?php if($get_template['data'][0]['tempFor']=='email'){echo "checked";} ?> /> Email
                                        <input type="radio" class="" id="sms"  name="temp_for" value="sms" <?php if($get_template['data']['template_data'][0]['temp_for']=='sms'){echo "checked";} ?> /> SMS -->
                                        <!--<input type="radio" class="" id="push"  name="ty" value="push" <?php if($temp_for=='push'){echo "checked";} ?> /> PUSH Notification-->
                                        <span id="e_ty" class="valid_error  error"></span>  
                                    </div>
                                </div>
              
                    <div class="form-group">
                        <label class="control-label text-left col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['sel_mod'];?><font color='red'>*</font></label>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12"> 
                            <select  class=" form-control" name="mid" id="module" onChange="get_sub_module(this.value)" >
                                <option value=""> <?php echo $ui_string['sel_mod'];?> </option>
                                 <?php 
                                    $jsondata=$get_modules['data'];
                                    for($i=0;$i<sizeof($jsondata);$i++)
                                    {
                                ?>
                                        <option value="<?php echo $jsondata[$i]['id']; ?>" <?php if(isset($get_template['data'][0]['mid']) && $get_template['data'][0]['mid']==$jsondata[$i]['id']){echo "selected";}?>  ><?php echo $jsondata[$i]['moduleName'];?></option>
                                <?php
                
                                    }
                                ?>
                            </select> 
                            <span id="module_err" class="valid_error error"></span>
                        </div>
                    </div>
               


               
                    <div class="form-group">
                        <label class="control-label text-left col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['sub_mo'];?><font color='red'>*</font></label>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" > 
                             <select  class="form-control" name="smid" id="submodule" onChange="get_events(this.value)">
                                <option value=""> <?php echo $ui_string['sel_sub_mod'];?> </option>
                               
                            </select> 
                            <span id="submodule_err" class="valid_error error"></span>
                        </div>
                    </div>
              


               
                    <div class="form-group">
                        <label class="control-label text-left col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['sel_eve'];?><font color='red'>*</font></label>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" > 
                             <select  class="form-control" name="eid" id="event" onChange="get_fields();" >
                                <option value=""> <?php echo $ui_string['sel_eve'];?> </option>
                               
                            </select> 
                            <span id="event_err" class="valid_error error"></span>
                        </div>
                    </div>
               
                
              
                    <div class="form-group">
                        <label class="control-label text-left col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['sel_fields'];?></label>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12"> 
                            <select  class="form-control" name="fieldValue" id="select1" onChange="change(this.value)">
                                <option value=""> <?php echo $ui_string['sel_fields'];?> </option>
                               
                            </select> 
                            <span id="field_err" class="valid_error error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-left col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['template'];?></label>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" id="exTab1"> 
                            <ul  class="nav nav-pills btn-color">
                                <?php if(!empty($languages)){ foreach ($languages as $lang) {?>
                                <li <?php if($_SESSION['user']['lang']==$lang['code']){ echo 'class="active"';} else { echo 'class=""';} ?>>
                                <a  class="btn btn-theme-inverse" href="#<?php echo $lang['code'];?>" onclick="chnage_editor('<?php echo $lang['code'];?>')" data-toggle="tab"><?php echo $lang['title'];?></a>
                                </li>
                                 <?php } }?> 
                            </ul>

                                        <div class="tab-content ">
                                        <?php $i=1;if(!empty($languages)){ foreach ($languages as $lang) {?>
                                        <div <?php if($_SESSION['user']['lang']==$lang['code']){ echo 'class="tab-pane active"';} else { echo 'class="tab-pane"';} ?> id="<?php echo $lang['code'];?>">

                                           <textarea class="ckeditor"  id="tempDesc_<?php echo $lang['code'];?>" cols="80" name="tempDesc_<?php echo $lang['code'];?>" rows="10"  ><?php  if(isset($get_template['data'][0]['tempDesc_'.$lang['code']])){echo base64_decode($get_template['data'][0]['tempDesc_'.$lang['code']]); }?> </textarea>
                                            <span id="temp_<?php echo $lang['code'];?>" class="valid_error error"></span>
                                          
                                        </div>
                                         <?php $i++;} }?> 

                                     </div>
                                     
                          
                                  
                        </div>
                    </div>
                    <input type="hidden" name="current_editor" id="current_editor" value="en" />
                     <input type="hidden" name="tempDesc" id="tempDesc" value="" />

                    
					<div class="form-group">
    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right"> 
                
						   <div class="pull-right">                
						  
                        <?php		
                            if(isset($_GET['id']))
                            {
                                echo'<button type="button" class="btn btn-theme-inverse" onclick="validate1();" name="submit">'.$ui_string['update'].'</button>';
                            }
                            else
                            {
                                echo'<button type="button" class="btn btn-theme-inverse" onclick="validate1()" name="Confirm"> '.$ui_string['confirm'].'</button>';
                            }
                        ?>
                        
						  </div> 
                        </div>
                    </div>
					
                </form>
       
    </section>
	</div>
    </div>
</div>
		<?php get_admin_left_sidebar($language); ?>   
        
                <div id="confirm-click-1" class="modal fade" data-backdrop="static" data-keyboard="false" data-header-color="#736086" >
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="glyphicon glyphicon-ok-circle "></i> <?php echo $ui_string['confirmation'];?></h4>
                    </div>
                
                    <div class="modal-body text_alignment" >
                
                        <div class="confirmation_successful">
                            <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
                                <?php
                                    if(isset($_GET['id']) && $_GET['id']!="")
                                    {
                                        echo "Successfully Updated";
                                    }
                                    else
                                    {
                                        echo "Successfully Created";
                                    }
                                ?>
                        </div>
                    </div>
                
                </div>
        
	
    
    
