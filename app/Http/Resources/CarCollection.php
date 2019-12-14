<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class CarCollection extends JsonResource
{
    /**
     * @param $user_id
     * @param $car_id
     * @return \ArrayObject
     */
    static function show_img($user_id, $car_id)
    {
        $arr = [''];
        $dir = getcwd().'/public/photos/'.$user_id.'/'.$car_id;
        if (is_dir($dir)){
            $arr = [];
            $scanned_directory = array_diff(scandir($dir), array('..', '.'));
            foreach ($scanned_directory as $i) {
                array_push($arr, Storage::disk('public_uploads')->url("photos/" . $user_id . '/' . $car_id . '/' . $i));
            }
        }
        return $arr;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        \Log::debug(self::show_img(1,1));
        return [
            'id' => $this->id,
            'model' => $this->model,
            'made' => $this->made,
            'modelYear' => $this->modelYear,
            'price' => $this->price,
            'rating' => $this->rating,
            'tripCount' => $this->tripCount,
            'state' => $this->state['stateName'],
            'image' => $this->show_img($this->hostedBy, $this->id)[0],
            'category' => $this->category['categoryName'],
        ];
    }
}
