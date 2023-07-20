<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Funeral\Admin\BrandIndex;
use App\Http\Controllers\Funeral\User\UserController;
use App\Http\Controllers\Funeral\Admin\AdminController;
use App\Http\Controllers\Funeral\Admin\BrandController;
use App\Http\Controllers\Funeral\Admin\ColorController;
use App\Http\Controllers\Funeral\Admin\SliderController;
use App\Http\Controllers\Funeral\Admin\ProductController;
use App\Http\Controllers\Funeral\Frontend\CartController;
use App\Http\Controllers\Funeral\Admin\CategoryController;
use App\Http\Controllers\Funeral\Frontend\FrontendController;
use App\Http\Controllers\Funeral\Frontend\WishlistController;

Auth::routes();

// Frontend Routes
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');

    Route::get('/new-arrivals', 'newArrival');
    Route::get('/featured-products', 'featuredProducts');
    Route::get('search', 'searchProducts');
});

// Frontend routes securing
Route::middleware(['auth'])->group(function () {
    Route::get('wishlist', [WishlistController::class, 'wishlist']);
    Route::get('cart', [CartController::class, 'cart']);
    Route::get('checkout', [CheckoutController::class, 'checkout']);

    // Checking orders
    Route::get('orders', [OrderController::class, 'orders']);
    Route::get('orders/{orderId}', [OrderController::class, 'show']);

    // User Routes
    Route::get('profile', [FrontendUserController::class, 'show']);
    Route::post('profile', [FrontendUserController::class, 'updateUserDetails']);
    Route::get('change-password', [FrontendUserController::class, 'passwordCreated']);
    Route::post('change-password', [FrontendUserController::class, 'changePassword']);
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'funeral.user.login')->name('login');
        Route::view('/register', 'funeral.user.register')->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
        Route::get('/verify', [UserController::class, 'verify'])->name('verify');

        Route::get('password/forgot', [UserController::class, 'showForgotForm'])->name('forgot.password.form');
        Route::post('password/forgot', [UserController::class, 'sendResetLink'])->name('forgot.password.link');
        Route::get('password/reset/{token}', [UserController::class, 'showResetForm'])->name('reset.password.form');
        Route::post('password/reset', [UserController::class, 'resetPassword'])->name('reset.password');
    });
    Route::middleware(['auth:web', 'is_user_verify_email', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'funeral.user.home')->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');

        //Homepage Routes
        Route::get('homepage', [FrontendController::class, 'home'])->name('homepage');
    });
});

// Admin Route
Route::prefix('admin')->name('admin.')->group(function () {
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

    // Colors Routes
    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors', 'color');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('/colors/{color_id}/delete', 'destroy');
    });

    // Products Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'product');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('products/{product_id}/delete', 'destroy');
        Route::get('product-image/{product_image_id}/delete', 'destroyImage');

        Route::post('product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get("product-color/{prod_color_id}/delete", 'deleteProdColor');
    });

    // Slider Routes
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'slider');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/delete', 'destroy');
    });
});

