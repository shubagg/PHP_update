<?php 
include_once('../../../global.php');

	get_admin_header(); 
	get_admin_header_menu(); 
	get_admin_left_sidebar(); 

	
?>



	<div id="">
    <div id="content">
        <div class="row">
            <div class="col-lg-12">
                <div class=" mt-15">
                    <label>Saved Queries</label>
            <select id="sel_query_all" class="form-control" onchange="change_query(this.value)">
            <option value="">Select Report Query</option>
            <?php foreach ($queryData as $qkey => $qvalue) { ?>
            	<option value="<?php echo $qkey ;?>"><?php echo $qvalue;?></option>		
            <?php }?>
            </select>

                </div>
            </div>
        </div>
        <!-- //content > row-->
    </div>
    </div>

<!--<div class="modal-scrollable z-1060">-->
    


<?php
include_once(server_path().'ui/admin/controller/report.php');

?>

<!--</div>-->
<?php get_admin_footer(); ?>
<script type="text/javascript">
function change_query(value)
{
	var url = "<?php echo site_url().'ui/admin/report?type='?>"+value;
	window.location = url;
}
</script>
