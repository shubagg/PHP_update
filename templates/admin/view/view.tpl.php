

<div id="main" class="dashboard">
<?php get_breadcrumb();
              
?>

  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal-scrollable"><div id="myModal-4" class="modal fade">
		   <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			  <i class="fa fa-times"></i>
			  </button>
			  <h4 class="modal-title" id="model_head">Run</h4>
		   </div>
		   <!-- //modal-header-->
		   <div class="modal-body text_alignment">
			  <form class="form-horizontal labelcustomize">
           
            <div class="form-group ">
	<label class="control-label remove_bg col-md-4 col-md-2"><span class="color">Select<font class="color">*</font></span></label>
	<div class="col-md-8 col-md-10">
	<select class="form-control">
		<option>select</option>
		<option>http://192.168.1.165</option>
		<option>http://192.168.1.119:8081</option>
	</select>
	    <span id="ecategoryname" class="error"></span>
    </div>
	</div>    <div class="col-md-12 text-right margn-btm-20">
               <span id="groupbut">
               	<button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" onclick="submitdata();">Confirm</button>
               </span>
               <span><button type="button" class="btn btn-inverse bottom-gap" pd-popup-close="popupNew1">
Cancel</button></span>
            </div>
            <br>
         </form>
		   </div>
		   <!-- //modal-body-->
		</div></div>


    <div id="content">
      <div class="row">
        <section class="panel">
          <header class="panel-heading">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3><strong><?php //echo $ui_string['BusinessProcess'];?> Control Tower</strong></h3>
              </div>
  
             
            </div>
          </header>
          <div class="panel-body">

    <section class="panel"> 
      <div class="panel-body">
      
            <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
            
                <li role="presentation" onclick="load_page('viewlist','view')" class="active"><a id="tab_view" href="#view" aria-controls="home" role="tab" data-toggle="tab"><?php echo $ui_string['viewlist'];?></a></li>
                <li role="presentation" onclick="load_page('draftlist','draft')" ><a id="tab_draft" href="#draft" aria-controls="home" role="tab" data-toggle="tab"><?php echo $ui_string['draftlist'];?></a></li>               
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
               
                <div role="tabpanel" class="tab-pane active" id="view"></div>
                 <div role="tabpanel" class="tab-pane" id="draft"></div>
              </div>
              
            </div>
                </section>

<strong>
          </div>
        </section>
      </div>
    </div>
  </div>
  
  <?php get_admin_left_sidebar($language); ?>

