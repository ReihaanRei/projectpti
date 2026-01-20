<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminVariantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminTransactionController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM / USER
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

Route::controller(HomeController::class)->group(function () {
    Route::get('/katalog', 'showKatalog')->name('katalog');
    Route::get('/catalog', 'catalogFilter')->name('catalogFilter');
    Route::get('/products/{id}', 'show')->name('productDetail');
});

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| TRANSAKSI USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/checkout', [TransactionController::class, 'checkout'])
        ->name('checkout');

    Route::get('/my-transactions', [TransactionController::class, 'myTransactions'])
        ->name('my.transactions');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    // ===== DASHBOARD =====
    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('adminDashboard');

    // ===== PRODUK =====
    Route::get('/products', [AdminController::class, 'productIndex'])
        ->name('admin.listProduct');

    Route::get('/products/create', [AdminController::class, 'productCreate'])
        ->name('admin.createProduct');

    Route::post('/products', [AdminController::class, 'productStore'])
        ->name('admin.storeProduct');

    Route::get('/products/{product}/edit', [AdminController::class, 'productEdit'])
        ->name('admin.editProduct');

    Route::put('/products/{product}', [AdminController::class, 'productUpdate'])
        ->name('admin.updateProduct');

    Route::delete('/products/{product}', [AdminController::class, 'productDestroy'])
        ->name('admin.destroyProduct');

    Route::get('/products/search', [AdminController::class, 'productSearch'])
        ->name('admin.searchProduct');

    Route::get('/products/filter', [AdminController::class, 'productFilter'])
        ->name('admin.productFilter');

    Route::delete('/delete-image/{id}', [AdminController::class, 'deleteImage'])
        ->name('admin.deleteImage');

    // ===== KATEGORI =====
    Route::get('/categories', [AdminController::class, 'categoryIndex'])
        ->name('admin.listCategory');

    Route::get('/categories/create', [AdminController::class, 'categoryCreate'])
        ->name('admin.createCategory');

    Route::post('/categories', [AdminController::class, 'categoryStore'])
        ->name('admin.storeCategory');

    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])
        ->name('admin.destroyCategory');

    // ===== VARIAN PRODUK (INI YANG BARU) =====
    Route::get('/products/{product}/variants', 
        [AdminVariantController::class, 'index'])
        ->name('admin.variants.index');

    Route::post('/products/{product}/variants', 
        [AdminVariantController::class, 'store'])
        ->name('admin.variants.store');

    Route::put('/variants/{variant}', 
        [AdminVariantController::class, 'update'])
        ->name('admin.variants.update');

    Route::delete('/variants/{variant}', 
        [AdminVariantController::class, 'destroy'])
        ->name('admin.variants.destroy');

    // ===== TRANSAKSI ADMIN =====
    Route::get('/transactions', [AdminTransactionController::class, 'index'])
        ->name('admin.transactions');

    Route::put('/transactions/{id}/confirm', 
        [AdminTransactionController::class, 'confirmTransaction'])
        ->name('admin.transactions.confirm');

    Route::put('/transactions/{id}/cancel', 
        [AdminTransactionController::class, 'cancelTransaction'])
        ->name('admin.transactions.cancel');
});

/*
|--------------------------------------------------------------------------
| LAIN-LAIN
|--------------------------------------------------------------------------
*/
Route::get('/maps', function () {
    return view('maps');
});
<<<<<<< HEAD
=======

Route::get('/createProduk', function () {
    return view('admin/createProduk');
});

Route::get('/createKategori', function () {
    return view('admin/createKategori');
});
>>>>>>> 773dfda3ae6dd8a727db891608c5dea126b2e2ac
