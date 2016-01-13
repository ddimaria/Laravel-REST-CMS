<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// V1 API
Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function()
{
	// users/auth
	Route::post('user/login', 'UserController@authenticate');
	Route::get('user/logout/{api_key}', 'UserController@deauthenticate');

	// page
	Route::get('page/{id}', 'PageController@show');
});