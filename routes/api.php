<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TelefonosController;
use App\Http\Controllers\Api\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::prefix('auth')->group(function () {
    //Prefijo V1, todo lo que este dentro de este grupo se accedera escribiendo v1 en el navegador, es decir /api/v1/*
    Route::post('authenticate', [\App\Http\Controllers\Api\AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('register');
  
    Route::get('telefonos/{id} ', [\App\Http\Controllers\Api\TelefonosController::class, 'show'])->name('show');
   
  
      Route::group(['middleware' => ['jwt.verify']], function() {
   //     Route::post('logout', [AuthController::class, 'logout']);
   Route::get('telefonos', [\App\Http\Controllers\Api\TelefonosController::class, 'index'])->name('index');
   
        Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout');
  
       
  /*       Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('telefonos', [TelefonosController::class, 'store']);
        Route::put('telefonos/{id}', [TelefonosController::class, 'update']);
        Route::delete('telefonos/{id}', [TelefonosController::class, 'destroy']); */
    });  
});