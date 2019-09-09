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
$start=microtime();
global $db;
$collection = 'company_licenses';
$cond=explode(",",$_GET['cond']);
$user_id=isset($_GET['id'])?$_GET['id']:'';

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


$where = array('company_id'=>$user_id);

//print_r($where);die;
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
    $cursor->sort(array('uploadedOn'=>-1));
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
 
 $i=1;
foreach ( $cursor as $doc ) {
        
    $id=$doc['_id']->{'$id'};
    $checkbox='';
    $action_buttons='';
    $action_buttons.='<span class="tooltip-area">'; 
     if(!isset($doc['active_status']) || $doc['active_status'] == '10')
     {
        $action_buttons.='<a data-original-title="Assign License" onclick="assign_license(this.id,0)" id="'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="Assign License">';
        $action_buttons.='<i class="fa fa-tasks"></i>';
        $action_buttons.='</a>&nbsp;';
     }                                                                     
    
   $action_buttons.='<a data-original-title="Delete" onclick="delete_license(this.id)" id="'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="Delete">';
        $action_buttons.='<i class="fa fa-trash"></i>';
    $action_buttons.='</a>&nbsp;';

    $action_buttons.='</span>';

    $color="red";
    $data_status='inactive';
    if( isset($doc['active_status']))
    {
        if($doc['active_status']==1){ $data_status='active';$color='green'; }
        
        $status='<a data-status="'.$data_status.'" data-id="'.$id.'" onclick="change_license_status(this.id)" id="status-'.$id.'" style="border-color: '.$color.'; color: '.$color.';" class="btn btn-default btn-sm" title="'.$data_status.'">
               <i class="glyphicon glyphicon-off"></i>
            </a>';
    }
    else
    {
        $status = 'N/A';
    }  
    
    $lno =$i;
    $license ='N/A';
    $license =$doc['licenses_no'];

    $date_of_expiry ='N/A';
    $date_of_expirys=encrypt_decrypt('','decrypt','opensesame',$doc['date_of_expiry']);
    if($date_of_expirys['success']=='true'){$date_of_expiry =str_replace("'", "", $date_of_expirys['data']);}
    
    $doc['date_of_expiry']=$doc['date_of_expiry'];
    $other_fields=array('checkbox'=>$checkbox,'action'=>$action_buttons,'status'=>$status,"user_avatar"=>$user_avatar,'category_profile'=>$category_profile,'user_type'=>$userType,'password'=>$password,'lno'=>$lno,'license'=>$license,'date_of_expiry'=>$date_of_expiry);
    
    
    $doc=array_merge($doc,$other_fields);    
    if(!$doc['vehicle']){ $doc['vehicle']='N/A';  }
     
    $output['aaData'][] = $doc;
    
    $i++;}
 $end=microtime();
 //echo $end-$start;
 //print_r($output);
echo json_encode( $output );
