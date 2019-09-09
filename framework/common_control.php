<?php
function createDropdown($key,$htmlControlJson,$paramJson = array())
{


	switch ($key) 
	{
		case "COURSE_LIST":
			if(!is_array($paramJson))
			{
				$paramJson = array();
			}
			$chart_data = curl_post("/get_course_list",$paramJson);	
			$data = $chart_data['data'];
			$option = '<option value="-1" >All</option>';
			foreach($data as $singleCourseArray)
			{
				if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
				{
					if($htmlControlJson['selected_value']==$singleCourseArray['course_id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$singleCourseArray['course_id'].'" '.$selected.'>'.$singleCourseArray['c_name'].'</option>';
			}
			$htmlControlJson['option_result'] = $option;
			$html = get_select_box($htmlControlJson);
		break;
		
		case "COUNTRY_LIST":
		
		if(!is_array($paramJson))
			{
				$paramJson = array();
			}
			
			$chart_data = curl_post("/get_country",$paramJson);	
			$data = $chart_data['data'];
			$option = '<option value="-1" >All</option>';
			foreach($data as $singleCourseArray)
			{
				if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
				{
					if($htmlControlJson['selected_value']==$singleCourseArray['country_id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$singleCourseArray['country_id'].'" '.$selected.'>'.$singleCourseArray['country_name'].'</option>';
			}
			$htmlControlJson['option_result'] = $option;
			$html = get_select_box($htmlControlJson);
		
		
		break;
		
		case "STATE_LIST":
		if(!is_array($paramJson))
			{
				$paramJson = array();
			}
			
			$chart_data = curl_post("/get_states",$paramJson);	
			$data = $chart_data['data'];
			$option = '<option value="-1" >All</option>';
			foreach($data as $singleCourseArray)
			{
				if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
				{
					if($htmlControlJson['selected_value']==$singleCourseArray['state_id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$singleCourseArray['state_id'].'" '.$selected.'>'.$singleCourseArray['state_name'].'</option>';
			}
			$htmlControlJson['option_result'] = $option;
			$html = get_select_box($htmlControlJson);
		
		break;
		
		case "CITY_LIST":
		
		if(!is_array($paramJson))
			{
				$paramJson = array();
			}
			
			$chart_data = curl_post("/get_cities",$paramJson);	
			$data = $chart_data['data'];
			$option = '<option value="-1" >All</option>';
			foreach($data as $singleCourseArray)
			{
				if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
				{
					if($htmlControlJson['selected_value']==$singleCourseArray['city_id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$singleCourseArray['city_id'].'" '.$selected.'>'.$singleCourseArray['city_name'].'</option>';
			}
			$htmlControlJson['option_result'] = $option;
			$html = get_select_box($htmlControlJson);
		break;
		
		case "PRODUCT_LIST":
		if(!is_array($paramJson))
			{
				$paramJson = array();
			}
			
			$chart_data = curl_post("/get_product_by_id",$paramJson);	
			//pr($chart_data);
			$data = $chart_data['data'];
			$option = '<option value="-1" >All</option>';
			foreach($data as $singleCourseArray)
			{
				if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
				{
					if($htmlControlJson['selected_value']==$singleCourseArray['id'])
					{
						$selected = 'selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$singleCourseArray['id'].'" '.$selected.'>'.$singleCourseArray['title'].'</option>';
			}
			$htmlControlJson['option_result'] = $option;
			$html = get_select_box($htmlControlJson);
		break;

		case "REFRESH_INTERVAL":
		
			if(!is_array($paramJson))
			{
				$paramJson = array();
			}
			
			$option .= '<option value="0" >Never</option>';
			for ($i=15; $i <= 60; $i+=15) { 

				if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
				{
					if($htmlControlJson['selected_value']==$i)
					{
						$selected = ' selected="selected"';
					}else
					{
						$selected = '';
					}
				}
				$option .= '<option value="'.$i.'" '.$selected.'>'.$i.' MIN</option>';
				
			}
			
			$htmlControlJson['option_result'] = $option;			
			
			 $html = get_select_box($htmlControlJson);
		break;

		case "LIMIT":


            if(!is_array($paramJson))
            {
                $paramJson = array();
            }

            if($htmlControlJson['selected_value'] == '1')
            {
                $selected1 = 'selected="selected"';
            }
            if($htmlControlJson['selected_value'] == '2')
            {
                $selected2 = 'selected="selected"';
            }
            if($htmlControlJson['selected_value'] == '3')
            {
                $selected3 = 'selected="selected"';
            }


            $option = '<option value="" >Select Limit</option>';
            $option .= '<option value="1" '.$selected1.' >1</option>';
            $option .= '<option value="2" '.$selected2.' >2</option>';
            $option .= '<option value="3" '.$selected3.' >3</option>';
            for ($i=5; $i <= 100 ; $i+=5) {

                if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
                {
                    if($htmlControlJson['selected_value']==$i)
                    {
                        $selected = 'selected="selected"';
                    }else
                    {
                        $selected = '';
                    }
                }
                $option .= '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

            }

            $htmlControlJson['option_result'] = $option;

             $html = get_select_box($htmlControlJson);
        break;

        case "TIME_PERIOD":
            if(!is_array($paramJson))
            {
                $paramJson = array();
            }

            $option = '<option value="" >Select Time Period</option>';


            if(isset($htmlControlJson['selected_value']) && $htmlControlJson['selected_value'] !='')
            {
                if($htmlControlJson['selected_value'] == '1-W')
                {
                    $selected1 = 'selected="selected"';
                }
                if($htmlControlJson['selected_value'] == '2-W')
                {
                    $selected2 = 'selected="selected"';
                }
                if($htmlControlJson['selected_value'] == '3-W')
                {
                    $selected3 = 'selected="selected"';
                }
                if($htmlControlJson['selected_value'] == '1-M')
                {
                    $selected4 = 'selected="selected"';
                }
                if($htmlControlJson['selected_value'] == '3-M')
                {
                    $selected5 = 'selected="selected"';
                }
                if($htmlControlJson['selected_value'] == '6-M')
                {
                    $selected6 = 'selected="selected"';
                }
                if($htmlControlJson['selected_value'] == '12-M')
                {
                    $selected12 = 'selected="selected"';
                }
                if($htmlControlJson['selected_value'] == '24-M')
                {
                    $selected24 = 'selected="selected"';
                }
            }
            $option .= '<option value="1-W" '.$selected1.'>1 Week</option>';
            $option .= '<option value="2-W" '.$selected2.'>2 Week</option>';
            $option .= '<option value="3-W" '.$selected3.'>3 Week</option>';
            $option .= '<option value="1-M" '.$selected4.'>1 Month</option>';
            $option .= '<option value="3-M" '.$selected5.'>3 Month</option>';
            $option .= '<option value="6-M" '.$selected6.'>6 Month</option>';
            $option .= '<option value="12-M" '.$selected12.'>12 Month</option>';
            $option .= '<option value="24-M" '.$selected24.'>24 Month</option>';

            $htmlControlJson['option_result'] = $option;

             $html = get_select_box($htmlControlJson);
        break; 
		
	}
	return $html;
	
}

?>