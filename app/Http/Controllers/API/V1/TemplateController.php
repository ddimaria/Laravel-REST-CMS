<?php 

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\ApiController;
use App\LaravelRestCms\Template\Template as Template;

class TemplateController extends ApiController
{
	/**
	 * The name of the model to use for this package
	 * 
	 * @var string
	 */
	protected $modelName = \App\LaravelRestCms\Template\Template::class;
    
	/**
	 * The name of the transformer to use for this package
	 * 
	 * @var string
	 */
	protected $transformerName = \App\LaravelRestCms\Template\TemplateTransformer::class;
    
	/**
	 * The key to use as a key for this collection in the output
	 * 
	 * @var string
	 */
	protected $collectionName = 'templates';

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
        ]);

        return $this->show($id);
    }

}