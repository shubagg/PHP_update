<div id="main">


<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li><a href="#">Library</a></li>
						<li class="active">Data</li>
				</ol>
			

			<div id="content" style="padding:15px;" >
    <section class="panel" style=" margin-bottom:10px;">
    
    <header class="panel-heading">

						
								<h3><strong><span style="color:black;">Report</span> - <?php echo $reportName ;?></strong> </h3>

    </header>
    
   		 <div class="panel-body panel_bg_d">


      <form id="reportForm" class="form-horizontal" method="post" action="" enctype="multipart/form-data" style="margin-top:0px;">
        
		
		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="formElement">	
			<input type="hidden" value="<?php echo $mid;?>" id="mid" name="mid" />	
			<input type="hidden" value="<?php echo $smid;?>" id="smid" name="smid" />
			<input type="hidden" value="<?php echo $report_id;?>" id="report_id" name="report_id" />
			<input type="hidden" value="<?php echo $_SESSION['user']['user_id'];?>" id="userId" name="userId" />
		</div>	
      </form>
    </div>
	</section>

	<section class="panel" id="report-sec" style="display:none;">
  <?php if(!empty($allCharts)){?>
	<div class="row">

      
      <div class="col-sm-12" style="text-align:right;">
      	<ul class="nav nav-tabs">
      	<?php foreach($allCharts as $k=>$r){ ?>
	    	<li <?php if($k==0){ echo 'class="active"';}?>><a data-toggle="tab" href="#tab_<?php echo $r;?>"><?php echo ucfirst($r);?></a></li>
	    <?php }  ?>
	    </ul>
      </div>
    </div>	


    	<div class="tab-content">
      	<?php if(!empty($allCharts)){foreach($allCharts as $k=>$r){ ?>
		    <div class="tab-pane fade <?php if($k==0){ echo 'in active';}?>" id="tab_<?php echo $r;?>"> 
          <div class="row">
<div class="col-sm-8">
          <div id="<?php echo $r;?>_chart" style="width: 1000; height: 400;"></div>	
</div>
        <div class="col-sm-4 text-right">
        <?php if(!empty($chartDayFormat)){foreach($chartDayFormat as $r){ ?>
        <a href="javascript://" onclick="get_report_data_according_date('<?php echo $r;?>');"><?php echo ucfirst($r);?></a>
        <?php } } ?>
      </div>
      </div>

      </div>
		 <?php } } ?>    
     	</div>
  	
	   							
    <?php } ?>
                                                                    
</section>
  <section class="panel">

<div class="panel-body" id="reportsData" style="display:none;" >
  <?php  include_once(include_admin_template('customTemplates','reportTable'));?>     
  </div>

  </section>
  </div>
			<!-- //content-->
		</div>


<div class="modal fade" id="fileterModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Select Fields</h4>
      </div>
      
      <div class="modal-body" id="allcheckbox">
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary" onclick="get_data_by_fields()">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


        
        
                 <?php echo success_fail_message_popup();?>
        
        
                 <?php echo delete_confirmation_popup();?> 
                 
                    
