<?php

namespace App\Http\Controllers\Car;

use App\Model\Car;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CarCollection;
use App\Model\State;

class CarController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $mades = DB::table('cars')->select('made')->distinct()->get();
        foreach ($mades as $made) {
            $made->models = DB::table('cars')->select('model')->where('made', $made->made)->distinct()->get();
        }
        return CarCollection::collection(Car::all())->additional([
            'status' => true,
            'meta' => [
                'mades' => $mades,
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
            \Log::debug($data->has('model'));
//            $data->model = strtoupper($data->model);
//            $data->made = strtoupper($data->made);
            $car->fill($data);
            $car->hostedBy = auth()->user()->id;
            \Log::debug($car);
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
    public function store(Request $request)
    {
        //
    }

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
            'data' => $car
        ]);
    }


    public function users_car() {
        $mades = DB::table('cars')->select('made')->distinct()->get();
        foreach ($mades as $made) {
            $made->models = DB::table('cars')->select('model')->where('made', $made->made)->distinct()->get();
        }
        return CarCollection::collection(Car::where('hostedBy', auth()->user()->id))->additional([
            'status' => true,
            'meta' => [
                'mades' => $mades,
                'categories' => Category::all()
            ]
        ]);
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
//            $data->model = strtoupper($data->model);
//            $data->made = strtoupper($data->made);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
