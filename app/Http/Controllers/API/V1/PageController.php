<?php 

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\ApiController;
use App\LaravelRestCms\Page\Page as Page;

class PageController extends ApiController
{
	/**
	 * The name of the model to use for this package
	 * 
	 * @var string
	 */
	protected $modelName = \App\LaravelRestCms\Page\Page::class;
    
	/**
	 * The name of the transformer to use for this package
	 * 
	 * @var string
	 */
	protected $transformerName = \App\LaravelRestCms\Page\PageTransformer::class;
    
	/**
	 * The key to use as a key for this collection in the output
	 * 
	 * @var string
	 */
	protected $collectionName = 'pages';

    /**
     * Returns a page and associated detail and template data
     * 
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showWithDetail($id)
    {        
        $this->manager->parseIncludes([
        	'detail',
        	'detail.template_detail',
        ]);

        return $this->show($id);
    }

}