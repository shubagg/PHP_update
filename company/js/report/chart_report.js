
 function drawBarChart(cdata,reportName){

  //console.log(cdata);

  
   var data = new google.visualization.arrayToDataTable(cdata);

        var options = {
         title: reportName,
          width:'1000',
          height:'400',
         bar: {groupWidth: "95%"},
          hAxis: { 
          format: 'MMM,d', 
          },
          explorer: { 
                actions: ['dragToZoom', 'rightClickToReset'], 
                axis: 'vertical'
            }
        };

        var chart =  new google.visualization.ColumnChart(document.getElementById('Bar_chart'));
        chart.draw(data, options);
        //resize('Bar_chart');
}


function drawLineChart(cdata,reportName){

  
  //cdata = JSON.stringify(cdata)
  var mdata=cdata;
  var index =jQuery.inArray("Date",mdata[0]);
  if(index!="-1")
  {
    var ncdat=new Array();
    var k;
    for(k=1;k<mdata.length;k++)
    {
      var from = mdata[k][index].split("-");
            var dta = new Date(from[0], from[1]-1,from[2]);
         //var dta=new Date(mdata[k][index]);
      mdata[k][index]=dta;
    }
  }
   var data = google.visualization.arrayToDataTable(mdata);
        var options = {
          title: reportName,
          width:'1000',
          height:'400',
          //curveType: 'function',          
          legend: { position: 'bottom' },
          pointSize: 5,
          hAxis: { 
          format: 'MMM,d', 
          },
          explorer: { 
                actions: ['dragToZoom', 'rightClickToReset'], 
                axis: 'vertical'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('Line_chart'));

        chart.draw(data, options);
        //resize('Line_chart');
        cdata='';
}

function drawPieChart(cpdata,reportName){

  //alert(cpdata);
     
     
       var data = google.visualization.arrayToDataTable(cpdata);

        var options = {
          width:'1000',
          height:'400',
         title: reportName,
          is3D: true,
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('Pie_chart'));
        chart.draw(data, options);
     
}

$(window).smartresize(function () {   
        chart.draw(data, options); 
    });




function get_report_data_according_date(type)
{
  $("#dateType").remove();
  var dateType='<input type="hidden" class="form-control " id="dateType" name="dateType" value="'+type+'">';
  $("#formElement").append(dateType);
  get_report_data();
}    