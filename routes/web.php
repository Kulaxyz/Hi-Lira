<?php

//Default routes
//Route::group(['prefix' => 'admin'], function () {
//    Voyager::routes();
//});

Auth::routes();

//ADMIN

Route::get('api_keys',			'AdminController@apiKeys')->middleware('can:edit-api')->name('api-keys');
Route::post('api_keys',			'AdminController@saveKeys')->middleware('can:edit-api')->name('save_api');

//APi
//Route::post('phone/callback',			'Auth\LoginController@createQuery');
//Route::post('phone/code',	 			'Auth\LoginController@checkQuery');
//
//Public pages
Route::view('/rules', 					'rules')					                ->name('rules');			//Rules page
Route::view('/reviews', 					'reviews')					            ->name('reviews');			//Reviews page
//Route::get('/media', 					'PublicController@media')					->name('media');			//Media page
//Route::get('/paper', 					'PublicController@paper')					->name('paper');			//Info
//Route::get('/learn', 					'PublicController@learn')					->name('learn');			//Learn page
Route::get('/', 						'PublicController@index')					->name('index');			//Learn page
Route::get('/referal/{referal}',		'PublicController@referalRegister')			->name('referalRegister');	//Referal page
Route::get('/privacy',					'PublicController@privacy') 				->name('privacy');

//For logined user
//Route::get('/history', 					'HomeController@history')					->name('history');
Route::get('wallet', 					'HomeController@wallet')					->name('wallet');			//Index, wallet, balance
Route::get('withdrawal', 				'HomeController@withdrawal')			    ->name('withdrawal');			//withdrawal
Route::post('withdrawal', 				'HomeController@withdrawalMake')			->name('withdrawal');			//withdrawal
Route::get('invest',					'HomeController@invest')					->name('invest');			//First stage paying
Route::get('history',					'HomeController@history')					->name('history');			//First stage paying
Route::get('referral',					'HomeController@referral')					->name('referral');			//Referal page
Route::get('team',					    'PublicController@team')					->name('team');			//Referal page
Route::get('tech',					    'PublicController@tech')					->name('tech');			//Referal page
Route::get('coefs',					    'HomeController@coefs')					    ->name('coefs');			//Referal page
Route::post('coefs',					'HomeController@coefsUpdate')				->name('coefs');			//Referal page
Route::get('get_balance',			    'HomeController@get_balance')				->name('get_balance');			//Referal page

//Payments
Route::post('module_status',			'PaymentController@moduleStatus')			->name('module_status');				//IPN callback
Route::get('/unitpay_result',			'PaymentController@unitpay_result')			->name('unitpay_result');   //UnitPay after-handler

Route::post('/pay/card/',				'PaymentController@card')					->name('card');				//IPN callback
Route::post('/pay/callback',			'PublicController@callback')				->name('callback');			//IPN

Route::post('/invest',					'PaymentController@get')					->name('get');				//Second stage paying
Route::post('/pay', 					'PaymentController@pay')					->name('pay');				//Create payment

Route::post('/pay/card/stripe', 		'PaymentController@stripe_card')			->name('stripe_card');		//Create Stripe payment
Route::post('/pay/moduleBank', 		    'PaymentController@payModuleBank')			->name('pay_module_bank');		//Create Stripe payment
 Route::get('/pay/card/stripe/result', 	'PaymentController@stripe_result')			->name('stripe_result');	//Stripe payment result page

Route::post('/pay/apple-pay', 			'PaymentController@apple_pay')				->name('apple_pay');		//Create apple payment
Route::post('/pay/apple-pay/result', 	'PaymentController@apple_pay_result')		->name('apple_pay_result');	//Apple payment result page
 Route::get('/pay/apple-pay/result', 	'PaymentController@apple_pay_get')			->name('apple_pay_get');	//Apple payment result page trap

 Route::get('/pay/not_applied', 		'PaymentController@payStatus_2')			->name('payStatus_2');		//Get payment status for cards and such stuff
 Route::get('/pay/{txt_id}', 			'PaymentController@payStatus')				->name('payStatus');		//Get payment status
Route::post('/gets', 					'HomeController@gets')						->name('gets');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// for testing and debug only!!!
//Route::get('/_info_user/{number}',		'AdminController@info_user');
//Route::get('/_delete_user/{number}',	'AdminController@delete_user');
//Route::get('/_make_admin/{number}',		'AdminController@make_admin');
//Route::get('/_unmake_admin/{number}',	'AdminController@unmake_admin');
//Route::get('/stripe-test', 			'PaymentController@stripe_card_test')		->name('stripe_card_test');
//Route::get('/apple-stripe-test', 		'PaymentController@apple_stripe_card_test')	->name('apple_stripe_card_test');
//Route::get('/viber_test',				'PublicController@viber_test')				->name('viber_test');
//Route::post('/viber_test',			'PublicController@viber_test')				->name('viber_test');
