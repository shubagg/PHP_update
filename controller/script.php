
<script type="text/javascript">
    
var columns_listing_data = '<?php echo $columns_listing_json ?>';
columns_listing_data = JSON.parse(columns_listing_data);
var listing_div_id = columns_listing_data['div_id'];
//console.log(columns_listing_data);
var advanced_search_data = '<?php echo $advance_seach_data ?>';
//console.log(advanced_search_data);
columns_listing = JSON.stringify(columns_listing_data);

if(columns_listing_data['status']=='1')
{

    var api_action = columns_listing_data['api_action'];
    var processing = 'true';
    var serverSide = 'true';
    var searching = 'true';
    var searchPlaceholder = '';
    if(columns_listing_data['processing'])
    {
        processing = columns_listing_data['processing'];
    }
    if(columns_listing_data['serverSide'])
    {
        serverSide = columns_listing_data['serverSide'];
    }
    if(columns_listing_data['searching'])
    {
        searching = columns_listing_data['searching'];
    }
    var sorting_columns = [];
    var column_listing_temp = [];
    for(var i=0; i < columns_listing_data['columns_listing'].length; i++)
    {
      
      if(columns_listing_data['columns_listing'][i]['sorting']!='true')
      {
         sorting_columns.push({'bSortable':false,'aTargets':[i]});
      }
      if(columns_listing_data['columns_listing'][i]['searching']=='true')
      {
        var spl = columns_listing_data['columns_listing'][i]['column_heading'];
        searchPlaceholder += ui_string[spl]+',' ;
      }
      
    }
    setTimeout(function(){ 
        make_datatable();
     }, 1000);
}

</script>



<script type="text/javascript">

var dataTable = '';
var ExportTable = '';
var str = '';
function make_datatable()
{
   // console.log(sorting_columns);
    if((str) && (str!=''))
    {
        columns_listing['api_action'] = export_columns_listing['advanced_search']['api_action'];
        columns_listing['api_action_params'] = export_columns_listing['advanced_search']['api_params'];
    }
    if(searchPlaceholder!='')
    {
        searchPlaceholder = searchPlaceholder.substring(0, searchPlaceholder.length - 1);
    }
    //console.log('aaaaa');
    //console.log(listing_div_id);
    $("."+listing_div_id+"-error").html("");
    dataTable = $('#'+listing_div_id).DataTable({
    "processing": processing,
    "serverSide": serverSide,
    "searching": searching,
    "bDestroy": true,
    //"bSort": false,
    language: {
                search: ui_string['search'],
                searchPlaceholder:searchPlaceholder,
                    "lengthMenu":  ui_string['show']+" _MENU_ "+ ui_string['records_per_page'],
                    "zeroRecords": ui_string['no_data_found'],
                    "info": ui_string['showing_page'] + " _PAGE_ " + ui_string['of'] + " _PAGES_ ",
                    //"_PAGE_ " + " of " + " _PAGES_",
                    "infoEmpty": ui_string['showing_page'] + " _PAGES_ " + ui_string['of'] + " _PAGES_ ",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "loadingRecords": ui_string['loading'],
                    "processing":     ui_string['processing'],
            },
    lengthMenu: [[10, 25, 50, 100], [ui_string['n_10'], ui_string['n_25'], ui_string['n_50'], ui_string['n_100']]] , 
    aoColumnDefs: sorting_columns,
    ajax:{
            url :site_url+"controller/ajax/datatable_ajax.php", // json datasource
            type: "post",
            data: {'columns_listing':columns_listing,'query_str':str},
            error: function(err)
                {  console.log(err);
                    var col_length = columns_listing_data['columns_listing'].length;
                   $("."+listing_div_id+"-error").html("");
                   $("#"+listing_div_id).append('<tbody class="employee-grid-error"><tr align="center"><td colspan="'+col_length+'">'+ui_string["no_data_found"]+'</td></tr></tbody>');
                        
                    $("#"+listing_div_id+"_processing").css("display","none");
                        
                        // dataTable.ajax.reload();
                        //unloading();
                }

                    
         }
         

    });
    
            
}


</script> 
<script type="text/javascript">
function export_data()
{
var export_columns_listing = '<?php echo $this->dynamic_export_json_data?>';
export_columns_listing = JSON.parse(export_columns_listing);

//console.log(export_columns_listing['listing_details']);
if((str) && (str!=''))
{
    export_columns_listing['listing_details']['api_action'] = export_columns_listing['advanced_search']['api_action'];
}
export_columns_listing = JSON.stringify(export_columns_listing['listing_details']);



   $.ajax({

        url:site_url+"controller/ajax/export_ajax.php",
        data:{'columns_listing':export_columns_listing,'export':'true','query_str':str},
        type:"POST",
        success:function(suc)
                { 
                    
                    var data = JSON.parse(suc);
                    
                    if(data['data']['success']=='true')
                    {
                        //console.log(suc);
                         window.location = data['data']['path'];        
                    }
                    else
                    {
                        
                        $('#error_head').html(ui_string['error_message']);
                        $('#error_body').html(ui_string['nodataavilable']);
                        $('#error_message').modal();
                        setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
                    }
            
                }

       })

}
</script>
<?php /*=============================================*/?>
<script type="text/javascript">
    
    var dynamic_div = 0;
    var dynamic_div_array = [];
    var export_columns_listing = '<?php echo $this->dynamic_export_json_data?>';
        export_columns_listing = JSON.parse(export_columns_listing);
    var advance_search_append_div_id = '';
    var advanced_search_data = JSON.parse(advanced_search_data);
    //console.log('addd');
    //console.log(columns_listing_data);
    //console.log('addd');
    function add_new_query(value,div_id)
    {
        var search_equivalent_data = export_columns_listing['advanced_search']['search_equivalent'];
        if(export_columns_listing['advanced_search']['div_id']!='')
        {
            advance_search_append_div_id = export_columns_listing['advanced_search']['div_id'];
        }
        else
        {
            return false;
        }

        var index_test = dynamic_div_array.indexOf(div_id);
        var arr_len_test = dynamic_div_array.length-1;
        if((value == '') || (index_test != arr_len_test))
        {
           return false;
        }
        
        var temp_col_listing_data = advanced_search_data['adv_search_listing'];
        var selstring1_options = '';
        for(var sel_str1 = 0; sel_str1 < temp_col_listing_data.length; sel_str1++)
        {
            
                selstring1_options +=  '<option data_id="a" value="'+temp_col_listing_data[sel_str1]['column']+'">'+ui_string[temp_col_listing_data[sel_str1]['column_heading']]+'</option>';  
               
            
        }
        var temp_equivalent_data = columns_listing_data['columns_listing'];
        var selstring2_options = '';
        for(var sel_str2 = 0; sel_str2 < search_equivalent_data.length; sel_str2++)
        {
            
           selstring2_options +=  '<option value="'+search_equivalent_data[sel_str2]+'">'+ui_string[search_equivalent_data[sel_str2]]+'</option>';  
        }
        

        var inputstring = '<div class="col-md-3 col-xs-12" id="div_inp1_'+dynamic_div+'"><input name="" id="inp1_'+dynamic_div+'" required="required" type="text" class="form-control inp1" /></div>';

        

        var selstring3 = '<div class="col-md-3 col-xs-12"><div class="form-group col-md-8" id="div_sel3_'+dynamic_div+'"><input type="radio" class="sel3" value="AND" id="and_radio_'+dynamic_div+'" name="radio_'+dynamic_div+'" onchange="add_new_query(this.value,'+dynamic_div+');">'+ui_string['and']+' &nbsp; <input type="radio" class="sel3" value="OR" id=or_radio_'+dynamic_div+' name="radio_'+dynamic_div+'" onchange="add_new_query(this.value,'+dynamic_div+');">'+ui_string['or']+'</div>';

        var divstring1 = ' <div><div onclick = "remove_query_div('+dynamic_div+')" class="badge bg-theme" ><span class="glyphicon glyphicon-minus"></span></div></div></div>';



        var divstringstart = '<div class="row " id="stadd_'+dynamic_div+'">';
        var divstringend = '</div>';

        var selstring1 = '<div class="col-md-3 col-xs-12" ><div class="form-group" id="div_sel1_'+dynamic_div+'"><select onchange="change_box(this.id,'+dynamic_div+')" name="" id="sel1_'+dynamic_div+'" class="form-control sel1" >'+selstring1_options+'</select></div></div>';

        var selstring2 ='<div class="col-md-3 col-xs-12" ><div class="form-group" id="div_sel2_'+dynamic_div+'"><select class="form-control sel2" id="sel2_'+dynamic_div+'">'+selstring2_options+'</select></div></div>';


        
        var allstring = divstringstart + selstring1 + selstring2 + inputstring + selstring3 + divstring1 + divstringend;
        dynamic_div_array.push(dynamic_div);
        dynamic_div++;
        $('#'+advance_search_append_div_id).append(allstring);
    }

    function remove_query_div(id)
    {
        if(dynamic_div_array.length==1)
        {
            return false;
        }
        $( "#stadd_"+id ).remove(); 
        var index_test = dynamic_div_array.indexOf(id);
        var arr_len_test = dynamic_div_array.length-1;
        
        //console.log(arr_len);
        if (index_test > -1) {
            
            dynamic_div_array.splice(index_test, 1);    
            //console.log(index_test +'=='+ arr_len_test)
            if(index_test == arr_len_test)
            {
                var temp_index_test = index_test-1;
                $('#and_radio_'+dynamic_div_array[temp_index_test]).attr('checked', false);
                $('#or_radio_'+dynamic_div_array[temp_index_test]).attr('checked', false);
                
            }
        }
    }
    

var selval1 = [];
var selval2 = [];
var selval3 = [];
var inpval1 = [];

function test1()
{

    selval1 = [];
    selval2 = [];
    selval3 = [];
    inpval1 = [];
    str = '';
    $('.sel1').each(function(i, obj) {
        //console.log(obj.value);
        selval1.push(obj.value);
    });
    
    $('.sel2').each(function(i, obj) {
        //console.log(obj.value);
        selval2.push(obj.value);
    });
    
    $('.sel3').each(function(i, obj) {
        
        var check_id = obj.id;
        if($("#"+check_id).is(":checked"))
        {
            selval3.push(obj.value);
        }
        
    });

    $('.inp1').each(function(i, obj) {
        //console.log(obj.value);
        inpval1.push(obj.value);
    });

    
    
    for(var i=0; i < selval1.length; i++)
    {   
       
       str +=   selval1[i] +  ' ' +  selval2[i] + ' '  +  '"'+inpval1[i]+'"' + ' ' ;
       if(selval3[i])
       {
         str +=   selval3[i] + ' ';
       }
     }
    $('#query_write').val(str);
   
    
    //hello(str);

}
</script>
<script type="text/javascript">
$( window ).load(function() {
    
    dynamic_div = 0;
    dynamic_div_array = [];
    
    if(export_columns_listing['advanced_search']['status']=='true')
    {
        
        add_new_query('true',dynamic_div);    
    }
});
</script>
<script type="text/javascript">
    function manage_table_header()
    {
        if(export_columns_listing)
        {
            var temp_data = export_columns_listing['listing_details']['columns_listing'];
            var temp_table = '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">';
            var temp_select_lising = columns_listing_data['columns_listing'];
            console.log('start');
            console.log(temp_select_lising[0]);
            console.log('end');
            var temp_data_data = [];
            for(var j=0; j < temp_select_lising.length;j++)
            {
                temp_data_data.push(temp_select_lising[j]["column_heading"]);
            }
            for(var i=0; i < temp_data.length;i++)
            {
                var check_box_staus = ""
                
                if(temp_data_data.length) 
                {
                    if(temp_data_data.indexOf(temp_data[i]["column_heading"]) >= 0)
                    {
                        check_box_staus ="checked";
                    }
                }
                else
                {
                    check_box_staus ="checked";
                }
                temp_table += '<tr><td width="50%"><input type="checkbox" name="sel_checkbox[]" id="sel_checkbox'+i+'" class="sel_checkbox" value="'+temp_data[i]["column_heading"]+'" '+check_box_staus+'  /></td><td width="50%">'+ui_string[temp_data[i]["column_heading"]]+'</td></tr>';
            }
            temp_table += '</table>'
            temp_table += '<div align="center"><button onclick="save_custom_table_header();">'+ui_string['save']+'</button></div>';
            //console.log(temp_table);
            $('#modal_data').html(temp_table);
            $('#table_header_setting').modal();
        }
    }
/*<tr><td colspan="2" align="center">'+ui_string['name']+'</td></tr>*/
</script>
<script type="text/javascript">
    function save_custom_table_header()
    {
        var userId = "<?php echo $this->userId ?>";
        var type = "<?php echo $_REQUEST['type'] ?>";
        var checkedValue = []; 
        var inputElements = document.getElementsByClassName('sel_checkbox');
        for(var i=0; i<inputElements.length; i++){
              if(inputElements[i].checked){
                checkedValue.push(inputElements[i].value);
              }
        }
        
        var UserData = {};
        UserData[type] = checkedValue;
        //console.log(UserData);
        var json_str = JSON.stringify(UserData);
        //console.log(json_str);
        $.cookie(userId, json_str, { expires : 3600000000});
        //createCookie(userId, json_str);
        $('#table_header_setting').modal('toggle');
        window.location.reload();
    }
</script>
<script type="text/javascript">
    function change_box(id)
    {
       // alert(id);
    }
$(document).ready(function(){


    $("#adv_search").hide();
    $("#adv_search_btn").show();

    
    $("#adv_search_btn").click(function(){
    $("#adv_search").slideToggle();
    });

});

</script>

