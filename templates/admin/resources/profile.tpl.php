<div id="main">
    <?php get_breadcrumb();
    $userEncyInfo = encrypt_decrypt($_SESSION['user']["user_id"], 'encrypt', 'nikky', '');
    $userId = !empty($userEncyInfo['data']) ? $userEncyInfo['data'] : '';
    ?>
    <div id="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:0;">
                <section class="panel">
                    <div class="panel-body">
                        <div class="col-md-4 align-lg-center">
                            <img id="blah" src="<?php echo $img_url; ?>" class="circle" style="width:120px; height:120px; border:5px #edece5   solid; margin:25px 0;">
                            <div class="form-group">
                                <button type="button" id="abcfile" class="btn btn-theme-inverse" onClick="showUploadForm()" > <?php echo $ui_string['change_image']; ?></button>
                                <button type="button" class="btn btn-theme-inverse md-effect" data-toggle="modal" data-effect="md-scale" href="#changepwd"> <?php echo $ui_string['change_password']; ?></button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <h3><?php echo $ui_string['account']; ?> <?php echo $ui_string['setting']; ?></h3>
                            <hr>
                            <form id="addUser" method="post" action="" enctype="multipart/form-data">
                                <?php $csrf = new CSRF_Protect();
                                $csrf->echoInputField(); ?>
                                <div class="form-group">
                                    <label class="control-label"><?php echo $ui_string['email']; ?></label>
                                    <input type="hidden" name="userId" id="userId" value="<?php echo $userId; ?>"/>	
                                    <input value="<?php echo $users[0]['email']; ?>" type="text" class="form-control" readonly  parsley-trigger="keyup"  parsley-rangelength="[8,15]"  parsley-required="true" parsley-trigger="keyup" placeholder="">
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="control-label"><?php echo $ui_string['name']; ?><span style="color: red;">*</span></label>
                                        <input value="<?php echo $users[0]['name']; ?>" type="text" data-check-valid="blank" data-valid-nospecial-error="Please enter valid name" data-error-show-in="ename" data-error-setting="2" data-error-text="Please enter name" class="form-control required_field modifyUser error2" name="name" id="name" placeholder=""  />
                                        <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="ename"></li></ul>

                                    </div>
                                    <?php /* ?><div class="col-md-6">

                                      <label class="control-label"><?php echo $ui_string['age'];?><span style="color: red;">*</span></label>
                                      <input readonly="readonly" value="<?php echo $users[0]['age'];?>" type="text" name="age" id="age" data-check-valid="blank" data-valid-lt-error="Please enter valid Date Of Birth" data-valid-numeric-error="Please enter valid Date Of Birth" data-error-show-in="eage" data-error-setting="2" data-error-text="Please enter Date Of Birth" class="form-control required_field modifyUser error2 form_datetime" />
                                      <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eage"></li></ul>

                                      </div>
                                      <?php */ ?>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="button" class="btn btn-theme-inverse" onclick="return validation('modifyUser')"><?php echo $ui_string['update']; ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- //content > row-->
    </div>
    <!-- //content-->
</div>
<!-- //main-->
<div id="md-effect" class="modal fade" tabindex="-1" data-width="450">
    <!--   <div class="modal-header bg-inverse bd-inverse-darken">-->
    <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title"><i class="fa fa-key"></i> <?php echo $ui_string['change_password']; ?></h4>
    </div>
    <!-- //modal-header-->
    <form id="updatePassword" method="post" action="" enctype="multipart/form-data">
<?php $csrf->echoInputField(); ?>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label"><?php echo $ui_string['old_password']; ?><font class="color">*</font></label>
                <input type="password" data-check-valid="blank" data-error-show-in="eold_password" data-error-setting="2" data-error-text="<?php echo $ui_string['12018']; ?>" class="form-control required_field updatePassword error1" name="old_password" id="old_password" placeholder=""  />
                <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eold_password"></li></ul>

            </div>
            <div class="form-group">
                <label class="control-label"><?php echo $ui_string['new_password']; ?><font class="color">*</font></label>
                <input type="password" data-check-valid="blank,gt-5" data-valid-gt-error="<?php echo $ui_string['12017']; ?>" data-error-show-in="enew_password" data-error-setting="2" data-error-text="<?php echo $ui_string['12020']; ?>" class="form-control required_field updatePassword error1" name="new_password" id="new_password" placeholder=""  />
                <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="enew_password"></li></ul>

            </div>
            <div class="form-group">
                <label class="control-label"><?php echo $ui_string['confirm_password']; ?><font class="color">*</font></label>
                <input type="password" data-match-with="new_password" data-valid-match-error="<?php echo $ui_string['12021']; ?>" data-check-valid="blank,match" data-valid-gt-error="?php echo $ui_string['12017'];?>" data-error-show-in="econfirm_password" data-error-setting="2" data-error-text="<?php echo $ui_string['12019']; ?>" class="form-control required_field updatePassword error1" name="confirm_password" id="confirm_password" placeholder=""  />
                <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="econfirm_password"></li></ul>

            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-theme-inverse" onclick="return validation('updatePassword')"><?php echo $ui_string['submit']; ?></button>
                <span class="error" id="er-msg" style="color:red;"></span>
            </div>
        </div>
    </form>
    <!-- //modal-body-->
</div>

<div id="md-effect1" class="modal fade" tabindex="-1" data-width="450" data-backdrop="static" auto-keyword="false">
    <!-- <div class="modal-header bg-inverse bd-inverse-darken">-->
    <div class="modal-header">
        <button type="button" class="close" onClick="close_image_popup()"><i class="fa fa-times"></i></button>
        <h4 class="modal-title"><i class="fa fa-upload"></i> <?php echo $ui_string['upload_image']; ?></h4>
    </div>
    <!-- //modal-header-->
    <form id="updateProfileImage" method="post" action="" enctype="multipart/form-data">
        <?php $csrf->echoInputField(); ?>
        <div class="modal-body">
            <div class="form-group">
                <input name="profile_picture" id="profile_picture1" type="file">
                <input type="hidden" name="userId" id="userId" value="<?php echo encrypt_decrypt('', 'encrypt', 'nikky', $_SESSION['user']["user_id"]); ?>"/>  
                <input type="hidden" data-check-valid="blank" data-error-show-in="eprofile_picture" data-error-setting="2" data-error-text="please upload profile image" class="form-control required_field updateProfileImage error1" name="vprofile_picture" id="vprofile_picture" />
                <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eprofile_picture"></li></ul>
            </div>
            <div class="form-group">
                <!--<button name="submit_img" class="btn btn-primary" onclick="return validation('updateProfileImage')">Upload Image</button>-->
                <input type="button" name="submit" value="<?php echo $ui_string['upload_image']; ?>" class="btn btn-primary btn-theme-inverse" onclick="return validation('updateProfileImage')">
            </div>
        </div>
    </form>
    <!-- //modal-body-->
</div>