function sendquestion(){
    var msg=$("#msg").val();
      if(msg!=""){
        $("#msg").val("");
        var chatTo="";
        if($(".chat-collapse" ).find( "i" ).hasClass("fa-plus")){
          $(".chat-collapse").click();
        }
        /*if(chatcounter==1){
          var dNow = new Date();
          var utc = new Date(dNow.getTime() + dNow.getTimezoneOffset() * 60000);
          var utcdate= utc.getHours() + ':' + utc.getMinutes();
              chatTo="<dt><strong>Today </strong> "+utcdate+"</dt>";  
        }
			//admin_ui_url+"dashboard/ajax/rpachat.php?action=chatrpa"

      http://192.168.1.16:300/login
      
		*/
        chatTo ='<dd class="to" id="question'+chatcounter+'"><p>'+msg.trim()+'</p></dd>';
        $("#chatdata").append(chatTo); 
        $("#focustab").html('<a href="#question'+chatcounter+'" id="anchortag"></a>');
        $('#anchortag')[0].click();
        $.ajax({
                url: "http://192.168.1.12:500/login",
                data:"ques="+msg,
				        crossDomain: true,
                type:"POST",
                success:function(suc){
                  if(suc!=""){
                    setTimeout(function(){  
                    $("#afocustab").html('<a href="#answerid'+chatcounter+'" id="anchortagans"></a>');
                    var chatFrom='<dd class="from" id="answerid'+chatcounter+'"><p>'+suc.trim()+'</p></dd>'; 
                    $("#chatdata").append(chatFrom);
                     $('#anchortagans')[0].click();
                     $('#msg').focus();
                    chatcounter++;
                  }, 1000);
                  }
                }
                }); 
    }
 }
$('#msg').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    sendquestion();
    return false;  
  }
}); 


$('.clickplus').click(function(){ 
        if($(".chat-collapse" ).find( "i" ).hasClass("fa-plus")){
            if(helpcounter==1){
            var chatFrom='<dd class="from" id="answerid1"><p>How may I help you today?</p></dd>';
             $("#chatdata").append(chatFrom); helpcounter++;
           }
        }
});
