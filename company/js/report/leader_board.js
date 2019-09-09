
function get_leader_board_tmp(report_id)
{
	
  var data={"head":'',"field":'',"defaultField":'',"report_id":report_id,'mid':mid,'smid':smid};
	$.ajax({
	  type: "POST",
	  url:  admin_template_path_site+"customTemplates/leaderBoardTable.tpl.php?action=get_retData",
	  data: data,
	  success: function(response) 
	  {
        //alert(response);
	    $("#leaderBoardInfo").html(response);
	  }

	});
}

function get_tab_data(tab)
{
    $("#formElement").html("");
    get_leader_board_tmp(tab);
}

function  get_leader_board_data()
{
	
	var formData = $( "#leaderBoardForm" ).serialize();
	ladda_toggle('submitBtn');
	$.ajax({
            type: "POST",
            url:  admin_ui_url+"report/ajax/manage_report.php?action=get_report_data",
            data: formData,
        
            success: function(data) 
			{
                //alert(data);

				ladda_toggle('submitBtn');
                var leaderBoardData = JSON.parse(data);
               
                	var clength = 1;//leaderBoardData['data']['chartType'].length;
					/*for(i=0;i<clength;i++)
					{				
						var ctmp =  leaderBoardData['data']['chartType'][i];
						var Ctmp1 = "draw"+ctmp+"Chart";
						alert(Ctmp1);
						//drawBarChart(leaderBoardData['data']['chartData'],leaderBoardData['data']['reportName']);
						window[Ctmp1](leaderBoardData['data']['chartData'],leaderBoardData['data']['reportName']);
					}*/
			   //drawBarChart(leaderBoardData['data']['chartData'],leaderBoardData['data']['reportName']);
			   setTimeout(function()
	    	   {
			   		drawChart(leaderBoardData['data']['chartData']);
			   }, 100);

               get_leader_board_tmpNew(leaderBoardData['data']['thead'],leaderBoardData['data']['tdata'],leaderBoardData['data']['defaultField'],leaderBoardData['data']['report_id'],leaderBoardData['data']['dropDownArr'],leaderBoardData['data']['course']);

            }
  
    });  
}

function get_leader_board_tmpNew(head,field,defaultField,report_id,dropDownArr,courseId){
  
   var data={"head":head,"field":field,"defaultField":defaultField,"report_id":report_id,'mid':mid,'smid':smid};
	$.ajax({
	  type: "POST",
	  url:  admin_template_path_site+"customTemplates/leaderBoardTable.tpl.php?action=get_retData&type=submit",
	  data: data,
	  async: false,
	  success: function(response) 
	  {
	  	//alert(response);
	    //alert(dropDownArr.length);
	    $("#leaderBoardInfo").html(response);
	    getTest(courseId);
	    setTimeout(function()
	    {
	    	
		    for(var l=0;l<dropDownArr.length;l++)
		    {	//alert(dropDownArr[l]['value']+"--"+dropDownArr[l]['key']);
		    	$("#"+dropDownArr[l]['key']).val(dropDownArr[l]['value']);
		    }
		    
		}, 100);
	    
	  }

	});
}

function drawChart123(chartRowData) {
	alert(chartRowData);
	console.log(chartRowData);
        var data = google.visualization.arrayToDataTable(chartRowData);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Line(document.getElementById('Bar_chart'));

        chart.draw(data, options);
      }

