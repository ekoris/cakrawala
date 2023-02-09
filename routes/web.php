<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['namespace' => 'App\Http\Controllers', 'as' => 'admin.'], function() {
        Route::group(['prefix' => 'user','as' => 'user.'], function() {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('create', 'UserController@create')->name('create');
            Route::post('store', 'UserController@store')->name('store');
            Route::get('/{id}/edit', 'UserController@edit')->name('edit');
            Route::post('/{id}/update', 'UserController@update')->name('update');
            Route::get('/{id}/delete', 'UserController@delete')->name('delete');
        });

        Route::group(['prefix' => 'master-market','as' => 'master-market.'], function() {
            Route::get('/', 'MasterMarketController@index')->name('index');
            Route::get('create', 'MasterMarketController@create')->name('create');
            Route::post('store', 'MasterMarketController@store')->name('store');
            Route::get('/{id}/edit', 'MasterMarketController@edit')->name('edit');
            Route::post('/{id}/update', 'MasterMarketController@update')->name('update');
            Route::get('/{id}/delete', 'MasterMarketController@delete')->name('delete');
        });

        Route::group(['prefix' => 'master-bank','as' => 'master-bank.'], function() {
            Route::get('/', 'MasterBankController@index')->name('index');
            Route::get('create', 'MasterBankController@create')->name('create');
            Route::post('store', 'MasterBankController@store')->name('store');
            Route::get('/{id}/edit', 'MasterBankController@edit')->name('edit');
            Route::post('/{id}/update', 'MasterBankController@update')->name('update');
            Route::get('/{id}/delete', 'MasterBankController@delete')->name('delete');
        });

        Route::group(['prefix' => 'master-collateral','as' => 'master-collateral.'], function() {
            Route::get('/', 'MasterCollateralController@index')->name('index');
            Route::get('create', 'MasterCollateralController@create')->name('create');
            Route::post('store', 'MasterCollateralController@store')->name('store');
            Route::get('/{id}/edit', 'MasterCollateralController@edit')->name('edit');
            Route::post('/{id}/update', 'MasterCollateralController@update')->name('update');
            Route::get('/{id}/delete', 'MasterCollateralController@delete')->name('delete');
        });

        Route::group(['prefix' => 'master-banner','as' => 'master-banner.'], function() {
            Route::get('/', 'MasterBannerController@index')->name('index');
            Route::get('create', 'MasterBannerController@create')->name('create');
            Route::post('store', 'MasterBannerController@store')->name('store');
            Route::get('/{id}/edit', 'MasterBannerController@edit')->name('edit');
            Route::post('/{id}/update', 'MasterBannerController@update')->name('update');
            Route::get('/{id}/delete', 'MasterBannerController@delete')->name('delete');
        });

        Route::group(['prefix' => 'mailbox','as' => 'mailbox.'], function() {
            Route::get('/', 'MailBoxController@index')->name('index');
            Route::get('create', 'MailBoxController@create')->name('create');
            Route::post('store', 'MailBoxController@store')->name('store');
            Route::get('/{id}/edit', 'MailBoxController@edit')->name('edit');
            Route::post('/{id}/update', 'MailBoxController@update')->name('update');
            Route::get('/{id}/delete', 'MailBoxController@delete')->name('delete');
        });

        Route::group(['prefix' => 'saving','as' => 'saving.'], function() {
            Route::group(['prefix' => 'all-data','as' => 'all-data.'], function() {
                Route::get('/', 'SavingController@index')->name('index');
                Route::get('{id}/show/{type}', 'SavingController@show')->name('show');
                Route::get('{id}/show/{type}/submit/{transaksi_id}/{status}', 'SavingController@submit')->name('submit');
            });
            Route::group(['prefix' => 'transaction-pending','as' => 'transaction-pending.'], function() {
                Route::get('/', 'SavingController@transactionPending')->name('index');
                Route::get('{id}/submit/{status}', 'SavingController@submitTransactionPending')->name('submit');
            });
        });

        Route::group(['prefix' => 'product','as' => 'product.'], function() {
            Route::get('/', 'ProductController@index')->name('index');
            Route::get('/create', 'ProductController@create')->name('create');
            Route::post('/store', 'ProductController@store')->name('store');
            Route::get('/{id}/edit', 'ProductController@edit')->name('edit');
            Route::get('/{id}/delete', 'ProductController@delete')->name('delete');
        });

        Route::group(['prefix' => 'loan','as' => 'loan.'], function() {
            Route::group(['as' => 'all-data.'], function() {
                Route::get('/all-data', 'LoanController@allData')->name('index');
                Route::get('{id}/show/{type}', 'LoanController@show')->name('show');
                Route::get('{id}/show/{type}/submit-transaction/{transaksi_id}/{status}', 'LoanController@submitTransaction')->name('submit');
            });

            Route::group(['as' => 'transaction.'], function() {
                Route::get('/transaction', 'LoanController@transaction')->name('index');
                Route::get('/transaction/{id}/submit/{status}', 'LoanController@transactionSubmit')->name('submit');
                Route::get('/{id}/edit-transaction', 'LoanController@editTransaction')->name('edit-transaction');
                Route::post('/{id}/update-transaction', 'LoanController@updateTransaction')->name('update-transaction');
            });
            
            Route::group(['as' => 'new.'], function() {
                Route::get('/new', 'LoanController@newLoan')->name('index');
                Route::get('/{id}/submit/{status}', 'LoanController@submit')->name('submit');
            });
        });
    });
});
