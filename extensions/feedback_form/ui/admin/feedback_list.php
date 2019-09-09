<?php
is_user_logged_in();
get_admin_header();
get_admin_header_menu(); 
get_admin_left_sidebar(); 





?>
  <div id="main" class="dashboard">
  <?php get_breadcrumb(); ?>
  <div id="content">
      <div class="row">
        <?php
            $_GET['jsonPath'] = "extensions/jsonController/";
            $_GET['type'] = 'feedbackfromList';
            $load_url = server_path().'ui/admin/controller/index.php';
            require_once($load_url);
    
        ?>
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