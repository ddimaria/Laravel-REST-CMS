<?php

use App\LaravelRestCms\Template\TemplateDetail;
use App\LaravelRestCms\Template\TemplateDetailTransformer;

class TemplateDetailTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = TemplateDetail::first();
    }

     public function testTransform()
    {
        $this->assertTrue(
            $this->transformGeneric($this->model, new TemplateDetailTransformer)
        );
    }
}
