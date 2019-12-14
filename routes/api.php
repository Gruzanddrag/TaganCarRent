<?php
    use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * Routes for open data
 */
Route::get('/car',"Car\CarController@index");
Route::get('/lol',"Car\CarController@lol");
Route::get('/car/{id}',"Car\CarController@show");

/*
 * Routes for secret data
 */
Route::group([
    'middleware' => 'jwt'
], function () {
    Route::post('/car',"Car\CarController@create");
    Route::post('/car/{id}',"Car\CarController@edit");
    Route::get('/user/car',"Car\CarController@user_cars");
});
/*
 * Routes for auth
 */
Route::group([
    'prefix' => 'auth'
], function() {
    Route::post('/login',"Auth\AuthController@login");
    Route::post('/registration',"Auth\AuthController@registration");
});
