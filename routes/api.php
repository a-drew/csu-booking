<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Room;
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
Route::post('/filterRooms', function (Request $request) {

    // None of the request fields are mandatory, only
    // filter the ones provided from request
    $validation = $request->validate([
        'capacity_standing' => 'numeric|min:0|not_in:0',
        'capacity_sitting' => 'numeric|min:0|not_in:0',
        'food' => ['boolean'],
        'alcohol' => ['boolean'],
        'a_v_permitted' => ['boolean'],
        'projector' => ['boolean'],
        'television' => ['boolean'],
        'computer' => ['boolean'],
        'whiteboard' => ['boolean'],
        'sofas' => 'numeric|min:0|not_in:0',
        'coffee_tables' => 'numeric|min:0|not_in:0',
        'tables' => 'numeric|min:0|not_in:0',
        'chairs' => 'numeric|min:0|not_in:0',
        'ambiant_music' => ['boolean'],
        'sale_for_profit' => ['boolean'],
        'fundraiser' => ['boolean'],
    ]);

    // If param value boolean, filter for boolean and if
    // numeric filter greater than integer in that column
    $query = Room::query();
    foreach ($request->toArray() as $key => $value){
        if(is_numeric($value)){
          $query->where('attributes->' . $key, '>=', $value);
        }else{
          if(is_bool($value)) {
            $query->where('attributes->' . $key, $value);
          }
        }

    }
    return response()->json($query->get());

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
