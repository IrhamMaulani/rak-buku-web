<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_book', function (Blueprint $table) {

            $table->unsignedInteger('author_id');
            $table->unsignedInteger('book_id');

            $table->foreign('author_id')->references('id')->on('authors')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('book_id')->references('id')->on('books')
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
        Schema::dropIfExists('author_book');
    }
}
