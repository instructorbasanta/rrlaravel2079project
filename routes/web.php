<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[AuthController::class, 'showLogin'])->name('backend.showlogin');
Route::post('/login',[AuthController::class, 'login'])->name('backend.login');


Route::get('/register',[AuthController::class, 'showRegister'])->name('backend.showregister');
Route::post('/register',[AuthController::class, 'register'])->name('backend.register');


Route::get('/backend/dashboard', [DashboardController::class,'index'])->name('backend.dashboard.index')->middleware('auth');

Route::post('/logout',[AuthController::class, 'logout'])->name('backend.logout');

Route::get('/forgot-password', function () {
    return view('backend.user.forgot_password');
});

Route::prefix('backend/')->name('backend.')->group(function (){
    Route::resource('setting', SettingController::class)->only([
        'create', 'store', 'update', 'edit'
    ]);
    //trash list
    Route::get('category/trash', [CategoryController::class,'showTrash'])->name('category.trash');
    //trash restore
    Route::get('category/trash/restore/{category}', [CategoryController::class,'restoreTrash'])->name('category.restore');

    //trash remove/permanent remove
    Route::delete('category/trash/{category}', [CategoryController::class,'deleteTrash'])->name('category.permanent_destroy');

    Route::resource('category', CategoryController::class);


});
