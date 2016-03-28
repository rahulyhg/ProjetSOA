$(document).on("click" , ".submitAuthForm", function () {
    $.get("{{action('AuthController@getToken')}}", $$("log_form").getValues())
    .done(function(data){
        localStorage.setItem("jwtToken",data.message[0].token);
        $(document).ajaxSend(function(event, jqxhr, settings){
             jqxhr.setRequestHeader("Authorization", data.message[0].token);
        });        
        $.get("{{ action("BookmarksController@getUi") }}")
        .done(function(ui) {
            console.log(ui);
            webix.ui(webix.DataDriver.json.toObject(ui), $$('log_form'))
        })
        .fail(function () {
          console.log("nope");
        });
    });

})
