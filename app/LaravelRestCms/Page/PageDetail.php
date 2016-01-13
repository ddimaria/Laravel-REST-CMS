<?php namespace App\LaravelRestCms\Page;

use App\LaravelRestCms\BaseModel;

class PageDetail extends BaseModel {

	public static $searchCols = ['data'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'page_detail';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}
