<?php
	$app->post('/add_chatroom','add_chatroom_webservice');
	$app->post('/add_chatroom_user','add_chatroom_user_webservice');
    $app->post('/adduserinchat','adduserinchat_webservice');
    $app->post('/getuserinchat','getuserinchat_webservice');
    $app->post('/deleteuserinchat','deleteuserinchat_webservice');
    $app->post('/manage_user_chat_activity','chat_webservice_manage_user_chat_activity');
    $app->post('/get_all_chat_user','chat_webservice_get_all_chat_user');

    $app->post('/get_friend_data_by_id','resource_webservice_get_friend_data_by_id');  // logger done
    $app->post('/manage_chat_user','resource_webservice_manage_chat_user');  // logger done
    $app->post('/delete_chat_user_data','resource_webservice_delete_chat_user_data');  // logger done
    
?>