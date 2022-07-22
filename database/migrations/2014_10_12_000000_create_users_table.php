<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->integer('ads_click')->nullable();
            $table->integer('admob_ads_click')->nullable();
            $table->integer('fb_ads_click')->nullable();
            $table->boolean('is_block_user')->nullable();
            $table->integer('app_version')->nullable();
            $table->string('rating')->nullable();
            $table->text('review_message')->nullable();
            $table->time('click_time')->nullable();
            $table->text('fcm_token')->nullable();
            $table->text('user_token')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

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
