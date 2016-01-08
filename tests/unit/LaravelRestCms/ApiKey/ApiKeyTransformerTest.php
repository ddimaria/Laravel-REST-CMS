<?php

use App\LaravelRestCms\ApiKey\ApiKey;
use App\LaravelRestCms\ApiKey\ApiKeyTransformer;

class ApiKeyTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();
    }

    public function testTransform()
    {
    	$apiKeyTransformer = new ApiKeyTransformer();
        $apiKeyArray = [
            'key' => bcrypt(str_random(10)),
            'level' => rand(1, 9),
        ];
        $apiKey = factory(App\LaravelRestCms\ApiKey\ApiKey::class)->make($apiKeyArray);        
        
        $this->assertEquals($apiKeyArray, $apiKeyTransformer->transform($apiKey));
    }
}
