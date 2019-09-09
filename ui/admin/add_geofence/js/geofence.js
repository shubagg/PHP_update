function save_geofence(data)
{
	//alert("userid--"+userId+"--mid--"+mid+"--iid--"+iid);
	console.log(data);
	$.ajax({
		url:admin_ui_url+"add_geofence/ajax/manage_geofence.php",
		data:"data="+data+"&userId="+atob(userId)+"&mid="+mid+"&smid="+smid+"&iid="+iid+"&status="+fence_status,
		type:"POST",
		success:function(suc)
				{
					//console.log("after suc"+suc);
					suc=JSON.parse(suc);
					if(suc['success']=='true')
					{
						if(suc['error_code']=='16020')
						{
							$('#model_des').html('Geofence Updated Successfully');
						}
						if(suc['error_code']=='16022')
						{
							$('#model_des').html('Geofence Added Successfully');
						}
						$('#success_modal').modal();
						setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
					}
					else
					{
						alert('Not Done');
					}
				}
	})
}


var IndexIdForShape='';
function fence_setting(selectedShape)
{	
	$('.chbox').removeAttr('checked');
	$('.error').html('');
	$('#tolerance').val('');
	$('#title').val('');
	$('#description').val('');
	   
	
	IndexIdForShape=selectedShape;
	for(var i = 0; i < all_coordinates.length; i++)
    {
        if((all_coordinates[i]['zindex_id']==IndexIdForShape.zIndex)||(all_coordinates[i]['zindex_id']==IndexIdForShape.routeIndex))
        {
        	console.log(all_coordinates[i]);
        	if(all_coordinates[i]['SettingArray'])
        	{
           		$('#title').val(all_coordinates[i]['SettingArray']['title']);
           		$('#description').val(all_coordinates[i]['SettingArray']['desc']);
           		$('#tolerance').val(all_coordinates[i]['SettingArray']['tolerance']);
				for(k=0;k<all_coordinates[i]['SettingArray']['type'].length;k++)
				{
					$('#'+all_coordinates[i]['SettingArray']['type'][k]).attr('checked','true');
				}
           	}
        }
    }

	$('#geo_fn').modal();
}


function save_fence_setting()
{
	$('.error').html('');
	var err=0;
	var tolerance=$('#tolerance').val().trim();
	var tp=[];
	var title=$('#title').val().trim();
	var desc=$('#description').val().trim();
	var focusId=[];

	if(title=='')
	{
		$('#etitle').html('*Please enter name');
		err=1;
		focusId.push('title');
	}

	if(desc=='')
	{
		$('#edescription').html('*Please enter description');
		focusId.push('description');
		err=1;
	}

	if(!$('#inward').attr('checked') && !$('#outward').attr('checked'))
	{
		$('#checktype').html('*Please select at least one type');
		err=1;
	}
	

	if($('#inward').attr('checked'))
	{
		tp.push('inward');
	}
	if($('#outward').attr('checked'))
	{
		tp.push('outward');
	}

	if(tolerance=='')
	{
		$('#etolerance').html('*Please add tolerance');
		focusId.push('tolerance');
		err=1;
	}


	if(isNaN(tolerance))
	{
		$('#etolerance').html('*Please add tolerance in numeric');
		$('#tolerance').val('');
		focusId.push('tolerance');
		err=1;
	}

	if(err==0)
	{
		for(var i = 0; i < all_coordinates.length; i++)
        {
            if((all_coordinates[i]['zindex_id']==IndexIdForShape.zIndex)||(all_coordinates[i]['zindex_id']==IndexIdForShape.routeIndex))
            {
               all_coordinates[i]['SettingArray']={'title':title,'desc':desc,'tolerance':tolerance,'type':tp};
               console.log(all_coordinates[i]);    
               $('#geo_fn').modal('toggle');
            }
        } 
	}
	else
	{
		$('#'+focusId[0]).focus();
	}

}