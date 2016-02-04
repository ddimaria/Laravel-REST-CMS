<?php

Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function()
{
	Route::get('blog', '\Modules\Blog\BlogController@collection');
	Route::get('blog/{slug}', '\Modules\Blog\BlogController@showBySlug');
});