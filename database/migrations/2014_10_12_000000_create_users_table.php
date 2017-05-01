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
            $table->increments('id');
            $table->integer('person_id')->unsigned()->unique()->index();
            $table->foreign('person_id')->references('id')->on('people');
            $table->string('username')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('password', 60);

            $table->string('verification_token');
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();

            $table->boolean('is_online')->default(false);
            $table->timestamp('last_login_time')->nullable();

            $table->boolean('is_active')->default(false);
            $table->timestamp('last_active_time')->nullable();

            $table->boolean('is_banned')->default(false);
            $table->timestamp('banned_at')->nullable();
            $table->integer('banned_by')->unsigned()->nullable();
            $table->foreign('banned_by')->references('id')->on('users');

            $table->string('timezone', 120)->nullable();
            $table->jsonb('settings')->nullable();

            $table->rememberToken();
            $table->softDeletes();
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
