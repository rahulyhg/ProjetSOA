<?php

namespace App\Http\Middleware;

use Closure;

use App\Utils\Jwt;
use App\Utils\Jsender;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $token = $request->header('Authorization');
      if(!$token){
        $token = $request->input('token','');;
        if(!$token){
          return response(Jsender::error("No token"),400,['Content-Type' => 'application/json']);
        }
      }
      if(!Jwt::validate($token)){
        return response(Jsender::error("Invalid token"),400,['Content-Type' => 'application/json']);
      }
      return $next($request);
    }
}
