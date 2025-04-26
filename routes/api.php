<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PhoneCreditApplicationController;
use Illuminate\Support\Facades\Route;



Route::post('/credits', [PhoneCreditApplicationController::class, 'store']);
Route::get('/credits/{id}', [PhoneCreditApplicationController::class, 'show']);
Route::get('credits/{id}/instalmnts', [PhoneCreditApplicationController::class, 'instalments']);
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/phones', [PhoneController::class, 'index']);

