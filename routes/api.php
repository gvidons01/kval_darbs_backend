<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Ad;
use App\Http\Controllers\AdController;
use App\Http\Resources\AdResource;

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

Route::get('/ad/{id}', function($id){
  return new AdResource(Ad::findOrFail($id));
});

Route::get('/ads', function(){
  return AdResource::collection(Ad::all());
});

Route::put('/ad/{id}', [AdController::class, 'update']);

Route::delete('/ad/{id}', [AdController::class, 'destroy']);

Route::post('/ads', [AdController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
