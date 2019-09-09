<?php
//$maindata=json_decode(str_replace("\\",'',trim($jsondata)),true);
$maindata = $arr;
//print_r($maindata);die;

$ms=time()*1000;
$l=sizeof($maindata);

for($i=0;$i<$l;$i++)
{
    $len=sizeof($maindata[$i]['uid1']);
    $data=$maindata[$i];
    
    if($data['used_for']=="desk")
    {
        $dwn="0";
    }
    else
    {
        $dwn="0";
    }
    $c=0;$f=0;$f1=0;
    $str=$str1="";
    $user_arr=array();

    $itemData =  (isset($data['data'])) ? $data['data'] : '' ;
    $uiSetting =  (isset($data['uiSetting'])) ? $data['uiSetting'] : '' ;
    $pmsg =  (isset($data['pmsg'])) ? $data['pmsg'] : '' ;
    $select = select_mongo('triggers',array('mid'=>$data['moduleid'],'smid'=>$data['submoduleid'],'eid'=>$data['eventid'],'status'=>'1','type'=>'push'));
    $fetch = add_id($select,'id');
    $pushMessage=array();
    if($fetch)
    {
        $pushMessage=$fetch[0];
    }
    
    foreach($maindata[$i]['uid1'] as $userid)
    {
            $userInfo=get_resource_by_id(array('id'=>$userid,'fields'=>'currentLang'));

            if($userInfo['success']=='true')
            {
                if(isset($userInfo['data'][0]['currentLang']) && $userInfo['data'][0]['currentLang']!="")
                {
                   $data['pmsg']=$pushMessage['msg_'.$userInfo['data'][0]['currentLang']];
                   $pmsg = $pushMessage['msg_'.$userInfo['data'][0]['currentLang']];

                }
            }
            if(isset($data['pushTitle']) && $data['pushTitle']!="")
            {
                $pmsg = $data['pushTitle'];
            }
            if(isset($data['ms']) && $data['ms']!="")
            {
                $ms = $data['ms'];
            }
         
            $data['userId'] = $userid;
            $data['seen'] = "0";
            $data['id'] = "0";
            $data['download'] = $dwn;
            $data['ms'] = $ms;
            $data['status'] = "0";
            $data['matchdata'] = $matchdata;
            $data['cdata'] = $itemData;
            //$data['uiSetting'] = $uiSetting;
            manage_notification($data);

        if($data['uid5'])
        {   
            for($j=0;$j<sizeof($data['uid5'][$c]);$j++)
            {
              
                $uid=$data['uid5'][$c][$j];
                $userInfo=get_resource_by_id(array('id'=>$uid,'fields'=>'currentLang'));
                if($userInfo['success']=='true')
                {
                    if(isset($userInfo['data'][0]['currentLang']) && $userInfo['data'][0]['currentLang']!="")
                    {
                       $data['pmsg']=$pushMessage['msg_'.$userInfo['data'][0]['currentLang']];
                       $pmsg = $pushMessage['msg_'.$userInfo['data'][0]['currentLang']];

                    }
                }

                if(isset($data['pushTitle']) && $data['pushTitle']!="")
                {
                    $pmsg = $data['pushTitle'];
                }
                if(isset($data['ms']) && $data['ms']!="")
                {
                    $ms = $data['ms'];
                }
                
                $data['userId'] = $uid;
                $data['seen'] = "0";
                $data['id'] = "0";
                $data['download'] = $dwn;
                $data['ms'] = $ms;
                $data['status'] = "0";
                $data['matchdata'] = $matchdata;
		        $data['cdata'] = $itemData;
               // $data['uiSetting'] = $uiSetting;
                manage_notification($data);
                
                //$getstringtxt = get_strings_by_id(array("id"=>"$data[stringid]"));
                //$getstringtxt = $getstringtxt['data'][0];
               
                $arr2=array("sid"=>$data['stringid'],"mid"=>$data['moduleid'],"smid"=>$data['submoduleid'],"eid"=>$data['eventid'],"u1"=>$uid,"u2"=>$data['uid2'],"u3"=>$data['uid3'],"u4"=>$data['uid4'],"u5"=>"","t"=>$pmsg,"ms"=>$ms,"cdata"=>$itemData,"uiSetting"=>$uiSetting);
                
               
                array_push($user_arr,$uid);
                
            }
        }
        $c++;
       
       
        //$getstringtxt = get_strings_by_id(array("id"=>"$data[stringid]"));
        //$getstringtxt = $getstringtxt['data'][0];
        
        $arr2=array("sid"=>$data['stringid'],"mid"=>$data['moduleid'],"smid"=>$data['submoduleid'],"eid"=>$data['eventid'],"u1"=>$userid,"u2"=>$data['uid2'],"u3"=>$data['uid3'],"u4"=>$data['uid4'],"u5"=>"","t"=>$pmsg,"ms"=>$ms,"cdata"=>$itemData,"cdata"=>$itemData,"uiSetting"=>$uiSetting);
      
        array_push($user_arr,$userid);
        
    }    
    
    if($p==1)
    {
        if(sizeof($user_arr)>0)
        {
           $this->send_push_on_device($user_arr,$arr2);
        }
    }
    
}
?>
