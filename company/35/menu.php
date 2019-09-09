<?php
$menus=array(
	array(
		"mid"=> "39",
		"smid"=>"dashboard",
		"stringId"=> "Dashboard",
		"icon"=> "fa-laptop",
		"menuId"=> "2808",
		"parentId"=> "0",
		"urlTitle"=>"dashboard"
	),
    array(
		"mid"=> "50",
		"stringId"=> "Control Tower",
		"smid"=>"allprocess",
		"icon"=> "fa-spinner",
		"menuId"=> "2801",
		"parentId"=> "0",
		"urlTitle"=>"controlTower"
	),
	array(
		"mid"=> "50",
		"stringId"=> "Configuration",
		"smid"=>"configuration",
		"icon"=> "fa-cog",
		"menuId"=> "200",
		"parentId"=> "0",
		"urlTitle"=>"configuration"
	),
	 
	// array(
		// "mid"=> "50",
		// "stringId"=> "Run",
		// "icon"=> "fa-list-alt",
		// "menuId"=> "2803",
		// "parentId"=> "2801",
		// "urlTitle"=>""
	// ),
	// array(
		// "mid"=> "50",
		// "stringId"=> "Result",
		// "icon"=> "fa-list-alt",
		// "menuId"=> "2804",
		// "parentId"=> "2803",
		// "urlTitle"=>"results"
	// ),
	// array(
		// "mid"=> "50",
		// "stringId"=> "Create",
		// "icon"=> "fa-plus",
		// "menuId"=> "2805",
		// "parentId"=> "2801",
		// "urlTitle"=>""
	// ),
	// array(
		// "mid"=> "50",
		// "stringId"=> "Edit",
		// "icon"=> "fa-edit",
		// "menuId"=> "2806",
		// "parentId"=> "2801",
		// "urlTitle"=>""
	// ),
	array(
		"mid"=> "50",
		"smid"=>"schedule",
		"stringId"=> "Schedule",
		"icon"=> "fa-calendar",
		"menuId"=> "2807",
		"parentId"=> "",
		"urlTitle"=>"schedule"
	),
	array(
		"mid"=> "1",
		"smid"=>"users",
		"stringId"=> "usermanagement",
		"icon"=> "fa-user",
		"menuId"=> "100",
		"parentId"=> "0",
		"urlTitle"=>""
		
	),
	array(
		"mid"=> "1",
		"smid"=>"users",
		"stringId"=> "userDetail",
		"icon"=> "fa-users",
		"menuId"=> "102",
		"parentId"=> "100",
		"urlTitle"=>"userDetail"
		
	),
	array(
		"mid"=> "1",
		"smid"=>"users",
		"stringId"=> "accountmanagement",
		"permissionRequired"=>"manage_password",
		"icon"=> "fa-lock",
		"menuId"=> "103",
		"parentId"=> "100",
		"urlTitle"=>"changePassword"
		
	),
	array(
		"mid"=> "50",
		"smid"=>"contactform",
		"stringId"=> "contact form",
		"icon"=> "fa-eye",
		"menuId"=> "5000",
		"parentId"=> "0",
		"urlTitle"=>"contactform"
	 ),
	array(
		"mid"=> "50",
		"smid"=>"imagelist",
		"stringId"=> "Image List",
		"icon"=> "fa-file-image-o",
		"menuId"=> "5000",
		"parentId"=> "0",
		"urlTitle"=>"imagelist"
	 ),
	array(
		"mid"=> "50",
		"smid"=>"invoicepdf",
		"stringId"=> "Invoice Pdf",
		"icon"=> "fa-laptop",
		"menuId"=> "7808",
		"parentId"=> "0",
		"urlTitle"=>"invoicePdf"
	),

	array(
		"mid"=> "55",
		"smid"=>"licenses",
		"stringId"=> "lic_mgm",
		"icon"=> "fa-laptop",
		"menuId"=> "55000",
		"parentId"=> "0",
		"urlTitle"=>""
	),
	array(
		"mid"=> "55",
		"smid"=>"licenses",
		"stringId"=> "lic_req",
		"icon"=> "fa-laptop",
		"menuId"=> "55001",
		"parentId"=> "55000",
		"urlTitle"=>"licRequest"
	),
	array(
		"mid"=> "55",
		"smid"=>"clicense",
		"stringId"=> "lic_mgm",
		"icon"=> "fa-laptop",
		"menuId"=> "55005",
		"parentId"=> "0",
		"urlTitle"=>""
	),

	array(
		"mid"=> "55",
		"smid"=>"clicense",
		"stringId"=> "lic_manage",
		"icon"=> "fa-laptop",
		"menuId"=> "55002",
		"parentId"=> "55005",
		"urlTitle"=>"manageLicense"
	),

	array(
		"mid"=> "55",
		"smid"=>"licenses",
		"stringId"=> "po_request",
		"icon"=> "fa-laptop",
		"menuId"=> "55003",
		"parentId"=> "55000",
		"urlTitle"=>"poRequest"
	)
			
);
?>