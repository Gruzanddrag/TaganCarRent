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
            'price' => $this->price,
            'location' => $this->location,
            'state' => $this->state['stateName'],
            'category' => $this->category['categoryName'],
            'ownerName' => $this->owner['name'],
            'ownerSurname' => $this->owner['surname']
        ];
    }
}
