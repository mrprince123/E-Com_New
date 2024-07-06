<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure( \Illuminate\Http\Request ): ( \Symfony\Component\HttpFoundation\Response )  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // echo 'Middleware is working';
        // echo $request->age;
        // echo $request->cookie( 'name' );
        // echo $request->session( 'any' );
        // if ( $request->age > 18 ) {
        //     echo 'You can go with the application';
        //     die;
        // }
        return $next($request);
    }
}
