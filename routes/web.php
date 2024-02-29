<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return "Hello World!";
  });
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/show', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books', [BookController::class, 'update']);
Route::delete('/books', [BookController::class, 'destory']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/show/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destory']);
