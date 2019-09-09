	var fake_js = function () {};
	fake_js.prototype = {
		log:function (a) {
		//	alert(a);
		},
	getlocally:function(key,value)
		{
            localStorage.type=key;
			localStorage.tid=value;
            window.location="content.html"; 
		},
    set_search_data:function(s_data)
    {
        //alert("js page"+s_data);
        var jData=JSON.stringify(s_data);
        localStorage.sData=jData;
        window.location="search_display.html";
    },
    setlocally:function(key,value)
	{
        localStorage.type=key;
		localStorage.tid=value;
        window.location="content.html"; 
	},
    get_desc_id:function(key,value)
		{
            localStorage.type=key;
			localStorage.did=value;
            window.location="description.html"; 
		},
	postlocally:function(value)
		{
			
		},
	getvalue:function(key,value)
		{
			
		},	
    setvalue:function(key,value)
		{
			
		},	
	postvalue:function(value)
		{
			
		},
	onAdClick :function(a)
		{
			
		},
	updateTitleBar:function(a,b)
		{
			
		},
	showProgress:function()
		{
			
		},
	hideProgress:function()
		{
			
		},
    user_login:function()
    {
    
        var login_path="http://www.xeliumtech.in/app_store/webservice/login_ajax.php";
      alert(jQuery('#contact-form').serialize());
    	jQuery.ajax({
            url: login_path, //This is the page where you will handle your SQL insert
            type: "POST",
            data: jQuery('#contact-form').serialize(), //The data your sending to some-page.php
            success: function(aaa){
                
		       alert(aaa);
               if(aaa==1)
               { 
                    
                    window.location="index.html";
               }
               else
               {
                    alert('incorrect username and password');
                    document.getElementById('email').value="";
                    document.getElementById('password').value="";
                    document.getElementById('email').setAttribute("class","error_cl");
		            return false;
               }
		      
            },
            error:function(){
                console.log("AJAX request was a failure");
            }   
        });
    },
    sign_up:function()
    {
         var sign_up_path="http://www.xeliumtech.in/app_store/webservice/sign_up.php";
            alert(jQuery('#contact-form').serialize());
        	jQuery.ajax({
                url: sign_up_path, //This is the page where you will handle your SQL insert
                type: "POST",
                data: jQuery('#contact-form').serialize(), //The data your sending to some-page.php
                success: function(aaa){
                    alert(aaa);
                  if(aaa==1)
                   { 
                        window.location="login.html";
                   }
                   else if(aaa==2)
                   {
                        document.getElementById('email').value="";
                        document.getElementById('password').value="";
                        document.getElementById('email').setAttribute("class","error_cl");
			             return false;
                   }
                   
                   else
                   {
                        return false;
                   }
                },
                error:function(){
                    console.log("AJAX request was a failure");
                }   
            });  
    },
    homepage:function()
    {
       
          var cat1_path="http://www.xeliumtech.in/app_store/webservice/get_category1.php";
        $.ajax({
                  url: cat1_path, //This is the page where you will handle your SQL insert
                  type: "POST",
                  success: function(ctg_re){
                    //alert(ctg_re);
                    con_add(ctg_re);
                   // return ctg_re;
                  },
                  error:function(){
                      console.log("AJAX request was a failure");
                  }   
                });
                
    },
    content_edc:function()	
    {
        var editor_path="http://www.xeliumtech.in/app_store/webservice/get_edc.php";
        var id=localStorage.tid;
        $.ajax({
          url: editor_path, //This is the page where you will handle your SQL insert
          type: "POST",
    	  data:"id="+id,
          success: function(ed_re){
    		content_data(ed_re);
    		
          },
          error:function(){
              console.log("AJAX request was a failure");
          }   
        });
        
    },
    content_dwn:function()	
    {
             var download_path="http://www.xeliumtech.in/app_store/webservice/get_dw.php";
             var id=localStorage.tid;
        $.ajax({
          url: download_path, //This is the page where you will handle your SQL insert
          type: "POST",
    	  data:"id="+id,
          success: function(do_re){
            
    		content_dw(do_re);
          },
          error:function(){
              console.log("AJAX request was a failure");
          }   
        });
        
    },
    content_description:function()	
    {
         var desc_path="http://www.xeliumtech.in/app_store/webservice/get_content_description.php";
         var sim_desc_path="http://www.xeliumtech.in/app_store/webservice/similar_content_description.php";
   	    var id=localStorage.did;
        var cid=localStorage.tid;
        //alert("ctg id="+cid);
        //alert("description id="+id);
        $.ajax({
          url: desc_path, //This is the page where you will handle your SQL insert
          type: "POST",
    	  data:"id="+id,
          success: function(con_des){
    	   	//alert(con_des);
            detail_data(con_des);
            		
    		
          },
          error:function(){
              console.log("AJAX request was a failure");
          }   
        }); 
        
        $.ajax({
          url: sim_desc_path, //This is the page where you will handle your SQL insert
          type: "POST",
    	  data:"id="+id +"&cid="+cid,
          success: function(sim_des){
    	   	//alert(sim_des);
            similar_data(sim_des);	
          },
          error:function(){
              console.log("AJAX request was a failure");
          }   
        }); 
        
    },
    
    	call_course:function()
	{
	//var cat1_path="http://localhost:81/app/webservice/get_courses.php";
	var cat1_path = "http://www.xeliumtech.in/app_store/webservice/get_courses.php";
	$.ajax({
                  url: cat1_path, //This is the page where you will handle your SQL insert
                  type: "POST",
                  success: function(ctg_re){
                  
           		    
            		con_add1(ctg_re);
            		
                  },
                  error:function(ctg_re){
					  alert(" yo yo  alert "+JSON.stringify(ctg_re));
                      console.log("AJAX request was a failure");
                  }   
                });
	
	},
    download_file:function(a,b)
    {
        alert(a);
        alert(b);
    },
    
     show_cont_dt:function(a,b)
    {
        alert(b);
        
          $.ajax({
			type: "POST",
			url: "http://www.xeliumtech.in/app_store/webservice/ajax_details.php",
			data: "value1="+a +"&value2="+b,
           
            success: function(html1){
					//alert("response is : "+html1);
                    show_cont_data(html1);
                  // alert(html1.trim());
          
            $('#cls').html(html1);
                
                
			//	$("#record").html(html);
			},
          error:function(html1){
            alert(JSON.stringify(html1));
              console.log("AJAX request was a failure");
          }   
		});
    },
    get_search_val:function()
    {
        //alert("you are here");
        var crs_id=jQuery('input[type=radio][name=cour_radio]:checked').val();
        var cls_id=jQuery('input[type=radio][name=class_radio]:checked').val();
        var sub_id=jQuery('input[type=radio][name=sub_radio]:checked').val();
        var id=localStorage.tid;
         // alert(id);
       // alert(crs_id);
       // alert(cls_id);
       // alert(sub_id);
       if(isNaN(crs_id))
       {
            crs_id='';
       }
       if(isNaN(cls_id))
       {
            cls_id='';
       }
       if(isNaN(sub_id))
       {
            sub_id='';
       }
        $.ajax({
			type: "POST",
			url: "http://www.xeliumtech.in/app_store/webservice/get_search_data.php",
			data: "c_id="+id +"&crs_id="+crs_id +"&cls_id="+cls_id +"&sub_id="+sub_id,
           
            success: function(html1){
		          //alert("response is : "+html1);
                  
                  jsinterface.set_search_data(html1);
                   
			},
          error:function(html1){
            alert(JSON.stringify(html1));
              console.log("AJAX request was a failure");
          }   
		});
    },
         show_user_cont:function()
    {
        //alert(b);
        
          $.ajax({
			type: "POST",
			url: "http://www.xeliumtech.in/app_store/webservice/get_user_content.php",
           
            success: function(html1){
					//alert("response is : "+html1);
                    con_add(html1);
                  // alert(html1.trim());
          
            //$('#cls').html(html1);
                
                
			//	$("#record").html(html);
			},
          error:function(html1){
            alert(JSON.stringify(html1));
              console.log("AJAX request was a failure");
          }   
		});
    }
    
    
    
    
	};
	
	//var jsinterface = new fake_js();