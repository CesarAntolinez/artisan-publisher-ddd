<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Writing\Infrastructure\Http\Controllers\Api\V1;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/articles', V1\ListArticlesController::class)->name('articles.index');
Route::post('/articles', V1\CreateArticleController::class)->name('articles.store');
Route::get('/articles/{articleId}', V1\FindArticleController::class)->name('articles.show');
Route::post('/articles/{articleId}/propose', V1\ProposeArticleForReviewController::class)->name('articles.propose');


Route::post('/articles/{articleId}/comments', V1\AddCommentController::class);

