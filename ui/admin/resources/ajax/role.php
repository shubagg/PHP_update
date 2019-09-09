<?php
include_once '../../../../global.php';


if(isset($_REQUEST['role_add12']))
{
    $role_id=$_REQUEST['role_id'];
    $role = trim(strtolower($_REQUEST['rolename']));
    if(isset($_POST['permission']) && $_POST['permission']!=""){$permission=implode("|",$_POST['permission']);}
    else{$permission="";}
        if($role_id!='0'){
            $output = curl_post("/manage_roles",array('id'=>$role_id,'title'=>$role,'permission'=>$permission));
        	echo json_encode($output);
        }
        else{        
        	$output = curl_post("/manage_roles",array('title'=>$role,'permission'=>$permission,'id'=>'0'));
        	echo json_encode($output);
        }
}

if(isset($_REQUEST['role_add']))
{

    $role_id=$_REQUEST['role_id'];
    $role = trim(strtolower($_REQUEST['rolename']));
    $specific_to=$_REQUEST['specific_to'];
    $deletable=$_REQUEST['deletable'];
    $result=array();
    $xyz=array();
    $abc=array();
    if(!isset($_POST['applyToHirarchy'])){ $_POST['applyToHirarchy']='0'; }
    if($_POST['permission']){
    
        $permission=implode("|",$_POST['permission']);
        $resourearr=$_POST['permission'];
        $arr1 = array();
        $arr2 = array();
        $arr3 = array();

        for($i=0;$i<count($resourearr);$i++)
        {
            $arr = explode("-",$resourearr[$i]);
            array_push($arr1,$arr[0]);

            $getarr1 = array();
        
                if(isset($arr2[$arr[0]]))
                {
                  
                    $getarr1 = $arr2[$arr[0]];
                }
            
            array_push($getarr1,$arr[1]);
            $arr2[$arr[0]] = array_unique(array_values($getarr1));
            $getarr2 = array();
        
                if(isset($arr3[$arr[1]]))
                {
                    $getarr2 = $arr3[$arr[1]];
                }
            
            array_push($getarr2,$arr[2]);
            $arr3[$arr[1]] = array_values($getarr2);
        }
        $moduleArr = array_unique($arr1);
        $finalarray= array();
            foreach ($moduleArr as $key1 => $value1) 
            {
                $submodarr = $arr2[$value1];
                $ar = array();
                foreach ($submodarr as $key2 => $value2) 
                {
                    $itemarr = $arr3[$value2];
                    $ar[$value2] = $itemarr;
                }

                $finalarray[$value1] = $ar;
            }
    }
    else{
        $permission="";
    }

    if($role_id!='0'){
        $output = manage_role(array('id'=>$role_id,'title'=>$role,'applyToHirarchy'=>$_POST['applyToHirarchy'],'specific_to'=>$specific_to,'deletable'=>$deletable,'permission'=>json_encode($finalarray)));
        echo json_encode($output);
    }
    else{        
        $output= manage_role(array('title'=>$role,'applyToHirarchy'=>$_POST['applyToHirarchy'],'specific_to'=>$specific_to,'deletable'=>$deletable,'permission'=>json_encode($finalarray),'id'=>'0'));
        echo json_encode($output);
    }
}

if(isset($_REQUEST['roleid']))
{
    $roleid = $_REQUEST['roleid'];
    $result=array();
    $mr1 = array();
    $single_role = get_roles(array("id"=>$roleid));
    $output=$single_role['data'][0];
    $userRole=json_decode($output['permission']);
    foreach ( $userRole as $key => $val) {
         
               
                foreach ($val as $key1 => $val1) {

                    foreach($val1 as $key2=>$val2){
                   
                        $mr1[]=$key.'-'.$key1.'-'.$val2;

                    }
                } 
            }
            $title=$output['title'];
            $specific_to=$output['specific_to'];
            $deletable=$output['deletable'];
            $result['specific_to']=$specific_to;
            $result['deletable']=$deletable;
            $result['applyToHirarchy']=$output['applyToHirarchy'];
            $result['title']=$title;
            $result['permission']=$mr1;
            echo json_encode($result);
}

if(isset($_REQUEST['role_data_id']))
{
    $output=delete_role(array('id'=>$_REQUEST['role_data_id']));
    echo json_encode($output);
}
?>
