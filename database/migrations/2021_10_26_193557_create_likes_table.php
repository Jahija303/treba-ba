<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('issue_id')->unsigned()->nullable();
            $table->bigInteger('issue_comment_id')->unsigned()->nullable();
            $table->bigInteger('comment_reply_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('issue_comment_id')->references('id')->on('issue_comments');
            $table->foreign('comment_reply_id')->references('id')->on('comment_replies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_likes');
    }
}
