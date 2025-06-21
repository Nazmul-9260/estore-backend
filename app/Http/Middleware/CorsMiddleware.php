<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle($request, Closure $next)
    {
         return $next($request)
             ->header('Access-Control-Allow-Origin', '*') // Adjust as needed
            ->header('Access-Control-Allow-Methods', '*') // Adjust as needed
             ->header('Access-Control-Allow-Credentials', true) // Adjust as needed
             ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization') // Adjust as needed
            ->header('Accept', 'application/json');

            //$response = $next($request);

            //$response->headers->set('Access-Control-Allow-Origin', '*'); //make sure to replace with your frontend url
            //$response->headers->set('Access-Control-Allow-Origin', 'http://store.scldev.com:8083'); //make sure to replace with your frontend url
            //$response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
           // $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
            //$response->headers->set('Accept', 'application/json');

            //return $response;
    }

}
