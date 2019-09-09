<?php
    function report_webservice_get_report_uidata_by_mid()
	{
		$postvar = get_post_data();
		$result = get_report_uidata_by_mid($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"19");
	}
	function report_webservice_get_report_data()
	{
		$postvar = get_post_data();
		$result = get_report_data($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"19");
	}

	function report_webservice_top_selling_product()
    {
        $postvar=get_post_data();
        $return=get_top_selling_product($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function report_webservice_report_list()
    {
        $postvar=get_post_data();
        $return=get_report_list($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function report_webservice_report_name()
    {
        $postvar=get_post_data();
        $return=get_report_name($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function report_webservice_get_survey_test()
    {
        $postvar=get_post_data();
        $return=get_survey_test($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }



	
?>
