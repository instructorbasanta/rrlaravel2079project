<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', function () {
    return view('backend.user.login');
});

Route::get('/register', function () {
    return view('backend.user.register');
});

Route::get('/forgot-password', function () {
    return view('backend.user.forgot_password');
});

Route::get('/backend/dashboard', function () {
    return view('backend.dashboard.index');
});

Route::get('/backend/dashboard', function () {
    return view('backend.dashboard.index');
});

Route::get('/backend/category/create', function () {
    return view('backend.category.create');
});

Route::get('/backend/category', function () {
    return view('backend.category.index');
});