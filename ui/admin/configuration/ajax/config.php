<?php
include_once ('../../../../global.php');
    $action=$_REQUEST['action'];
    if($action=='title')
    {  
       if(isset($_POST['submit_type']) && $_POST['submit_type']=="save"){
        if(isset($_POST['title']) && $_POST['title']!=""){
             $totalCount = count_mongo('robotlistAssociate',array("name"=>$_POST['title'],"asid"=>$_POST['insertId'])); 
             if($totalCount==0 || $totalCount==1){
                echo "1";
             }else{
                echo "0";
             }
        }
        else{
            echo "0";
        }
       }
       else
        {
          echo "2"; 
        }
        
    }
?>
