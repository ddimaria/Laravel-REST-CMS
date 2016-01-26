<?php namespace App\LaravelRestCms\Seo;

use App\LaravelRestCms\BaseModel;

class Seo extends BaseModel {

	public static $searchCols = ['title', 'keywords', 'description'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'seo';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 
		'keywords', 
		'description',
		'og_title',
		'og_description',
		'og_image',
		'og_type',
		'fb_app_id',
		'meta',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * Rules to validate when creating a model
	 * 
	* @var array
	 */
	protected static $createRules = [		
		'title' => 'required',	
		'keywords' => 'required',	
		'description' => 'required',
	];
    
}
