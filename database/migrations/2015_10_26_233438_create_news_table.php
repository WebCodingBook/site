<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 120)->unique();
            $table->string('slug', 120)->unique();
            $table->longText('content');
            $table->integer('user_id')->unsigned();
            $table->integer('cat_id')->unsigned();
            $table->boolean('published')->default(true);
            $table->boolean('allow_comments')->default(true);
            $table->timestamps();

            $table->index('user_id');
            $table->index('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
