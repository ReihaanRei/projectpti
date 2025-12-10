<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
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

Route::get('/detailProduk', function () {
    return view('detailProduk');
});

Route::get('/maps', function () {
    return view('maps');
});

Route::get('/createProduk', function () {
    return view('admin/createProduk');
});

Route::get('/createKategori', function () {
    return view('admin/createKategori');
});