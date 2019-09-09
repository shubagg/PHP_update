
function resetSearch()
{
    get_dataajax_data();
}
function get_dataajax_data()
{    
	$('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"ajax/datatable_ajax_ticketbook.php",
            "aoColumns":showFields[0]['data_table_1']
        } );
}