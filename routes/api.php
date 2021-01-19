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
    return Room::where('floor', '>', 5)->get();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
