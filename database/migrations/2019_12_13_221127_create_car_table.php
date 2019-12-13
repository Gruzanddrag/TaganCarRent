<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Car;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CATEGORIES TABLE
        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedInteger('id')->unique();
            $table->string("categoryName");
            $table->primary('id');
        });
        // LITTLE HARDCORE (ZAUR DONT LOOK)
        DB::table('categories')->insert(
            [
                array(
                    'id' => 0,
                    'categoryName' => 'No data'
                ),
                array(
                    'id' => 1,
                    'categoryName' => 'Sport'
                ),
                array(
                    'id' => 2,
                    'categoryName' => 'Luxury'
                ),
                array(
                    'id' => 3,
                    'categoryName' => 'Classic'
                ),
                array(
                    'id' => 4,
                    'categoryName' => 'Cheap'
                )
            ]
        );

        // STATES TABLE
        Schema::create('states', function (Blueprint $table) {
            $table->unsignedInteger('id')->unique();
            $table->string("stateName");
            $table->primary('id');
        });
        // LITTLE HARD CORE (ZAUR DONT LOOK AGAIN)
        DB::table('states')->insert(
            [
                array(
                    'id' => 0,
                    'stateName' => 'enable'
                ),
                array(
                    'id' => 1,
                    'stateName' => 'disable'
                ),
                array(
                    'id' => 2,
                    'stateName' => 'processing'
                ),
                array(
                    'id' => 3,
                    'stateName' => 'blocked'
                )
            ]
        );


        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('made');
            $table->string('model');
            $table->string('location');
            $table->text('description');
            $table->year('modelYear');
            $table->integer('countOfPhotos');
            $table->double('rating');
            $table->unsignedInteger('stateId')->nullable();
            $table->bigInteger('tripCount')->default(0);
            $table->unsignedBigInteger('hostedBy');
            $table->unsignedInteger('categoryId')->nullable();
            $table->text('guidelines')->nullable();
            $table->text('parkingDetails')->nullable();
            $table->boolean('haveAutomaticTransmission')->default(false);
            $table->boolean('haveGPS')->default(false);
            $table->boolean('haveBluetooth')->default(false);
            $table->boolean('haveUSB')->default(false);
            $table->double('distanceIncluded');
            $table->double('additionPrice');
            $table->double('price');
            $table->integer('fuelType');
            $table->double('fuelPerKilometres');
            $table->integer('doorCount');
            $table->integer('seatCount');
            $table->timestamps();
        });
        /*
         * Foreign keys
         */
        Schema::table('cars', function($table) {
            $table->foreign('hostedBy')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('categoryId')
                ->references('id')->on('categories')
                ->onDelete('set null');
            $table->foreign('stateId')
                ->references('id')->on('states')
                ->onDelete('set null');
        });
        /*
         * Hardcore
         */
        $car = new Car();
        $car['model'] = 'Q7';
        $car['made'] = 'AUDI';
        $car['location'] = 'Moscow';
        $car['description'] = 'STOOPID CAR';
        $car['modelYear'] = 1989;
        $car['countOfPhotos'] = 0;
        $car['rating'] = 0.7;
        $car['stateId'] = 0;
        $car['hostedBy'] = 1;
        $car['categoryId'] = 2;
        $car['distanceIncluded'] = 120;
        $car['additionPrice'] = 11;
        $car['price'] = 152.2;
        $car['fuelType'] = 98;
        $car['fuelPerKilometres'] = 22;
        $car['doorCount'] = 5;
        $car['seatCount'] = 5;
        $car->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('states');
    }
}
