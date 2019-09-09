var allCheckedArray=[];    
var allCheckedArrayValues=[];

function checkall()
    {
        var mid="";
       	var  a=document.getElementsByName("status"); 
        //$('.check_box').html();
        console.log(a);
        
        if(document.getElementById('checklist').checked == true)
        {
            for(i=0;i<a.length;i++)
            {
           	    a[i].checked=true; 
                allCheckedArray.push(a[i].id);
                mid=allCheckedArray.join('|');
                
            }   
                console.log(mid);
                datastring="mid="+mid+"&val=1";
                $.ajax({
                  
                  url:admin_ui_url+"resources/ajax/status.php",
                  type:"post",
                  data:datastring,
                  success:function(suc)
                  {
                        suc=JSON.parse(suc);
                        console.log(suc);
                        if(suc['success']=='true')
                        {   
                            $("#model_des").html("Successfull Checked");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }
                        else
                        {
                            $("#model_des").html("Unsuccessfull");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }     
                  } 

                })
            
           
        }

        if(document.getElementById('checklist').checked == false)
        {   

            for(i=0;i<a.length;i++)
            {
                a[i].checked=false; 
                allCheckedArray.push(a[i].id);
                mid=allCheckedArray.join('|');   
            }   

                datastring="mid="+mid+"&val=0";
                $.ajax({
                  
                  url:admin_ui_url+"resources/ajax/status.php",
                  type:"post",
                  data:datastring,
                  success:function(suc)
                  {   
                        suc=JSON.parse(suc);
                        console.log(suc); 
                        if(suc['success']=='true')
                        {   
                            $("#model_des").html("Successfull Unchecked");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }
                        else
                        {
                            $("#model_des").html("Unsuccessfull");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }    
                  } 

                })

        }
    }


function checkBoxChecked(id)
{    
    console.log(id);
    if(document.getElementById(id).checked==false)
    {
        datastring="mid="+id+"&val=0";
                $.ajax({
                  
                  url:admin_ui_url+"resources/ajax/status.php",
                  type:"post",
                  data:datastring,
                  success:function(suc)
                  {
                        suc=JSON.parse(suc);
                        console.log(suc);
                        if(suc['success']=='true')
                        {   
                            $("#model_des").html("Successfull Unchecked");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }
                        else
                        {
                            $("#model_des").html("Unsuccessfull");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }     
                  } 

                })
    }
    else
    {
        datastring="mid="+id+"&val=1";
                $.ajax({
                  
                  url:admin_ui_url+"resources/ajax/status.php",
                  type:"post",
                  data:datastring,
                  success:function(suc)
                  {
                        suc=JSON.parse(suc);
                        console.log(suc);
                        if(suc['success']=='true')
                        {   
                            $("#model_des").html("Successfull Checked");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }
                        else
                        {
                            $("#model_des").html("Unsuccessfull");
                            $('#success_modal').modal("show");
                            setTimeout(function(){ $('#success_modal').modal("hide"); },1000);
                        }     
                  } 

                })
            
    }    
}
