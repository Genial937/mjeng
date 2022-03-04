<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfVendor
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
            $user = auth()->user();
            if ($user->user_type == "BUSINESS"):
                //check if user has business
                if(!count(User::where('id',$user->id)->with('businesses')->first()->businesses)):
                  return redirect(route('vendor.create.business'));
                endif;
            endif;

        }

        return $next($request);
    }
}
