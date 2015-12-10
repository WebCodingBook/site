<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('activities_comments', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        });

        Schema::table('likes', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('notifications', function(Blueprint $table) {
            $table->foreign('user_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        });

        Schema::table('friends', function(BluePrint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('friends', function(BluePrint $table) {
            $table->dropForeign('friends_user_id_foreign');
            $table->dropForeign('friends_friend_id_foreign');
        });

        Schema::table('notifications', function(BluePrint $table) {
            $table->dropForeign('notifications_user_to_foreign');
            $table->dropForeign('notifications_user_from_foreign');
            $table->dropForeign('notifications_activity_id_foreign');
        });

        Schema::table('activities_comments', function(Blueprint $table) {
            $table->dropForeign('activities_comments_user_id_foreign');
            $table->dropForeign('activities_comments_activity_id_foreign');
        });

        Schema::table('activities', function(Blueprint $table) {
            $table->dropForeign('activities_user_id_foreign');
        });

        Schema::table('likes', function(Blueprint $table) {
            $table->dropForeign('likes_user_id_foreign');
        });
    }
}
