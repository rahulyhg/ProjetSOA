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
    // On vérifie que le token soit correct
    $payload = Jwt::validate($request->header('Authorization'));
    // On récupère les bookmarks de l'utilisateur loggé
    $user = DB::table('users')->where('email',$payload->email)->first();
    $bookmarks = $user->bookmarks;
    // On les renvoie à notre vue pour qu'il soit exploité
    return $this->jsonView('bookmarks.ui',["bookmarks"=>$bookmarks]);
  }
  public function test(Request $request){
    // On vérifie le token
    $payload = Jwt::validate($request->header('Authorization'));
    // On récupère le user
    $user = User::where('email',$payload->email)->first();
    $bookmark = $request->bookmark;
    // On lui attache le nouveau bookmark
    $user->bookmarks = $bookmark;
    // Et on le sauve dans la base de données
    $user->save();
    // On notifie l'utilisateur que tout c'est passé comme voulu
    return response(Jsender::success(["user"=>"$user"]),200,['Content-Type' => 'application/json']);



  }
}
