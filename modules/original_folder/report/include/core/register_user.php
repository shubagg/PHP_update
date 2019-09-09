<?php

function get_register_user_report($data)
{
    $filterFields = json_decode($data['jsonArr'],true);
    $fields1 = array();
    $fields2 = array();
    $reportName="";
    $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array('setting','fields','reportName'));
    $fetdata = add_id($getdata,"id");
    if($fetdata[0])
    {

        $fields1 = $fetdata[0]['setting']['defaultFields'];
        $fields2 = $fetdata[0]['setting']['allFields'];
        $reportName = $fetdata[0]['reportName'];
    }
    $fields = array();
    $fields = shortArrayByKey($fields2,'order');
    $fields1 = shortArrayByKey($fields1,'order');
    $thead = array();
    $fieldArr = array();

    foreach ($fields as $fkey => $fvalue) 
    {
        array_push($thead,$fvalue['fieldName']);
        
    }
    foreach ($fields1 as $fkey1 => $fvalue1) 
    {
       
        array_push($fieldArr,$fvalue1['fieldName']);
    }

    $condition = array();
    $filterFieldsArr = array();
    $startDate="";
    $endDate="";
    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            case "fromDate":
                $condition['start'] = $value;
                $startDate=$value;
                array_push($filterFieldsArr, $value);
            break;
            case "toDate":
                $condition['end'] = $value;
                $endDate=$value;
                array_push($filterFieldsArr, $value);
            break;
            case "dateType":
                $dateType=$value;
            break;
        }
    }
    if($endDate==''){
        $endDate=$startDate;
    }
    if($dateType=='week')
    {
        $tmp=getAllWeeksDate($startDate,$endDate);
    }
    else if($dateType=='month')
    {
        $tmp=getAllMonthDate($startDate,$endDate);
    }
    else
    {
        $tmp=createDateRangeArray($startDate,$endDate);
    }
   // print_r($tmp);die;
    if(!empty($tmp))
    {
        
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $blogArray = array();
        $newFieldArr=array();
        array_push($headArr, "Date");
        array_push($headArr, "users");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp as $key=>$value) 
        {
           
            $rowchart = array();
            if($dateType=='week' || $dateType=='month')
            {
                $totalUsers = count_register_user(array('start'=>$value[0],'end'=>$value[1]));
                $userInfo   = get_users_according_date(array('start'=>$value[0],'end'=>$value[1]));
                array_push($rowchart, $value[1]);
                array_push($rowchart, $totalUsers);
            }
            else
            {
                $totalUsers = count_register_user(array('start'=>$value,'end'=>$value));
                $userInfo   = get_users_according_date(array('start'=>$value,'end'=>$value));
                array_push($rowchart, $value);
                array_push($rowchart, $totalUsers);
            }
            foreach ($userInfo['data'] as $user) 
            {
                $row = array();
                $row1 = array();
                foreach ($fields as $fkey => $fvalue) 
                {

                    Switch($fvalue['fieldValue'])
                    {
                        case "name":
                            array_push($row,$user['name']);
                            $row1[] = $user['name'];
                        break;
                        case "email":
        
                            array_push($row,$user['email']);
                            $row1[] = $user['email'];
                        break;
                        case "phone":
        
                            array_push($row,$user['phone']);
                             $row1[] = $user['phone'];
                        break;
                        case "mediaName":
                            $mediaName="abc.jpg";
                            array_push($row,$mediaName);
                            $row1[] = $mediaName;
                        break;
                        
                        default: 
                            array_push($row,$value1[$fvalue['fieldValue']]);
                        break;
                    }
                    
                }
                array_push($blogArray,$row); 
                $newFieldArr[]=$row1;
            }
              
               array_push($chartArr, $rowchart);
              
               
            }

            
            array_unshift($chartArr, $headArr);
        
    }
    //print_r($blogArray);die;
    
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$blogArray,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName);
}


function count_register_user($data)
{
        logger("19",'',$data,5);
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        $condition['uploadedOn'] = array('$gte'=>$start,'$lt'=>$end);
        $condition['status']="1";
        //$condition['user_type']="user";
        $getdata = count_mongo("user",$condition);
        return $getdata;
}

function get_users_according_date($data)
{
        logger("19",'',$data,5);   
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        
        $condition['uploadedOn'] = array('$gte'=>$start,'$lt'=>$end);
        $condition['status']="1";
        //$condition['user_type']="user";

        $getdata = select_mongo("user",$condition);
        $return = add_id($getdata,"id");
        if($return[0])
        {
            $alldata=array();
            foreach($return as $ret)
            {
                array_push($alldata,$ret);
            }
            return array('data'=>$alldata,'error_code'=>'100','success'=>'true');
        }
        else
        {
            return array('data'=>"",'error_code'=>'101','success'=>'false');
        }
         
}

?>