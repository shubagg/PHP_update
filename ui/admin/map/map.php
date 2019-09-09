<?php 


 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

if(isset($_GET['date']))
{
	function getalldateform($dateformat)
	{
		$dateformats =explode("/",$dateformat);
		
		$d=$dateformats['2'];
        $y=$dateformats['0'];
        $m=$dateformats['1'];
		return $y."-".$m."-".$d;      

	}
		$viewdatesrch=getalldateform($_GET['date']);
    	$fromdate=getalldateform($_GET['date']);
	    $todate=getalldateform($_GET['date']); 
		$fromdate=$fromdate." 00:00";
		$todate=$todate." 23:59";
		$fromdate= strtotime($fromdate);
		$todate= strtotime($todate);
    	$attdetail=curl_post("/get_attendance_report",array("userId"=>$_SESSION['user']["user_id"],"from"=>$fromdate,"to"=>$todate,"status"=>"tracking"));
    	$attendence_map= json_encode($attdetail["data"]);
}


 include_once(include_admin_template("map","map")); ?>



	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>admin/plugins/gmaps/gmaps.js"></script>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var url_img="<?php echo assets_url(); ?>";
var jsonResult='<?php echo $attendence_map; ?>';
var map;
var markers=[];

$(document).ready(function (){


	
function focus_on_map(lat,lng)
{
	var myLatLng = new google.maps.LatLng(lat,lng);
	map = new GMaps({
        		el: '#googleMap',
        		lat: lat,
        		lng: lng,
        		zoom:15,
        		center: myLatLng,
        		panControl: false,
        		scrollwheel: true,
        		zoomControl: true,
        		mapTypeControl:false
        		

      });	
}


      
function add_marker(id,lat,lng,address)
{
	
	var tmp = map.addMarker({
		lat: lat,
		lng: lng,
		title: address,
		mouseover: function(e)
		{
		
		},
		infoWindow: {
		content: '<p> lat = '+lat+' </p> <p> long = '+lng+' </p> <p> Address = '+address+' </p>'
		} 
		});    
    
}

function call_map_attendence()
{
	
    var parseresult=JSON.parse(jsonResult);
    var lengthofmap=parseresult.length;
    for(si=0;si<lengthofmap;si++ )
    {
         
         var id= parseresult[si]['id'];
         var lat=parseresult[si]['lat'];
         var lng=parseresult[si]['lng'];
         var address=parseresult[si]['address'];
         if(si==0)
         {
         	focus_on_map(lat,lng);
         }

        add_marker(id,lat,lng,address);
    }
   
}
	call_map_attendence();

});
</script>


<?php get_admin_footer(); ?>
