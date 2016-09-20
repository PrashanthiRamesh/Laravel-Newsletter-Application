<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::check()){
            \Artisan::call('migrate:install');
            \Artisan::call('migrate', [
                '--path' => "database/migrations"
            ]);
            return Redirect::to('login');
        }else{

            return $next($request);
        }


    }
}

