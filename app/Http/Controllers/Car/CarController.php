<?php

namespace App\Http\Controllers\Car;

use App\Model\Car;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CarCollection;
use Illuminate\Support\Facades\Storage;
use App\Model\State;
use phpDocumentor\Reflection\Types\Array_;

class CarController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $q = request()->query('filter');
        \Log::debug($q);
        $mades = DB::table('cars')->select('made')->distinct()->get();
        foreach ($mades as $made) {
            $made->models = DB::table('cars')->select('model')->where('made', $made->made)->distinct()->get();
        }
        $cars = [];
        if($q){
            $cars = Car::query()->whereRaw(self::formateQuery($q))->get();
        } else {
            $cars = Car::all();
        }
        return CarCollection::collection($cars)->additional([
            'status' => true,
            'meta' => [
                'makes' => $mades,
                'categories' => Category::all()
            ]
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function create()
    {
        $status = false;
        try{
            $car = new Car();
            $data = request($car->getFillable());
            $car->fill($data);
            $car->hostedBy = auth()->user()->id;
            $car->saveOrFail();
            $status = true;
        }catch (\Exception $e) {
            \Log::error($e);
        }
        return response()->json([
            'status' => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $car = Car::find($id);
        $car['category'] = Car::find($id)->category['categoryName'];
        return response()->json([
            'status' => true,
            'owner' => Car::find($id)->owner,
            'data' => $car,
            'images' => CarCollection::show_img($car->hostedBy,$car->id)
        ]);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function user_cars() {
        $mades = DB::table('cars')->select('made')->distinct()->get();
        foreach ($mades as $made) {
            $made->models = DB::table('cars')->select('model')->where('made', $made->made)->distinct()->get();
        }
        return CarCollection::collection(Car::where('hostedBy', auth()->user()->id)->get())->additional([
            'status' => true
        ]);
    }

    /**
     * РОФЛИШЬ? МНЕ ТАК ПЛОХО ЧТО Я СДЕЛАЛ ОТДЕЛЬНЫЙ МЕТО ДЛЯ ЗАГРУЗКИ ФОТОК
     * @param Request $r
     * @param $user_id
     * @param $car_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function save_photo(Request $r, $user_id, $car_id){
        Storage::disk('public_uploads')->put('/photos/'.$user_id.'/'.$car_id, $r->file('photo'));
        return response()->json(['status' => 'true']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = false;
        try {

            $car = Car::where([
                ['hostedBy', '=', auth()->user()->id],
                ['id', '=', $id]
            ])->first();
            $data = request($car->getFillable());
            $car->fill($data);
            $car->saveOrFail();
            $status = true;
        } catch (\Exception $e) {
            \Log::error($e);
        }
        return response()->json([
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    static function formateQuery($string){
        $arr = explode(" ", $string);
        \Log::debug($string);
        $query = "";
        if(sizeof($arr)){
            foreach ($arr as $key => $rule){
                $query = $query . $rule;
                if($key != sizeof($arr) - 1){
                    $query = $query . " and ";
                }
            }
        } else {
            $query = $string;
        }
        return $query;
    }
}
