<?php

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

Route::group(['middleware' => 'prevent-back-history'],function(){
    Route::get('/', 'UserLoginController@index');
    Route::get('/register',function(){
    	return view('register');
    });
    Route::post('/login', ['as'=>'user.auth','uses'=>'UserLoginController@login']);
    Route::post('/login/add_client_info','UserLoginController@add_client_info');
    Route::get('/login/add_client_info','UserLoginController@add_client_info');
    
    Route::post('signup','UserLoginController@signup');
	Route::get('signup','UserLoginController@signup');
	Route::get('/logout','UserLoginController@logout');
	Route::get('/home','UserController@index');
			

	/***************************Form Ajax *******************************************/
	
	Route::get('/district/ajax/{id}',array('as'=>'addLocation.ajax','uses'=>'UserLoginController@getDistrict'));
	Route::get('/city/ajax/{id}',array('as'=>'addLocation.ajax','uses'=>'UserLoginController@getCity'));
	Route::get('/area/ajax/{id}',array('as'=>'addLocation.ajax','uses'=>'UserLoginController@getArea'));

	Route::get('/equipments/ajax/{id}',array('as'=>'requestCall.ajax','uses'=>'CustomController@getEquipments'));
	Route::get('/equDiscription/ajax/{id}',array('as'=>'requestCall.ajax','uses'=>'CustomController@getDiscription'));
	Route::get('/getEquipment/ajax/{id}',array('as'=>'manageDevice.ajax','uses'=>'CustomController@getEquipment'));
	Route::get('/dashboardPie/ajax/',array('as'=>'dashboard.ajax','uses'=>'CustomController@getPieChart'));
	Route::get('/dashboardDoughnut/ajax/',array('as'=>'dashboard.ajax','uses'=>'CustomController@getDoughnutChart'));
	Route::get('/dashboardBar/ajax/',array('as'=>'dashboard.ajax','uses'=>'CustomController@getBarChart'));
	/*****************************End**********************************************/

	/******************************Show Forms*************************************/
	Route::get('/home/dashboard/{token}','CustomerController@dashboard');
	Route::get('/home/requestCall/{token}','CustomerController@requestCall');
	Route::get('/home/manageCall/{token}','CustomerController@manageCall');
	Route::get('/home/callHistory/{token}','CustomerController@callHistory');
	Route::get('/home/placeOrder/{token}','CustomerController@placeOrder');
	Route::get('/home/productHistory/{token}','CustomerController@productHistory');
	Route::get('/home/addDevice/{token}','CustomerController@addDevice');
	Route::get('/home/manageDevice/{token}','CustomerController@manageDevice');
	Route::get('/home/profile/{token}','CustomerController@profile');
	Route::get('/home/changePassword/{token}','CustomerController@changePassword');
	Route::get('/home/addLocation/{token}','CustomerController@addLocation');
	/********************************End******************************************/

	/***********************Form Operations******************************************/
	Route::get('/home/requestCall/add','CustomController@addRequest');
	Route::post('/home/requestCall/add','CustomController@addRequest');

	Route::post('/home/changePassword/change','CustomController@changePassword');
	Route::get('/home/changePassword/change','CustomController@changePassword');

	Route::post('/home/addDevice/add','CustomController@addEquipment');
	Route::get('/home/addDevice/add','CustomController@addEquipment');

	Route::post('/home/addDevice/place','CustomController@placeOrder');
	Route::get('/home/addDevice/place','CustomController@placeOrder');

	Route::post('/home/addLocation/add','CustomController@addProfileLocation');
	Route::get('/home/addLocation/add','CustomController@addProfileLocation');

	Route::post('/home/addLocation/add','CustomController@addLocation');

	Route::post('/home/updateDevice/add','CustomController@updateEquipment');
	Route::get('/home/updateDevice/add','CustomController@updateEquipment');
	/*************************End************************************************/

	/**********************Password Reset***************************************/
	Route::get('/send', 'ResetPasswordController@sendLink');
    Route::post('password/sendLink', 'ResetPasswordController@sendLink');
    Route::get('password/sendLink', 'ResetPasswordController@sendLink');
    Route::post('password/reset/{token}', 'ResetPasswordController@showResetForm');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
    Route::get('password/reset', 'ResetPasswordController@reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
    /****************************End**********************************************/
});
