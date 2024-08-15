<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoverageRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coverage_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('nearest_landmark');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('no_of_users')->nullable();
            $table->string('request_type');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('core_area_id');
            $table->unsignedBigInteger('zone_area_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('core_area_id')->references('id')->on('core_areas');
            $table->foreign('zone_area_id')->references('id')->on('zone_areas');
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
        Schema::dropIfExists('coverage_requests');
    }
}
