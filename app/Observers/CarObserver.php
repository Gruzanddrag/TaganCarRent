<?php

namespace App\Observers;

use App\Car;

class CarObserver
{

    /**
     * @param Car $car
     * @return mixed
     */
    public function saving(Car $car)
    {
        \Log::debug('SAVED');
        return $this->save($car);
    }
    /**
     * Handle the car "created" event.
     *
     * @param  \App\Car  $car
     * @return void
     */
    public function created(Car $car)
    {
        //
    }

    /**
     * Handle the car "updated" event.
     *
     * @param  \App\Car  $car
     * @return void
     */
    public function updating(Car $car)
    {
        \Log::debug('EDITING');
    }

    /**
     * @param Car $car
     */
    public function updated(Car $car)
    {
        \Log::debug('EDIT!');
    }

    /**
     * Handle the car "deleted" event.
     *
     * @param  \App\Car  $car
     * @return void
     */
    public function deleted(Car $car)
    {
        //
    }

    /**
     * Handle the car "restored" event.
     *
     * @param  \App\Car  $car
     * @return void
     */
    public function restoring(Car $car)
    {
        //
    }

    /**
     * @param Car $car
     */
    public function restored(Car $car)
    {
        //
    }

    /**
     * Handle the car "force deleted" event.
     *
     * @param  \App\Car  $car
     * @return void
     */
    public function forceDeleted(Car $car)
    {
        //
    }
}
