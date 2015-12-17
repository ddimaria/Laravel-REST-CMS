<?php 

namespace App\Http\Controllers\Api\V1;

use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\LaravelRestCms\User\User as User;
use Input;
use Validator;

class UserController extends ApiGuardController
{
    protected $modelName = 'App\LaravelRestCms\User\User';
    protected $transformerName = 'App\LaravelRestCms\User\UserTransformer';
    protected $collectionName = 'users';

    protected $apiMethods = [
        'authenticate' => [
            'keyAuthentication' => false
        ],
        'deauthenticate' => [
            'keyAuthentication' => false
        ]
    ];

    public function authenticate() 
    {
        $credentials['username'] = Input::get('username');
        $credentials['password'] = Input::get('password');
        
        $validator = Validator::make([
                'username' => $credentials['username'],
                'password' => $credentials['password']
            ],
            [
                'username' => 'required|max:255',
                'password' => 'required|max:255'
            ]
        );
        
        if ($validator->fails()) {
            return $this->response->errorWrongArgsValidator($validator);
        }

        try {
            $user                 = with(new User)->authenticate($credentials['username'], $credentials['password'])->first();
            $credentials['email'] = $user->email;
        } catch (\ErrorException $e) {
            return $this->response->errorUnauthorized("Your username or password is incorrect");
        }

        // We have validated this user
        // Assign an API key for this session
        $apiKey = ApiKey::where('user_id', '=', $user->id)->first();
        
        if (!isset($apiKey)) {
            $apiKey                = new ApiKey;
            $apiKey->user_id       = $user->id;
            $apiKey->key           = $apiKey->generateKey();
            $apiKey->level         = 5;
            $apiKey->ignore_limits = 0;
        } else {
            $apiKey->generateKey();
        }

        if (!$apiKey->save()) {
            return $this->response->errorInternalError("Failed to create an API key. Please try again.");
        }


        // We have an API key.. i guess we only need to return that.
        return $this->response->withItem($user, new \App\LaravelRestCms\User\UserTransformer);
    }

    public function getUserDetails() 
    {
        $user = $this->apiKey->user;

        return isset($user) ? $user : $this->response->errorNotFound();
    }

    public function deauthenticate($apiKey) 
    {
        $this->apiKey = ApiKey::where('key', $apiKey)->first();

        if (empty($this->apiKey)) {
            return $this->response->errorUnauthorized("There is no such user to deauthenticate.");
        }

        $this->apiKey->delete();

        return $this->response->withArray([
            'ok' => [
                'code'      => 'SUCCESSFUL',
                'http_code' => 200,
                'message'   => 'User was successfuly deauthenticated'
            ]
        ]);
    }
}