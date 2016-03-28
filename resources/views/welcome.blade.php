<!DOCTYPE HTML>
<html>
<head>
    @include('layouts.head')
</head>
    <body>
        <script type="text/javascript" charset="utf-8">
        @include("auth.logic");
        @include("bookmarks.logic");
        @include("tasklist.logic");

        webix.proxy.bookmarkRest = {
        	$proxy:true,
        	load:function(view, callback){
        		//webix.ajax(this.source, callback, view);
        	},
        	save:function(view, update, dp, callback){
            //console.log$$("bookmark").serialize());
            console.log(this);
            $.post(this.source, {bookmark: JSON.stringify($$("bookmark").serialize())});

        	},
        	saveAll:function(view, update, dp, callback){
            console.log("save all");

        	},
        	result:function(state, view, dp, text, data, loader){

        	}
        };

          var token = localStorage.getItem("jwtToken");

          webix.ui({"id" : "main"});

          console.log(token);
          if(!token){
              webix.ui(@include("auth.ui"), $$('main'));

          } else{
              $(document).ajaxSend(function(event, jqxhr, settings){
                  jqxhr.setRequestHeader("Authorization", token);
              });
              webix.ui({
                "cols":[
                  {"id":"left"},
                  {"id":"right"}
                ]
              },$$('main'))
              $.get("{{ action('BookmarksController@getUi') }}", function(ui){
                  webix.ui(webix.DataDriver.json.toObject(ui), $$('left'))
              });
              $.get("{{ action('TasklistController@getUi') }}", function(ui){
                  webix.ui(webix.DataDriver.json.toObject(ui), $$('right'))
              });
          }
        </script>
    </body>
</html>
