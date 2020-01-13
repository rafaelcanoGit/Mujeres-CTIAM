<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $is_admin)
    {
        if (!$request->user()->hasRole($is_admin)) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
