function validation_successfull(tp)
{
alert(tp);
switch(tp)
{

case "interest_page":


var interest_name = document.getElementById('interest_name').value.trim();

var pg_name = 'interest_add';
var interest_id = document.getElementById('interest_id').value.trim();


$.ajax({
        
        
        url:"php_curl.php",
        data:
        {
            interest_id:interest_id,
            interest_name:interest_name,
            pg_name:pg_name
            
        },
        
        type:"post",
        success:function(suc)
        {
           alert(suc);
            if(suc.trim()=='1')
            {
                window.location.href = admin_ui_url+'interest/interests_listing.php'; 
            }
            else
            {
                
            }
        }
        
    })
    


break;

case "cms_page":


var pg_heading = document.getElementById('pg_name').value.trim();
var pg_url = document.getElementById('pg_url').value.trim();
var pg_un_name = document.getElementById('pg_un_name').value.trim();

var pg_content = CKEDITOR.instances['pg_content'].getData();
var pg_name = 'cms_page';
var pg_id = document.getElementById('pg_id').value.trim();

if((pg_url!='')||(pg_url!=NULL))
{
    
    pg_url = pg_un_name.replace(/\s\s+/g, ' ');
    pg_url = pg_url.replace(" ","_");
    pg_url = pg_url.toLowerCase();
}

$.ajax({
        
        
        url:"php_curl.php",
        data:
        {
            pg_heading:pg_heading,
            pg_url:pg_url,
            pg_content:pg_content,
            pg_id:pg_id,
            pg_un_name:pg_un_name,
            pg_name:pg_name
            
        },
        
        type:"post",
        success:function(suc)
        {
           
            if(suc.trim()=='1')
            {
                window.location.href = admin_ui_url+'cms/listing_cms_pages.php'; 
            }
            else
            {
                
            }
        }
        
    })
    


break;

}
}
function unique_name_create()
{
    
    var pg_name = document.getElementById('pg_name').value.trim();
    var pg_un_name = pg_name.replace(/\s\s+/g, ' ');
    pg_un_name = pg_un_name.replace(" ","_");
    
    pg_un_name = pg_un_name.toLowerCase();
    document.getElementById('pg_un_name').value = pg_un_name;
    
}
function check_unique_url()
{
    
    var pg_name = document.getElementById('pg_url').value.trim();
    var pg_un_name = pg_name.replace(/\s\s+/g, ' ');
    pg_un_name = pg_un_name.replace(" ","_");
    pg_un_name = pg_un_name.toLowerCase();
    
    $.ajax({
        
        
        url:"php_curl.php?pg_name=check_url",
        data:"&pg_url="+pg_un_name,
        type:"post",
        success:function(suc)
        {
            console.log(suc);
            if(suc.trim()=='1')
            {
                alert("boom");
            }
            else
            {
               document.getElementById('pg_url').value = '';
               $('#e_pg_url').html('Please Enter Unique Value'); 
            }
        }
        
    })
   
    
}
function check_unique_heading()
{
    
    var pg_name = document.getElementById('pg_name').value.trim();
    var pg_un_name = pg_name.replace(/\s\s+/g, ' ');
    pg_un_name = pg_un_name.replace(" ","_");
    pg_un_name = pg_un_name.toLowerCase();
     
     $.ajax({
        
        
        url:"php_curl.php?pg_name=check_name",
        data:"&pg_heading="+pg_un_name,
        type:"post",
        success:function(suc)
        {
            alert(suc);
            if(suc.trim()=='1')
            {
                
            }
            else
            {
                document.getElementById('pg_name').value = '';
                $('#e_pg_name').html('Please Enter Unique Value');
            }
        }
        
    })
    
    
    
    
   
    
}