<?php

use Modules\Blog\Blog;
use Modules\Blog\BlogTransformer;

class BlogTransformerTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = Blog::first();
    }

    public function testIncludeSeo()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new BlogTransformer, 'includeSeo')
        );
    }

    public function testIncludeUser()
    {   
        $this->assertTrue(
            $this->transformerCollection($this->model, new BlogTransformer, 'includeUser')
        );
    }
}
