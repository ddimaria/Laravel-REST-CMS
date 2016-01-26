<?php

use App\LaravelRestCms\Page\Page;
use App\LaravelRestCms\Page\PageDetail;
use App\LaravelRestCms\Template\Template;

class PageTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = Page::first();
    }

    public function testDetail()
    {
    	$this->assertTrue(
            $this->relationship($this->model, new PageDetail, 'detail', 'id', 'page_id')
        );
    }

    public function testTemplate()
    {
        $this->assertTrue(
            $this->relationship($this->model, new Template, 'template', 'template_id', 'id')
        );
    }

    public function testParent()
    {
        $this->assertTrue(
            $this->relationship($this->model, new Page, 'parent', 'parent_id', 'id')
        );
    }

    public function testShowBySlug()
    {
        $data = $this->model->showBySlug($this->model->url);

        $this->assertArrayHasKeys(['nav_name', 'url', 'title', 'vars', 'template'], $data);
        $this->assertArrayHasKeys(['name', 'class', 'method', 'params', 'template_name', 'layout'], $data['template']);
    }
}