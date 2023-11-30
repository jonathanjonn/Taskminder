<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

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
Route::view('/','login')->name('todos.login');

Route::view('/register','register')->name('todos.register');


Route::get('todos/index', [TodoController::class, 'index'])->name('todos.index');
Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::get('todos/edit', [TodoController::class, 'edit'])->name('todos.edit');
Route::post('todos/store', [TodoController::class, 'store'])->name('todos.store');
Route::get('todos/detail/{id}', [TodoController::class, 'detail'])->name('todos.detail');
Route::get('todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
Route::put('todos/update', [TodoController::class, 'update'])->name('todos.update');
Route::delete('todos/remove', [TodoController::class, 'remove'])->name('todos.remove');