<?php

use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/todos', [TodoController::class, 'getTodos']);
Route::post('/todos', [TodoController::class, 'addTodo']);
Route::get('todos/{id}', [TodoController::class, 'getSingleTodo']);
Route::put('todos/{id}', [TodoController::class, 'updateTodo']);
Route::get('todos/{id}', [TodoController::class, 'getSingleTodo']);
Route::delete('todos/{id}', [TodoController::class, 'deleteTodo']);
