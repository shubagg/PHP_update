searchFieldArr = JSON.parse(searchFieldJson);
filedLength = searchFieldArr.length;

for(i=0;i<filedLength;i++)
{
	//alert(filedLength);
	var tmp = searchFieldArr[i]['type'];
	var tmp1 = tmp+"_html";
	//alert(tmp1);
	var str = window[tmp1](searchFieldArr[i],i);
	
}	

function date_html(fieldAttr)
{
	var str = '';
	var cssClass = '';
	if(fieldAttr.hasOwnProperty('cssClass')){
		cssClass =fieldAttr.cssClass;
	}
	str+= '<div class="col-md-4 col-sm-4 col-xs-8 nopadding-left">';	
	str+='<label>'+fieldAttr.label+'</label>';	
	str+= '<div class="input-group date form_datetime1" data-picker-position="bottom-left" data-date-format="">';
	str+= '<input type="text" class="form-control '+cssClass+'" id="'+fieldAttr.id+'" name="'+fieldAttr.name+'">';
	str+= '<span class="input-group-btn">';
	str+= '<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>';
	str+= '<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>';
	str+= '</span>';
	str+= '</div>';
	str+= '<span id="err_'+fieldAttr.id+'" style="color:red"></span>';
	str+= '</div>';
	//alert(str);
	$("#formElement").append(str);
}

function getTest(val)
{
	var requiredParams = new Object();
   		requiredParams.course_id = val;
   		requiredParams.type  = 'test';
  
   var optionstr = '<option value="-1">All Test</option>';
	var params = JSON.stringify(requiredParams);
	$.ajax({
			url :admin_ui_url+"report/ajax/manage_report.php",
			data:"webserviceName=get_content_by_course_id&action=getrecord&params="+params,
			type:"post",
			success:function(suc)
			{
				suc = JSON.parse(suc);
				for(i=0;i<suc.length;i++)
				{
					optionstr+='<option value="'+suc[i].id+'">'+suc[i].name+'</option>';
				}
				
				$("#idtest").html(optionstr); 
			}
		})
}

function dropdown_html(fieldAttr)
{
	//alert(fieldAttr);
	var str ='';
	var cssClass = '';
	if(fieldAttr.hasOwnProperty('cssClass')){
		cssClass =fieldAttr.cssClass;
	}
	
	str+='<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 " style="padding-left:0;">';
	str+='<label>'+fieldAttr.label+'</label>';
	str+='<select id="'+fieldAttr.id+'" name="'+fieldAttr.name+'" '+fieldAttr.eventOption+' class="form-control required_field addUser editUser '+cssClass+' ">';   	   
   
    str+='</select>';
					
	str+='<span id="err_'+fieldAttr.id+'" style="color:red"></span>';
	str+='</div>';
	$("#formElement").append(str);
	createDropdown(fieldAttr);
}


function leader_button_html(fieldAttr)
{
	var str ='';
	var cssClass = '';
	if(fieldAttr.hasOwnProperty('cssClass')){
		cssClass =fieldAttr.cssClass;
	}
	str+='<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 " style="padding:0;">';
	str+='<button style="margin-top:24px" id="submitBtn" type="button" onclick="get_leader_board_data();" class="btn btn-block btn-theme-inverse pull-right ladda-button '+cssClass+' " data-style="zoom-in">Submit </button>';
	str+='</div>';
	$("#formElement").append(str);
}

function createDropdown(fieldAttr)
{

	var optionstr = '';
	if(fieldAttr.hasOwnProperty('firstOption')){
		
		var firstOpt = fieldAttr.firstOption.split('|');
        
		optionstr ='<option value="'+firstOpt[1]+'">'+firstOpt[0]+'</option>';

	}else{
		optionstr = '';
	}



	
	
	if(fieldAttr.sourceType=='web')
	{
		//alert(fieldAttr.source);
		var params = JSON.stringify(fieldAttr.requiredParams);
		//alert(params);
		$.ajax({
			url :admin_ui_url+"report/ajax/manage_report.php",
			data:"webserviceName="+fieldAttr.source+"&action=getrecord&params="+params,
			type:"post",
			success:function(suc)
			{
				//alert(suc);
				//console.log(suc);
				suc = JSON.parse(suc);
				for(i=0;i<suc.length;i++)
				{
					
					optionstr+='<option value="'+suc[i].id+'">'+suc[i].name+'</option>';
				}
				$("#"+fieldAttr.id).html(optionstr); 
			}
		})
	}
	else
	{
		if(fieldAttr.source !='')
		{
			var options = fieldAttr.source.split(",");
			for(j=0;j<options.length;j++)
			{
				optionPart = options[j].split("|");
				optionstr+='<option value="'+optionPart[0]+'">'+optionPart[1]+'</option>';
			}			
		}
		$("#"+fieldAttr.id).html(optionstr); 
	}
}

function  get_report_data()
{
	var formData = $( "#reportForm" ).serialize();
	ladda_toggle('submitBtn');
	$.ajax({
            type: "POST",
            url:  admin_ui_url+"report/ajax/manage_report.php?action=get_report_data",
            data: formData,
        
            success: function(data) 
			{
                //alert(data);

                //console.log(data);              
				ladda_toggle('submitBtn');
                var reportdata = JSON.parse(data);
                //charts
                //alert(reportdata['data']['tdata']);
                if(reportdata['data']['tdata']!=null)
                {
                	//alert(reportdata['data']['reportId']);
                	//alert(reportdata['data']['thead']);
	                var clength = reportdata['data']['chartType'].length;
					for(i=0;i<clength;i++)
					{				
						var ctmp =  reportdata['data']['chartType'][i];
						var Ctmp1 = "draw"+ctmp+"Chart";
						window[Ctmp1](reportdata['data']['chartData'],reportdata['data']['reportName']);
					}
					
					var rid  = reportdata['data']['reportId'];
					var defaultFields  = reportdata['data']['defaultField'];
					var allFields  = reportdata['data']['allFields'];


					get_report_tmp(reportdata['data']['thead'],reportdata['data']['tdata'],reportdata['data']['defaultField'],rid,defaultFields,allFields);

					$("#report-sec").show();
				}
				else
				{
					$("#reportsData").html("No Data Available");
					$("#report-sec").hide();
					$("#reportsData").show();
				}
            }
  
    });  
}

function button_html(fieldAttr)
{
	var str ='';
	var cssClass = '';
	if(fieldAttr.hasOwnProperty('cssClass')){
		cssClass =fieldAttr.cssClass;
	}
	str+='<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 " style="padding:0;">';
	str+='<button style="margin-top:24px" id="submitBtn" type="button" onclick="get_report_data();" class="btn btn-block btn-theme-inverse pull-right ladda-button '+cssClass+' " data-style="zoom-in">Submit </button>';
	str+='</div>';
	$("#formElement").append(str);
}


function ladda_toggle(button_id)
{   
    var l= Ladda.create(document.querySelector('#'+button_id));
    l.toggle();       
} 






function show_report_datatable(start,end)
{
    var show_fields=[{'mDataProp':'title'},{'mDataProp':'description'}];
    $('#data_table_1').dataTable().fnDestroy();
   
   $('#data_table_1')
        .dataTable( { 
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": admin_ui_url+"report/ajax/datatable_ajax.php?start="+start+"&end="+end,
            "aoColumns":show_fields
        } );
}

/*------------------ report template -------------------------*/
function get_report_tmp(head,field,defaultField,reportID,defaultFields,allFields){
$("#allcheckbox").html("");
if(reportID!='undefined')
{	
	var newreport_id = reportID;
	var newFArr=defaultFields;
	var newAllFieldsArr=allFields;
	for(i=0;i<newAllFieldsArr.length;i++)
  {
  	var ids1=newAllFieldsArr[i]['fieldName'].replace(/[{()}]/g, '');
  	var fieldtext=' <input class="ich-fields" type="checkbox" id="ich-'+ids1.replace(/ /g, '_')+'" name="filterdata[]" value="'+newAllFieldsArr[i]['fieldName']+'">'+newAllFieldsArr[i]['fieldName'];
    $("#allcheckbox").append(fieldtext);
  }
  

}else
{	
	var newreport_id = report_id;	
	var newFArr=JSON.parse(FilterFields);
	var newAllFieldsArr=JSON.parse(allFieldsArr);
	for(i=0;i<newAllFieldsArr.length;i++)
  {
  	var ids1=newAllFieldsArr[i].replace(/[{()}]/g, '');
  	var fieldtext=' <input class="ich-fields" type="checkbox" id="ich-'+ids1.replace(/ /g, '_')+'" name="filterdata[]" value="'+newAllFieldsArr[i]+'">'+newAllFieldsArr[i];
    $("#allcheckbox").append(fieldtext);
  }
	
} 
  
  
   var data={"head":head,"field":field,"defaultField":newFArr,"report_id":newreport_id,'mid':mid,'smid':smid};
	$.ajax({
	  type: "POST",
	  url:  admin_template_path_site+"customTemplates/reportTable.tpl.php?action=get_retData&type=submit",
	  data: data,
	  success: function(response) 
	  {
	  	//console.log(response);

	 	$("#reportsData").show();
	    $("#reportsData").html(response);
	  }

	});
}

function checkedheadersetting(){
  $(".ich-fields").removeAttr("checked");	
  var newFArr1=JSON.parse(OlddefaultField);	
  for(i=0;i<newFArr1.length;i++)
  {
  	var ids=newFArr1[i].replace(/[{()}]/g, '');
    $('#ich-'+ids.replace(/ /g, '_')).attr('checked',"checked");
  }
	$("#fileterModel").modal('show');
	
}

function get_data_by_fields()
{
	
	var head1=JSON.parse(head);
	var field1=JSON.parse(field);
	OlddefaultField=JSON.parse(OlddefaultField);
	var defaultField = [];
	 $("input[type=checkbox]:checked").each(function() {
	 	
    	defaultField.push($(this).val());
	});
	 if(defaultField.length<2){
	 	alert("Please select at least two fields");

	 	defaultField=OlddefaultField;
	 }
	
	var data={"head":head1,"field":field1,"defaultField":defaultField,"report_id":new_report_id,'mid':new_mid,'smid':new_smid};
	$.ajax({
	  type: "POST",
	  url:  admin_template_path_site+"customTemplates/reportTable.tpl.php?action=get_retData",
	  data: data,
	  success: function(response) 
	  {
	  	//alert(response);
        $("#reportsData").show();
	    $("#reportsData").html(response);
	    $("#fileterModel").modal('toggle');
	  }

	});
}


function export_report()
{
	var h=JSON.parse(head);
	var f=JSON.parse(field);
	//alert(h);
	//alert(f);
    var data={"head_data":h,"show_data":f};
    //var data="action=abc";
	$.ajax({
	  type: "post",
	  url:  admin_ui_url+"report/ajax/export_report_data.php?action=report",
	  data: data,
	  success: function(suc) 
	  {
         //alert(suc);
         suc=JSON.parse(suc);
                    if(suc['success']=='false')
                    {
                        $('#error_body').html('No Data To Export');
                        $('#error_head').html('Error');
                        $('#error_foot').html('');
                        $('#error_message').modal();
                        setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
                    }
                    else
                    {
                        window.location=suc['data']['path'];
                    }
	  }

	});
}