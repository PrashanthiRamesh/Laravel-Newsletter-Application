<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Artisan;
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
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        if(!Auth::check()){
//            return Redirect::to('login');
//        }else{
//
//            return $next($request);
//        }

        $pieces = explode('.', $request->getHost());

        $user = User::where('username', '=', $pieces[0])->first();

        if ($user === null) {
            return Redirect::to('register');
        }else{

            Config::set('database.connections.mysql_tenant.database', $user->username);
            Config::set('database.default', 'mysql_tenant');
            DB::reconnect('mysql_tenant');


                Artisan::call('migrate', [
                    '--path' => "database/migrations/tenant"
                ]);

           dd('yay');
        }

        return $next($request);

    }
}

