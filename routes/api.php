<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PollController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\AnswerController;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('current-user', 'currentUser');
});

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index');
    Route::post('user', 'store');
    Route::get('user/{id}', 'show');
    Route::put('user/{id}', 'update');
    Route::delete('user/{id}', 'destroy');
});

Route::apiResource("polls", PollController::class);

// Route::apiResource("questions", QuestionController::class);
Route::controller(QuestionController::class)->group(function () {
    Route::get('questions', 'index');
    Route::post('question', 'store');
    Route::get('question/{id}', 'show');
    Route::put('question/{id}', 'update');
    Route::delete('question/{id}', 'destroy');
    Route::get('question-poll/{id}', 'toto');
});

// Route::apiResource("answers", AnswerController::class);
Route::controller(AnswerController::class)->group(function () {
    Route::get('answers', 'index');
    Route::post('answer', 'store');
    Route::get('answer/{id}', 'show');
    Route::put('answer/{id}', 'update');
    Route::delete('answer/{id}', 'destroy');
    Route::get('answer-question/{id}', 'toto2');
});

//EXEMPLE

// Route::controller(TodoController::class)->group(function () {
//     Route::get('todos', 'index');
//     Route::post('todo', 'store');
//     Route::get('todo/{id}', 'show');
//     Route::put('todo/{id}', 'update');
//     Route::delete('todo/{id}', 'destroy');
// }); 
