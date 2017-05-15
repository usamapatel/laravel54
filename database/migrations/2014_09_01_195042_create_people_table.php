<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 60)->nullable();
            $table->string('last_name', 60)->nullable();
            $table->string('display_name', 50)->nullable();
            $table->jsonb('address')->nullable();
            $table->timestamp('dob')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('gender', ['m', 'f', 'n'])->default('n'); // m: male, f: female, n: not specified
            $table->string('primary_email', 100)->nullable();
            $table->string('secondary_email', 100)->nullable();
            $table->string('home_phone', 50)->nullable();
            $table->string('work_phone', 50)->nullable();
            $table->string('mobile_number', 30)->nullable();
            $table->text('v_card')->nullable();
            $table->jsonb('extra_info')->nullable();
            $table->jsonb('settings')->nullable();
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
        Schema::dropIfExists('people');
    }
}
