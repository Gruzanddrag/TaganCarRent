<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'made' => $this->made,
            'modelYear' => $this->modelYear,
            'price' => $this->price,
            'rating' => $this->rating,
            'tripCount' => $this->tripCount,
            'state' => $this->state['stateName'],
            'category' => $this->category['categoryName'],
        ];
    }
}
