<?php

use App\LaravelRestCms\Page\PageDetail;
use App\LaravelRestCms\Page\PageDetailTransformer;

class PageDetailTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = PageDetail::first();
    }

    public function testTransform()
    {
        $this->assertTrue(
            $this->transformGeneric($this->model, new PageDetailTransformer)
        );
    }

    public function testIncludeTemplateDetail()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new PageDetailTransformer, 'includeTemplateDetail')
        );
    }
}
