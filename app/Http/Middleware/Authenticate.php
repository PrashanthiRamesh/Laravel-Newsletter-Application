<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        Config::set('database.default', 'mysql');
        DB::reconnect();

        if (!Auth::check()) {
            return Redirect::to('register');
        }else{
            $user_id=Auth::user()->id;
            $user= User::where('id', $user_id)->first();
            Config::set('database.connections.mysql_tenant.database', $user->username);
            Config::set('database.default', 'mysql_tenant');
            DB::reconnect('mysql_tenant');
        }
        return $next($request);

    }
}

