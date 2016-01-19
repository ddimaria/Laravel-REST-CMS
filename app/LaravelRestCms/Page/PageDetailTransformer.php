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
     * Transforms a Page model
     * 
     * @param  \App\LaravelRestCms\BaseModel $pageDetail
     * @return array
     */
    public function transform(BaseModel $pageDetail)
    {
        return [
            'id' => (int) $pageDetail->id,
            'page_id' => (int) $pageDetail->page_id,
            'template_detail_id' => (int) $pageDetail->template_detail_id,
            'data' => $pageDetail->data,
            'group' => $pageDetail->group,
            'version' => $pageDetail->version,
        ];
    }

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