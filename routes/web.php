<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/demo', function () {
    return view('demo');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [TaskController::class,'index'])->name('dashboard');

    Route::resource('/tasks',TaskController::class);
});




Route::group(['middleware' => ['role:Admin|superAdmin']],function(){

Route::resource('/permission',PermissionController::class);
Route::resource('/role',RoleController::class);
Route::put('/rolePermission/{roleId}',[RoleController::class,'updatePermission'])->name('rolePermission');
Route::resource('/user',UserController::class);

Route::get('/users', [AdminController::class,'getAllUsers'])->name('users.data');

Route::get('/activity', [AdminController::class,'getAllActivity'])->name('users.activity');
    
});


