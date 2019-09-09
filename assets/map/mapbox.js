
document.write('<link href="https://api.mapbox.com/mapbox.js/v3.1.0/mapbox.css" async rel="stylesheet" />');
document.write('<script type="text/javascript" src="https://api.mapbox.com/mapbox.js/v3.1.0/mapbox.js" async ></script>');
var mainMap={};
function init_map(data)
{

	var map = '';
	L.mapbox.accessToken = 'pk.eyJ1IjoidmlwaW5hcm9yYSIsImEiOiJjajJsZmZnbDgwMDBlMndwZjVvZzNkYXI5In0.8OVtLCj9eWrjrnp_1jFOxQ';
	
	
	if(data && data['div_id'] && data['div_id']!='')
	{
		div_id = data['div_id']
	}
	else
	{
		div_id = 'map';
	}

	map = L.mapbox.map(div_id, 'mapbox.streets');
	if(data)
	{
		if((data['lat']) && (data['lat'] != "") && (data['lng']) && (data['lng'] != "" ))
	    {
	    	var lat =  parseFloat(data['lat']);
	    	var lng =  parseFloat(data['lng']);	
	    }
	    else
	    {
	    	var lat = 28.508471;
	    	var lng = 77.091087;
	    }
	    if((data['zoom']) && (data['zoom'] != ''))
	    {
	    	var zoom = parseInt(data['zoom']);
	    }
	    else
	    {
	    	var zoom = 5;
	    }
	
	}
	else
	{ 
		var lat = 28.508471;
	    var lng = 77.091087;
	    var zoom = 5;
	}
	    
	map.setView([lat, lng], zoom);	
	
    if(data && data['click'] && data['click'] != "")
    {
    	map.on('mouse click', function(e) {
    	window[data['click']](e);
    	});
    }
	if(data && data['dblclick'] && data['dblclick'] != "")
    {
    	map.on('mouse dbclick', function(e) {
    	window[data['dblclick']](e);	
    	});
    }
	mainMap[data['div_id']]=map;
} 

function add_markers(data)
{
	var map = mainMap[data['div_id']];
	if(data && data['lat'] && data['lat']!="" && data['lng'] && data['lng']!="")
	{
		var lat = (data && data['lat'] && data['lat']!='') ? data['lat'] : '';
		var lng = (data && data['lng'] && data['lng']!='') ? data['lng'] : '';
		var id = (data && data['id'] && data['id']!='') ? data['id'] : '';
		var icon = (data && data['icon'] && data['icon']!='') ? data['icon'] : '';

		

		
		if(icon!='')
		{
			lat = parseFloat(lat);
			lng = parseFloat(lng);
			var marker = L.marker([lat, lng], {
			  icon :  L.icon( {
		            iconUrl : icon,
		        } )  
			});
		}
		else
		{
			lat = parseFloat(lat);
			lng = parseFloat(lng);
			var marker = L.marker([lat, lng], {
			  
			});
		}
		if(id!='')
		{
			marker._leaflet_id = id;	
		}
		
		
		if(data && data['bind'] && data['bind'] != "")
	    {
	    	marker.bindPopup(data['bind']);
	    }

		if(data && data['click'] && data['click'] != "")
	    {
	    	marker.on('mouse click', function(e) {
	    	window[data['click']](e);
	    	});
	    }	
	    if(data && data['dblclick'] && data['onDbClick'] != "")
	    {
	    	marker.on('mouse dblclick', function(e) {
	    	window[data['dblclick']](e);
	    	});
	    }
	    if(data && data['mouseover'] && data['mouseover'] != "")
	    {
	    	marker.on('mouseover', function(e) {
	    	window[data['mouseover']](e);
	    	});
	    }
		
		if(markers[marker._leaflet_id] == undefined)
		{
			marker.addTo(map);
			markers[marker._leaflet_id] = marker;
		}
		else
		{
			var dataWrapper = [];
			dataWrapper['div_id']=data['div_id'];
			dataWrapper['id']=marker._leaflet_id;
			remove_marker(dataWrapper);
			 setTimeout(function(){ 
			 	marker.addTo(map);
				markers[marker._leaflet_id] = marker;
			 }, 500);
		}	
		
			
	}
	

}
function remove_marker(data)
{
	var map = mainMap[data['div_id']];
	map.removeLayer(markers[data['id']]);
	if(markers[data['id']] != undefined)
	{
		delete markers[data['id']];
	}
}
function remove_all_markers(data)
{

	var map = mainMap[data['div_id']];
		$.each(markers, function( index, value ) {
			if(markers[index] != undefined)
			{
				try{
					map.removeLayer(markers[index]);
					delete markers[index];
				}
				catch(err){
					console.log(err);
				}
	        } 
		});	
		
	
}
function maptoPan(data)
{
	var map = mainMap[data['div_id']];
	if(data && data['lat'] && data['lng'] && data['lat']!="" && data['lng']!="")
	{
		var latLng = new L.LatLng(data['lat'], data['lng']);
   		map.panTo(latLng);	
	}	
   
}
function fitbound(data)
{
	var map = mainMap[data['div_id']];
	map.fitBounds(data['data']);
}
function update_marker(data)
{
	var map = mainMap[data['div_id']];
	if(data && data['icon'] && data['icon']!="")
	{
		var myNewIcon = L.icon({
    	iconUrl: 'http://img2.wikia.nocookie.net/__cb20130315134107/disney/es/images/2/24/ChickenLittle.png'
		});	
		markers[data['id']].setIcon(myNewIcon);
	}
	if(data && data['lat'] && data['lng'] && data['lat']!="" && data['lng']!="")
	{
		var newLatLng = new L.LatLng(data['lat'], data['lng']);
    	markers[data['id']].setLatLng(newLatLng); 	
	}
	
}




