<?php namespace App\LaravelRestCms\User;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
    ];

    /**
     * Transforms a User model
     * 
     * @param  User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'     => (int) @$user->id,
            'first_name' => @$user->first_name,
            'last_name' => @$user->last_name,
            'api_key' => @$user->apiKey->key,
            'version' => \Config::get('laravel-rest-cms.version'),
        ];
    }
}