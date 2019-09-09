<?php

//error_reporting(0);
$path = include_module_path("export", "core/");
include_once(include_module_path("export", "core/Excel/PHPExcel.php"));
include_once(include_module_path("export", "core/Excel/reader.php"));

$objPHPExcel = new PHPExcel();

function DataTableExport_xls($header_fields, $show_data) {

    global $path;
    global $objPHPExcel;
    header('Content-Type: text/html; charset=ISO-8859-1');
    $alpha = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ", "BA", "BB", "BC", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BK", "BL", "BM", "BN", "BO", "BP", "BQ", "BR", "BS", "BT", "BU", "BV", "BW", "BX", "BY", "BZ");
    $kk = 0;

    $head = array('S.no');
    $head = array_merge($head, $header_fields);
    $styleArray = array(
        'font' => array(
            'color' => array('rgb' => 'FFFFFF'),
    ));
    $objPHPExcel->getActiveSheet()->getStyle('A1:Z999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($styleArray);
    foreach ($head as $newfield) {

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($alpha[$kk] . '1', $newfield);
        cellColor($alpha[$kk] . '1', '203764');
        $kk++;
    }
    $j = 2;

    foreach ($show_data as $data) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha[0] . $j, $j - 1);
        $i = 1;
        foreach ($data as $dt) {

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha[$i] . $j, $dt);
            //$objPHPExcel->getActiveSheet()->getColumnDimension($alpha[$i].$j)->setAutoSize(true);
            if (filter_var($dt, FILTER_VALIDATE_URL)) {
                $objPHPExcel->getActiveSheet()->getCell($alpha[$i] . $j)->getHyperlink()->setUrl($dt)->setTooltip('Click here to access file');
            }
            $i++;
        }
        $j++;
    }
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
        $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

        $sheet = $objPHPExcel->getActiveSheet();
        $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);
        // @var PHPExcel_Cell $cell 
    }
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $savexls = $objWriter->save(str_replace('.php', '.xls', __FILE__));

    $file_name = explode(".", __FILE__);
    $current_file = $file_name[0] . ".xls";
    $time = time();
    $uploaded_file = get_company_path() . $time . ".xls";

    rename($current_file, $uploaded_file);

    return array("success" => "true", "path" => get_upload_dir_url() . $time . ".xls");
}

function DataTableExportReport_xls($header_fields, $show_data) {
    global $path;
    global $objPHPExcel;
    header('Content-Type: text/html; charset=ISO-8859-1');
    // header('Content-Type: application/vnd.ms-excel'); 
    $alpha = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ", "BA", "BB", "BC", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BK", "BL", "BM", "BN", "BO", "BP", "BQ", "BR", "BS", "BT", "BU", "BV", "BW", "BX", "BY", "BZ");
    $kk = 0;

    // $head = array('S.no');
    //$head = array_merge($head, $header_fields);
    $head = $header_fields;
    /* $styleArray = array(
      'font' => array(
      'color' => array('rgb' => 'FFFFFF'),
      'bold'  => true,
      'size'  => 12,
      )); */
    $styleArray = array(
        'font' => array(
            'color' => array('rgb' => 'FFFFFF'),
            'bold' => true,
            'size' => 12,
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        ),
    );
    $objPHPExcel->getActiveSheet()->getStyle('A1:AZ1')->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    $objPHPExcel->getActiveSheet()->getStyle('A1:AZ1')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED);
    foreach ($head as $newfield) {

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($alpha[$kk] . '1', $newfield);
        cellColor($alpha[$kk] . '1', '203764');
        $kk++;
    }
    $j = 2;

    foreach ($show_data as $data => $value) {
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha[0] . $j, $j - 1);
        $i = 0;
        foreach ($value as $key => $dt) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha[$i] . $j, $dt);
            //$objPHPExcel->getActiveSheet()->getColumnDimension($alpha[$i].$j)->setAutoSize(true);
            if (filter_var($dt, FILTER_VALIDATE_URL)) {
                $objPHPExcel->getActiveSheet()->getCell($alpha[$i] . $j)->getHyperlink()->setUrl($dt)->setTooltip('Click here to access file');
            }
            $i++;
        }
        $j++;
    }
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
        $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

        $sheet = $objPHPExcel->getActiveSheet();
        $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);
        // @var PHPExcel_Cell $cell 
        foreach ($cellIterator as $cell) {
            $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
        }
    }
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //pr(__FILE__);die;
    $savexls = $objWriter->save(str_replace('.php', '.xls', __FILE__));
    $file_name = explode(".", __FILE__);
    $current_file = $file_name[0] . ".xls";
    $date = date('d-m-Y-H-i-s');
    //$time = date('H-i');
    $uploaded_file = get_company_path() . $date . ".xls";
    rename($current_file, $uploaded_file);
    return array("success" => "true", "path" => get_upload_dir_url() . $date . ".xls");
}

function export_xls($headerFields, $showData) {


    global $path;
    global $objPHPExcel;
    $alpha = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ", "BA", "BB", "BC", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BK", "BL", "BM", "BN", "BO", "BP", "BQ", "BR", "BS", "BT", "BU", "BV", "BW", "BX", "BY", "BZ");



    $zz = 0;
    foreach ($headerFields as $key => $value) {
        $kk = 0;
        if ($zz != count($headerFields)) {
            $objWorkSheet = $objPHPExcel->createSheet($zz);
        }

        $sheet = $objPHPExcel->getActiveSheet();
        $header_fields = $value['fields'];
        $show_data = $showData[$key];
        if ($zz > 0) {
            // pr($objPHPExcel->getActiveSheet());
            // pr($show_data); die;
        }

        $form_name = $value['name'];
        $head = array('S.no');
        $head = array_merge($head, $header_fields);
        $styleArray = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ff0000')
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($styleArray);
        foreach ($head as $newfield) {

            $objPHPExcel->setActiveSheetIndex($zz)
                    ->setCellValue($alpha[$kk] . '1', $newfield);
            cellColor($alpha[$kk] . '1', '00FF00');
            $kk++;
        }
        $j = 2;

        foreach ($show_data as $data) {

            $data = str_replace('+', ' ', $data);
            //pr($data); die;
            $objPHPExcel->setActiveSheetIndex($zz)->setCellValue($alpha[0] . $j, $j - 1);
            $i = 1;
            foreach ($data as $dt) {

                $objPHPExcel->setActiveSheetIndex($zz)->setCellValue($alpha[$i] . $j, $dt);
                //$objPHPExcel->getActiveSheet()->getColumnDimension($alpha[$i].$j)->setAutoSize(true);
                if (filter_var($dt, FILTER_VALIDATE_URL)) {
                    $objPHPExcel->getActiveSheet()->getCell($alpha[$i] . $j)->getHyperlink()->setUrl($dt)->setTooltip('Click here to access file');
                }

                $i++;
            }
            $j++;
        }

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

            $sheet = $objPHPExcel->getActiveSheet();
            $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            /** @var PHPExcel_Cell $cell */
        }
        $sheetTitle = str_replace(array('/'), array('-'), $form_name);
        $objWorkSheet->setTitle($sheetTitle);
        $zz++;
    }
    //Setting index when creating


    $objPHPExcel->removeSheetByIndex($zz);

    $objPHPExcel->setActiveSheetIndex(0);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $savexls = $objWriter->save(str_replace('.php', '.xls', __FILE__));

    $file_name = explode(".", __FILE__);
    $current_file = $file_name[0] . ".xls";
    $time = time();
    $uploaded_file = get_company_path() . $time . ".xls";

    rename($current_file, $uploaded_file);

    return array("success" => "true", "path" => get_upload_dir_url() . $time . ".xls");
}

function export_user_xls($data) {

    logger("1", $data, "", 5, "/export_user_xls");
    $check = check_key_available($data, array('header_fields', 'show_data', 'time', 'dirpath'));
    if ($check['success'] == 'true') {
        $header_fields = json_decode($data['header_fields'], true);

        $show_data = json_decode($data['show_data'], true);
        $time = $data['time'];
        $dirpath = $data['dirpath'];
        global $path;
        global $objPHPExcel;
        $alpha = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ", "BA", "BB", "BC", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BK", "BL", "BM", "BN", "BO", "BP", "BQ", "BR", "BS", "BT", "BU", "BV", "BW", "BX", "BY", "BZ");
        $kk = 0;

        $head = array('S.no');
        $head = array_merge($head, $header_fields);


        foreach ($head as $newfield) {

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($alpha[$kk] . '1', $newfield);
            cellColor($alpha[$kk] . '1', 'F28A8C');
            $kk++;
        }



        $j = 2;
        foreach ($show_data as $data) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha[0] . $j, $j - 1);
            $i = 1;
            foreach ($data as $dt) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha[$i] . $j, $dt);
                $objPHPExcel->getActiveSheet()->getColumnDimension($alpha[$i] . $j)->setAutoSize(true);

                $i++;
            }
            $j++;
        }



        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

            $sheet = $objPHPExcel->getActiveSheet();
            $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            /** @var PHPExcel_Cell $cell */
            foreach ($cellIterator as $cell) {
                $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
            }
        }



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $savexls = $objWriter->save(str_replace('.php', '.xls', __FILE__));

        $file_name = explode(".", __FILE__);
        $current_file = $file_name[0] . ".xls";
        $uploaded_file = $dirpath . "/" . $time . '/' . $time . ".xls";
        rename($current_file, $uploaded_file);
        return array("success" => "true");
    } else {
        return $check;
    }
}

function cellColor($cells, $color) {
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => $color
        )
    ));
}

function import_user_xls($data) {
    logger("1", $data, "", 5, "/import_user_xls");
    $reader = new Spreadsheet_Excel_Reader();
    $reader->setUTFEncoder('iconv');
    $reader->setOutputEncoding('UTF-8');
    //if (is_readable($data['tmp_name'])) {
    $reader->read($data['tmp_name']);
    $x = 1;
    $count = count($reader->sheets[0]["cells"]);
    $userId = 1;
    $action = 2;
    $image = 3;
    $name = 4;
    $email = 5;
    $password = 6;
    $role = 7;
    $category = 8;
    $user_type = 9;
    $login_type = 10;
    $status = 11;
    $gcm = 12;
    $deviceType = 13;
    $deviceId = 14;
    $designation = 15;
    $checkdata = 1;
    if ($count > 1) {

        for ($i = 2; $i <= $count; $i++) {
            if (isset($reader->sheets[0]["cells"][$i][$userId])) {
                $uid = $reader->sheets[0]["cells"][$i][$userId];
            }

            if (isset($reader->sheets[0]["cells"][$i][$email])) {
                $uemail = trim($reader->sheets[0]["cells"][$i][$email]);
            }
            if (isset($reader->sheets[0]["cells"][$i][$action])) {
                $uaction = trim($reader->sheets[0]["cells"][$i][$action]);
            }
            if (isset($reader->sheets[0]["cells"][$i][$image])) {
                $uimage = trim($reader->sheets[0]["cells"][$i][$image]);
            }
            if ($uaction == 'delete') {
                $check = check_userid_exists(array('userId' => $uid));
                if ($check['success'] == 'false') {
                    $checkdata = 0;
                    $msg = "userid is not exists in line no " . $i;
                    return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                }
            } else if ($uaction == 'edit') {
                $check = check_userid_exists(array('userId' => $uid));
                if ($check['success'] == 'false') {
                    $checkdata = 0;
                    $msg = "userid does not exists in line no " . $i;
                    return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                }
                /*   if($uemail!='')
                  {
                  if (!filter_var($uemail, FILTER_VALIDATE_EMAIL) === true) {
                  $checkdata = 0;
                  $msg="not a valid email id in line no ".$i;
                  return array('data'=>$msg,'error_code'=>'1036','success'=>'false');
                  break;
                  }
                  }
                  else
                  {
                  $checkdata = 0;
                  $msg="email id is blank in line no ".$i;
                  return array('data'=>$msg,'error_code'=>'1036','success'=>'false');
                  break;
                  }
                  $checkemail=check_emailid_exists(array('email'=>trim($uemail)));
                  if($checkemail['success']=='false')
                  {
                  $checkdata = 0;
                  $msg="email id already exists in line no ".$i;
                  return array('data'=>$msg,'error_code'=>'1036','success'=>'false');
                  break;
                  } */
                if ($uimage != "") {
                    $checkimage = check_image_exists(array('image_name' => trim($uimage), 'filename' => $data['filename']));
                    if ($checkimage['success'] == 'false') {
                        $checkdata = 0;
                        $msg = "image does not exists in line no " . $i;
                        return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                    }
                }
            } else if ($uaction == 'add' || $uaction == '') {
                if (!empty($uid) || $uid != 0) {
                    $checkdata = 0;
                    $msg = "userid is exists in line no " . $i;
                    return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                }

                if ($uemail != '') {
                    if (!filter_var($uemail, FILTER_VALIDATE_EMAIL) === true) {
                        $checkdata = 0;
                        $msg = "not a valid email id in line no " . $i;
                        return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                    }
                } else {
                    $checkdata = 0;
                    $msg = "email id is blank in line no " . $i;
                    return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                }

                $checkemail = check_emailid_exists(array('email' => trim($uemail)));
                if ($checkemail['success'] == 'false') {
                    $checkdata = 0;
                    $msg = "email id already exists in line no " . $i;
                    return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                }

                $checkimage = check_image_exists(array('image_name' => trim($uimage), 'filename' => $data['filename']));
                if ($checkimage['success'] == 'false') {
                    $checkdata = 0;
                    $msg = "image does not exists in line no " . $i;
                    return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
                }
            } else if ($uaction != 'add' || $uaction != 'edit' || $uaction != 'delete' || $uaction != '') {
                $msg = "action is not valid in line no " . $i;
                return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
            }
        }
        if ($checkdata == 1) {
            $dataInfo = insert_user_xls($data);
            return $dataInfo;
        }
    } else {
        $msg = "no data is available";
        return array('data' => $msg, 'error_code' => '1036', 'success' => 'false');
    }

    /* } else {
      $msg="file is not valid";
      return array('data'=>$msg,'error_code'=>'1036','success'=>'false');
      break;
      } */
}

function insert_user_xls($data) {
    logger("1", $data, "", 5, "/insert_user_xls");
    $reader = new Spreadsheet_Excel_Reader();
    $reader->setUTFEncoder('iconv');
    $reader->setOutputEncoding('UTF-8');
    $reader->read($data['tmp_name']);
    $x = 1;
    $count = count($reader->sheets[0]["cells"]);
    $userId = 1;
    $action = 2;
    $image = 3;
    $name = 4;
    $email = 5;
    $password = 6;
    $role = 7;
    $category = 8;
    $user_type = 9;
    $login_type = 10;
    $status = 11;
    $gcm = 12;
    $deviceType = 13;
    $deviceId = 14;
    $designation = 15;

    $row = array();
    for ($i = 2; $i <= $count; $i++) {
        $udesignation = '';
        $ucategory = '';
        $urole = '';
        $usrtype = '';
        $ustatus = '';

        if (isset($reader->sheets[0]["cells"][$i][$userId])) {
            $uid = trim($reader->sheets[0]["cells"][$i][$userId]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$category])) {
            $ucategory = trim($reader->sheets[0]["cells"][$i][$category]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$email])) {
            $usrname = trim($reader->sheets[0]["cells"][$i][$email]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$email])) {
            $uemail = trim($reader->sheets[0]["cells"][$i][$email]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$image])) {
            $uimage = trim($reader->sheets[0]["cells"][$i][$image]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$name])) {
            $uname = trim($reader->sheets[0]["cells"][$i][$name]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$password])) {
            $upassword = trim($reader->sheets[0]["cells"][$i][$password]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$role])) {
            $urole = trim($reader->sheets[0]["cells"][$i][$role]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$action])) {
            $uaction = trim($reader->sheets[0]["cells"][$i][$action]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$user_type])) {
            $usrtype = trim($reader->sheets[0]["cells"][$i][$user_type]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$login_type])) {
            $login_type = trim($reader->sheets[0]["cells"][$i][$login_type]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$status])) {
            $ustatus = trim($reader->sheets[0]["cells"][$i][$status]);
        }
        if (isset($reader->sheets[0]["cells"][$i][$designation])) {
            $udesignation = trim($reader->sheets[0]["cells"][$i][$designation]);
        }


        $col = array();
        if (isset($uaction)) {

            if ($uaction == 'add' || $uaction == '') {
                $result = manage_user(array('id' => 0, 'category' => $ucategory, 'username' => $uemail, 'email' => $uemail, 'name' => $uname, 'password' => $upassword, 'designation' => $udesignation, 'role' => $urole, 'user_type' => $usrtype, 'login_type' => $login_type, 'status' => $ustatus));
                if ($result['success'] == 'true') {
                    $aiid = $result['data'];

                    if ($uimage != "") {

                        $cid = get_company_data();
                        $comid = $cid['cid'];
                        $url = site_url() . 'company/' . $comid . '/uploads/import_image/' . $data['filename'] . '/' . $uimage;

                        $tmp = file_get_contents($url);

                        $array = explode('.', $url);
                        $ext = end($array);

                        $outputs = manage_media(array('id' => "0", 'smid' => "1", 'amid' => "1", 'asmid' => "1", 'aiid' => $aiid, 'mediaName' => "userImg", 'mediaType' => "image", 'userImg' => base64_encode($tmp), 'base64enc' => '1', 'extension' => $ext, 'multimedia' => 0, 'delete_previous' => 'true'));
                    }
                }
            } else if ($uaction == 'edit') {
                $result = manage_user(array('id' => $uid, 'category' => $ucategory, 'role' => $urole, 'name' => $uname, 'designation' => $udesignation, 'password' => $upassword, 'user_type' => $usrtype, 'login_type' => $login_type, 'status' => $ustatus));
                if ($result['success'] == 'true') {
                    $aiid = $uid;
                    $cid = get_company_data();
                    $comid = $cid['cid'];
                    $url = site_url() . 'company/' . $comid . '/uploads/import_image/' . $data['filename'] . '/' . $uimage;
                    $tmp = file_get_contents($url);
                    $array = explode('.', $url);
                    $ext = end($array);
                    $outputs = manage_media(array('id' => "0", 'smid' => "1", 'amid' => "1", 'asmid' => "1", 'aiid' => $aiid, 'mediaName' => "userImg", 'mediaType' => "image", 'userImg' => base64_encode($tmp), 'base64enc' => '1', 'extension' => $ext, 'multimedia' => 0, 'delete_previous' => 'true'));
                }
            } else if ($uaction == 'delete') {
                //echo $userid;
                $result = delete_user(array('id' => $uid));
            }
        }
    }
    return $result;
}

?>