<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('valid-otp', [AuthController::class, 'validOTP']);

Route::group(['middleware' => 'auth:api'], function () {
	Route::group(['namespace' => 'App\Http\Controllers\API'], function() {

		Route::group(['prefix' => 'master'], function() {
			Route::get('/market', 'MasterController@market')->name('market');
			Route::get('/account-officer', 'MasterController@accountOfficer')->name('account-officer');
			Route::get('/bank', 'MasterController@bank')->name('bank');
			Route::get('/collateral', 'MasterController@collateral')->name('collateral');
			Route::get('/banner-promo', 'MasterController@bannerPromo')->name('banner-promo');
			Route::post('/store-mail-box', 'MasterController@storeMailBox')->name('store-mail-box');
		});

		Route::get('/info', 'UserController@info')->name('info');
		Route::post('/update', 'UserController@update')->name('update');

		Route::get('/product', 'ProductController@product')->name('product');
		Route::get('/product/{id_product}/detail', 'ProductController@detailProduct')->name('detail');
		Route::get('/category-product', 'ProductController@categoryProduct')->name('category-product');

		Route::get('/history-transaction', 'HistoryTransactionController@index')->name('history-transaction');
		
		Route::group(['prefix' => 'order'], function() {
			Route::post('/', 'OrderController@order')->name('order');
			Route::get('/list', 'OrderController@list')->name('list');
			Route::post('/{id}/confirm-payment', 'OrderController@confirmPayment')->name('confirm-payment');
			Route::get('/{id}/detail-order', 'OrderController@detailOrder')->name('detail-order');
			Route::post('/list-order', 'OrderController@listOrder')->name('list-order');
		});

		Route::group(['prefix' => 'account'], function() {
			Route::post('/save', 'AccountController@saveAccount')->name('save-account');
			Route::get('/list', 'AccountController@allAccount')->name('list');
			Route::get('/{account_type}/type', 'AccountController@accountType')->name('account-type');
		});

		Route::group(['prefix' => 'saving'], function() {
			Route::post('/', 'SavingController@saving')->name('saving');
			Route::get('/list', 'SavingController@listSaving')->name('list-saving');
			Route::get('/{type_id}/type', 'SavingController@savingType')->name('saving-type');
			Route::get('/{deposit_id}/saving-deposit-detail', 'SavingController@savingDepositDetail')->name('saving-deposit-detail');
			Route::get('/{deposit_id}/history-saving-deposit-transaction', 'SavingController@historySavingDepositTransaction')->name('history-saving-deposit-transaction');
		});

		Route::group(['prefix' => 'loan'], function() {
			Route::post('/', 'LoanController@store')->name('loan');
			Route::post('/store-bill-payment', 'LoanController@storeBillPayment')->name('store-bill-payment');
			Route::get('/list', 'LoanController@listLoan')->name('list-loan');
			Route::get('/{type_id}/type', 'LoanController@loanType')->name('loan-type');
			Route::get('/{loan_id}/loan-detail', 'LoanController@loanDetail')->name('loan-detail');
			Route::get('/{loan_id}/loan-list-financing', 'LoanController@loanListFinancing')->name('loan-list-financing');
		});


	});

	
});
