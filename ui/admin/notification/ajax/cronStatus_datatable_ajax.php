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
$collection = 'cronStatus';
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
$condition=array();
$dt = $_GET['starttime']. " 00:00";
$start = new MongoDate(strtotime($dt));
$dt1 = $_GET['endtime']. " 24:00";
$end = new MongoDate(strtotime($dt1));
$condition['lastUpdate'] = array('$gte'=>$start,'$lte'=>$end);
$cursor = $m_collection->find($condition, $fields);
 

 
/**
 * Paging
 */
if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
    $cursor->limit( intval($input['iDisplayLength']) )->skip( intval($input['iDisplayStart']) );
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
    $cursor->sort(array('lastUpdate'=>-1));
}
$cursor->sort(array('lastUpdate'=>-1));
 
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
    $starttime="";
    $endtime="";
    $status="";
    $result="";
    if(isset($doc['status']))    
    {
        $status=$doc['status'];
    }
    if(isset($doc['result']))    
    {
        $result=$doc['result'];
    }
    if(isset($doc['starttime']))    
    {
        $starttime=date("Y-m-d H:i:s",$doc['starttime']);
    }
    if(isset($doc['endtime']))    
    {
        $endtime=date("Y-m-d H:i:s",$doc['endtime']);
    }

    
     $checkbox='<span class="checkbox" data-color="red">
            <input id="ch_'.$id.'" onclick="checkBoxChecked(this.id)" name="numbers[]" value="'.$id.'" class="check_box" type="checkbox"> <label></label>
    </span>';
    
   
    $logsId='<a href="cronLogs?id='.$doc['logsId'].'" target="_blank" style="cursor: pointer;" class="" title="">'.$doc['logsId'].'
            </a>';

    $action_buttons='';
    $action_buttons.='<span class="tooltip-area">'; 
                                                                          
    $action_buttons.='<a data-original-title="Delete" onclick="delete_cron_status_data(\''.$doc['logsId'].'\')" id="data_table_1-'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="">';
        $action_buttons.='<i class="fa fa-trash-o"></i>';
    $action_buttons.='</a>&nbsp;';

    $action_buttons.='</span>';
       
    
    
    $other_fields=array('checkbox'=>$checkbox,"starttime"=>$starttime,'endtime'=>$endtime,'user_type'=>$endtime,'logsId'=>$logsId,'action'=>$action_buttons,'result'=>$result,'status'=>$status);
    
    
    $doc=array_merge($doc,$other_fields);    
    if(!$doc['vehicle']){ $doc['vehicle']='N/A';  }
     
    $output['aaData'][] = $doc;
    
   
        
    //$output['aaData'][]=;
     }
 $end=microtime();
 //echo $end-$start;
 //print_r($output);
echo json_encode( $output );
