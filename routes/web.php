<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WS_UserController;

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
    return view('auth.login');
});

Route::get('/index', function () {
    return view('admin.index');
});


// Login Routes
Route::get('login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('login',  [AuthController::class,'login']);

Route::post('logout', [AuthController::class,'logout'])->name('logout');

//dashboard -admin
Route::get('/dashboard',[AdminController::class,'index']);
Route::get('/dashboard/table/{tablename}', [AdminController::class, 'getTable']);
Route::delete('/dashboard/table/{tablename}/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::put('/dashboard/{tablename}/{id}/edit', [AdminController::class, 'updateRecord'])->name('editRecord');
Route::post('/dashboard/addRecord/{tablename}',[AdminController::class,'addRecord'])->name('addRecord');

//User 
Route::get('/dashboard/tables/ws_user',[WS_UserController::class,'index']);
Route::post('/ws_user/addRecord',[WS_UserController::class,'addRecord']);
Route::put('/ws_user/updateRecord/{recordId}',[WS_UserController::class,'UpdateRecord']);
Route::get('/getUsers',[WS_UserController::class,'getAll']);
Route::get('/getCountries',[WS_UserController::class,'getAllCountries']);


