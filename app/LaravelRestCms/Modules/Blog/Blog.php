<?php namespace Modules\Blog;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\Seo\Seo;
use App\LaravelRestCms\Seo\SeoTransformer;
use App\LaravelRestCms\User\User;
use App\LaravelRestCms\User\UserTransformer;
use Modules\Blog\BlogTransformer;

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
        return $this->hasOne(Seo::class, 'id', 'seo_id');
    }

	/**
	 * Joins the user table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * Returns a blog and associated detail and template data
     * 
     * @param  string $slug
     * @return array
     */
    public function showBySlug($slug)
    {        
        $data = Blog::where(['url' => $slug])->firstOrFail();
        
        return $this->package($data);
    }

    /**
     * Pacages a collection into an array for public consumption
     * 
     * @param  Blog   $data 
     * @return array
     */
    protected function package(Blog $data)
    {
    	$blog = with(new BlogTransformer)->transform($data);
    	$blog['seo'] = with(new SeoTransformer)->transform($data->seo);
    	$blog['user'] = with(new UserTransformer)->transform($data->user);

        return $blog;
    }
}
