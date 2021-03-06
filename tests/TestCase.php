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

    public function relationship(App\LaravelRestCms\BaseModel $model, App\LaravelRestCms\BaseModel $related, $relatedName, $pk, $fk)
    {
        $modelCount = $model->{$relatedName}()->count();
        $relatedCount = $related::where($fk, $model->{$pk})->count();

        return ($modelCount == $relatedCount);
    }

    public function transformerCollection(App\LaravelRestCms\BaseModel $model, App\LaravelRestCms\BaseTransformer $transformer, $methodName)
    {
    	$collection = with($transformer)->{$methodName}($model);
        
        return $collection instanceof League\Fractal\Resource\Collection;
    }

    public function transformGeneric(App\LaravelRestCms\BaseModel $model, App\LaravelRestCms\BaseTransformer $transformer)
    {
        //$transformed = Mockery::mock($transformer)->transform($model);
        $collection = with($transformer)->transform($model);
        
        return is_array($collection) && count($collection);
    }

    /**
	 * Reports an error if $array does not have all of the specified keys.
	 * 
	 * @param array $expectedKeys
	 * @param array $actual
	 * @param string $message
	 * @param bool
	 */
	protected function assertArrayHasKeys(array $expectedKeys, array $actual, $message = '', $strict = false) 
	{
		$extraKeys = static::arrayHasKeys($actual, $expectedKeys);
		$this->assertEquals(array(), $extraKeys, $message);
		
		if ($strict) {
			$actualKeys = array_keys($actual);
			sort($expectedKeys);
			sort($actualKeys);
			$this->assertEquals($expectedKeys, $actualKeys, $message);
		}
	}

	/**
	 * Determine if the listed keys are in an array
	 *
	 * @param array $source
	 * @param array $keys
	 * @return array
	 */
	static public function arrayHasKeys($source, $keys, $strict = false) 
	{
		$missing = array();
		foreach ($keys as $key) {
			if (! array_key_exists($key, $source)) {
				$missing[] = $key;
			}
		}
		return $missing;
	}

}
