<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KontakController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::get('/kontak', [KontakController::class, 'getKontak']);
Route::post('/create_kontak', [KontakController::class, 'create']);
Route::get('/search_kontak', [KontakController::class, 'search']);
Route::get('/edi_kontak/{id}', [KontakController::class, 'edit']);
Route::put('/update_kontak/{id}', [KontakController::class, 'update']);
Route::delete('/delete_kontak/{id}', [KontakController::class, 'destroy']);
