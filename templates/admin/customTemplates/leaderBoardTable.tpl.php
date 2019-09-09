<?php

if(isset($_REQUEST['action']) && $_REQUEST['action']=='get_retData')
{
	 include_once("../../../global.php");
	 $mid=$_POST['mid'];
     $smid=$_POST['smid'];
     $report_id=$_POST['report_id'];
 
}
else
{
	$mid= "2";
	$smid= "1";
	$report_id = "11";
}

$report_list=get_report_list(array('status'=>'2'));

$reportName = get_report_name(array("mid"=>$mid,"smid"=>$smid,"report_id"=>$report_id));
$reportName = $reportName['data'];

$getdata = get_report_uidata_by_mid(array("mid"=>$mid,"smid"=>$smid,'report_id'=>$report_id));

$searchfields = json_encode($getdata['data'][0]['setting']['searchFields']);


?>
			
<section class="panel" style=" margin-bottom:10px;">
    <header class="panel-heading">
	<h3><strong><span style="color:black;">Report</span> - <?php echo $reportName ;?></strong> </h3>
    </header>
</section>

<section class="panel" id="leader-sec">
    <div class="row">
      <div class="col-sm-12">
        <ul class="nav nav-tabs">
        	<?php foreach($report_list['data']['2_1'] as $reports){?>
                                    
	        <li><a data-toggle="tab" onclick="get_tab_data('<?php echo $reports['report_id'];?>');"><?php echo $reports['report_name'];?></a></li>
	        <?php } ?>
       </ul>
       </div>
    	<div class="tab-content col-sm-12" >
	      <div class="tab-pane fade in active" id="tab_<?php echo $report_id;?>">
		      <form id="leaderBoardForm" class="form-horizontal" method="post" action="" enctype="multipart/form-data" style="margin-top:0px;">
		      	    <input type="hidden" value="<?php echo $mid;?>" id="mid" name="mid" />	
					<input type="hidden" value="<?php echo $smid;?>" id="smid" name="smid" />
					<input type="hidden" value="<?php echo $report_id;?>" id="report_id" name="report_id" />
					<input type="hidden" value="<?php echo $_SESSION['user']['user_id'];?>" id="userId" name="userId" />
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="formElement">	
					
				</div>	
		      </form>
		  </div>
      </div>

    </div>		                                                                  
</section>

<script>

var mid='<?php echo $mid;?>';
var smid='<?php echo $smid;?>';
var report_id='<?php echo $report_id;?>';
var searchFieldJson = '<?php echo $searchfields; ?>';
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var admin_template_path_site='<?php echo admin_template_path_site();?>';

</script>

<script type="text/javascript" src="<?php echo admin_ui_url(); ?>report/js/manage_report.js"></script>

<script type="text/javascript" src="<?php echo admin_ui_url(); ?>report/js/leader_board.js"></script>

