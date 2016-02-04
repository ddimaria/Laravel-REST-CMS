<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Blog\Blog;

class BlogRouteTest extends TestCase {

	//use DatabaseTransactions;
	use WithoutMiddleware;

	public function setUp()
    {
        parent::setUp();

        $this->model = Blog::first();
    }
	
	/**
	 * @covers Modules\Blog\BlogController::showBySlug
	 */
	public function testBlogItem()
	{
		$response = $this->callWithValidToken('GET', static::$apiPath . '/blog/' . $this->model->url);

		$data = json_decode($response->getContent(), true);

		$this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKeys(['id', 'url', 'title', 'content', 'tags', 'published_on', 'seo', 'user'], $data);
	}
	
	/**
	 * @covers Modules\Blog\BlogController::showBySlug
	 */
	public function testBlogItemInvalidSlug()
	{
		$response = $this->callWithValidToken('GET', static::$apiPath . '/blog/1234567890!@#$%^&*()_+' . $this->model->url);

		$this->assertEquals(404, $response->getStatusCode());
	}

}
