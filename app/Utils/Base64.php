<?php

namespace App\Utils;
/*
  http://php.net/manual/fr/function.base64-encode.php premier commentaire
*/


class Base64
{
  public static function encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
  }

  public static function decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
  }
}
