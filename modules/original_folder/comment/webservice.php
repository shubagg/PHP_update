<?php
	$app->post('/manage_like','comment_webservice_manage_like');
    $app->post('/get_count','comment_webservice_get_count');//to get count of a single aiid of any type
    $app->post('/manage_rating','comment_webservice_manage_rating');
    $app->post('/get_user_rating','comment_webservice_get_user_rating');//user array
    $app->post('/get_aiid_rating','comment_webservice_get_aiid_rating');//aiid array
    
    $app->post('/manage_comment','comment_webservice_manage_comment');
    $app->post('/update_comment_status','comment_webservice_update_comment_status');
    $app->post('/delete_comment','comment_webservice_delete_comment');
    $app->post('/get_comments','comment_webservice_get_comments');
    $app->post('/get_comment_by_id','comment_webservice_get_comment_by_id');
    
    $app->post('/manage_comment_data','comment_webservice_manage_comment_data');
    $app->post('/get_comment_data','comment_webservice_get_comment_data');
?>