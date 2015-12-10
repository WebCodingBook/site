<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_to')->unsigned();
            $table->integer('user_from')->unsigned()->nullable();
            $table->integer('activity_id')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->timestamps();

            $table->index('user_to');
            $table->index('user_from');
            $table->index('activity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}
