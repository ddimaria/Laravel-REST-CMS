<?php 

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\ApiController;
use App\LaravelRestCms\Page\PageDetail as PageDetail;

class PageDetailController extends ApiController
{
	/**
	 * The name of the model to use for this package
	 * 
	 * @var string
	 */
	protected $modelName = App\LaravelRestCms\Page\PageDetail::class;
    
	/**
	 * The name of the transformer to use for this package
	 * 
	 * @var string
	 */
	protected $transformerName = App\LaravelRestCms\Page\PageDetailTransformer::class;
    
	/**
	 * The key to use as a key for this collection in the output
	 * 
	 * @var string
	 */
	protected $collectionName = 'page_detail';

}