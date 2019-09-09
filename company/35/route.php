<?php
$teamegeRoute = array(
    'dashboard' => 'ui/admin/rpaDashboard/dashboard.php',
    'manage_dashboard' => 'ui/admin/dashboard/manage_dashboard.php',
    'resource' => 'ui/admin/resources/resources.php',
    'resource/user' => 'ui/admin/resources/user.php',
    
    'userDetail' => 'ui/admin/resources/resources.php',
    'changePassword' => 'ui/admin/resources/manage_password.php',
    'loginDetail' => 'ui/admin/resources/logsDetails.php',
    'addUser' => 'ui/admin/resources/user.php',
    'updateUser' => 'ui/admin/resources/user.php',
    'hierarchy' => 'ui/admin/resources/department_hierarchy.php',
    'profile' => 'ui/admin/resources/profile.php',
    'language' => 'ui/admin/resources/language.php',
    'notification' => 'ui/admin/notification/notification.php',
    'cron' => 'ui/admin/notification/cron.php',
    'timeTrigger' => 'ui/admin/notification/timeTrigger.php',
    'cronLogs' => 'ui/admin/notification/cronLogs.php',
    'cronStatus' => 'ui/admin/notification/cronStatus.php',
    'manageTimeTrigger' => 'ui/admin/notification/manageTimeTrigger.php',
    'manageAccount' => 'ui/admin/notification/manage_account.php',
    'manageAccount/AddAccount' => 'ui/admin/notification/account.php',
    'manageTemplate' => 'ui/admin/notification/manage_template.php',
    'manage_inventry' => 'ui/admin/inventory/manage_inventry.php',
    'request_history' => 'ui/admin/inventory/request_history.php',
    'venderInventry' => 'ui/admin/notification/vender_view_inventry.php',
    'storeInventry' => 'ui/admin/notification/store_view_inventry.php',
    'Invoice' => 'ui/admin/notification/invoice_page.php',
    'addInventry' => 'ui/admin/notification/add_inventry.php',
    'allocateInventry' => 'ui/admin/notification/allocate_inventry.php',
    'returnInventry' => 'ui/admin/notification/accept_return_inventry.php',
    'warehouse'=>'ui/admin/inventory/warehouse.php',
    'user_inventry' => 'ui/admin/inventory/user_inventry.php',
    'AddTemplate' => 'ui/admin/notification/template.php',
    'EditTemplate' => 'ui/admin/notification/template.php',
    'manageTrigger' => 'ui/admin/notification/manage_trigger.php',
    'AddTrigger' => 'ui/admin/notification/trigger.php',
    'EditTrigger' => 'ui/admin/notification/trigger.php',
    'manageMroadcast' => 'ui/admin/notification/btrigger.php',
    'message' => 'ui/admin/messages/messages.php',
    'messageList' => 'ui/admin/notification/messageList.php',
    'messageList/Edit' => 'ui/admin/messages/message.php',
    'blog' => 'ui/admin/blog/user_blog.php',
    'blog/blogDetail' => 'ui/admin/blog/user_blog.php',
    'manageblog' => 'ui/admin/blog/myblog.php',
    'viewblog' => 'ui/admin/blog/view_blog.php',
    'blog/view_blog' => 'ui/admin/blog/view_blog.php',
    'myblog' => 'ui/admin/blog/myblogonly.php',

    'manageblog/viewblog' => 'ui/admin/blog/view_blog.php',
    'manageblog/manageblog' => 'ui/admin/blog/myblog.php',
    'manageblog/myblog' => 'ui/admin/blog/myblogonly.php',
    'manageblog/blogcategory' => 'ui/admin/blog/blog_category.php',
    'manageblog/blogassign' => 'ui/admin/blog/blogassign.php',
    'manageblog/manage_blog' => 'ui/admin/blog/manage_blog.php',
    'manageblog/manage_blog_category' => 'ui/admin/blog/manage_blog_category.php',
    'manageblog/blog_comment' => 'ui/admin/blog/blog_comment.php',
    
    'blogcategory' => 'ui/admin/blog/blog_category.php',
    'blogassign' => 'ui/admin/blog/blogassign.php',
    'manage_blog' => 'ui/admin/blog/manage_blog.php',
    'manage_blog_category' => 'ui/admin/blog/manage_blog_category.php',
    'manage_blog' => 'ui/admin/blog/manage_blog.php',
    'blog_comment' => 'ui/admin/blog/blog_comment.php',
    'blog_category' => 'ui/admin/blog/blog_category.php',
    'forum' => 'ui/admin/forum/forum.php',
    'forum/forumanswer' => 'ui/admin/forum/forumanswer.php',
    'forum/askQuestion' => 'ui/admin/forum/ask_question.php',
    'manageform' => 'ui/admin/forum/forum.php',
    //'attendance' => 'ui/admin/attendance/attendance_view.php',
    //'attendance?type=attendance' => 'ui/admin/controller/index.php',
    'controller/index.php' => 'ui/admin/controller/index.php',
    'manage_attendance' => 'ui/admin/attendance/attendance.php',
    'manage_attendance_setting' => 'ui/admin/attendance/manageAttendance.php',
    'attendance_setting' => 'ui/admin/attendance/attendanceSetting.php',
    #project+Ticket+SLM
    'project' => 'ui/admin/project/project.php',
    'ticket_tool' => 'ui/admin/job/service_desk.php',
    'ticket_tool/my_tickets' => 'ui/admin/job/my_tickets.php',
    'ticket_tool/tickers' => 'ui/admin/job/all_ticker.php',
    'ticket_tool/all_tickets' => 'ui/admin/job/all_ticket.php',
    'ticket_tool/ticket_detail' => 'ui/admin/job/ticket_detail.php',
    'slm' => 'ui/admin/sla/sla_list.php',
    'slm/manage_metric' => 'ui/admin/sla/manage_metric.php',
    'slm/metric_detail' => 'ui/admin/sla/sla_detail.php',
    'calendar'=>'ui/admin/calendar/calendar_list.php',
    'calendar/detail'=>'ui/admin/calendar/calendar.php',
    'calendar/add'=>'ui/admin/calendar/add_calendar.php',
    'calendar/edit'=>'ui/admin/calendar/calendar_edit.php',
    
    'products'=>'ui/admin/product/all_product.php',
    'manage_product'=>'ui/admin/product/manage_product.php',
    'all_feature'=>'ui/admin/product/all_feature.php',
    'feature_group'=>'ui/admin/product/feature_group.php',
    'options'=>'ui/admin/product/options.php',
    'featured_product'=>'ui/admin/product/featured_product.php',
    'view_product'=>'ui/admin/product/view_product.php',
    'product_categories'=>'ui/admin/categories/product_categories.php',
    'product_categories/manage_category'=>'ui/admin/categories/manage_category.php',
    'gift_card'=>'ui/admin/product/gift_card.php',
    'brands'=>'ui/admin/brand/all_brand.php',
    'manage_brand'=>'ui/admin/brand/manage_brand.php',
    'cancel_order'=>'ui/admin/order/cancel_order.php',
    'current_order'=>'ui/admin/order/current_order.php',
    'shipped_order'=>'ui/admin/order/shipped_order.php',
    'failed_order'=>'ui/admin/order/failed_order.php',
    'track_order'=>'ui/admin/order/track_order.php',
    'return_products'=>'ui/admin/order/return_products.php',
    'coupons'=>'ui/admin/coupan/all_coupan.php',
    'coupons/manage_coupon'=>'ui/admin/coupan/add_coupan.php',
    'stockist'=>'ui/admin/stockist/stockist.php',
    'shipping'=>'ui/admin/shipping/shipping.php',
    'list'=>'ui/admin/enquiry/list.php',
    'banner'=>'ui/admin/banner/banner.php',
    'banner_info'=>'ui/admin/banner/add_banner.php',
    'banner/add_banner'=>'ui/admin/banner/add_banner1.php',
    'subscribe'=>'ui/admin/subscribe/subscribe.php',
    'blogs'=>'ui/admin/blog/myblog.php',
    'change_password'=>'ui/admin/change_password.php',
    'chat'=>'chat/index.php',
    'report'=>'ui/admin/report/index.php',
    'reportWidget'=>'ui/admin/report/reportWidget.php',
    
    'schedule' => 'ui/admin/schedule/schedule.php',
    'results' => 'ui/admin/results/results.php',
   // 'view' => 'ui/admin/view/view.php',
    'controlTower' => 'ui/admin/controlTower/controlTower.php',
    'chat' => 'ui/admin/chat/chat.php',
    'configuration' => 'ui/admin/configuration/configuration.php',
    'chatBot' => 'ui/admin/chatBot/chatBot.php',
    'contactform' => 'ui/admin/contactform/contactform.php',
    'imagelist' => 'ui/admin/imagelist/imagelist.php',
    'invoicePdf'=>'ui/admin/invoicePdf/invoicePdf.php',
    'licRequest'=>'ui/admin/licenses_management/licenses_request.php',
    'manageLicense'=>'ui/admin/licenses_management/manageLicense.php',
    'poRequest'=>'ui/admin/licenses_management/poRequest.php',
);

function get_route($key) {
    global $folder, $teamegeRoute, $server_path, $ui_string, $extensionRoute,$admin_ui_url,$ui_url;
    if (!empty($teamegeRoute[$key]) || !empty($extensionRoute[$key])) {

        if (!empty($extensionRoute[$key])) {

            $extensionRoute[$key] = explode('?', $extensionRoute[$key]);
            include($extensionRoute[$key][0]);
        } else {
            $teamegeRoute[$key] = explode('?', $teamegeRoute[$key]);
            include($server_path . $teamegeRoute[$key][0]);
        }
    } else {
        
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = str_replace('/' . $folder, $server_path . 'ui', $url[0]);
        //echo $url;  die;
        if (file_exists($url)) {

            include($url);
        } else {
            header("location:".site_url()."admin/404");
          // include(site_url().'ui/admin/404.php');
        }
    }
}
?>