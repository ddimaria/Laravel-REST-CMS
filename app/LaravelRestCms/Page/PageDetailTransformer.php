<?php namespace App\LaravelRestCms\Page;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\BaseTransformer;
use App\LaravelRestCms\Page\PageDetail;
use App\LaravelRestCms\Template\TemplateDetailTransformer;

class PageDetailTransformer extends BaseTransformer {

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'template_detail'
	];

    /**
     * Include Template Detail
     *
     * @return \League\Fractal\ItemResource
     */
    public function includeTemplateDetail(PageDetail $pageDetail)
    {
        return $this->collection($pageDetail->templateDetail, new TemplateDetailTransformer);
    }
}