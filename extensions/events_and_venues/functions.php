<?php
$adminUiPath=dirname(__FILE__)."/ui/admin/";


$extensionRoute['hotel']=$adminUiPath."listing.php";
$extensionRoute['hotel/manage_venue']=$adminUiPath."manage_venue.php";
$extensionRoute['tax']=$adminUiPath."tax_listing.php";
$extensionRoute['amenities']=$adminUiPath."amenities_listing.php";
$extensionRoute['category']=$adminUiPath."category_listing.php";
//$extensionRoute['warehouse']=$adminUiPath."warehouse_listing.php";
$extensionRoute['location']=$adminUiPath."location_listing.php";
$extensionRoute['bookingrequest']=$adminUiPath."bookingrequest.php";


//CMS  Pages

$extensionRoute['cms'] = $adminUiPath."cms/cms.php";//-3
$extensionRoute['cms/QueriesComplains'] = $adminUiPath."cms/supportlisting.php";
$extensionRoute['cms/feedback'] = $adminUiPath."cms/supportlisting.php";
$extensionRoute['cms/partnerwithBk'] = $adminUiPath."cms/partnerslisting.php";
$extensionRoute['cms/benefits'] = $adminUiPath."cms/benefits.php";
$extensionRoute['cms/benefitsComment'] = $adminUiPath."cms/benefitsComment.php";




function events_and_venues()
{
	global $adminUiPath;
	switch($_GET['action'])
	{
		case "manage_venue":
			include($adminUiPath."manage_venue.php");
		break;
		case "manage_event":
			include($adminUiPath."manage_event.php");
		break;
		default:
			include($adminUiPath."listing.php");
		break;
	}
	
}

function manage_amenities()
{
	global $adminUiPath;
	include($adminUiPath."amenities_listing.php");
}

function manage_categorys()
{
	
	global $adminUiPath;
	include($adminUiPath."category_listing.php");	
}
function manage_warehouse_page()
{
	global $adminUiPath;
	include($adminUiPath."warehouse_listing.php");	
}
function manage_location_page()
{
	global $adminUiPath;
	include($adminUiPath."location_listing.php");	
}
function manage_venue_requuest_page()
{
	global $adminUiPath;
	include($adminUiPath."manage_venue_requuest_page_listing.php");		
}
function manage_ticket_book_page()
{
	global $adminUiPath;
	include($adminUiPath."manage_ticket_book_page_listing.php");		
}

?>