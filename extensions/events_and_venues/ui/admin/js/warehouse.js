
function go_to_popup(PopupId,id) 
{
    $("#eventproductId").attr('disabled','disabled');
    $("#venueproductIds").attr('disabled','disabled');
    $.ajax({
            url:extensions_ui_url+"ajax/getData.php?action=getwarehousedata",
            data: id,
            type:"POST",
            success:function(suc)
                    {   
                         suc=JSON.parse(suc);
                         if(PopupId=="warehouseeventPopup")
                         {
                            $("#eventid").val(suc['id']);
                            $("#typeevent").val(suc['type']);
                            $("#eventproductId").val(suc['productId']);
                            $("#eventdate").val(suc['date']);
                            edittablerow(suc['pricedetail'],'1');
                            $("#eventinventory").val(suc['inventory']);
                            $("#eventdesc").val(suc['description']);
                            $("#eventduration").val(suc['duration']);
                           
                         }
                         else
                         {
                             $("#venueid").val(suc['id']);
                             $("#typevenue").val(suc['type']);
                             $("#venueproductIds").val(suc['productId']);
                             $("#venuedates").val(suc['date']);
                             edittablerow(suc['pricedetail']);
                             $("#venueinventorys").val(suc['inventory']);
                             $("#venuedescs").val(suc['description']);
                             
                         }
                         $("#"+PopupId).modal("show");
                    }

            });
    
}



function go_to_taxpopup(id) 
{ 
    $.ajax({
            url:extensions_ui_url+"ajax/getData.php?action=gettaxdata",
            data: id,
            type:"POST",
            success:function(suc)
                    { 
						suc=JSON.parse(suc);
				
						console.log(suc);
						
						$("#venueid").val(suc['id']);
						$("#venueproductIds").val(suc['hotelUserId']);
						//taxedittablerow(suc['pricedetail']);
						
						
						 var counter=1;
						for(var i=0; i < suc['tax'].length;i++)
						{
							
							$("#minraange"+counter+"title").val(suc['tax'][i]['min']);
							$("#maxraange"+counter+"title").val(suc['tax'][i]['max']);
							$("#t"+counter+"rate").val(suc['tax'][i]['taxrate']);
							counter++;
						}
						
						
						$("#warehousevenuePopup").modal("show");
                    }

            });
    
}

function resetSearch(tableid,con)
{
    get_dataajax_data('data_table_2','venue');
}

function get_dataajax_data(tableid,con)
{
    
    var current=0;
    /*if(con=='venue')
    {
        current=1;
    }*/
    
	$('input:checkbox').removeAttr('checked');
    $('#'+tableid).dataTable().fnDestroy();
    $('#'+tableid)
        .dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"ajax/datatable_ajaxwarehouse.php?type="+con,
            "aoColumns":showFields[current][tableid]
        } );
}

function get_dataajaxtax_data(tableid)
{
    
    var current=0;
	$('input:checkbox').removeAttr('checked');
    $('#'+tableid).dataTable().fnDestroy();
    $('#'+tableid)
        .dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"ajax/datatable_ajaxtax.php",
            "aoColumns":showFields[current][tableid]
        } );
}

function delete_data_temp(id,tableid,type)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_data(\''+userIds+'\',\''+tableid+'\',\''+type+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+' confirm'+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        if(allCheckedArrayValues.length)
        {
            var userIds=allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_data(\''+userIds+'\',\''+tableid+'\',\''+type+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+' confirm'+'</button>');
            $('#sure_to_delete').modal();
        }
        else
        {
        
            $('#error_head').html('Error Message');
            $('#error_body').html('Please Select At Least One Check Box');
            $('#error_message').modal();
            setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
        }  
    }  
}

function delete_taxdata_temp(id)
{
    if(id)
    {
        var taxIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_tax_data(\''+taxIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+' confirm'+'</button>');
        $('#sure_to_delete').modal();
    }    
}

function delete_tax_data(taxId)
{
    
    $.ajax({
            url:extensions_ui_url+"ajax/delete.php?action=deletetax",
            data:"taxId="+taxId,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html('confirm');
                                    $("#model_des").html('Deleted');
                                    $('#success_modal').modal();
                                    get_dataajaxtax_data('data_table_2');
                                    setTimeout(function(){ 
                                    	$('#sure_to_delete').modal('hide');
                                    	$('#success_modal').modal('hide');
                                    },1000);
                        }
                        else if(suc['errorcode']=='160019'){
                            $("#model_head").html('not confirm');
                                $("#model_des").html(suc['data']);
                                $('#success_modal').modal();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('hide');
                                        $('#success_modal').modal('hide');
                                    },1000); 
                        }
                        else
                        {
                                $("#model_head").html('not confirm');
                                $("#model_des").html(' delete unsuccess');
                                $('#success_modal').modal();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('hide');
                                        $('#success_modal').modal('hide');
                                    },1000);   
                        }
                    }
        })
}



function delete_multiple_data(userIds,tableid,type)
{
    
    $.ajax({
            url:extensions_ui_url+"ajax/delete.php?action=deletewarehouse",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html('confirm');
                                    $("#model_des").html('Deleted');
                                    $('#success_modal').modal();
                                    get_dataajax_data(tableid,type);
                                    setTimeout(function(){ 
                                    	$('#sure_to_delete').modal('hide');
                                    	$('#success_modal').modal('hide');
                                    },1000);
                        }
                        else if(suc['errorcode']=='160019'){
                            $("#model_head").html('not confirm');
                                $("#model_des").html(suc['data']);
                                $('#success_modal').modal();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('hide');
                                        $('#success_modal').modal('hide');
                                    },1000); 
                        }
                        else
                        {
                                $("#model_head").html('not confirm');
                                $("#model_des").html(' delete unsuccess');
                                $('#success_modal').modal();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('hide');
                                        $('#success_modal').modal('hide');
                                    },1000);   
                        }
                    }
        })
}
function validation_successfull(tp)
{
        switch(tp)
        {
            case "warehouseeventSubmit":
                var werehouseeventidid=$("#eventid").val();
                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/warehouseSubmit.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                    resetformdata('warehouseeventSubmit');

                                    if(werehouseeventidid=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Event Inventory Added Successfully');
                                        $('#success_modal').modal();
                                        $("#warehouseeventPopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Event Inventory Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#warehouseeventPopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }

                                    get_dataajax_data('data_table_1','event');
                                    eventclicked('eventlist');
                                    
                                }
                                else
                                {
                                    if(data["success"]=="false" && data["errorcode"]=="16003")
                                    {
                                        $("#model_head").html('notconfirm');
                                        $("#model_des").html("This type of Event is already exist");
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000) 
                                        eventclicked('eventlist');
                                    }
                                    else
                                    {
                                        $("#model_head").html('notconfirm');
                                        $("#model_des").html("error try again");
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                        eventclicked('eventlist');

                                    }
                                }
                                
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });   
            break;
            
            case "warehousevenueSubmit":
                var werehousevenueid=$("#venueid").val();
                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/warehouseSubmit.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                    resetformdata('warehousevenueSubmit');

                                    if(werehousevenueid=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Venue Inventory Added Successfully');
                                        $('#success_modal').modal();
                                        $("#warehousevenuePopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Venue Inventory Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#warehousevenuePopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }

                                    get_dataajax_data('data_table_2','venue');
                                    eventclicked('venuelist');
                                    
                                }
                                else
                                {
                                    if(data["success"]=="false" && data["errorcode"]=="16003")
                                    {
                                        $("#model_head").html('notconfirm');
                                        $("#model_des").html("This type of Event is already exist");
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)   
                                        eventclicked('venuelist');
                                    }
                                    else
                                    {
                                        $("#model_head").html('notconfirm');
                                        $("#model_des").html("Error try again");
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                        eventclicked('venuelist');
                                    }
                                }
                                
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });   
            break;
			
			case "taxvenueSubmit":
			
                var werehousevenueid=$("#venueid").val();
                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/taxSubmit.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                    resetformdata('taxvenueSubmit');

                                    if(werehousevenueid=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Tax Added Successfully');
                                        $('#success_modal').modal();
                                        $("#warehousevenuePopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Tax Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#warehousevenuePopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                                    }
                                    get_dataajaxtax_data('data_table_2');
                                                                 
                                }
                                else
                                {
                                    if(data["success"]=="false" && data["errorcode"]=="16003")
                                    {
                                        $("#model_head").html('notconfirm');
                                        $("#model_des").html("This type of Event is already exist");
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)   
                                        eventclicked('venuelist');
                                    }
                                    else
                                    {
                                        $("#model_head").html('notconfirm');
                                        $("#model_des").html("Error try again");
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                        
                                    }
                                }
                                
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });   
            break;
            
        }
    }

    $(".warehouseevent").click(function(){
        resetformdata('warehouseeventSubmit');
       // $("#appendPrice").html('');
    });

    $(".warehousevenue").click(function(){
        resetformdata('warehousevenueSubmit');
       // $("#appendPrice2").html('');
    });

    function resetformdata(fromid)
    {
        $('#'+fromid)[0].reset();
        
        if(fromid=='warehousevenueSubmit')
        {
            $("#typevenue").val("venue");   
            $("#venueid").val("0");
        }
        else
        {
            $("#typeevent").val("event");
            $("#eventid").val("0");
        }

    }
    function  eventclicked(id) 
    {
        $('li').removeClass('active');
        $('#'+id+'1').addClass('active');
        $('.tab-pane').hide();
        $('#'+id).show();
        $('.tab-pane').removeClass('active in');
        $('#'+id).addClass('active in');
    }

  function addtablerow(select,type)
  {
        var id='pricetr'+counter;
        var newid='#image-'+id;
        var newidval='image-pricetr'+counter;
        var tabledata ='<tr id="'+id+'">';
          tabledata +='<td><input type="text" name="Pricetitle[]" class="form-control"></td>';
          tabledata +='<td><input type="text" name="Pricerate[]" class="form-control"></td>';
          if(type=='event'){
             tabledata +='<td><input type="number" name="PriceTicket[]" min="0" class="mange_event-width form-control"></td>';
          }
         
          tabledata +='<td><input type="text" name="Pricedesc[]" class="form-control"></td>';
          tabledata +='<td style="width: 100px;"><input type="file" name="Priceimg[]" class="imagevalidation form-control" id="'+newidval+'" style="display: none;"><span class="tooltip-area">';
          
          tabledata +='<a data-original-title="Image upload"  class="" title="Image upload" onclick="$(\''+newid+'\').click();">';

          tabledata +='<img id="blah" class="Cropthumbnail" src="'+site_url+'ui/admin/blog/css/addg.png" alt="your image" width="30" height="30" style="margin-left: 5px;"></a>&nbsp;';
          tabledata +='<a data-original-title="Delete" onclick="deletePriceHtml(\''+id+'\');" class="btn btn-default btn-sm" title=""><i class="fa fa-trash-o"></i></a>&nbsp;</span></td>';
          tabledata +=' </tr>';

          counter++;
          
          if(select=='1')
          {
            $("#appendPrice").append(tabledata);
          }
          else
          {
            $("#appendPrice2").append(tabledata);
          }
          
  }
  function deletePriceHtml(id)
  {
    $("#"+id).remove();
  }
  function edittablerow(select,selecttab)
  {
    var data= JSON.parse(select);
    var tabledata="";
    var image=site_url+'ui/admin/blog/css/addg.png';
    var counter=1;
    for(var i=0; i<data.length;i++)
    {
        $("#p"+counter+"rate").val(data[i]['rate']);
        counter++;
    }
          
  }

var _URL = window.URL || window.webkitURL;
$(document).ready(function(e) {
 $('.imagevalidation').live("change",function () {
   
    setloader();
    var fileExtension = ["jpg","JPG","PNG","png","JPEG","jpeg"];
    var obj=$(this);
     if($(this).val()=="")
    { 
         unloading();
    }
    else if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1)
    {   
        unloading();
        $(".imagevalidation").val("");
        $("#imageerror").html("Please upload only images");
    }
    else if(this.files[0].size > 104857600)
    {
        unloading();
        $(".imagevalidation").val("");
        $("#imageerror").html("Please upload less than 100mb images");

   }
   else if((file = this.files[0])) {

    if (this.files && this.files[0]) 
        {
            var FR= new FileReader();
            FR.onload = function(e) {
            
             imagebaseType= e.target.result;
          };       
          FR.readAsDataURL( this.files[0] );

          imageType=this.files[0].type;
        }   

        img = new Image();
        img.onload = function ()
        {
            var w=this.width;
            var h=this.height;
            var file, img;
            var wi = 100;
            var hi = 100;
            
            if(w == wi && h == hi) 
            {
                unloading();
                obj.parent().children().children().find('img').attr('src',imagebaseType);

            }
            else
            {
                   unloading();
                  $("#imageerror").html("Please Select Image Greater Then Or Exact (W-100 & H-100)");
            }
            
        };
        img.src = _URL.createObjectURL(file);
    }
   else
   {
           unloading();
        $("#imageerror").html("");
   }
 
 });
});