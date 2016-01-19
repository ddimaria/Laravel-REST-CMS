<?php namespace App\LaravelRestCms\Template;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\Template\TemplateDetail;

class Template extends BaseModel {

	public static $searchCols = ['name', 'class'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'templates';

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

	/**
	 * Rules to validate when creating a model
	 * 
	* @var array
	 */
	protected static $createRules = [	
		'parent_id' => 'integer',
		'template_id' => 'integer',
		'nav_name' => 'required',
		'url' => 'required|unique:pages',
		'title' => 'required',
		'created_by' => 'integer',
		'updated_by' => 'integer',
	];

	/**
	 * Joins the page_detail table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function detail()
    {
        return $this->hasMany(TemplateDetail::class, 'template_id', 'id');
    }
    
}
