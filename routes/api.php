<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AbsenController;
use App\Http\Controllers\Api\EmployeController;
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
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
// Route::middleware('auth:sanctum')->group( function () {
    Route::get('barcode', [EmployeController::class, 'barcode']);
    
// });
Route::middleware('auth:sanctum')->group( function () {
    Route::post('absen', [AbsenController::class, 'absen']);
    Route::post('lembur', [AbsenController::class, 'lembur']);
    Route::get('rekap_absensi', [AbsenController::class, 'rekap_absensi']);
    
});
