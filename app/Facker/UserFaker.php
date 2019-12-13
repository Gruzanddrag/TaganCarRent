<?php


namespace App\Facker;


use App\Model\User;
use Hash;

class UserFaker
{
    public function fake() {

        $user = new User();
        $user['email'] = 'bulahov26@gmail.com';
        $user['password'] = Hash::make('admin');
        $user['name'] = 'Nikita';
        $user['surname'] = 'Bulakhov';
        $user['tripCount'] = 13;
        $user['rating'] = 5;
        $user['appToDrive'] = true;
        $user['phone'] = '+79964168136';
        $user['age'] = 19;
        $user->save();

        $user = new User();
        $user['email'] = 'ruslan112@gmail.com';
        $user['password'] = Hash::make('admin');
        $user['name'] = 'Ruslan';
        $user['surname'] = 'Agushev';
        $user['tripCount'] = 220;
        $user['rating'] = 4.5;
        $user['appToDrive'] = true;
        $user['phone'] = '+79234128656';
        $user['age'] = 20;
        $user->save();
    }
}