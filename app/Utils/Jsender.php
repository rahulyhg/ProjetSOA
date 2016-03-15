<?php

namespace App\Utils;
/*
  https://labs.omniti.com/labs/jsend
*/


class Jsender
{
  public static function success($message){
    return json_encode([
      "status" =>"succes",
      "message" => [$message]]);
    }
    public static function error($message){
      return json_encode([
        "status" =>"error",
        "message" => $message]);
      }
}
