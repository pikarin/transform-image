<?php

use App\Http\Controllers\TransformImageController;
use Illuminate\Support\Facades\Route;

Route::get('/images/{options}/{path}', TransformImageController::class)
    ->where('options', '([a-zA-Z]+=[a-zA-Z0-9]+,?)+')
    ->where('path', '.*\..*');
