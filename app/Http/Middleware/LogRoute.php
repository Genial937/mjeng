<?php

namespace App\Http\Middleware;

use App\SystemLogs;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogRoute
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
        $response = $next($request);

            $log = [
                "USER"=>auth()->user(),
                'URI' => $request->getUri(),
                'IP' => $request->ip(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $response->getContent()
            ];
           if($request->getMethod()=="GET"){
               SystemLogs::create([
                   "user_id"=> Auth::id()??NULL,
                   "url"=>$request->getUri(),
                   "ip"=> $request->ip(),
                   "agent"=>$request->header('user-agent')??"_SYSTEM_",
                   "method"=>$request->getMethod(),
                   "request_body"=>json_encode($request->all()),
                   'response' => "GET"
               ]);
           }else{
               SystemLogs::create([
                   "user_id"=> Auth::id()??NULL,
                   "url"=>$request->getUri(),
                   "ip"=> $request->ip(),
                   "method"=>$request->getMethod(),
                   "request_body"=>json_encode($request->all()),
                   'response' => $response->getContent()
               ]);
           }


        return $response;
    }
}
