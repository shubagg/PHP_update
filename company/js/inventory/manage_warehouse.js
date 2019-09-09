function validation_successfull(){ }
function open_warehouse_popup()
{
	$('.error').html('');
	$('#manage_warehouse_form')[0].reset();
	$('#warehouse_popup').modal();
}

$('.warehouse_form_submit').click(function(){
	var check=validation('manage_warehouse_form');
	$('#addware').attr('disabled', 'disabled');

	if(check!=false)
	{
		$.ajax({
			url:site_url+"webservices/manage_warehouse",
			data:'id='+$('#warehouseId').val()+'&title='+$('#title').val()+'&location=1&address='+$('#address').val()+'&contactperson=1&contactno=1&vendorcode='+$('#owner').val()+'&status=1',
			type:"POST",
			dataType:"json",
			success:function(suc)
					{

						$('#warehouseId').val('0');
						if(suc['success']=='true'){
							//refresh_custom_dt();
							location.reload();
							$('#warehouse_popup').modal('toggle');
							$('#success_modal').modal();
							setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
						}else{
							$('#error_head').html('Error!');
							$('#error_body').html('Something went wrong');
							$('#error_message').modal();
							setTimeout(function(){ $('#error_message').modal('toggle'); },1000);
						}
					}
		})
	}
})

function edit_warehouse_temp(warehouseId)
{
	$('.error').html('');
	$('#manage_warehouse_form')[0].reset();
	$('#warehouse_popup').modal();
	$('#warehouseId').val(warehouseId);
	$.ajax({
		url:site_url+"webservices/get_warehouse_by_id",
		data:"id="+warehouseId,
		type:"POST",
		dataType:"json",
		success:function(suc){
			suc=suc['data'][0];
			$('#warehouseId').val()
			$('#title').val(suc['title']);
			$('#address').val(suc['address']);
			$('#owner').val(suc['vendorcode']);
		}
	});
}

function openGenericUsersPopup(id,roleId)
{
	group_id=roleId;
	genericUsersPopup(id);
}