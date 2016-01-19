<?php

use App\LaravelRestCms\Template\TemplateDetail;

class TemplateDetailTest extends TestCase {

	public function setUp()
    {
        parent::setUp();

        $this->model = TemplateDetail::first();
    }

    public function testTemplateDetail()
    {
    	$this->assertTrue(
            $this->relationship($this->model, new TemplateDetail, 'parent', 'parent_id', 'id')
        );
    }
}
