<?php

use App\Http\Controllers\PhoneCreditApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/phone-credits', [PhoneCreditApplicationController::class, 'store']);
