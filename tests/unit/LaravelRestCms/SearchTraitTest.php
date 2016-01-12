<?php

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\User\User;

class SearchTraitTest extends TestCase {

	protected $traitlName = 'App\LaravelRestCms\SearchTrait';
	protected $modelName = 'App\LaravelRestCms\User\User';

	public function setUp()
    {
        parent::setUp();

        $this->model = User::find(1);
        User::$labelCol = ['first_name', 'last_name'];
        User::$searchCols = ['first_name', 'last_name'];
    }

    public function testAddSearch()
    {
    	$model = $this->model->addSearch('a');
		$expected = 'select * from `users` where (`first_name` like ? or `last_name` like ?)';
    	
    	$this->assertEquals($expected, $model->toSql());

    	User::$searchCols = null;
    	User::$labelCol = null;
    	$model = $this->model->addSearch('a');
		$expected = 'select * from `users`';
    	$this->assertEquals($expected, $model->toSql());
    }

    public function testGetSearchCols()
    {
    	$this->assertEquals(['first_name', 'last_name'], $this->model->getSearchCols());
    	$this->assertEquals(['first_name'], $this->model->getSearchCols(['first_name']));

    	User::$searchCols = null;    	
    	$this->assertEquals(['first_name', 'last_name'], $this->model->getSearchCols());
    	
    	User::$labelCol = null; 
    	$this->assertEquals(['first_name'], $this->model->getSearchCols(null, ['first_name']));

    	$this->assertEquals(false, $this->model->getSearchCols());
    }

    public function testScopeSearch()
    {
    	$expected = 'select * from `users` where MATCH(first_name) AGAINST (? IN BOOLEAN MODE) and MATCH(last_name) AGAINST (? IN BOOLEAN MODE) order by MATCH(last_name) AGAINST (? IN BOOLEAN MODE) desc';
    	
    	$this->assertEquals($expected, $this->model->scopeSearch($this->model)->toSql());
    }

}
