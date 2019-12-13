<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\User;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string("photo")->nullable();
            $table->bigInteger('tripCount')->default(0);
            $table->double('rating')->default(0);
            $table->boolean('appToDrive')->default(false);
//            $table->timestamps();
        });
        /*
         * Hardcore user
         */
        $fake = new App\Facker\UserFaker;
        $fake->fake();
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
