<?php 

$categoryId=$_GET['id'];

$allCat=get_category(array('id'=>$categoryId));
$arr="";
$cln='"';
$parent="";
$div="<div class='chart-heading-name'>";
$div1="</div>";//
$all=get_category(array('code'=>$allCat['data'][0]['code']));
foreach($all['data'] as $cat)
{
    $parent=$cat['title1'];
    if($cat['parent_id']!='0')
    {
          $parentinfo=get_category(array('id'=>$cat['parent_id']));
          if($parentinfo['success']=='true')
          {
              $parent=$parentinfo['data'][0]['title1'];
          }
    }
    $managername=array();
    $name='';
    $managerinfo=get_category_managers(array('categoryid'=>$cat['id']));
    
    if($managerinfo['success']=='true' && $managerinfo['data']!='')
    {
         $i=1;
         $dot="";
         $usersIds=str_replace(",", "|", $managerinfo['data']);
         $userInfo=get_resource_by_id(array('id'=>$usersIds,'orderby'=>'-1'));
         if($userInfo['success']=='true' && $userInfo['data']!='')
         {
           
           foreach($userInfo['data'] as $manager)
           {

              if($i>2)
              {
                $dot="...";
                break;
              }
              $managername[]=$manager['name'];
              $i++;
           }
        }
  }
  if(!empty($managername))
  {    
       $name=implode(",",$managername).$dot;
  }  
   

  $arr.='['.'{'.'v'.':'.$cln.$cat['title1'].$cln.','.'f'.':'.$cln.$div.$cat['title1'].$div1.'<div>'.'<span>'.$name.'</span>'.$div1.'</a>'.$cln.'}'.','.$cln.$parent.$cln.','.$cln.$cat['id'].$cln.']'.',';

}

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources","department_hierarchy")); ?>

  <!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.nice-select.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';
var  API ;

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
        data.addRows([<?php echo $arr ?>]);

        // Create the chart.
         chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
    google.visualization.events.addListener(chart, 'select', selectHandler);
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {
    allowHtml:true,
    
    });
      }
    function selectHandler() { 
    
      
      var selectedItem = chart.getSelection()[0];
      if (selectedItem) 
      {
        var ToolTip = data.getValue(selectedItem.row, 2);
        var dept = data.getValue(selectedItem.row, 0);
        getNavTemp(ToolTip,dept); 
        $("#menu-right").mmenu({
          position  : 'right',
          counters  : false,      
      });
        API = $("#menu-right").data( "mmenu" );
        API. open();  

      }

}


function getNavTemp(ToolTip,dept)
{
  var formData = "catid="+ToolTip +"&dept="+dept;
  $.ajax({
    url: "<?php echo site_url();?>templates/admin/resources/nav_hierarchy.tpl.php",
    type: "POST",
    data: formData,
    success:function(response)
    {
       // alert(response);
        $("#hrchyData").html(response);
       
    }
  });
}


function update_manage_memeber(cid,uid,catName,mid)
{ 
  //alert(mid);
       var formData = "cid="+cid +"&uid="+uid+"&mid="+mid;
       $.ajax({
        url: "<?php echo admin_ui_url();?>resources/ajax/add_user.php?action=manage_manager",
        type: "POST",
        data: formData,
        success:function(response)
        {
          //alert(response)
            if(response==1)
            {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['user_update_success']);
                $('#success_modal').modal();
                
                setTimeout(function(){ $('#success_modal').modal("toggle");  location.reload();  },2000);

            }
     
            else
            {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['user_update_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function(){ $('#success_modal').modal("toggle"); },2000);
            }
           
        }
      });
   
}
 setTimeout(function(){ $("#user_table_previous").html("<i class='fa fa-chevron-left' aria-hidden='true'></i>"); }, 1000);
 setTimeout(function(){ $("#user_table_next").html("<i class='fa fa-chevron-right' aria-hidden='true'></i>"); }, 1000);
 
     
     
  $(document).ready(function() {
  $('.list').niceSelect();
});
   </script>
