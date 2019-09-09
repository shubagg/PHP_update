<?php
$con = mysqli_connect("p:".MYSQL_HOST,MYSQL_USER,MYSQL_PASS) or die('Could not connect to mysqli database : ' . mysqli_error());
mysqli_select_db($con,MYSQL_DB) or die ('Can\'t use mysqli database : ' .MYSQL_DB." Error-- ". mysql_error());
/*$mysql_con = mysql_pconnect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS) or die('Could not connect mysql database : ' . mysql_error());
mysql_select_db(MYSQL_DB) or die ('Can\'t use mysql database: ' . mysql_error());*/
function insert_mysql($data,$table)
{
    global $con;
    if(isset($data['id'])){unset($data['id']);}
    $insert_string1=array();
    $insert_string2=array();
    foreach($data as $key=>$value)
    {
        array_push($insert_string1,"`".$key."`");
        array_push($insert_string2,"'".$value."'");
    }
   $insert_string1=implode(",",$insert_string1);
   $insert_string2=implode(",",$insert_string2);
    $query="insert into $table ($insert_string1) VALUES($insert_string2)";
   $insertQuery=mysqli_query($con,$query);
   if($insertQuery)
   {
        return array("success"=>"true","data"=>mysqli_insert_id($con));
   }
   else
   {
        return array("success"=>"false","data"=>mysqli_error($con));
   }
}

function update_mysql($data,$table,$condition)
{   

    global $con;
    $id='';
    if(isset($data['id'])){
    $id=$data['id'];
    unset($data['id']);}
    $update_string=array();
    foreach($data as $key=>$value)
    {
        array_push($update_string,"`$key`='$value'");
    }
    $update_string=implode(",",$update_string);
    $query="update $table set $update_string where $condition";
    $updateQuery=mysqli_query($con,$query);

    if($updateQuery)
    {
        return array("success"=>"true","data"=>$id);
    }
    else
    {
        return array("success"=>"false","data"=>mysqli_error($con));
    }
}

function update_counter($field,$value,$table,$condition)
{
    global $con;
    $id="";
   $query="update $table set $field=$field+$value where $condition";
   $updateQuery=mysqli_query($con,$query);
    if($updateQuery)
    {
        return array("success"=>"true","data"=>$id);
    }
    else
    {
        return array("success"=>"false","data"=>mysqli_error($con));
    }
}

function Select_Some($fields,$table,$conditions)
{
    global $con;
    $query="Select $fields from $table where $conditions";
    
    $get_data=mysqli_query($con,$query);
    if($get_data)
    {
        if(mysqli_num_rows($get_data)>0)
        {    
            return $get_data;
        }
        else
        {
            return array("success"=>"false","data"=>"No data available");
        }
    }
    else
    {
        return array("success"=>"false","data"=>mysqli_error($con));
    }
    
}


function Select_All($fields,$table)
{
    global $con;
    $query="Select $fields from $table";
    //print_r($query);
    $get_data=mysqli_query($con,$query);
    if($get_data)
    {
        if(mysqli_num_rows($get_data)>0)
        {
            return $get_data;
        }
        else
        {
            return array("success"=>"false","data"=>"No data available");
        }
    }
    else
    {
        return array("success"=>"false","data"=>mysqli_error($con));
    }
    
}

function get_ids_to_delete($table,$condition)
{
    global $con;
    $ids=array();
    $get_ids=mysqli_query($con,"select id from $table  where $condition");
    while($fet_ids=mysqli_fetch_assoc($get_ids))
    {
        array_push($ids,$fet_ids['id']);
    }
    return $ids;
}

function delete_mysql($table,$condition)
{
    global $con;
    $query="delete from $table where $condition";
    $delete=mysqli_query($con,$query);
    if($delete)
    {
        return array("success"=>"true","data"=>$query);
    }
    else
    {
        return array("success"=>"false","data"=>mysqli_error($con));
    }
}

function select_record($tbl, $select = '*', $join = '', $where = '', $group_by = '', $start = 0, $limit = 'ALL', $order_by = '') {
    global $con;
    $query = "Select {$select} from `{$tbl}`";
    if (!empty($join)) {
        $query .= " $join";
    }
    if (!empty($where)) {
        $query .= " WHERE {$where}";
    }
    if (!empty($group_by)) {
        $query .= " GROUP BY {$group_by}";
    }
    if (!empty($order_by)) {
        $query .= " ORDER BY {$order_by}";
    }
    if ($limit != 'ALL') {
        $query .= " LIMIT {$start}, {$limit}";
    }
    
    $get_data = mysqli_query($con, $query);
    if ($get_data) {
        if (mysqli_num_rows($get_data) > 0) {
            return array("success" => "true", "data" => $get_data);
        } else {
            return array("success" => "false", "data" => "No data available");
        }
    } else {
        return array("success" => "false", "data" => mysqli_error($con));
    }
}

function sql_query($query) {
    global $con;
    $get_data = mysqli_query($con, $query);
    if($get_data) {
        if(mysqli_num_rows($get_data)>0) {
            return array("success" => "true","data" => $get_data);
        }
        else {
            return array("success"=>"false","data" => "No data available");
        }
    }
    else {
        return array("success"=>"false","data" => mysqli_error($con));
    }
}

function select_records($tbl, $select = '*', $join = '', $where = '', $group_by = '', $start = 0, $limit = 'ALL', $order_by = '') {
    global $con;
    $courses=array();
    $query = "Select {$select} from `{$tbl}`";
    if(!empty($join)) {
        $query .= " $join";
    }
    if(!empty($where)) {
        $query .= " WHERE {$where}";
    }
    if(!empty($group_by)) {
        $query .= " GROUP BY {$group_by}";
    }
    if(!empty($order_by)) {
        $query .= " ORDER BY {$order_by}";
    }
    if($limit != 'ALL') {
        $query .= " LIMIT {$start}, {$limit}";
    }
    // echo $query;
    // die;
    $get_data = mysqli_query($con, $query);

    if($get_data) {
        
        if(mysqli_num_rows($get_data)>0) {

            return array("success" => "true","data" => $get_data);
        }
        else {
            return array("success"=>"false","data" => "No data available");
        }
    }
    else {
        return array("success"=>"false","data" => mysqli_error($con));
    }
}


function direct_mysql_query($query) {
    global $con;
    //$query = "delete from $table where $condition";
    $result = mysqli_query($con, $query);
    if ($result) {
        return array("success" => "true", "data" => $result);
    } else {
        return array("success" => "false", "data" => mysqli_error($con));
    }
}

?>
