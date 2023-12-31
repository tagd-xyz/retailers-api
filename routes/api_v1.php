<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\App\Http\V1\Controllers')->group(function () {
    Route::permanentRedirect('/', '/api/v1/status');

    Route::middleware('guest')->group(function () {
        Route::get('status', 'Status@index')
            ->name('status');
    });

    Route::middleware(['auth:api'])->group(function () {
        Route::get('me', 'Me@show');

        Route::resource('retailers', 'Retailers')->only([
            'update',
        ]);

        Route::resource('items', 'Items')->only([
            'store',
        ]);

        Route::resource('stock', 'Stock')->only([
            'index', 'show', 'store', 'update', 'destroy',
        ]);

        Route::resource('stock.uploads', 'StocksUploads')->only([
            'store',
        ]);

        Route::resource('tagds', 'Tagds')->only([
            'index', 'show', 'destroy',
        ]);

        Route::prefix('tagds/{tagd}')->group(function () {
            Route::post('activate', 'Tagds@activate');
            Route::post('deactivate', 'Tagds@deactivate');
            Route::post('return', 'Tagds@return');
        });

        Route::group(['namespace' => 'Ref'], function () {
            Route::prefix('ref')->group(function () {
                Route::resource('countries', 'Countries')->only([
                    'index',
                ]);
                Route::resource('currencies', 'Currencies')->only([
                    'index',
                ]);
                Route::resource('item-types', 'ItemTypes')->only([
                    'index',
                ]);
            });
        });
    });
});
