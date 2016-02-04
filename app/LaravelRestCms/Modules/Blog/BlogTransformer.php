<?php namespace Modules\Blog;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\BaseTransformer;
use App\LaravelRestCms\HierarchyTransformerTrait;
use App\LaravelRestCms\Seo\Seo;
use App\LaravelRestCms\Seo\SeoTransformer;
use App\LaravelRestCms\User\UserTransformer;

class BlogTransformer extends BaseTransformer {

	use HierarchyTransformerTrait;

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
        'seo',
        'user',
	];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setupHierarchy(self::class, 'parent');
    }

    /**
     * Transforms a Blog model
     * 
     * @param  \App\LaravelRestCms\BaseModel $blog
     * @return array
     */
    public function transform(BaseModel $blog)
    {
        return [
            'id' => (int) $blog->id,
            'url' => $blog->url,
            'title' => $blog->title,
            'tags' => $blog->tags,
            'content' => $blog->content,
            'published_on' => $blog->published_on,
        ];
    }

    /**
     * Include Seo
     *
     * @param \App\LaravelRestCms\Blog\Blog
     * @return \League\Fractal\Resource\Collection
     */
    public function includeSeo(Blog $blog)
    {
        return $this->collection($blog->seo, new SeoTransformer);
    }

    /**
     * Include Seo
     *
     * @param \App\LaravelRestCms\Blog\Blog
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUser(Blog $blog)
    {
        return $this->collection($blog->user, new UserTransformer);
    }
}