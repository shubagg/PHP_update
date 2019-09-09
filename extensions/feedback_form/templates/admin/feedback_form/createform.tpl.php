<style>
.panel-heading.xs h2 {
    font-size: 1.1em;
	    font-weight: 600;
}

#uploader .queueList {
    margin: 20px;
}

.element-invisible {
    position: absolute !important;
    clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px,1px,1px,1px);
}

#uploader .placeholder {
    border: 3px dashed #e6e6e6;
    min-height: 238px;
    padding-top: 158px;
    text-align: center;
    background: url(./image.png) center 93px no-repeat;
    color: #cccccc;
    font-size: 18px;
    position: relative;
}

#uploader .placeholder .webuploader-pick {
    font-size: 18px;
    background: #00b7ee;
    border-radius: 3px;
    line-height: 44px;
    padding: 0 30px;
    color: #fff;
    display: inline-block;
    margin: 20px auto;
    cursor: pointer;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}

#uploader .placeholder .webuploader-pick-hover {
    background: #00a2d4;
}

#uploader .placeholder .flashTip {
    color: #666666;
    font-size: 12px;
    position: absolute;
    width: 100%;
    text-align: center;
    bottom: 20px;
}
#uploader .placeholder .flashTip a {
    color: #0785d1;
    text-decoration: none;
}
#uploader .placeholder .flashTip a:hover {
    text-decoration: underline;
}

#uploader .placeholder.webuploader-dnd-over {
    border-color: #999999;
}

#uploader .placeholder.webuploader-dnd-over.webuploader-dnd-denied {
    border-color: red;
}

#uploader .filelist {
    list-style: none;
    margin: 0;
    padding: 0;
}

#uploader .filelist:after {
    content: '';
    display: block;
    width: 0;
    height: 0;
    overflow: hidden;
    clear: both;
}

#uploader .filelist li {
    width: 110px;
    height: 110px;
    background: url(./bg.png) no-repeat;
    text-align: center;
    margin: 0 8px 20px 0;
    position: relative;
    display: inline;
    float: left;
    overflow: hidden;
    font-size: 12px;
}

#uploader .filelist li p.log {
    position: relative;
    top: -45px;
}

#uploader .filelist li p.title {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow : ellipsis;
    top: 5px;
    text-indent: 5px;
    text-align: left;
}

#uploader .filelist li p.progress {
    position: absolute;
    width: 100%;
    bottom: 0;
    left: 0;
    height: 8px;
    overflow: hidden;
    z-index: 50;
}
#uploader .filelist li p.progress span {
    display: none;
    overflow: hidden;
    width: 0;
    height: 100%;
    background: #1483d8 url(./progress.png) repeat-x;

    -webit-transition: width 200ms linear;
    -moz-transition: width 200ms linear;
    -o-transition: width 200ms linear;
    -ms-transition: width 200ms linear;
    transition: width 200ms linear;

    -webkit-animation: progressmove 2s linear infinite;
    -moz-animation: progressmove 2s linear infinite;
    -o-animation: progressmove 2s linear infinite;
    -ms-animation: progressmove 2s linear infinite;
    animation: progressmove 2s linear infinite;

    -webkit-transform: translateZ(0);
}

@-webkit-keyframes progressmove {
    0% {
       background-position: 0 0;
    }
    100% {
       background-position: 17px 0;
    }
}
@-moz-keyframes progressmove {
    0% {
       background-position: 0 0;
    }
    100% {
       background-position: 17px 0;
    }
}
@keyframes progressmove {
    0% {
       background-position: 0 0;
    }
    100% {
       background-position: 17px 0;
    }
}

#uploader .filelist li p.imgWrap {
    position: relative;
    z-index: 2;
    line-height: 110px;
    vertical-align: middle;
    overflow: hidden;
    width: 110px;
    height: 110px;

    -webkit-transform-origin: 50% 50%;
    -moz-transform-origin: 50% 50%;
    -o-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;

    -webit-transition: 200ms ease-out;
    -moz-transition: 200ms ease-out;
    -o-transition: 200ms ease-out;
    -ms-transition: 200ms ease-out;
    transition: 200ms ease-out;
}

#uploader .filelist li img {
    width: 100%;
}

#uploader .filelist li p.error {
    background: #f43838;
    color: #fff;
    position: absolute;
    bottom: 0;
    left: 0;
    height: 28px;
    line-height: 28px;
    width: 100%;
    z-index: 100;
}

#uploader .filelist li .success {
    display: block;
    position: absolute;
    left: 0;
    bottom: 0;
    height: 40px;
    width: 100%;
    z-index: 200;
    background: url(./success.png) no-repeat right bottom;
}

#uploader .filelist div.file-panel {
    position: absolute;
    height: 0;
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#80000000', endColorstr='#80000000')\0;
    background: rgba( 0, 0, 0, 0.5 );
    width: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
    z-index: 300;
}

#uploader .filelist div.file-panel span {
    width: 24px;
    height: 24px;
    display: inline;
    float: right;
    text-indent: -9999px;
    overflow: hidden;
    background: url(./icons.png) no-repeat;
    margin: 5px 1px 1px;
    cursor: pointer;
}

#uploader .filelist div.file-panel span.rotateLeft {
    background-position: 0 -24px;
}
#uploader .filelist div.file-panel span.rotateLeft:hover {
    background-position: 0 0;
}

#uploader .filelist div.file-panel span.rotateRight {
    background-position: -24px -24px;
}
#uploader .filelist div.file-panel span.rotateRight:hover {
    background-position: -24px 0;
}

#uploader .filelist div.file-panel span.cancel {
    background-position: -48px -24px;
}
#uploader .filelist div.file-panel span.cancel:hover {
    background-position: -48px 0;
}

#uploader .statusBar {
    height: 63px;
    border-top: 1px solid #dadada;
    padding: 0 20px;
    line-height: 63px;
    vertical-align: middle;
    position: relative;
}

#uploader .statusBar .progress {
    border: 1px solid #1483d8;
    width: 198px;
    background: #fff;
    height: 18px;
    position: relative;
    display: inline-block;
    text-align: center;
    line-height: 20px;
    color: #6dbfff;
    position: relative;
    margin-right: 10px;
}
#uploader .statusBar .progress span.percentage {
    width: 0;
    height: 100%;
    left: 0;
    top: 0;
    background: #1483d8;
    position: absolute;
}
#uploader .statusBar .progress span.text {
    position: relative;
    z-index: 10;
}

#uploader .statusBar .info {
    display: inline-block;
    font-size: 14px;
    color: #666666;
}

#uploader .statusBar .btns {
    position: absolute;
    top: 10px;
    right: 20px;
    line-height: 40px;
}

#filePicker2 {
    display: inline-block;
    float: left;
}

#uploader .statusBar .btns .webuploader-pick,
#uploader .statusBar .btns .uploadBtn,
#uploader .statusBar .btns .uploadBtn.state-uploading,
#uploader .statusBar .btns .uploadBtn.state-paused {
    background: #ffffff;
    border: 1px solid #cfcfcf;
    color: #565656;
    padding: 0 18px;
    display: inline-block;
    border-radius: 3px;
    margin-left: 10px;
    cursor: pointer;
    font-size: 14px;
    float: left;
}
#uploader .statusBar .btns .webuploader-pick-hover,
#uploader .statusBar .btns .uploadBtn:hover,
#uploader .statusBar .btns .uploadBtn.state-uploading:hover,
#uploader .statusBar .btns .uploadBtn.state-paused:hover {
    background: #f0f0f0;
}

#uploader .statusBar .btns .uploadBtn {
    background: #00b7ee;
    color: #fff;
    border-color: transparent;
}
#uploader .statusBar .btns .uploadBtn:hover {
    background: #00a2d4;
}

#uploader .statusBar .btns .uploadBtn.disabled {
    pointer-events: none;
    opacity: 0.6;
}

.webuploader-container {
	position: relative;
}
.webuploader-element-invisible {
	position: absolute !important;
	clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px,1px,1px,1px);
}
.webuploader-pick {
	position: relative;
	display: inline-block;
	cursor: pointer;
	background: #00b7ee;
	padding: 10px 15px;
	color: #fff;
	text-align: center;
	border-radius: 3px;
	overflow: hidden;
}
.webuploader-pick-hover {
	background: #00a2d4;
}

.webuploader-pick-disable {
	opacity: 0.6;
	pointer-events:none;
}



</style>


<div id="main">
   <div id="content">
      <div class="row">
         <section class="panel">
            <header class="panel-heading">
               <div class="row">
                  <div class="col-md-6">
                     <h3><strong><?php echo $ui_string['fillupform']?></strong></h3>
                  </div>
                 
                  <div class="col-md-6 text-right tooltip-area">
                    
            
                  </div>
               </div>
            </header>
<div class="panel-body" style="padding-left:0px; padding-right:0px;">
       <div class="tabbable">
          <ul class="nav nav-tabs">
             <?php /* ?><li class="active"><a href="#create_new" data-toggle="tab"><?php echo $ui_string['commonlyusedform'];?></a></li><?php */?>
             <li class="active"><a href="#commonused" data-toggle="tab"><?php echo $ui_string['choosenewfrom'];?></a></li>
          </ul>
        <div class="tab-content" style="background-color: transparent;">
           <?php /* ?> <div class="tab-pane fade in active" id="create_new">
                       
                  <?php
                      $output=curl_post("/get_common_used_form_by_id",array('id'=>'0',"userId"=>$_SESSION['user']['user_id']));

                      if($output['data'])
                      {


                      //echo "<pre>";print_r($output);
                      foreach ($output['data'] as $outputvalue) 
                      { 
                        if($outputvalue['formId'])
                        {
                        $formData=curl_post("/get_form_by_id",array('id'=>$outputvalue['formId']));
                        $formData=$formData['data'][0];
                        //echo "<pre>";print_r($formData);
                  ?>
                  <div class="" style="margin-left:25px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                      <span class="radio" data-color="red">

                      <input onclick="location.href='<?php echo site_url().'admin/form/formdetail?formid='.$formData['id']; ?>'" name="formname" value="<?php echo $formData['id']; ?>" class="check_box" type="radio"> <label> <?php echo $outputvalue['name']; ?></label>
                     
                      </span>
                      </div>
                       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                        <button type="button" class="btn btn-theme-inverse" id="delete" name="delete" onclick="confirmationpopupshow('<?php echo $outputvalue['id']; ?>');"><i class="fa fa-trash" aria-hidden="true"></i>
                        <?php echo $ui_string['delete']; ?></button>
                      
                       </div>
                      </div> 
                      </div>                  </div>

                  <?php } } }else {?>
                    <div class="" style="margin-left:25px;">
                      <div class="row">
                      <span class="radio" data-color="red"></span><?php echo $ui_string['no_record_found'];?></span>
                      </div> 
                    </div>
                  <?php }?>    
        </div> <?php */ ?>
        <div class="tab-pane fade in active" id="commonused">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <input type="hidden" id="commonusedId" value="0" class="form-control">
                      <input type="hidden" id="userId" value="<?php echo $_SESSION['user']['user_id']; ?>" class="form-control">
                      <div class="form-group">
                        <label for="title"><?php echo $ui_string['department'];?></label>
                        <select id="category" name="category" class="form-control" onchange="getrelatedForm(this.value);">

                      <?php
                      $categorylist='569f77677c3d6894203c9869';
                      $parentId=array();
                      $userData=get_resource_by_id(array('id'=>$_SESSION['user']['user_id']));
                      //pr($userData);
                      $userData=$userData['data']['0'];
                      if($userData['user_type']!='super admin'){
                            $categorylist=$userData['category']['0'];
                            $categoryData=implode('|', $userData['category']);
                            $cat = get_category(array('id'=>$categoryData));
                            $all_cats=$cat['data'];
                            foreach ($all_cats as $value) {
                            ?>
                            <option value="<?php echo $value['id'];?>"><?php echo $value['title'];?></option>
                            <?php
                                 // $dat=get_department_tree($all_cats,$value['parent_id']);
                                 // array_push($parentId,$dat); 
                              }   
                                //show_department_accordians($parentId,'-',0,1,'');
                            }else{
                                  $cat = get_category(array());
                                  $all_cats=$cat['data'];
                                  $dat=get_category_tree($all_cats,0);
                                  //pr($dat);die;
                                  show_category_accordians($dat,'-',0,1,'');
                            }    
                            ?>   
                        </select> 
                      </div>    

                      <div class="form-group">
                        <label for="title"><?php echo $ui_string['form'];?></label>
                        <select id="relatedform" name="relatedform" class="form-control" onchange="filldisplayname(this.value)">
                        <?php $relatedform=curl_post("/get_form_by_id",array('id'=>'0','category'=>$categorylist,'fields'=>'title','status'=>'1'));  
                        $_SESSION['formcategory']=$categorylist;
                        if($relatedform['data']){
                        foreach ($relatedform['data'] as $relatedformvalue) 
                        { ?>
                        <option value="<?php echo $relatedformvalue['id']; ?>"><?php echo $relatedformvalue['title']; ?></option>
                        <?php } }else {?>
                        <option value=""><?php echo $ui_string['formnotavailable'];?></option>
                        <?php }  ?>
                        </select> 
                      </div> 
                      
                   

                     <!--  <div class="form-group">
                        <label for="title"><?php echo $ui_string['addcommonform'];?></label>
                         <input type="radio" id="commonusedcheckbox" name="commonused" class="check_box">
                        
                      </div>    -->
                      <?php /* ?>
                      <div class="form-group" >
                    
                    
                      <input id="commonusedcheckbox" name="commonused"  class="check_box" type="checkbox" onchange="showName('0');"> <label><?php echo $ui_string['addcommonlyform'];?></label>
                     
                        <span id="errorshow" style="color:red"></span>
           
                      </div><?php */ ?>

                      <div class="form-group" id="showName" style="display: none;">
                        <label for="title"><?php echo $ui_string['displayname'];?></label>
                         <input type="text" value="" id="displayname" name="name" class="form-control">
                      </div>   
                      
                      <div class="form-group text-right">
                        <button type="button" class="btn btn-theme-inverse" id='submitcommonused' name="submit"  onclick="markcommmonused();"><i class="fa fa-pencil" aria-hidden="true"></i>
                        <?php echo $ui_string['fillup']; ?></button>
                        <button type="button" style="display: none;" class="btn btn-theme-inverse" id="deletecommonused" name="delete" onclick="unmarkcommmonused();"><?php echo $ui_string['delete']; ?></button>
                      </div>

                </div>
    
          </div>
       </div>
    </div> 

          
          <div class="clearfix"></div>
            
            
            </div>
            
         </section>
        
      </div>
   </div>
   <!-- //content--> 
</div>
<!-- //main--> 
<!--
   ////////////////////////////////////////////////////////////////////////
   //////////     MODAL EFFECT DEMO    //////////
   //////////////////////////////////////////////////////////////////////
   -->


<!-- delete forum-->


      <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 


