<?php

namespace App\Utils;

class PushToWS
{

  public static function push($msg, $ip = "127.0.0.1", $port = "5555")
  {
    $context = new \ZMQContext();
    $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
    $socket->connect("tcp://".$ip.":".$port);
    $socket->send($msg);
  }
}
