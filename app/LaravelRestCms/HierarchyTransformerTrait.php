<?php namespace App\LaravelRestCms;

trait HierarchyTransformerTrait {

	/**
	 * The transformer of the parent (usually itself)
	 * 
	 * @var string
	 */
	protected $parentTransformer;

	/**
	 * Sets instance vars and adds includes
	 * 
	 * @param  string $parentTransformer 
	 * @param  string $method            
	 */
	protected function setupHierarchy($parentTransformer, $method = 'parent')
	{
		$this->parentTransformer = $parentTransformer;
		parent::addToIncludes($method);
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