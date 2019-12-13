<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carId');
            $table->unsignedBigInteger('userId');
            $table->date('tripStart');
            $table->date('tripEnd');
            $table->string('locationName');
            $table->string('locationPostcode');
            $table->double('locationLat');
            $table->double('locationLng');
            $table->timestamps();
            $table->foreign('carId')
                ->references('id')->on('cars')
                ->onDelete('no action');
            $table->foreign('userId')
                ->references('id')->on('users')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
