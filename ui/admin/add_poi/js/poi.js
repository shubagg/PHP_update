  	var map;
  	var marker;
    var allPointers=[];
    var allPointers1=[];
    var allIds=[];
    var mkrs=[];
    function initMap() {

    	var map='';	


	  	if(allData.length > 0){
	  		
	  		var addCenter={lat: gLat, lng: gLng };
	  		if(currentPoi){addCenter={lat: parseFloat(allData[currentPoi]['lat']), lng: parseFloat(allData[currentPoi]['lng']) };}


	  		 map = new google.maps.Map(document.getElementById('Gmap'), {
			    zoom: 15,
			    center: addCenter
			  });
	  		
			setPointerOnMap(allData,map);
		}
		else
		{
			map = new google.maps.Map(document.getElementById('Gmap'), {
			    zoom: 15,
			    center: {lat: gLat, lng: gLng }
			  });
		}

		/* var marker1 = new google.maps.Marker({
            position: new google.maps.LatLng({lat: parseFloat(gLat), lng: parseFloat(gLng) }),
            map: map,
            icon:admin_ui_url+'traking/marker_icon_img/running.png'
          });*/



	  map.addListener('click', function(e) {
	    placeMarkerAndPanTo(e.latLng, map,null,true);
	    var jsn={'lat':e.latLng.lat(),'lng':e.latLng.lng()};
	  	allPointers.push(jsn); 
	  });

	}

	var markers = new Array();
    var iconCounter = 0;
    var latlongs=[];

	function placeMarkerAndPanTo(latLng, map,ind,chdrag) {
	   var d = new Date();
       var n = d.getTime();
       var i=markers.length;
       
	   var marker = new google.maps.Marker({
		        position: new google.maps.LatLng(latLng.lat(),latLng.lng()),
		        draggable: true,
		        map: map
		      });

	   		  var jsn={'id':i,'lat':latLng.lat(),'lng':latLng.lng()};
		      latlongs.push(jsn);	

		      markers.push(marker);

		      google.maps.event.addListener(marker, 'dragend', (function(e, i) {
		        return function() {
		         for(m=0;m<latlongs.length;m++)
		        	{
		        		if(latlongs[m]['id']==i)
		        		{
		        			var jsn1={'id':latlongs[m]['id'],'lat':marker.position.lat(),'lng':marker.position.lng()};
		        			latlongs[m]=jsn1;
		        		}
		        	}
		        }
		      })(marker, i));
		      
		      iconCounter++;
		      // We only have a limited number of possible icon colors, so we may have to restart the counter
		      if(iconCounter >= markers.length) {
		        iconCounter = 0;
		      }


	   if(ind==currentPoi && currentPoi!='')
	   {
	   	marker.setAnimation(google.maps.Animation.BOUNCE);
	   }
	  map.panTo(latLng);
	}

	var infowindow = new google.maps.InfoWindow({
      maxWidth: 160
    });

	function setPointerOnMap(dt,map)
	{
		
		for(i=0;i<dt.length;i++)
		{
			var marker = new google.maps.Marker({
		        position: new google.maps.LatLng(dt[i]),
		        draggable: true,
		        map: map
		      });
				
		      markers.push(marker);
		      var jsn={'id':i,'lat':dt[i]['lat'],'lng':dt[i]['lng']};

		      latlongs.push(jsn);

		      google.maps.event.addListener(marker, 'click', (function(marker, i) {
		        return function() {
		        	infowindow.setContent(dt[i]['creationDate']+"<br/>"+dt[i]['address']);
          			infowindow.open(map, marker);
		        }
		      })(marker, i));


		      google.maps.event.addListener(marker, 'dragend', (function(marker, i) {
		        return function() {
		        	for(m=0;m<latlongs.length;m++)
		        	{
		        		if(latlongs[m]['id']==i)
		        		{
		        			var jsn1={'id':latlongs[m]['id'],'lat':marker.position.lat(),'lng':marker.position.lng()};
		        			latlongs[m]=jsn1;
		        		}
		        	}
		        }
		      })(marker, i));
		      
		      iconCounter++;
		      // We only have a limited number of possible icon colors, so we may have to restart the counter
		      if(iconCounter >= dt.length) {
		        iconCounter = 0;
		      }
		}
	}
	

	function save_pointers(mr,ev)
	{
		for(i=0;i<allIds.length;i++)
		{
			if(allIds[i]==mr.id)
			{
				allPointers1[allIds[i]]=ev;
			}
		}
	}

	function save_all_data()
	{
		
		setloader();
		
		$.ajax({
			url:admin_ui_url+"add_geofence/ajax/manage_geofence.php",
			data:"poiData="+JSON.stringify(latlongs)+"&userId="+atob(userid)+"&mid="+mid+"&smid="+smid+"&iid="+iid,
			type:"POST",
			success:function(suc)
					{
						
						unloading();
						suc=JSON.parse(suc);
						if(suc['success']=='true')
						{
							if(suc['error_code']=='16020')
							{
								$('#model_des').html('POI Updated Successfully');
							}
							if(suc['error_code']=='16022')
							{
								$('#model_des').html('POI Added Successfully');
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

initMap();
