const WindowsBalloon = require("node-notifier").WindowsBalloon;
const WebSocket = require("ws");
var open_url_by_browser = require("open-url-by-browser");


const ws = new WebSocket("ws://192.168.133.222:8080/", {
  perMessageDeflate: false
});

function showNotify(recive){

  var notifier = new WindowsBalloon({
    withFallback: false, // Try Windows Toast and Growl first?
    customPath: undefined // Relative/Absolute path if you want to use your fork of notifu
  });
  
  notifier.notify(
    {
      title: "Příchozí hovor",
      message: recive.name,
      sound: true,
      timeout: 30,
      wait: true
    },
    function(error, response, metadata) {
      //console.log(response, metadata);
    }
  );
  
  notifier.on("click", function(notifierObject, options, event) {
    open_url_by_browser("http://192.168.133.222/info.php?name="+recive.name);
  });

  

}


ws.on("message", function message(data) {
  //console.log("received: %s", data);
  var recive = JSON.parse(data);
  //console.log(recive);
  //console.log(recive.msg);
  showNotify(recive);
  delete notifier;

});

