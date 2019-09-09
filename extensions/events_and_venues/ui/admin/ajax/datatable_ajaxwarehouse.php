<?php
include_once '../../../../../global.php';
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
//mb_internal_encoding('UTF-8');
error_reporting(0);
$start=microtime();
global $db;
$collection = 'inventory';
/**
 * MongoDB connection
 */
/*try {
    $m = new Mongo();
} catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
}*/
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
			$typesearch="";
			if($dataProps[$i]=="productid"){
				$typesearch="title";
			
            $searchTermsAny[] = array(
                $typesearch => new MongoRegex( '/'.$sRegex.'/i' )
            );
			}
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

if(isset($_GET['type'])){
$where=array('type'=>$_GET['type']);
}

	$user_type = getUserType($_SESSION['user']['user_id']); //$_SESSION['user']['user_type'];
	if($user_type == 'hotel')
	{
		$queryExecute = select_mongo('product',array('hotelUserId'=>$_SESSION['user']['user_id']),array());
		$proudctIds = add_id($queryExecute);
		$pIdsArr = array();
		foreach($proudctIds  as $proudctId)
		{
			$pIdsArr[] = $proudctId['id'];
		}
			
		
		$where = array();
		$where['productId'] = array('$in'=>$pIdsArr); //$product_id;
		
		$qarray=array();
		if(sizeof($searchTerms))
		{
			array_push($qarray,$where);
			array_push($qarray,$searchTerms);   
			$query=array('$and'=>$qarray);
			$cursor = $m_collection->find($query, $fields);
		}  
		else
		{
			$cursor = $m_collection->find($where, $fields);
		}
		
	}
	else{
		
		$qarray=array();
		if(sizeof($searchTerms))
		{
			
			array_push($qarray,$searchTerms);   
			$query=array('$and'=>$qarray);
			$finaldata=select_mongo("product",$query,array("title"));
			$finaldata=add_id($finaldata);
			if(!empty($finaldata)){
					foreach($finaldata as $value){
						$querydata[]=$value['id'];
					}
			}
			$querydatas['productId']['$in']=$querydata;
			$cursor = $m_collection->find($querydatas, $fields);
			
		}  
		else
		{
			$cursor = $m_collection->find($searchTerms, $fields);
		}
		
		//$cursor = $m_collection->find($searchTerms, $fields);
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

if($sort_fields['checkbox']=='1' || $sort_fields['checkbox']=='-1')
{
    $cursor->sort(array('updatedOn'=>-1));
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
 
 
foreach ( $cursor as $doc ) {

    if($doc['user_type']!="super admin"){
    $id=$doc['_id']->{'$id'};
    
    $checkbox='<span class="checkbox" data-color="red">
            <input id="ch_'.$id.'" onclick="checkBoxChecked(this.id)" name="numbers[]" value="'.$id.'" class="check_box" type="checkbox"> <label></label>
    </span>';
    
    
    $action_buttons=''; 
    $tableid="";
if($doc['status']=="1"){

  if($doc['type']=='event'){
    $action_buttons.='<span class="tooltip-area">';
    $action_buttons.='<a data-original-title="Edit" onclick="go_to_popup(\'warehouseeventPopup\',\'id=\'+$(this).attr(\'data-id\'))" id="data_table_1-'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="Edit">';    
    $tableid='data_table_1';
  }
  else
  {
    $action_buttons.='<span class="tooltip-area">';
    $action_buttons.='<a data-original-title="Edit" onclick="go_to_popup(\'warehousevenuePopup\',\'id=\'+$(this).attr(\'data-id\'))" id="data_table_1-'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="Edit">';
    $tableid='data_table_2';
  }
      $action_buttons.='<i class="fa fa-pencil"></i>';
      $action_buttons.='</a>&nbsp;';  
}   

  
    $action_buttons.='<a data-original-title="Delete" onclick="delete_data_temp(this.id,\''.$tableid.'\',\''.$doc['type'].'\')" id="data_table_1-'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="">';
        $action_buttons.='<i class="fa fa-trash-o"></i>';
    $action_buttons.='</a>&nbsp;';

    $action_buttons.='</span>';
    
    $product=get_product_by_id(array("id"=>$doc['productId']));
    $Ptitle=$product['data'][0]['title'];
    $checkbox="";
    if($doc['status']=='1')
    {
        $status='Active';
    }
    else{
        $status='Deleted';
    }
    $other_fields=array('checkbox'=>$checkbox,'productid'=>$Ptitle,'action'=>$action_buttons,'status'=>$status);
    $doc=array_merge($doc,$other_fields);
    $output['aaData'][] = $doc;
} 
}
 $end=microtime();
 echo json_encode( $output );
