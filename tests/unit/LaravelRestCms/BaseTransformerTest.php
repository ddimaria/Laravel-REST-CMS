<?php

use App\LaravelRestCms\BaseTransformer;
use App\LaravelRestCms\User\UserTransformer;

class BaseTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();
    }

    /**
     * @covers \App\LaravelRestCms\BaseTransformer::transform
     */
    public function testTransform()
    {
        $this->user = factory(App\LaravelRestCms\User\User::class)->make(); 

		$this->assertTrue(
            $this->transformGeneric($this->user, new BaseTransformer)
        );
    }

}
