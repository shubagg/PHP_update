var productId='';
var warehouseId='';
var inventoryAllocationId='';
function request_inventory(id)
{
	$('.error').html('');
	$('#request_stock_form')[0].reset();
	productId=id;
	$('#request_inventory').modal();
}

function requestPopup(id,pid,inventoryId,jobId)
{
	productId=pid;
	$('.error').html('');
	$('#return_request_form')[0].reset();
	$('#consumeForm')[0].reset();
	inventoryAllocationId=inventoryId;
	$('#consumeJobId').val(jobId);
	$('#returnJobId').val(jobId);
	$('#'+id).modal();
}

function getRequestTypeData(requestType)
{
	load_page('inventoryHistory','inventory_history','&requestType='+requestType);
}

$('.requestInventoryButton').click(function(){
	var check=validation('request_stock_form');
	if(check!=false){
		setloader();
		var requestData="quantity="+$('#requestQuantity').val()+"&productId="+productId+"&userId="+currentUserId+"&jobId="+$('#requestJobId').val()+"&type=REQUEST";
		$.ajax({
			url:site_url+"webservices/inventory_request",
			data:requestData,
			type:"POST",
			dataType:"json",
			success:function(suc)
					{
						setloader();
						console.log(suc);
						$('#request_inventory').modal('toggle');
						$('#success_modal').modal();
						$('.nav-tabs a[href="#requestd_history"]').tab('show');
						setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
						
						load_page('inventoryRequestHistory','requestd_history');
						//reset_datatable('user_requested_history_dt','productId,productCategory,quantity,updatedOn,jobId,status',warehouseId,'user_request_datatable_ajax',"&type=REQUEST");
					}
		})
	}
});

$('.returnButton').click(function(){
	var check=validation('return_request_form');
	if(check!=false){
		setloader();
		var requestData="allocationId="+inventoryAllocationId+"&quantity="+$('#returnQuantity').val()+"&productId="+productId+"&userId="+currentUserId+"&jobId="+$('#returnJobId').val()+"&type=RETURN";
		$.ajax({
			url:site_url+"webservices/inventory_request",
			data:requestData,
			type:"POST",
			dataType:"json",
			success:function(suc)
					{
						setloader();
						if(suc['success']=='true'){
							$('.requestType').val('RETURN');
							$('#return_popup').modal('toggle');
							$('#success_modal').modal();
							$('.nav-tabs a[href="#inventory_history"]').tab('show');
							load_page('inventoryHistory','inventory_history','&requestType=RETURN');
							setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
						}else{
							$('#error_head').html('Error!');
							$('#error_body').html('Quantity available :'+suc['data']);
							$('#error_message').modal();
							setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
						}
					}
		})
	}
})

function validation_successfull(){}

$('.consume_submit_button').click(function(){
	var check=validation('consumeForm');
	if(check!=false){
		setloader();
		$.ajax({
			url:site_url+"webservices/inventory_consume",
			data:"quantity="+$('#consumeTitle').val()+"&jobId="+$('#consumeJobId').val()+"&productId="+productId+"&userId="+currentUserId+"&id="+inventoryAllocationId,
			type:"POST",
			dataType:"json",
			success:function(suc)
					{
						setloader();
						if(suc['success']=='true')
						{
							$('.requestType').val('CONSUMED');
							$('#consume_popup').modal('toggle');
							$('#success_modal').modal();
							$('.nav-tabs a[href="#inventory_history"]').tab('show');
							setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
							load_page('inventoryHistory','inventory_history','&requestType=CONSUMED');
						}
						else
						{
							$('#error_head').html('Error!');
							$('#error_body').html('Quantity available :'+suc['data']);
							$('#error_message').modal();
							setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
						}
					}
		})
	}
})