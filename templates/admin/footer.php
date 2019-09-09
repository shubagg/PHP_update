<section>
		<div id="deletepopup" class="modal fade in" data-backdrop="static" data-keyboard="false">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></button>
				<h4 class="modal-title"><i class=""></i> <span id="msgtext"></span></h4>
				</div>
				<!-- //modal-header-->

				<div class="modal-body text_alignment">
				<div class="button_holder"> 

				<div id="deletconfirm"></div>
				</div>
				</div>
		</div>
		<div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
               <div class="modal-header">
                  <button  type="button" class="close"></button>
                  <h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>
               </div>
               <!-- //modal-header-->

               <div class="modal-body">

                  <div class="button_holder">
                     <p><strong id="error_body"></strong></p>
                  </div>
               </div>
               <!-- //modal-body-->
            </div>
		<div id="success_modal" class="modal fade"
		   data-header-color="#736086">
		   <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal"
				 aria-hidden="true">
			  <i class="fa fa-times"></i>
			  </button>
			  <h4 class="modal-title" id="model_head">
				 <i class="glyphicon glyphicon-ok-circle"></i> Confirmation
			  </h4>
		   </div>
		   <!-- //modal-header-->
		   <div class="modal-body text_alignment">
			  <div class="confirmation_successful">
				 <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
				 <span id="model_des">Confirmation Successful</span>
			  </div>
		   </div>
		   <!-- //modal-body-->
		</div>
</section>
    
    <!-- Jquery Library -->
    <script type="text/javascript" src="<?php echo admin_assets_url(); ?>plugins/combineJs/TM_js.js?8400&cache=<?php echo get_assets_caching();?>"></script>
    <script type="text/javascript" src="<?php echo admin_assets_url(); ?>plugins/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo get_global_js_url(); ?>global.js?cache=<?php echo get_assets_caching();?>"></script>
	<script type="text/javascript" src="<?php echo get_global_js_url(); ?>validation.js?cache=<?php echo get_assets_caching();?>"></script>
	<script type="text/javascript" src="<?php echo get_global_js_url(); ?>checkbox_multiple_datatable.js"></script>
	<!-- Library Themes Customize -->
	<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/tm.custom.js?cache=<?php echo get_assets_caching();?>"></script>
	
  
	<script type="text/javascript">

	function fnShowHide( iCol , table){
	    var oTable = $(table).dataTable(); 
	    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
	    oTable.fnSetColumnVis( iCol, bVis ? false : true );
	}

	$(function() {
		
		//////////     DATA TABLE  COLUMN TOGGLE    //////////
		$('[data-table="table-toggle-column"]').each(function(i) {
				var data=$(this).data(), 
				table=$(this).data("table-target"), 
				dropdown=$(this).parent().find(".dropdown-menu"),
				col=new Array;
				$(table).find("thead th").each(function(i) {
				 		$("<li><a  class='toggle-column' href='javascript:void(0)' onclick=fnShowHide("+i+",'"+table+"') ><i class='fa fa-check'></i> "+$(this).text()+"</a></li>").appendTo(dropdown);
				});
		});

		//////////     COLUMN  TOGGLE     //////////
		 $("a.toggle-column").on('click',function(){
				$(this).toggleClass( "toggle-column-hide" );  				
				$(this).find('.fa').toggleClass( "fa-times" );  			
		});

		// Call dataTable in this page only
		$('#table-example').dataTable();
		$('#table-example1').dataTable();
		$('#table-example2').dataTable();
		$('#table-example3').dataTable();
		$('#table-example4').dataTable();
		$('#table-example5').dataTable();
		$('table[data-provide="data-table"]').dataTable();
		$('.basic_datatable').dataTable();
	});
</script>
<script>
	$( document ).ready(function() {
setTimeout(function(){$(function () {
    "use strict";
    
    $(".sorting_1 img").click(function () {
        var $src = $(this).attr("src");
        $(".show1").fadeIn();
        $(".img-show img").attr("src", $src);
    });
    
    $("span, .overlay").click(function () {
        $(".show1").fadeOut();
    });
    
})}, 3000);



        
    });
</script>



