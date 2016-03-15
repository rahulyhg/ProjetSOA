submitAuthForm = function () {
  $.get("{{ action('AuthController@getToken') }}",
    $$("log_form").getValues(),
      function(data){
        console.log(data);
        localStorage.setItem("jwtToken",data.message[0].token);
  });
}
