<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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
    return view('index');
});

// Login Routes
Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login',  [LoginController::class,'login']);

Route::post('logout', [LoginController::class,'logout'])->name('logout');

//dashboard -admin
Route::get('/dashboard',[AdminController::class,'index']);
Route::get('/dashboard/table/{tablename}', [AdminController::class, 'getTable']);
Route::delete('/dashboard/table/{tablename}/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::put('/dashboard/{tablename}/{id}/edit', [AdminController::class, 'updateRecord'])->name('editRecord');
Route::post('/dashboard/addRecord/{tablename}',[AdminController::class,'addRecord'])->name('addRecord');