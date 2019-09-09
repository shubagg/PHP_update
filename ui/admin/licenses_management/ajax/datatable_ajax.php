<?php
include_once '../../../../global.php';
/**
 * Script:    DataTables server-side script for PHP 5.2+ and MongoDB
 * Copyright: 2012 - Kari S�derholm, aka Haprog
 * License:   GPL v2 or BSD (3-point)
 *
 * By default Mongo documents are returned as is like they are stored in the
 * database. You can define which fields to return by overriding the empty
 * $fields array a few rows below.
 *
 * Because MongoDB documents can naturally contain nested data, this script
 * assumes (requires) that you use mDataProp in DataTables to define which
 * fields to display.
 */
mb_internal_encoding('UTF-8');
error_reporting(0);
$start = microtime();
global $db;
$collection = 'licensesRequest';
$cond = explode(",", $_GET['cond']);
$user_id = isset($_GET['id']) ? $_GET['id'] : '';

$m_collection = $db->$collection;

/**
 * Define the document fields to return to DataTables (as in http://us.php.net/manual/en/mongocollection.find.php).
 * If empty, the whole document will be returned.
 */
$fields = array();

// Input method (use $_GET, $_POST or $_REQUEST)
$input = & $_GET;

/**
 * Handle requested DataProps
 */
// Number of columns being displayed (useful for getting individual column search info)
$iColumns = $input['iColumns'];

// Get mDataProp values assigned for each table column
$dataProps = array();
for ($i = 0; $i < $iColumns; $i++) {
    $var = 'mDataProp_' . $i;
    if (!empty($input[$var]) && $input[$var] != 'null') {
        $dataProps[$i] = $input[$var];
    }
}

/**
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large collections.
 */
$searchTermsAny = array();
$searchTermsAll = array();

if (!empty($input['sSearch'])) {
    $sSearch = $input['sSearch'];

    for ($i = 0; $i < $iColumns; $i++) {
        if ($input['bSearchable_' . $i] == 'true') {
            if ($input['bRegex'] == 'true') {
                $sRegex = str_replace('/', '\/', $sSearch);
            } else {
                $sRegex = preg_quote($sSearch, '/');
            }
            $searchTermsAny[] = array(
                $dataProps[$i] => new MongoRegex('/' . $sRegex . '/i')
            );
        }
    }
}

// Individual column filtering
for ($i = 0; $i < $iColumns; $i++) {
    if ($input['bSearchable_' . $i] == 'true' && $input['sSearch_' . $i] != '') {
        if ($input['bRegex_' . $i] == 'true') {
            $sRegex = str_replace('/', '\/', $input['sSearch_' . $i]);
        } else {
            $sRegex = preg_quote($input['sSearch_' . $i], '/');
        }
        $searchTermsAll[$dataProps[$i]] = new MongoRegex('/' . $sRegex . '/i');
    }
}
$searchTerms = $searchTermsAll;
if (!empty($searchTermsAny)) {
    $searchTerms['$or'] = $searchTermsAny;
}
$cursor = $m_collection->find();
/**
 * Paging
 */
if (isset($input['iDisplayStart']) && $input['iDisplayLength'] != '-1') {
    $cursor->limit(intval($input['iDisplayLength']))->skip(intval($input['iDisplayStart']));
}
/**
 * Ordering
 */
if (isset($input['iSortCol_0'])) {
    $sort_fields = array();
    for ($i = 0; $i < intval($input['iSortingCols']); $i++) {
        if ($input['bSortable_' . intval($input['iSortCol_' . $i])] == 'true') {
            $field = $dataProps[intval($input['iSortCol_' . $i])];
            $order = ( $input['sSortDir_' . $i] == 'desc' ? -1 : 1 );
            $sort_fields[$field] = $order;
        }
    }
    $cursor->sort($sort_fields);
}

if ($sort_fields['checkbox'] == '1' || $sort_fields['checkbox'] == '-1') {
    $cursor->sort(array('uploadedOn' => -1));
}

/**
 * Output
 */
$output = array(
    "sEcho" => intval($input['sEcho']),
    "iTotalRecords" => $cursor->count(),
    "iTotalDisplayRecords" => $cursor->count(),
    "aaData" => array(),
);
foreach ($cursor as $doc) {
    $id = $doc['_id']->{'$id'};
    if ($doc['user_type'] == 'admin') {
        $userType = "reseller";
    } else if ($doc['user_type'] == 'user') {
        $userType = "agency/user";
    } else {
        $userType = $doc['user_type'];
    }
    $password = "";
    for ($i = 0; $i < strlen($doc['password']); $i++) {
        $password .= "*";
    }

    $po_number = 'N/A';
    $po_number1 = "0";
    $po_verify = '<i class="fa fa-times"></i>';
    if (isset($doc['po_number'])) {
        $po_number = $doc['po_number'];
        $po_number1 = $doc['po_number'];
    }
    if (isset($doc['po_verify']) && $doc['po_verify'] == '1') {
        $po_verify = '<i class="fa fa-check"></i>';
    }
    $checkbox = '';
    $action_buttons = '';
    $action_buttons .= '<span class="tooltip-area">';
    $action_buttons .= '<a data-original-title="License Generation Request" onclick="make_licenses(this.id)" id="' . $id . '" data-id="' . $id . '" class="btn btn-default btn-sm" title="License Generation Request">';
    $action_buttons .= '<i class="fa fa-tasks"></i>';
    $action_buttons .= '</a>&nbsp;';

    $action_buttons .= '<a data-original-title="Verify PO Number" onclick="verify_PO_Number(this.id,\'' . $po_number1 . '\')" id="' . $id . '" data-id="' . $id . '" class="btn btn-default btn-sm" title="Verify PO Number">';
    $action_buttons .= '<i class="fa fa-certificate"></i>';
    $action_buttons .= '</a>&nbsp;';
    
    $ip_address = !empty($doc['ip_address']) ? $doc['ip_address'] : '';
    $action_buttons .= '<a data-original-title="Update IP Address" onclick="update_ip_number(this.id, \''.$ip_address.'\')" id="' . $id . '" data-id="' . $id . '" class="btn btn-default btn-sm" title="Update IP Address">';
    $action_buttons .= '<i class="fa fa-globe" aria-hidden="true"></i>';
    $action_buttons .= '</a>&nbsp;';
    
    $server_expiry_date = '';
    if(!empty($doc['server_expiry_date'])) {
        $server_expiry_date = encrypt_decrypt('', 'decrypt', 'opensesame3', $doc['server_expiry_date']);
        $server_expiry_date = htmlentities(str_replace(array('"', "'"), '', $server_expiry_date['data']));
    }
    $action_buttons .= '<a data-original-title="Upload Server License" onclick="update_server_license_configuration(this.id, \''.$server_expiry_date.'\')" id="' . $id . '" data-id="' . $id . '" class="btn btn-default btn-sm" title="Update Server License">';
    $action_buttons .= '<i class="fa fa-plus" aria-hidden="true"></i>';
    $action_buttons .= '</a>&nbsp;';
    /* $color="red";
      $data_status='inactive';
      if($doc['status']==1){ $data_status='active';$color='green'; }
      $action_buttons.='<a data-original-title="status" onclick="make_licenses_Status(this.id)" id="'.$id.'" data-status="'.$data_status.'" data-id="'.$id.'" class="btn btn-default btn-link " title="Status" style="border-color: '.$color.'; color: '.$color.';">';
      $action_buttons.=' <i class="glyphicon glyphicon-off"></i>';
      $action_buttons.='</a>&nbsp;'; */

    $action_buttons .= '</span>';

    /* $color="red";
      $data_status='inactive';
      if($doc['status']==1){ $data_status='active';$color='green'; }

      $status='<a onclick="update_status(this.id)" data-status="'.$data_status.'" data-id="'.$id.'" id="status-'.$id.'" style="border-color: '.$color.'; color: '.$color.';" class="btn btn-default btn-link" title="">
      <i class="glyphicon glyphicon-off"></i>
      </a>'; */

    //if($doc['profile_picture']!=''){$img_url=site_url().'uploads/users/'.$doc['profile_picture'];}  
    // else{$img_url=admin_assets_url().'img/avatar.png';}  
    //$user_avatar="<img src='$img_url' width='50' height='50'/>";
    // $get_user_categories=curl_post("/get_user_category",array("category_ids"=>implode("|",$doc['category']),"code"=>'profile'));
    //  $category_profile=$get_user_categories['data'];
    
    $other_fields = array('checkbox' => $checkbox, 'action' => $action_buttons, 'ip_address' => $ip_address, 'server_expiry_date' => $server_expiry_date, 'status' => $status, "user_avatar" => $user_avatar, 'category_profile' => $category_profile, 'user_type' => $userType, 'password' => $password, 'po_number' => $po_number, "po_verify" => $po_verify);
    $doc = array_merge($doc, $other_fields);
    if (!$doc['vehicle']) {
        $doc['vehicle'] = 'N/A';
    }
    $output['aaData'][] = $doc;
    //$output['aaData'][]=;
}
$end = microtime();
//echo $end-$start;
//print_r($output);
echo json_encode($output);
