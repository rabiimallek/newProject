<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAdmin
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
        if(auth()->user()->typeUser == 'user')
        {
            $response = [
                'status' => 2,
                'message' => 'admin',
            ];

            return response()->json($response, 413);
        }
        else
        {
            return $next($request);
        }
    }
}
