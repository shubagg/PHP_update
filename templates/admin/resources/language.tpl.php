<div id="main">
      <div id="content">
        <div class="row">
            
                
      <section class="panel top-gap">
          <header class="panel-heading">
          <div class="row">
          
            <div class="col-md-4 margn_tp_7">
            
                <h3><strong><?php echo $ui_string['language']; ?></strong> <!--<?php echo $ui_string['list']; ?> --></h3>
                
            
            </div>
            
            
          </div>
          </header>
          
            <div class="panel-body panel_bg_d">
             <?php if(!empty($languages)){ foreach ($languages as $lang) {?>
 <div class="row  ">
 
            

            
             <div class="col-md-5 col-sm-9 col-xs-8 font-16"><input class=""  type="radio" name="lang" value="<?php $lang['code'];?>" <?php if($lang['code']==$_SESSION['user']['lang']){echo 'checked="checked"';}?> onchange="change_languages('<?php echo $lang['code'];?>')"> <?php echo $lang['title'];?></div>
               
             </div>
             
<br/>
             <?php } ?>
        <input type="hidden" id="code" value="<?php echo $_SESSION['user']['lang']; ?>">     

<button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" onclick="change_confirm_language()"><?php echo $ui_string['save'];?></button>

             <?php }?>  
            

             <?php /*?>        
              <div class="table-responsive">
                            
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped datatable">
            <thead>
              <tr>
                <th><?php echo $ui_string['id']; ?></th>
               <!--  <th><?php echo $ui_string['stringid']; ?></th> -->
                <th><?php echo $ui_string['languagename']; ?></th>
                <th><?php echo $ui_string['action']; ?></th>  
              </tr>
            </thead>
            <tbody align="center">
            <?php
           $language_setting_json=get_module_setting_by_mid(array("mid"=>'1',"smid"=>'1'));
           $language_setting_json = $language_setting_json['data'][0]['uiSetting']['lang'];
           if(sizeof($language_setting_json)>0){
           for($i=0;$i<sizeof($language_setting_json);$i++){

            ?>
                <tr class="gradeX">
                  <td><?php echo $language_setting_json[$i]['id'] ;?></td>
                 <!--  <td><?php echo $language_setting_json[$i]['stringid']; ?></td> -->
                  <td><?php echo $language_setting_json[$i]['string']; ?></td>
                  <td>
                    <button class="btn_actoin languageButton btn btn-theme-inverse" onclick="change_language('<?php echo $language_setting_json[$i]['id'] ;?>')" type="button"> <?php  echo $ui_string['changelanguage']; ?> </button>
                    <button class="btn_actoin languageButton btn btn-theme-inverse" onclick="makedefault('<?php echo $language_setting_json[$i]['id'] ;?>')" type="button"> <?php  echo $ui_string['makedefault']; ?> </button>
                  </td>
                </tr>
            <?php } } else {?>
                   <tr>
                   <td><?php echo $ui_string['no_record_found'] ?></td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   </tr>

            <?php }?>

            </tbody>
      
    
          </table>   
              </div>
              <?php */?>
            </div>
          </section>
            
        <!-- //content > row-->
      </div>
      <!-- //content-->
    </div>
    <!-- //main-->


    
              
     <?php echo delete_confirmation_popup(); ?> 

     <div id="confirmlang_modal" class="modal fade in" data-backdrop="static" data-keyboard="false" data-width="300" style="display: none; width: 300px; margin-left: -150px; margin-top: -67.5px;" aria-hidden="false">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title"><?php echo $ui_string['areyousure'];?>?</h4>
                    </div>
                    <!-- //modal-header-->
                    <form class="form-horizontal" data-collabel="2" data-label="color" id="deleteData">
                    <?php $csrf = new CSRF_Protect(); $csrf->echoInputField();?>
               
                    <div class="modal-body text_alignment">
                    <div class="button_holder"> 
                    
                    <div id="deletType"><button type="button" id="delete_sure_button" class="btn btn-inverse" onclick=" change_panel_language()"><?php echo $ui_string['confirm'];?></button>
                    <button type="button"  class="btn btn-theme-inverse" data-dismiss="modal"><?php echo $ui_string['cancel'];?></button>
                                </div></div>
                            </div>
                    </form>                
        <!-- //modal-body-->
        </div>

  </div>