<?php
include_once '../../../../global.php';

$get_jobs=get_pending_formjob(array("smid"=>3,'userid'=>$_SESSION['user']['user_id'],"form_id"=>$_POST['form_id']));

//$get_jobs=get_pending_formjob(array("smid"=>3,'userid'=>'599fb2d0942ffa6b30716f76',"form_id"=>$_POST['form_id']));
//pr($get_jobs); die;
if(!empty($get_jobs['data']))
{
$formIds = array();
foreach ($get_jobs['data'] as $temp_key => $temp_value) {
    
    $formIds[$temp_value['form_id']][] = $temp_value;  
}

$show_data=array();
$header_fields=array();
foreach ($formIds as $form_id => $jobData) {
    $getform=get_form_by_id(array('id'=>$form_id));
       // pr($getform); die;
    if(!count($getform['data']['0'])>0)
    {
        continue;
    }

    $getform= $getform['data']['0'];
    $headerdata=array();
    foreach ($getform['field'] as $formkey) {
        $headertitle=$formkey['title'];
        array_push($headerdata,$getform['strings']['en'][$headertitle]); 
    } 
    array_push($headerdata,$ui_string['fillperson']);  
    array_push($headerdata,$ui_string['fill_date']);  
    $header_fields[$form_id] = array("name"=>$getform['title'],'fields'=>$headerdata);
    foreach ($jobData as $job) {
        $form_data =json_decode($job['form_data']);

        $data=array();
        foreach ($getform['field'] as $fk => $fv) {
            foreach ($form_data as $key => $formvalue) {
                
                if($formvalue->id==$fv['id'])
                {
                    $fieldsvalueArray=array();
                    $value=array();
                    foreach ($formvalue->fields as $fieldsvalue) {
                        if(isset($fieldsvalue->val) && !empty($fieldsvalue->val))
                        {
                            if($formvalue->type=='image' || $formvalue->type=='signature' || $formvalue->type=='uploadVideo' || $formvalue->type=='recordVideo' || $formvalue->type=='uploadAudio' || $formvalue->type=='recordAudio'){
                                    $media='';
                            if($fieldsvalue->mediaId){
                               $media=get_media_by_id(array('id'=>$fieldsvalue->mediaId,'object'=>true));
                               $media=$media['data'][0];
                               if($media){
                                    array_push($fieldsvalueArray,$media['link']); 
                               }                    
                            }
                            }
                            else{
                            array_push($fieldsvalueArray,$fieldsvalue->val);
                            }
                        }
                        else
                        {
                            array_push($fieldsvalueArray,'');
                        } 
                        $value=implode(',',$fieldsvalueArray);
                    }
                    
                  array_push($data,$value); 
                }
                else
                {
                    //array_push($data,''); 
                }
             } 
            
        } 
       
        $user_details = curl_post("/get_resource_by_id", array("id" => $job['creator']));
        if(isset($user_details['data']['0']) && $user_details['data']['0']!=''){
            $value = $user_details['data']['0']['name'];
        }else {
            $value = '---' ;
        } 
        array_push($data,$value); 
        array_push($data,date('Y-m-d',$job['time']));
        $show_data[$form_id][] = $data;
    }
    
//array_push($show_data,$data);  
//array_push($header_fields,$headerdata); 
}
//pr($header_fields);die;

//pr($header_fields); pr($show_data); die;
$export_xls=export_xls($header_fields,$show_data);
//pr($export_xls); die;
//$ex=curl_post("/export_xls",array("header_fields"=>json_encode($headerdata),"show_data"=>json_encode($show_data)));
echo json_encode($export_xls);
}
else
{
echo json_encode(array('data'=>'','success'=>'false','errorcode'=>'101'));
}
?>
