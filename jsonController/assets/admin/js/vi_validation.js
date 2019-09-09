var standard_error_text="This Field Is Required";
function validation(pg)
{   
  //alert(pg);


   var required_fields=get_validation_array(pg);
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
            case "2":
                var errorShowId=$('#'+required_fields[i]).attr('data-error-show-in');
                $('#'+errorShowId).html('');
                $('#'+required_fields[i]).removeClass('validation-error');
                var check=check_valid(required_fields[i]);
                if(check==0){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'error-text');  field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                if(check==2){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-email-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                if(check==3){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-gt-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                if(check==4){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-match-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
            break;  
            default:
                var errorShowId=$('#'+required_fields[i]).attr('data-error-show-in');
                $('#'+errorShowId).html('');
                $('#'+required_fields[i]).removeClass('validation-error');
                var check=check_valid(required_fields[i]);
                if(check==0){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'error-text');  field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                if(check==2){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-email-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                if(check==3){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-gt-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
                if(check==4){ $('#'+required_fields[i]).addClass('validation-error'); var error_text=get_error_text(required_fields[i],'valid-match-error'); field_ids.push(required_fields[i]); $('#'+errorShowId).html(error_text); }
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
          return true;
        //validation_successfull(pg);
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
                
                case "gt":
                    if($('#'+id).val().trim()!=''){
                        if(check_validation_types('gt',id,spl[1])==false)
                        {
                            return 3;
                        }
                       
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
            var re = /\S+@\S+\.\S+/;
            if(re.test($('#'+id).val())==false)
            {
                $('#'+id).val('');
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
                $('#'+id).val('');
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
                $('#'+id).val('');
                return false;
            }
            else
            {
                return true;
            }
        }   
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