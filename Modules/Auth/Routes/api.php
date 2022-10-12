<?php

use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);