<?php
include_once '../../../../global.php';
$verifyRequest = $csrf->verifyRequest();
if($verifyRequest['success'] == 'false') {
    echo json_encode($verifyRequest);
    return;
}
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
$collection = 'user';

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

   
$where=array('category'=>array('$exists'=>true,'$in'=>array($_GET['categoryid'])),'status'=>array('$ne'=>'10'));
//$where=array('status'=>'10');
$cursor = $m_collection->find($where, $fields);
 
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

foreach ( $cursor as $doc ) {
        $id=$doc['_id']->{'$id'};
        $checkbox='';
        $name="";
        $selected="";
        $rs=$ui_string['member'];
        if(isset($doc['name']))
        {
            $name='<div class="hri_name_short">'.$doc['name'].'</div>';
        }
        $manager=1;
        if(isset($doc['manager']) && $doc['manager'][0]!='')
        {
            if(in_array($_GET['categoryid'], $doc['manager']))
            {
                $manager=2;
            }
        }
    if($manager==2)
    { 
        $maselected="selected";
        $meselected="";
        $rs=$ui_string['manager'];
     }
     else if($manager==1)
     {
        $meselected="selected";
        $maselected="";
        $rs=$ui_string['member'];
     } 

         $checkbox='<span class="checkbox" data-color="red">
            <input id="ch_'.$id.'" onclick="checkBoxChecked(this.id)" name="numbers[]" value="'.$id.'" class="check_box" type="checkbox"> <label></label>
        </span>';
        $action_buttons='';
                               
        $action_buttons.='<div class="nice-select form-control" tabindex="0"><span class="current">'.$rs.'</span><ul class="list"><li data-value="2" class="option '.$maselected.'" onclick="update_manage_memeber(\''.$_GET['categoryid'].'\',\''.$id.'\',\''.$_GET['catName'].'\',2);">'.$ui_string['manager'].'</li><li data-value="1" class="option '.$meselected.'" onclick="update_manage_memeber(\''.$_GET['categoryid'].'\',\''.$id.'\',\''.$_GET['catName'].'\',1);">'.$ui_string['member'].'</li></ul></div>
          </div>&nbsp;';
    
    
    $other_fields=array('checkbox'=>$checkbox,'action'=>$action_buttons,'status'=>$status,"user_avatar"=>$user_avatar,'category_profile'=>$category_profile,'user_type'=>$userType,'name'=>$name);
    
    
    $doc=array_merge($doc,$other_fields);    
     
    $output['aaData'][] = $doc;
    
   
        
    //$output['aaData'][]=;
     }
 $end=microtime();
 //echo $end-$start;
 //print_r($output);
echo json_encode( $output );
