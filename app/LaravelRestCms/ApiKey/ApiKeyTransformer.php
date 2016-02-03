<?php namespace App\LaravelRestCms\ApiKey;

use League\Fractal\TransformerAbstract;

class ApiKeyTransformer extends TransformerAbstract {

	/**
	 * Perform transformations on the data
	 * 
	 * @param  \Chrisbjr\ApiGuard\Models\ApiKey $apiKey Eloquent collection
	 * @return array
	 */
	public function transform(\Chrisbjr\ApiGuard\Models\ApiKey $apiKey)
	{
		return [
			'key'   => $apiKey->key,
			'level' => $apiKey->level,
		];
	}
}