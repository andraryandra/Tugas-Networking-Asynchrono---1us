<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogApiController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('blog', BlogApiController::class);
// Route::resource('auth/register', [Auth\AuthController::class, 'register']);
Route::post('auth/register', [Auth\AuthController::class, 'register']);
Route::post('auth/login', [Auth\AuthController::class, 'login']);

// Route::group(['middleware' => ['auth:sanctum']], function(){
//     Route::get('auth/me', [Auth\AuthController::class, 'me']);
//     Route::post('auth/logout', [Auth\AuthController::class, 'logout']);
// });
