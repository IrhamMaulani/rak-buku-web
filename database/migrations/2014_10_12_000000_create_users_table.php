<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('is_author')->default(0);
            $table->string('reputation')->default('neutral');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /*
     * Reputation : every day using cron will update reputation use cron job
     * Wizard ->have > 1000 reviews with atleast more than half helful
     * Crafter (for user active also write many good books) >= 100 helpful reviews and write atleast 3 books 
     * Fire Keeper -> have >= 200 reviews with atleast more than half helful
     * BookWorm ->  have >= 30 reviews with atleast more than half helful
     * Neutral ->  0 <= reviews < 30
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
