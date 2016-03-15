<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Utils\Jwt;
use App\Utils\Jsender;
use DB;

class BookmarksController extends Controller
{
  public function getUi(Request $request){
    $token = $request->input('token','');
    $payload = Jwt::payloadDecode($token);
    $user = DB::table('users')->where('email',$payload->email)->first();
    dd($user);
    return ('hola');
  }
}
