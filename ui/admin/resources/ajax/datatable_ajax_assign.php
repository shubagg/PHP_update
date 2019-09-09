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
$start = microtime();
global $db;
global $companyId;
$collection = 'user';
$cond = explode(",", $_GET['cond']);

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
$currentId = $_SESSION['user']['user_id'];
$users = array();
$where = array();
$userInfo = get_user_hirarchy(array('userId' => $currentId, 'mongoObject' => 'true'));
if ($userInfo['success'] == 'true' && $userInfo['data'] != "") {
    $users = $userInfo['data'];
    $where = array('_id' => array('$in' => $users));
}


if ($_GET['cond']) {
    $cond = explode(",", $_GET['cond']);
    $where['category'] = array('$in' => $cond);
}

if (sizeof($searchTerms)) {
    $qarray = array();
    array_push($qarray, $where);
    array_push($qarray, $searchTerms);
    $query = array('$and' => $qarray);
    $cursor = $m_collection->find($query, $fields);
} else {

    $cursor = $m_collection->find($where, $fields);
}

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

foreach($cursor as $doc) {

    if ($doc['user_type'] != "super admin") {
        $id = $doc['_id']->{'$id'};
        $area = 'area';
        if ($companyId == 8) {
            $area = 'class';
        }
        $companyAddress = "";
        $address = "";
        $department = "N/A";
        $designation = "";
        $googleID = "";
        $email_id="";
        if (isset($doc['address'])) {
            $address = $doc['address'];
        }
        if (isset($doc['email'])) {
            $email_id = $doc['email'];
        }
        if (isset($doc['companyAddress'])) {
            $companyAddress = $doc['companyAddress'];
        }
        if (isset($doc['designation'])) {
            $designation = $doc['designation'];
        }
        if (isset($doc['googleID'])) {
            $googleID = $doc['googleID'];
        }

        $checkbox = '<span class="checkbox" data-color="red">
            <input id="ch_' . $id . '" onclick="checkBoxChecked(this.id)" name="numbersEnroll[]" value="' . $id . '" class="check_box_assign check_box robot_assign_check_box" type="checkbox"> <label></label>
    </span>';


        $action_buttons = '';
        $action_buttons .= '<span class="tooltip-area">';

        $action_buttons .= '<a data-original-title="Run" onclick="configuration_temp_assign(this)" data-info="' . $email_id . '" class="btn btn-default btn-sm controlTowerPlay" title="Run">';
        $action_buttons .= '<i class="fa fa-play"></i>';
        $action_buttons .= '</a>&nbsp;';

        $action_buttons .= '</span>';

        $color = "red";
        $data_status = 'inactive';
        if ($doc['status'] == 1) {
            $data_status = 'active';
            $color = 'green';
        } else if ($doc['status'] == 2) {
            $data_status = 'block';
            $color = 'yellow';
        } else if ($doc['status'] == 3) {
            $data_status = 'lock';
            $color = 'blue';
        }

        $status = '<a onclick="update_status(this.id)" data-status="' . $data_status . '" data-id="' . $id . '" id="status-' . $id . '" style="border-color: ' . $color . '; color: ' . $color . ';" class="btn btn-default btn-link" title="">
           <i class="glyphicon glyphicon-off"></i>
        </a>';

        $profileImage = get_media(array('smid' => '1', 'amid' => '1', 'asmid' => '1', 'aiid' => $id, 'url' => 'true'));

        $profileImage = $profileImage['data'][0];

        if (sizeof($profileImage)) {
            $img_url = $profileImage;
        } else {
            //$img_url = admin_assets_url() . 'img/avatar.png';
            $img_url = site_url().'company/'.$companyId.'/uploads/default_media/avatar.png';
        }
        $user_avatar = "<img src='$img_url' width='50' height='50'/>";

        $department = "N/A";
        $name = "N/A";
        if (isset($doc['name']) && $doc['name'] != "") {
            $name = $doc['name'];
        }
        if (isset($doc['category']) && !empty($doc['category'])) {
            $get_user_categories2 = curl_post("/get_user_category", array("category_ids" => implode("|", $doc['category']), "code" => ''));
            if (!empty($get_user_categories2['data'])) {
                $department = implode(" | ", array_filter(explode(" | ", $get_user_categories2['data'])));
            }
        }

        $manager = "N/A";
        $get_user_categories3 = curl_post("/get_user_category_manager", array("category_ids" => implode("|", $doc['manager'])));
        // print_r($get_user_categories3)
        if (!empty($get_user_categories3['data'])) {
            $manager = $get_user_categories3['data'];
        }
        


        $other_fields = array('checkbox' => $checkbox, 'action' => $action_buttons, 'user_status' => $status, "user_avatar" => $user_avatar, 'category_profile' => $department, 'category_area' => $category_area, 'manager' => $manager, 'address' => $address, 'companyAddress' => $companyAddress, 'department' => $department, 'designation' => $designation, 'googleID' => $googleID, 'name' => $name);


        $doc = array_merge($doc, $other_fields);
        $output['aaData'][] = $doc;
        //$output['aaData'][]=;
    }
}
$end = microtime();
//echo $end-$start;
//print_r($output);
echo json_encode($output);

