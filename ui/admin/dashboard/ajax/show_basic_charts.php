<?php
$noclose=true;
include_once '../../../../global.php';
$mid=$_POST['mid'];
$smid=$_POST['smid'];
$basic_chart_data = curl_post("/get_basic_widget",array('mid' => $mid,'smid' => $smid));
 $basic_chart_data= $basic_chart_data['data'];

   $html='';
   $img_path=$admin_assets_url.'img/chart/';
foreach ($basic_chart_data as $key) {
	$ChartType=$key['chart_type'];
	$ChartID=$key['id'];
	$haxis='';
	$vaxis='';
	$c_div='widget_div_1';
	$widget_config = $key['c_config'];
//print_r($basic_chart_data['data']);
	
	$html .= '<div id="basic_charts11" class="modal-descrbe " style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-2 col-sm-3 col-xs-12">
						 <img src="'.$img_path.$key['chart_Img'].'">
						 </div>
						 <div class="col-md-7 col-sm-6 col-xs-12"><h4>\''.$key['chart_name'].'\'</h4><p>\''.$key['chart_desc'].'\'</p> </div>
						 
							<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_widget(\''.$ChartID.'\',\''.$ChartType.'\',\''.$key['chart_name'].'\',\''.$key['chart_Img'].'\',\''.$key['chart_url'].'\',\''.$key['prefix'].'\' ,\''.$widget_config.'\')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">';
								$html .= $ui_string['add_widget'];
								$html .= '</button>
							</a></div>						 
						 </div>
						 <div class="clr"></div>
						</div>';

 }
 echo $html;