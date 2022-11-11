<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\group;
use App\Models\Ad;
use App\Http\Controllers\AdController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Resources\AdResource;
use App\Http\Resources\GroupResource;

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

//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Route::resource('ads', AdController::class);

Route::get('/ad/{id}', [AdController::class, 'show']);

Route::get('/ads', [AdController::class, 'index']);

Route::get('/ads/search/{description}', [AdController::class, 'search']);

Route::get('/groups', function(){
  return GroupResource::collection(group::all());
});

Route::get('/group/{id}', function($id){
  return new GroupResource(group::findOrFail($id));
});

//protected routes (only authenticated users!)
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/ads', [AdController::class, 'store']);
  Route::put('/ad/{id}', [AdController::class, 'update']);
  Route::delete('/ad/{id}', [AdController::class, 'destroy']);

  Route::post('/logout', [AuthController::class, 'logout']);
  //route to user's profile, update or delete user profile.
  //report routes
});
