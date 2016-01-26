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
     */
    public function transform(BaseModel $template)
    {
        return [
            'id' => (int) $template->id,
            'name' => $template->name,
            'class' => $template->class,
            'method' => $template->method,
            'params' => $template->params,
            'template_name' => $template->template_name,
            'layout' => $template->layout,
        ];
    }  
    
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
