<?php

use App\LaravelRestCms\User\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase {
	
	/**
     * The api path to use
     *
     * @var string
     */
    protected static $apiPath = '/api/v1';

	/**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

	/**
     * The auth token
     *
     * @var string
     */
    protected $token;

	/**
     * The user to use for most tests
     *
     * @var App\LaravelRestCms\User\User
     */
    protected $user;

	/**
     * The auth token
     *
     * @var bool
     */
    protected $requiresToken = true;

    public function setUp()
    {
        parent::setUp();
        
        //$this->resetEvents();
    }

	/**
	 * Standard tearDown method
	 */
    public function tearDown()
    {
        Mockery::close();
    }

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 * @expectedException InvalidArgumentException
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}

	/**
	 * Overrides a normal call() method to inject a valid Auth Token
	 * 
	 * @param  string  $method
	 * @param  string  $uri
	 * @param  array   $parameters
	 * @param  array   $cookies
	 * @param  array   $files
	 * @param  array   $server
	 * @param  string  $content
	 * @return \Illuminate\Http\Response
	 */
	protected function callWithValidToken($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
	{
        if ($this->requiresToken) {
        	$this->login();
        }
     
        return $this->call($method, $uri, $parameters, $cookies, $files, array_merge($server, ['X-Authorization' => Session::get('token')]), $content);
	}

	/**
	 * Login, do this first
	 *
	 * @return void
	 * @return \Illuminate\Http\Response
	 */
	public function login()
	{
		if (is_null($this->user)) {

			$this->user = User::all()->first(); 
		}
		
		$response = $this->call('POST', static::$apiPath . '/user/login', ['username' => $this->user->username, 'password' => $this->user->password]);
		
		$token = json_decode($response->getContent())->data->api_key;
		$this->session(['token' => $token]);

		return $response;
	}

	/**
 	 * getPrivateProperty
 	 *
 	 * @param 	string $className
 	 * @param 	string $propertyName
 	 * @return	ReflectionProperty
 	 */
	public function setPrivateProperty(&$object, $propertyName, $propertyValue) 
	{
		$reflector = new \ReflectionClass(get_class($object));
		$property = $reflector->getProperty($propertyName);
		$property->setAccessible(true);

		return $property->setValue($object, $propertyValue);
	}

	/**
	 * Call protected/private method of a class.
	 *
	 * @param object &$object    Instantiated object that we will run method on
	 * @param string $methodName Method name to call
	 * @param array  $parameters Array of parameters to pass into method
	 * @return mixed Method return
	 */
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
	    $reflection = new \ReflectionClass(get_class($object));
	    $method = $reflection->getMethod($methodName);
	    $method->setAccessible(true);

	    return $method->invokeArgs($object, $parameters);
	}

	private function resetEvents(){
        // Define the models that have event listeners.
        $models = ['App\LaravelRestCms\User\User'];

        // Reset their event listeners.
        foreach ($models as $model) {

            // Flush any existing listeners.
            call_user_func(array($model, 'flushEventListeners'));

            // Reregister them.
            call_user_func(array($model, 'boot'));
        }
    }
}
