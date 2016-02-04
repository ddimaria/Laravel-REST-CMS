<?php

use App\LaravelRestCms\User\User;
use App\LaravelRestCms\User\UserTransformer;

class UserTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = User::first();
    }

    public function testIncludeApiKey()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new UserTransformer, 'includeApiKey')
        );
    }
}
