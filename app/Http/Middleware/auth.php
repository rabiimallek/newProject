<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle(Request $request, Closure $next)
    {
      /* if ( $request->header('API_PASSWORD') != 'AZERTYUIOPPOIUYTREZA')
        {

            return  $response = [

                'message' => 'Unauthorized',
            ];
        }
        else
        {
            return $next($request);
        }*/

        if($request->header('API_PASSWORD') != 'AZERTYUIOPPOIUYTREZA')
        {
            $response = [
                'status' => 2,
                'message' => 'Unauthorized',
            ];

            return response()->json($response, 413);
        }
        else
        {
            return $next($request);
        }
    }
}
