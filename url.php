<?php
$url1=array(
	
	'dashboard'=>admin_ui_urls().'dashboard',
	'userDetail'=>admin_ui_urls().'accountSetup/userDetail',
	'addUser'=>admin_ui_urls().'accountSetup/addUser',
	
	'loginDetail'=>admin_ui_urls().'accountSetup/loginDetail',
	'urgency'=>admin_ui_urls().'systemSetup/urgency',
	'changePassword'=>admin_ui_urls().'systemSetup/changePassword',

	'manage_account'=>admin_ui_urls().'notification/manageAccount',
	'AddAccount'=>admin_ui_urls().'notification/manageAccount/AddAccount',
	'manage_template'=>admin_ui_urls().'notification/manageTemplate',
	'manage_trigger'=>admin_ui_urls().'notification/manageTrigger',
	'manage_broadcast'=>admin_ui_urls().'notification/manageMroadcast',

	'message'=>admin_ui_urls().'message',
	'messageList'=>admin_ui_urls().'messageList',
	'formList'=>admin_ui_urls().'formList',
	'form_report'=>admin_ui_urls().'history/formReport',
	'formdetail'=>admin_ui_urls().'fillupForm/formDetail',
    'createpersonnel'=>admin_ui_urls().'sendforApproval',
    'closenotify'=>admin_ui_urls().'closenotify',
    'fillupForm'=>admin_ui_urls().'fillupForm',
    'printForm'=>admin_ui_urls().'printForm',

    'stat_report'=>admin_ui_urls().'stat_report',

    'profile'=>admin_ui_urls().'profile',
    'language'=>admin_ui_urls().'language',
    'notification'=>admin_ui_urls().'notification',
    'hierarchy'=>admin_ui_urls().'hierarchy',
    'cron'=>admin_ui_urls().'notification/cron',
    'timeTrigger'=>admin_ui_urls().'notification/timeTrigger',
    'cronLogs'=>admin_ui_urls().'notification/cronLogs',
    'cronStatus'=>admin_ui_urls().'notification/cronStatus',
    'manageTimeTrigger'=>admin_ui_urls().'notification/manageTimeTrigger',
     
     'home'=>site_url().'home',
	'staff-favorite'=>site_url().'staff-favorite',
	'best-seller'=>site_url().'best-seller',
	'on-sale'=>site_url().'on-sale',
	'contact_us'=>site_url().'contact_us',
	'blogs'=>site_url().'blogs',
	"brands"=>site_url().'brands',
	'unsubscribe'=>site_url().'unsubscribe',
	'all-products'=>site_url().'products',
	"product_type"=>site_url().'type',
	"bag"=>site_url().'bag',
	'filter'=>site_url().'filter',
	'account'=>site_url().'account',
	'order_history'=>site_url().'order_history',
	'wish_list'=>site_url().'wish_list',
	'logout'=>site_url().'logout',
	'search'=>site_url().'search',
	'return_policy'=>site_url().'return_policy',
	'privacy'=>site_url().'privacy',
	'terms'=>site_url().'terms_and_conditions',
	'about_us'=>site_url().'about_us',
	'product_type_details'=>site_url().'10004',
	'brand_details'=>site_url().'brands',
	'product_details'=>site_url().'10003',
	'products'=>site_url().'products',
	'gift_card'=>site_url().'gift_card',
	'category'=>site_url().'10001',
	'category-products'=>site_url().'10002',
	'view-all-category-products'=>site_url().'10005',
	'payment_error'=>site_url().'payment-error',
	'dashboard'=>admin_ui_urls().'dashboard',
	'allproduct'=>admin_ui_urls().'products',
	'view_product'=>admin_ui_urls().'products/view_product',
	'manage_product_types'=>admin_ui_urls().'all_product/manage_product_type',
	'manageproduct'=>admin_ui_urls().'products/manage_product',
	'manage_product'=>admin_ui_urls().'products/manage_product',
	'manageproducttype'=>admin_ui_urls().'products/manage_product_type',
	'all_invoice'=>admin_ui_urls().'all_invoice',
	'all_customer'=>admin_ui_urls().'customer',
	'add_customer'=>admin_ui_urls().'customer/edit_customer',
	'edit_customer_all'=>admin_ui_urls().'all_customer/edit_customer',
	'current_order'=>admin_ui_urls().'current_order',
	'pre_order'=>admin_ui_urls().'pre_order',
	'shipped_order'=>admin_ui_urls().'shipped_order',
	'shipped_order_view'=>admin_ui_urls().'shipped_order/view_shipped_order',
	'failed_order'=>admin_ui_urls().'failed_order',
	'track_order'=>admin_ui_urls().'track_order',
	'failed_order'=>admin_ui_urls().'failed_order',
	'all_user'=>admin_ui_urls().'all_user',
	'add_user'=>admin_ui_urls().'add_user',
	'edit_add_user'=>admin_ui_urls().'all_user/edit_user',
	'manage_password'=>admin_ui_urls().'manage_password',
	'reports'=>admin_ui_urls().'reports',
	'product_categories'=>admin_ui_urls().'product_categories',
	'manage_category'=>admin_ui_urls().'product_categories/manage_category',
	'sub_category'=>admin_ui_urls().'product_categories/sub_category',
	'all_tag'=>admin_ui_urls().'all_tag',
	'all_brand'=>admin_ui_urls().'brands',
	'manage_brand'=>admin_ui_urls().'brands/manage_brand',
	'manage_brand_edit'=>admin_ui_urls().'all_brand/edit_brand',
	'manage_coupon'=>admin_ui_urls().'coupons/manage_coupon',
	'all_coupan'=>admin_ui_urls().'coupons',
	'apply_coupan'=>admin_ui_urls().'apply_coupan',
	'all_discount'=>admin_ui_urls().'all_discount',
	'add_discount'=>admin_ui_urls().'coupons/manage_coupon',
	'add_discount_first'=>admin_ui_urls().'all_discount/add_discount',
	'apply_discount'=>admin_ui_urls().'apply_discount',
	'banner'=>admin_ui_urls().'banner',
        'banner_info'=>admin_ui_urls().'banner_info',
	'add_banner'=>admin_ui_urls().'banner/add_banner',
	'add_banner1'=>admin_ui_urls().'add_banner',
	'list'=>admin_ui_urls().'list',
	'subscribe'=>admin_ui_urls().'subscribe',
	'manage_newsletter'=>admin_ui_urls().'newsletter',
	'cms'=>admin_ui_urls().'cms',
	'setting'=>admin_ui_urls().'setting',
	'shippment'=>admin_ui_urls().'shipment',
	'shippment_price'=>admin_ui_urls().'shipment_price',
	'social_setting'=>admin_ui_urls().'social_setting',
	'sms'=>admin_ui_urls().'sms',
	'enquiry_setting'=>admin_ui_urls().'enquiry_setting',
	'manage_account'=>admin_ui_urls().'manage_account',
	'manage_template'=>admin_ui_urls().'manage_template',
	'manage_trigger'=>admin_ui_urls().'manage_trigger',
	'myblog'=>admin_ui_urls().'blogs',
	'manage_blog'=>admin_ui_urls().'blogs/manage_blog',
	'blog_comment'=>admin_ui_urls().'blogs/comment',
	'blog_category'=>admin_ui_urls().'blogs/category',
	'manage_blog_category'=>admin_ui_urls().'blogs/category/manage_category',
	'trigger'=>admin_ui_urls().'trigger',
	'template'=>admin_ui_urls().'template',
	'account_admin'=>admin_ui_urls().'account',
	'btrigger'=>admin_ui_urls().'newsletter/send_newsletter',
 	'add_banneredit'=>admin_ui_urls().'banner/edit_banner',
	'all_discounta'=>admin_ui_urls().'all_discount/edit_discount',
 	'view_invoice'=>admin_ui_urls().'all_invoice/view_invoice',
    'admin_gift_card'=>admin_ui_urls().'products/gift_card',
    'country'=>admin_ui_urls().'country/country',
    'return_product'=>admin_ui_urls().'return_products',
    'return_product_view'=>admin_ui_urls().'return_products/product',
    'options'=>admin_ui_urls().'product/options',


    'manage_timesheet'=>admin_ui_urls().'timesheet/manage_timesheet',
    'timesheet_listing'=>admin_ui_urls().'timesheet/manage_timesheet'

	
	);

function get_url($urlKey)
{
	global $url1;
	return $url1[$urlKey];
}
?>

