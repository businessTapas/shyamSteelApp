<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::resources(['users' => UsersController::class]);

 Route::get('/', [UsersController::class, 'index'])->name('users.index');
Route::post('/users', [UsersController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::post('/users/update', [UsersController::class, 'update'])->name('users.update');
Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy'); 
