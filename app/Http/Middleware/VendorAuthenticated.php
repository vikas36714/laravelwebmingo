<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class VendorAuthenticated
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
        if( Auth::check() )
        {
            // allow vendor to proceed with request
            if ( Auth::user()->isVendor() ) {
                 return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
