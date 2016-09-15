<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailQueueDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_queue_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->string('content');
            $table->string('to_name');
            $table->string('to_email');
            $table->string('from_name');
            $table->string('from_email');
            $table->string('from_designation');
            $table->string('subject');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
