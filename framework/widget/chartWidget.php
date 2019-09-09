<?php
require_once($server_path.'framework/widget/'.'baseWidget.php');

function getChartInitWidgetMarkup(&$returnValue)
{
	getWidgetJson($returnValue);
	
	$returnValue["chartWidget"] = "
	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
	<script>	
	google.charts.load('current', {'packages':['corechart','table']});
	google.charts.setOnLoadCallback(drawChart);
	//console.log('On load');
	var arr = [];
	var asyncChart = [];
	var cachedData=[];
	var widgetInterval=[];
	function drawChart()
	{		
		for(var i=0;i<arr.length ;i++)
		{
			var funName = arr[i][0];
			var divID = arr[i][1];			
			var dataParam = arr[i][2];	
			//alert(window[dataParam]);				
			window[funName](divID,dataParam,'false');
		}	
		//console.log(asyncChart);
		for(var key in asyncChart) 
		{	
			var ajaxUrl = asyncChart[key]['ajaxUrl'];
			var widgetId = asyncChart[key]['widgetId'];
			if(widgetId !=undefined)
			{
			var widgetJSON = asyncChart[key]['widgetJSON'];
			var data=widgetJSON.config_Json;
			var newdata=JSON.parse(data);
			var refresh=newdata['refresh_interval'];
			var myJSON = JSON.stringify(widgetJSON);
			AsyncFunc(ajaxUrl,widgetId,widgetJSON,refresh);	
			}			
		}		
	}
	function drawChartWidget(arr)
	{	
		for(var key in asyncChart) 
		{	
			var ajaxUrl = asyncChart[key]['ajaxUrl'];
			var widgetId = asyncChart[key]['widgetId'];
			if(widgetId!=undefined)
			{
			//console.log(['DT',widgetId,$.inArray(widgetId,arr)]);
			if($.inArray(widgetId,arr)!==-1){
				var widgetJSON = asyncChart[key]['widgetJSON'];
				var data=widgetJSON.config_Json;
				var newdata=JSON.parse(data);
				var refresh=newdata['refresh_interval'];
				var myJSON = JSON.stringify(widgetJSON);
				//runAsyncjs(ajaxUrl,widgetId,widgetJSON);
				if(cachedData[widgetId]!=undefined)	
					callfunction(widgetId,cachedData[widgetId]);
				else
					AsyncFunc(ajaxUrl,widgetId,widgetJSON,refresh);
			}
		}
		}		
	}	
	function AsyncFunc(ajaxUrl,widgetId,widgetJSON,refreshInter)
	{
		//console.log(['WIDGET',widgetInterval[widgetId]]);
		runAsyncjs(ajaxUrl,widgetId,widgetJSON);
		if(refreshInter!= undefined && refreshInter != 0 && !isNaN(refreshInter))
		{
			if(widgetInterval[widgetId]!=undefined){
				clearInterval(widgetInterval[widgetId]);
			}
			widgetInterval[widgetId] =setInterval(function() { runAsyncjs(ajaxUrl,widgetId,widgetJSON); },refreshInter*60*1000);
		}
		else
		{
			widgetInterval[widgetId] =0;
		}
	}
	
	function runAsyncjs(ajaxUrl,widgetId,widgetJSON)
	{
		$('#'+widgetId).hide();
		$('#cl'+widgetId).show();
		$.ajax({
			url: admin_ui_url+ajaxUrl,
			type:'POST',
			async: true,
			dataType: 'json',
			data: 'widgetId='+widgetId,
			success:function(res){
				//console.log(res);
				$('#'+widgetId).show();
				$('#cl'+widgetId).hide();
				cachedData[widgetId]=res;
				callfunction(widgetId,res);				

           }
          });		
	}
	
	function callfunction(widgetId,widgetData)
	{
		var funName = asyncChart[widgetId]['function'];
		window[funName](widgetId,widgetData,'true');
	}	
</script>";
}

?>
