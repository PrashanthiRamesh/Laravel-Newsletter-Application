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

       $this->call('UserTableSeeder');
     //     $this->call('ListsTableSeeder');
       // $this->call('SubscribtionsTableSeeder');
      //  $this->call('SubscribersTableSeeder');
      //  $this->call('NewslettersTableSeeder');
      //  $this->call('SendersTableSeeder');
    }
}
class UserTableSeeder extends Seeder
{

    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->delete();
        \App\User::create(array(
            'name'     => 'Prashanthi Ramesh',
            'username' => 'prash4',
            'email'    => 'rvprashanthi@gmail.com',
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
        \App\Lists::create(array(
            'name'     => 'Full Version Users',
            'description' =>'Customers using the full version'
        ));
    }

}

class SubscribtionsTableSeeder extends Seeder
{

    public function run()
    {
        \Illuminate\Support\Facades\DB::table('subscribtions')->delete();
        \App\Subscribtions::create(array(
            'subscribers_id'=>'1',
            'list_id'=>'4'
        ));
    }

}

class SubscribersTableSeeder extends Seeder
{

    public function run()
    {
       // \Illuminate\Support\Facades\DB::table('subscribers')->delete();
        \App\Subscribers::create(array(
            'email'=>'tyrion@gmail.com',
            'name'=>'Tyrion'
        ));
    }

}

class NewslettersTableSeeder extends Seeder
{

    public function run()
    {
        // \Illuminate\Support\Facades\DB::table('subscribers')->delete();
        \App\Newsletters::create(array(
            'subject'=>'Promotional mail',
            'body'=>'Blah',
            'template_id' => '1'
        ));
    }

}

class SendersTableSeeder extends Seeder
{

    public function run()
    {
         \App\Senders::create(array(
            'name'=>'Prashanthi',
             'email'=>'prashanthi@flycart.org',
             'designation'=>'Intern'
        ));
    }

}

