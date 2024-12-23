<?php

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return view('welcome');
});


// Rute untuk mencetak laporan pendapatan
Route::post('/report/print', [ReportController::class, 'print'])->name('report.print');
// Rute untuk menampilkan laporan pendapatan
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
// Rute untuk mencetak laporan berdasarkan ID
Route::post('/report/{id}/print', [ReportController::class, 'print'])->name('report.print');
// Menampilkan formulir untuk menghitung pendapatan
Route::get('/revenue', [RevenueController::class, 'indexForm'])->name('revenue.form');
// Menyimpan dan menghitung pendapatan (metode POST)
Route::post('/revenue', [RevenueController::class, 'index'])->name('revenue.index');


Route::get('/sale/autocomplete', function (Request $request) {
    $search = $request->input('term'); // Ambil teks pencarian dari input
    
    $results = Item::where('nama_barang', 'LIKE', "%{$search}%")
                ->pluck('nama_barang') // Ambil kolom nama_barang
                ->toArray(); // Konversi ke array

    return response()->json($results);
})->name('sale.autocomplete');

Route::get('/sale/pendapatan', [SaleController::class, 'pendapatanForm'])->name('sale.pendapatan.form');
Route::post('/sale/pendapatan', [SaleController::class, 'pendapatan'])->name('sale.pendapatan');

// tambahkan route baru
Route::get('/files', [App\Http\Controllers\FileController::class, 'index'])
->name('files.index');
Route::get('/files/create', [App\Http\Controllers\FileController::class, 'create']) ->name('files.create');
Route::post('/files/store', [App\Http\Controllers\FileController::class, 'store'])
->name('files.store');
Route::get('/files/{file}/download', [App\Http\Controllers\FileController::class, 'download']) ->name('files.download');




Route::middleware([RoleMiddleware::class . ':admin'])->group(function(){
    Route::get('/edit-post/{post}',[FileController::class, 'showEditScreen']);
    Route::put('/edit-post/{post}',[FileController::class, 'actuallyUpdatePost']);
});
Route::middleware([RoleMiddleware::class . ':admin,user'])->group(function(){
    Route::post('/create-post', [FileController::class, 'createPost']);
});




Route::get('/app', function () {
    return view('layouts.app'); // Pastikan path view benar
})->middleware('auth'); // Pastikan hanya pengguna yang login bisa mengakses

Route::get('register', [RegisterController::class, 'showRegisterForm']);
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout']);


Route::resource('items', ItemController::class);
Route::get('items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('items', [ItemController::class, 'store'])->name('items.store');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');
Route::get('/sale/create', [SaleController::class, 'create'])->name('sale.create');
Route::post('/sale', [SaleController::class, 'createPost'])->name('sale.createPost');
Route::get('/sale/{id}/edit', [SaleController::class, 'edit'])->name('sale.edit');
Route::put('/sale/{id}', [SaleController::class, 'update'])->name('sale.update');
Route::delete('/sale/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');
Route::post('/sale', [SaleController::class, 'createPost'])->name('sale.store');


