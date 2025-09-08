<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Writing\Infrastructure\Http\Controllers\Api\V1;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/articles', V1\CreateArticleController::class)->name('articles.store');
Route::post('/articles/{articleId}/propose', V1\ProposeArticleForReviewController::class);
Route::get('/articles/{articleId}', V1\FindArticleController::class);



