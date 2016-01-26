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
        return $this->hasMany(Template::class, 'id', 'template_id');
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
     * Returns a page and associated detail and template data
     * 
     * @param  string $slug
     * @return array
     */
    public function showBySlug($slug)
    {        
        $data = Page::where(['url' => $slug])->with('detail.templateDetail')->firstOrFail();
        
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
    	$page = [
        	'nav_name' => $data->nav_name,
        	'url' => $data->url,
        	'title' => $data->title,
        	'vars' => []
        ];

        foreach ($data->detail as $detail) {
        	foreach ($detail->templateDetail as $template_detail) {
	        	$page['vars'][$template_detail->var] = $detail->data;
        	}
        }

        return $page;
    }
}
