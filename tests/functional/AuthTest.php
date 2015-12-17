<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase {

	/**
	 * Login, do this first
	 *
	 * @return void
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
	 * @return void
	 */
	public function testLogout()
	{
		$this->login();
		$response = $this->call('GET', static::$apiPath . '/user/logout/' . Session::get('token'));

        $this->assertEquals(200, $response->getStatusCode());
	}

}
