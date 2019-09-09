<?php 
include_once("../../../global.php");
$companyData=get_company_data();
include(lang_url()."resourse/en.php");

//echo $server_path . "ui/admin/resources/dashboardController.php";

include($server_path . "ui/admin/dashboard/dashboardController.php");

//is_user_logged_in();
//$chart_total=get_module_count();
//$chart_count=$chart_total['data'];
?>

<?php get_admin_header();  ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Active', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'Robot Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    
        google.charts.load('current', {packages: ['corechart', 'line']});
		google.charts.setOnLoadCallback(drawBackgroundColor);

		function drawBackgroundColor() {
		      var data = new google.visualization.DataTable();
		      data.addColumn('number', 'X');
		      data.addColumn('number', 'Performance');

		      data.addRows([
		        [0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
		        [6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
		        [12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
		        [18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
		        [24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
		        [30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
		        [36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
		        [42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
		        [48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
		        [54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
		        [60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
		        [66, 70], [67, 72], [68, 75], [69, 80]
		      ]);

		      var options = {
		        hAxis: {
		          title: 'Time'
		        },
		        vAxis: {
		          title: 'Performance'
		        },
		        backgroundColor: '#f1f8e9'
		      };

		      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		      chart.draw(data, options);
		    }

    </script>
<?php get_admin_header_menu(); ?>

 <script>
var parent_cats='<?php echo implode(",",$parent_cats);  ?>';
var chatcounter=1;
var helpcounter=1;
</script>
<?php  get_admin_left_sidebar(); ?> 

<style type="text/css">
	
	.graph{
		padding-right: 20px;
	}
</style>

<div class="tfp graph">
	<div class="row">
<div class="col-md-6 col-sm-12 col-xs-12"> 
<div id="piechart" style="width: 100%; height: 650px;"></div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12"> 
<div id="chart_div" style="width: 100%; height: 650px;"></div>
</div>
 </div>
</div>
<div class="clearfix"></div>

<?php  //include_once(include_admin_template("dashboard","dashboardMainUI")); ?>

<?php include($server_path . "ui/admin/dashboard/chatsection.php"); ?>

<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>dashboard/js/dashboard.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/category.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>dashboard/js/chat.js"></script>
<!-- <script type="text/javascript" src="<?php echo admin_ui_url(); ?>course/js/course.js"></script> -->
<!-- <script type="text/javascript" src="<?php// echo admin_ui_url(); ?>resources/js/resource.js"></script>
 <script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/user.js"></script>  
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/role.js"></script> -->
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<script type="text/javascript" src="<?php echo site_url()."company/".$companyData['cid']."/"; ?>assets/js/chat-bot.js"></script>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

//setTimeout(function(){ show_basic_charts(50,1); }, 1000);
</script>  

 <?php get_admin_footer(); ?> 