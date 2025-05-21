<?php

namespace YassineAs\CasAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use YassineAs\CasAuth\Facades\CasAuth as Cas;

class CasAuth
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
        if (!Cas::isAuthenticated()) {
            return redirect()->route('login');
        }
         return $next($request);
    }
}
