<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\FoodController;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class,'showHomePage'])->name('frontend.homepage');
Route::get('/menu', [HomeController::class,'showMenu'])->name('frontend.menu');
Route::get('/booking', [HomeController::class,'showBookingForm'])->name('frontend.booking');
Route::post('/booking', [HomeController::class,'storeBookingData'])->name('frontend.store_booking');


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
//For Category
    //trash list
    Route::get('category/trash', [CategoryController::class,'showTrash'])->name('category.trash');
    //trash restore
    Route::get('category/trash/restore/{category}', [CategoryController::class,'restoreTrash'])->name('category.restore');
    //trash remove/permanent remove
    Route::delete('category/trash/{category}', [CategoryController::class,'deleteTrash'])->name('category.permanent_destroy');

    Route::resource('category', CategoryController::class);

//    For Tag
    //trash list
    Route::get('tag/trash', [TagController::class,'showTrash'])->name('tag.trash');
    //trash restore
    Route::get('tag/trash/restore/{tag}', [TagController::class,'restoreTrash'])->name('tag.restore');
    //trash remove/permanent remove
    Route::delete('tag/trash/{tag}', [TagController::class,'deleteTrash'])->name('tag.permanent_destroy');

    Route::resource('tag', TagController::class);

//    For Food
    //trash list
    Route::get('food/trash', [FoodController::class,'showTrash'])->name('food.trash');
    //trash restore
    Route::get('food/trash/restore/{food}', [FoodController::class,'restoreTrash'])->name('food.restore');
    //trash remove/permanent remove
    Route::delete('food/trash/{food}', [FoodController::class,'deleteTrash'])->name('food.permanent_destroy');

    Route::resource('food', FoodController::class);
});
