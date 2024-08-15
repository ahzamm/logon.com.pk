<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('menu_name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('page_id')->nullable();
            $table->boolean('status');
            $table->string('slug')->nullable();
            $table->string('icon');
            $table->smallInteger('order_menu');
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('front_menus');
    }
}
