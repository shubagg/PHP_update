
if(typeof(map_type) == 'undefined' || typeof(map_type) == 'null')
{
	
	var map_type = 'mapbox';
}
var map = '';
var markers = [];	

document.write('<script src="'+assets_url+'map/'+map_type+'.js" ></script>');

function initialize_map(data)
{
	init_map(data);
	/*if(data && data['lat'] && data['lng'] && data['lat']!='' && data['lng']!='')
	{
		init_map(data);		
	}*/
}
function add_map_marker(data)
{
	add_markers(data);
}
function remove_map_marker(id)
{
	remove_marker(id);
}
function remove_all_map_marker(data)
{
	remove_all_markers(data);
}
function update_map_marker()
{
	update_marker(data);
}
function map_toPan(data)
{
	maptoPan(data);
}
function map_fitbound(data)
{
	fitbound(data);
}