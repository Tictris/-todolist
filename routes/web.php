<?php

use App\Http\Controllers\Todo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\TodoController;

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

Route::get('/', function () {
    return view('home');
});

// Authentication
Route::controller(Authentication::class)->group(function () {
    // register routes...
    Route::post('/register', 'register')->name('register');
    Route::view('/register', 'authentication.register');
    // login routes...
    Route::post('/login', 'login')->name('login');
    Route::view('/login', 'authentication.login');
    // logout route...
    Route::post('/logout', 'logout')->name('logout');
});

//todo
Route::controller(TodoController::class)->group(function () {
    //view todo list
    Route::get('/todo', 'index')->name('index');
    //create new task
    Route::post('/todo/store', 'store')->name('store');
    //delete task(s)
    Route::post('/todo/delete', 'delete')->name('delete');
});
