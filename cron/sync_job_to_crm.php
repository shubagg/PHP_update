<?php
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
global $con;
$currentDate=date("Y-m-d H:i:s");
logger("5","CRM Cron Start","",5,"/sync_job_in_local");
echo "<pre>";
$client_secret="npTnK0146GJ87fBiD04A3/7vVQH1E9FY+tYOqkQBLCo=";
$client_id='ea7763fb-e355-4e46-8b70-839c710617de';
//$resource='https://aintuincsandbox.crm.dynamics.com';
//$authUrl='https://login.windows.net/08bea408-7085-4dde-bdce-122e690bf0c4/oauth2/token';
//$api_to_call='https://aintuincsandbox.api.crm.dynamics.com/api/data/v8.2/pcl_RetailerOnBoarding';
//$api_to_call_for_document_upload='https://aintuincsandbox.api.crm.dynamics.com/api/data/v8.2/pcl_DocumentUploadAPI';


$resource='https://aintuinc.crm.dynamics.com';
$authUrl='https://login.windows.net/08bea408-7085-4dde-bdce-122e690bf0c4/oauth2/token';
$api_to_call='https://aintuinc.api.crm.dynamics.com/api/data/v8.2/pcl_RetailerOnBoarding';
$api_to_call_for_document_upload='https://aintuinc.api.crm.dynamics.com/api/data/v8.2/pcl_DocumentUploadAPI';


$access_token=get_token(2);
echo $return=send_to_ms_crm($access_token);
echo $upload_doc=upload_document($access_token);

//$postData=urldecode(urlencode($postData));


function upload_document($access_token)
{
	global $api_to_call_for_document_upload,$con,$media_url;
	$get_media=mysqli_query($con,"select * from job_media_sync where status=0 and crm_id!=''");
	while($fet_media=mysqli_fetch_assoc($get_media))
	{
		$media=get_media_by_id(array('id'=>$fet_media['media_id']));
		
		$mediaCode=base64_encode(file_get_contents($media_url.'images/'.$media['data'][0]['mediaName']));
	
		$request=array(
			"RetailerId"=>$fet_media['crm_id'],
			"DocumentName"=>$fet_media['mediaName'],
			"DocumentBody"=>$mediaCode,
			"DocumentMimeType"=>'image/png',
			"TargetEntity"=>'account'
			);
		
		$request=json_encode($request);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $api_to_call_for_document_upload);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token['data']));

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$crm_response = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			print_r($crm_response);
			//print_r($httpcode);
			
			if($httpcode==200)
			{
				mysqli_query($con,"update job_media_sync set status=1 where id='$fet_media[id]'");
				array_push($response,'true');
			}
			else
			{
				array_push($response,'false');
				logger("5","REQUEST : ".json_encode($request)."   RESPONSE : ".$crm_response,"CRM MEDIA UPLOAD ERROR",5,"/sync_job_to_crm");
			}
			//if($httpcode=='401'){  $token=get_token(2); send_to_ms_crm($token); }
			curl_close($ch);
	}
}

function send_to_ms_crm($access_token)
{
	global $api_to_call,$con;
		$response=array();
		$get_jobs=mysqli_query($con,"Select j.id,j.title,j.form_data,j.form_id,js.id as jobsyncid from job j,job_sync js where j.id=js.job_id AND js.status=0");
		$totalRecords=mysqli_num_rows($get_jobs);
		while($fet_jobs=mysqli_fetch_assoc($get_jobs))
		{
			$formData=json_decode($fet_jobs['form_data'],true);
			
			$formatted_dob = get_field('35',$formData);
			if($formatted_dob!='')
			{
				$formatted_dob=date("Y-m-d",strtotime($formatted_dob));
			}
			
			
			$OpeningTime=get_field('16',$formData);
			$ClosingTime=get_field('17',$formData);
			$latlng = get_field('11',$formData);
			$lat = '';
			$lng = '';
			if($latlng!='')
			{
				$latlng = explode(',', $latlng);
				$lat = $latlng[0];
				$lng = $latlng[1];
			}
			
			$request=array(
			"RetailerName"=>get_field('2',$formData),
			"BankName"=>get_field('41',$formData),
			"BankAccountNo"=>get_field('42',$formData),
			"IFSCCode"=>get_field('43',$formData),
			"StorePANNo"=>get_field('26',$formData), //not available
			"BankAccountHolderName"=>get_field('44',$formData),
			"Owner_FullName"=>get_field('32',$formData),
			"BusinessType"=>get_field('21',$formData),
			"IDProofType"=>get_field('37',$formData),//not available
			"IDProofNo"=>get_field('38',$formData),//not available
			"AddressProofType"=>'',//get_field('43',$formData),
			"AddressProofNo"=>'',//get_field('44',$formData),
			"BillingSystem"=>get_field('14',$formData),
			"OutletFormat"=>get_field('22',$formData),
			"OpeningTime"=>$OpeningTime,
			"ClosingTime"=>$ClosingTime,
			"Street1"=>get_field('3',$formData),
			"Street2"=>get_field('4',$formData),
			"Street3"=>get_field('5',$formData),
			"Territory"=>get_field('10',$formData),
			"Area"=>get_field('6',$formData),
			"City"=>get_field('7',$formData),
			"State"=>get_field('8',$formData),
			"Country"=>"India",
			"Pincode"=>get_field('9',$formData),
			"Latitude"=>$lat,
			"Longitude"=>$lng,
			
			"ShopPhone"=>get_field('23',$formData),
			"StoreLandlineNo"=>get_field('24',$formData),
			"Email"=>get_field('34',$formData),
			
			"EstablishmentProof"=>get_field('28',$formData),
			"EntityProofType"=>get_field('27',$formData),
			"EntityProofNo"=>get_field('29',$formData),


			"StoreSizeinSqFoot"=>get_field('25',$formData),
			"BillCutsperDay"=>0,
			"No_Of_POS_Terminal"=>get_field('15',$formData),
			"Owner_MobilePhone"=>get_field('33',$formData),
			"Owner_Gender"=>get_field('36',$formData),
			"Owner_Email"=>get_field('34',$formData),
			"Owner_DOB"=>$formatted_dob,
			"Owner_Street1"=>'',//get_field('37',$formData),
			"Owner_Street2"=>'',//get_field('38',$formData),
			"Owner_Street3"=>'',//get_field('39',$formData),
			"Owner_City"=>'',//get_field('40',$formData),
			"Owner_Country"=>"India",
			"Owner_Pincode"=>'',//get_field('42',$formData),
			"Owner_State"=>'',//get_field('41',$formData),
			"WeeklyDayOff"=>get_field('18',$formData),
			"ChainStandAlone"=>get_field('12',$formData),
			"ParentChainName"=>get_field('13',$formData)
			);
			//$request=array("RetailerName"=>"Swaraj Generaj Store","BankName"=>"SBI","BankAccountNo"=>"SBI321","IFSCCode"=>"1221","StorePANNo"=>"9874563012","BankAccountHolderName"=>"Nita Ambani","Owner_FullName"=>"Nita","BusinessType"=>"2","IDProofType"=>"1","IDProofNo"=>"123","AddressProofType"=>"1","AddressProofNo"=>"1111","BillingSystem"=>"1","OutletFormat"=>"1","OpeningTime"=>"798330060","ClosingTime"=>"798330020","Street1"=>"Karve Road","Street2"=>"Venkatpura Naka","Street3"=>"Pune","Territory"=>"west","Area"=>"Pune","City"=>"Pune","State"=>"Maharashtra","Country"=>"India","Pincode"=>"411011","Latitude"=>"45","Longitude"=>"91","ShopPhone"=>"99887744502","StoreLandlineNo"=>"98745-123","Email"=>"sonia.rathi@pragmasys.in","EstablishmentProof"=>"ID Card","EntityProofType"=>"798330003","EntityProofNo"=>"123","StoreSizeinSqFoot"=>"12","BillCutsperDay"=>5,"No_Of_POS_Terminal"=>25,"Owner_MobilePhone"=>"999999991","Owner_Gender"=>"2","Owner_Email"=>"Nita@gmail.com","Owner_DOB"=>"2017-07-27","Owner_Street1"=>"Nita@gmail.com","Owner_Street2"=>"Pune","Owner_Street3"=>"Paud road","Owner_City"=>"Pune","Owner_Country"=>"India","Owner_Pincode"=>"411011","Owner_State"=>"Maharashtra");
			echo "<pre>";
			//print_r($request); die;
			$request=json_encode($request);
			echo $request;
			logger("5","REQUEST : ".json_encode($request)." CRMDATA  REQUEST : ".$crm_response,"CRMDATA  REQUEST",5,"/sync_job_to_crm");
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $api_to_call);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token['data']));

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$crm_response = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			print_r($crm_response);
			///die;
			//print_r($httpcode);
			if($httpcode==200)
			{
				$crm_response=json_decode($crm_response,true);
				echo "update job_media_sync set crm_id='$crm_response[RetailerId]' where job_id='$fet_jobs[id]'";
				mysqli_query($con,"update job_sync set status=1 where id='$fet_jobs[jobsyncid]'");
				mysqli_query($con,"update job_media_sync set crm_id='$crm_response[RetailerId]' where job_id='$fet_jobs[id]'");
				array_push($response,'true');
			}
			else
			{
				array_push($response,'false');
				logger("5","REQUEST : ".json_encode($request)."   RESPONSE : ".$crm_response,"CRM ERROR",5,"/sync_job_to_crm");
			}
			//if($httpcode=='401'){  $token=get_token(2); send_to_ms_crm($token); }
			curl_close($ch);
		}

		if($totalRecords==0)
		{
			return "2";
		}
		else
		{
			if(in_array('false', $response)){
				return "0";
			}else{
				return "1";
			}
		}
}


function get_token($type=1)
{
	global $resource,$client_id,$client_secret,$authUrl;
	$getToken=select_mongo('user',array('_id'=>new MongoId('569f7faa7c3d68011e3c9869')),array('crm_token'));
	$getToken=add_id($getToken);

	if($type==1)
	{
		$token=$getToken[0]['crm_token'];
		$access_token=array('success'=>'true','data'=>$token,'error_code'=>'100');
	}
	else
	{
		$token=new AccessTokenAuthentication();
		$access_token=$token->getTokens('client_credentials', $resource, $client_id, $client_secret, $authUrl);
		if($access_token['success']=='true')
		{
			update_mongo('user',array('crm_token'=>$access_token['data']),array('_id'=>new MongoId('569f7faa7c3d68011e3c9869')));
		}
	}
	return $access_token;
}

function get_field($id,$formData){
	$check=0;
	foreach($formData as $fdata){
		if('id-'.$id==$fdata['id']){
			if($fdata['fields'][0]['val'])
			{
				return $fdata['fields'][0]['val'];
			}
		}
	}
	return null;
}



class AccessTokenAuthentication {
    /*
     * Get the access token.
     *
     * @param string $grantType    Grant type.
     * @param string $scopeUrl     Application Scope URL.
     * @param string $clientID     Application client ID.
     * @param string $clientSecret Application client ID.
     * @param string $authUrl      Oauth Url.
     *
     * @return string.
     */
      function getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl){
                                    try {
            //Initialize the Curl Session.
            $ch = curl_init();
            //Create the request Array.
            $paramArr = array (
                 'grant_type'    => $grantType,
                 'resource'         => $scopeUrl,
                 'client_id'     => $clientID,
                 'client_secret' => $clientSecret
            );
            //Create an Http Query.//
            $paramArr = http_build_query($paramArr);
            //Set the Curl URL.
            curl_setopt($ch, CURLOPT_URL, $authUrl);
            //Set HTTP POST Request.
            curl_setopt($ch, CURLOPT_POST, TRUE);
            //Set data to POST in HTTP "POST" Operation.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramArr);
            //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //Execute the  cURL session.
            $strResponse = curl_exec($ch);
            //Get the Error Code returned by Curl.
            $curlErrno = curl_errno($ch);
            if($curlErrno){
                $curlError = curl_error($ch);
                logger("5",json_encode($curlError),"",5,"/sync_job_to_crm");
                return array('success'=>'false','data'=>json_encode($curlError),'error_code'=>'101');
                throw new Exception($curlError);
            }
            //Close the Curl Session.
            curl_close($ch);
            //Decode the returned JSON string.
            $objResponse = json_decode($strResponse);

            if (isset($objResponse->error)){
            	logger("5",json_encode($objResponse),"",5,"/sync_job_to_crm");
            	return array('success'=>'false','data'=>json_encode($objResponse),'error_code'=>'101');
                throw new Exception($objResponse->error_description);
            }
            return array('success'=>'true','data'=>$objResponse->access_token,'error_code'=>'100');
        } catch (Exception $e) {
        	return array('success'=>'false','data'=>$e->getMessage(),'error_code'=>'101');
            echo "Exception-".$e->getMessage();
        }
    }
}
?>