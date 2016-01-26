<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call(UserTableSeeder::class);
		$this->call(TemplateTableSeeder::class);
		$this->call(TemplateDetailTableSeeder::class);
		$this->call(PageTableSeeder::class);
        $this->call(PageDetailTableSeeder::class);
        $this->call(SeoTableSeeder::class);
	}

}
