<?php
  $alermTime='60';
  if(isset($triggerInfo['alermTime'])){

     $alermTime=$triggerInfo['alermTime'];
  } 
 
  $checked='checked="checked"';
  $checked1='';
  if(isset($triggerInfo['continueCronOnFailure']))
  {
    if($triggerInfo['continueCronOnFailure']=='true')
    { 
      $checked='checked="checked"';
      $checked1='';
    }
    else if($triggerInfo['continueCronOnFailure']=='false'){
       $checked1='checked="checked"';
       $checked='';
    }
  }
  
  ?>
<div id="main">
   <div id="content">
      <div class="row">
      <section class="panel">
            <header class="panel-heading">
               <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                     <?php if($_GET['tid']){?>
                     <h3><strong><?php echo $ui_string['edit'];?></strong> <?php echo $ui_string['timeTrigger'];?></h3>
                     <?php } else {?>
                     <h3><strong><?php echo $ui_string['add'];?></strong> <?php echo $ui_string['timeTrigger'];?></h3>
                     <?php } ?>
                  </div>
               </div>
            </header>
        <div class="panel-body">
               <form id="timetrigger" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                 <?php $csrf = new CSRF_Protect(); $csrf->echoInputField();?>
                   <div class="form-group">
              <label class="control-label"><?php echo $ui_string['cronId'];?></label>
                     <div> 
                             <select  id="cronId" name="cronId" data-check-valid="blank" data-error-show-in="ecronId" data-error-setting="2" data-error-text="<?php echo $ui_string['3401'];?>" class="form-control required_field timetrigger" value=""  placeholder="" >
                              <?php 
                              $cronInfo=get_crons(array());
                              if(!empty($cronInfo['data'])){foreach ($cronInfo['data'] as $value) {?>
                     
                              <option value="<?php echo $value['cronId'];?>" <?php if($_GET['id']==$value['cronId']){echo 'selected="selected"';}?>><?php echo $value['name'];?></option>
                              <?php } } ?>
                            </select> 
                <span id="ecronId" class="error"></span> </div>
                        </div>
                   </div>
                  
                  <?php echo get_data_field('text',$ui_string['triggerFilePath'],'fileName','fileName','required_field timetrigger','data-check-valid="blank" data-error-show-in="efileName" data-error-setting="2" data-error-text="'.$ui_string['3400'].'"',$triggerInfo['fileName'],'','',''); ?>

                   <?php echo get_data_field('number',$ui_string['alertTime'],'alermTime','alermTime','required_field timetrigger','data-check-valid="blank" data-error-show-in="efileName" data-error-setting="2" data-error-text="'.$ui_string['3406'].'"',$alermTime,'','',''); ?>


                    <div class="form-group">
              <label class="control-label"><?php echo $ui_string['ccron'];?></label>
                     <div> 
                      <input type="radio" id="continueCronOnFailure" name="continueCronOnFailure" value="true" <?php echo $checked;?> ><?php echo $ui_string['yes'];?>
                        <input type="radio" id="continueCronOnFailure1" name="continueCronOnFailure" value="false" <?php echo $checked1; ?> ><?php echo $ui_string['no'];?>
                      </div>     
                            
                   </div>

               
                  <input type="hidden" name="id" value="<?php echo $tid; ?>"/>
              
         
                 <div class="form-group">
                  <?php if($_GET['tid']!=''){?>
              <button  onclick="return validation('editTimeTrigger')" type="button" class="btn btn-theme-inverse"> <?php echo $ui_string['update'];;?> </button>
                  <?php } else {?>
              <button  onclick="return validation('addTimeTrigger')" type="button" class="btn btn-theme-inverse"> <?php echo $ui_string['submit'];;?> </button>
                  <?php } ?>
               </div>
               </form>
            </div>
         </section>
      </div>
   </div>
</div>


</div>
</div>