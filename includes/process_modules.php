<?php
function get_module_path($name)
{
    return server_path()."modules/".$name."/";
}
function get_custom_module_path($name)
{
    $id = get_company_data();
    return server_path()."custom_modules/".$id['cid']."/".$name."/";
}
function get_module_url($name)
{
    return site_url()."modules/".$name."/";
}
function include_module_path($mod_name,$file)
{
    global $path,$inc_file;

    //echo get_module_path($mod_name);
    $path1 = get_module_path($mod_name)."include/".$file;
    return $path1;
}

function include_custom_module_path($mod_name,$file)
{
    global $path,$inc_file;
    
    //echo get_module_path($mod_name);
    $path1 = get_custom_module_path($mod_name)."include/".$file;
    return $path1;
}
function include_module_url($mod_name,$file)
{
    global $path,$inc_file;
    //echo get_module_path($mod_name);
    $path1 = get_module_url($mod_name)."include/".$file;
    return $path1;
}

function module_exists($name)
{
    echo get_module_url($name);
    if(file_exists(get_module_url($name)))
    {
        return true;
    }
    else
    {
        return false;
    }
}


function module_item_exists($mod,$item)
{
    //echo "chk = ".$mod."|".$item;
    if(module_exists($mod))
    {
        $data = $name();
        if(in_array($item,$data))
            return true;
        else
            return false;
    }
    else
    {
        return false;
    }
    
}
require_once($server_path."includes/modules_lists.php");
require_once($server_path."extensions/extension_modules_lists.php");

// $dir    = $server_path.'modules';
// $modules_list = scandir($dir);
// foreach ($modules_list as $key => $val) {
//     if($val=="."||$val=="..")
//         continue;
//     //echo "require_once($server_path.'modules"."/".$val."/".$val.".php');<br>";
//     require_once( $dir."/".$val."/".$val.".php");
// }
// custom modules
$cid = get_company_data();
if(isset($cid['cid'])&&$cid['cid']!=""){
    $dir    = $server_path.'custom_modules/'.$cid['cid'];
    if(is_dir($dir)){
    $modules_list = scandir($dir);
    if(!empty($modules_list)){
        foreach($modules_list as $key => $val){
            if($val=="."||$val=="..")
                continue;

            require_once $dir."/".$val."/".$val.".php";
        }
    }
}
}


//webservice funtions
function get_post_data()
{
    global $app;
    $postVar = $app->request->post();

    return $postVar;
    //
    //print_r($postVar);
    //print_r(json_decode($postVar['key'],ARRAY_A));
    if($postVar['key']!="")
        return json_decode($postVar['key'],ARRAY_A);
    return "";

}

function curl_post_ext($url,$params)
{

    global $curlDebug,$server_path;
    $postData = 'lang='.get_language().'&';
   //create name value pairs seperated by &
   foreach($params as $k => $v) 
   { 
      if(is_array($v))
      {
        $v = json_encode_advanced($v);
      }
     
        $postData .= $k . '='.$v.'&';
     
   }
   rtrim($postData, '&');

    $ch = curl_init(); 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
 
    $output=curl_exec($ch);
    curl_close($ch);
    if($curlDebug)
    {
        return $output;
    }
    else
    {
        if($output!="")
        {
            $output=json_decode($output,'ARRAY_A');
            if(isset($output['data']['refreshedToken'])){
                $_SESSION['user']['token']=$output['data']['refreshedToken'];
                unset($output['refreshedToken']);
            }
            return $output;
        }
    }
}
function curl_post($url,$params)
{
    global $webservice_url;
    if(isset($params['mid']))
    {
        $mid=$params['mid'];
        $smid=$params['smid'];
        $getUrl=module_access_url($mid,$smid);
        if($getUrl){ 
            $getUrl=json_decode($getUrl,true); 
            $webservice_url=$getUrl['access_url']."webservices";
        }
    }

    $parsedFunctionFromUrl=substr($url, 1);
    $url = $webservice_url.$url;
    if(OAUTH)
    {
        $params['refresh_token']=get_refresh_token();
        $params['token']=get_current_token();
        $params['client_id']='testclient';
        $params['client_secret']='testpass';
    }
    $params['deviceType']='web';
    return curl_post_ext($url,$params);
}
function curl_get($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
function curl_post_url($url,$data)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    return $server_output = curl_exec ($ch);
    
    curl_close ($ch);
}

function is_loged_in()
{
    if(isset($_SESSION['user_data']['username']))
    {
        return $_SESSION['user_data'];
    }
    else
    {
        return fam_close(fam);
    }
    
}

function get_admin_id()
{
    global $webservice_url,$db;
    $single_cat = curl_post($webservice_url."/get_category",array());
    $id="";
    foreach ($single_cat['category'] as $key => $value) {

        if($value['name']=="admin")
            $id= $value['id'];
    }
    if($id!="")
    {
        $arr1 = array();
        $arr = $db->user->find(array('category'=>array('$regex'=>$id,'$options'=>'i')));
        foreach ($arr as $key => $val) {
            array_push($arr1,db_id($val));
        }
        return $arr1;
    }
}

function add_association($table,$iid,$amid,$asmid,$aiid,$json)
{
    global $db;
    
    if($table=='jobAssociate' || $table=='courseAssociate')
    {
        $table=strtolower($table);
        manage_association($table,$iid,$amid,$asmid,$aiid,$json);
    }
    else
    {
        $com_data = get_company_data();
        $data = array('iid'=>$iid,'amid'=>$amid,'asmid'=>$asmid,'aiid'=>$aiid,'data'=>$json);
        if(isset($com_data['cid']) && $com_data['cid'] != '')
        {
            $data['cid'] = $com_data['cid'];
            $data['scid'] = $com_data['scid'];
        }
       $db->$table->update(array('iid'=>$iid,'amid'=>$amid,'asmid'=>$asmid,'aiid'=>$aiid),$data,array("upsert" => true));
    }   
}

function manage_association($table,$iid,$amid,$asmid,$aiid,$json)
{
    
    global $con;
    $com_data = get_company_data();
    $check_association=mysqli_query($con,"Select id from $table where iid='$iid' AND amid='$amid' AND asmid='$asmid' AND aiid='$aiid'");
    if(mysqli_num_rows($check_association)>0)
    {
        $data=array('data'=>json_encode($json));
        $manage_association=update_mysql($data,$table,"iid='$iid' AND amid='$amid' AND asmid='$asmid' AND aiid='$aiid'");
    }
    else
    {   //////change by nilesh for add company id
        $data=array('iid'=>$iid,'amid'=>$amid,'asmid'=>$asmid,'aiid'=>$aiid,'cid'=>$com_data['cid'],'scid'=>$com_data['scid'],'data'=>json_encode($json));
        $manage_association=insert_mysql($data,$table);    
    }
}



function remove_association($table,$iid,$amid,$asmid,$aiid)
{
//    global $db;
//    if($table=='jobAssociate' || $table=='courseAssociate')
//    {
//        $table=strtolower($table);
//        $cond='';
//        if($iid){ $cond.=" AND iid='$iid'"; }
//        if($aiid){ $cond.=" AND aiid='$aiid'"; }
//        if($amid){ $cond.=" AND amid='$amid'"; }
//        if($asmid){ $cond.=" AND asmid='$asmid'"; }
//        if($cond)
//        {
//            $delete_association=delete_mysql($table,"1 $cond");
//        }    
//    }
//    else
//    {  
//        $arr = array();
//        if($amid)
//            $arr['amid']=($amid);
//        if($asmid)
//            $arr['asmid']=($asmid);
//        if($iid)
//            $arr['iid']=($iid);
//        if($aiid)
//            $arr['aiid']=($aiid);
//	
//        if(count($arr)>0)
//         $db->$table->remove($arr);        
//    }   
}

function format_amid($amid,$asmid,$aiid)
{
    $amid = explode("|",$amid);
    $asmid = explode("|",$asmid);
    $aiid = explode("|",$aiid);

    $final_array=array();

    for ($i=0; $i <count($aiid) ; $i++) {
        $tmp_aiid = explode(";",$aiid[$i]);
        $tmp_asmid = explode(";",$asmid[$i]);
        for ($j=0; $j < count($tmp_aiid); $j++) {
            $tmp1 = explode("~",$tmp_aiid[$j]);

            foreach ($tmp1 as $key => $val) {
                array_push($final_array,array('amid'=>$amid[$i],'asmid'=>$tmp_asmid[$j],'aiid'=>$val));
            }
        }
    }
    return $final_array;
}

function remove_prev_association($mid,$iid)
{
    for ($i=1; $i < 39 ; $i++) { 
        $module = get_module($i);
        if($module=="-1")
            return;
        
        $table = $module."Associate";
        if($mid!=$i){ 
            remove_association($table,"",$mid,"",$iid);
        }
        else{
            remove_association($table,$iid,"","","");
        }
    }
}
//associate_module("1","10","2|3|4","12|13|14","22|23|24",array(),"add");
//remove_prev_association(1,10);
//get_association_data("1","2|3","12;13|14;15","21");
function get_association_data($mid,$amid,$asmid,$iid,$nor="")
{
    $default_pagi=10;
    $nor_chk=false;
    if($nor!=""){
        $nor = explode("|",$id);
    }
    else
    {
        $nor_chk=true;
        $nor = array();
    }
    $iid = explode("|",$iid);
    if(!is_array($iid))
        $iid = array($iid);
    $amid = explode("|",$amid);
    $asmid = explode("|",$asmid);
    $final = array();
    
        $cnt_nor=0;
        for ($i=0; $i <count($asmid) ; $i++) {
            $tmp_asmid = explode(";",$asmid[$i]);
            foreach ($tmp_asmid as $key => $val) {
                
                if($nor_chk)
                    $nor[$cnt_nor]=$default_pagi;

                $mod = get_module($amid[$i]);
                if(!isset($final[$mod]))
                    $final[$mod]=array();
                if(!isset($final[$mod][$val]))
                    $final[$mod][$val]=array();


                    foreach($iid as $key_id=>$val_id){
                        $final[$mod][$val][$val_id]=get_module_asso_id($val_id,$mid,$amid[$i],$val,$nor[$cnt_nor]);
                        
                    }
                //array_push($final[$mod][$val],get_module_asso_id($mid,$amid[$i],$val));
                    $cnt_nor++;
            }
        
    }
    return $final;

}

function get_module_asso_id($iid,$mid,$amid,$asmid,$nor)
{

    global $db;
    $table = $table1 = get_module($mid)."Associate";
    if($table=='courseAssociate' || $table=='jobAssociate')
    {
        $arr=array();
        $table=strtolower($table);
        $get=Select_Some("*","$table","iid=$iid AND amid=$amid AND asmid=$asmid");
        while($fet=mysqli_fetch_assoc($get))
        {
            array_push($arr,$fet);
        }
        
    }
    else
    {
        $data = array('iid'=>$iid,'amid'=>$amid,'asmid'=>$asmid);
        $com_data = get_company_data();
        if(isset($com_data['cid']) && $com_data['cid'] != '')
        {
            $data['cid'] = $com_data['cid'];
            $data['scid'] = $com_data['scid'];
        }
        $arr = $db->$table->find($data);
    }
    //$arr = $db->$table->find(array('iid'=>$iid,'amid'=>$amid,'asmid'=>$asmid));

    $aiid = array();
    foreach ($arr as $key => $val) {
        array_push($aiid,$val['aiid']);
    }
    if(count($aiid)>0)
        return get_module_data($amid,$aiid,$nor);
    return array();
}
function get_module_data($mid,$iid,$nor)
{

    global $db;
    $iid=array_filter($iid);
    $iid = implode("|",$iid);
    $modfunc = "get_".get_module($mid)."_by_id";
    $tmp = $modfunc(array('id'=>$iid,'index'=>0,'nor'=>intval($nor)));
    $final_arr = array();
    if($tmp['success']=='true'){
        return $tmp['data'];
    }
    //return $final;
}
function associate_module($mid,$iid,$amid,$asmid,$aiid,$json=array(),$action="add",$remove_prev=true)
{
    //echo "mid--".$mid."iid--".$iid."amid--".$amid."asmid".$asmid."aiid".$aiid; die;
    //$notifyData=$json['notify'];
    //unset($json['notify']);
    if($remove_prev){

        remove_prev_association($mid,$iid);
        //file_put_contents("asdas.txt",$remove_prev);
    }
	
    $format_amid = format_amid($amid,$asmid,$aiid);
   
    $notificationData=array();
    foreach ($format_amid as $key => $val) {
        
        $module = get_module($val['amid']);
        $table = $module."Associate";
        $table1 = get_module($mid)."Associate";
        if($action=="add")
        {
            add_association($table,$val['aiid'],$mid,$val['asmid'],$iid,$json);
            add_association($table1,$iid,$val['amid'],$val['asmid'],$val['aiid'],$json);
        }
        else
        {
            remove_association($table,$val['aiid'],$mid,$val['asmid'],$iid);
            remove_association($table1,$iid,$val['amid'],$val['asmid'],$val['aiid']);
        }
    }
    
}


function get_module($mid)
{
    switch ($mid) {
        case 1:
            return "resource";
        break;

        case 2:
            return "course";
            
        break;

        case 3:
            return "notification";
            
        break;

        case 4:
            return "approval";
            
        break;

        case 5:
            return 'job';
            
        break;

        case 6:
            return "forum";
            
        break;

        case 7:
            return "blog";
            
        break;

        case 8:
            return "comment";
            
        break;

        case 9:
            return "discount";
            
        break;

        case 10:
            return "media";
            
        break;

        case 11:
            return "location";
            
        break;

        case 12:
            return "assignment";
            
        break;

        case 13:
            return "ad_Management";
            
        break;

        case 14:
            return "cart";
            
        break;
        
        case 15:
            return "faq";
            
        break;

        case 16:
            return "product";
            
        break;

        case 17:
            return "setting";
            
        break;

        case 18:
            return "login";
            
        break;

        case 19:
            return "sample";
            
        break;
        case 20:
            return "device";

        case 21:
            return "company";
        break;
        case 22:
            return "attendance";
        break;
        case 23:
            return "news";
        break;
        case 24:
            return "cms";
        break;
        case 25:
            return "event";
        break;
        case 28:
            return "report";
        break;
        
        case 32:
            return "project";
        break;
        case 35:
            return "chat";
        break;
        case 36:
            return "announcement";
        break;
        case 32:
            return "project";
        break;
        case 37:
            return "slm";
        break;
        case 38:
            return "calendar";
        break;
        case 39:
            return "dashboard";
        break;
        case 40:
            return "form";
        break;
        case 41:
            return "inventory";
        case 42:
            return "approvalprocess";
        break;
        case 50:
            return "rpa";
        break;
        case 55:
            return "licenses";
        default:
          return "-1";
        break;
    }
}

function get_module_by_name($mn)
{
    switch ($mn) {
        case "resources":
            return 1;
        break;
        
        case "course":
            return 2;    
        break;

        
        case "notification":
            return 3;   
        break;

        
        case "approval":
            return 4;    
        break;

        
        case "job":
            return 5;    
        break;

        
        case "forum":
            return 6;    
        break;

        
        case "blog":
            return 7;    
        break;

        
        case "comment":
            return 8;    
        break;

        
        case "discount":
            return 9;
        break;

        case "media":
            return 10;
        break;

        case "location":
            return 11;  
        break;

        case "assignment":
            return 12;
        break;

        case "ad_Management":
            return 13;
        break;

        case "cart":
            return 14;  
        break;
        
        case "faq":
            return 15;
        break;

        case "product":
            return 16;
        break;

        case "setting":
            return 17;
        break;

        case "login":
            return 18; 
        break;

        case "sample":
            return 19;
        break;

        case "device":
            return 20;
        break;    

        case "company":
            return 21;
        break;
        case "attendance":
            return 22;
        break;
        case "news":
            return 23;
        break;
        case "cms":
            return 24;
        break;
        case "report":
            return 28;
        break;
        case "project":
            return 32;
        break;
        case "chat":
            return 35;
        break;
        case "announcement":
            return 36;
        break;
        case "project":
            return 32;
        break;
        case "slm":
            return 37;
        break;
        case "calendar":
            return 38;
        break;
        case "dashboard":
            return 39;
        break;
        case "form":
            return 40;
        case "inventory":
            return 41;
        case "approvalprocess":
            return 42;
        break;
        case "rpa":
            return 50;
        break;
        case "licenses":
            return 55;
        default:
          return "-1";
        break;
    }
}

function memcache_delete1($key)
{
    global $db;
    $db->memcache->remove(array('key'=>$key));
}
function memcache($key,$value="")
{
    global $db;
    if($value=="")
    {
        $arr = $db->memcache->find(array('key'=>$key));
            $arr = add_id($arr);
            if(count($arr)>0)
                return $arr[0]['value'];
    }
    else
    {
        $db->memcache->update(array('key'=>$key),array('key'=>$key,'value'=>$value),array("upsert" => true));
    }
        
}

function set_page_name($pn)
{
    global $pagename;
    $pagename=$pn;
}
?>
