<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_social_media', function (Blueprint $table) {
              $table->unsignedInteger('author_id');

            $table->unsignedInteger('social_media_id');

            $table->string('url');

            $table->foreign('author_id')->references('id')->on('authors')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('social_media_id')->references('id')->on('social_medias')
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
        Schema::dropIfExists('author_social_media');
    }
}
