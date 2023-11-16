<?php

use Illuminate\Support\Facades\Auth; // Menggunakan Facade Auth untuk otentikasi
use Illuminate\Support\Facades\Route; // Menggunakan Facade Route untuk mendefinisikan rute
use App\Http\Controllers\BookController; // Menggunakan BookController untuk mengelola buku
use App\Http\Controllers\KategoriController; // Menggunakan KategoriController untuk mengelola kategori
use App\Http\Controllers\PeminjamController; // Menggunakan PeminjamController untuk mengelola peminjam
use App\Http\Controllers\DashboardController; // Menggunakan DashboardController untuk mengelola dashboard
use App\Http\Controllers\PengarangController; // Menggunakan PengarangController untuk mengelola pengarang
use App\Http\Controllers\TransaksiController; // Menggunakan TransaksiController untuk mengelola transaksi


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
    return view('welcome');
});

Route::middleware('auth')->middleware('check')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('book', [BookController::class, 'index'])->name('book.index');
    Route::get('pengarang', [PengarangController::class, 'index'])->name('pengarang.index');
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('peminjam', [PeminjamController::class, 'index'])->name('peminjam.index');
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
});

Route::controller(BookController::class)->prefix('book')->group(function () {
    Route::get('', 'index')->name('book');
    Route::get('create', 'create')->name('book.create');
    Route::post('store', 'store')->name('book.store');
    Route::get('edit/{id}', 'edit')->name('book.edit');
    Route::put('edit/{id}', 'update')->name('book.update');
    Route::delete('destroy/{id}', 'destroy')->name('book.destroy');
});

Route::controller(PengarangController::class)->prefix('pengarang')->group(function () {
    Route::get('', 'index')->name('pengarang');
    Route::get('create', 'create')->name('pengarang.create');
    Route::post('store', 'store')->name('pengarang.store');
    Route::get('edit/{id}', 'edit')->name('pengarang.edit');
    Route::put('edit/{id}', 'update')->name('pengarang.update');
    Route::delete('destroy/{id}', 'destroy')->name('pengarang.destroy');
});
Route::controller(TransaksiController::class)->prefix('transaksi')->group(function () {
    Route::get('', 'index')->name('transaksi');
    Route::get('create', 'create')->name('transaksi.create');
    Route::post('store', 'store')->name('transaksi.store');
    Route::get('edit/{id}', 'edit')->name('transaksi.edit');
    Route::put('edit/{id}', 'update')->name('transaksi.update');
    Route::delete('destroy/{id}', 'destroy')->name('transaksi.destroy');
});

Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
    Route::get('', 'index')->name('kategori');
    Route::get('create', 'create')->name('kategori.create');
    Route::post('store', 'store')->name('kategori.store');
    Route::get('edit/{id}', 'edit')->name('kategori.edit');
    Route::put('edit/{id}', 'update')->name('kategori.update');
    Route::delete('destroy/{id}', 'destroy')->name('kategori.destroy');
});

Route::controller(PeminjamController::class)->prefix('peminjam')->group(function () {
    Route::get('', 'index')->name('peminjam');
    Route::get('create', 'create')->name('peminjam.create');
    Route::post('store', 'store')->name('peminjam.store');
    Route::get('edit/{id}', 'edit')->name('peminjam.edit');
    Route::put('edit/{id}', 'update')->name('peminjam.update');
    Route::delete('destroy/{id}', 'destroy')->name('peminjam.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
