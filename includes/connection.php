<?php
try{
     //$m = new MongoClient("mongodb://203.122.41.106:27017"); // connect
    $m = new MongoClient(MONGO_HOST); // connect
     //$m = new MongoClient(MONGO_HOST, array("username" => MONGO_USER, "password" => MONGO_PASS)); 
}
    catch (MongoConnectionException $exception)
{
    print_r($exception->getMessage());
}   
$v = MONGO_DB;
$db = $m->$v; // get the database named "foo"
?>

