<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CardController;
use App\Http\Controllers\Frontend\CheckoutController;

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AddressController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Burada web rotalarınızı tanımlayabilirsiniz.
|
*/

// Public frontend routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{categorySlug?}', [HomeController::class, 'index']);

Route::get('/giris', [AuthController::class, 'signInForm'])->name('auth.signin.form');
Route::post('/giris', [AuthController::class, 'signIn'])->name('auth.signin');
Route::get('/cikis', [AuthController::class, 'signOut'])->name('auth.signout');

Route::get('/uye-ol', [AuthController::class, 'signUpForm'])->name('auth.signup.form');
Route::post('/uye-ol', [AuthController::class, 'signUp'])->name('auth.signup');

Route::middleware('auth')->group(function () {
    Route::get('/sepetim/ekle/{product}', [CardController::class, 'add'])->name('card.add');
    Route::get('/sepetim/sil/{cardDetails}', [CardController::class, 'remove'])->name('card.remove');
    Route::get('/sepetim', [CardController::class,'index'])->name('card.index');

    Route::get("/satin-al", [CheckoutController::class, 'showCheckoutForm']);
    Route::post("/satin-al", [CheckoutController::class, 'checkout']);
});

// Backend routes with auth middleware
Route::middleware('auth')->group(function () {

    // User management
    Route::resource('users', UserController::class);

    Route::get('users/{user}/change-password', [UserController::class, 'passwordForm'])->name('users.change-password.form');
    Route::post('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');

    // Addresses routes nested under users
    Route::resource('users.addresses', AddressController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products and product images
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('products.images', ProductImageController::class);
});

