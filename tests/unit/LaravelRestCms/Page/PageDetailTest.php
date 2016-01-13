<?php

use App\LaravelRestCms\Page\PageDetail;
use App\LaravelRestCms\Template\TemplateDetail;

class PageDetailTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = PageDetail::first();
    }

    public function testTemplateDetail()
    {
    	$this->assertTrue(
            $this->relationship($this->model, new TemplateDetail, 'templateDetail', 'id', 'id')
        );
    }
}
