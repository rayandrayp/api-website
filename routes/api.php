<?php

use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\BeritaController;
use App\Http\Controllers\API\DokterController;
use App\Http\Controllers\API\JajaranDireksiController;
use App\Http\Controllers\API\PagesController;
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

Route::group(['prefix' => 'profil'], function () {
    Route::apiResource('pages', PagesController::class);
    Route::apiResource('jajarandireksi', JajaranDireksiController::class);
});

Route::apiResource('berita', BeritaController::class);
Route::apiResource('artikel', ArtikelController::class);
Route::apiResource('dokter', DokterController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
