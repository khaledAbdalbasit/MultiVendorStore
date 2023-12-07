<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CurrancyConverterController;
use App\Http\Controllers\Dashboard\dashbordController;
use App\Http\Controllers\Front\Auth\TowFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\Categories\AccessoriesController;
use App\Http\Controllers\Front\Categories\CategoriesController;
use App\Http\Controllers\Front\Categories\DigitalCamerasController;
use App\Http\Controllers\Front\Categories\ElectronicsController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
// Route::group([
//     'prefix' => '{locale}',
// ],function(){
        Route::get('/', [HomeController::class, 'index'])
            ->name('home');

        Route::get('/products', [ProductsController::class, 'index'])
            ->name('products.index');

        Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
            ->name('products.show');


        Route::resource('/cart', CartController::class)->middleware('auth');
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
        Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
        Route::post('checkout', [CheckoutController::class, 'store']);

        Route::get('auth/user/2FA', [TowFactorAuthenticationController::class, 'index'])
            ->name('front.2fa');

        Route::post('currency', [CurrancyConverterController::class, 'store'])
            ->name('currency.store');
//});
        Route::get('show/category/{category:slug}', [CategoriesController::class, 'show'])
        ->name('products.categories.show');
        Route::get('show2/category/{category:slug}', [CategoriesController::class, 'show2'])
        ->name('products.categories.show2');
        Route::get('show3/category/{category:slug}', [CategoriesController::class, 'show3'])
        ->name('products.categories.show3');

        Route::get('show4/category/{category:slug}', [CategoriesController::class, 'show4'])
        ->name('products.categories.show4');
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware(['guest'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest']);
require __DIR__.'/dashboard.php';
// require __DIR__.'/auth.php';
