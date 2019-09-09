<?php
	$app->post('/manage_event','event_webservice_manage_event');
    $app->post('/get_event_by_id','event_webservice_get_event_by_id');
    $app->post('/delete_event','event_webservice_delete_event');

    //category webservice
    $app->post('/manage_event_category','event_webservice_manage_event_category');
    $app->post('/get_event_category_by_id','event_webservice_get_event_category_by_id');
?>