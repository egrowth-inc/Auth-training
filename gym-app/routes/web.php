<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;

Route::get('/', function () {
    return view('index');
});

Route::get('/training/{muscle?}', [TrainingController::class, 'show']);


