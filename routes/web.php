<?php

use App\Http\Controllers\PhoneCreditApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/credits', [PhoneCreditApplicationController::class, 'store']);
Route::get('/credits/{id}', [PhoneCreditApplicationController::class, 'show']);
Route::get('credits/{id}/instalmnts', [PhoneCreditApplicationController::class, 'instalments']);

