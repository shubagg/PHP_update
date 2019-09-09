<?php
	
	$app->post('/manage_location','location_webservice_manage_location');
	$app->post('/search_location','location_webservice_search_location');
	$app->post('/delete_location','location_webservice_delete_location');
	$app->post('/getaddress','location_webservice_getaddress');
	$app->post('/getcoordinates','location_webservice_getcoordinates');
	$app->post('/get_location_by_id','location_webservice_get_location_by_id');

        $app->post('/get_country','location_webservice_get_country');
	$app->post('/get_states','location_webservice_get_states');
	$app->post('/get_cities','location_webservice_get_cities');
	$app->post('/get_geofence','geo_webservice_get_geofence');
	$app->post('/manage_states','location_webservice_manage_states');
	$app->post('/manage_city','location_webservice_manage_city');
	$app->post('/delete_country_state_cities_by_tablename','location_webservice_delete_country_state_cities_by_tablename');


	//$app->post('/find_distance_item','location_webservice_distance_item');
	//$app->post('/find_distance_coordinates','location_webservice_distance_coordinates');
?>