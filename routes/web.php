<?php

// use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RequirementController;
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
Route::get('/india', function () {
    return 'india';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index2'])->name('home2');

// Route::get('/gate', [App\Http\Controllers\AuthorizationController::class, 'index'])->name('gate.index')->middleware('can:isUser');
Route::get('/gate', [App\Http\Controllers\AuthorizationController::class, 'index'])->name('gate.index'); //autrhorized throgh controller


Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index'); 


// Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show')->middleware('can:view,post'); 
Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

Route::get('/posts/delete/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete')->middleware('can:delete,post'); 


// ----------------- csrf token start -----------------
Route::get('/takecsrf',[RequirementController::class,'takecsrf']);
Route::middleware(['csrfcor'])->group(function () {
    Route::post('/addingdata',[RequirementController::class,'addRequirement']);
});
// ----------------- csrf token end -----------------

Route::get('/allrequests',[RequirementController::class,'allrequests'])->name('customer.requirements');
Route::controller(RequirementController::class)->group(function(){
    Route::get('/allrequests/{requirement}', 'showRequest')->name('view.request');
    Route::put('/addingcomment', 'addComment')->name('add.comment');
});

Route::get('/iframe', function () {
    return view('iframe');
});