<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class Guest
{
    /**
     * Handle an incoming request.
     * This is an after middleware
     * As the action happens the request it's passed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::guest()){

            return redirect('home');
        }
        $request->session()->flash('status', 'failure');
        return $next($request);
    }
}
