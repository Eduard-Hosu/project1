<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;

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

Auth::routes();

Route::get('/', function() {
    return view('layouts.app');
});

//Users
Route::resource('users', UserController::class)->middleware('is_admin');
Route::get('/changeUserStatus', [UserController::class, 'changeUserStatus'])->name('status.get')->middleware('is_admin');


//Projects
Route::get('projects', [ProjectController::class, 'index'])->name('projects')->middleware('is_admin');
Route::get('projects/edit/{project}', [ProjectController::class, 'edit'])->name('projects.edit')->middleware('is_admin');
Route::put('projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update')->middleware('is_admin');
Route::delete('/projects/destroy/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy')->middleware('is_admin');

//Tasks
Route::resource('tasks', TaskController::class);

//Comments
Route::resource('comments', CommentController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
