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
$user_id=isset($_GET['id'])?$_GET['id']:'';
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


$where = array('role'=>'5cf4c668518be4001e000032', 'status' => '1');
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
        if (isset($doc['license']) && $doc['license'] == "") 
        {

            $id = $doc['_id']->{'$id'};


            $checkbox = '<span class="checkbox" data-color="red">
                <input id="ch_' . $id . '" onclick="checkBoxChecked(this.id)" name="numbersEnroll[]" value="' . $id . '" class="check_box_enroll check_box" type="radio"> <label></label>
        </span>';


            $action_buttons = '';
            $action_buttons .= '<span class="tooltip-area">';

            $action_buttons .= '<a data-original-title="Run" onclick="configuration_temp_assign(this)" data-info="' . $email_id . '" class="btn btn-default btn-sm controlTowerPlay" title="Run">';
            $action_buttons .= '<i class="fa fa-play"></i>';
            $action_buttons .= '</a>&nbsp;';

            $action_buttons .= '</span>';

       
            $status = '<a onclick="update_status(this.id)" data-status="' . $data_status . '" data-id="' . $id . '" id="status-' . $id . '" style="border-color: ' . $color . '; color: ' . $color . ';" class="btn btn-default btn-link" title="">
               <i class="glyphicon glyphicon-off"></i>
            </a>';

             
            $name = "N/A";
            if (isset($doc['name']) && $doc['name'] != "") {
                $name = $doc['name'];
            }

            $other_fields = array('checkbox' => $checkbox, 'action' => $action_buttons, 'user_status' => $status, "user_avatar" => $user_avatar, 'category_profile' => $category_profile, 'category_area' => $category_area, 'manager' => $manager, 'address' => $address, 'companyAddress' => $companyAddress, 'department' => $department, 'designation' => $designation, 'googleID' => $googleID, 'name' => $name);


            $doc = array_merge($doc, $other_fields);
            $output['aaData'][] = $doc;
            //$output['aaData'][]=;
        }
        else if (!isset($doc['license'])) 
        {
            $id = $doc['_id']->{'$id'};


            $checkbox = '<span class="checkbox" data-color="red">
                <input id="ch_' . $id . '" onclick="checkBoxChecked(this.id)" name="numbersEnroll[]" value="' . $id . '" class="check_box_enroll check_box" type="radio"> <label></label>
        </span>';


            $action_buttons = '';
            $action_buttons .= '<span class="tooltip-area">';

            $action_buttons .= '<a data-original-title="Run" onclick="configuration_temp_assign(this)" data-info="' . $email_id . '" class="btn btn-default btn-sm controlTowerPlay" title="Run">';
            $action_buttons .= '<i class="fa fa-play"></i>';
            $action_buttons .= '</a>&nbsp;';

            $action_buttons .= '</span>';

       
            $status = '<a onclick="update_status(this.id)" data-status="' . $data_status . '" data-id="' . $id . '" id="status-' . $id . '" style="border-color: ' . $color . '; color: ' . $color . ';" class="btn btn-default btn-sm" title="">
               <i class="glyphicon glyphicon-off"></i>
            </a>';

             
            $name = "N/A";
            if (isset($doc['name']) && $doc['name'] != "") {
                $name = $doc['name'];
            }

            $other_fields = array('checkbox' => $checkbox, 'action' => $action_buttons, 'user_status' => $status, "user_avatar" => $user_avatar, 'category_profile' => $category_profile, 'category_area' => $category_area, 'manager' => $manager, 'address' => $address, 'companyAddress' => $companyAddress, 'department' => $department, 'designation' => $designation, 'googleID' => $googleID, 'name' => $name);


            $doc = array_merge($doc, $other_fields);
            $output['aaData'][] = $doc;
            //$output['aaData'][]=;
        }
    }
}
$end = microtime();
//echo $end-$start;
//print_r($output);
echo json_encode($output);

