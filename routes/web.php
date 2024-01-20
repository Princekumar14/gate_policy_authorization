<?php

// use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index2'])->name('home2');

Route::get('/gate', [App\Http\Controllers\AuthorizationController::class, 'index'])->name('gate.index');
// Route::get('/gate', [App\Http\Controllers\AuthorizationController::class, 'index'])->name('gate.index')->middleware('can:isUser');
// Route::get('/gate', [App\Http\Controllers\AuthorizationController::class, 'index'])->name('gate.index'); //autrhorized throgh controller

// Route::get('/gate', function(){
//     return "hi";
// });