<?php namespace Modules\Blog;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\Page\PageDetail;
use App\LaravelRestCms\Seo\Seo;
use App\LaravelRestCms\Template\Template;
use App\LaravelRestCms\User\User;

class Blog extends BaseModel {

	public static $searchCols = ['url', 'title'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blogs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['url', 'title', 'created_by', 'updated_by'];

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
		'url' => 'required|unique:pages',
		'title' => 'required',
		'created_by' => 'integer',
		'updated_by' => 'integer',
	];

	/**
	 * Indicates if the model should be attributed with created_by and updated_by
	 * 
	* @var bool
	 */
	public $attirbution = true;

	/**
	 * Joins the seo table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function seo()
    {
        return $this->hasMany(Seo::class, 'id', 'seo_id');
    }

	/**
	 * Joins the user table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function user()
    {
        return $this->hasMany(User::class, 'id', 'created_by');
    }

    /**
     * Returns a page and associated detail and template data
     * 
     * @param  string $slug
     * @return array
     */
    public function showBySlug($slug)
    {        
        $data = Page::where(['url' => $slug])->firstOrFail();
        
        return $this->package($data);
    }

    /**
     * Pacages a collection into an array for public consumption
     * 
     * @param  Page   $data 
     * @return array
     */
    protected function package(Page $data)
    {
    	
    }
}
