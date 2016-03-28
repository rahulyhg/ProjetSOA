<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Utils\Jwt;
use App\Utils\Jsender;
use DB;
use App\User;

class BookmarksController extends Controller
{
  public function getUi(Request $request){
    $payload = Jwt::validate($request->header('Authorization'));
    $user = DB::table('users')->where('email',$payload->email)->first();
    $bookmarks = $user->bookmarks;
    return $this->jsonView('bookmarks.ui',["bookmarks"=>$bookmarks]);
  }
  public function test(Request $request){

    $payload = Jwt::validate($request->header('Authorization'));
    $user = User::where('email',$payload->email)->first();
    $bookmark = $request->bookmark;
    $user->bookmarks = $bookmark;
    $user->save();

    return response(Jsender::success(["user"=>"$user"]),200,['Content-Type' => 'application/json']);



  }
}
