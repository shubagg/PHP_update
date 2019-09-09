<?php

$sla_json_data = array(
    'sla_adv_data' => array(
        'search_key' => array('sla_key_adv_blank', 'sla_adv_priority', 'sla_adv_status', 'sla_adv_assignee', 'sla_adv_label'),
        'search_equivalent' => array('sla_equ_adv_blank', 'sla_adv_is_equal_to','sla_adv_is_not_equal_to'),
        'search_value' => array('sla_val_adv_blank')
    ),
    'sla_key_search_key' => array('sla_adv_priority' => 'priority', 'sla_adv_status' => 'status', 'sla_adv_assignee' => 'assignee', 'sla_adv_label' => 'label'),
    'sla_key_search_equivalent' => array('sla_adv_is_equal_to' => 'is_equal', 'sla_adv_is_not_equal_to' => 'is_not_equal')
);