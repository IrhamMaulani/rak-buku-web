<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_like')->default(0);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('comment_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('comment_id')->references('id')->on('comments')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * 0 for neutral, 1 like, 2 for dislike
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_responses');
    }
}
