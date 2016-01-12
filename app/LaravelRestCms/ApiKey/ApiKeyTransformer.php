<?php namespace App\LaravelRestCms\ApiKey;

use Chrisbjr\ApiGuard\Models\ApiKey as ApiGuardApiKey;
use League\Fractal\TransformerAbstract;

class ApiKeyTransformer extends TransformerAbstract {

	/**
	 * Perform transformations on the data
	 * 
	 * @param  ApiKey $apiKey Eloquent collection
	 * @return array
	 */
	public function transform(ApiGuardApiKey $apiKey)
	{
		return [
			'key'   => $apiKey->key,
			'level' => $apiKey->level,
		];
	}
}