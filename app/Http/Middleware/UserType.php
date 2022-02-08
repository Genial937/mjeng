<?php

namespace App\Http\Middleware;

use Closure;

class UserType
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
        if(auth()->check()):
            //check user user type
            $user=auth()->user();
            if($user->user_type=="ADMIN"):
                return redirect(route('admin.dashboard'));
            elseif($user->user_type=="BUSINESS"):
                return redirect(route('vendor.dashboard'));
            elseif($user->user_type=="CONTRACTOR"):
                return redirect(route('contractor.dashboard'));
            else:
                //unknown user
                return redirect(route('web.error',"USER_404"));
            endif;
        endif;
        return redirect(route('web.error',"USER_404"));
       // return $next($request);
    }
}
