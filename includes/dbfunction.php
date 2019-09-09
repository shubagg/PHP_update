<?php
function data_array($data) {
    $arr = array();
    foreach ($data as $key => $val) {
        array_push($arr, $val);
    }
    return $arr;
}

function check_key_available($array, $keys) {
    $all_keys = array();
    foreach ($array as $key => $value) {
        array_push($all_keys, $key);
    }
    $check = array_diff($keys, $all_keys);
    if (sizeof($check) == 0) {
        return array('data' => '', 'error_code' => '100', 'success' => 'true');
    } else {
        return array('data' => implode(",", $check), 'error_code' => '116', 'success' => 'false');
    }
}

function check_unique_field($data) {
    $check = check_key_available($data, array('table', 'field', 'value', 'id'));
    if ($check['success'] == 'true') {
        $fields = explode("|", $data['field']);
        $values = explode("|", $data['value']);
        $countArray = array();
        $retArray = array();

        if ($data['id']) {
            for ($chl = 0; $chl < sizeof($fields); $chl++) {
                $count = count_mongo($data['table'], array($fields[$chl] => $values[$chl], '_id' => array('$ne' => new MongoId($data['id']))));
                array_push($countArray, $count);
                array_push($retArray, array('field' => $fields[$chl], 'value' => $values[$chl], 'total' => $count));
            }
        } else {

            for ($chl = 0; $chl < sizeof($fields); $chl++) {
                $count = count_mongo($data['table'], array($fields[$chl] => $values[$chl]));

                array_push($countArray, $count);
                array_push($retArray, array('field' => $fields[$chl], 'value' => $values[$chl], 'total' => $count));
            }
        }


        if (in_array('0', $countArray)) {
            return array('success' => 'true', 'data' => '', 'error_code' => '100');
        } else {
            return array('success' => 'false', 'data' => $retArray, 'error_code' => '117');
        }
    } else {
        $check['error_code'] = '119';
        return $check;
    }
}

function join_mongo($table1, $table2, $localField, $foreignField, $data = array(), $sortcond = array(), $index = 0, $nor = 0, $groupcond = array()) {

    global $db;
    $cond = array(
        array(
            '$lookup' => array(
                "from" => $table2,
                "localField" => $localField,
                "foreignField" => $foreignField,
                "as" => "joinData"
            ),
        )
    );
    if (sizeof($sortcond)) {
        array_push($cond, array('$sort' => $sortcond));
    }
    if (sizeof($data)) {
        array_push($cond, array('$match' => $data));
    }
    if ($nor) {
        array_push($cond, array('$skip' => (int) $index));
        array_push($cond, array('$limit' => (int) $nor));
    }
    if (sizeof($groupcond)) {
        array_push($cond, array('$group' => $groupcond));
    }

    //for mongodb 3.6
    $res = $db->$table1->aggregate($cond, array('cursor' => array('batchSize' => (int) ($nor ? $nor : 100000))));
    return $res['result'];
}

function innerjoin_mongo($table1, $table2, $localField, $foreignField, $data = array(), $sortcond = array(), $index = 0, $nor = 0, $groupcond = array()) {

    global $db;
    $cond = array(
        array(
            '$lookup' => array(
                "from" => $table2,
                "localField" => $localField,
                "foreignField" => $foreignField,
                "as" => "joinData"
            ),
        ),
        array(
            '$unwind' => array(
                'path' => '$joinData',
                'preserveNullAndEmptyArrays' => false
            )
        )
    );
    if (sizeof($sortcond)) {
        array_push($cond, array('$sort' => $sortcond));
    }
    if (sizeof($data)) {
        array_push($cond, array('$match' => $data));
    }
    if ($nor) {
        array_push($cond, array('$skip' => (int) $index));
        array_push($cond, array('$limit' => (int) $nor));
    }
    if (sizeof($groupcond)) {
        array_push($cond, array('$group' => $groupcond));
    }

    //for mongodb 3.6
    $res = $db->$table1->aggregate($cond, array('cursor' => array('batchSize' => (int) ($nor ? $nor : 100000))));
    if (!empty($res['result'])) {
        return $res['result'];
    } else {
        return $res['cursor']['firstBatch'];
    }
}

function insert_mongo($table, $data) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$data['cid'] = $com_data['cid'];
        //$data['scid'] = $com_data['scid'];
    }

    $res = $db->$table->insert($data);
    return $res;
}

function update_mongo($table, $data, $condition) {
    global $db;
    if (isset($data['$unset'])) {
        $res = $db->$table->update($condition, $data, array("multiple" => true));
    } else {
        $res = $db->$table->update($condition, array('$set' => $data), array("multiple" => true));
    }
    return $res;
}

function update_push_mongo($table, $data, $condition) {
    global $db;
    $res = $db->$table->update($condition, array('$push' => $data), array("multiple" => true));
    return $res;
}

function delete_mongo($table, $condition) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$condition['cid'] = $com_data['cid'];
        //$condition['scid'] = $com_data['scid'];
    }

    $res = $db->$table->remove($condition);
    return $res;
}

function select_mongo($table, $condition, $params = array()) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //  $condition['cid'] = $com_data['cid'];
        //  $condition['scid'] = $com_data['scid'];
    }
    $res = $db->$table->find($condition, $params);
    return $res;
}

function select_all_mongo($table) {
    global $db;
    $condition = array();
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$condition['cid'] = $com_data['cid'];
        //$condition['scid'] = $com_data['scid'];
    }
    $res = $db->$table->find($condition);
    return $res;
}

function increament_field_mongo($table, $fieldsToIncreament, $condition) {
    global $db;
    $res = $db->$table->update($condition, array('$inc' => $fieldsToIncreament), array("multiple" => true));
    return $res;
}

function count_mongo($table, $condition = array()) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$condition['cid'] = $com_data['cid'];
        //$condition['scid'] = $com_data['scid'];
    }
    $res = $db->$table->count($condition);
    return $res;
}

function select_limit_mongo($table, $condition, $params = array(), $index, $nrecords) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$condition['cid'] = $com_data['cid'];
        //$condition['scid'] = $com_data['scid'];
    }
    $res = $db->$table->find($condition, $params)->limit(intval($nrecords))->skip(intval($index));
    return $res;
}

function select_sort_mongo($table, $condition, $params = array(), $sortcond) {
    global $db;
    $res = $db->$table->find($condition, $params)->sort($sortcond);
    return $res;
}

function select_sort_limit_mongo($table, $condition, $params = array(), $sortcond, $index, $nrecords) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$condition['cid'] = $com_data['cid'];
        //$condition['scid'] = $com_data['scid'];
    }
    $res = $db->$table->find($condition, $params)->sort($sortcond)->limit(intval($nrecords))->skip(intval($index));
    return $res;
}

function select_limitonly_mongo($table, $condition, $params = array(), $nrecords) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$condition['cid'] = $com_data['cid'];
        //$condition['scid'] = $com_data['scid'];
    }
    $res = $db->$table->find($condition, $params)->limit(intval($nrecords));
    return $res;
}

function select_sort_limitonly_mongo($table, $condition, $params = array(), $sortcond, $nrecords) {
    global $db;
    $com_data = get_company_data();
    if (isset($com_data['cid']) && $com_data['cid'] != '') {
        //$condition['cid'] = $com_data['cid'];
        //$condition['scid'] = $com_data['scid'];
    }
    $res = $db->$table->find($condition, $params)->sort($sortcond)->limit(intval($nrecords));
    return $res;
}

function get_avg_mongo($table, $condition) {
    global $db;
    //$cond = $db->$table->aggregate(array(array('$group'=> array('_id'=>'','avgValue'=>array('$avg'=>'$rating')))));
    $cond = $db->$table->aggregate(array(array('$group' => array('_id' => '', 'avgValue' => $condition))));
    return $cond['result'][0]['avgValue'];
}

function db_id($tmp) {
    if (isset($tmp['_id']))
        return $tmp['_id']->{'$id'};
    return false;
}

function add_id($tmp, $field_name = "id", $time = false, $time_field = "creation_date") {
    $arr = array();
    if (is_array($tmp) || $tmp->count()) {
        if (!empty($tmp)) {
            foreach ($tmp as $key => $val) {
                $val[$field_name] = db_id($val);
                unset($val['_id']);
                //if($time)
                //	$val[$time_field]=strtotime($val[$time_field]);
                array_push($arr, $val);
            }
        }
    }

    return $arr;
}

function add_id_multi($tmp1, $field_name = "id", $lang = "en") {
    $arr = array();
    if ($tmp1->count()) {
        foreach ($tmp1 as $key => $val) {
            $val[$field_name] = db_id($val);
            unset($val['_id']);
            $tmp = array();
            foreach ($val as $key1 => $val1) {
                if (strpos($key1, "_")) {
                    $t = explode("_", $key1);
                    if ($t[1] == $lang)
                        $tmp[$t[0]] = $val1;
                }
                else {
                    $tmp[$key1] = $val1;
                }
            }
            //if($time)
            //	$val[$time_field]=strtotime($val[$time_field]);
            array_push($arr, $tmp);
        }
    }

    return $arr;
}

function mongo_time() {
    date_default_timezone_set("UTC");
    //$created_at = date('Y-m-d H:i:s',time());
    //$created_at = "2015-07-27 11:04:42";
    $created_at = new MongoDate(time());
    return $created_at;
}

function add_id_multi_mysql($tmp1, $lang = "en") {
    $arr = array();
    foreach ($tmp1 as $key => $val) {
        $tmp = array();
        foreach ($val as $key1 => $val1) {

            if (strpos($key1, "_")) {
                $t = explode("_", $key1);
                if ($t[1] == $lang)
                    $tmp[$t[0]] = $val1;
            }
            else {
                $tmp[$key1] = $val1;
            }
        }
//if($time)
//	$val[$time_field]=strtotime($val[$time_field]);
        array_push($arr, $tmp);
    }
    return $arr;
}

function select_groupby_mongo($table, $condition, $groupBy, $total) {
    global $db;
    $com_data = get_company_data();
    //for mongodb 3.4
    /* $res = $db->$table->aggregate(array(
      array('$match'=>$condition),
      array('$group'=>array('_id'=>$groupBy, 'count'=>array('$sum'=>1))),
      array('$sort'=>array('count'=>-1)),
      array('$limit'=>$total)
      )); */
    //for mongodb 3.6
    $res = $db->$table->aggregate(
            array(
        array('$match' => $condition),
        array('$group' => array('_id' => $groupBy, 'count' => array('$sum' => 1))),
        array('$sort' => array('count' => -1)),
            ), array('cursor' => array('batchSize' => $total))
    );

    return $res;
}

function select_distinct_mongo($table, $condition) {
    global $db;
    $res = $db->$table->distinct($condition);
    return $res;
}

function object_check_unique_field($data) {
    $check = check_key_available($data, array('table', 'field', 'value', 'field1', 'value1', 'id'));
    if ($check['success'] == 'true') {
        $fields = explode("|", $data['field']);
        $values = explode("|", $data['value']);
        $fields1 = explode("|", $data['field1']);
        $values1 = explode("|", $data['value1']);
        $countArray = array();
        $retArray = array();
        if ($data['id']) {
            for ($chl = 0; $chl < sizeof($fields); $chl++) {
                $count = count_mongo($data['table'], array($fields[$chl] => $values[$chl], $fields1[$chl] => $values1[$chl], '_id' => array('$ne' => new MongoId($data['id']))));
                array_push($countArray, $count);
                array_push($retArray, array('field' => $fields[$chl], 'value' => $values[$chl], 'field1' => $fields1[$chl], 'value1' => $values1[$chl], 'total' => $count));
            }
        } else {
            for ($chl = 0; $chl < sizeof($fields); $chl++) {
                $count = count_mongo($data['table'], array($fields[$chl] => $values[$chl], $fields1[$chl] => $values1[$chl]));
                array_push($countArray, $count);
                array_push($retArray, array('field' => $fields[$chl], 'value' => $values[$chl], 'field1' => $fields1[$chl], 'value1' => $values1[$chl], 'total' => $count));
            }
        }
        if (in_array('0', $countArray)) {
            return array('success' => 'true', 'data' => '', 'error_code' => '100');
        } else {
            return array('success' => 'false', 'data' => $retArray, 'error_code' => '117');
        }
    } else {
        $check['error_code'] = '119';
        return $check;
    }
}
?>