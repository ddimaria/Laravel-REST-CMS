<?php

use App\LaravelRestCms\Page\Page;
use App\LaravelRestCms\Page\PageTransformer;

class PageTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = Page::first();
    }

    public function testTransform()
    {
        $this->assertTrue(
            $this->transformGeneric($this->model, new PageTransformer)
        );
    }

    public function testIncludeDetail()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new PageTransformer, 'includeDetail')
        );
    }

    public function testIncludeTemplate()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new PageTransformer, 'includeTemplate')
        );
    }

    public function testIncludeParent()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new PageTransformer, 'includeParent')
        );
    }

    public function testIncludeSeo()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new PageTransformer, 'includeSeo')
        );
    }
}
