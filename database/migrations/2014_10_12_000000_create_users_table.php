<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 60)->unique();
            $table->string('firstname', 60)->nullable();
            $table->string('lastname', 60)->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('country', 60)->nullable();
            $table->string('department', 60)->nullable();
            $table->string('city', 60)->nullable();
            $table->string('birthday', 20)->nullable();
            $table->string('job', 60)->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('status', 60)->nullable();
            $table->string('avatar', 60)->nullable();
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
