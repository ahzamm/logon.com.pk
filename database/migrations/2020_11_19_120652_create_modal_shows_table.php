<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modal_shows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('modal_content_id');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->timestamps();
            $table->foreign('modal_content_id')->references('id')->on('modal_contents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modal_shows');
    }
}
