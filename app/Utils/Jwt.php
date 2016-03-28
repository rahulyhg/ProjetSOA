<?php

namespace App\Utils;

class Jwt
{

  public static function generate($payload){
    $header = Base64::encode(json_encode([
      "alg" => "HS256",
      "type" => "JWT"
    ]));
    $payload = Base64::encode(json_encode($payload));
    $signature = Base64::encode(hash_hmac("sha256","{$header}.{$payload}", config('app.key'),true));
    return "{$header}.{$payload}.{$signature}";

  }

  public static function validate($token){
    $tokenExploded = explode(".",$token);
    if(count($tokenExploded)!=3){
            return false;
        }
    $header = $tokenExploded[0];
    $payload = $tokenExploded[1];
    $signatureToCheck = $tokenExploded[2];

    $payloadDecoded = json_decode(Base64::decode($payload));

    $signature = Base64::encode(hash_hmac("sha256","{$header}.{$payload}", config('app.key'),true));
    if($signatureToCheck == $signature){
      return $payloadDecoded;
    }else{
      return false;
    }

  }

  public static function payloadDecode($token){
    $tokenExploded = explode(".",$token);
    if(count($tokenExploded)!=3){
            return false;
        }
    $header = $tokenExploded[0];
    $payload = $tokenExploded[1];
    $signatureToCheck = $tokenExploded[2];

     return json_decode(base64_decode($payload));

  }

}
