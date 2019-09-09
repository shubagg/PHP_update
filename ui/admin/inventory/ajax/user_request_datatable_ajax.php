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
$collection = 'inventoryRequests';
$m_collection = $db->$collection;
 
/**
 * Define the document fields to return to DataTables (as in http://us.php.net/manual/en/mongocollection.find.php).
 * If empty, the whole document will be returned.
 */
$fields = array();
 
// Input method (use $_GET, $_POST or $_REQUEST)
$input =& $_GET;
 
/**
 * Handle requested DataProps
 */
 
// Number of columns being displayed (useful for getting individual column search info)
$iColumns = $input['iColumns'];
 
// Get mDataProp values assigned for each table column
$dataProps = array();
for ($i = 0; $i < $iColumns; $i++) {
    $var = 'mDataProp_'.$i;
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
 
if ( !empty($input['sSearch']) ) {
    $sSearch = $input['sSearch'];
     
    for ( $i=0 ; $i < $iColumns ; $i++ ) {
        if ($input['bSearchable_'.$i] == 'true') {
            if ($input['bRegex'] == 'true') {
                $sRegex = str_replace('/', '\/', $sSearch);
            } else {
                $sRegex = preg_quote($sSearch, '/');
            }
            $searchTermsAny[] = array(
                $dataProps[$i] => new MongoRegex( '/'.$sRegex.'/i' )
            );
        }
    }
}
 
// Individual column filtering
for ( $i=0 ; $i < $iColumns ; $i++ ) {
    if ( $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '' ) {
        if ($input['bRegex_'.$i] == 'true') {
            $sRegex = str_replace('/', '\/', $input['sSearch_'.$i]);
        } else {
            $sRegex = preg_quote($input['sSearch_'.$i], '/');
        }
        $searchTermsAll[ $dataProps[$i] ] = new MongoRegex( '/'.$sRegex.'/i' );
    }
}

$searchTerms = $searchTermsAll;
if (!empty($searchTermsAny)) {
    $searchTerms['$or'] = $searchTermsAny;
}

$where=array('userId'=>$_SESSION['user']['user_id']);
if($_GET['type']){ $where['type']=array('$in'=>explode(",",$_GET['type'])); }
    if(sizeof($searchTerms))
    {
        if(sizeof($where))
        {
            array_push($qarray,$where);
        }
        array_push($qarray,$searchTerms);   
        $query=array('$and'=>$qarray);

        $cursor = $m_collection->find($query, $fields);
    }  
    else
    {
        $cursor = $m_collection->find($where, $fields);
    }
/**
 * Paging
 */
if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
    $cursor->limit( $input['iDisplayLength'] )->skip( $input['iDisplayStart'] );
}
 
/**
 * Ordering
 */
if ( isset($input['iSortCol_0']) ) {
    $sort_fields = array();
    for ( $i=0 ; $i<intval( $input['iSortingCols'] ) ; $i++ ) {
        if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
            $field = $dataProps[ intval( $input['iSortCol_'.$i] ) ];
            $order = ( $input['sSortDir_'.$i]=='desc' ? -1 : 1 );
            $sort_fields[$field] = $order;
        }
    }
    $cursor->sort($sort_fields);
}


$cursor->sort(array('updatedOn'=>-1));
 

/**
 * Output
 */
$output = array(
    "sEcho" => intval($input['sEcho']),
    "iTotalRecords" => $cursor->count(),
    "iTotalDisplayRecords" => $cursor->count(),
    "aaData" => array(),
);
 
 
foreach ( $cursor as $doc ) {

    $id=$doc['_id']->{'$id'};
    $productTitle=get_product_by_id(array('id'=>$doc['productId'],'fields'=>'title'));
    $productTitle=$productTitle['data'][0]['title'];

    $userId=get_resource_by_id(array('id'=>$doc['userId'],'fields'=>'name'));
    $userId=$userId['data'][0]['name'];
    $category=explode(",",$doc['productCategory']);$category=$category[0];

    $productCategory=get_product_category(array('id'=>$category,'parentId'=>'0','fields'=>'title'));
    $productCategory=$productCategory['data'][0]['title'];

    if($doc['status']=='PENDING')
    {
        $action='<button type="button" class="btn btn-theme-inverse " onclick="accept_request(\''.$id.'\',\''.$_GET['type'].'\')"> Accept </button>
            <a href="javascript:;" class="btn btn-theme-inverse" onclick="reject_request(\''.$id.'\',\''.$_GET['type'].'\')"> Reject </a>';
    }
    else
    {
        $action=$doc['status'];
    }
    
    $jobTitle='----';
    if($doc['jobId']){
        $getTitle=get_job_by_id(array('id'=>$doc['jobId'],'fields'=>'title','smid'=>'1'));
        $getTitle=$getTitle['data'][0]['title'];
        $jobTitle='N/A';
        if($getTitle){ $jobTitle=$getTitle; }
    }

    $doc['jobId']=$jobTitle;
    $doc['updatedOn']=date("Y-m-d H:i:s",$doc['updatedOn']->sec);
    $doc['productId']=$productTitle;
    $doc['userId']=$userId;
    $doc['productCategory']=$productCategory;
    $doc['action']=$action;
    $output['aaData'][] = $doc;
}
$end=microtime();
echo json_encode( $output );
?>