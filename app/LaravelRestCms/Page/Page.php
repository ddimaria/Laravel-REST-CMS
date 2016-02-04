<?php namespace App\LaravelRestCms\Page;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\Page\PageDetail;
use App\LaravelRestCms\Page\PageDetailTransformer;
use App\LaravelRestCms\Page\PageTransformer;
use App\LaravelRestCms\Seo\Seo;
use App\LaravelRestCms\Seo\SeoTransformer;
use App\LaravelRestCms\Template\Template;
use App\LaravelRestCms\Template\TemplateTransformer;
use App\LaravelRestCms\User\User;
use App\LaravelRestCms\User\UserTransformer;

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
	protected $fillable = ['parent_id', 'template_id', 'nav_name', 'url', 'title', 'created_by', 'updated_by'];

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
	 * Indicates if the model should be attributed with created_by and updated_by
	 * 
	* @var bool
	 */
	public $attirbution = true;

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
        return $this->hasOne(Template::class, 'id', 'template_id');
    }

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
	 * Joins the pages table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function parent()
    {
        return $this->hasMany(Page::class, 'id', 'parent_id');
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
     * Returns a page and associated detail and template data
     * 
     * @param  string $slug
     * @return array
     */
    public function showBySlug($slug)
    {        
        $data = Page::where(['url' => $slug])->with('template', 'detail.templateDetail')->firstOrFail();
        
        return $this->packagePage($data);
    }

    /**
     * Pacages a Page collection into an array for public consumption
     * 
     * @param  Page   $data 
     * @return array
     */
    protected function packagePage(Page $data)
    {
    	$page = with(new PageTransformer)->transform($data);
    	$page['template'] = with(new TemplateTransformer)->transform($data->template);
    	$page['seo'] = with(new SeoTransformer)->transform($data->seo);
    	$page['user'] = with(new UserTransformer)->transform($data->user);
    	
        foreach ($data->detail as $detail) {
        	$page['vars'][$detail->templateDetail->first()->var] = $detail->data;
        }

        return $page;
    }
}
