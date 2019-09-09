function print_log(msg,dt){
	//alert(msg+" : "+JSON.stringify(dt));
	console.log(msg+" : "+JSON.stringify(dt));
}
var categoryAutoSelect='';
var productAutoSelect='';
var quantityAutoSelect='';

$('.manageInventoryButton').live('click',function(){
	$('#manage_inventory_list_table').DataTable().clear().draw();
	stock_in_form_data=[];
	totalTempStock=1;
	$('#manage_inventory_list_modal').modal();
});

$('.allocateInventoryButton').live('click',function(){
	$('#manage_allocation_list_table').DataTable().clear().draw();
	inventoryAvailable={};
	allocation_form_data=[];
	totalTempAllocation=1;
	categoryAutoSelect='';
	productAutoSelect='';
	quantityAutoSelect='';
	$('#itemsAllocate').removeAttr('readonly');
	$('#quantityAllocate').removeAttr('readonly');
	$('#productCategoryAllocation').removeAttr('readonly');
	$('#itemsAllocate').css('pointer-events','all');
	$('#productCategoryAllocation').css('pointer-events','all');
	$('#manage_allocation_list_modal').modal();
});

function allocateInventoryButton(categoryId,productId,quantity){
	categoryAutoSelect=categoryId;
	productAutoSelect=productId;
	quantityAutoSelect=quantity;
	$('#manage_allocation_list_table').DataTable().clear().draw();
	inventoryAvailable={};
	allocation_form_data=[];
	totalTempAllocation=1;
	$('#manage_allocation_list_modal').modal();
}

$('.add_inventory_button').click(function(){
	$('#stock_in_form')[0].reset();
	$('#manage_inventory_modal').modal();
});

$('.add_allocation_button').click(function(){
	
	$('#allocation_form')[0].reset();
	$('#productCategoryAllocation').val(categoryAutoSelect);
	get_product_allocation(categoryAutoSelect);
	if(productAutoSelect)
	{
		setTimeout(function(){ 

			$('#itemsAllocate').val(productAutoSelect);
			$('#quantityAllocate').val(quantityAutoSelect);
			$('#itemsAllocate').attr('readonly','readonly');
			
			//$('#quantityAllocate').attr('readonly','readonly');
			$('#productCategoryAllocation').attr('readonly','readonly');
			$('#itemsAllocate').css('pointer-events','none');
			$('#productCategoryAllocation').css('pointer-events','none');

			$('#manage_allocation_modal').modal();
		},1000);
	}
	else
	{
		$('#manage_allocation_modal').modal();
	}
	
});


$('#warehouse').change(function(){
	var activeTab = $(".tab-content").find(".active");
	activeTab = activeTab.attr('id');
	update_warehouse_users(this.value);
	$('#tab_'+activeTab).click();
});

function update_warehouse_users(id)
{
	setloader();
	$.ajax({
		url:site_url+"webservices/get_users_by_enroll_itemid",
		data:"itemId="+id+"&proj_group_id="+STORE_USER_ROLE_ID,
		type:"POST",
		dataType:"json",
		success:function(suc)
				{
					setloader();
					var users=suc['data'];
					var html='<option value="">Select User</option>';
					if(suc['success']=='true')
					{
						for(i=0;i<users.length;i++){
							html+='<option value="'+users[i]['id']+'">'+users[i]['name']+'</option>';
						}
					}
					$('#userAllocate').html(html);
				}
	})
}

$('.productCategory').change(function(){
	var categoryIds=this.value;
	//categoryIds=categoryIds.split(",");
	setloader();
	$.ajax({
		url:site_url+"webservices/get_product_by_id",
		data:"id=0&fields=title&status=1&category="+categoryIds,
		dataType : "json",
		type:"POST",
		success:function(suc){
			setloader();
			var products=suc['data'];
			var html='<option value="">Select Item</option>';
			for(i=0;i<products.length;i++)
			{
				html+='<option value="'+products[i]['id']+'">'+products[i]['title']+'</option>';
			}
			$('#items').html(html);
		}
	})
})


var stock_in_form_data=[];
var stock_in_form_data_id=[];
var totalTempStock=1;
var rowHtml="";
$('.stock_in_form_submit').click(function(){
	var check=validation('stock_in_form');
	var t = $('#manage_inventory_list_table').DataTable();
	if(check!=false){
		var available=false;
		for(m=0;m<stock_in_form_data.length;m++)
		{
			if(stock_in_form_data[m]['productId']==$('#items').val() && stock_in_form_data[m]['vendor']==$('#vendor').val()){
				stock_in_form_data[m]['quantity']=parseInt(stock_in_form_data[m]['quantity'])+parseInt($('#quantity').val());
				stock_in_form_data[m]['type']='';
				$('#quantity_'+m).html(stock_in_form_data[m]['quantity']);
				available=true;
			}
		}
		if(!available)
		{
			stock_in_form_data.push({"productCategory":$('#productCategory').val(),"productId":$('#items').val(),"quantity":$('#quantity').val(),"vendor":$('#vendor').val()})
				
				t.row.add( [
		            totalTempStock,
		            $("#items option:selected").text(),
		            $("#productCategory option:selected").text(),
		            "<span id='quantity_"+(totalTempStock-1)+"'>"+$('#quantity').val()+"</span>",
		            $("#vendor option:selected").text(),
		            "<a href='javascript:;' id='row_"+(totalTempStock-1)+"' onclick='deleteTempStock(\""+(totalTempStock-1)+"\")'>Delete</a>"
		        ] ).draw( false );
			totalTempStock++;
		}
		$('#manage_inventory_modal').modal('toggle');
	}
});

function parse_stock_in_form_date(data)
{
	for(m=0;m<data.length;m++)
	{
		if(data[m]['type']=='scanned'){
			data[m]['quantity']=$('#qval_'+m).val();
			data[m]['vendor']=$('#vend_'+m).val();
		}
	}
	return data;
}

$('.add_to_stock').click(function(){
	if(stock_in_form_data.length>0)
	{
		setloader();
		$.ajax({
			url:admin_ui_url+"inventory/ajax/add_to_stock.php",
			data:"stock="+JSON.stringify(parse_stock_in_form_date(stock_in_form_data))+"&warehouseId="+$('#warehouse').val(),
			type:"POST",
			success:function(suc){
				setloader();
				suc=JSON.parse(suc);
				if(suc['success']=='true'){
					$('#manage_inventory_list_table').DataTable().clear().draw();
					stock_in_form_data=[];
					$('#manage_inventory_list_modal').modal('toggle');
					load_page('inventoryStockin','stock_in');
					//reset_datatable('stock_in_dt','productId,productCategory,quantity,createdOn,vendor',$('#warehouse').val(),'datatable_ajax','');
					//reset_datatable('stock_available_dt','productId,productCategory,quantity,createdOn,quantityAvailable,thresholdQuantity,action',$('#warehouse').val(),'available_stock_datatable_ajax','');
					$('#success_modal').modal();
					setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
				}
			}
		})
	}
	else
	{
		$('#error_head').html('Error!');
		$('#error_body').html('Inventory not found');
		$('#error_message').modal();
		setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
	}
})


function deleteTempStock(key)
{
	var t = $('#manage_inventory_list_table').DataTable();
	t.row( $('#row_'+key).parents('tr') ).remove().draw();
	stock_in_form_data.splice(key,1);
	//inventoryAvailable.splice(key,1);
}


//Allocation Of stock
var totalTempAllocation=1;
var allocation_form_data=[];
var inventoryAvailable={};
$('.allocate_form_submit').click(function(){
	var check=validation('allocation_form');
	if(check!=false){
		allocate_inventory_temp('itemsAllocate','productCategoryAllocation','quantityAllocate','userAllocate','job');
	}
})

function allocate_inventory_temp(itemsAllocate,productCategoryAllocation,quantityAllocate,userAllocate,job,type)
{
	if(inventoryAvailable[$('#'+itemsAllocate).val()]<$('#'+quantityAllocate).val())
	{
		$('#error_head').html('Error!');
		$('#error_body').html('Stock Available :'+inventoryAvailable[$('#itemsAllocate').val()]);
		$('#error_message').modal();
		setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
	}
	else
	{
		setloader();
		$.ajax({
			url:site_url+"webservices/check_inventory_available",
			data:"warehouse="+$('#warehouse').val()+"&quantity="+$('#'+quantityAllocate).val()+"&productId="+$('#'+itemsAllocate).val(),
			type:"POST",
			dataType : "json",
			success:function(suc)
					{
						setloader();
						if(suc['success']=='true')
						{
							var t = $('#manage_allocation_list_table').DataTable();
							var job=$("#job :selected").text();
							if($("#job").val()==''){ job=''; }

							var diductPrevious=0;
							if(inventoryAvailable[$('#'+itemsAllocate).val()])
							{
								inventoryAvailable[$('#'+itemsAllocate).val()]=parseInt(inventoryAvailable[$('#'+itemsAllocate).val()])-parseInt(inventoryAvailable[$('#'+itemsAllocate).val()]);
							}
							else
							{
								inventoryAvailable[$('#'+itemsAllocate).val()]=suc['data']-parseInt($('#'+quantityAllocate).val());
							}
							
							allocation_form_data.push({"productId":$('#'+itemsAllocate).val(),"productCategory":$("#"+productCategoryAllocation).val(),"quantity":$('#'+quantityAllocate).val(),"userId":$('#'+userAllocate).val(),"jobId":$("#job").val()});
							if(!job){ job='----'; }
							t.row.add( [
					            totalTempAllocation,
					            $("#"+itemsAllocate+" option:selected").text(),
					            $("#"+productCategoryAllocation+" option:selected").text(),
					            "<span id='aquantity_"+(totalTempAllocation-1)+"'>"+$('#'+quantityAllocate).val()+"</span>",
					            $("#"+userAllocate+" option:selected").text(),
					            job,
					            "<a href='javascript:;' data-quantity='"+$('#'+quantityAllocate).val()+"' data-id='"+$('#'+itemsAllocate).val()+"' id='arow_"+(totalTempAllocation-1)+"' onclick='deleteTempAllocation(\""+(totalTempAllocation-1)+"\")'>Delete</a>"
					        ] ).draw( false );
					        $('#manage_allocation_modal').modal('toggle');
					        totalTempAllocation++;
						}
						else
						{
							$('#error_head').html('Error!');
							if(suc['data']==''){ suc['data']=0; }
							$('#error_body').html('Stock Available :'+suc['data']);
							$('#error_message').modal();
							setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
						}
					}
		})
	}
}

$('.productCategoryAllocation').change(function(){
	var categoryIds=this.value;
	get_product_allocation(categoryIds);
});

function get_product_allocation(categoryIds)
{
	setloader();
	$.ajax({
		url:site_url+"webservices/get_warehouse_product",
		data:"warehouse="+$('#warehouse').val()+"&categoryId="+categoryIds,
		type:"POST",
		dataType : "json",
		success:function(suc){
			setloader();
			var products=suc['data'];
			var html='<option value="">Select Item</option>';
			for(i=0;i<products.length;i++)
			{
				html+='<option value="'+products[i]['id']+'">'+products[i]['title']+'</option>';
			}
			$('#itemsAllocate').html(html);
		}
	})
}

function parse_stock_out_form_date(data)
{
	for(l=0;l<data.length;l++)
	{
		if(data[l]['type']=='scanned'){
			data[l]['quantity']=$('#qaval_'+l).val();
			data[l]['userId']=$('#uallocate_'+l).val();
			data[l]['jobId']=$('#ujob_'+l).val();
		}
	}
	return data;
}

$('.add_to_allocation').click(function(){
	$('.error').html('');
	if(allocation_form_data.length>0)
	{
		setloader();
		$.ajax({
			url:site_url+"webservices/allocate_inventory",
			data:"stock="+JSON.stringify(parse_stock_out_form_date(allocation_form_data))+"&warehouse="+$('#warehouse').val()+"&userId="+currentUserId,
			type:"POST",
			dataType : "json",
			success:function(suc){
				setloader();
				print_log("Allocation",suc);
				if(suc['success']=='true')
				{
					$('#manage_allocation_list_modal').modal('toggle');
					var activeTab = $(".tab-content").find(".active");
					activeTab = activeTab.attr('id');
					if(activeTab=='stock_out'){ load_page('inventoryStockout','stock_out'); }
					if(activeTab=='avail_stock'){ load_page('inventoryAvailable','avail_stock'); }
					
					//reset_datatable('stock_out_dt','productId,productCategory,quantity,createdOn,jobId,allocatedTo,status',$('#warehouse').val(),'stock_out_datatable_ajax','');
					//reset_datatable('stock_available_dt','productId,productCategory,quantity,createdOn,quantityAvailable,thresholdQuantity,action',$('#warehouse').val(),'available_stock_datatable_ajax','');
					$('#success_modal').modal();
					setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
				}
				else
				{
					if(suc['errorcode']=='1601')
					{
						for(lm=0;lm<suc['data'].length;lm++){
							$('.error_'+suc['data'][lm]['productId']).html("Max : "+suc['data'][lm]['max_available']);
						}
					}
					else
					{
						$('#error_head').html('Error!');
						$('#error_body').html('There is some error in :'+suc['data']);
						$('#error_message').modal();
						setTimeout(function(){ $('#error_message').modal('hide'); },2000);
					}
				}
			}
		})
	}
	else
	{
		$('#error_head').html('Error!');
		$('#error_body').html('Data not found');
		$('#error_message').modal();
		setTimeout(function(){ $('#error_message').modal('hide'); },2000);
	}
})

function deleteTempAllocation(key)
{
	var t = $('#manage_allocation_list_table').DataTable();
	var id=$('#arow_'+key).attr('data-id');
	var quantity=$('#arow_'+key).attr('data-quantity');
	inventoryAvailable[id]=parseInt(inventoryAvailable[id])+parseInt(quantity);
	t.row( $('#arow_'+key).parents('tr') ).remove().draw();
	allocation_form_data.splice(key,1);
}


function reject_request(id,type)
{
	setloader();
	$.ajax({
		url:site_url+"webservices/reject_inventory_request",
		data:"id="+id+"&type="+type+"&rejectedBy="+currentUserId,
		type:"POST",
		dataType : "json",
		success:function(suc){
			setloader();
			if(suc['success']=='true')
			{
				if(type=='REQUEST'){ 
					load_page('inventoryRequest','request_stock');
				}
				if(type=='RETURN'){ 
					load_page('inventoryReturn','reurned_stock');
				}
				$('#success_modal').modal();
				setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
			}
			else
			{
				$('#error_head').html('Error!');
				$('#error_body').html('There is some error in :'+suc['data']);
				$('#error_message').modal();
				setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
			}
		}
	})
}

function accept_request(id,type)
{
	setloader();
	$.ajax({
		url:site_url+"webservices/accept_inventory_request",
		data:"id="+id+"&type="+type+"&acceptedBy="+currentUserId,
		type:"POST",
		dataType : "json",
		success:function(suc){
			console.log(suc);
			setloader();
			if(suc['success']=='true')
			{
				if(type=='REQUEST'){ load_page('inventoryRequest','request_stock'); }
				if(type=='RETURN'){ load_page('inventoryReturn','reurned_stock'); }				
				$('#success_modal').modal();
				setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
			}
			else
			{
				$('#error_head').html('Error!');
				if(suc['errorcode']=='1601'){ 
					$('#error_body').html('Stock not available');
				}else{
					$('#error_body').html('There is some error in :'+JSON.stringify(suc['data']));
				}
				$('#error_message').modal();
				setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
			}
		}
	})
}

var currentProductId='';
function inventory_reorder(productId,productTitle)
{
	setloader();
	$('#reorder_inventory_form')[0].reset();
	$('#reorderProductTitle').val(productTitle);
	$('#reorder_inventory_modal').modal();
	$('.error').html('');
	currentProductId=productId;
	$.ajax({
		url:site_url+"webservices/get_inventory_vendors",
		data:"productId="+productId+"&warehouseId="+$('#warehouse').val(),
		type:"POST",
		dataType:"json",
		success:function(suc)
				{
					setloader();
					var vendorsHtml='<option value="">Select Vendor</option>';
					var vendors=suc['data'];
					for(m=0;m<vendors.length;m++){
						vendorsHtml+='<option value="'+vendors[m]['id']+'">'+vendors[m]['name']+'</option>';
					}
					$('#reorderVendor').html(vendorsHtml);
				}
	})
}

$('.reorder_inventory_form_submit').click(function(){
	var check=validation('reorder_inventory_form');
	if(check!=false){
		setloader();
		$.ajax({
			url:site_url+"webservices/reorder_inventory",
			data:"vendor="+$('#reorderVendor').val()+"&quantity="+$('#reorderQuantity').val()+"&userId="+currentUserId+"&productId="+currentProductId,
			type:"POST",
			dataType:"json",
			success:function(suc){
				setloader();
				if(suc['success']=='true')
				{
					$('#reorder_inventory_modal').modal('toggle');
					$('#success_modal').modal();
					$('#model_des').html("Mail Sent to vendor Successfully");
					setTimeout(function(){ $('#success_modal').modal('toggle'); $('#model_des').html("Confirmation Successfull"); },2000);
				}
				else
				{
					$('#error_head').html('Error!');
					$('#error_body').html('There is some error');
					$('#error_message').modal();
					setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
				}
			}
		})
	}
})


function updateProductIdindex(productId,index,type)
{
	if(type==2)
	{
		var i = 0, key;
	    for (key in inventoryAvailable) {	if(i==index){ 
	    	var quantity = $('#aproductId_'+index+' option:selected').attr('data-quantity');
	    	inventoryAvailable[productId]=parseInt(quantity)-1;
	    	$('#quantity_error_'+index).removeClass('error_'+key);
	    	delete inventoryAvailable[key]; }
	        i++;
	    }
		$('#quantity_error_'+index).addClass('error_'+productId);
		$('#qaval_'+index).val(1);
		allocation_form_data[index]['productId']=productId;
	}
	else
	{
		stock_in_form_data[index]['productId']=productId;
	}
}

$("#scannedCode").keyup(function(e) {
    if (e.which == 13) {
       	$('.scanBarcode').html('Scan');
       	var barcode=$('#scannedCode').val();
       	$('#scannedCode').val('');
       	setloader();
       	$.ajax({
       		url:site_url+"webservices/get_scanned_inventory",
       		data:"barcode="+barcode+"&type=2",
       		type:"POST",
       		dataType:"json",
       		success:function(suc){
       			setloader();
       			if(suc['success']=='false' || suc['data'].length==0){
       				$('#error_head').html('Error!');
					$('#error_body').html('Product not available');
					$('#error_message').modal();
					setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
       			}else{
       				var available=false;
       				var multi=false;
       				var product=suc['data'][0];
       				if(suc['data'].length>1){ multi=true;  }
					for(m=0;m<stock_in_form_data.length;m++)
					{
						//alert(stock_in_form_data[m]['productId']+'=='+product['id']+' && '+stock_in_form_data[m]['vendor']+'=='+$('#vendor').val());
						if(stock_in_form_data[m]['productId']==product['id'] && stock_in_form_data[m]['vendor']==$("#vendor option:eq(1)").val()){
							stock_in_form_data[m]['quantity']=parseInt(stock_in_form_data[m]['quantity'])+parseInt(1);
							if(stock_in_form_data[m]['type']==undefined || stock_in_form_data[m]['type']=='')
							{
								$('#quantity_'+m).html(stock_in_form_data[m]['quantity']);
							}
							else
							{
								$('#qval_'+m).val(stock_in_form_data[m]['quantity']);
							}
							available=true;
						}
					}
					if(!available)
					{
	       				var t = $('#manage_inventory_list_table').DataTable();
						stock_in_form_data.push({"productCategory":product['category'].toString(),"productId":product['id'],"quantity":1,"vendor":$("#vendor option:eq(1)").val(),'type':'scanned'})
						var productTitle="<input id='productId_"+(totalTempStock-1)+"' type='hidden'/>"+product['title'];
						if(multi){
							productTitle='';
							productTitle+='<select onchange="updateProductIdindex(this.value,\''+(totalTempStock-1)+'\')" id="productId_'+(totalTempStock-1)+'">';
							for(lc=0;lc<suc['data'].length;lc++){
									productTitle+='<option value="'+suc['data'][lc]['id']+'">'+suc['data'][lc]['title']+'</option>';
							}
							productTitle+='</select>';
						}
							t.row.add( [
					            totalTempStock,
					            productTitle,
					            product['categoryTitle'],
					            "<span id='quantity_"+(totalTempStock-1)+"'><input id='qval_"+(totalTempStock-1)+"' min='1' type='number' value='1'></span>",
					            "<select id='vend_"+(totalTempStock-1)+"'>"+$('#vendor').html()+"</select>",
					            "<a href='javascript:;' id='row_"+(totalTempStock-1)+"' onclick='deleteTempStock(\""+(totalTempStock-1)+"\")'>Delete</a>"
					        ] ).draw( false );

					        $("#vend_"+(totalTempStock-1)).find("option").eq(0).remove();
						totalTempStock++;
					}
       			}
       			$('#scannedCode').val('');
       		}
       	})
    }
});


$("#scannedCode_1").keyup(function(e) {
    if (e.which == 13) {
    	setloader();
       	var barcode=$('#scannedCode_1').val();
       	$('#scannedCode_1').val('');
       	$.ajax({
			url:site_url+"webservices/get_warehouse_product",
			data:"warehouse="+$('#warehouse').val()+"&barcode="+barcode,
			type:"POST",
			dataType : "json",
			success:function(suc){
				setloader();
				if(suc['success']=='false' || suc['data'].length==0)
				{
					$('#error_head').html('Error!');
					$('#error_body').html('Product not available in stock');
					$('#error_message').modal();
					setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
				}
				else
				{	
					print_log("Webservice Return",suc['data']);
					var inventoryAvailableForProduct=[];
					for(k=0;k<suc['data'].length;k++){
						var productTemp=suc['data'][k];
						if(inventoryAvailable[productTemp['id']]>0 || inventoryAvailable[productTemp['id']]==undefined){}
						else{ suc['data'].splice(k,1); }
					}
					print_log("Inventory Available",inventoryAvailable['data']);
					var multi=false;
					if(suc['data'].length>1){ multi=true; }
					var product=suc['data'][0];

					if(inventoryAvailable[product['id']]>0 || inventoryAvailable[product['id']]==undefined)
					{
						var t = $('#manage_allocation_list_table').DataTable();
						var job='';
						var quantity=1;
						var diductPrevious=0;
						print_log("Inventory Available",inventoryAvailable[product['id']]);
						if(inventoryAvailable[product['id']])
						{
							inventoryAvailable[product['id']]=parseInt(inventoryAvailable[product['id']])-parseInt(quantity);
							for(k=0;k<allocation_form_data.length;k++)
							{
								if(allocation_form_data[k]['productId']==product['id']){
									allocation_form_data[k]['quantity']=parseInt(allocation_form_data[k]['quantity'])+1;
									if(allocation_form_data[k]['type']==undefined)
									{
										$('#aquantity_'+k).html(allocation_form_data[k]['quantity']);
									}
									else
									{
										$('#qaval_'+k).val(allocation_form_data[k]['quantity']);
									}
								}
							}
						}
						else
						{
							print_log("Inventory Not Available",inventoryAvailable[product['id']]);
							var productTitle="<input id='aproductId_"+(totalTempAllocation-1)+"' type='hidden'/>"+product['title'];
							if(multi){
								productTitle='';
								productTitle+='<select onchange="updateProductIdindex(this.value,\''+(totalTempAllocation-1)+'\',2)" id="aproductId_'+(totalTempStock-1)+'">';
								for(lc=0;lc<suc['data'].length;lc++){
										productTitle+='<option value="'+suc['data'][lc]['id']+'" data-quantity="'+suc['data'][lc]['inventoryAvailable']+'">'+suc['data'][lc]['title']+'</option>';
								}
								productTitle+='</select>';
							}

							inventoryAvailable[product['id']]=parseInt(product['inventoryAvailable'])-parseInt(quantity);
							allocation_form_data.push({"productId":product['id'],"productCategory":product['category'].toString(),"quantity":1,"userId":"","jobId":"","type":"scanned"});
							t.row.add( [
					            totalTempAllocation,
					            productTitle,
					            product['categoryTitle'],
					            "<input id='qaval_"+(totalTempAllocation-1)+"' style='width: 70px;' min='1' type='number' value='1'><span class='error error_"+product['id']+"' style='font-size: 9px !important;' id='quantity_error_"+(totalTempAllocation-1)+"'></span>",
					            "<select class='popupselectbox' id='uallocate_"+(totalTempAllocation-1)+"'>"+$('#userAllocate').html()+"</select>",
					            "<select class='popupselectbox' id='ujob_"+(totalTempAllocation-1)+"'>"+$('#job').html()+"</select>",
					            "<a href='javascript:;' data-quantity='1' data-id='"+product['id']+"' id='arow_"+(totalTempAllocation-1)+"' onclick='deleteTempAllocation(\""+(totalTempAllocation-1)+"\")'>Delete</a>"
					        ] ).draw( false );
					        $("#uallocate_"+(totalTempAllocation-1)).find("option").eq(0).remove();
					        totalTempAllocation++;
						}
						
				      }
				      else
				      {
			      		$('#error_head').html('Error!');
						$('#error_body').html('Product not available in stock');
						$('#error_message').modal();
						setTimeout(function(){ $('#error_message').modal('hide'); },1000);
				      }
				}
			}
		})
      // 	allocate_inventory_temp(itemsAllocate,productCategoryAllocation,quantityAllocate,userAllocate,job);
    }
});


function reset_scan(id,cl)
{
	if($('#'+id).val()==''){
		$('.'+cl).html('Scan');
	}
}
function validation_successfull(fm){}
function checkalldata(){ }