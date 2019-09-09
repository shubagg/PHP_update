<?php 

include_once('../../../global.php');
include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

//  $attdetail=curl_post("/get_user_tracking",array("mid"=>$_GET['mid'],"smid"=>$_GET['smid'],"iid"=>$_GET['iid'],"userId"=>$_GET['userId'],"fromDate"=>$_GET['fromDate'],"toDate"=>$_GET['toDate']));
 
 // $attendence_map= json_encode($attdetail["data"]['userdata']); // remove the bellow code to $atttendence_map..

  $attendence_map='[{"userId":"5655b59a9c76843009000001","lat":"28.635504","lng":"77.053996","status":"tracking","createdOn":{"sec":1454394650,"usec":631000},"chk":"0","address":"delhi","id":"56b04d1aa32974201b3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.635810","lng":"77.053814","status":"tracking","createdOn":{"sec":1454394682,"usec":38000},"chk":"0","address":"delhi","id":"56b04d3aa329747d193c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.635939","lng":"77.053739","status":"tracking","createdOn":{"sec":1454394697,"usec":215000},"chk":"0","address":"delhi","id":"56b04d49a32974201b3c986a"},{"userId":"5655b59a9c76843009000001","lat":"28.636078","lng":"77.053640","status":"tracking","createdOn":{"sec":1454394711,"usec":19000},"chk":"0","address":"delhi","id":"56b04d57a32974d20a3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.636565","lng":"77.053363","status":"tracking","createdOn":{"sec":1454394729,"usec":290000},"chk":"0","address":"delhi","id":"56b04d69a32974810a3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.636852","lng":"77.053197","status":"tracking","createdOn":{"sec":1454394745,"usec":564000},"chk":"0","address":"delhi","id":"56b04d79a32974db1d3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.637022","lng":"77.053082","status":"tracking","createdOn":{"sec":1454394760,"usec":509000},"chk":"0","address":"delhi","id":"56b04d88a329747e0a3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.637163","lng":"77.052974","status":"tracking","createdOn":{"sec":1454394773,"usec":99000},"chk":"0","address":"delhi","id":"56b04d95a32974e31b3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.636622","lng":"77.051572","status":"tracking","createdOn":{"sec":1454405637,"usec":923000},"chk":"0","address":"","id":"56b07805a3297404493c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.637432","lng":"77.048160","status":"tracking","createdOn":{"sec":1454405689,"usec":165000},"chk":"0","address":"","id":"56b07839a32974d1443c9869"}]';

 include_once(include_admin_template("map","track")); ?>


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 

<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js">
</script> 

<script type="text/javascript" src="<?php echo assets_url();?>admin/plugins/gmaps/gmaps.js"></script> 



<script> 

var ui_url='<?php echo ui_url();?>'; 
var admin_ui_url='<?php echo admin_ui_url();?>'; 
var url_img="<?php echo assets_url(); ?>"; 
var jsonResult='<?php echo $attendence_map; ?>'; 
var map;
var markers=[];
var flightPath=[];  
var setshowtime=0;




$(document).ready(function (){

map = new GMaps({
            el: '#Gmap',
            lat: 28.613939,
            lng: 77.209021,
            zoom:15,
            panControl: false,
            scrollwheel: true,
            zoomControl: true,
            mapTypeControl:false
            

      });   
  function make_polyline_points(time1)
  {
    var parseresult=JSON.parse(jsonResult);
    var path_leng = parseresult.length;
    if(path_leng>2)
    {
      var y = 0;
      for(var x=0;x<path_leng-2;x++)
      { 
          y++;

          delay_route(parseresult[x]['lat'],parseresult[x]['lng'],parseresult[y]['lat'],parseresult[y]['lng'],time1);
         
      }
      y++; 
      delay_route(parseresult[x]['lat'],parseresult[x]['lng'],parseresult[y]['lat'],parseresult[y]['lng'],time1);
     
  }

}

var i =1;

function delay_route(olat,olng,dlat,dlng,time1)
{
  if(i==1)
  {
    pan(dlat,dlng);
  }
  var lineSymbol = {path: google.maps.SymbolPath.FORWARD_OPEN_ARROW,scale: 2,
strokeWeight:2,
strokeColor:"#B40404"};

  map.travelRoute({
    origin: [olat, olng],
    destination: [dlat, dlng],
    travelMode: 'driving',
    step: function(e){
        
      
        setTimeout(function(coords) 
        {

          var poly_tmp = map.drawPolyline({
            path: coords.path,
            strokeColor: '#131540',
            strokeOpacity: 1,
            strokeWeight: 1,
            icons: [{
            icon: lineSymbol,
            offset: '100%',
            scale:1,
            geodesic: true,
            // repeat:'50%',

            }]
          });
          flightPath.push(poly_tmp);
        }, time1*i++, e);
    }
  });
    
}
function pan(lt,lg)
{
    var panPoint = new google.maps.LatLng(lt, lg);
    map.panTo(panPoint)
}

    make_polyline_points(setshowtime);

});


function again_call_map()
{
    
  
  map = new GMaps({
            el: '#Gmap',
            lat: 28.613939,
            lng: 77.209021,
            zoom:15,
            panControl: false,
            scrollwheel: true,
            zoomControl: true,
            mapTypeControl:false
            

      });   
  function make_polyline_point(time1)
  {
    var parseresult=JSON.parse(jsonResult);
    var path_leng = parseresult.length;
    if(path_leng>2)
    {
      var y = 0;
      for(var x=0;x<path_leng-2;x++)
      { 
          y++;

          delay_routes(parseresult[x]['lat'],parseresult[x]['lng'],parseresult[y]['lat'],parseresult[y]['lng'],time1);
         
      }
      y++; 
      delay_routes(parseresult[x]['lat'],parseresult[x]['lng'],parseresult[y]['lat'],parseresult[y]['lng'],time1);
     
  }

}

var i =1;

function delay_routes(olat,olng,dlat,dlng,time1)
{
  if(i==1)
  {
    pans(dlat,dlng);
  }
  var lineSymbol = {path: google.maps.SymbolPath.FORWARD_OPEN_ARROW,scale: 2,
strokeWeight:2,
strokeColor:"#B40404"};

  map.travelRoute({
    origin: [olat, olng],
    destination: [dlat, dlng],
    travelMode: 'driving',
    step: function(e){
        
      
        setTimeout(function(coords) 
        {

          var poly_tmp = map.drawPolyline({
            path: coords.path,
            strokeColor: '#131540',
            strokeOpacity: 1,
            strokeWeight: 1,
            icons: [{
            icon: lineSymbol,
            offset: '100%',
            scale:1,
            geodesic: true,
            // repeat:'50%',

            }]
          });
          flightPath.push(poly_tmp);
        }, time1*i++, e);
    }
  });
   
}
function pans(lt,lg)
{
    var panPoint = new google.maps.LatLng(lt, lg);
    map.panTo(panPoint)
}
   make_polyline_point(1000);
}

</script>


<?php get_admin_footer(); ?>
