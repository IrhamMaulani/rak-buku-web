<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tag', function (Blueprint $table) {

            $table->unsignedInteger('book_id');

            $table->unsignedInteger('tag_id');

            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_tag');
    }
}
