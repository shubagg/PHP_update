/*
headerRow 				- Assigns a class name to the table header row (<tr> element).
tableRow 				- Assigns a class name to the non-header rows (<tr> elements).
oddTableRow 			- Assigns a class name to odd table rows (<tr> elements). Note: the alternatingRowStyle option must be set to true.
selectedTableRow 		- Assigns a class name to the selected table row (<tr> element).
hoverTableRow 			- Assigns a class name to the hovered table row (<tr> element).
headerCell 				- Assigns a class name to all cells in the header row (<td> element).
tableCell 				- Assigns a class name to all non-header table cells (<td> element).
rowNumberCell 			- Assigns a class name to the cells in the row number column (<td> element). Note: the showRowNumber option must be set to true.

var cssClassJson = {headerRow: 'bigAndBoldClass',hoverTableRow: 'highlightClass'};	
cssClassNames : cssClassJson;
*/
function drawTable(divID,chartData,type) 
{     
		
		if(type=='false')
		{
			 var dataJson = window[chartData];
			
		}else
		{
			var dataJson = chartData;	
		}	
		// var dataJson = '[["#","Title","Desc","Project","Type","Severity","Priority","Status","Date"],[1,"Create 2 ","fcd","","","","P5","Inprogress","2017-05-15"],[2,"1","testing","Ticketing tool (Pro -2)","Bug","Normal","P2","Inprogress","2017-05-15"],[3,"ABC Test","ABC","","","","P5","Inprogress","2017-05-18"],[4,"test by pawan ","testing on urgent basis.\nit is very important.","Ticketing tool (Pro -2)","","Major","P1","Inprogress","2017-05-18"],[5,"test","testing ticketing tol ","Ticketing tool (Pro -2)","","Critical","P1","Inprogress","2017-05-18"],[6,"Hello test","Test","Ticketing tool (Pro -2)","","","P5","Inprogress","2017-05-18"],[7,"test1","testing by ayushi updated","Ticketing tool (Pro -2)","Bug","Critical","P5","Inprogress","2017-05-18"]]';

		//		
        var data = new google.visualization.arrayToDataTable(dataJson);
       if(data.getNumberOfRows()==0)
	{
 	document.getElementById(divID).innerHTML = "No Data Available";
    document.getElementById(divID).classList.add("graph-data-nt-avail");
	}
	else
	{
	var chart = new google.visualization.Table(document.getElementById(divID));
    chart.draw(data,{width:'100%',page:'enable',pageSize:5,pagingButtons:'both'});
}
        
$('.google-visualization-table-table').parent().addClass('dashboard-gogle-tabel-fixed');
}

