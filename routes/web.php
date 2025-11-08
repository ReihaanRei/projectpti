<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/adminDashboard', function () {
    return view('adminDashboard');
});