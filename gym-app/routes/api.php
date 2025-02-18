<?php

use App\Http\Controllers\MuscleController;
use Illuminate\Support\Facades\Route;

Route::get('/muscle/{name}', [MuscleController::class, 'show']);