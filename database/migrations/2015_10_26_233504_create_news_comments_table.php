<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('news_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('published')->defaul(false);
            //$table->softDeletes();
            $table->timestamps();

            $table->index('news_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news_comments');
    }
}
