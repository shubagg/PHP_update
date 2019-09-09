try {
  var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  var recognition = new SpeechRecognition();
  var recognizing = false;
      recognition.interimResults = true; //to increaser the speed
      recognition.maxAlternatives = 3;
      //recognition.continuous = true;
      recognition.synth = window.speechSynthesis;
}
catch(e) {
  $('.no-browser-support').show();
  $('.app').hide();
}

var noteTextarea = "";
var instructions = $('#recording-instructions');
var noteContent = '';
var focuselement='';

var speechToText='';
recognition.onresult = (event) => {
  console.log("start");
       speechToText = Array.from(event.results)
      .map(result => result[0])
      .map(result => result.transcript)
      .join('');
      if (event.results[0].isFinal){
          callback(speechToText);
      }
};
function callback(speechToText){

    if(speechToText!=""){
    var completetext=speechToText;
        completetext=completetext.toLowerCase();
        console.log(completetext);
    if($.trim(completetext)=="tab"){
            var inputs = $(':input'); var nextInput = inputs.get(inputs.index(focuselement) + 1);
            if (nextInput) {
                nextInput.focus();
                focuselement=$('#'+nextInput.id);
            }
    }else{
        
        var res = completetext.split('tab');
        res = res.filter(function(v){return $.trim(v)!=='' });
    if(res.length>0){

      for (var i = 0; i < res.length; i++){
     
          if(statuscount=='1'){
            noteContent=$('#fname').val();
            $('#fname').focus();
            noteTextarea = $('#fname');
            noteContent += $.trim(res[i]);
            noteTextarea.val(noteContent);
            statuscount="2";
          }else if(statuscount=="2"){
                noteContent=$('#lname').val();
                $('#lname').focus();
                noteTextarea = $('#lname');
                noteContent += $.trim(res[i]);
                noteTextarea.val(noteContent);
                statuscount="3";
          }else if(statuscount=="3"){
                noteContent=$('#email').val();
                $('#email').focus();
                noteTextarea = $('#email');
                noteContent += $.trim(res[i]);
                noteTextarea.val(noteContent);
                statuscount="4";
          }else if(statuscount=="4"){
                noteContent=$('#Phone').val();
                $('#Phone').focus();
                noteTextarea = $('#Phone');
                noteContent += $.trim(res[i]);
                noteTextarea.val(noteContent);
                statuscount="5";
          }else if(statuscount=="5"){
                noteContent=$('#description').val();
                $('#description').focus();
                noteTextarea = $('#description');
                noteContent += $.trim(res[i]);
                noteTextarea.val(noteContent);
                statuscount="";
          }else if(res[i].match('save')=="save"){
                submitform();
          }else if(res[i].match('reset')=="reset"){
                $('#contentform')[0].reset();
          }else if(res[i].match('save')=="save"){
               window.location.reload();
          }
          else{
              var hasFocusFname = $('#fname').is(':focus'); 
              var hasFocusLname = $('#lname').is(':focus'); 
              var hasFocusEmail = $('#email').is(':focus'); 
              var hasFocusPhone = $('#Phone').is(':focus'); 
              var hasFocusDescription = $('#description').is(':focus'); 
              if(hasFocusFname){
                focuselement=$('#fname');
                $('#fname').focus();
              }else if(hasFocusLname){
                focuselement=$('#lname');
                $('#lname').focus();
              }else if(hasFocusEmail){
                focuselement=$('#email');
                $('#email').focus();
              }else if(hasFocusPhone){
                focuselement=$('#Phone');
                $('#Phone').focus();
              }else if(hasFocusDescription){
                focuselement=$('#description');
                $('#description').focus();
              }else{
                
                var inputs = $(':input'); var nextInput = inputs.get(inputs.index(focuselement) + 1);
                if (nextInput) {
                    nextInput.focus();
                    focuselement=$('#'+nextInput.id);
                }
              }
          }
      }
    }
   }
  }
}
recognition.onstart = function() { 
  recognizing = true;
  instructions.text('Voice recognition activated. Try speaking into the microphone.');
}

recognition.onspeechend = function() {
  recognizing = false;
  instructions.text('You were quiet for a while so voice recognition turned itself off.');
}

recognition.onerror = function(event) {
  recognizing = false;
  if(event.error == 'no-speech') {
    instructions.text('No speech was detected. Try again.');  
  };
}

//default recording
 recognition.start();
 $('#fname').focus();
 statuscount='1';
 focuselement= $('#fname');
function startrecorder(){
   recognition.stop();
   recognizing=false;
  if(!recognizing){
     recognition.start();
    }
}