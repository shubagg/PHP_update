//This variable gets all coordinates of polygone and save them. Finally you should use this array because it contains all latitude and longitude coordinates of polygon.
var server_url = "http://webexperts.info/gmaps/map_report/sampledata/";

var coordinates = [];
var map = '';
//This variable saves polygon.
var polygons = [];
var circle = [];
var circle_coordinates = [];
var rectangle = [];
var rectangle_coordinates = [];
var all_coordinates = [];
var markers = [];
var selectedShape1='';
var directionsDisplay ='';
var directionsService = '';
var details = '';
var selectedShape = '';
var mouse_click_latlng = [];

//This function save latitude and longitude to the polygons[] variable after we call it.
function save_coordinates_to_array(polygon,settings)
{
    var polygonBounds = polygon.getPath();
    var cord = '';
    coordinates = [];
   
    for(var i = 0 ; i < polygonBounds.length ; i++)
    {
        cord += ' Lat : ' + polygonBounds.getAt(i).lat() + ' Lng : ' + polygonBounds.getAt(i).lng() + ',';
        coordinates.push({"lat":polygonBounds.getAt(i).lat(),"lng":polygonBounds.getAt(i).lng()});
    } 
    
    var flag = 0;
    for(var j = 0;j < all_coordinates.length; j++)
    {
        if(all_coordinates[j]['zindex_id']==polygon.zIndex)
        {
            all_coordinates[j]["coordinates"] = coordinates;
            all_coordinates[j]["type"] = "polygon";
            all_coordinates[j]["all_data"] = polygon;
            flag = 1;
            break;
        }
        
    }
    if(flag == '0')
    {
        var n_polygon =  {"zindex_id":polygon.zIndex,"type":"polygon","coordinates":coordinates,"all_data":polygon,"SettingArray":settings}
        all_coordinates.push(n_polygon);
    }
    //////console.log(all_coordinates);
   
}

function save_coordinates_to_circle(circle,settings)
{
    var cord = '';
    coordinates = [];
    
    var lat = circle.getCenter().lat();
    var lng = circle.getCenter().lng(); 
    coordinates.push({'lat':lat,'lng': lng});
    var flag = 0;
    for(var j = 0;j < all_coordinates.length; j++)
    {
        if(all_coordinates[j]['zindex_id']==circle.zIndex)
        {
                
                all_coordinates[j]["coordinates"] = coordinates;
                all_coordinates[j]["radius"] = circle.getRadius();
                all_coordinates[j]["type"] = "circle";
                all_coordinates[j]["all_data"] = circle;
                flag = 1;
                
                break;
                
                
        }
    }
    if(flag == '0')
    {
        var n_circle =  {"zindex_id":circle.zIndex,"type":"circle","coordinates":coordinates,"radius":circle.getRadius(),"all_data":circle,"SettingArray":settings}
        all_coordinates.push(n_circle);
    }
    //////console.log(all_coordinates);
   
}


function save_coordinates_to_direction(direction_route)
{
    
    var cord = '';
    coordinates = [];
    
    
    var direction_route1 = direction_route.routes[0]['legs'];
    st_lat = direction_route1[0]['start_location'].lat();
    st_lng = direction_route1[0]['start_location'].lng();
    
    en_lat = direction_route1[0]['end_location'].lat();
    en_lng = direction_route1[0]['end_location'].lng();
     
    coordinates.push({'st_lat':st_lat,'st_lng': st_lng,'en_lat':en_lat,'en_lng': en_lng});
    ////console.log(coordinates);
    var flag = 0;
    for(var j = 0;j < all_coordinates.length; j++)
    {
        if(all_coordinates[j]['zindex_id']==0)
        {
                
                all_coordinates[j]["coordinates"] = coordinates;
                all_coordinates[j]["type"] = "road_fence";
                all_coordinates[j]["all_data"] = selectedShape;
                flag = 1;
                
                break;
                
                
        }
    }
    if(flag == '0')
    {
        var n_road_fence =  {"zindex_id":0,"type":"road_fence","coordinates":coordinates,"all_data":selectedShape}
        all_coordinates.push(n_road_fence);
    }
    
        console.log(all_coordinates);
        
    
    
   
}

function save_coordinates_to_rectangle(rectangle,Setting)
{
    var cord = '';
    coordinates = [];
   var ne = rectangle.getBounds().getNorthEast();
   var sw = rectangle.getBounds().getSouthWest();
   
    coordinates.push({'ne_lat':ne.lat(),'ne_lng':ne.lng(),'sw_lat': sw.lat(),'sw_lng': sw.lng()});
    var flag = 0;
    for(var j = 0;j < all_coordinates.length; j++)
    {
        if(all_coordinates[j]['zindex_id']==rectangle.zIndex)
        {
                
                all_coordinates[j]["coordinates"] = coordinates;
                all_coordinates[j]["type"] = "rectangle";
                all_coordinates[j]["all_data"] = rectangle;
                flag = 1;
                break;
               
        }
    }
    
    if(flag == '0')
    {
        var n_rectangle =  {"zindex_id":rectangle.zIndex,"type":"rectangle","coordinates":coordinates,"all_data":rectangle,"SettingArray":Setting}
        all_coordinates.push(n_rectangle);
    }
   //////console.log(all_coordinates);
}


var center='';
var map = null;
var mapDefaults = '';

var infoWindow='';

function initialize(latpr)
{    
  
 // console.log("pp"+latpr); 
  
    /*if(latpr.length>0)
    {
      mapDefaults = {
          zoom: 12,
          center: new google.maps.LatLng(gLat, gLng)
      };
    }
    else
    {
    
        mapDefaults = {
          zoom: 12,
          center: new google.maps.LatLng(gLat, gLng)
      };
    }*/
    if(latpr!=undefined && latpr!=null)
    {
      mapDefaults = {
          zoom: 12,
          center: new google.maps.LatLng(latpr[0]['lat'], latpr[0]['lng'])
      };
    }
    else
    {
      mapDefaults = {
          zoom: 12,
          center: new google.maps.LatLng(gLat, gLng)
      };  
    }
    

     

    map = new google.maps.Map(document.getElementById('Gmap'), mapDefaults);

  /* if(latpr!=undefined && latpr!=null)
    {
     var marker1 = new google.maps.Marker({
            position: new google.maps.LatLng({lat: parseFloat(gLat), lng: parseFloat(gLng) }),
            map: map,
            icon:admin_ui_url+'traking/marker_icon_img/running.png'
          });
    }*/




    infoWindow = new google.maps.InfoWindow();
    
     directionsService = new google.maps.DirectionsService;
     directionsDisplay = new google.maps.DirectionsRenderer({
            draggable: true,
            map:map,
            //panel: document.getElementById('right-panel')
    });

  //**************************************Direction*************/
  directionsDisplay.addListener('directions_changed', function() {
    
        selectedShape = directionsDisplay;
       // console.log(selectedShape);
        computeTotalDistance(directionsDisplay.getDirections());
  });
  
 

  //*************************Latitute Longitude on Map Click*******************

 /* google.maps.event.addListener(map, 'click', function( event ){
    
    var latitutelongitute = event.latLng.lat()+','+event.latLng.lng();
        mouse_click_latlng.push(latitutelongitute);
        mouse_click_latlng.push(latitutelongitute);
        if(mouse_click_latlng.length==2)
        {
            create_road_fence();
            
        }
           
  //alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng() ); 
});    
   */



  //displayRoute('dwarka,new delhi', 'janakpuri,new delhi', directionsService,directionsDisplay);
    
    polyOptions = {
          strokeWeight: 3,
          fillOpacity: 0.45,
          fillColor : '#008000',
          strokeColor : '#008000',
          editable: true,
          draggable:true
        };
     polylineOptions = {
          strokeWeight: 3,
          fillOpacity: 0.45,
          fillColor : '#008000',
          strokeColor : '#008000',
          editable: true,
          draggable:true
        };   
    circle_Options = {
          strokeWeight: 3,
          fillOpacity: 0.45,
          fillColor : '#008000',
          strokeColor : '#008000',
          editable: true,
          draggable:true
        };
        
    rectangleOptions = {
          strokeWeight: 3,
          fillOpacity: 0.45,
          fillColor : '#008000',
          strokeColor : '#008000',
          editable: true,
          draggable:true
        };
    //Create a drawing manager panel that lets you select polygon, polyline, circle, rectangle or etc and then draw it.
    drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
            drawingModes: [
                google.maps.drawing.OverlayType.CIRCLE,
                google.maps.drawing.OverlayType.POLYGON,
                google.maps.drawing.OverlayType.RECTANGLE]

        },
    });
    
    drawingManager.setMap(map);

    //This event fires when creation of polygon is completed by user.
    google.maps.event.addDomListener(drawingManager, 'circlecomplete', function(circle)
    {
        circle.setEditable(true);
        circle.setDraggable(true);
        var d = new Date();
        var n = d.getTime();
        ////console.log(n);
        //var infowindow = new google.maps.InfoWindow();
        //var service = new google.maps.places.PlacesService(map);

        circle.setOptions({ zIndex: n });
        ////console.log(circle.zIndex);
        selectedShape1 = 'circle';
        save_coordinates_to_circle(circle)
        
        google.maps.event.addListener(circle, 'radius_changed', function () {
           selectedShape1 = 'circle';
            save_coordinates_to_circle(circle)
            });
    
        google.maps.event.addListener(circle, 'center_changed', function () {
           selectedShape1 = 'circle';
            save_coordinates_to_circle(circle)
            });
        
        google.maps.event.addListener(circle, 'click', function (event) {
            

            //console.log("circle");
            selectedShape = circle;
            fence_setting(selectedShape);
            });
        
        
        
        drawingManager.setDrawingMode(null);
    });
     
    //*****************************Drawing mode change*******************
        google.maps.event.addListener(drawingManager, "drawingmode_changed", function(e) {
        

            if(document.getElementById('single').checked)
            {
                
                if((drawingManager.drawingMode!=null)&&(selectedShape1!=''))
                {
                    //&&(drawingManager.drawingMode!=selectedShape1
                    ////console.log(drawingManager.drawingMode);
                    ////console.log(selectedShape1);
                    old_all_delete();        
                }    
            }
            
        
        
        
        });
    google.maps.event.addDomListener(drawingManager, 'rectanglecomplete', function(rectangle)
    {
        rectangle.setEditable(true);
        rectangle.setDraggable(true);
        var d = new Date();
        var n = d.getTime();
        ////console.log(n);
        rectangle.setOptions({ zIndex: n });
        selectedShape1 = 'rectangle';
        save_coordinates_to_rectangle(rectangle);
        
        ////console.log(rectangle);
        
        google.maps.event.addListener(rectangle, 'bounds_changed', function() {
            save_coordinates_to_rectangle(rectangle)
            selectedShape1 = 'rectangle';
            
        });
        
        google.maps.event.addListener(rectangle, 'click', function (event) 
        {
          console.log("rectangle");
            selectedShape = rectangle;
            fence_setting(selectedShape);
            selectedShape1 = 'rectangle';
            });
        drawingManager.setDrawingMode(null);
    });
    /*google.maps.event.addDomListener(drawingManager, 'polylinecomplete', function(polyline)
    {
        ////console.log(polyline);
    });*/
    
            
    google.maps.event.addDomListener(drawingManager, 'polygoncomplete', function(polygon)
    {
        
        polygon.setEditable(true);
        polygon.setDraggable(true);
        var d = new Date();
        var n = d.getTime();
        ////console.log(n);
        polygon.setOptions({ zIndex: n });
        selectedShape1 = 'polygon';
        
        save_coordinates_to_array(polygon);
        
        google.maps.event.addListener(polygon.getPath(), 'set_at', function () {
           selectedShape1 = 'polygon';
            save_coordinates_to_array(polygon);
            });

       
        google.maps.event.addListener(polygon.getPath(), 'insert_at', function (){
        selectedShape1 = 'polygon';
            save_coordinates_to_array(polygon);
            });
            
       google.maps.event.addListener(polygon, 'click', function (event) {
           
            selectedShape1 = 'polygon';
            selectedShape = polygon;
            fence_setting(selectedShape);
            });
        
        drawingManager.setDrawingMode(null);

    });
    
  
    google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
    
}
//**********************************Create Functions*****************************
//====================================
function create_polygon(poly_cord,z_index,details,setting)
{

    var d = new Date();
    var n = d.getTime();
    
    polygon = new google.maps.Polygon({
    paths: poly_cord,
   /* strokeWeight: 3,
    fillOpacity: 0.45,
    fillColor : '#008000',
    strokeColor : '#008000',*/
    zIndex:n,
    editable:true,
    draggable:true,
    map: map,
   
  });
  
  polygon.setMap(map);
  save_coordinates_to_array(polygon,setting);
        
        google.maps.event.addListener(polygon.getPath(), 'set_at', function () {
           //selectedShape1 = 'polygon';
            save_coordinates_to_array(polygon,setting);
            });

       
        google.maps.event.addListener(polygon.getPath(), 'insert_at', function (){
        //selectedShape1 = 'polygon';
            save_coordinates_to_array(polygon,setting);
            });
            
       google.maps.event.addListener(polygon, 'click', function (event) {
            
            //selectedShape1 = 'polygon';
            selectedShape = polygon;
            fence_setting(selectedShape);
            });
    drawingManager.setDrawingMode(null);
}
//====================================
function create_circle(cir_cord,rad,z_index,gg,settings)
{
      var d = new Date();
      var n = d.getTime();
      circle = new google.maps.Circle({
      /*strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,*/
      center: {"lat":parseFloat(cir_cord[0]['lat']),"lng":parseFloat(cir_cord[0]['lng'])},
      radius: rad,
      editable:true,
      draggable:true,
      zIndex:n,
      map: map
    });
    circle.setMap(map);
   
    save_coordinates_to_circle(circle,settings)
        
       google.maps.event.addListener(circle, 'radius_changed', function () {
           //selectedShape1 = 'circle';
            save_coordinates_to_circle(circle,settings)
            });
    
        google.maps.event.addListener(circle, 'center_changed', function () {
          // selectedShape1 = 'circle';
            save_coordinates_to_circle(circle,settings)
            });
        
        google.maps.event.addListener(circle, 'mouseover', function (event) {

            var location = event.latLng;
            show_infowindow(location,settings);
                
          });


        google.maps.event.addListener(circle, 'click', function (event) {
            
            selectedShape = circle;
            fence_setting(selectedShape);
            });
      drawingManager.setDrawingMode(null);
}
//====================================
function create_rectangle(rec_cord,z_index,dt,settings)
{
    var d = new Date();
    var n = d.getTime();
    rectangle = new google.maps.Rectangle({
    /*strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 1,*/
    editable:true,
    draggable:true,
    map: map,
    zIndex:n,
    bounds: {
      north: rec_cord[0]['ne_lat'],
      south: rec_cord[0]['sw_lat'],
      east: rec_cord[0]['ne_lng'],
      west: rec_cord[0]['sw_lng'],
      }
    
  });
  rectangle.setMap(map);
  save_coordinates_to_rectangle(rectangle,settings);
        
        //////console.log(rectangle);
        
        google.maps.event.addListener(rectangle, 'bounds_changed', function() {
            save_coordinates_to_rectangle(rectangle,settings)
            //selectedShape1 = 'rectangle';
            
        });
        
        google.maps.event.addListener(rectangle, 'click', function (event) {
            
            selectedShape = rectangle;
            fence_setting(selectedShape);
            //selectedShape1 = 'rectangle';
            });
  
  drawingManager.setDrawingMode(null);
}
//*****************************End Create Functions************************

//*******************Route Display or Making route******************
   
function displayRoute(start, end, service, display) 
{
    
  service.route({
    origin: start,
    destination: end,
    //waypoints: [{location: 'Cocklebiddy, WA'}, {location: 'Broken Hill, NSW'}],
    travelMode: google.maps.TravelMode.DRIVING,
    //avoidTolls: true
    
    }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) 
    {
       fitBounds = true;
       directionsDisplay.setOptions( { preserveViewport: true } );
       display.setDirections(response);
    } 
    else
    {
      alert('Could not set directions due to: ' + status);
    }
  });
  mouse_click_latlng = [];
}

function computeTotalDistance(result) {
  var total = 0;
 

  save_coordinates_to_direction(result)
  document.getElementById('total').innerHTML = '';
  var myroute = result.routes[0];
  for (var i = 0; i < myroute.legs.length; i++)
  {
    total += myroute.legs[i].distance.value;
   // console.log("value of i"+i);
 //   console.log(myroute.legs[i].distance.value);
    
  }
  total = total / 1000;
  document.getElementById('total').innerHTML = total + ' km';
}
//******************

//**************function for delete selected shape****************
//============================================
function deleteSelectedShape() 
{

    if (selectedShape) 
    {
       for(var i = 0; i < all_coordinates.length; i++)
       {
            if((all_coordinates[i]['zindex_id']==selectedShape.zIndex)||(all_coordinates[i]['zindex_id']==selectedShape.routeIndex))
            {
                all_coordinates.splice(i, 1);
                selectedShape.setMap(null);
                ////console.log(all_coordinates);    
            }
            
            
       } 
      
      
    }
    
}
//==================Re-Initialize Map====================
function re_initialize() 
{
    initialize();
    
}
//==================Delete All====================
function old_all_delete() 
{
   
    var cord_length = all_coordinates.length;
    ////console.log(cord_length);
    
       for(var i = 0; i < cord_length; i++)
       {
        ////console.log("value of i"+i);
            selectedShape = all_coordinates[i]['all_data'];
            console.log(selectedShape);
            if(selectedShape)
            {
                selectedShape.setMap(null);
                   
            }
            
       } 
      all_coordinates = [];
      //selectedShape = '';
}







//===================get_all_data===============
function get_all_cordinates()
{
    
    var new_all_coordinates = [];    
    for(var j=0; j < all_coordinates.length; j++)
    {   
        var coordinates = all_coordinates[j]['coordinates'];
        var type = all_coordinates[j]['type'];
        var SettingArray=all_coordinates[j]['SettingArray'];
        if(type=='circle')
        {
        	var radius=all_coordinates[j]['radius'];
        	new_all_coordinates.push({coordinates,type,radius,SettingArray});
        }
        else
        {
        	new_all_coordinates.push({coordinates,type,SettingArray});
        }
        
    }
    new_all_coordinates = {"location":new_all_coordinates,"s_type":"4"};
    
    save_geofence(JSON.stringify(new_all_coordinates));
}

var fence_status = '1';
function show_geofence()
{
  gLat  = 23.644524198;
  gLng  = 77.958984375;
    $.ajax({
        
        url:admin_ui_url+"add_geofence/ajax/get_geofence_data.php",
        data:{'userId':userId,'mid':mid,'smid':smid,'iid':iid},
        type:'post',
        success:function(suc)
        {
          console.log('suc:----'+suc);
        	if(suc!='false')
        	{

		            path = JSON.parse(suc);
                if(path['status']!='undefined' && path['status']!=null)
                {
                  fence_status = path['status'];
                }
                
               // console.log("path"+path);
                if((path.length>0)&&(path[0]['data']))
                {


  		            path=JSON.parse(path[0]['data']);
  		            path = path['location'];

  		            var n_cord = '';
  		            var n_radius = '';
  		    		    var settings='0';
  		        //    console.log("path-----"+(path[0]['coordinates'][0]['lat']));
                  if(path!='')
                    { var mlat = path[0]['coordinates'][0]['lat'];
                      var mlng = path[0]['coordinates'][0]['lng'];
                      var ldt=[{'lat':mlat,'lng':mlng}];  
                      initialize(ldt);
                    }
                  else
                    { 
                      var ldt=[{'lat':gLat,'lng':gLng}]; 
                      initialize(ldt); 
                    }
                //    console.log("ldt-----"+JSON.stringify(ldt));
  		            for(var i=0; i<path.length;i++)
  		            {
  		                ////console.log("length"+path.length);
  		                switch(path[i]['type'])
  		                {
  		                
  		                    case "polygon":
  		                    n_cord = path[i]['coordinates'];
  		                    z_index = path[i]['zindex_id'];
  		                    details = path[i]['all_data'];
  		                    settings=path[i]['SettingArray'];
  		                    create_polygon(n_cord,z_index,details,settings);
  		                    break;
  		                    
  		                    case "circle":
  		                    
  		                    n_cord = path[i]['coordinates'];
  		                    n_radius = path[i]['radius'];
  		                    z_index = path[i]['zindex_id'];
  		                    details = path[i]['all_data'];
  		                    settings=path[i]['SettingArray'];
  		                    create_circle(n_cord,n_radius,z_index,details,settings);
                          
                          break;
  		                    
  		                    case "rectangle":
  		                    n_cord = path[i]['coordinates'];
  		                    z_index = path[i]['zindex_id'];
  		                    details = path[i]['all_data'];
  		                    settings=path[i]['SettingArray'];
  		                    create_rectangle(n_cord,z_index,details,settings);
  		                    break;
  		                    
  		                    case "road_fence":
  		                    
  		                    
  		                    n_cord = path[i]['coordinates'];
  		                    z_index = path[i]['zindex_id'];
  		                    details = path[i]['all_data'];
  		                    var start1 = [n_cord[0]['st_lat'],n_cord['st_lng']];
  		                    var end1 = [n_cord['en_lat'],n_cord['en_lng']];
  		                    displayRoute(start1,end1,directionsService,directionsDisplay);
  		                    break;
  		                    
  		                    
  		                       
  		                }   
  		            }
    		    }
            else
            {
              var ar=[{'lat':gLat,'lng':gLng}];
              initialize(ar);
            }
        }
        else
        {
          var ar=[{'lat':gLat,'lng':gLng}];
          initialize(ar);
        }
	}
    
        
})
  
}



function show_infowindow(location,settings)
{

     infoWindow.setContent('Name : '+settings['title']+"  <br/> Description : "+settings['desc']);
     infoWindow.setPosition(location);
     infoWindow.open(map);
}


function create_road_fence()
{
    
    displayRoute(mouse_click_latlng[0],mouse_click_latlng[1],directionsService,directionsDisplay);
    
}
