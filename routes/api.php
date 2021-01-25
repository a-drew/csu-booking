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


    $validation = $request->validate([
        'capacity_standing' => ['nullable', 'string', 'max:255'],
        'capacity_sitting' => ['nullable', 'string', 'max:255'],
        'food' => ['boolean'],
        'alcohol' => ['boolean'],
        'a_v_permitted' => ['boolean'],
        'projector' => ['boolean'],
        'television' => ['boolean'],
        'computer' => ['boolean'],
        'whiteboard' => ['boolean'],
        'sofas' => ['nullable', 'string', 'max:255'],
        'coffee_tables' => ['nullable', 'string', 'max:255'],
        'tables' => ['nullable', 'string', 'max:255'],
        'chairs' => ['nullable', 'string', 'max:255'],
        'ambiant_music' => ['boolean'],
        'sale_for_profit' => ['boolean'],
        'fundraiser' => ['boolean'],
    ]);

    $query = Room::query();
    foreach ($request->toArray() as $key => $value){
        if(is_bool($value)){
            $query->where('attributes->'.$key, $value);
        }else{
            $query->where('attributes->'.$key, '>=', (int)$value);
        }

    }
    return response()->json($query->get());

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
