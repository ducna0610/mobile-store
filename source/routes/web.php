<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\User\BillController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomePageController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\CheckAdminLoginMiddleware;
use App\Http\Middleware\CheckUserLogin;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

// -- USER --
Route::group(
    [
        'as' => 'homes.',
        'controller' => HomePageController::class,
    ],
    function () {
        Route::get('/', 'index')->name('index');

        Route::get('/about', 'about')->name('about');

        Route::get('/location', 'location')->name('location');

        Route::get('/detail-product/{product}', 'detailProduct')->name('detailProduct');
    }
);

Route::group(
    [
        'prefix' => 'carts',
        'as' => 'carts.',
        'controller' => CartController::class,
    ],
    function () {
        Route::post('/add-to-cart/{product}', 'addToCart')->name('addToCart');
        Route::post('/update-quantity-cart/{type}', 'updateQuantityInCart')->name('updateCart');
        Route::delete('/delete-item-cart/{type}', 'deleteItemCart')->name('deleteItemCart');
        Route::get('/show-cart', 'showCart')->name('showCart');
        Route::get('/total-quantity', 'totalQuantity')->name('totalQuantity');
    }
);

Route::group([
    'middleware' => CheckUserLogin::class
], function () {
    Route::group(
        [
            'prefix' => 'carts',
            'as' => 'carts.',
            'controller' => CartController::class,
        ],
        function () {
            Route::get('/order', 'order')->name('order');
            Route::post('/checkout', 'checkout')->name('checkout');
        }
    );

    Route::group(
        [
            'prefix' => 'bills',
            'as' => 'bills.',
            'controller' => BillController::class,
        ],
        function () {
            Route::get('/show-bill', 'showBill')->name('showBill');
            Route::get('/bill-detail/{bill}', 'billDetail')->name('billDetail');
            Route::get('/cancel/{bill}', 'cancel')->name('cancel');
            Route::get('/rate/{product}', 'rate')->name('rate');
            Route::get('/delete-rate/{product}', 'deleteRate')->name('deleteRate');
        }
    );

    Route::group(
        [
            'prefix' => 'me',
            'as' => 'users.',
            'controller' => UserController::class,
        ],
        function () {
            Route::get('/profile', 'showProfile')->name('showProfile');
            Route::post('/profile', 'editProfile')->name('editProfile');
        }
    );
});

Route::post('login', [AuthController::class, 'logging'])->name('logging');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('registering', [AuthController::class, 'registering'])->name('registering');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


// -- SOCIALITE --
Route::get('/auth/redirect/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('auth.redirect');

Route::get(
    '/auth/callback/{provider}',
    [
        AuthController::class, 'callback'
    ]
)->name('auth.callback');


// ===========================================================


// -- ADMIN --
Route::get('admin-login', [AuthController::class, 'adminLogin'])->name('admin-login');
Route::post('admin-login', [AuthController::class, 'adminLogging'])->name('admin-logging');


Route::get('admin-register', [AuthController::class, 'adminRegister'])->name('admin-register');
Route::post('admin-register', [AuthController::class, 'adminRegistering'])->name('admin-registering');

Route::get('admin-logout', [AuthController::class, 'adminLogout'])->name('admin-logout');

Route::group(
    [
        'prefix' => 'ad',
        'as' => 'admins.',
        'controller' => AdminController::class,
        'middleware' => CheckAdminLoginMiddleware::class,
    ],
    function () {

        Route::get('/', 'index')->name('index');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        Route::group(
            [
                'prefix' => 'manufacturers',
                'as' => 'manufacturers.',
                'controller' => ManufacturerController::class,
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/index-api', function () {
                    return view('admin.manufacturer.index_api');
                });
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'store')->name('store');
                Route::get('/{manufacturer}/edit', 'edit')->name('edit');
                Route::put('/{manufacturer}', 'update')->name('update');
                Route::delete('/{manufacturer}', 'destroy')->name('destroy');
            }
        );

        Route::group(
            [
                'prefix' => 'products',
                'as' => 'products.',
                'controller' => ProductController::class,
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/{product}', 'detail')->name('detail');
                Route::post('/create', 'store')->name('store');
                Route::get('/{product}/edit', 'edit')->name('edit');
                Route::post('/update-active/{product}', 'updateActive')->name('updateActive');
                Route::put('/{product}', 'update')->name('update');
                Route::delete('/{product}', 'destroy')->name('destroy');

                Route::group(
                    [
                        'prefix' => 'images',
                        'as' => 'images.',
                        'controller' => ImageController::class,
                    ],
                    function () {
                        Route::post('/create/{product}', 'store_image_product')->name('store');
                        Route::put('/{product}', 'update')->name('update');
                        Route::delete('/{product}', 'destroy')->name('destroy');
                    }
                );
            }
        );

        Route::group(
            [
                'prefix' => 'type',
                'as' => 'types.',
                'controller' => TypeController::class,
            ],
            function () {
                Route::get('/create', 'create')->name('create');
                Route::post('/create/{product}', 'store')->name('store');
                Route::get('/{type}/edit', 'edit')->name('edit');
                Route::put('/{type}', 'update')->name('update');
                Route::delete('/{type}', 'destroy')->name('destroy');
            }
        );

        Route::group(
            [
                'prefix' => 'order',
                'as' => 'orders.',
                'controller' => OrderController::class,
            ],
            function () {
                Route::get('/', 'index')->name('index');
                Route::post('/update-status/{bill}', 'updateStatus')->name('updateStatus');
            }
        );

        Route::group(
            [
                'prefix' => 'charts',
                'as' => 'charts.',
                'controller' => ChartController::class,
            ],
            function () {
                Route::get('/revenue', 'revenue')->name('revenue');
                Route::get('/products', 'products')->name('products');
            }
        );
    }
);
