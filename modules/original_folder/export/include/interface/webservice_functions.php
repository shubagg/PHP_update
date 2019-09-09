<?php
function export_webservice_export_xls()
{
    $postvar = get_post_data();
    $header_fields=json_decode($postvar['header_fields'],true);
    $show_data=json_decode($postvar['show_data'],true);
    $export_xls=export_xls($header_fields,$show_data);
    rs($export_xls);
}
function export_webservice_DataTableExport_xls()
{
    $postvar = get_post_data();
    $header_fields=json_decode($postvar['header_fields'],true);
    $show_data=json_decode($postvar['show_data'],true);
    $export_xls=DataTableExport_xls($header_fields,$show_data);
    rs($export_xls);
}
function export_webservice_export_user_xls()
{
    $postvar = get_post_data();
   /* $header_fields=json_decode($postvar['header_fields'],true);

    $show_data=json_decode($postvar['show_data'],true);
    $time=$postvar['time'];
    $dirpath=$postvar['dirpath'];*/
    $export_xls=export_user_xls($postvar);
  rs($return['data'],$return['error_code'],$return['success'],"1"); 
    
}

function export_webservice_import_user_xls()
{
        $postvar=get_post_data();
        $return=import_user_xls($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
}


?>