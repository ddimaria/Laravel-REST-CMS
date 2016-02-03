<?php 

namespace App\LaravelRestCms\User;

use App\LaravelRestCms\BaseModel;

class UserLoginTransformer extends UserTransformer {

	/**
	 * Transforms a User model
	 * 
	 * @param  \App\LaravelRestCms\BaseModel $user
	 * @return array
	 */
	public function transform(BaseModel $user)
	{
		$data = parent::transform($user);
		$data['api_key'] = $user->apiKey->first()->key;

		return $data;
	}
}
