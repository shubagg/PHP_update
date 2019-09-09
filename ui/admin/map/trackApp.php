<?php 

include_once('../../../global.php');
include(lang_url()."global_en.php");

?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/style.css" />
<script src="<?php echo site_url()."ui/js_error.php";?>"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.min.js"></script>
</head>
<body>
  

<?php


  $attdetail=curl_post("/get_user_tracking",array("mid"=>$_GET['mid'],"smid"=>$_GET['smid'],"iid"=>$_GET['iid'],"userId"=>$_GET['userId'],"fromDate"=>$_GET['fromDate'],"toDate"=>$_GET['toDate']));

  //echo json_encode($attdetail);die;
 
  $attendence_map= json_encode($attdetail["data"]['userdata']); // remove the bellow code to $atttendence_map..

  $reloadTime = (isset($_GET['reloadTime']))? $_GET['reloadTime'] : 0;
  //$attendence_map='[{"userId":"5655b59a9c76843009000001","lat":"28.635504","lng":"77.053996","status":"tracking","createdOn":{"sec":1454394650,"usec":631000},"chk":"0","address":"delhi","id":"56b04d1aa32974201b3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.635810","lng":"77.053814","status":"tracking","createdOn":{"sec":1454394682,"usec":38000},"chk":"0","address":"delhi","id":"56b04d3aa329747d193c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.635939","lng":"77.053739","status":"tracking","createdOn":{"sec":1454394697,"usec":215000},"chk":"0","address":"delhi","id":"56b04d49a32974201b3c986a"},{"userId":"5655b59a9c76843009000001","lat":"28.636078","lng":"77.053640","status":"tracking","createdOn":{"sec":1454394711,"usec":19000},"chk":"0","address":"delhi","id":"56b04d57a32974d20a3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.636565","lng":"77.053363","status":"tracking","createdOn":{"sec":1454394729,"usec":290000},"chk":"0","address":"delhi","id":"56b04d69a32974810a3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.636852","lng":"77.053197","status":"tracking","createdOn":{"sec":1454394745,"usec":564000},"chk":"0","address":"delhi","id":"56b04d79a32974db1d3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.637022","lng":"77.053082","status":"tracking","createdOn":{"sec":1454394760,"usec":509000},"chk":"0","address":"delhi","id":"56b04d88a329747e0a3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.637163","lng":"77.052974","status":"tracking","createdOn":{"sec":1454394773,"usec":99000},"chk":"0","address":"delhi","id":"56b04d95a32974e31b3c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.636622","lng":"77.051572","status":"tracking","createdOn":{"sec":1454405637,"usec":923000},"chk":"0","address":"","id":"56b07805a3297404493c9869"},{"userId":"5655b59a9c76843009000001","lat":"28.637432","lng":"77.048160","status":"tracking","createdOn":{"sec":1454405689,"usec":165000},"chk":"0","address":"","id":"56b07839a32974d1443c9869"}]';

 include_once(include_admin_template("map","trackAtt")); ?>


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCpn7vrYggdNI-oHkyDmpd5cFcMeUVuV7U"></script> 

<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js">
</script> 
<script type="text/javascript" src="<?php echo assets_url();?>admin/plugins/gmaps/gmaps.js"></script> 
<style>
.overlay{
  display:block;
  text-align:center;
  color:#fff;
  font-size:13px;
  line-height:15px;
  opacity:0.8;
  background:#4477aa;
  border:solid 3px #336699;
  border-radius:4px;
  box-shadow:2px 2px 10px #333;
  text-shadow:1px 1px 1px #666;
  padding:0 4px;
  width: 200px;
}

.overlay_arrow{
  left:50%;
  margin-left:-16px;
  width:0;
  height:0;
  position:absolute;
}
.overlay_arrow.above{
  bottom:-15px;
  border-left:2px solid transparent;
  border-right:2px solid transparent;
  border-top:2px solid #336699;
}
.overlay_arrow.below{
  top:-15px;
  border-left:2px solid transparent;
  border-right:2px solid transparent;
  border-bottom:2px solid #336699;
}</style>
<style type="text/css">.nav_center{   width: 270px;
    margin-left: 28%;
    height: 50px;
    line-height: 50px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;}


   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;
     border: 2px solid black;
     white-space: nowrap;
   }

</style>

<script> 
var img_url="<?php echo $admin_ui_url;?>map/marker_icon_img/"; 
var jsonResult='<?php echo $attendence_map; ?>';
var reloadTime ='<?php echo $reloadTime;?>';
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
            zoomControl: false,
            mapTypeControl:false
            

      });   


    make_polyline_points(setshowtime);

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

			delay_route(parseresult[x]['lat'],parseresult[x]['lng'],parseresult[y]['lat'],parseresult[y]['lng'],time1,parseresult[y]['address']);

		}
		y++; 
		delay_route(parseresult[x]['lat'],parseresult[x]['lng'],parseresult[y]['lat'],parseresult[y]['lng'],time1,parseresult[y]['address']);

	}

}

var i =1;

function delay_route(olat,olng,dlat,dlng,time1,address)
{
  if(i==1)
  {
	var make_path=JSON.parse(jsonResult);
	var len = make_path.length-1;
	pan(make_path[0]['lat'],make_path[0]["lng"]);
	add_marker_start(5001,make_path[0]['lat'],make_path[0]['lng'],make_path[0]['address'],'start');
	add_marker_start(5001,make_path[len]['lat'],make_path[len]['lng'],make_path[len]['address'],'stopc');
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
            scale:2,
            geodesic: true,
            // repeat:'50%',

            }],
            mouseover: function(e)
            {
                 var location = e.latLng;
              
              var ln = location.lat();
              var lnn = location.lng();
               showadd(ln,lnn,address);

            },
            mouseout: function(e)
            {
              //if(console.log)
              //console.log(e);
              
                map.removeOverlays({});

            }
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

function again_call_map()
{
  map = new GMaps({
            el: '#Gmap',
            lat: 28.613939,
            lng: 77.209021,
            zoom:15,
            panControl: false,
            scrollwheel: true,
            zoomControl: false,
            mapTypeControl:false
            

      });   
	i=1;
   make_polyline_points(1000);
}


if(reloadTime > 0)
{
  	setInterval(function(){ getNewTrackdata()  }, 10000);
}


function getNewTrackdata()
{
    var postdata = "mid=<?php echo $_GET['mid'];?>&smid=<?php echo $_GET['smid'];?>&iid=<?php echo $_GET['iid'];?>&userId=<?php echo $_GET['userId'];?>&fromDate=<?php echo $_GET['fromDate'];?>&toDate=&action=getNewTrackdata";
    var posturl = "<?php echo $admin_ui_url;?>map/ajax/manage_map.php";
    $.ajax({
      url:posturl,
      type:"post",
      data:postdata,
      success:function(suc)
      {
        jsonResult=suc;
        make_polyline_new(0);;
      }
    })
}

function showadd(latg,langg,addg)
{
    map.drawOverlay({
      lat: latg,
      lng: langg,
      content: '<div class="overlay">'+addg+'<div class="overlay_arrow above"></div></div>',
        verticalAlign: 'top',
        horizontalAlign: 'center'
  });
}

function add_marker_start(id,lat,lng,title,img)
{
   
    var tmp = map.addMarker({
    lat: lat,
    lng: lng,
    title: title,
    icon:{ url:img_url+img+'.png'},
    mouseover: function(e)
    {
      if(console.log){}
      //console.log(e);
     // alert('You clicked in this marker'+id);
    },
    infoWindow: {
                    content: title
                }
   

    });            
}	
</script>

