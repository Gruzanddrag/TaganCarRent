<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'model',
        'made',
        'location',
        'description',
        'modelYear',
        'countOfPhotos',
        'stateId',
        'tripCount',
        'categoryId',
        'guidelines',
        'parkingDetails',
        'haveAutomaticTransmission',
        'haveGPS',
        'haveBluetooth',
        'haveUSB',
        'distanceIncluded',
        'additionPrice',
        'price',
        'fuelType',
        'fuelPerKilometres',
        'doorCount',
        'seatCount',

    ];

    /**
     * CAR STATE
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\Model\State', 'stateId');
    }

    /**
     * CAR CATEGORY
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'categoryId');
    }

    /**
     * CAR OWNER
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Model\User', 'hostedBy');
    }


//    protected $hidden = ['password'];
}
