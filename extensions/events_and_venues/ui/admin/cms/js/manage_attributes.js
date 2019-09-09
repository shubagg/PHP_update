function validation_successfull(frm)
{
	switch(frm)
	{
		case "manageAttribute":
		$('#'+frm).submit();
		break;


		case "manageProductType":
			var allData=$('#'+frm).serialize();
			$.ajax({
				url:admin_ui_url+"brand/ajax/manage_attributes.php",
				data:allData,
				type:"POST",
				success:function(suc)
						{
							suc=JSON.parse(suc);
							if(suc['success']=='true')
							{
								if(suc['error_code']=='1600015')
								{
									$('#model_des').html('Product Type Added Successfully');
									$('#success_modal').modal();
									setTimeout(function(){  location.reload(); },1000);
								}
								else
								{
									$('#model_des').html('Product Type Updated Successfully');
									$('#success_modal').modal();
									setTimeout(function(){ window.location=admin_ui_url+"product/manage_product_type.php"; },1000);
								}
							}
							else
							{
								if(suc['error_code']=='117')
				            	{
				            		if(suc['data'][0]['field']=='title')
									{
										$('#etitle').html('Product Type '+suc['data'][0]['value']+' already exists');
									}
									if(suc['data'][1]['field']=='title_ar')
									{
										$('#etitle_ar').html('Product Type '+suc['data'][1]['value']+' already exists');
									}
				            	}
							}
						}
			})
		break;
	}
}


(function() {
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('#manageAttribute').ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
        },
        success: function() {
            var percentVal = '100%';
        },
        complete: function(xhr) {
            var suc = xhr.responseText.trim();
           // alert(suc);
            suc=JSON.parse(suc);
            if(suc['success']=='true')
            {
            	if(suc['error_code']=='1600015')
				{
					$('#manageAttribute')[0].reset();
					$('#model_des').html('Brand Added Successfully');
					$('#success_modal').modal();
					setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
				}
				else
				{
					$('#model_des').html('Brand Updated Successfully');
					$('#success_modal').modal();
					setTimeout(function(){ window.location=admin_ui_url+"brand/all_brand.php" },1000);
				}
            }
            else
            {
            	if(suc['error_code']=='117')
            	{
            		if(suc['data'][0]['field']=='title')
					{
						$('#etitle').html('Brand '+suc['data'][0]['value']+' already exists');
					}
					if(suc['data'][1]['field']=='title_ar')
					{
						$('#etitle_ar').html('Brand '+suc['data'][1]['value']+' already exists');
					}
            	}
            }
            
        }
    });
})();


function delete_attribute_temp(id)
{
	$('#deletType').html('<button type="button" onclick="delete_attribute(\''+id+'\')" class="btn btn-theme-inverse"> Ok</button>');
	$('#sure_to_delete').modal();
}

function delete_attribute(id)
{
	$.ajax({
		url:admin_ui_url+"brand/ajax/delete_attribute.php",
		data:"id="+id,
		type:"POST",
		success:function(suc)
				{
					suc=JSON.parse(suc);
					if(suc['success']=='true')
					{
						$('#model_des').html('Attribute Deleted Successfully');
						$('#success_modal').modal();
						setTimeout(function(){ location.reload(); },1000);
					}
					else
					{
						$('#model_des').html('Error Code '+suc['error_code']);
						$('#success_modal').modal();
						setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
					}
				}
	})
}
