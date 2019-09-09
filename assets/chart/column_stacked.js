function drawStackedColChart(divID,chartData,type) 
{     
		if(type=='false')
		{
			 var dataJson = window[chartData];
		}else
		{
			var dataJson = chartData;			 
		}	
    
	var color_code =  Math.floor(Math.random() * 10);
        var color_array ={1 :'#16A085',2 :'#2ECC71',3 :'#27AE60',4 :'#1ABC9C',5 :'#8E44AD',6 :'#2980B9',7 :'#34495E',8 :'#C0392B',9 :'#D35400',10 :'#E67E22',11 :'#95A5A6',12 :'#BDC3C7',13 :'#ECF0F1',0 :'#ff1a1a'};
        var color = color_array[color_code];
        var data = new google.visualization.arrayToDataTable(dataJson);
          var view = new google.visualization.DataView(data);
           if(view.getNumberOfRows()>0)
            {
      view.setColumns([0, 1,
                       {
                         sourceColumn: 1,
                         role: "annotation" },
                       2,
                       {
                         sourceColumn: 2,
                         role: "annotation" }]);
  }
        var chart = new google.visualization.ColumnChart(document.getElementById(divID));
        google.visualization.events.addListener(chart, 'error', function (googleError) {
      document.getElementById(divID).innerHTML = "No Data Available";
     document.getElementById(divID).classList.add("graph-data-nt-avail");
  });
        chart.draw(view,{width:'100%',colors: [color, 'silver', '#f3b49f', '#b87333'],isStacked: 'true',legend:'bottom'});

}


function loadScript(url, callback){

    var script = document.createElement("script")
    script.type = "text/javascript";

    if (script.readyState){  //IE
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" ||
                    script.readyState == "complete"){
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function(){
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}



