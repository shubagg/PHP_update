
function drawChartPie(divID,chartData,type) 
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
	var sum = 0;
	for(i=1;i<=length-1;i++)
	{
		 sum += parseInt(dataJson[i][1]);
     }
	var data = new google.visualization.arrayToDataTable(dataJson);
	if(sum>0)
	{
	if(data.getNumberOfRows()==0)
	{
 	document.getElementById(divID).innerHTML = "No Data Available";
    document.getElementById(divID).classList.add("graph-data-nt-avail");
	}
	else
	{
	var chart = new google.visualization.PieChart(document.getElementById(divID));
	chart.draw(data,{width:'100%',legend:'bottom',is3D:'true',});
}
}
else
{
	document.getElementById(divID).innerHTML = "No Data Available";
    document.getElementById(divID).classList.add("graph-data-nt-avail");
}


}




