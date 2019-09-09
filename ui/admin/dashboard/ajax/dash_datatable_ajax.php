<?php

include_once '../../../../global.php';
/**
 * Script:    DataTables server-side script for PHP 5.2+ and MongoDB
 * Copyright: 2012 - Kari Söderholm, aka Haprog
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
$start=microtime();
global $db;
$collection = 'dashboard';
$cond=explode(",",$_GET['cond']);

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
    $checkPage="";
    $where=array();

    if($_SESSION['user']['user_id'])
    {
        //$checkPage="1";
        $where['$or']=array(array('user_id'=>$_SESSION['user']['user_id']),array('dash_type'=>'0'));
        //$where=array('user_id'=>$_SESSION['user']['user_id'],'dash_type'=>'0');
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
    $cursor->limit($input['iDisplayLength'])->skip($input['iDisplayStart']);
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
    $cursor->sort(array('lastUpdate' => -1));
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
 
 $cursor = add_id($cursor, "id");
 //pr($cursor);
foreach ( $cursor as $doc ) {
    $id=$doc['id'];
    $doc['creation_date'] =date('Y-M-d',$doc['creation_date']->sec);
    if($doc['template_type']=="1")
    {
        $doc['template_type']="1 : 2";
    }
    else if($doc['template_type']=="2"){
        $doc['template_type']="1 : 1";
    }
    else if($doc['template_type']=="3"){
        $doc['template_type']="3 : 1";
    }

$action_buttons = '';
        $action_buttons .= '<span class="tooltip-area">';
         $dash_manage=explode(',',$doc['DashManage']);
        if($doc['user_id']==$_SESSION['user']['user_id'])
        {
        $action_buttons .= '<a data-original-title="Edit" onclick="manage_dashboard(\'updateDashboard\',this.id)" id="'.$id.'" data-id="' . $id . '" class="btn btn-default btn-sm" title="Edit">';
        $action_buttons .= '<i class="fa fa-pencil"></i>';
        $action_buttons .= '</a>&nbsp;';
        $action_buttons .= '<a data-original-title="Delete" onclick="delete_dashboard(this.id)" id="data_table_1-' . $id . '" data-id="' . $id . '" class="btn btn-default btn-sm" title="">';
        $action_buttons .= '<i class="fa fa-trash-o"></i>';
        $action_buttons .= '</a>&nbsp;';
         }

        else if($dash_manage[0]=='def' || $dash_manage[0]==1)
        {
        $action_buttons .= '<a data-original-title="Edit" onclick="manage_dashboard(\'updateDashboard\',this.id)" id="'.$id.'" data-id="' . $id . '" class="btn btn-default btn-sm" title="Edit">';
        $action_buttons .= '<i class="fa fa-pencil"></i>';
        $action_buttons .= '</a>&nbsp;';
        $action_buttons .= '<a data-original-title="Delete" onclick="delete_dashboard(this.id)" id="data_table_1-' . $id . '" data-id="' . $id . '" class="btn btn-default btn-sm" title="">';
        $action_buttons .= '<i class="fa fa-trash-o"></i>';
        $action_buttons .= '</a>&nbsp;';
         }
           

        $action_buttons .= '</span>';
         $other_fields = array('action' => $action_buttons);


        $doc = array_merge($doc, $other_fields);
        $output['aaData'][] = $doc;
    //$other_fields=array('template_type'=> )
    
   // $doc=array_merge($doc,$other_fields);
    //$output['aaData'][]=;
}
 $end=microtime();
 //echo $end-$start;
 //print_r($output);
echo json_encode( $output );
