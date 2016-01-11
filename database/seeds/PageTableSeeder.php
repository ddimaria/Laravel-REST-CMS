<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\LaravelRestCms\Page\Page;

class PageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->delete();

        Page::create(['parent_id' => null, 'template_id' => 1, 'seo_id' => null, 'nav_name' => 'Home', 'url' => 'home', 'title' => 'Home Page', 'sort' => 1]);
    }

}