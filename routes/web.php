<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/articles', \Writing\Infrastructure\Http\Controllers\Api\V1\CreateArticleController::class);
