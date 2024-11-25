<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Inscription
Route::post('/register', [RegisteredUserController::class, 'store']); 

// Connexion
Route::post('/login', [AuthenticatedSessionController::class, 'store']); 

// auth
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'role:gestionnaire'])->get('/gestionnaire', function () {
    return response()->json(['message' => 'Accès réservé au gestionnaire.']);
});

//admin
Route::middleware(['auth:sanctum', 'role:admin'])->get('/admin', function () {
    return response()->json(['message' => 'Accès réservé à l\'administrateur.']);
});
