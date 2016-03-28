<?php

Route::get("/", function (){
  return view('welcome');
});

Route::get("/php", function(){
  phpinfo();
});
Route::get('tasklist/getUi', 'TasklistController@getUi');
Route::resource('tasklist', 'TasklistController');

Route::get('faker', 'FakerController@test');

Route::get("auth/getToken", "AuthController@getToken");
Route::get("auth/validateToken", "AuthController@validateToken");
Route::get("auth/getUi", "AuthController@getUi");
Route::get("bookmarks2/getUi", "BookmarksController@getUi");
Route::post("search", "SearchController@search");

Route::group(['middleware' => 'token'], function(){
  Route::get("bookmarks/getUi", "BookmarksController@getUi");
  Route::post("bookmarks/test", "BookmarksController@test");

});
