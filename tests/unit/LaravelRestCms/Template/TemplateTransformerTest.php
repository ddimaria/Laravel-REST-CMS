<?php

use App\LaravelRestCms\Template\Template;
use App\LaravelRestCms\Template\TemplateDetail;
use App\LaravelRestCms\Template\TemplateDetailTransformer;
use App\LaravelRestCms\Template\TemplateTransformer;

class TemplateTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = Template::first();
    }

    public function testTransform()
    {
        $this->assertTrue(
            $this->transformGeneric($this->model, new TemplateTransformer)
        );
    }

    public function testIncludeDetail()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new TemplateTransformer, 'includeDetail')
        );
    }
}
