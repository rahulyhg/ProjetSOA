<?php

Route::get("/", function (){
  return view('welcome');
});

Route::get("auth/getToken", "AuthController@getToken");
Route::get("auth/validateToken", "AuthController@validateToken");
Route::get("auth/getUi", "AuthController@getUi");

Route::group(['middleware' => 'token'], function(){
  Route::get("bookmarks/getUi", "BookmarksController@getUi");

});
