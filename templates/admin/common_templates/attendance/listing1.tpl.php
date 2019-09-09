<section class="panel">
    <!--<a href="javascript:;" onclick="show_datatable(334,'j.priority=3')">hello</a>-->

<div class="panel-body">
<header class="panel-heading">
    <div class="row">
    
    <div class="col-md-3">
    	<label><?php echo $ui_string['fromdate'];?></label>
       <div class="input-group date form_datetime " data-picker-position="bottom-left" data-date-format="yyyy-mm-dd">
					<input type="text" id='fromDate' readonly class="form-control input-height" placeholder="<?php echo $ui_string['from_date']; ?>" value="" >
          <span class="error" id="e_fromDate"></span>
					<span class="input-group-btn">
					<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
					<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
			</div>
    </div>
    <div class="col-md-3">
    	<label><?php echo $ui_string['todate'];?></label>
      <div class="input-group date form_datetime " data-picker-position="bottom-left" data-date-format="yyyy-mm-dd">
          <input type="text" id='toDate' readonly class="form-control input-height" placeholder="<?php echo $ui_string['to_date']; ?>" value="">
          <span class="error" id="e_toDate"></span>
          <span class="input-group-btn">
          <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
          <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
          </span>
      </div>
    </div>
    <div class="col-md-1">
    <div><label>&nbsp;</label></div>
    	<button class="btn btn-theme-inverse" onclick="changeData()" ><?php echo $ui_string['submit']?></button>
    </div>
    <div class="col-md-4 text-right pull-right" id="">
                   <div><label>&nbsp;</label></div>
                    <?php
                        echo $this->custom_buttons(); 
                    ?>
        </div>  
		
       
         
</div>

			
																				
</header>

       <div class="row ">
       	  <div class="col-xs-12 margn-tp-20">
       	    <table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="table table-striped">
            <thead>
                <tr>
                    <?php 
                    $table_header = $this->get_table_header();
                    
                    if(is_array($table_header) && count($table_header)) { 
                        
                        foreach($table_header as $val) {
                            ?>
                            <th class="text-center2">
                                <?= $ui_string[$val]; ?>
                            </th>
                            <?php
                        }
                        ?>
                    <?php } ?>
                </tr>
            </thead>
        </table>
       	  	
       	  </div>
       </div>

    
</div>
</section>
<script type="text/javascript">
  $( window ).on( "load", function() {
        if( typeof columns_listing != 'object' ) {

            columns_listing = JSON.parse(columns_listing);

        }
        console.log(columns_listing);
        $('#fromDate').val(columns_listing['api_params']['fromDate']);
        $('#toDate').val(columns_listing['api_params']['toDate']);
    });
</script>



