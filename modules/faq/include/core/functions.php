<?php
function get_faq_count()
{
	global $db;
    $tmp = $db->faq->find()->count();
    return $tmp;
}

function add_faq($question,$answer,$id)
{
	global $db;
    $fields=array(
        'question'=>$question,
        'answer'=>$answer,
        'created_on'=> new MongoDate(),
        'status'=>0,
        '_id'=>new MongoId()
        );
   
    $res = $db->faq->insert($fields);
    if($res['n']==1)
    {
        return array("errorcode"=>"201","data"=>$fields);
    }
    else
    {
        $ins_id=db_id($fields);
        return $ins_id;
    }
}

function update_faq($question,$answer,$id)
{
	global $db;
    $fields=array(
        'question'=>$question,
        'answer'=>$answer
        );
    $cond=array(
        '_id'=>new MongoId($id)
    );
    
    $res = $db->faq->update($cond,array('$set'=>$fields));
    if($res['n']==0)
    {
        return array("errorcode"=>"202","data"=>$fields);
    }
    else
    {
        
        return array("success"=>"true");
    } 
}

function get_faqs()
{
	global $db;
    $res=$db->faq->find();  
    return add_id($res,"id");
}

function get_faq($id)
{
	global $db;
    $res=$db->faq->find(array('_id'=>new MongoId($id)));  

    $tmp = add_id($res,"id");
    return $tmp;
}

function delete_faq($id)
{
	global $db;
    $id = explode(",",$id);

    foreach ($id as $key => $val) {
        $id[$key] = new MongoId($val);
    }

    $res=$db->faq->remove(array('_id'=>array('$in'=> $id)));  

    return array("success"=>"true");
}
?>