<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProsesTransaksiController;
use App\Http\Controllers\DetailTransaksiController;

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
    return view('login.login');
});


Route::get('/', [AccountController::class, 'showLogin']);
Route::post('/', [AccountController::class, 'login'])->name('login');
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');


Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('pages.dashboard');


Route::get('/dashboard/account', [AccountController::class, 'showAccount'])->name('account');
Route::post('/dashboard/account/store', [AccountController::class, 'store'])->name('account.store');
Route::delete('/dashboard/account/{id}/destroy', [AccountController::class, 'destroy'])->name('account.destroy');
Route::get('/dashboard/account/edit/{id}', [AccountController::class, 'edit'])->name('account.edit');
Route::put('/dashboard/account/update/{id}', [AccountController::class, 'update'])->name('account.update');


Route::get('/dashboard/kategori', [KategoriController::class, 'show'])->name('kategori');
Route::post('/dashboard/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
Route::delete('/dashboard/kategori/{id}/destroy', [KategoriController::class, 'destroy'])->name('kategori.delete');
Route::get('/dashboard/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/dashboard/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');

Route::get('/dashboard/barang', [BarangController::class, 'show'])->name('barang');
Route::post('/dashboard/barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::get('/dashboard/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/dashboard/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/dashboard/barang/{id}/destroy', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/dashboard/transaksi', [TransaksiController::class, 'show'])->name('transaksi');

Route::post('/update-jumlah', [TransaksiController::class, 'updateJumlah'])->name('update.jumlah');
Route::delete('/proses-transaksi/{id}', [ProsesTransaksiController::class, 'destroy'])->name('proses-transaksi.destroy');
Route::post('/dashboard/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::post('/dashboard/transaksi/add', [ProsesTransaksiController::class, 'store'])->name('prosestransaksi.store');


Route::get('/dashboard/history', [DetailTransaksiController::class, 'show'])->name('history');
Route::get('/detailtransaksi/{transaksi_id}', [DetailTransaksiController::class, 'showDetail'])->name('detail');
Route::get('/print/{id}', [DetailTransaksiController::class, 'showPrint'])->name('print');
