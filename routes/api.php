<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PegawaiApiController;

Route::middleware('auth:sanctum')->get('/pegawai', [PegawaiApiController::class, 'index']);
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return response()->json(['token' => Auth::user()->createToken('Personal Access Token')->plainTextToken]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
});
