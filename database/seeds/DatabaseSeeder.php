<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Illuminate\Database\Eloquent\Model::unguard();

    //    $this->call('UserTableSeeder');
     //     $this->call('ListsTableSeeder');
    }
}
class UserTableSeeder extends Seeder
{

    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->delete();
        \App\User::create(array(
            'name'     => 'Sansa Stark',
            'username' => 'sansa',
            'email'    => 'sansa@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ));
    }

}
class ListsTableSeeder extends Seeder
{

    public function run()
    {
        \Illuminate\Support\Facades\DB::table('lists')->delete();
        \App\Lists::create(array(
            'name'     => 'Free Users',
            'description' =>'Customers using only the free version'
        ));
    }

}

