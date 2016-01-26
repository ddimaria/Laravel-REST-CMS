<?php namespace App\LaravelRestCms\Seo;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\BaseTransformer;

class SeoTransformer extends BaseTransformer {

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [];

    /**
     * Transforms a Page model
     * 
     * @return array
     */
    public function transform(BaseModel $seo)
    {
        return [
            'id' => (int) $seo->id,
            'title' => $seo->title, 
            'keywords' => $seo->keywords, 
            'description' => $seo->description,
            'og_title' => $seo->og_title,
            'og_description' => $seo->og_description,
            'og_image' => $seo->og_image,
            'og_type' => $seo->og_type,
            'fb_app_id' => $seo->fb_app_id,
            'meta' => $seo->meta,
        ];
    }
}
