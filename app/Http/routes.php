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

Route::pattern('id', '\d+');

// V1 API
Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function()
{
	// users/auth
	Route::post('user/login', 'UserController@authenticate');
	Route::get('user/logout/{api_key}', 'UserController@deauthenticate');

	// page
	Route::get('page/{id}', 'PageController@show');
	Route::get('page/{slug}', 'PageController@showBySlug');
	Route::post('page', 'PageController@create');
	Route::get('page/{id}/detail', 'PageController@showWithDetail');
	Route::get('pagedetail/{id}', 'PageDetailController@show');
	Route::post('pagedetail', 'PageDetailController@create');

	// template
	Route::get('template/{id}', 'TemplateController@show');
	Route::post('template', 'TemplateController@create');
	Route::get('template/{id}/detail', 'TemplateController@showWithDetail');
	Route::get('templatedetail/{id}', 'TemplateDetailController@show');
	Route::post('templatedetail', 'TemplateDetailController@create');
});

Route::any('{any}', function($route) 
{
	return \App\Http\Controllers\Api\V1\ApiController::respondNotFound('Invalid Route!');
})->where('any', '(.*)');