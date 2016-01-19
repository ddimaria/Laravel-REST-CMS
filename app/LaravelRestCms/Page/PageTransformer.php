<?php namespace App\LaravelRestCms\Page;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\BaseTransformer;
use App\LaravelRestCms\Page\Page;
use App\LaravelRestCms\Page\PageDetailTransformer;
use App\LaravelRestCms\Template\TemplateTransformer;

class PageTransformer extends BaseTransformer {

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'detail',
		'template',
        'parent',
	];

    /**
     * Transforms a Page model
     * 
     * @param  Page $page
     * @return array
     */
    public function transform(BaseModel $page)
    {
        return [
            'id' => (int) $page->id,
            'parent_id' => (int)$page->parent_id,
            'template_id' => $page->template_id,
            'nav_name' => $page->nav_name,
            'url' => $page->url,
            'title' => $page->title,
        ];
    }

    /**
     * Include Page Detail
     * 
     * @param \App\LaravelRestCms\Page\Page
     * @return \League\Fractal\ItemResource
     */
    public function includeDetail(Page $page)
    {
        return $this->collection($page->detail, new PageDetailTransformer);
    }

    /**
     * Include Template
     *
     * @param \App\LaravelRestCms\Page\Page
     * @return \League\Fractal\ItemResource
     */
    public function includeTemplate(Page $page)
    {
        return $this->collection($page->template, new TemplateTransformer);
    }

    /**
     * Include Page Parent
     * 
     * @param \App\LaravelRestCms\Page\Page
     * @return \League\Fractal\ItemResource
     */
    public function includeParent(Page $page)
    {
        return $this->collection($page->parent, new PageTransformer);
    }
}