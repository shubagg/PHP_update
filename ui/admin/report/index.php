<?php include_once('../../../global.php'); ?>
<?php get_admin_header(); ?>
<?php get_admin_header_menu(); ?>
<?php get_admin_left_sidebar(); ?>
<?php
if(check_user_permission('report', 'report', 'all')!='1' && check_user_permission('report', 'report', 'view')!='1' ) 
{
    include_once(include_admin_template("customTemplates","unauthorised")); 
    die;
}

?>
<div id="main" class="dashboard">

<?php
    $userId = is_user_logged_in();
    $query_id = '';
    if(isset($_GET['query']) && !empty($_GET['query']))
    {
    	$query_id = $_GET['query'];
        $queryData = curl_post('/get_saved_queries',array("id"=>$_GET['query']));
        if($queryData['success']=='true')
        {
            $query = $queryData['data'][0]['query'];
        }
        $divShowHide ='block';
    }
    else
    {
        $divShowHide ='none';
    }
  
?>

    <div id="content">
        <div class="row">
            <div class="col-lg-12">
<!--------------------------------- Include Page Header ------------------------------------------>
       
                
<!------------------------------ Include Advanced Search -------------------------------------->
                
            <section class="panel">
              <header class="panel-heading">
                <div id="filter-panel" class="filter-panel">
                  <div class="row">
                    <div class="col-lg-12">
                        <div class=" mt-15">
                            <label>Saved Queries</label>
                            <select id="sel_query_all" class="form-control" onchange="change_query(this.value)">
                            <option value="">Select Report Query</option>
                            
                            </select>

                        </div>
                    </div>

                  </div>
                </div>
              </header>  
              <header class="panel-heading">
                <div id="filter-panel" class="filter-panel">
               
           
                    <div class="row">
                      <div class="col-md-6" >
                      
                        <h3><strong>
                          <?php
                            echo $ui_string['query'];
                          ?>
                          </strong></h3>
                       </div>
                      
                    </div>
                </div>
               </header>
                   <div class="panel-body">
                    <div class="grid" id="adv_search_all" style="display: <?php echo $divShowHide; ?>;">
                     <div class="row">
                        <div class="col-md-12 margn_tp_7" style="display: block;">
                        <label><?php echo $ui_string['query_string'];?></label>
                    <textarea id="query_write" readonly  class="form-control" rows="5"><?php if(isset($query)){ echo $query; } ?>
                    </textarea>
                        </div>
                     </div>
                    </div>
                   </div>
           
     
   
</section>
                
<!------------------------------ Include Listing Page -------------------------------------->
 <script type="text/javascript">
 var str ='';
 var query_id = '';
 $( document ).ready(function() {
     str = $('#query_write').val();
     query_id = "<?php echo $query_id; ?>";

});
	
</script>           
            <?php 
                include_once(server_path().'ui/admin/controller/report.php');
            ?>
                
            </div>
        </div>
        <!-- //content > row-->
    </div>

<!--<div class="modal-scrollable z-1060">-->
    

</div>


<!--</div>-->
<?php get_admin_footer(); ?>

<script type="text/javascript">
$( window ).load(function() {
    
    get_saved_queries();
});
</script>
<script type="text/javascript">
var query_data_result = '';
    function get_saved_queries()
    {
        var qUserId = "<?php echo is_user_logged_in(); ?>";
        var query_data = '<select id="sel_query_all" class="form-control" onchange="change_query(this.value);">';
        query_data += '<option value="">'+ui_string['select_query']+'</option>';
            $.ajax({

                url:webservice_url+'/get_saved_queries',
                type:'post',
                data:{'userId':qUserId},
                success:function(suc)
                {
                    if(typeof(suc) !='object')
                    {
                       suc = JSON.parse(suc);
                    }
                   // console.log(suc);
                    if(suc['success']=='true')
                    {
                        var data = suc['data'];
                        query_data_result = suc['data'];
                        for(var i=0; i < data.length; i++)
                        {
                            query_data += '<option value="'+data[i]['id']+'"';
                            if(data[i]['id']==query_id)
                            {
                            	query_data += ' selected ';
                            }
                            query_data += '>'+data[i]['name']+'</option>';

                            if(i==(data.length-1))
                            {
                              query_data += '<select>';  
                              $('#sel_query_all').html(query_data);
                              
                            }
                        }

                    }
                    else
                    {
                      query_data += '</select>';  
                    }
                }

            });
        

    }
</script>
<script type="text/javascript">
function change_query(value)
{

    var rurl = '';
    for(q=0;q < query_data_result.length; q++)
    {
        if(value == query_data_result[q]['id'])
        {
            rurl = '?type='+query_data_result[q]['type']+'&query='+value;
        }
    }
   
    var url = "<?php echo site_url().'admin/report'?>"+rurl;
    window.location = url;
}
</script>