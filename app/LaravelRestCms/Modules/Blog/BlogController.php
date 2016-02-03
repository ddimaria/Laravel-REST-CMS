<?php namespace Modules\Blog;

use App\Http\Controllers\Api\V1\ApiController;
use Modules\Blog\Blog as Blog;

class BlogController extends ApiController
{
	/**
	 * The name of the model to use for this package
	 * 
	 * @var string
	 */
	protected $modelName = Blog::class;
    
	/**
	 * The name of the transformer to use for this package
	 * 
	 * @var string
	 */
	protected $transformerName = BlogTransformer::class;
    
	/**
	 * The key to use as a key for this collection in the output
	 * 
	 * @var string
	 */
	protected $collectionName = 'blogs';

	/**
	 * The methods that don't require api authentication
	 * 
	 * @var array
	 */
	protected $apiMethods = [];

	/**
	 * Returns a blog and associated detail and template data
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
	 * Returns a blog and associated detail and template data
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
			'seo',
			//'detail.template_detail.parent',
		]);

		return $this->show($id);
	}

}