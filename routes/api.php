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
    //Prefijo auth , todo lo que este dentro de este grupo se accedera escribiendo auth  en el navegador, es decir /api/auth/
    // ejemplo authenticate http://127.0.0.1:8000/api/auth/authenticate
    
    Route::post('authenticate', [\App\Http\Controllers\Api\AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('register');
  
      Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('telefonos', [\App\Http\Controllers\Api\TelefonosController::class, 'index'])->name('index');
        Route::get('telefonos/{id} ', [\App\Http\Controllers\Api\TelefonosController::class, 'show'])->name('show');
        Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout');
        Route::post('telefonos', [\App\Http\Controllers\Api\TelefonosController::class, 'store'])->name('store');
        Route::put('telefonos/{id}', [\App\Http\Controllers\Api\TelefonosController::class, 'update'])->name('update');
        Route::delete('telefonos/{id}', [\App\Http\Controllers\Api\TelefonosController::class, 'destroy'])->name('destroy');
    });  
});