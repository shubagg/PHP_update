<?php
switch(ENVIROMENT_ACCESS)
{
	case "1": // Teamerge Server
	
		$cdnMediaUrl='https://storage.googleapis.com/tmtuploads-files/';
		$assets_url = "https://storage.googleapis.com/tmassets/"."assets/"; 
		$project_specific_assets=$site_url ."custom_assets/"; // Project based css and Js
		$admin_assets_url ="https://storage.googleapis.com/tmassets/"."assets/admin/";
		$custom_js_url=$site_url . "company/js/";   //js which we are using on each module
		//$font_icon_access_url="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
		$font_icon_access_url=$site_url."assets/admin/css/font-awesome/font-awesome.min.css";
		
		//Mongo Settings
		define("MONGO_HOST","mongodb://10.140.0.4");
		define("MONGO_USER",'');
		define("MONGO_PASS",'');
		define("MONGO_DB",'teammerge'.COMPANY_ID);
		// Mysql Settings 	
		define("MYSQL_HOST",'10.140.0.4');
		define("MYSQL_USER",'root');
		define("MYSQL_PASS",'TM@123');
		define("MYSQL_DB",'teammerge'.COMPANY_ID);	
		
		$ex_location_url = 'http://111.93.125.78/location_records/manage_address.php';
		$log_ui = new KLogger($new_log_file_url, KLogger::DEBUG,1);
		$log = new KLogger($new_log_file_url, KLogger::DEBUG,2);	
		
		define("MEDIA_ACCESS_URL",$cdnMediaUrl . "$companyId/");
		define("OAUTH_URL","http://localhost/oauth/demo/");
		define("CLIENT_ID","testclient");
		define("CLIENT_SECRET","testpass");
	break;
	
	case "2":  // Development server 203
		$cdnMediaUrl = $site_url;
		$assets_url = $site_url ."assets/"; 
		$project_specific_assets=$site_url ."custom_assets/"; // Project based css and Js
		$admin_assets_url = $assets_url . "admin/";
		$custom_js_url=$site_url . "company/js/";   //js which we are using on each module
		$font_icon_access_url=$site_url."assets/admin/css/font-awesome/font-awesome.min.css";
		
		
		//Mongo settings
		define("MONGO_HOST",'');
		define("MONGO_USER",'');
		define("MONGO_PASS",'');
		define("MONGO_DB",'teammerge'.COMPANY_ID);
		// Mysql Settings
		define("MYSQL_HOST",'localhost');
		define("MYSQL_USER",'root');
		define("MYSQL_PASS",'xeliumtech123');
		define("MYSQL_DB",'teammerge'.COMPANY_ID);
		
		$log_ui = new KLogger($new_log_file_url, KLogger::DEBUG,1);
		$log = new KLogger($new_log_file_url, KLogger::DEBUG,2);
		$ex_location_url = 'http://111.93.125.78/location_records/manage_address.php';

		
		define("MEDIA_ACCESS_URL",$cdnMediaUrl . "uploads/$companyId/");
		define("OAUTH_URL","http://localhost/oauth/demo/");
		define("CLIENT_ID","testclient");
		define("CLIENT_SECRET","testpass");
	break;
	
	default: //localhost 
		$cdnMediaUrl = $site_url;
		$assets_url = $site_url ."assets/"; 
		$project_specific_assets=$site_url ."custom_assets/"; // Project based css and Js
		$admin_assets_url = $assets_url . "admin/";
		$custom_js_url=$site_url . "company/js/";   //js which we are using on each module
		$font_icon_access_url=$site_url."assets/admin/css/font-awesome/font-awesome.min.css";
		
		
		
		define("MONGO_HOST",'mongodb://127.0.0.1:27017');
		define("MONGO_USER",'');
		define("MONGO_PASS",'');
		define("MONGO_DB",'teammerge'.COMPANY_ID);
			
		define("MYSQL_HOST",'localhost');
		define("MYSQL_USER",'root');
		define("MYSQL_PASS",'');
		define("MYSQL_DB",'teammerge'.COMPANY_ID);
		
		$log_ui = new KLogger($new_log_file_url, KLogger::DEBUG,1);
		$log = new KLogger($new_log_file_url, KLogger::DEBUG,2);
		$ex_location_url = 'http://111.93.125.78/location_records/manage_address.php';

		
		
		define("MEDIA_ACCESS_URL",$cdnMediaUrl . "uploads/$companyId/");
		define("OAUTH_URL","http://111.93.125.78/oauth/demo/");
		define("CLIENT_ID","testclient");
		define("CLIENT_SECRET","testpass");
	break;	
}
?>