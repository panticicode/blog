<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class Admin
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
        if(!Auth :: user()->admin):
            Session :: flash('warning', 'You don\'t have permissions to perform this action');
            return redirect()->back();
        else:
            return $next($request);
        endif;
    }
}
