<?php namespace App\LaravelRestCms;

use App\LaravelRestCms\BaseTransformer;

trait HierarchyTransformerTrait {
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        parent::addToIncludes('parent');
    }

    /**
     * Include Parent
     * 
     * @param \App\LaravelRestCms\BaseModel
     * @return \League\Fractal\ItemResource
     */
    public function includeParent(BaseModel $model)
    {
        return $this->collection($model->parent, new $this->parentTransformer);
    }
    
}