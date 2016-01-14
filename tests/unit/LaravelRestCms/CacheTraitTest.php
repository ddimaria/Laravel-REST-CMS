<?php

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CacheTraitTest extends TestCase {

	//use DatabaseTransactions;

	protected $traitlName = 'App\LaravelRestCms\CacheTrait';
	protected $modelName = 'App\LaravelRestCms\User\User';

	public function setUp()
    {
        parent::setUp();

        $this->model = $this->getMockForTrait($this->traitlName);
    }

    public function testBoot()
    {
    	$this->assertTrue(true);
    }

    public function testSavedEvent()
    {
        DB::transaction(function () {
            $user = factory(App\LaravelRestCms\User\User::class)->make();  

            \Cache::shouldReceive('forget')
                ->once()
                ->with(Mockery::any());
                
            \Cache::shouldReceive('put')
                ->once()
                ->with(Mockery::any(), $user, Mockery::any())
                ->andReturn(true);

            $user->save();

            DB::rollBack();
        });
    }

    public function testDeletingEvent()
    {
        DB::transaction(function () {
            $user = factory(App\LaravelRestCms\User\User::class)->make(); 
            $user->save();
            
            \Cache::shouldReceive('forget')
                ->once()
                ->with('users.id');

            $user->delete();

            DB::rollBack();
        });
    }

    public function testGetModelCache()
    {
    	$this->assertEquals($this->modelName, $this->model->getModelCache($this->modelName));
    }

    public function testGetCacheKey()
    {
    	$this->assertEquals('users.id', $this->model->getCacheKey($this->modelName));
    	$this->assertEquals('users.id', $this->model->getCacheKey($this->modelName, 'id'));
    }

    public function testCache()
    {
    	$data = [
			'col_1' => 'a',
			'col_2' => 'b',
		];

		$this->assertEquals($this->modelName, $this->model->cache($this->modelName, null, $data));
		$this->assertEquals($this->modelName, $this->model->cache($this->modelName, 'id', $data));
    }

    public function testGetCache()
    {
    	$model = $this->model;
		
		$data = [
			'col_1' => 'a',
			'col_2' => 'b',
		];
		
		\Cache::shouldReceive('get', 'forget')
	        ->once()
	        ->with('users.id')
	        ->andReturn($data);

	    \Cache::shouldReceive('put')
	        ->once()
	        ->with('users.id', $data, $model::$cacheTime)
	        ->andReturn(true);

		$this->model->cache($this->modelName, 'id', $data);
		$cache = $this->model->getCache($this->modelName, 'id');

		$this->assertEquals($cache, $data);
    }

}
