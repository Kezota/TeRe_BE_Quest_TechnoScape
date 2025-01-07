<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;

//Route::middleware([AuthMiddleware::class])->group(function () {
Route::post('/users/add', [UserController::class, 'createUser']);
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/users/{userId}', [UserController::class, 'getUser']);
Route::put('/users/update/active', [UserController::class, 'updateUserStatus']);
Route::get('/users/{limit}/{page}', [UserController::class, 'getUsersPaginated']);
//});
