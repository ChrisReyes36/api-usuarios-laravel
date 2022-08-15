<?php

use App\Http\Controllers\api\RolController;
use App\Http\Controllers\api\UsuarioCotroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(UsuarioCotroller::class)->group(function () {
    Route::get('/usuarios', 'index');
    Route::get('/usuarios/{id}', 'show');
    Route::post('/usuarios', 'store');
    Route::put('/usuarios/{id}', 'update');
    Route::delete('/usuarios/{id}', 'destroy');
});

Route::controller(RolController::class)->group(function () {
    Route::get('/roles', 'index');
});
