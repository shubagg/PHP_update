<link rel="stylesheet" type="text/css" href="<?php echo admin_assets_url(); ?>css/select2.min.css"/>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/select2.min.js"></script> 
<script type="text/javascript">
    
var columns_listing_data = '<?php echo $columns_listing_json ?>';
columns_listing_data = JSON.parse(columns_listing_data);
var listing_div_id = columns_listing_data['div_id'];
var qUserId = '<?php echo $_SESSION["user"]["user_id"] ?>';
var qgtype = '<?php echo $_GET["type"] ?>';
var webservice_url = '<?php echo $webservice_url ?>';

//console.log(columns_listing_data);

var advanced_search_data = '<?php echo $advance_seach_data ?>';
//console.log(advanced_search_data);
//columns_listing = JSON.stringify(columns_listing_data);
columns_listing = columns_listing_data;
var api_action = columns_listing_data['api_action'];
var processing = true;
var serverSide = true;
var searching = true;
var sorting = false;
var dropDownPaging = true;
var searchPlaceholder = '';
var sorting_columns = [];
var column_listing_temp = [];
var already_check = false;
$( window ).load(function() {
  
    setTimeout(function(){

        if(columns_listing_data['status']=='true')
        {
            already_check = true;
            if(columns_listing_data['processing'] != undefined)
            {
                processing = columns_listing_data['processing'];
            }
            if(columns_listing_data['dropDownPaging'] != undefined)
            {
                dropDownPaging = columns_listing_data['dropDownPaging'];
            }
            if(columns_listing_data['serverSide'] != undefined)
            {
                serverSide = columns_listing_data['serverSide'];
            }
            if(columns_listing_data['searching'] != undefined)
            {
               searching = columns_listing_data['searching'];
            }
            if(columns_listing_data['sorting'] != undefined)
            {
               sorting = columns_listing_data['sorting'];
            }
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
        else 
        {
            setTimeout(function(){
                make_datatable();
             }, 1000);
        }
            
    }, 500);
});
</script>



<script type="text/javascript">

var dataTable = '';
var ExportTable = '';
if(AdvSearchQuery==undefined)
{
    var AdvSearchQuery = '';
}

if(all_string_checked_selections == 'undefined') {
    var all_string_checked_selections = {};
}
function make_datatable(callback)
{

    var default_column_order = false;
	if(typeof columns_listing != 'object')
	{
		columns_listing = JSON.parse(columns_listing);
	}
    if(columns_listing['default_column_order']!=undefined)
    {
        default_column_order = [columns_listing['default_column_order']];    
    }
	
    if((columns_listing['pagination']) && (columns_listing['pagination']!=undefined))
    {
       var show = [];
       var set = [];
       var sh_count = columns_listing['pagination']['set'].length;
       for(var sh = 0; sh < sh_count;sh++)
       {
          show.push(ui_string[columns_listing['pagination']['show'][sh]]);
       }
       var length = [columns_listing['pagination']['set'],show];
        
    }
    else
    {
        var length = [[10, 25, 50, 100], [ui_string['n_10'], ui_string['n_25'], ui_string['n_50'], ui_string['n_100']]];
    }
    
    //columns_listing = JSON.parse(columns_listing);
    columns_listing['callBack_func'] = '';
    columns_listing['call_func'] = '';
    //for not append in previous search place holder
    searchPlaceholder='';
    
    if((AdvSearchQuery) && (AdvSearchQuery!=''))
    {
        columns_listing['api_action'] = export_columns_listing['advanced_search']['api_action'];
        columns_listing['api_action_params'] = export_columns_listing['advanced_search']['api_params'];
        if(export_columns_listing['advanced_search']['adv_call_func'])
        {
            columns_listing['call_func'] = export_columns_listing['advanced_search']['adv_call_func'];
        }
        if(export_columns_listing['advanced_search']['adv_callBack_func'])
        {
            columns_listing['callBack_func'] = export_columns_listing['advanced_search']['adv_callBack_func'];
        }
        

    }
    else
    {	
    	//alert('tst');
    	if((columns_listing['default_callBack_func']) && (columns_listing['default_callBack_func']!=''))
    	{
    		//alert('tst1');
    		columns_listing['callBack_func'] = columns_listing['default_callBack_func'];
    	}
    	if((columns_listing['default_call_func']) && (columns_listing['default_call_func']!=''))
    	{
    		//alert('tst2');
    		columns_listing['call_func'] = columns_listing['default_call_func'];
    	}
    }
    
    if((searchPlaceholder!='') && (searchPlaceholder!=undefined))
    {
        searchPlaceholder = searchPlaceholder.substring(0, searchPlaceholder.length - 1);
    }
   // var columns_listing_temp1 = JSON.parse(columns_listing);

   var columns_listing_temp1 = [];

    if((columns_listing['call_func']) && (columns_listing['call_func']!=undefined) && (columns_listing['call_func']!=''))
    {
        columns_listing_temp1 = columns_listing;
         
    	columns_listing = JSON.stringify(columns_listing);
        $.ajax({
                url :site_url+"ui/admin/controller/ajax/datatable_ajax.php", // json datasource
                type: "post",
                data: {'columns_listing':columns_listing,'query_str':AdvSearchQuery},
                success:function(suc)
                {
                    window[columns_listing_temp1['call_func']](suc);
                    if(typeof callback === 'function'&&callback()){
                        callback();
                    }
                },
                error: function(err)
                {  
                   window[columns_listing_temp1['call_func']](err);
                  if(typeof callback === 'function'&&callback()){
                        callback();
                    }
                }
             });
    }
    else
    {   
        
        if(!already_check)
        {
            
            if(columns_listing['processing'] != undefined)
            {
                processing = columns_listing['processing'];
            }
            if(columns_listing['dropDownPaging'] != undefined)
            {
                dropDownPaging = columns_listing['dropDownPaging'];
            }
            if(columns_listing['serverSide'] != undefined)
            {
                serverSide = columns_listing['serverSide'];
            }
            if(columns_listing['searching'] != undefined)
            {
               searching = columns_listing['searching'];
            }
            if(columns_listing['sorting'] != undefined)
            {
               sorting = columns_listing['sorting'];
            }
            for(var i=0; i < columns_listing['columns_listing'].length; i++)
            {
              
              if(columns_listing['columns_listing'][i]['sorting']!='true')
              {
                         sorting_columns.push({'bSortable':false,'aTargets':[i]});
              }
              if(columns_listing['columns_listing'][i]['searching']=='true')
              {
                var spl = columns_listing['columns_listing'][i]['column_heading'];
                searchPlaceholder += ui_string[spl]+',' ;
              }
              
            }
        }
        
        
        
        
        columns_listing_temp1 = columns_listing;
    	columns_listing = JSON.stringify(columns_listing);
        $("."+listing_div_id+"-error").html("");
        dataTable = $('#'+listing_div_id).DataTable({
        "processing": processing,
        "bLengthChange": dropDownPaging,
        "serverSide": serverSide,
        "searching": searching,
        "bDestroy": true,
        "bSort": sorting,
        language: {
                    search: ui_string['search'],
                    //searchPlaceholder:searchPlaceholder,
                    "sSearch":searchPlaceholder,
                        //"lengthMenu":  ui_string['show']+" _MENU_ "+ ui_string['records_per_page'],
                        "lengthMenu":  " _MENU_ ",
                        "zeroRecords": ui_string['no_data_found'],
                        "info": ui_string['showing_page'] + " _PAGE_ " + ui_string['of'] + " _PAGES_ ",
                        //"_PAGE_ " + " of " + " _PAGES_",
                        "infoEmpty": ui_string['showing_page'] + " _PAGES_ " + ui_string['of'] + " _PAGES_ ",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "loadingRecords": ui_string['loading'],
                        "processing":     ui_string['processing'],
                       
                },
       // lengthMenu: [[10, 25, 50, 100], [ui_string['n_10'], ui_string['n_25'], ui_string['n_50'], ui_string['n_100']]] , 
        
        lengthMenu: length,

        aoColumnDefs: sorting_columns,

        aaSorting: default_column_order,
               
        ajax:{
                url :site_url+"ui/admin/controller/ajax/datatable_ajax.php", // json datasource
                type: "post",
                data: {'columns_listing':columns_listing,'query_str':AdvSearchQuery, 'adv2_all_selected_opt' : JSON.stringify(all_string_checked_selections)},
                error: function(err)
                    {  console.log(err);

                           var col_length = columns_listing_data['columns_listing'].length;
                           $("."+listing_div_id+"-error").html("");
                           $("#"+listing_div_id).append('<tbody class="employee-grid-error"><tr align="center"><td colspan="'+col_length+'">'+ui_string["no_data_found"]+'</td></tr></tbody>');
                                
                            $("#"+listing_div_id+"_processing").css("display","none");
                    },
                complete: function(suc) 
	                {
	                   if((columns_listing_temp1['callBack_func']) && (columns_listing_temp1['callBack_func']!=undefined))
	                       {
	                            suc = suc.responseText;
	                            window[columns_listing_temp1['callBack_func']](suc);
	                       }
                          if(typeof callback === 'function'&&callback()){
                            callback();
                    }
	                }
                       
             }
             

        });

    }
    
    
            
}


</script> 
<script type="text/javascript">
    function refresh_custom_dt(callback)
    {
        var div_id = advanced_search_data['div_id'];
           if(callback==undefined || AdvSearchQuery=='')
    {
       AdvSearchQuery = '';
    }
        $('#query_write').val('');
        $(".after-query").prop('disabled', true);

        dynamic_div_array = [];
        dynamic_div = 0;
        $('#'+div_id).html('');
        get_saved_queries();
        if(export_columns_listing['advanced_search']['status']=='true')
        {
            add_new_query('true',dynamic_div);    
        }
        // add_new_query(true,dynamic_div);
        make_datatable(function(){
            if(typeof callback === 'function'&&callback()){
                        callback();
                    }
        });
    }
</script>
<script type="text/javascript">
function export_detail_data()
{
    setloader();
    /*var export_columns_listing = '<?php echo $this->dynamic_export_json_data?>';
    export_columns_listing = JSON.parse(export_columns_listing);

    //console.log(columns_listing);return;
    if((AdvSearchQuery) && (AdvSearchQuery!=''))
    {
        export_columns_listing['listing_details']['api_action'] = export_columns_listing['advanced_search']['api_action'];
    }*/
    export_columns_listing = JSON.stringify(columns_listing['listing_details']);

    $.ajax({

        url:site_url+"ui/admin/controller/ajax/export_detail_ajax.php",
        data:{'columns_listing':columns_listing,'export':'true'},
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
                    unloading();
                }
            })

}


function export_data()
{
    setloader();
	var export_columns_listing = '<?php echo $this->dynamic_export_json_data?>';
	export_columns_listing = JSON.parse(export_columns_listing);

	//console.log(export_columns_listing['listing_details']);
	if((AdvSearchQuery) && (AdvSearchQuery!=''))
	{
	    export_columns_listing['listing_details']['api_action'] = export_columns_listing['advanced_search']['api_action'];
	}
	export_columns_listing = JSON.stringify(export_columns_listing['listing_details']);

    $.ajax({

        url:site_url+"ui/admin/controller/ajax/export_ajax.php",
        data:{'columns_listing':export_columns_listing,'export':'true','query_str':AdvSearchQuery},
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
                    unloading();
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
    var advance_search_append_div_id = 'stadd';
    var main_div_row = 'row';
    if(advanced_search_data && advanced_search_data!=undefined)
    {
    	advanced_search_data = JSON.parse(advanced_search_data);	
    }
    
   
    
    //console.log('addd');
    //console.log(export_columns_listing);
   // console.log(advanced_search_data);
    //console.log('addd');
    function add_new_query(value,div_id)
    {
      
        if((export_columns_listing['advanced_search']['div_id']) && (export_columns_listing['advanced_search']['div_id']!=undefined))
        {
            advance_search_append_div_id = export_columns_listing['advanced_search']['div_id'];
        }
        if((export_columns_listing['advanced_search']['div_class']) && (export_columns_listing['advanced_search']['div_class']!=undefined))
        {
            main_div_row = export_columns_listing['advanced_search']['div_class'];
        }

        var search_equivalent_data = export_columns_listing['advanced_search']['search_equivalent'];
        

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
        var search_equivalent_data = temp_col_listing_data[0]['search_equivalent'];
        
        var selstring2_options = '';
        for(var sel_str2 = 0; sel_str2 < search_equivalent_data.length; sel_str2++)
        {
            
           selstring2_options +=  '<option value="'+search_equivalent_data[sel_str2]+'">'+ui_string[search_equivalent_data[sel_str2]]+'</option>';  
        }
        
        var class_name0 = 'form-control';
        var class_name1 = 'form-control';
        var class_name2 = 'form-control';
        var class_name3 = 'form-control';
        var class_name4 = 'form-control';
        var class_name5 = 'form-control';

        var div_class_name0 = 'col-md-3 col-xs-12';
        var div_class_name1 = 'col-md-3 col-xs-12';
        var div_class_name2 = 'col-md-3 col-xs-12';
        var div_class_name3 = 'col-md-3 col-xs-12';
        var div_class_name4 = 'col-md-3 col-xs-12';
        var div_class_name5 = 'col-md-3 col-xs-12';
        if((temp_col_listing_data[0]['class']) && (temp_col_listing_data[0]['class']!=undefined) && (temp_col_listing_data[0]['class']!=''))
                {

                        var class_name = [];
                        class_name = temp_col_listing_data[0]['class'];
                        
                        if( typeof class_name == 'object' ) {
                           
                            if(class_name[0])
                            {
                               class_name0 = class_name[0];
                            }
                            if(class_name[1])
                            {
                               class_name1 = class_name[1];
                            }
                            if(class_name[2])
                            {
                                class_name2 = class_name[2];
                            }
                            if(class_name[3])
                            {
                               class_name3 = class_name[3];
                            }
                            if(class_name[4])
                            {
                               class_name4 = class_name[4];
                            }

                        }
                }
                if((temp_col_listing_data[0]['div_class']) && (temp_col_listing_data[0]['div_class']!=undefined) && (temp_col_listing_data[0]['div_class']!=''))
                {

                        var div_class_name = [];
                        div_class_name = temp_col_listing_data[0]['div_class'];
                        
                        if( typeof div_class_name === 'object' ) {
                           
                            if(div_class_name[0])
                            {
                               div_class_name0 = div_class_name[0];
                            }
                            if(div_class_name[1])
                            {
                               div_class_name1 = div_class_name[1];
                            }
                            if(div_class_name[2])
                            {
                                div_class_name2 = div_class_name[2];
                            }
                            if(div_class_name[3])
                            {
                               div_class_name3 = div_class_name[3];
                            }
                            if(div_class_name[4])
                            {
                               div_class_name4 = div_class_name[4];
                            }

                        }
                }
               
                    
                

        var inputstring_temp = value_div(temp_col_listing_data[0],dynamic_div);

        //var inputstring = '<div class="'+div_class_name2+'" id="div_inp1_'+dynamic_div+'">'+inputstring_temp+'</div>';
        var inputstring  = inputstring_temp;
        

        var selstring3 = '<div class="'+div_class_name3+'"><div class="advance-search_and-or" id="div_sel3_'+dynamic_div+'"><input type="radio" class="sel3 " value="AND" id="and_radio_'+dynamic_div+'" name="radio_'+dynamic_div+'" onchange="add_new_query(this.value,'+dynamic_div+');">&nbsp;'+ui_string['and']+' &nbsp; <input type="radio" class="sel3 " value="OR" id=or_radio_'+dynamic_div+' name="radio_'+dynamic_div+'" onchange="add_new_query(this.value,'+dynamic_div+');">&nbsp;'+ui_string['or']+'</div>';

        var divstring1 = ' <div class="advance-search-minus"><div onclick = "remove_query_div('+dynamic_div+')" class="badge bg-theme search-badge" ><span class="glyphicon glyphicon-minus"></span></div></div></div>';

        

        var divstringstart = '<div class="'+main_div_row+ '" id="'+advance_search_append_div_id+dynamic_div+'">';
        var divstringend = '</div>';
        
        
                
        var selstring1 = '<div class="'+div_class_name0+'" ><div class="form-group" id="div_sel1_'+dynamic_div+'"><select onchange="change_box(this.value,'+dynamic_div+')" name="" id="sel1_'+dynamic_div+'" class="'+class_name1+' sel1" >'+selstring1_options+'</select></div></div>';

        var selstring2 ='<div class="'+div_class_name1+'" ><div class="form-group" id="div_sel2_'+dynamic_div+'"><select class="'+class_name1+' sel2" id="sel2_'+dynamic_div+'">'+selstring2_options+'</select></div></div>';


        
        var allstring = divstringstart + selstring1 + selstring2 + inputstring + selstring3 + divstring1 + divstringend;
        dynamic_div_array.push(dynamic_div);
        dynamic_div++;
        $('#'+advance_search_append_div_id).append(allstring);
        //renderComponents($("#div_inp1_"+(dynamic_div-1)));
        
        $.when(renderComponents($("#div_inp1_"+(dynamic_div-1)))).then(setSelectSearch());
        

    }
function setSelectSearch()
{
    setTimeout(function(){ 

        $('.inp1').each(function(i, obj) {
           //  console.log(obj['type']);
            if((obj['type']=='select-one') || (obj['type']=='select-multiple'))
            {
               $('#'+obj['id']).addClass('js-adv-select-search');
               $(".js-adv-select-search").select2();
            }
            else
            {
                $('#'+obj['id']).removeClass('js-adv-select-search');
            }
        });
        
            
        }, 1500);
}
function value_div(data,dynamic_id)
{
        var class_name = 'form-control';
        if((data['class']) && (data['class']!=undefined) && (data['class']!=''))
        {
            var class_name = [];
            class_name = data['class'];
            if( typeof class_name === 'object' ) {
                if(class_name[2])
                {
                  class_name = class_name[2];
                }
            }                                                   
                                      
                                  
                        
        }
        if((data['div_class']) && (data['div_class']!=undefined) && (data['div_class']!=''))
        {
            var div_class_name = [];
            div_class_name = data['div_class'];
            if( typeof div_class_name === 'object' ) {
                if(div_class_name[2])
                {
                  div_class_name = div_class_name[2];
                }
            }                                                   
                                      
                                  
                        
        }

        var div_data  = "<div class='"+div_class_name+" renderComponents' id='div_inp1_"+dynamic_id+"'";
        div_data +=  ' data-html-id = inp1_'+dynamic_id ;
        div_data +=  " data-html-classes = 'inp1 '"  ;
        div_data +=  " data-html-heading = 'no'"  ;
        div_data +=  " data-html-default = 'no'"  ;
        if(data['div_params'])
        {
            $.each(data['div_params'], function( index, value ) {
              div_data +=  ' '+index +'='+ "'"+value+"'"+ ' '  ;
            });
        }
        div_data += "></div>";
        

        /*var inputstring = '';
        if((data['type']) && (data['type']=='text'))
        {
            inputstring = '<input name="" id="inp1_'+dynamic_id+'" required="required" type="text" class="inp1 '+class_name+'" />';
        }
        else if((data['type']) && (data['type']=='dropdown'))
        {
            inputstring = '<input name="" id="inp1_'+dynamic_id+'" required="required" type="text" class="inp1 '+class_name+'" />';
        }
        else if((data['type']) && (data['type']=='date'))
        {
            if((data['format']) && (data['format']!='') && (data['format']!=undefined))
            {
                var format = 'yyyy-mm-dd';
            }
            else
            {
                var format = '';
            }
                     inputstring = '<input name="" id="inp1_'+dynamic_id+'" required="required" format="'+format+'" type="date" class="inp1 '+class_name+'" />';
        }*/
//        console.log(div_data);
        return div_data;
        //inputstring;
}
    function remove_query_div(id)
    {
        if(dynamic_div_array.length==1)
        {
            return false;
        }
        $( "#"+advance_search_append_div_id+id ).remove(); 
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

function make_query()
{
    var data = export_columns_listing;
    
    if((data['advanced_search']['query_type']) && (data['advanced_search']['query_type']=='mongo'))
    {
        query_mongo();
    }
    else if((data['advanced_search']['query_type']) && (data['advanced_search']['query_type']=='mysql'))
    {
        query_mysql();
    }

    
    
}
function query_mysql()
{
    selval1 = [];
    selval2 = [];
    selval3 = [];
    inpval1 = [];
    AdvSearchQuery = '';
    $('.sel1').each(function(i, obj) {
     
        selval1.push(obj.value);
    });
    
    $('.sel2').each(function(i, obj) {
        
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

        inpval1.push(obj.value);
    });

    
    for(var i=0; i < selval1.length; i++)
    {   
       if(selval2[i]=='like')
       {
            AdvSearchQuery +=   selval1[i] +  ' ' +  selval2[i] + ' '  +  '"%'+$.trim(inpval1[i])+'%"' + ' ' ; 
       }
       else
       {

            AdvSearchQuery +=   selval1[i] +  ' ' +  selval2[i] + ' '  +  '"'+$.trim(inpval1[i])+'"' + ' ' ;
       }

       
       if(selval3[i])
       {
         AdvSearchQuery +=   selval3[i] + ' ';
       }
     }
    $('#query_write').val(AdvSearchQuery);
    if(AdvSearchQuery!='' && ($('#query_write').val().trim()!=''))
    {
        $(".after-query").prop('disabled', false);
    }
    else
    {
        $(".after-query").prop('disabled', true);
    }
   
}
function query_mongo()
{

    selval1 = [];
    selval2 = [];
    selval3 = [];
    inpval1 = [];
    AdvSearchQuery = '';
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

    AdvSearchQuery = '';
    var url = site_url+"ui/admin/controller/ajax/mongo_query.php";
    var qr = '[';//'{"$and" :[';
    
    var data = export_columns_listing['advanced_search']['adv_search_col_listing'];

    if((selval1.length=='1') || (selval3.length<='0'))
    {
        /*for(var j=0; j < data.length; j++)
        {
            if(selval1[0]==data[j]['column'])
            {
                if((data[j]['type']=='date') && (data[j]['format']=='yyyy-mm-dd'))
                {
                    var tt = new Date("'"+inpval1[0]+"'");
                    inpval1[0] = "new MongoDate(tt)";
                    alert(inpval1[0]);
                }
            }
        }*/
        if(selval2[0]=='$lt' || selval2[0]=='$gt' || selval2[0]=='$gte' || selval2[0]=='$lte')
        {
            
            var format = new Date(inpval1[0]);
            if(format!='Invalid Date')
            {
                qr += '{"'+selval1[0]+'":{"'+selval2[0]+'":'+ inpval1[0]+'}},';
            }
            else
        {
            qr += '{"'+selval1[0]+'":{"'+selval2[0]+'":'+ parseInt(inpval1[0])+'}},';
        }
            
        }
        else
        {
            qr += '{"'+selval1[0]+'":{"'+selval2[0]+'":"'+ inpval1[0]+'"}},';
        }
        qr = qr.substring(0, qr.length - 1);
        qr += ']';//']}';
        $.ajax({

                        url:url,
                        data:{'AdvSearchQuery':qr},
                        type:'post',
                        success:function(suc)
                        {
                           // alert('done');
                           // console.log(suc)
                        }
                    });
        AdvSearchQuery = qr;
    }
    else
    {   
        var zx = 0;
        var or_active = 0;
            for(var i=0; i < selval1.length; i++)
            {   

               if(selval3[i]=='OR')
               {
                 if(!or_active)
                 {
                    qr += '{"$or" : [';
                    or_active = 1;
                    if(selval2[i]=='$lt' || selval2[i]=='$gt')
                    {
                        qr += '{"'+selval1[i]+'":{"'+selval2[i]+'":'+ parseInt(inpval1[i])+'}},';
                    }
                    else
                    {
                        qr += '{"'+selval1[i]+'":{"'+selval2[i]+'":"'+ inpval1[i]+'"}},';
                    }
                 }
                 zx = i+1;
                    if(selval2[zx]=='$lt' || selval2[zx]=='$gt')
                    {
                        qr += '{"'+selval1[zx]+'":{"'+selval2[zx]+'":'+ parseInt(inpval1[zx])+'}},';
                    }
                    else
                    {
                        qr += '{"'+selval1[zx]+'":{"'+selval2[zx]+'":"'+ inpval1[zx]+'"}},';
                    }
                      
               }
               else 
               {

                 if(or_active)
                 {
                    qr = qr.substring(0, qr.length - 1);
                    qr += ']},';
                    or_active = 0;
                    zx++; 
                 }
                 if((selval1[zx]) && (selval1[zx]!=undefined) && (selval1[zx]!=''))
                 {
                    if(selval2[zx]=='$lt' || selval2[zx]=='$gt')
                    {
                        qr += '{"'+selval1[zx]+'":{"'+selval2[zx]+'":'+ parseInt(inpval1[zx])+'}},';
                    }
                    else
                    {
                        qr += '{"'+selval1[zx]+'":{"'+selval2[zx]+'":"'+ inpval1[zx]+'"}},';
                    }
                    zx++; 
                 }
                     
               }

               if(i==(selval1.length-1))
               {
                 qr = qr.substring(0, qr.length - 1);
                 qr += ']';// ']}';
                 AdvSearchQuery = qr;
                 $.ajax({

                        url:url,
                        data:{'AdvSearchQuery':qr},
                        type:'post',
                        success:function(suc)
                        {
                           // alert('done');
                           // console.log(suc)
                        }
                    });
                }
                 
             }

    }
    $('#query_write').val(qr);
    if(AdvSearchQuery!='' && ($('#query_write').val().trim()!=''))
    {
        $(".after-query").prop('disabled', false);
    }
    else
    {
        $(".after-query").prop('disabled', true);
    }
}
</script>
<script type="text/javascript">
    function set_query_name()
    {
        if(qUserId && qgtype && AdvSearchQuery )
        {
            if((qUserId!='' && qUserId!=undefined) && (qgtype!='' && qgtype!=undefined) && (AdvSearchQuery!='' && AdvSearchQuery!=undefined))
            {
                $('#e_qname').html('');
                $('#qname').val('');
                $('#query_name').modal();
            }
        }
        
        
    }

	function save_adv_query()
	{
        
        if(qUserId && qgtype && AdvSearchQuery )
        {
            if((qUserId!='' && qUserId!=undefined) && (qgtype!='' && qgtype!=undefined) && (AdvSearchQuery!='' && AdvSearchQuery!=undefined))
            {

                var url = webservice_url;
                var qname = $('#qname').val().trim();
                if(qname=='')
                {
                    $('#qname').val('');
                    $('#qname').focus();
                    $('#e_qname').html(ui_string['enter_query_name']);
                    return false;
                }
                else
                {
                    setTimeout(function(){ $('#query_name').modal("toggle"); },1000)
                }
               // alert(url);
                $.ajax({

                        url:url+'/manage_adv_save_query',
                        type:'post',
                        data:{'id':'0','userId':qUserId,'type':qgtype,'query':AdvSearchQuery,'name':qname},
                        success:function(suc)
                        {
                           if(typeof(suc) !='object')
                           {
                             suc = JSON.parse(suc);
                           } 
                           var data = suc; //JSON.parse(suc);
                           
                           if(data['success']=='true')
                           {
                                $("#model_head").html(ui_string['confirm']);
                                $("#model_des").html(ui_string['success']);
                                $('#success_modal').modal();
                                setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                //setTimeout(function(){ location.reload(); },1000)

                           }
                           else
                           {    
                               if(data['errorcode']=='1796')
                               {   
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['querynameissue']);
                               }else {
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['unsuccess']);
                               }
                               $('#success_modal').modal();
                               setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                
                           }
                           get_saved_queries();
                        }
                    });
            }
            
        }
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

    get_saved_queries();
});
</script>
<script type="text/javascript">
var query_data_result = '';
    function get_saved_queries()
    {
        var query_data = '<select id="sel_query" class="form-control" onchange="show_query(this.value);">';
        query_data += '<option value="">'+ui_string['select_query']+'</option>';
            $.ajax({

                url:webservice_url+'/get_saved_queries',
                type:'post',
                data:{'userId':qUserId,'type':qgtype},
                success:function(suc)
                {
                    if(typeof(suc) !='object')
                    {
                       suc = JSON.parse(suc);
                    }
                   // console.log(suc);
                    if(suc['success']=='true')
                    {
                        var data = suc['data'];
                        query_data_result = suc['data'];
                        for(var i=0; i < data.length; i++)
                        {
                            query_data += '<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>';

                            if(i==(data.length-1))
                            {
                              query_data += '<select>';  
                              $('#sel_query').html(query_data);
                              
                            }
                        }

                    }
                    else
                    {
                      query_data += '</select>';  
                    }
                }

            });
        

    }
    function show_query(id)
    {
        
        for(var i=0; i < query_data_result.length; i++)
        {
            if(id==query_data_result[i]['id'])
            {
                $('#query_write').val(query_data_result[i]['query']);
                AdvSearchQuery = query_data_result[i]['query'];
                $(".after-query").prop('disabled', false);
            }
        }
        if((AdvSearchQuery=='')||(id=='')||(id==undefined))
        {
            $('#query_write').val('');
            AdvSearchQuery = '';
            $(".after-query").prop('disabled', true);
            $('#query_write').html('');
        }
        
    }
</script>
<script type="text/javascript">

    function manage_table_header()
    {
        if(export_columns_listing)
        {
            var temp_data = export_columns_listing['listing_details']['columns_listing'];
            var temp_table = '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">';
            var temp_select_lising = columns_listing_data['columns_listing'];
            
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
                    //check_box_staus ="checked";
                }
                temp_table += '<tr><td width="30%" style="text-align: center !important;"><input type="checkbox" name="sel_checkbox[]" id="sel_checkbox'+i+'" class="sel_checkbox" value="'+temp_data[i]["column_heading"]+'" '+check_box_staus+'  /></td><td width="70%">'+ui_string[temp_data[i]["column_heading"]]+'</td></tr>';
            }
            temp_table += '</table>'
            temp_table += '<div class="row"><div class="col-xs-12"><button class="btn btn-theme-inverse pull-right" onclick="save_custom_table_header();">'+ui_string['save']+'</button></div></div>';
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
    function change_box(val,dynamic_id)
    {   
       
        var i = $("#sel1_"+dynamic_id+" option:selected").index();
        var data = advanced_search_data['adv_search_listing'];
      
        setloader();
            
            if(data[i]['column'] == val)
            {
                
                var selstring2_options = '';
                var search_equivalent_data = data[i]['search_equivalent'];
                for(var sel_str2 = 0; sel_str2 < search_equivalent_data.length; sel_str2++)
                {
                    
                   selstring2_options +=  '<option value="'+search_equivalent_data[sel_str2]+'">'+ui_string[search_equivalent_data[sel_str2]]+'</option>';  

                }
                var inputstring = value_div(data[i],dynamic_id);

               /* if((data[i]['type']) && (data[i]['type']=='text'))
                {
                    
                    var inputstring = '<input name="" id="inp1_'+dynamic_id+'" required="required" type="text" class="inp1 '+class_name+'" />';
                }
                else if((data[i]['type']) && (data[i]['type']=='dropdown'))
                {
                    var inputstring = '<input name="" id="inp1_'+dynamic_id+'" required="required" type="text" class="inp1 '+class_name+'" />';
                }
                else if((data[i]['type']) && (data[i]['type']=='date'))
                {
                    if((data[i]['format']) && (data[i]['format']!='') && (data[i]['format']!=undefined))
                    {
                        var format = 'yyyy-mm-dd';
                    }
                    else
                    {
                        var format = '';
                    }
                    var inputstring = '<input name="" id="inp1_'+dynamic_id+'" required="required" format="'+format+'" type="date" class="inp1 '+class_name+'" />';
                }
               */
            
                
                $('#div_inp1_'+dynamic_id).replaceWith(inputstring);
                //renderComponents($('#div_inp1_'+dynamic_id));

                $.when(renderComponents($('#div_inp1_'+dynamic_id))).then(setSelectSearch());


                $('#sel2_'+dynamic_id).html(selstring2_options);

            }
       // }
        unloading();

       // alert(val+'--'+val);
    }
$(document).ready(function(){

	
    $("#adv_search").hide();
    $("#adv_search_btn").show();

    
    $("#adv_search_btn").click(function(){

    $("#adv_search").slideToggle();
    });

});

</script>
<script>
$(document).ready(function(){
    $(".adv_srch").click(function(){
        $(".advance_ui").slideToggle();
          if ($('.top-advance-search i').hasClass('fa-plus-circle')){
            $('.top-advance-search i').removeClass('fa-plus-circle');
              $('.top-advance-search i').addClass('fa-minus-circle');
        } else {
            $('.top-advance-search i').addClass('fa-plus-circle');
            $('.top-advance-search i').removeClass('fa-minus-circle');
          }
    });
});
</script>

<div id="table_header_setting" class="modal container fade in" tabindex="-1" aria-hidden="false" data-width="400" >
    <div class="modal-header">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title"> <?php echo $ui_string['select_fields']; ?></h4>
                    </div>
                    </div>
                    
                    </div>
        
                            <!-- //modal-header-->
        <div class="modal-body">
                              
            <div class="clr"></div>
                 <div class="modal_data" id="modal_data">
                               
     
                 </div> 
        </div>
                            <!-- //modal-body-->
    </div>

    <div id="query_name" class="modal container fade in" tabindex="-1" aria-hidden="false" data-width="400">
    <div class="modal-header">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title"> <?php echo $ui_string['query_name']; ?></h4>
    </div>
    </div>
    </div>
        
                            <!-- //modal-header-->
        <div class="modal-body">
                              
            <div class="clr"></div>
                 <div class="modal_data" id="modal_data">
                 <label><?php echo $ui_string['query_name']; ?></label>
                    <input class="form-control query" type="text" name="qname" id="qname" value="">
                    <span class="error query" id="e_qname"></span>
                    
                    <button class="btn btn-theme-inverse pull-right margn_tp_btm_10" onclick="save_adv_query();">Submit</button>
                 </div> 
        </div>
                            <!-- //modal-body-->
    </div>