var standard_error_text="This Field Is Required";
function validation(tg)
{
    
   var required_fields=get_validation_array(tg);
   var field_ids=[];
   var error_texts=[];
   for(i=0;i<required_fields.length;i++)
   {
        switch($('#'+required_fields[i]).attr('data-error-setting'))
        {
            case "1":
                var error_text=get_error_text(required_fields[i]);
                var check=check_valid(required_fields[i]);
                if(check==0){field_ids.push(required_fields[i]); $('#'+required_fields[i]).val(error_text); }
                
            break;
            default:
                var errorShowId=$('#'+required_fields[i]).attr('data-error-show-in');
                $('#'+errorShowId).html('');
                $('#'+required_fields[i]).removeClass('validation-error');
                
                var field_type=document.getElementById(required_fields[i]).type;
                switch(field_type)
                {
                    case "radio":
                        var radio_name=$('#'+required_fields[i]).attr('name');
                        var check=check_radio_checkbox(radio_name);
                        if(check==0){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'error-text');  field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text);  }
                    break;
                    
                    case "checkbox":
                        var checkbox_name=$('#'+required_fields[i]).attr('name');
                        var check=check_radio_checkbox(checkbox_name);
                        if(check==0){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'error-text');  field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text);  }
                    break;
                    
                    default:
                        var check=check_valid(required_fields[i]);
                        if(check==0){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'error-text');  field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==2){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-email-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==3){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-gt-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==4){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-match-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==5){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-eq-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==6){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-numeric-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==7){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-nospecial-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==8){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-lt-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        if(check==9){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-gtval-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
						if(check==10){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-na-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                        
                    break;
                }
            break;    
        }
   }
   if(field_ids.length)
   {    
        $('#'+field_ids[0]).focus();
        return false;
   }
   else
   {
          validation_successfull(tg);   
   }
   
   
}

function check_radio_checkbox(radio_name)
{
    var check=$("input[name='"+radio_name+"']:checked").length;
    if(check==0)
    { 
        return 0;
    }
}


function check_valid(id)
{  
    var check_valid=$('#'+id).attr('data-check-valid');
    if(check_valid)
    {
        check_valid=check_valid.split(',');
        
        for(k=0;k<check_valid.length;k++)
        {
            var spl=check_valid[k].split('-');
           
            
            switch(spl[0])
            {
                case "blank":
                    if($('#'+id).val().trim()==''){
                        return 0;
                    }
                break;
                case "email":
                    if($('#'+id).val().trim()!=''){
                        if(check_validation_types('email',id)==false)
                        {
                            return 2;
                        }
                       
                    }
                break;
                
                case "numeric":
                    if($('#'+id).val().trim()!=''){
                        if(check_validation_types('numeric',id)==false)
                        {
                            return 6;
                        }
                    }
                break;

                
                
                case "gt":
                    if($('#'+id).val().trim()!=''){
                        if(check_validation_types('gt',id,spl[1])==false)
                        {
                            return 3;
                        }
                    }
                break;

                case "lt":
                    if($('#'+id).val().trim()!=''){
                        if(check_validation_types('lt',id,spl[1])==false)
                        {
                            return 8;
                        }
                    }
                break;
                case "gtval":
                    if($('#'+id).val().trim()!=''){
                        if(check_validation_types('gtval',id,spl[1])==false)
                        {
                            return 9;
                        }
                    }
                break;
                case "eq":
                    if($('#'+id).val().trim()!=''){
                        if(check_validation_types('eq',id,spl[1])==false)
                        {
                            return 5;
                        }
                    }
                break;
                
                case "nospecial":
                    if($('#'+id).val().trim()!=''){
                            if(check_validation_types('nospecial',id,spl[1])==false)
                            {
                                return 7;
                            }
                        }
                
                break;
				
				case "allow_na_numeric":
				
                    if($('#'+id).val().trim()!='N/A' && check_validation_types('numeric',id)==false)
					{
						 return 10;
                    }
                break;
                
                case "match":
                    
                    if($('#'+id).val().trim()!='' && !$('#'+id).hasClass('validation-error')){
                        if(check_validation_types('match',id,spl[1])==false)
                        {
                            return 4;
                        }
                    }
            }
        }
    }
    else
    {
        if($('#'+id).val().trim()!='')
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }            
}

function check_validation_types(tp,id,atr)
{
    switch(tp)
    {
        case "email":
            //var re = /\S+@\S+\.\S+/; update regex for email validation
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(re.test($('#'+id).val())==false)
            {
                //$('#'+id).val('');
                return false;
            }
            else
            {
                return true;
            }
        break;
        
        case "gt":
            if($('#'+id).val().length < atr)
            {
                //$('#'+id).val('');
                return false;
            }
            else
            {
                return true;
            }
        break; 

        case "lt":
            if($('#'+id).val().length > atr)
            {
                return false;
            }
            else
            {
                return true;
            }
        break; 
          
        case "gtval":
            if($('#'+id).val() < 1)
            {
                return false;
            }
            else
            {
                return true;
            }
        break; 
            
        case "eq":
            if($('#'+id).val().length != atr)
            {
                return false;
            }
            else
            {
                return true;
            }
        break;
        
        case "match":
        {
            var matchId=$('#'+id).attr('data-match-with');
            if($('#'+id).val()!=$('#'+matchId).val())
            {
                return false;
            }
            else
            {
                return true;
            }
        } 
        
        
        case "nospecial":
            if(/^[a-zA-Z0-9- ]*$/.test($('#'+id).val()) == false) 
            {
                return false;
            }
            else
            {
                return true;
            }
        break;
        
        case "numeric":
            if(isNaN($('#'+id).val()))
            {
                //$('#'+id).val('');
                return false;
            }
            else
            {
                return true;
            }
        break;

        
    }
}


function get_error_text(id,tp)
{
    var check_error_text=$('#'+id).attr('data-'+tp);
    if(check_error_text){
        return check_error_text;
    }else{
        return standard_error_text;
    }
}

function get_validation_array(tg)
{
    var reqar=[];
    $(".required_field").each(function (index, element) {
        var id=this.id;
            if($('#'+id).hasClass(tg))
            {
                reqar.push($(this).attr("id"));
            }
    });
    return reqar;
}






function validImage(input,numb)
{ 
    var img=input.value;
    var imgext=img.split(".");
    imgext=imgext[imgext.length-1];
    if(imgext=='jpg' || imgext=='png'|| imgext=='JPG'|| imgext=='JPEG' || imgext=='jpeg' || imgext=='gif' ||imgext=='GIF')
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('showimage'+numb).innerHTML='<img width="150" height="90" alt=""  src="'+e.target.result+'"/>';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    else
    {
        document.getElementById(input.id).value='';
        $('#eshowimage'+numb).html('Please Upload jpg or png files only');
    }
}


