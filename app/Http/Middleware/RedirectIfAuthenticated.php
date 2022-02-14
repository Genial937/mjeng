<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user=auth()->user();
            if($user->user_type=="ADMIN")
                return redirect(route('admin.dashboard'));
            if($user->user_type=="BUSINESS")
                return redirect(route('vendor.dashboard'));
            if($user->user_type=="CONTRACTOR")
                return redirect(route('contractor.dashboard'));
        }

        return $next($request);
    }
}
