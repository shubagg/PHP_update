<?php
	function location_webservice_manage_location()
	{
		$postvar = get_post_data();
		$result = manage_location($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}

	function location_webservice_search_location()
	{
		$postvar = get_post_data();
		$result = find_location_radius($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}

	function location_webservice_distance_item()
	{
		$postvar = get_post_data();
		$result = find_location_two($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
		/*$mode = "road";
		if(!isset($postvar['module1'])||!isset($postvar['item1'])||!isset($postvar['item_id1'])||!isset($postvar['module2'])||!isset($postvar['item2'])||!isset($postvar['item_id2']))
		{
			rs("","116","false");
		}
		if(isset($postvar['mode']))
			$mode = $postvar['mode'];

		$tmp = find_location_two($postvar['module1'],$postvar['item1'],$postvar['item_id1'],$postvar['module2'],$postvar['item2'],$postvar['item_id2'],$mode);
		if($tmp==410||$tmp==411||$tmp==409)
			rs("","{$tmp}","false");
		else
			rs($tmp);*/
	}

	function location_webservice_distance_coordinates()
	{
		$postvar = get_post_data();
		$mode = "road";
		if(!isset($postvar['lat1'])||!isset($postvar['lng1'])||!isset($postvar['lat2'])||!isset($postvar['lng2']))
		{
			rs("","116","false");
		}
		if(isset($postvar['mode']))
			$mode = $postvar['mode'];

		$origin = array();
		$destination = array();

		$origin['lat']=$postvar['lat1'];
		$origin['lng']=$postvar['lng1'];
		$destination['lat']=$postvar['lat2'];
		$destination['lng']=$postvar['lng2'];

		$tmp = find_location_lat_long($origin,$destination,$mode);
		if($tmp==410||$tmp==411||$tmp==409)
			rs("","{$tmp}","false");
		else
			rs($tmp);
	}

	function location_webservice_delete_location()
	{
		$postvar = get_post_data();
		$result = delete_location($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}

	function location_webservice_getaddress()
	{
		$postvar = get_post_data();
		$result = getaddress($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}

	function location_webservice_getcoordinates()
	{
		$postvar = get_post_data();
		$result = getcoordinates($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}

	function location_webservice_get_location_by_id()
	{
		$postvar = get_post_data();
		$result = get_location_by_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}
	function geo_webservice_get_geofence()
	{
		$postvar = get_post_data();
		$result = get_geofence($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}
	function location_webservice_get_country()
	{
		$postvar = get_post_data();
		$result = get_country($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}


	function location_webservice_get_states()
	{
		$postvar = get_post_data();
		$result = get_states($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}

	function location_webservice_get_cities()
	{
		$postvar = get_post_data();
		$result = get_cities($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}
	
	function location_webservice_manage_states()
	{
		$postvar = get_post_data();
		$result = manage_states($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}
	function location_webservice_manage_city()
	{
		$postvar = get_post_data();
		$result = manage_city($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}
	
	function location_webservice_delete_country_state_cities_by_tablename()
	{
		$postvar = get_post_data();
		$result = delete_country_state_cities_by_tablename($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"11");
	}
	
?>