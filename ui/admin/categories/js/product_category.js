function validation_successfull(frm)
{
	switch(frm)
	{
		case "manageCategory":
			//var formData=$('#manageCategory').serialize();
			var formData = new FormData($('#'+frm)[0]);
			$.ajax({
				url:admin_ui_url+"categories/ajax/manage_product_category.php",
				data:formData,
				async: false,
				type:"POST",
				success:function(suc)
						{
							suc=JSON.parse(suc);
							if(suc['success']=='true')
							{
								
								if(suc['error_code']=='1600023')
								{
									$('#manageCategory')[0].reset();
									$('#model_des').html('Department Added Successfully');
									$('#success_modal').modal();
									//setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
									setTimeout(function(){ window.location=site_url+"admin/product_categories"; },1000);
								}
								else
								{
									$('#model_des').html('Department Updated Successfully');
									$('#success_modal').modal();
									//setTimeout(function(){ location.reload(); },1000);
									setTimeout(function(){ window.location=site_url+"admin/product_categories"; },1000);
								}
								
							}
							else
							{
								var error_code=suc['error_code'];
								if(error_code=='117')
								{
									if(suc['data'][0]['field']=='title')
									{
										$('#etitle').html('Category '+suc['data'][0]['value']+' already exists');
									}
									if(suc['data'][1]['field']=='title_ar')
									{
										$('#etitle_ar').html('Category '+suc['data'][1]['value']+' already exists');
									}
								}
							}
						},cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
			})
		break;
	}
}

function delete_category_temp(id)
{
	$('#deletType').html('<button type="button" onclick="delete_product_category(\''+id+'\')" class="btn btn-theme-inverse"> Ok</button>');
	$('#sure_to_delete').modal();
}

function delete_product_category(id)
{
	$('#sure_to_delete').modal('toggle');
	$.ajax({
		url:admin_ui_url+"categories/ajax/delete_product_category.php",
		data:"id="+id,
		type:"POST",
		success:function(suc)
				{
					suc=JSON.parse(suc);
					if(suc['success']=='true')
					{
						$('#model_des').html('Category Deleted Successfully');
						$('#success_modal').modal();
						setTimeout(function(){ location.reload(); },1000);
					}
					else
					{

						var errorHtml='Error Code '+suc['error_code'];
						if(suc['error_code']=='1600033')
						{
							errorHtml='';
							var dependent=[];
							var data=suc['data'];
							if(data['products']>0){ errorHtml+='Total Products Available = '+data['products']+"<br/>"; dependent.push("products"); }
							if(data['subCategory']>0){ errorHtml+='Total SubCategories Available = '+data['subCategory']+"<br/>"; dependent.push("SubCategories"); }
							errorHtml+="Delete Dependent "+dependent.join(' AND ');
						}

						$('#model_des').html(errorHtml);
						$('#success_modal').modal();
						setTimeout(function(){ $('#success_modal').modal('toggle'); },2000);
					}
				}
	})
}

function cancel_product_category(){
	 window.location=product_categories;
}

