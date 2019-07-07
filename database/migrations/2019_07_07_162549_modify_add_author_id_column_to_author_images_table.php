<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAddAuthorIdColumnToAuthorImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('author_images', function (Blueprint $table) {
            $table->unsignedInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors')
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
        Schema::table('author_images', function (Blueprint $table) {
            //
        });
    }
}
