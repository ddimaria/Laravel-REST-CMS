<?php namespace App\LaravelRestCms\Page;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\Page\PageDetail;
use App\LaravelRestCms\Template\Template;

class Page extends BaseModel {

	public static $searchCols = ['nav_name', 'url', 'title'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

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
	 * Joins the page_detail table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function detail()
    {
        return $this->hasMany(PageDetail::class, 'page_id', 'id');
    }

	/**
	 * Joins the templates table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function template()
    {
        return $this->hasMany(Template::class, 'id', 'template_id');
    }

}
