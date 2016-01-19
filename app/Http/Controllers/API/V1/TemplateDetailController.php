<?php 

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\ApiController;
use App\LaravelRestCms\Page\TemplateDetail as TemplateDetail;

class TemplateDetailController extends ApiController
{
	/**
	 * The name of the model to use for this package
	 * 
	 * @var string
	 */
	protected $modelName = \App\LaravelRestCms\Page\TemplateDetail::class;
    
	/**
	 * The name of the transformer to use for this package
	 * 
	 * @var string
	 */
	protected $transformerName = \App\LaravelRestCms\Page\TemplateDetailTransformer::class;
    
	/**
	 * The key to use as a key for this collection in the output
	 * 
	 * @var string
	 */
	protected $collectionName = 'template_detail';

}