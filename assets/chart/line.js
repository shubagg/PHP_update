
function drawChartLine(divID,chartData,type) 
{     
        //alert(chartData);
        if(type=='false')
		{
			 var dataJson = window[chartData];
			 
			 
		}else
		{
			
			var dataJson = chartData;
			 
		}
       
        var data = new google.visualization.arrayToDataTable(dataJson);
        var chart = new google.visualization.LineChart(document.getElementById(divID));
        
		  chart.draw(data,{width:'100%',legend:'bottom'});

}




