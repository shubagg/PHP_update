<?php 



?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources","hierarchy")); ?>

  <!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->



<!--<style>
.mm-menu
{
  background: none!important;
}-->
</style>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>

<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  

 <?php get_admin_footer(); ?> 

 <?php
    $a=get_category(array());

      
    $arr="";
    $cln='"';
    $parent="";
    $div="<div class='chart-heading-name'>";
    $div1="</div>";
   
  foreach($a['data'] as $cat)
  {
      
        $username=array();
        $name='';
            if($cat['parent_id']!='0')
            {
                  $parentinfo=get_category(array('id'=>$cat['parent_id']));
                  if($parentinfo['success']=='true')
                  {
                   $parent=$parentinfo['data'][0]['title1'];
                  }
            }
               $userinfo=get_category_users(array('category_ids'=>$cat['id']));

             if($userinfo['success']=='true' && $userinfo['data']!='')
              {
                $i=1;
                $dot="";
                   foreach($userinfo['data'] as $user)
                   {

                    if($i>2)
                    {
                      $dot="...";

                      break;
                    }
                     $username[]=$user['name'];
                   
                      $i++;

                   } 


            }


    if(!empty($username))
    {
                
         $name=implode(",",$username).$dot;
      

    }  
     
   $arr.='['.'{'.'v'.':'.$cln.$cat['title1'].$cln.','.'f'.':'.$cln.$href.$href1.$href2.$href3.$href4.$div.$cat['title1'].$div1.'<div>'.'<span>'.$name.'</span>'.$div1.'</a>'.$cln.'}'.','.$cln.$parent.$cln.','.$cln.$cat['id'].$cln.']'.',';

  }


        

  ?>
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
          <?php echo $arr ?>
          
         
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
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var ToolTip = data.getValue(selectedItem.row, 2);
            var dept = data.getValue(selectedItem.row, 0);
  //alert('You selected ' + ToolTip);
  //alert("<?php echo site_url();?>admin/resources/hierarchy_nav.tpl.php ");
 var formData = "catid="+ToolTip +"&dept="+dept;
 //alert(formData);

  

  $.ajax({
                            type: "POST",
                            url:  "<?php echo site_url();?>templates/admin/resources/hierarchy_nav.tpl.php",
                            data: formData,
                            success: function(data) {
                            
                              
                                $("#menu-right").html(data);
                     
                                
                            },
                           
                }); 
   

}
$("html").addClass("mm-right mm-opened mm-opening");
 //$(".mm-ismenu").css({ 'background' : '#101215' });

}
   </script>

