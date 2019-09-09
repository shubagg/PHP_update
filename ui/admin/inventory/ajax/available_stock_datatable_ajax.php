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
$collection = 'inventory';
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
$where=array('warehouse'=>array('$in'=>explode(",",$_GET['warehouseId'])));

$query=array(
    array('$match'=>$where),
    array('$group'=>array('_id'=>'$productId', 
        'quantityAvailable'=>array('$sum'=>'$quantityAvailable'),
        'productCategory' => array('$first' => '$productCategory'),
        'quantity' => array('$sum' => array('$add'=>array('$quantityAvailable','$quantityAllocated'))),
        'updatedOn' => array('$first' => '$updatedOn'),
        'productId'=>array('$first'=>'$productId')
        )),
    array('$sort'=>array('quantityAvailable'=>-1)),
);

if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
    array_push($query,array('$limit'=>intval($input['iDisplayLength'])));
    array_push($query,array('$skip'=>intval($input['iDisplayStart'])));
}

$cursor = $m_collection->aggregate($query);
$cursor=$cursor['result'];
 

/**
 * Output
 */
$output = array(
    "sEcho" => intval($input['sEcho']),
    "iTotalRecords" => sizeof($cursor),
    "iTotalDisplayRecords" => sizeof($cursor),
    "aaData" => array(),
);
 
 
foreach ( $cursor as $doc ) {

    $id=$doc['_id']->{'$id'};
    $product=get_product_by_id(array('id'=>$doc['productId'],'fields'=>'title,threshold_quantity'));
    $product=$product['data'][0];

    $vendorName=get_resource_by_id(array('id'=>$doc['vendor'],'fields'=>'name'));
    $vendorName=$vendorName['data'][0]['name'];
    $category=explode(",",$doc['productCategory']);$category=$category[0];

    $productCategory=get_product_category(array('id'=>$category,'parentId'=>'0','fields'=>'title'));
    $productCategory=$productCategory['data'][0]['title'];
    if(isset($_GET['type'])=='user')
    {
        $action='<button type="button" class="btn btn-theme-inverse" onclick="request_inventory(\''.$doc['productId'].'\')" > Request </button>';
    }
    else
    {
        $action='';
        if($doc['quantityAvailable']<$product['threshold_quantity'])
        {
            $action.='<button type="button" onclick="inventory_reorder(\''.$doc['productId'].'\',\''.$product['title'].'\')" class="btn btn-theme-inverse "> Reorder </button>  ';
        }
        $action.='<a href="javascript:;" class="btn btn-theme-inverse" onclick="allocateInventoryButton(\''.$doc['productCategory'].'\',\''.$doc['productId'].'\',\''.$doc['quantityAvailable'].'\')"> Allocate </a>';
    }

    $doc['thresholdQuantity']=$product['threshold_quantity'];
    $doc['createdOn']=date("Y-m-d H:i:s",$doc['updatedOn']->sec);
    $doc['productId']=$product['title'];
    $doc['vendor']=$vendorName;
    $doc['productCategory']=$productCategory;
    $doc['action']=$action;
    $output['aaData'][] = $doc;
}
$end=microtime();
echo json_encode( $output );
?>