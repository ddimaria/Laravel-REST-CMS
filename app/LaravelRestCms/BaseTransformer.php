<?php namespace App\LaravelRestCms;

use App\LaravelRestCms\BaseModel;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract {

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [];

	/**
	 * Transforms a  model
	 * Be default, it exposes all attributes
	 * Overide this to hide attributes
	 * 
	 * @param  \App\LaravelRestCms\BaseModel $model
	 * @return array
	 */
	public function transform(BaseModel $model)
	{
		return $model->getAttributes();
	}

	/**
	 * Adds a item to the availIncludes array
	 * 
	 * @param string $include
	 */
	protected function addToIncludes($include)
	{
		if ( ! in_array($include, $this->availableIncludes)) {
			$this->availableIncludes[] = $include;
		}
	}
}