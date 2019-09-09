<?php 
//include('dashboardDataProvider.php');

include($server_path.'framework/widget/widgetEngine.php');

function getUserDashboards($data)
{

	if (isset($cacheData)) {
		$dashboards=$cacheData;
	}
	else
	{
		$div_id=1;
		$li_id=1; 
		$dashboards = curl_post("/get_dashboard",array('user_id' => $data['user_id'],'dash_type' => $data['dash_type']));
		$dashboards = $dashboards['data'];
	}
	return $dashboards;

	//getDashboardsData();            //dashboardDataProvider.php
}

function initDashboards($dashboard, $user, &$initArr)
{    

		$widgets = getTheWidgetList($dashboard);
	foreach ($widgets as $key) 
	{	
		 
		getwidgetinitMarkup($key,$initArr);

		/* foreach($initArr as $initjson)
		{
			echo $initjson;
			echo "<br>";
		}*/
		
		
	}
	
			//return $initArr;

}

function tpl_50_50($widgets)
{
	
	$html ='';
	$count = 1;
	foreach ($widgets as $key) 
	{
		$projectid=json_decode($key['config_Json'],true);
		if (isset($projectid['projectId']) && ($projectid['projectId']=='')) 
		{ 		
			$projectName='All'; 		
		} 		
		else if(isset($projectid['projectId']))		
		{ 		$data=get_project_by_id(array('id'=>$projectid['projectId'])); 		
	            $projectName=$data['data'][0]['name']; 		
	    }

	    else if (isset($projectid['formid']) && ($projectid['formid']=='')) 
		{ 		
			$projectName='All'; 		
		} 		
		else if(isset($projectid['formid']))	
		{ 		
	        $data=get_form_by_id(array('id'=>$projectid['formid'],'fields'=>'title'));
			$projectName=$data['data'][0]['title'];	
	    }
	    else if(isset($projectid['query']))	
		{ 		
	        $data = curl_post('/get_saved_queries',array("id"=>$projectid['query']));
			$projectName=$data['data'][0]['name'];	
	    }
	    else
	    {
	    	$projectName='';
	    }
		$widget_data = initWidgetMarkup($key);
		$widgetId = $key['id'];
		$dash_id = $key['dash_id'];
		$widget_config = $key['c_config'];
		$chart_id = $key['chart_id'];
		if($count==1)
		{
			$html .= "<div class='row'>";
		}
		if(isset($projectid['day']) && $projectid['day']=='yesterday')
		{
			$heading='Previous Day Attendence';
		}
		else if(isset($projectid['day']) && $projectid['day']=='today')
		{
			$heading='Present Day Attendence';
		}
		else if(isset($projectid['userId']) && isset($projectid['toVersus']))
		{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			$assign=$data['data'][0]['name'];
				if($projectid['toVersus']=='all'){
                    $status='All Status';
                }
                else if($projectid['status']==4){
                    $status='New';
                }else if($projectid['toVersus']==0){
                    $status='Pending';
                }else if($projectid['toVersus']==1){
                    $status='Approved';
                }else if($projectid['toVersus']==5){
                    $status='Done';
                }else if($projectid['toVersus']==2){
                    $status='Rejected';
                }
                $heading=$assign.' v/s '.$status;
		}
		else if(isset($projectid['category']) && isset($projectid['priority']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['category']==1){
            $category='S & M';
            }else if($projectid['category']==2){
            $category='New Installation';
            }else if($projectid['category']==3){
            $category='Modernization';
            }
            if($projectid['priority']=='all')
			{
			$priority="All Priority";
			}
			else if($projectid['priority']==1){
            $priority='Low Priority';
            }else if($projectid['priority']==2){
            $priority='Medium';
            }else if($projectid['priority']==3){
            $priority='High Priority';
            }
            else if($projectid['priority']==4){
            $priority='Urgent Priority';
            }
            $heading=$category.' v/s '.$priority;
			
		}
		else if(isset($projectid['userId']) && isset($projectid['fromDate']) )
		{
			if($projectid['userId']=='all')
			{
			$heading="All Users Attendance";
			}
			else
			{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			$heading=$data['data'][0]['name']." Attendance";
			}
		}
		else if(isset($projectid['userId']))
		{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));

			$heading="Assigned to ".$data['data'][0]['name'];
		}

		else if(isset($projectid['category']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['category']=='all')
			{
			$heading="Based On All Category";
			}
			else if($projectid['category']==1){
            $heading='Based On S & M Category';
            }else if($projectid['category']==2){
            $heading='Based On New Installation Category';
            }else if($projectid['category']==3){
            $heading='Based On Modernization Category';
            }
			
		}
			else if(isset($projectid['status']))
                {
               	if($projectid['status']=='all'){
                    $heading='Based On All Status';
                }
                else if($projectid['status']==4){
                    $heading='Based On New Status';
                }else if($projectid['status']==0){
                    $heading='Based On Pending Status';
                }else if($projectid['status']==1){
                    $heading='Based On Approved Status';
                }else if($projectid['status']==5){
                    $heading='Based On Done Status';
                }else if($projectid['status']==2){
                    $heading='Based On Rejected Status';
                }
            }
            else if(isset($projectid['toVersus']))
                {
               	if($projectid['toVersus']=='all'){
                    $heading='Created v/s All Status';
                }
                else if($projectid['toVersus']==4){
                    $heading='Created v/s New Status';
                }else if($projectid['toVersus']==0){
                    $heading='Created v/s Pending Status';
                }else if($projectid['toVersus']==1){
                    $heading='Created v/s Approved Status';
                }else if($projectid['toVersus']==5){
                    $heading='Created v/s Done Status';
                }else if($projectid['toVersus']==2){
                    $heading='Created v/s Rejected Status';
                }
            }
		else if(isset($projectid['priority']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['priority']=='all')
			{
			$heading="Based On All Priority";
			}
			else if($projectid['priority']==1){
            $heading='Based On Low Priority';
            }else if($projectid['priority']==2){
            $heading='Based On Medium';
            }else if($projectid['priority']==3){
            $heading='Based On High Priority';
            }
            else if($projectid['priority']==4){
            $heading='Based On Urgent Priority';
            }
			
		}
		else
		{
		$heading = $key['chart_name'];
		}
		$min = 5;
		$html .= "<div class='col-md-6 col-sm-6 col-xs-12'><div style='border: 1px solid #e8edf2; box-shadow: 0px 0px 5px #afafaf;  overflow: hidden;'><div style='height:50px;border-bottom: 2px solid #d9dfe3; padding: 15px 20px 0px 20px;font-size: 14px;'><div class='row'><div class='col-xs-3'><div class='chart-projectname'>".$projectName."</div></div><div class='col-xs-6 text-right'><span>".$heading."</span></div><div class='col-xs-3'><a onclick='deleteWidget(\"".$widgetId."\")' class='right tooltip-area' title='Delete'><span class='pull-right cursor_pointer' style='margin-left:10px;'><i class='fa fa-trash-o' aria-hidden='true'></i></span></a><a onclick='editWidget(\"".$dash_id."\",\"".$widgetId."\",\"".$chart_id."\")' class='right tooltip-area'><span class='pull-right cursor_pointer' title='Edit'> <i class='fa fa-pencil' aria-hidden='true'></i></span></a></div></div></div> <div class='auto_refresh' id='".$widgetId."' data-interval='".$min."' >".$widget_data."</div><div class='col-xs-12 text-center' id='cl".$widgetId."'><img src=".admin_ui_url()."dashboard/img/giphy.gif></div></div></div>";  

		if($count==2)
		{
			$html .= "</div><br><br>";
			$count = 0;
		}
		$count++;
		
	}
		if(count($widgets) % 2 == 1)
		{			
			$html .= "</div><br><br>";
		}
	return $html;
}
function tpl_100($widgets)
{
	$html ='';
	foreach ($widgets as $key) 
	{
		$projectid=json_decode($key['config_Json'],true);
		if (isset($projectid['projectId']) && ($projectid['projectId']=='')) 
		{ 		
			$projectName='All'; 		
		} 		
		else if(isset($projectid['projectId']))		
		{ 		$data=get_project_by_id(array('id'=>$projectid['projectId'])); 		
	            $projectName=$data['data'][0]['name']; 		
	    }

	    else if (isset($projectid['formid']) && ($projectid['formid']=='')) 
		{ 		
			$projectName='All'; 		
		} 		
		else if(isset($projectid['formid']))	
		{ 		
	        $data=get_form_by_id(array('id'=>$projectid['formid'],'fields'=>'title'));
			$projectName=$data['data'][0]['title'];	
	    }
	    else if(isset($projectid['query']))	
		{ 		
	        $data = curl_post('/get_saved_queries',array("id"=>$projectid['query']));
			$projectName=$data['data'][0]['name'];	
	    }
	    else
	    {
	    	$projectName='';
	    }
		$widget_data = initWidgetMarkup($key);
		$widgetId = $key['id'];
		$dash_id = $key['dash_id'];
		$widget_config = $key['c_config'];
		$chart_id = $key['chart_id'];
		if($count==1)
		{
			$html .= "<div class='row'>";
		}
		if(isset($projectid['day']) && $projectid['day']=='yesterday')
		{
			$heading='Previous Day Attendence';
		}
		else if(isset($projectid['day']) && $projectid['day']=='today')
		{
			$heading='Present Day Attendence';
		}
		else if(isset($projectid['userId']) && isset($projectid['toVersus']))
		{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			$assign=$data['data'][0]['name'];
				if($projectid['toVersus']=='all'){
                    $status='All Status';
                }
                else if($projectid['status']==4){
                    $status='New';
                }else if($projectid['toVersus']==0){
                    $status='Pending';
                }else if($projectid['toVersus']==1){
                    $status='Approved';
                }else if($projectid['toVersus']==5){
                    $status='Done';
                }else if($projectid['toVersus']==2){
                    $status='Rejected';
                }
                $heading=$assign.' v/s '.$status;
		}
		else if(isset($projectid['category']) && isset($projectid['priority']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['category']==1){
            $category='S & M';
            }else if($projectid['category']==2){
            $category='New Installation';
            }else if($projectid['category']==3){
            $category='Modernization';
            }
            if($projectid['priority']=='all')
			{
			$priority="All Priority";
			}
			else if($projectid['priority']==1){
            $priority='Low Priority';
            }else if($projectid['priority']==2){
            $priority='Medium';
            }else if($projectid['priority']==3){
            $priority='High Priority';
            }
            else if($projectid['priority']==4){
            $priority='Urgent Priority';
            }
            $heading=$category.' v/s '.$priority;
			
		}
		else if(isset($projectid['userId']) && isset($projectid['fromDate']) )
		{
			if($projectid['userId']=='all')
			{
			$heading="All Users Attendance";
			}
			else
			{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			$heading=$data['data'][0]['name']." Attendance";
			}
		}
		else if(isset($projectid['userId']))
		{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));

			$heading="Assigned to ".$data['data'][0]['name'];
		}

		else if(isset($projectid['category']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['category']=='all')
			{
			$heading="Based On All Category";
			}
			else if($projectid['category']==1){
            $heading='Based On S & M Category';
            }else if($projectid['category']==2){
            $heading='Based On New Installation Category';
            }else if($projectid['category']==3){
            $heading='Based On Modernization Category';
            }
			
		}
			else if(isset($projectid['status']))
                {
               	if($projectid['status']=='all'){
                    $heading='Based On All Status';
                }
                else if($projectid['status']==4){
                    $heading='Based On New Status';
                }else if($projectid['status']==0){
                    $heading='Based On Pending Status';
                }else if($projectid['status']==1){
                    $heading='Based On Approved Status';
                }else if($projectid['status']==5){
                    $heading='Based On Done Status';
                }else if($projectid['status']==2){
                    $heading='Based On Rejected Status';
                }
            }
            else if(isset($projectid['toVersus']))
                {
               	if($projectid['toVersus']=='all'){
                    $heading='Created v/s All Status';
                }
                else if($projectid['toVersus']==4){
                    $heading='Created v/s New Status';
                }else if($projectid['toVersus']==0){
                    $heading='Created v/s Pending Status';
                }else if($projectid['toVersus']==1){
                    $heading='Created v/s Approved Status';
                }else if($projectid['toVersus']==5){
                    $heading='Created v/s Done Status';
                }else if($projectid['toVersus']==2){
                    $heading='Created v/s Rejected Status';
                }
            }
		else if(isset($projectid['priority']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['priority']=='all')
			{
			$heading="Based On All Priority";
			}
			else if($projectid['priority']==1){
            $heading='Based On Low Priority';
            }else if($projectid['priority']==2){
            $heading='Based On Medium';
            }else if($projectid['priority']==3){
            $heading='Based On High Priority';
            }
            else if($projectid['priority']==4){
            $heading='Based On Urgent Priority';
            }
			
		}
		else
		{
		$heading = $key['chart_name'];
		}
		$min = 5;
		$html .= "<div class='row'>";
	//	$html .= "<div id='".$widgetId."' class='col-md-12 col-sm-12 col-xs-12 drag-box-full'>".$widget_data."</div>"; 
		$html .= "<div class='auto_refresh col-md-12 col-sm-12 col-xs-12'><div style='border: 1px solid #e8edf2; box-shadow: 0px 0px 5px #afafaf;  overflow: hidden;'><div style='height:50px; border-bottom: 2px solid #d9dfe3;padding: 15px 20px 0px 20px;font-size: 14px;'><div class='row'><div class='col-xs-3'><div class='chart-projectname'>".$projectName."</div></div><div class='col-xs-6 text-right'><span>".$heading."</span></div><div class='col-xs-3'><a onclick='deleteWidget(\"".$widgetId."\")' class='right tooltip-area' title='Delete'><span class='pull-right cursor_pointer' style='margin-left:10px;'><i class='fa fa-trash-o' aria-hidden='true'></i></span></a><a onclick='editWidget(\"".$dash_id."\",\"".$widgetId."\",\"".$chart_id."\")' class='right tooltip-area'><span class='pull-right cursor_pointer' title='Edit'><i class='fa fa-pencil' aria-hidden='true'></i></span></a></div></div></div> <div   id='".$widgetId."' class='auto_refresh' data-interval='".$min."' >".$widget_data."</div><div class='col-xs-12 text-center' id='cl".$widgetId."'><img src=".admin_ui_url()."dashboard/img/giphy.gif></div></div></div>";

		$html .= "</div><br><br>";
	}		
	return $html;
}
function tpl_75_25($widgets)
{
	
	$html ='';
	$count = 1;
	foreach ($widgets as $key) 
	{
		$projectid=json_decode($key['config_Json'],true);

		if (isset($projectid['projectId']) && ($projectid['projectId']=='')) 
		{ 		
			$projectName='All'; 		
		} 		
		else if(isset($projectid['projectId']))		
		{ 		$data=get_project_by_id(array('id'=>$projectid['projectId'])); 		
	            $projectName=$data['data'][0]['name']; 		
	    }

	    else if (isset($projectid['formid']) && ($projectid['formid']=='')) 
		{ 		
			$projectName='All'; 		
		} 		
		else if(isset($projectid['formid']))	
		{ 		
	        $data=get_form_by_id(array('id'=>$projectid['formid'],'fields'=>'title'));
			$projectName=$data['data'][0]['title'];	
	    }
	    else if(isset($projectid['query']))	
		{ 		
	        $data = curl_post('/get_saved_queries',array("id"=>$projectid['query']));
			$projectName=$data['data'][0]['name'];	
	    }
	    else
	    {
	    	$projectName='';
	    }
		$widget_data = initWidgetMarkup($key);
		$widgetId = $key['id'];
		$dash_id = $key['dash_id'];
		$chart_id = $key['chart_id'];
		if(isset($projectid['day']) && $projectid['day']=='yesterday')
		{
			$heading='Previous Day Attendence';
		}
		else if(isset($projectid['day']) && $projectid['day']=='today')
		{
			$heading='Present Day Attendence';
		}
		else if(isset($projectid['userId']) && isset($projectid['toVersus']))
		{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			$assign=$data['data'][0]['name'];
				if($projectid['toVersus']=='all'){
                    $status='All Status';
                }
                else if($projectid['status']==4){
                    $status='New';
                }else if($projectid['toVersus']==0){
                    $status='Pending';
                }else if($projectid['toVersus']==1){
                    $status='Approved';
                }else if($projectid['toVersus']==5){
                    $status='Done';
                }else if($projectid['toVersus']==2){
                    $status='Rejected';
                }
                $heading=$assign.' v/s '.$status;
		}
		else if(isset($projectid['category']) && isset($projectid['priority']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['category']==1){
            $category='S & M';
            }else if($projectid['category']==2){
            $category='New Installation';
            }else if($projectid['category']==3){
            $category='Modernization';
            }
            if($projectid['priority']=='all')
			{
			$priority="All Priority";
			}
			else if($projectid['priority']==1){
            $priority='Low Priority';
            }else if($projectid['priority']==2){
            $priority='Medium';
            }else if($projectid['priority']==3){
            $priority='High Priority';
            }
            else if($projectid['priority']==4){
            $priority='Urgent Priority';
            }
            $heading=$category.' v/s '.$priority;
			
		}
		else if(isset($projectid['userId']) && isset($projectid['fromDate']) )
		{
			if($projectid['userId']=='all')
			{
			$heading="All Users Attendance";
			}
			else
			{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			$heading=$data['data'][0]['name']." Attendance";
			}
		}
		else if(isset($projectid['userId']))
		{
			$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));

			$heading="Assigned to ".$data['data'][0]['name'];
		}

		else if(isset($projectid['category']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['category']=='all')
			{
			$heading="Based On All Category";
			}
			else if($projectid['category']==1){
            $heading='Based On S & M Category';
            }else if($projectid['category']==2){
            $heading='Based On New Installation Category';
            }else if($projectid['category']==3){
            $heading='Based On Modernization Category';
            }
			
		}
			else if(isset($projectid['status']))
                {
               	if($projectid['status']=='all'){
                    $heading='Based On All Status';
                }
                else if($projectid['status']==4){
                    $heading='Based On New Status';
                }else if($projectid['status']==0){
                    $heading='Based On Pending Status';
                }else if($projectid['status']==1){
                    $heading='Based On Approved Status';
                }else if($projectid['status']==5){
                    $heading='Based On Done Status';
                }else if($projectid['status']==2){
                    $heading='Based On Rejected Status';
                }
            }
            else if(isset($projectid['toVersus']))
                {
               	if($projectid['toVersus']=='all'){
                    $heading='Created v/s All Status';
                }
                else if($projectid['toVersus']==4){
                    $heading='Created v/s New Status';
                }else if($projectid['toVersus']==0){
                    $heading='Created v/s Pending Status';
                }else if($projectid['toVersus']==1){
                    $heading='Created v/s Approved Status';
                }else if($projectid['toVersus']==5){
                    $heading='Created v/s Done Status';
                }else if($projectid['toVersus']==2){
                    $heading='Created v/s Rejected Status';
                }
            }
		else if(isset($projectid['priority']) )
		{
			//$data = curl_post("/get_resource_by_id",array('id'=>$projectid['userId']));
			if($projectid['priority']=='all')
			{
			$heading="Based On All Priority";
			}
			else if($projectid['priority']==1){
            $heading='Based On Low Priority';
            }else if($projectid['priority']==2){
            $heading='Based On Medium';
            }else if($projectid['priority']==3){
            $heading='Based On High Priority';
            }
            else if($projectid['priority']==4){
            $heading='Based On Urgent Priority';
            }
			
		}
		else
		{
		$heading = $key['chart_name'];
		}
		$min = 5;
		if($count%2==1)
		{
			$html .= "<div class='row'>";
			$class = "col-md-8 col-sm-8 col-xs-12 ";
		}else{
			$class = "col-md-4 col-sm-4 col-xs-12 ";
		}
		$html .= "<div class='auto_refresh ".$class."'><div style='border: 1px solid #e8edf2; box-shadow: 0px 0px 5px #afafaf; overflow: hidden;'><div style='height:50px; border-bottom: 2px solid #d9dfe3;padding: 15px 20px 0px 20px;font-size: 14px;'><div class='row'><div class='col-xs-3'><div class='chart-projectname'>".$projectName."</div></div><div class='col-xs-6 text-right'><span>".$heading."</span></div><div class='col-xs-3'><a onclick='deleteWidget(\"".$widgetId."\")' class='right tooltip-area'title='Delete'><span class='pull-right cursor_pointer' style='margin-left:10px;'><i class='fa fa-trash-o' aria-hidden='true'></i></span></a><a onclick='editWidget(\"".$dash_id."\",\"".$widgetId."\",\"".$chart_id."\")' class='right tooltip-area' title='Edit'><span class='pull-right cursor_pointer'> <i class='fa fa-pencil' aria-hidden='true'></i></span></a></div></div></div> <div  id='".$widgetId."' class='auto_refresh' data-interval='".$min."' >".$widget_data."</div><div class='col-xs-12 text-center' id='cl".$widgetId."'><img src=".admin_ui_url()."dashboard/img/giphy.gif></div></div></div>";  

		//$html .= "<div id='".$widgetId."' class='".$class."'>".$widget_data."</div>"; 

		if($count%2==0)
		{
			$html .= "</div><br><br>";
			$count = 0;
		}
		$count++;
		
	}
		if(count($widgets) % 2 == 1)
		{			
			$html .= "</div><br><br>";
		}
	return $html;
	
	
	
	
}

function initDashboards_bak($dashboard, $user, $div)
{   
		$widgets = getTheWidgetList($dashboard['id']);
		$count = 1;
		
		$tpl_type = $dashboard['template_type'];
		switch ($tpl_type) 
		{
			case "1":
			$html = tpl_50_50($widgets);
			break;
			case "2":
			$html =  tpl_100($widgets);
			break;
			case "3":
			$html = tpl_75_25($widgets);
			break;
		}
		
		return $html;

}



function getTheWidgetList($data)
{

		$widgets = curl_post("/get_widget_detail",array('dash_id' => $data));
		$widgets = $widgets['data'];
		return $widgets;
}


?>