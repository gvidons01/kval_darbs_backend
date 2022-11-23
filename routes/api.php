<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\group;
use App\Models\Ad;
use App\Models\category;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\UserController;

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

Route::get('/ad/{id}', [AdController::class, 'show']);

Route::get('/ads', [AdController::class, 'index']);

Route::get('/ads/search/{description}', [AdController::class, 'search']);

Route::get('/groups', [GroupController::class, 'index']);

Route::get('/group/{id}', [GroupController::class, 'show']);

//protected routes (only authenticated users!)
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/ads', [AdController::class, 'store']);
  Route::put('/ad/{id}', [AdController::class, 'update']);
  Route::delete('/ad/{id}', [AdController::class, 'destroy']);

  Route::post('/logout', [AuthController::class, 'logout']);
  //route to user's profile, update or delete user profile.
  Route::get('/user', [UserController::class, 'userInfo']);
  Route::delete('/user', [UserController::class, 'deleteUser']);
  Route::put('/user', [UserController::class, 'updateUser']);
  Route::put('/user/updatepw', [UserController::class, 'resetPassword']);
  //report routes

  //admin routes (only admin access, every function has an admin role check)
  Route::get('/admin/reports', [AdminController::class, 'viewReportedAds']);
  Route::get('/admin/report/{id}', [AdminController::class, 'viewAdReports']);
  Route::delete('/admin/report/{id}', [AdminController::class, 'deleteAdReports']);
  Route::get('/admin/reports', [AdminController::class, 'viewReportedAds']);
  Route::get('/admin/blocked', [AdminController::class, 'showBlockedUsers']);
  Route::put('/admin/block/{id}', [AdminController::class, 'changeUserAccess']);
});

