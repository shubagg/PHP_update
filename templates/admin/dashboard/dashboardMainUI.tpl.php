<?php
$dash=$_SESSION['user']['permission']['dashboard']['dashboard'];
$basic_chart_data1 = curl_post("/get_basic_widget",array('mid' => '28','smid' => '1'));
 $basic_chart_data1= $basic_chart_data1['data'];

   $html='';
   $img_path=$admin_assets_url.'img/chart/';
	$ChartType1=$basic_chart_data1[0]['chart_type'];
	$ChartID1=$basic_chart_data1[0]['id'];
	$haxis='';
	$vaxis='';
	$c_div='widget_div_1';
	$widget_config1 = $basic_chart_data1[0]['c_config'];				
	
if (in_array("ticketing_charts", $dash) && in_array("all", $dash))
  {
  	$mid=5;
  	$smid=2;
  }
  else if(in_array("product_charts", $dash) && in_array("all", $dash))
  {
  	$mid=16;
  	$smid=1;
  }
  else if(in_array("aintu_charts", $dash) && in_array("all", $dash))
  {
  	$mid=5;
  	$smid=3;
  }
  else if(in_array("course_charts", $dash) && in_array("all", $dash))
  {
  	$mid=2;
  	$smid=1;
  }
  else if(in_array("job_charts", $dash) && in_array("all", $dash))
  {
  	$mid=5;
  	$smid=1;
  }
  else if(in_array("resource_charts", $dash) && in_array("all", $dash))
  {
  	$mid=1;
  	$smid=1;
  }
  else if(in_array("slm_charts", $dash) && in_array("all", $dash))
  {
  	$mid=37;
  	$smid=1;
  }
  else if(in_array("rpa_charts", $dash) && in_array("all", $dash))
  {
  	$mid=50;
  	$smid=1;
  }
  else
  {
  	$mid=0;
  	$smid=0;
  }

$new1 = '<div id="main" class="dashboard">'; 
echo $new1;
get_breadcrumb();
 $new = '<script> function checkalldata(){} </script> 			
			<div id="content">
				<div class="row">';

	$dashboards=getUserDashboards(array('user_id' => $_SESSION['user']['user_id'],'dash_type' =>'0'));
	$li_id=1;
	$initstr = '';
	$dashboardinitarr = array();
	if(is_array($dashboards))
	{
	foreach ($dashboards as $index => $key) 
	{
			
			initDashboards($key['id'],array('user_id' => $_SESSION['user']['user_id']),$dashboardinitarr);
	}
}
	foreach($dashboardinitarr as $key => $initjson)
	{
		$new = $new.$initjson;
	}
 
echo $new;
get_breadcrumb();

$maindata = '';
if(check_user_permission("dashboard","dashboard","view")==1 || check_user_permission("dashboard","dashboard","all")==1){
$maindata .= '<div>
	     <div class="but_list">';
	     
	      $maindata .= '<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">';
			if(is_array($dashboards))
				
			{
			 foreach ($dashboards as $key) 
			 { 
			 	
				if ($li_id==1) 
				{
					$maindata .= '<li id="'.$key['id'].'" role="presentation" class= "Dashboard active" ><a href="#abc_'. $li_id.'" id='.$key['id'].' role="tab" data-toggle="tab" aria-controls="abc_'. $li_id.'" aria-expanded="true"  class="clickbutton" onclick="redraw_chart(\''.$key['id'].'\')">'. ucwords($key['dash_name']) .'</a></li>';

				}else{
					$maindata .= '<li id="'. $key['id'].'" class="Dashboard" role="presentation"><a href="#abc_'.$li_id.'" id='. $key['id'].' role="tab" data-toggle="tab" aria-controls="abc_'. $li_id.'" aria-expanded="true" class="clickbutton" onclick="redraw_chart(\''.$key['id'].'\')">'. ucwords($key['dash_name']) .'</a></li>';

				} 
				$li_id++;

			 } 
			}
			  
			 $maindata .= '</ul>';
			 $maindata .= '<div id="myTabContent" class="tab-content">';
				
				$li_id=1;
				$div = 1;
				$initDash = '';
				if(empty($dashboards))
	{
				$companyData=get_company_data();  
				$company_name=ucfirst($companyData['cname']); 
				$maindata .='<div class="row">
               
                     <div class="col-md-12 margn_tp_7 text-center margn-tp-20">

                         
                                 <h3>';
                                 $maindata .= $ui_string['wlcm_to'];
                                 $maindata .= $company_name;
                                 $maindata .='</h3>
                                 <h4 class="margn-tp-10">';
                                 $maindata .=$ui_string['no_dashboard'];
                                 $maindata .='</h4>
                         
                         		</div>
                
                     		</div>
                    ';
    }
				foreach ($dashboards as $index => $key) 
				{ $data1=curl_post($webservice_url."/get_widget_detail",array("dash_id"=>$key['id']));
			  $dash_manage=explode(',',$key['DashManage']);
			  if($key['user_id']==$_SESSION['user']['user_id'])
			  {
			  	$dashper=1;
			  }
			  else if(isset($dash_manage[1]) && $dash_manage[1]==0 || $dash_manage[0]==0)
			  {
			  	$dashper=1;
			  }
			  else
			  {
			  	$dashper=0;
			  }
					if($data1['success']=='true')
					{
						$count=1;
					}
					else
					{
						$count=0;
					}
					$html = initDashboards_bak($key,array('user_id' =>  $_SESSION['user']['user_id']),$div);
					$div = $div+1;
					$classActive = $li_id==1?"in active":"";
					$maindata .= '<div role="tabpanel" class="tab-pane fade'. $classActive.'" id="abc_'.  $li_id.'" aria-labelledby="'. $key['id'].'">						
						<header class="panel-heading pading-lft-right-0">
							<div class="row">					
								<div class="col-md-4 margn_tp_7">					
									<h3><strong></strong>'; 
									$maindata .=$ui_string['dashboard'];
									$maindata .= '</h3>
								</div>
								 ';
								 if(check_user_permission("dashboard","dashboard","add")==1 || check_user_permission("dashboard","dashboard","all")==1){
								$maindata .='<div class="col-md-4 pull-right text-right">
							<a onclick="refresh();">
									<div class="display_block">
										<div class=" btn btn-theme-inverse btn_cu ">
											<span>';
											$maindata .=$ui_string['refresh'];
											$maindata .='</span>
										</div>
									</div>
								</a>';
											if($dashper==1)
											{
								$maindata .='<a onclick="addgadget('.$mid.','.$smid.');">
									<div class="display_block">
										<div class=" btn btn-theme-inverse btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
											<span>';
											$maindata .=$ui_string['add_gadget'];
											$maindata .='</span>
										</div>
									</div>
								</a>';
							}
							if(check_user_permission("dashboard","dashboard","all")==1  || check_user_permission("dashboard","dashboard","report_charts")==1){ 
								$maindata .='<div class=" btn btn-theme-inverse btn_cu ">
<span  onclick="open_add_widget(\''.$ChartID1.'\',\''.$ChartType1.'\',\''.$basic_chart_data1[0]['chart_name'].'\',\''.$basic_chart_data1[0]['chart_Img'].'\',\''.$basic_chart_data1[0]['chart_url'].'\',\''.$basic_chart_data1[0]['prefix'].'\' ,\''.$widget_config1.'\')">Report</span>
											</div>';
										} 

								$maindata .='</div>';
								}
							$maindata .='</div>
						</header>';

						if($count==1)
						{

						$maindata .='<div class="panel-body panel_bg_d pading-lft-right-0">
							<div class="" id="newDiv">
							
							'. $html.'

							</div>

						</div>
						
					
					';
				}
				else{
				$companyData=get_company_data();  
				$company_name=ucfirst($companyData['cname']); 
				$maindata .='<div class="row">
               
                     <div class="col-md-12 margn_tp_7 text-center margn-tp-20">

                         
                                 <h3>';
                                 $maindata .= $ui_string['wlcm_to'];
                                 $maindata .= $company_name;
                                 $maindata .='</h3>
                                 <h4 class="margn-tp-10">';
                                 $maindata .=$ui_string['no_gadget'];
                                 $maindata .='</h4>
                         
                         		</div>
                
                     		</div>
                    ';
					}

				$maindata .='</div>';
					$li_id=$li_id+1;
				} 
				$maindata .= '</div>

		
</div>';
echo $maindata;
}
else
{
 	$companyData=get_company_data();  
	$company_name=ucfirst($companyData['cname']); 
	$maindata .='<div class="row">
                    
                    <div class="col-md-12 margn_tp_7 text-center margn-tp-20">
                        
                                <h3>';
                                $maindata .= $ui_string['wlcm_to'];
                                $maindata .= $company_name;
                                $maindata .='</h3>   
                    </div>
                                    
                 </div>';
	echo $maindata;
}

   ?>            
<div id="categories" class="modal fade" role="dialog" data-width="900" data-backdrop="static" data-keyboard="false">
 

      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			<i class="fa fa-times"></i>
		</button>
		<h4 class="modal-title"><?php echo $ui_string['add_gadget'];?></h4>
	</div>
     <div class="modal-body">
		<div class="modal-scroll">
			<div class="row">
				<div class="col-md-12">
				<?php 
				if($mid==0)
					{?>

					<div class="row">
                    
                    <div class="col-md-12 margn_tp_7 text-center margn-tp-20">
                        
                                <h3><?php echo $ui_string['no_widget'];?></h3>
                                
                        </div>
                                    <div class="col-md-8">
                 
                        </div>

                                    
                    </div>
				<?php } else {?>
					<div class="modal-title"><strong><?php echo $ui_string['modules'];?></strong></div>
				</div>
			</div>
			<div class="row margn-tp-20">
				<div class="col-md-3 gadget-border">
					<div class="">
						<ul class="dashboard_graph_tab">


				
					<?php
					if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","product_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(16,1)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['16-1'])){ echo $chart_count['16-1']; } else { echo "0";} ?></span><?php echo $ui_string['product'];?></li></a>
 							<?php } ?>
 							<?php if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","ticketing_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(5,2)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['5-2'])){ echo $chart_count['5-2']; } else { echo "0";}?></span><?php echo $ui_string['ticket_tool'];?></li></a>
 							<?php } ?>
 							<?php if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","attendance_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(22,1)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['22-1'])){ echo $chart_count['22-1']; } else { echo "0";}?></span><?php echo $ui_string['attendance'];?></li></a>
 							<?php } ?>
 							<?php if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","job_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(5,1)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['5-1'])){ echo $chart_count['5-1']; } else { echo "0";}?></span><?php echo $ui_string['job'];?></li></a>
 							<?php } ?>
 							<?php if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","slm_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(37,1)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['37-1'])){ echo $chart_count['37-1']; } else { echo "0";}?></span><?php echo $ui_string['s_sla'];?></li></a>
 							<?php } ?>
 							<?php if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","course_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(2,1)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['2-1'])){ echo $chart_count['2-1']; } else { echo "0";}?></span><?php echo $ui_string['course'];?></li></a>
 							<?php }  if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","resource_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(1,1)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['2-1'])){ echo $chart_count['1-1']; } else { echo "0";}?></span><?php echo $ui_string['resource'];?></li></a>
 							<?php } if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","aintu_charts")==1){ ?>
 								<a href="javascript:;" onclick="show_basic_charts(5,3)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['5-3'])){ echo $chart_count['5-3']; } else { echo "0";}?></span><?php echo $ui_string['aintu'];?></li></a> 
 							
 							<?php } ?>
					
 							<?php
								if(check_user_permission("dashboard","dashboard","all")==1  && check_user_permission("dashboard","dashboard","rpa_charts")==1){ ?>
 							<a href="javascript:;" onclick="show_basic_charts(50,1)" ><li class=" "><span class="aui-badge"><?php if (isset ($chart_count['50-1'])){ echo $chart_count['50-1']; } else { echo "0";} ?></span><?php echo $ui_string['rpa'];?></li></a>
 							<?php } ?>
 							

 							
						</ul>
					</div>
				</div>
				
			<div id="basic_charts111" class=" col-md-9 gadget-border-1">
			</div>
			<?php } ?>
			
			</div>
		</div>
		
	</div>
     
   

</div>


<div id="report" class="modal fade" role="dialog" data-width="900" data-backdrop="static" data-keyboard="false">
 

      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			<i class="fa fa-times"></i>
		</button>
		<h4 class="modal-title"><?php echo "Report";?></h4>
	</div>
     <div class="modal-body">
		<div class="modal-scroll">
			<div class="row">
				<div class="col-md-12">
			<!-- 	<?php 
				if($mid==0)
					{?>

					<div class="row">
                    
                    <div class="col-md-12 margn_tp_7 text-center margn-tp-20">
                        
                                <h3><?php echo $ui_string['no_widget'];?></h3>
                                
                        </div>
                                    <div class="col-md-8">
                 
                        </div>

                                    
                    </div>
				<?php } else {?> -->
					<div class="modal-title"><strong><?php echo "Report";?></strong></div>
				</div>
			</div>
			<div class="row margn-tp-20">
				
			<div id="basic_report111" class=" col-md-9 gadget-border-1">
			</div>
			<!-- <?php } ?> -->
			
			</div>
		</div>
		
	</div>
     
   

</div>
        




</div>
	<!-- //main-->
<div id="add_category" class="modal fade  add-gadget-modal" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" data-width="900">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
		<h4 class="modal-title"><span><?php echo $ui_string['add_gadget'];?></span></h4>
	</div>
	<!-- //modal-header-->
	<div class="modal-body ">
		
			
			<div id="configur_header" class="col-md-12  col-sm-12 col-xs-12 text-center gadget-imgfull">
				<div class="col-md-12 col-sm-12 col-xs-12">
				<h4><span id="config_title" ></span></h4><p><span id="config_desc"></span></p> 
				</div>
				<img id="Chart_Image"  src="">
			</div>
			 <!-- <iframe id="ifrm" src="" width="100%" height="250"></iframe>  -->
			<div id="ifrm">
				<form class="form-horizontal labelcustomize" data-collabel="4" data-label="color" id="addChart" name="chartCreation">
					<input type="hidden" id="hdn_dash_id" name="dash_id" value="">
					<input type="hidden" id="hdn_chart_id" name="chart_id" value="">
					<input type="hidden" id="hdn_chart_type" name="chart_type" value="">
					<input type="hidden" id="hdn_chart_name" name="chart_name" value="">
					<input type="hidden" id="hdn_chart_img" name="chart_img" value="">
					<input type="hidden" id="hdn_chart_url" name="chart_url" value="">
					<input type="hidden" id="hdn_prefix" name="prefix" value="">
					<input type="hidden" id="hdn_request_type" name="request_type" value="">
					<input type="hidden" id="hdn_widget_id" name="widget_id" value="">

					<div class="col-md-12 col-sm-12 col-xs-12" id="custom_config_file"></div>
					
						<div class="col-md-12">    
							<a  class="right tooltip-area">
							<button type="button" class="btn btn-theme-inverse btn_cu pull-right" id="add_chart" onclick="return validation('addChart');"><?php echo $ui_string['submit'];?></button>
							</a>
						</div>
					
				</form>
    		</div>
	</div>
</div>

     
 
	</div>
	<?php echo delete_confirmation_popup(); ?>
	
	