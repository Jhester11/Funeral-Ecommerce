<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Funeral\Admin\AdminController;
use App\Http\Controllers\Funeral\Admin\BrandController;
use App\Http\Controllers\Funeral\Admin\CategoryController;
use App\Http\Livewire\Funeral\Admin\BrandIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin Route
Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'funeral.admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });
    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/dashboard', 'funeral.admin.dashboard')->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Category Routes
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'category');
            Route::get('/category/create', 'create');
            Route::post('/category', 'store');
            Route::get('/category/{category}/edit', 'edit');
            Route::put('category/{category}', 'update');
            Route::get('/category/{category}/delete', 'destroy');
        });
    });

    // Brands Routes
    Route::get('/brands', BrandIndex::class);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
