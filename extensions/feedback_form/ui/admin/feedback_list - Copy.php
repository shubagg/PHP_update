<?php
is_user_logged_in();
get_admin_header();
get_admin_header_menu(); 
get_admin_left_sidebar(); 


$adminUiPath="https://$_SERVER[HTTP_HOST]/extensions/feedback_form/ui/";

$user=$_SESSION['user']['user_id'];
$api_action='get_pending_formjob';
$listing_data=array('columns' => array($ui_string['form_name'],$ui_string['form_no'], $ui_string['fillperson'], $ui_string['fill_date']));


?>
  <div id="main" class="dashboard">
  <?php get_breadcrumb(); ?>
 <div id="content">
      <div class="row">
<section class="panel">
 <header class="panel-heading">
               <div class="row">

                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >

                     <h3><strong><?php echo $ui_string['feedback_form']?></strong></h3>
                  </div>
     
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                 
                    
                     <div class="text-right select_all">
                       <select class="btn btn-default" onchange="updateDatatable(this.value);" id="formlisting">
                       <option value=""><?php echo $ui_string['selectform'];?></option>

                        <?php 
                            $query = "SELECT DISTINCT form_id FROM job";
                            $getformlist=mysql_query($query);
                            while($gdata = mysql_fetch_assoc($getformlist))
                            {
                               $getformName=get_form_by_id(array('id'=>$gdata['form_id'],'fields'=>'title'));
                               $getformName=$getformName['data']['0'];
                               if($getformName){
                        ?>
                            <option value="<?php echo $getformName['id']; ?>"><?php echo $getformName['title']; ?></option>
                        <?php } } ?>

                    </select>
                        <button onclick="export_data()" type="button" data-toggle="tooltip" data-placement="top" title="Export" class="btn btn-default">
                           <i class="glyphicon glyphicon-export"></i><!--Export <?php echo $language['export']; ?> -->
                        </button>
                     </div>
                  </div>
           
               </div>
            </header>

   <div class="panel-body panel_bg_d">
    <div class="tbl-responsive">
        <table id="list_details" cellpadding="0" cellspacing="0" border="0" class="table table-striped">
            <thead>
                <tr>
                    <?php if(!empty($listing_data['columns'])) {
                        foreach($listing_data['columns'] as $val) {
                            ?>
                            <th class="">
                                <?= $val; ?>
                            </th>
                            <?php
                        }
                        ?>
                    <?php } ?>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</section>
      </div>
   </div>
</div>
<script type="text/javascript">
var adminUiPath='<?php echo $adminUiPath;?>';

function export_data(){
    setloader();
    var datastring="userid=<?php echo $user; ?>&form_id="+$('#formlisting').val();
    $.ajax({
            url: adminUiPath + 'ajax/exportjobdata.php',
            type:"post",
            data: datastring,
            async:false,  
            success:function(suc)
            {      
                unloading();
                console.log(suc);
                var data = JSON.parse(suc);
                if(data['data']['success']=='true')
                {
                     window.location = data['data']['path'];        
                }
                else
                {
                    $("#model_des").html(ui_string['nodataavilable']);
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal('toggle'); },1500);
                } 
            }
    });
}


function updateDatatable(e){
    show_datatable(e);
}



function checkdataForDatatable(){}
function show_datatable(formid='')
{
    
    var current_project = "<?php echo $selected_project; ?>";
    var formtype = "<?php echo $_GET['formtype']; ?>";
    var api_action = "<?php echo $api_action; ?>";
    var user = "<?php echo $user; ?>";

    $("#list_details").dataTable().fnDestroy();
    $('#list_details').DataTable({
        "columns": [{
                "data": "title"
            }, {
                "data": "id"
            }, {
                "data": "creator"
            }, {
                "data": "date"
            }],
        "processing": true,
        "serverSide": true,
        "bDestroy": true,
        "order":[1,'desc'],
        language: {
                search: ui_string['search'],
               // searchPlaceholder: ui_string['form_no']+','+ui_string['form_name']+','+ui_string['fill_date'],
                "lengthMenu":  ui_string['show']+" _MENU_ "+ ui_string['records_per_page'],
                "zeroRecords": ui_string['no_data_found'],
                "info": ui_string['showing_page'] + " _PAGE_ " + ui_string['of'] + " _PAGES_ ",
                //"_PAGE_ " + " of " + " _PAGES_",
                "infoEmpty":  ui_string['showing_page'] + " _PAGES_ " + ui_string['of'] + " _PAGES_ ",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "loadingRecords": ui_string['loading'],
                "processing":     ui_string['processing'],
            },
        "lengthMenu": [[10, 25, 50, 100], [ui_string['n_10'], ui_string['n_25'], ui_string['n_50'], ui_string['n_100']]] , 
        
        //"searching": false,
      //  "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] },{ 'bSortable': false, 'aTargets': [ 2 ] },{ 'bSortable': false, 'aTargets': [ 3 ] }],
        "ajax": {
            url: adminUiPath + 'ajax/form_details_datatable_ajax.php',
            type: 'POST',
            data: {
                projectId: current_project,
                formid: formid,
                formtype: formtype,
                api_action: api_action,
                user: user
            },
            error: function(err){  // error handling
                    
                    console.log(err);
            }

        }
    });
}
$(document).ready(function() {
    show_datatable();
});

</script>

<?php
	get_admin_footer();
?>