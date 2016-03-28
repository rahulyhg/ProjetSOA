<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



class PushToWS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push-to-ws';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $context = new \ZMQContext();
      $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
      $socket->connect("tcp://localhost:5555");

      $socket->send("hello");
    }
}
