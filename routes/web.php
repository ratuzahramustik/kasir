<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');

    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{produk}/update', [ProdukController::class, 'update'])->name('produk.update');

    Route::get('/produk/{produk}/edit-stok', [ProdukController::class, 'editStok'])->name('produk.edit-stok');
    Route::put('/produk/{produk}/update-stok', [ProdukController::class, 'updateStok'])->name('produk.update-stok');

    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/produk/export/excel', [ProdukController::class, 'exportExcel'])->name('produk.export.excel');

});



Route::resource('users', UserController::class);
Route::get('/user/export/excel', [UserController::class, 'exportExcel'])->name('users.export.excel');



Route::resource('penjualan', PenjualanController::class);
    Route::get('/sales', [PenjualanController::class, 'sales'])->name('sales.index');
    Route::post('/sales/process-produk', [PenjualanController::class, 'processProduk'])->name('sales.process.produk');
    Route::post('/sales/process-member', [PenjualanController::class, 'processMember'])->name('sales.process.member');
    Route::post('/sales/member', [PenjualanController::class, 'member'])->name('sales.member');
    Route::post('/sales/store', [PenjualanController::class, 'store'])->name('sales.store');
    Route::get('invoice/{id}/download', [PenjualanController::class, 'downloadInvoice'])->name('penjualan.pdf');
    Route::get('/penjualan/export/excel', [PenjualanController::class, 'exportExcel'])->name('penjualan.export.excel');

    



