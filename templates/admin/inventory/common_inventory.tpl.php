<div id="history_popup" class="modal fade" role="dialog" data-width="900">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">History</h4>
	</div>
	<div class="modal-body">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped basic_datatable" id="manage_history_datatable">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Item Name</th>
					<th>Qty</th>
					<th>By</th>
					<th>To</th>
					<th>Job</th>
					<th>Status</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody align="center" id="manage_allocation_list_table_data">
				
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
function getHistory(id)
{
	$.ajax({
		url:site_url+"webservices/get_inventory_history",
		data:"allocationId="+id,
		type:"POST",
		dataType:"json",
		success:function(suc){
			
			suc=suc['data'];
			$('#manage_history_datatable').DataTable().clear().draw();
			var t = $('#manage_history_datatable').DataTable();
			for(i=0;i<suc.length;i++)
			{
				t.row.add( [
		           (i+1),
		           suc[i]['productTitle'],
		           suc[i]['quantity'],
		           suc[i]['userName_by'],
		           suc[i]['userName_to'],
		           suc[i]['job'],
		           suc[i]['key'],
		           suc[i]['date']
		        ] ).draw( false );
			}
			$('#history_popup').modal();
		}
	})
}
</script>