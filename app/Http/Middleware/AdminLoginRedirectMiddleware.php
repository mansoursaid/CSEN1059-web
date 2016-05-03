<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminLoginRedirectMiddleware
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

        // pass the request
        $response = $next($request);

        // the authenticated user
        $user = Auth::user();
        if ($user->type > 0)
        {
            return redirect()->action('UsersController@show', $user->id);
        }

        return $response;

    }
}
