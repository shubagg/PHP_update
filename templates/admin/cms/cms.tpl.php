<div id="main">
   
  <div id="content" style="padding:15px;">
    <section class="box">
      <h2 class="title"><?php if(isset($getSlugCms['data'][0]['id'])){ echo $getSlugCms['data'][0]['subtitle']; } else { echo "Add Page"; } ?></h2>
    </section>
    <section class="panel margin-bottom-20">
      <div class="panel-body" style="padding: 20px 10px 3px 20px;">
        <form id="reportrecord" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        
		
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group" style="display:none">
              <label for="inputOne"> Slug</label>
              <input type="hidden" name="id" id="id" value="<?php echo $getcmsid; ?>">
              <input type="text" class="form-control" id="slug" name="About us_heading" value="<?php echo $getSlugCms['data'][0]['slug']; ?>">
              <span id="slug_err" class="valid_error" style="color:red"></span>
           </div>
           <div class="form-group" style="display:none">
              <label for="inputOne"> Icon</label>
              <input type="text" class="form-control" id="icon" name="About us_heading" value="<?php echo $getSlugCms['data'][0]['icon']; ?>">
              <span id="icon_err" class="valid_error" style="color:red"></span>
           </div>
          <div class="form-group" style="display:none">
              <label for="inputOne">Title</label>
              <input type="text" class="form-control" id="subtitle" name="About us_heading" value="<?php echo $getSlugCms['data'][0]['subtitle']; ?>">
              <span id="subtitle_err" class="valid_error" style="color:red"></span>
           </div>
          <div class="form-group">
              <label for="inputOne">  Heading </label>
              <input type="text" class="form-control" id="title" name="About us_heading" value="<?php echo $getSlugCms['data'][0]['title']; ?>">
              <span id="title_err" class="valid_error" style="color:red"></span>
           </div>

           <div class="form-group">
              <label for="inputOne">  Email </label>
              <input type="text" class="form-control" id="email" name="email" value="<?php echo $getSlugCms['data'][0]['email']; ?>">
              <span id="email_err" class="valid_error" style="color:red"></span>
           </div>

           <div class="form-group">
              <label for="inputOne">  Mobile </label>
              <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $getSlugCms['data'][0]['mobile']; ?>">
              <span id="mobile_err" class="valid_error" style="color:red"></span>
           </div>

           <div class="form-group">
              <label for="inputOne">  web Url </label>
              <input type="text" class="form-control" id="weburl" name="weburl" value="<?php echo $getSlugCms['data'][0]['weburl']; ?>">
              <span id="weburl_err" class="valid_error" style="color:red"></span>
           </div>

            <div class="form-group">
              <label for="inputOne">  Address </label>
              <input type="text" class="form-control" id="address" name="address" value="<?php echo $getSlugCms['data'][0]['address']; ?>">
              <span id="address_err" class="valid_error" style="color:red"></span>
           </div>
                
                 <div class="form-group" style="display:none;">
                        <label for="inputOne"> Description</label> <br /> <br />
                        <textarea class="form-control " id="editorCk" rows="3"><?php echo $getSlugCms['data'][0]['description']; ?></textarea>
                        <span id="description_err" class="valid_error" style="color:red"></span>
                     </div>
                 
                    <div class="form-group">
                      <?php if(check_user_permission("cms","enquiry","all")==1){?>
                       
                        
                      <button type="button" class="btn btn-primary Saawtbtn2" data-toggle="modal" onclick="validate();"; data-target="">Save</button>
                      <?php } ?>
                      <?php if(isset($getSlugCms['data'][0]['id'])) {?>
                      <button type="button" style="display:none" class="hvr-bounce-to-bottom btn " data-toggle="modal" id="<?php echo $getSlugCms['data'][0]['id']; ?>" onclick="delete_cms(this.id);"; data-target="">Delete</button>
                      <?php } ?>
                    </div>
                     
                     </div>
      </form>
      </div>
    </section>

    
  </div>
  
  <!-- //content--> 
  
</div>

<!-- //main-->

      <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
        <div class="modal-header">
          <button  type="button" class="close"></button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>
        </div>
        <!-- //modal-header-->
        <div class="modal-body text_alignment">
          <div class="button_holder">
            <p><strong id="error_body"></strong></p>
          </div>
        </div>
        <!-- //modal-body--> 
      </div>

<!--success,fail message popup--> 

<?php echo success_fail_message_popup();?> 

<!--delete_confirmation popup--> 

<?php echo delete_confirmation_popup();?> 

