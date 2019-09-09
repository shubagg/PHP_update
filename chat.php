<html>
<head>
<script>
  var recognition = new webkitSpeechRecognition();
  recognition.continuous = true;
  recognition.interimResults = true;
  function start(){
    recognition.onresult = function(event) { 
      console.log(event);
      var output = document.getElementById("output");
      output.innerHTML = "";
      for(var i=0; i<event.results.length; i++){
        output.innerHTML = output.innerHTML + event.results[i][0].transcript;
      }
    }
    recognition.start();
  }
</script>
</head>
<body>
  <h1>Speach to text</h1>
  <input id = "bStart" type = "button" value = "Start" onclick = "start();"></input>
  <div id = "output"></div>
</body>
</html>