<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\LapKondisiJalanController;
use App\Http\Controllers\LapKondisiJembatanController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ActivateController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [LoginController::class, 'login']);
Route::post('/guest_login', [LoginController::class, 'guest_login']);

Route::get('/lap_jalans', [GuestController::class, 'index_jalan']);
Route::get('/lap_jembatans', [GuestController::class, 'index_jembatan']);
Route::get('/nama_desas', [GuestController::class, 'index_desa']);

Route::apiResource('registers', RegisterController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('kabupatens', KabupatenController::class);
    Route::apiResource('kecamatans', KecamatanController::class);
    Route::apiResource('desas', DesaController::class);
    Route::apiResource('lap_kondisi_jalans', LapKondisiJalanController::class);
    Route::apiResource('lap_kondisi_jembatans', LapKondisiJembatanController::class);
    Route::apiResource('sumber_danas', SumberDanaController::class);
    Route::apiResource('laporan_kegiatans', LaporanKegiatanController::class);
    Route::apiResource('karyawans', KaryawanController::class);
    Route::apiResource('pengaduans', PengaduanController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('ratings', RatingController::class);
    
    Route::get('kecamatans/by-kabupaten/{kabupaten}', [KecamatanController::class, 'getByKabupaten']);
    Route::get('desas/by-kecamatan/{kecamatan}', [DesaController::class, 'getByKecamatan']);

    // users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::get('/user', [UserController::class, 'authenticatedUser']);

    Route::get('/activate', [ActivateController::class, 'index']);
    Route::put('/activate/1', [ActivateController::class, 'toggleActivation']);
    
    Route::post('/logout', [LoginController::class, 'logout']);
});
    