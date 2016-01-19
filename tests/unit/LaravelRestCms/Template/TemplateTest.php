<?php

use App\LaravelRestCms\Template\Template;
use App\LaravelRestCms\Template\TemplateDetail;

class TemplateTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = Template::first();
    }

    public function testDetail()
    {
    	$this->assertTrue(
            $this->relationship($this->model, new TemplateDetail, 'detail', 'id', 'template_id')
        );
    }
}
