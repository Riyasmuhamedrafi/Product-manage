<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::middleware(['auth','admin'])->group(function () {


    Route::resource('subadmin',UserController::class);
    Route::post('subadmin/delete',[UserController::class,'delete'])->name('subadmin.delete');
    Route::post('bulk-delete', [ProductController::class, 'bulkdelete'])->name('bulkdelete');

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/search', [ProductController::class, 'search'])->name('search');

Route::get('/error', function () {
    return view('layouts.error');
})->name('error_found');
Route::middleware(['auth'])->group(function () {
    Route::resource('product',ProductController::class);
    Route::post('product/update',[ProductController::class,'update_product'])->name('update_product');
    Route::post('bulk-import', [ProductController::class, 'import'])->name('bulk.import');
    Route::get('bulk-export', [ProductController::class, 'export'])->name('bulk.export');
});
Route::get('/test', function () {
    return view('products.test');
});


