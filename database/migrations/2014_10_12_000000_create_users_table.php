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
        $user = new User();
        $user['email'] = 'bulahov26@gmail.com';
        $user['password'] = Hash::make('admin');
        $user['name'] = 'Nikita';
        $user['surname'] = 'Bulakhov';
        $user['phone'] = '+79964168136';
        $user->save();
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
