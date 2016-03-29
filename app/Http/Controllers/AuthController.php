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
        // Récupération des informations de l'utilisateur
      $email = $request->input('email','');
      $password = $request->input('password','');
        // On le recherche dans la base de données
      $user = DB::table('users')->where('email', $email)->first();
        // On vérifie qu'il existe
      if(!$user){
        return response(Jsender::error("username or password not found"),200,['Content-Type' => 'application/json']);
      }
        // On vérifie que son password est le même que celui sauvegardé dans la BD
      if (Hash::check($password, $user->password)){
        $token = Jwt::generate([
          "email" => $email,
            "exp" => time()+(30*60),

        ]);
          // Succès avec le token
        return response(Jsender::success(["token"=>"$token"]),200,['Content-Type' => 'application/json']);
      }else{
          // Echec
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
        // Récupération du token dans le header
      $token = $request->header('Authorization');
        // On vérifie si le token existe dans Authorization
      if(!$token){
          // Ou si il a été envoyé dans la request
        $token = $request->input('token','');;
        if(!$token){
          return response(Jsender::error("No token"),400,['Content-Type' => 'application/json']);
        }
      }
        // On valide le token
      $payload = Jwt::validate($token);

      if($payload){
          // Succès
        return response(Jsender::success(["token"=>"$token"]),200,['Content-Type' => 'application/json']);
      }
        // Echec
      return response(Jsender::error("You filthy hacker"),400,['Content-Type' => 'application/json']);

    }


    public function getUi(){
      return $this->jsonView('auth/ui');
    }
}