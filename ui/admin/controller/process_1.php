<?php

class process {
    function __construct() {
        global $ui_string;
    }
    function call_process($data) {
        $this->process_data($data);
    }
    
    function process_data($data) {
        global $ui_string;
        $template = !empty($data['template']) ? $data['template'] : 'default';
        
//        $post_data = array("smid" => '2', 'id' => 0, 'projectId' => '585378576d955743303c9869', 'get_total' => 1);
//        $total_record_data = curl_post("/get_tickets", $post_data);
//        $total = 0;
//        $item_per_page = 2;
//        $current_page = 1;
//        if(!empty($total_record_data['data']['total'])) {
//            $total = $total_record_data['data']['total'];
//        }
//        $total_pages = ceil($total/$item_per_page);
//	unset($post_data['get_total']);
//        
//        //Get Record
//        $data['show_details'] = curl_post("/get_tickets", $post_data);
//        
//	//get starting position to fetch the records
//	$page_position = (($current_page-1) * $item_per_page);
////        $data['pagination'] = $this->paginate($item_per_page, $current_page, $total, $total_pages);
////        pr($data);
        $where = '';
        $qry_where = '';
        if(!empty($data['advanced_search_data'])) {
            if(!empty($data['advanced_search_data']['adv_search_key'])) {
                foreach($data['advanced_search_data']['adv_search_key'] as $k => $v) {
                    if(!empty($data['advanced_search_data']['adv_search_equivalent'][$k]) && !empty($data['advanced_search_data']['adv_search_value'][$k])) {
                        $qry_where .= '`'. $v . '` ' . $ui_string['db_' . $data['advanced_search_data']['adv_search_equivalent'][$k]] . ' "' . $data['advanced_search_data']['adv_search_value'][$k] . '" ' . $data['advanced_search_data']['adv_conditional_operator'][$k] . ' ';
                        $where .= $v . ' ' . $ui_string['db_' . $data['advanced_search_data']['adv_search_equivalent'][$k]] . ' ' . $data['advanced_search_data']['adv_search_value'][$k] . ' ' . $data['advanced_search_data']['adv_conditional_operator'][$k] . ' ';
                    }
                }
            }
        }
        //echo $qry_where;die;
        $adv_search_qry_where = rtrim($qry_where, ' AND ');
        $adv_search_qry_where = rtrim($qry_where, ' OR ');
        $adv_search_where = rtrim($where, ' AND ');
        $adv_search_where = rtrim($where, ' OR ');
        $data['adv_search_qry_where'] = $adv_search_qry_where;
        $data['adv_search_where'] = $adv_search_where;
        $this->set_template($template, $data);
    }

    function set_template($template, $request_data) {
        global $site_url;
        global $ui_string;
        include_once(include_admin_template("common_templates", $template));
    }
    
    ################ pagination function #########################################
    function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url = '') {
        $pagination = '';
        if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
            $pagination .= '<ul class="pagination">';

            $right_links = $current_page + 3;
            $previous = $current_page - 3; //previous link
            $next = $current_page + 1; //next link
            $first_link = true; //boolean var to decide our first link

            if ($current_page > 1) {
                $previous_link = ($previous == 0) ? 1 : $previous;
                $pagination .= '<li class="first"><a href="' . $page_url . '?page=1" title="First">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="' . $page_url . '?page=' . $previous_link . '" title="Previous">&lt;</a></li>'; //previous link
                for ($i = ($current_page - 2); $i < $current_page; $i++) { //Create left-hand side links
                    if ($i > 0) {
                        $pagination .= '<li><a href="' . $page_url . '?page=' . $i . '">' . $i . '</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if ($first_link) { //if current active page is first link
                $pagination .= '<li class="first active">' . $current_page . '</li>';
            } elseif ($current_page == $total_pages) { //if it's the last active link
                $pagination .= '<li class="last active">' . $current_page . '</li>';
            } else { //regular current link
                $pagination .= '<li class="active">' . $current_page . '</li>';
            }

            for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
                if ($i <= $total_pages) {
                    $pagination .= '<li><a href="' . $page_url . '?page=' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($current_page < $total_pages) {
                $next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="' . $page_url . '?page=' . $next_link . '" >&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="' . $page_url . '?page=' . $total_pages . '" title="Last">&raquo;</a></li>'; //last link
            }

            $pagination .= '</ul>';
        }
        return $pagination; //return pagination links
    }

}
?>