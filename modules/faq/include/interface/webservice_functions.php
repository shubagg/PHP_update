<?php
    function faq_webservice_add_faq()
	{
		$postvar = get_post_data();
		if(!isset($postvar['question'])&&!isset($postvar['answer']))
		{
			rs("","116","false");
		}
        if($postvar['id']==0)
        {
    		$arr = add_faq($postvar['question'],$postvar['answer'],$postvar['id']);
    		rs(array('faq_id'=>$arr));
        }
        else
		{
			$arr = update_faq($postvar['question'],$postvar['answer'],$postvar['id']);
    		rs(array('faq_data'=>$arr));
		}
	}
    
    function faq_webservice_get_faq()
	{
		$postvar = get_post_data();     
        if(!isset($postvar['id']))
		{
			rs("","116","false");
		}   
		$arr = get_faq($postvar['id']);
		rs(array('faq_data'=>$arr));
	}
    
    function faq_webservice_get_faqs()
	{
		$postvar = get_post_data();     
		$arr = get_faqs();
		rs(array('faq_data'=>$arr));
	}
    
    function faq_webservice_delete_faq()
	{
		$postvar = get_post_data(); 
        if(!isset($postvar['id']))
		{
			rs("","116","false");
		}        
		$arr = delete_faq($postvar['id']);
		rs(array('result'=>$arr));
	}
    
    
	
?>