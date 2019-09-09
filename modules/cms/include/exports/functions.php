<?php

function pg_by_name($pg_heading)
{
    //$url = change_name($pg_heading);
    global $db;
    $tmp = $db->cms->find(array("pg_un_name"=>$pg_heading));
    $tmp = add_id($tmp,"id");
    return $tmp;
    }
function pg_by_id($id)
{
    
    global $db;
    $tmp = $db->cms->find(array('_id' => new MongoId($id)));
    $tmp = add_id($tmp,"id");
    return $tmp;
    
}
function pg_by_url($pg_url)
{
    //$url = change_name($pg_url);
    global $db;
    $tmp = $db->cms->find(array("pg_url"=>$pg_url));
    $tmp = add_id($tmp,"id");
    return $tmp;
    
}
function change_name($name)
{
    $input = $name;
    $input = trim($input," ");
    $input = preg_replace("/[[:blank:]]+/"," ",$input);
    return $name = str_replace(' ', '_', $input);
}

?>
