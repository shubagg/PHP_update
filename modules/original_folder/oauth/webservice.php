<?php
	$app->post('/get_oauth_token','oauth_webservice_get_oauth_token');
	$app->post('/verify_token','oauth_webservice_verify_token');
	$app->post('/refresh_token','oauth_webservice_refresh_token');

	$app->post('/get_hexa_permissions','oauth_webservice_get_hexa_permissions');
	$app->post('/check_hexa_permission','oauth_webservice_check_hexa_permission');
	
?>