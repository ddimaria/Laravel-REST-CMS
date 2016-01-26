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
	 * The methods that don't require api authentication
	 * 
	 * @var array
	 */
	protected $apiMethods = [
		'showBySlug' => [
			'keyAuthentication' => false
		],
	];

    /**
     * Returns a page and associated detail and template data
     * 
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function showBySlug($slug)
    {        
        try {
            return \Response::json($this->model->showBySlug($slug));
        
        } catch (\Exception $e) {

            return $this->respondNotFound();
        }
    }

    /**
     * Returns a page and associated detail and template data
     * 
     * @param  mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showWithDetail($id)
    {        
        $this->manager->parseIncludes([
        	'parent',
        	'detail',
        	'detail.template_detail',
        	'template',
        	//'detail.template_detail.parent',
        ]);

        return $this->show($id);
    }

}