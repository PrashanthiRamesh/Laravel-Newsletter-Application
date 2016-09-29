<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

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
            return Redirect::to('/');
        }
        \Config::set('database.connections.mysql.host', env('DB_HOST'));
        \Config::set('database.connections.mysql.database', env('DB_DATABASE'));
        \Config::set('database.connections.mysql.username', env('DB_USERNAME'));
        \Config::set('database.connections.mysql.password', env('DB_PASSWORD'));
        \DB::reconnect();

        if(!\Schema::hasTable('migrations')) {
            Artisan::call('migrate:install');
            Artisan::call('migrate', [
                '--path' => "database/migrations/main"
            ]);

        }
        return $next($request);
    }
}
