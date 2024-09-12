<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Api\PegawaiApiController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('login');
Route::middleware(['middleware'=>'auth'])->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/pegawai-api', [PegawaiController::class, 'index']);
    Route::post('/tambah-pegawai', [PegawaiController::class, 'store']);
    Route::put('/update-pegawai/{id}', [PegawaiController::class, 'update']);
    Route::delete('/delete-pegawai/{id}', [PegawaiController::class, 'delete']);
});

