<?php

namespace App\Http\Middleware;

use Closure;
use App\Content;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
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
        if (! Auth::guard('clients')->check())
            return redirect()->route('index');

        return $next($request);
    }
}
