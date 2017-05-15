<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
            $table->string('icon');
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('width');
            $table->boolean('status');
            $table->text('settings')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('menu_item_id')->unsigned();
            $table->foreign('menu_item_id')
                ->references('id')->on('menu_items')
                ->onDelete('cascade');
            $table->integer('widget_type_id')->unsigned();
            $table->foreign('widget_type_id')
                ->references('id')->on('widget_type')
                ->onDelete('cascade');
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
        Schema::drop('widgets');
    }
}
