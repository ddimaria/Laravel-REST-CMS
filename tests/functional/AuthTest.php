<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase {

	use DatabaseTransactions;
	
	/**
	 * Login, do this first
	 *
     * @covers App\Http\Controllers\Api\V1\UserController::authenticate
     * @covers App\LaravelRestCms\User\User::authenticate
     * @covers App\LaravelRestCms\User\UserTransformer::transform
	 */
	public function testLogin()
	{
		$response = $this->login();
		
		$this->assertEquals(200, $response->getStatusCode());
		$this->seeJsonContains([
             	"api_key" => Session::get('token')
         ]);
	}

	/**
	 * Logout
	 *
     * @covers App\Http\Controllers\Api\V1\UserController::deauthenticate
	 */
	public function testLogout()
	{
		$this->login();
		$response = $this->call('GET', static::$apiPath . '/user/logout/' . Session::get('token'));

        $this->assertEquals(200, $response->getStatusCode());
	}

}
