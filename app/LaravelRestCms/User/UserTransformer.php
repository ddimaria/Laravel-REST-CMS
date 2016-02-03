<?php namespace App\LaravelRestCms\User;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\ApiKey\ApiKeyTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'apiKey'
	];

	/**
	 * Transforms a User model
	 * 
	 * @param  \App\LaravelRestCms\BaseModel $user
	 * @return array
	 */
	public function transform(BaseModel $user)
	{
		return [
			'id'     => (int) $user->id,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'email' => $user->email,
			//'api_key' => $user->apiKey->key,
			//'version' => \Config::get('laravel-rest-cms.version'),
		];
	}

    /**
     * Include ApiKey
     *
     * @param \App\LaravelRestCms\User\User
     * @return \League\Fractal\Resource\Collection
     */
    public function includeApiKey(User $user)
    {
        return $this->collection($user->apiKey, new ApiKeyTransformer);
    }


}