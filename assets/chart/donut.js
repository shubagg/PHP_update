
function drawChartDonut(divID,chartData,type) 
{   

	if(type=='false')
	{
		var dataJson = window[chartData];
	}else
	{
		var dataJson = chartData;
		//dataJson = JSON.parse(dataJson);
	}
	var length=dataJson.length;
	
	var data = new google.visualization.arrayToDataTable(dataJson);
	 var options = {
          legend: {position: 'bottom'},
          pieHole: 0.4,
        };

	var chart = new google.visualization.PieChart(document.getElementById(divID));
	chart.draw(data,options);


}




