<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MainDatabaseConfig
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

        if(Auth::check()){
            $user_id=Auth::user()->id;
            $user= User::where('id', $user_id)->first();
            Config::set('database.connections.mysql_tenant.database', $user->username);
            Config::set('database.default', 'mysql_tenant');
            DB::reconnect('mysql_tenant');
            return redirect()->route('sub', ['subdomain' => $user->username]);
        }
        \Config::set('database.connections.mysql.host', env('DB_HOST'));
        \Config::set('database.connections.mysql.database', env('DB_DATABASE'));
        \Config::set('database.connections.mysql.username', env('DB_USERNAME'));
        \Config::set('database.connections.mysql.password', env('DB_PASSWORD'));
        \DB::reconnect();


        return $next($request);
    }
}
