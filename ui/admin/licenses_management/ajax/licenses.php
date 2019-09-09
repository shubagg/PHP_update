<?php
$noclose = true;
include_once '../../../../global.php';
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
} else {
    $action = '';
}
global $companyId;
if ($action == 'lrequest') {
    $licenses_request=get_licenses_request(array('id'=>$_POST['id']));
    if($licenses_request['success']=='true')
    {
        $no_of_licenses =0;
        $lic_required = $_POST['no_of_licenses'] + $no_of_licenses;
        if(isset($licenses_request['data'][0]['no_of_licenses']))
        {
            $no_of_licenses=$licenses_request['data'][0]['no_of_licenses'];
            $lic_required = $_POST['no_of_licenses'] + $no_of_licenses;
        }
        if($licenses_request['data'][0]['lic_required']>=$lic_required)
        {


            // licenses creation mandatory parameter
            $params = json_encode(array('license_quantity'=>$_POST['no_of_licenses'],'company_name'=>$licenses_request['data'][0]['company'],'location'=>$licenses_request['data'][0]['country'],'request_date'=>$licenses_request['data'][0]['request_date'],'time_period'=>$licenses_request['data'][0]['time_period'],'license_type'=>$licenses_request['data'][0]['licenses_type'],'user_name'=>$licenses_request['data'][0]['fname']." ".$licenses_request['data'][0]['lname'],'email'=>$licenses_request['data'][0]['email'],'designation'=>$licenses_request['data'][0]['list_of_departments'],'company_id'=>$licenses_request['data'][0]['id']));

            // licenses creation url
            $url ="http://192.168.1.12:400/license";
            $output = nikky_curl_post_execute($url,$params);
            if($output['success']=='true')
            {
                $mid=$output['mediaName'];
                //$mid="5cdfe3ce90941b58163c986a";
                $mediaNameInfo = get_media_by_id(array('id'=>$mid));
                if($mediaNameInfo['success']=='true')
                {
                    $mediaName =$mediaNameInfo['data'][0]['mediaName'].".zip";
                }
                if(!empty($output['data'])){
                    foreach ($output['data'] as $value) {
                        $lparam = array('company_id'=>$licenses_request['data'][0]['id'],'licenses_no'=>$value,'licenses_generation_data'=>date("Y-m-d"),'createdOn'=>new MongoDate(),'assign_status'=>'0','active_status'=>'0','licenses_file'=>$mediaName);

                       // insert company licenses 
                       // insert_mongo('licensesStatusHistory', $lparam);
                    }
                }
                $nlicenses = $no_of_licenses + $_POST['no_of_licenses'];

                // send notification to comany owner for licenses download
                insert_notification(array('customerId'=>$companyId,'mid'=>'55','smid'=>'1','userId'=>$licenses_request['data'][0]['userId'],'itemId'=>$mediaName,'eid'=>"305",'extra'=>$params));
                manage_licenses_request(array('id'=>$_POST['id'],'no_of_licenses'=>$nlicenses,'lrequest'=>'1'));
                $data['_id']=new MongoId();

                $data['companyId'] =$_POST['id'];
                $data['uploadedOn']=new MongoDate();
                $data['requestdOn']=new MongoDate();
                $data['no_of_licenses']=$_POST['no_of_licenses'];
                $ret=insert_mongo('licensesGenerateHistory',$data);
            }
            else
            {
                $licenses_request=array('data'=>$output['message'],"error_code"=>'116','success'=>'false');
            }
            
        }
        else
        {
            $licenses_request=array('data'=>"Enter Valid No Of Licenses","error_code"=>'116','success'=>'false');
        }
        
    }
    echo json_encode($licenses_request);
}
if ($action == 'statusupdate') 
{
    $output = status_update($_POST);
    echo json_encode($output);
}
if ($action == 'IPrequest') 
{
    $output = ip_address_update($_POST);
    echo json_encode($output);
}

if ($action == 'updateServerConfiguration') 
{
    $output = update_server_configuration($_POST);
    echo json_encode($output);
}
if ($action == 'statusactive') 
{ 
    $output = company_active_status($_POST);
    echo json_encode($output);
}
if ($action == 'delete') 
{ 
    $output = company_deactive_status(array('mid'=>$_POST['id'],'status'=>'del'));
    echo json_encode($output);
}
if ($action == 'licstatusupdate') 
{ 
    $output = company_deactive_status(array('mid'=>$_POST['id'],'status'=>'upd'));
    echo json_encode($output);
}

if ($action == 'po_request') 
{ 
    $output =  manage_po_request($_POST);
    echo json_encode($output);
}

if ($action == 'po_number_verify') 
{ 
    if($_POST['po_number']=='0')
    {
        echo json_encode(array('data'=>'','error_code'=>'100','success'=>'false'));
    }
    else
    {
        $query['po_number'] = $_POST['po_number'];
        $fields = array();
        $tmp = select_mongo('poRequest',$query,$fields);
        $return=add_id($tmp,"id");
        if(isset($return[0]) && $return[0]>0)
        {
            $cond['po_verify'] ='1';
            $update = update_mongo('licensesRequest',$cond,array('_id'=> new MongoId($_POST['id'])));
            if($update['n'] == 1)
            {
                echo json_encode(array('data'=>'','error_code'=>'100','success'=>'true'));
            }
            else
            {
                 echo json_encode(array('data'=>'','error_code'=>'101','success'=>'false'));
            }
        }
        else
        {
            echo json_encode(array('data'=>'','error_code'=>'100','success'=>'false'));
        }
    }
}
?>
