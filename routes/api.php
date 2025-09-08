<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/articles', \Writing\Infrastructure\Http\Controllers\Api\V1\CreateArticleController::class)
    ->name('articles.store');

