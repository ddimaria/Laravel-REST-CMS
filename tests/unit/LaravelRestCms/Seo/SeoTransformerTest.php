<?php

use App\LaravelRestCms\Seo\Seo;
use App\LaravelRestCms\Seo\SeoTransformer;

class SeoTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = Seo::first();
    }

    public function testTransform()
    {
        $this->assertTrue(
            $this->transformGeneric($this->model, new SeoTransformer)
        );
    }
}
