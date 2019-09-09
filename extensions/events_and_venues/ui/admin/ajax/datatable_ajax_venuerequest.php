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
$collection = 'productOrder';
$cond=explode(",",$_GET['cond']);


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
	
	/*
		# Get user id
		# Get user type 
		# check if user_type = hotel
		# pass hotel id in where condition
		
	*/
	$where=array('type'=>'3','ProductType'=>'venue','txnid'=>array('$exists'=>true));
	
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
		$where['productId'] = array('$in'=>$pIdsArr);			
	}
	
	 
	if(isset($_GET['filter']))
	{
		$dateArr = explode(',',$_GET['filter']);
		$srart_date_arr = explode('=',$dateArr[0]);
		$end_date_arr = explode('=',$dateArr[1]);
		
		$st_date = $srart_date_arr[1]. " 00:00";
		$start = new MongoDate(strtotime($st_date));
		$end_date = $end_date_arr[1]. " 23:59";
		$end = new MongoDate(strtotime($end_date));
		
        // get total number of session 
        $where['createdOn'] = array('$gte'=>$start,'$lt'=>$end);
		
	}
   
    
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
$cursor->sort(array('createdOn'=>-1));
 
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

    
    $status=array('Pending','Approved','Rejected','Approved <br/>(Payment Session Expire )','Approved <br/>(Booked)');
    if($doc['user_type']!="super admin"){
    $id=$doc['_id']->{'$id'};
    
    $checkbox='<span class="checkbox" data-color="red">
            <input id="ch_'.$id.'" onclick="checkBoxChecked(this.id)" name="numbers[]" value="'.$id.'" class="check_box" type="checkbox"> <label></label>
    </span>';
    
    
    $action_buttons='';
    $action_buttons.='<span class="tooltip-area">'; 
  
    if($doc['venueStatus']=='0')
    {
        $action_buttons.='<a data-original-title="action" onclick="go_to_popup(\'approveaddPopup\',\''.$doc['productId'].'\',\'id=\'+$(this).attr(\'data-id\'))" id="data_table_1-'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="Action">';
        $action_buttons.='<i class="fa fa-crosshairs"></i>';
        $action_buttons.='</a>&nbsp;';   
    }
    else
    {
        if(($doc['venueStatus']=='1') && ($doc['bookedStatus']=='1'))
        {
            $doc['venueStatus'] = 4;
        }
        else if(isset($doc['paymetExpireTime']) && ($doc['venueStatus']=='1'))
        {
            $Ctime = time()*1000;
            if($Ctime  >=  $doc['paymetExpireTime'])
            {
                $doc['venueStatus'] = 3;
            }
        }
        $action_buttons.='<a data-original-title="action" onclick="go_to_detail_popup(\'approveaddPopupdetail\',\''.$doc['comment'].'\',\''.$status[$doc['venueStatus']].'\',\'id=\'+$(this).attr(\'data-id\'))" id="data_table_1-'.$id.'" data-id="'.$id.'" class="btn btn-default btn-sm" title="Action">';
        $action_buttons.='<i class="fa fa-crosshairs"></i>';
        $action_buttons.='</a>&nbsp;';   
    }

    $action_buttons.='</span>';
    
    
    $productId=$doc['productId'];
    $imageData=get_association_data("16","10","1",$productId);
    $profile_picture=$imageData['media']['1'][$productId][0]['mediaName'];
    if($profile_picture!=''){$img_url=media_url().'images/'.$profile_picture;}  
    else{$img_url=admin_assets_url().'img/avatar.png';}  
    $user_avatar="<img src='$img_url' width='50' height='50'/>";

    $getProductTitle=get_product_by_id(array("id"=>$productId,'fields'=>'title'));
    $getProductTitle=$getProductTitle['data'][0]['title'];;

    $usernameDetail=get_resource_by_id(array('id'=>$doc['userId'],'fields'=>'name,email,phone,contact'));
    $username = $usernameDetail['data'][0]['name'];
    if(isset($usernameDetail['data'][0]['email']) && !empty($usernameDetail['data'][0]['email']))
    {
        $username .= '<br/>'.$usernameDetail['data'][0]['email'];
    }
    if(isset($usernameDetail['data'][0]['phone']) && !empty($usernameDetail['data'][0]['phone']))
    {
        $username .= '<br/>'.$usernameDetail['data'][0]['phone'];
    }
    if(isset($usernameDetail['data'][0]['contact']) && !empty($usernameDetail['data'][0]['contact']))
    {
        $username .= '<br/>'.$usernameDetail['data'][0]['contact'];
    }
    

    $datetime=date("Y-m-d H:i:s a",$doc['createdOn']->sec);
    $checkbox="";
    $totalPrice = $doc['totalPrice'];
    $orderId = $doc['orderId'];
    $detaillist=json_decode($doc['priceinfoDetails'],true);
    
   // echo "<pre>"; print_r($detaillist); die;
    $detail = "<table border='1'><tr><td>Title</td><td>Ticket</td><td>Total</td></tr>";
    foreach ($detaillist as $key => $value) {
       
       if(isset($value['ticket']) && !empty($value['ticket']))
       {
            $detail .= "<tr><td>".$value['title']."</td><td>".$value['ticket']."</td><td>".$value['total']."</td></tr>";
            //$detail .=$value['title']."-".$value['ticket']."-".$value['total'].'<br/>';
       }
    }
    $detail .= "</table>";
    
    $other_fields=array('orderId'=>$orderId,'date'=>$datetime,'title'=>$getProductTitle,'username'=>$username,'action'=>$action_buttons,'status'=>$status[$doc['venueStatus']],"user_avatar"=>$user_avatar,"description"=>$detail,"totalPrice"=>$totalPrice);
    
    
    $doc=array_merge($doc,$other_fields);
    $output['aaData'][] = $doc;
    //$output['aaData'][]=;
} 
}
 $end=microtime();
 //echo $end-$start;
 //print_r($output);
echo json_encode( $output );
