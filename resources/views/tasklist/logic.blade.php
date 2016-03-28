$("body").on("click",".button_add",function(){
  console.log("click");
  $$('tasklist').add({
    task:"your task",
    status:"your status",
    note:"your note"
});
})

function createWebSocket () {
    webSocket = new WebSocket("ws://localhost:8080");
    webSocket.onopen = function(e) {
        console.log("connected");
    };
    webSocket.onclose = function(e) {
        console.log("disconnected");
    };
    webSocket.onmessage = function(response) {
  var data = response.data
  console.log(data);
    var json = JSON.parse(response.data);
  console.log(json);


   $$("tasklist").clearAll();
   $$("tasklist").load("rest->tasklist/getUi");

    };
    webSocket.sendJson = function (data) {
        this.send(sending);
    }
}

createWebSocket();
