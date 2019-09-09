<?php 



?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources","unity")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->




<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  

 <?php get_admin_footer(); ?> 


     <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);
	   var chart;
	   var data;
      function drawChart() {
         data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
          [{v:'Vikram Salwan', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'', 'Mr. Vikram salwan is managing whole organization'],
			
          [{v:'PHP', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Vikram Salwan', 'Manager HR and SEO/Business'],
			
			[{v:'Sarita', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'PHP', 'Human Resource'],
			
			[{v:'Sonia', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'PHP', 'Human Resource'],
			
          [{v:'Vipul', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Vikram Salwan', 'Manager L2'],
			
		   [{v:'Aman', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Vipul', 'Engineer UI'],
			
			[{v:'Nishat', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Vipul', 'Engineer UI'],
			
			
			
		  [{v:'Pratyush', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Vikram Salwan', 'Manager UI'],
			
		  [{v:'Ripu', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Pratyush', 'Leading UI team'],
			
		  [{v:'Aman', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Ripu', 'Engineer UI'],
			
		  [{v:'Nitin', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Ripu', 'Engineer UI'],
			
		  [{v:'Swati', f:'<div class="chart-heading-name">Department</div><div><span>Chandan, Aaditya...</span></div>'},'Ripu', 'Engineer UI'],
          
         
        ]);

        // Create the chart.
         chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
		google.visualization.events.addListener(chart, 'select', selectHandler);
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {
		allowHtml:true,
		
		});
      }
	  function selectHandler() {
  var selection = chart.getSelection();
  var message = '';
  for (var i = 0; i < selection.length; i++) {
    var item = selection[i];
    if (item.row != null && item.column != null) {
      var str = data.getFormattedValue(item.row, item.column);
      message += '{row:' + item.row + ',column:' + item.column + '} = ' + str + '\n';
    } else if (item.row != null) {
      var str = data.getFormattedValue(item.row, 0);
      message += '{row:' + item.row + ', column:none}; value (col 0) = ' + str + '\n';
    } else if (item.column != null) {
      var str = data.getFormattedValue(0, item.column);
      message += '{row:none, column:' + item.column + '}; value (row 0) = ' + str + '\n';
    }
  }
  if (message == '') {
    message = 'nothing';
  }
  alert('You selected ' + message);
  $("html").addClass("mm-background mm-right mm-opened mm-opening");

}

$(document).on('click', function (e) {
   /*if ($(e.target).closest("#CONTAINER").length === 0) {
        $("#CONTAINER").hide();
    }*/
    $("html").removeClass("mm-background mm-right mm-opened mm-opening");
});
   </script>
