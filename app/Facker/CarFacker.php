<?php


namespace App\Facker;


use App\Model\Car;

class CarFacker
{
    public function fake() {

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

        $car = new Car();
        $car['model'] = 'M3';
        $car['made'] = 'BMW';
        $car['location'] = 'Moscow';
        $car['description'] = 'Cool CAR';
        $car['modelYear'] = 2010;
        $car['countOfPhotos'] = 0;
        $car['rating'] = 4.7;
        $car['stateId'] = 0;
        $car['hostedBy'] = 2;
        $car['categoryId'] = 1;
        $car['distanceIncluded'] = 100;
        $car['additionPrice'] = 100;
        $car['price'] = 300;
        $car['fuelType'] = 98;
        $car['fuelPerKilometres'] = 15;
        $car['doorCount'] = 5;
        $car['seatCount'] = 5;
        $car->save();

        $car = new Car();
        $car['model'] = 'VOLGA 24';
        $car['made'] = 'GAZ';
        $car['location'] = 'Moscow';
        $car['description'] = 'Rear and clasic car';
        $car['modelYear'] = 1977;
        $car['countOfPhotos'] = 0;
        $car['rating'] = 5;
        $car['stateId'] = 0;
        $car['hostedBy'] = 2;
        $car['categoryId'] = 3;
        $car['distanceIncluded'] = 400;
        $car['additionPrice'] = 12;
        $car['price'] = 50;
        $car['fuelType'] = 100;
        $car['fuelPerKilometres'] = 18;
        $car['doorCount'] = 5;
        $car['seatCount'] = 5;
        $car->save();
    }
}