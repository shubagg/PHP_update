function check_validation(tg)
{
	var check_error_exist="0";
	$(".error" ).remove();
   $(".mandatory_field").each(function (index, element){
    	

    	var thisdata=$(this);
    	var type_check=$(this).attr('data-check');
    	var data_error=$(this).attr('data-error');
    	var red_hower=$(this).attr('data-createform-id');

    	$('[data-createform="'+red_hower+'"]').next().removeClass("error_color");
    	if(type_check!=""){
    		var returncheck=check_valid_field(type_check,thisdata);	
    		if(returncheck==0){
    			check_error_exist="1";
    			$('[data-createform="'+red_hower+'"]').next().addClass("error_color");
    			$(this).after('<span class="red error">'+data_error+'</span>');
    		}else{
    			if(check_error_exist=="1"){
    				check_error_exist="1";	
    			}else{
    				check_error_exist="0";
    			}
    			
    		}
    	}
    });
   return check_error_exist;
}
function check_valid_field(id,thisdata)
{  
	 var spl=id.split(',');
	 for(var k=0;k<spl.length;k++)
     {
     	var check=spl[k].trim();
		switch(check)
		{
		    case "blank":
		        if($(thisdata).val().trim()==''){
		            return 0;
		        }
		    break;
		    case "numeric":
	            if(isNaN($(thisdata).val()))
	            {
	                return 0;
	            }
		    break;
		}
	}
}