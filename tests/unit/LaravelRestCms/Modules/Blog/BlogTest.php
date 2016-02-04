<?php

use Modules\Blog\Blog;
use App\LaravelRestCms\Seo\Seo;

class BlogTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = Blog::first();
    }

    public function testShowBySlug()
    {
        $data = $this->model->showBySlug($this->model->url);

        $this->assertArrayHasKeys(['id', 'url', 'title', 'content', 'tags', 'published_on', 'seo', 'user'], $data);
    }
}