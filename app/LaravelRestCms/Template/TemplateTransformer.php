<?php namespace App\LaravelRestCms\Template;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\BaseTransformer;

class TemplateTransformer extends BaseTransformer {

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'detail',
	];

    /**
     * Transforms a Page model
     * 
     * @param  \App\LaravelRestCms\BaseModel $page
     * @return array
     
    public function transform(BaseModel $page)
    {
        return [
            'id' => (int) $page->id,
            'parent_id' => (int)$page->parent_id,
            'template_id' => (int) $page->template_id,
            'nav_name' => $page->nav_name,
            'url' => $page->url,
            'title' => $page->title,
        ];
    }
*/
    /**
     * Include Template Detail
     * 
     * @param \App\LaravelRestCms\Template\Template $template
     * @return \League\Fractal\ItemResource
     */
    public function includeDetail(Template $template)
    {
        return $this->collection($template->detail, new TemplateDetailTransformer);
    }
}
