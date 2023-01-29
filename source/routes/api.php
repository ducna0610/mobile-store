<?php

use App\Http\Controllers\User\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'api.',
        'controller' => ApiController::class,
    ],
    function () {
        Route::group(
            [
                'as' => 'products.',
            ],
            function () {

                Route::get('/disks/{product_id}', 'disks')->name('disks');

                Route::get('/rams/{product_id}', 'rams')->name('rams');

                Route::get('/colors/{product_id}', 'colors')->name('colors');

                Route::get('/type/{product_id}', 'type')->name('type');
            }
        );
    }
);
