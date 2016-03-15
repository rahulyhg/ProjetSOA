<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Utils\Jwt;
use App\Utils\Jsender;
use View;

class AuthController extends Controller
{
    /**
    * Generate a JWT token inside a JSON object
    * {
    *
    *   token: "the token here"
    *  }
    *
    * @param  \Illuminate\Http\Request $request
    * @return JSon
    */
    public function getToken(Request $request)
    {
      $email = $request->input('email','');
      $password = $request->input('password','');
      $user = DB::table('users')->where('email', $email)->first();

      if(!$user){
        return response(Jsender::error("username or password not found"),200,['Content-Type' => 'application/json']);
      }

      if (Hash::check($password, $user->password)){
        $token = Jwt::generate([
          "email" => $email,
        ]);
        return response(Jsender::success(["token"=>"$token"]),200,['Content-Type' => 'application/json']);
      }else{
        return response(Jsender::error("username or password not found"),400,['Content-Type' => 'application/json']);
      }
    }
    /**
    * Validate the input token
    * {
    *
    *   email: "the email of the user who validate the token"
    *  }
    *
    * @param  \Illuminate\Http\Request $request
    * @return JSon
    */
    public function validateToken(Request $request){
      $token = $request->header('Authorization');
      if(!$token){
        $token = $request->input('token','');;
        if(!$token){
          return response(Jsender::error("No token"),400,['Content-Type' => 'application/json']);
        }
      }

      $payload = Jwt::validate($token);
      dd($token);
      if($payload){
        return response(Jsender::success(["token"=>"$token"]),200,['Content-Type' => 'application/json']);
      }

      return response(Jsender::error("You filthy hacker"),400,['Content-Type' => 'application/json']);

    }


    public function getUi(){
      return $this->jsonView('auth/ui');
    }
}
