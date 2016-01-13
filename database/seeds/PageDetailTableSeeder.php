<?php

use Illuminate\Database\Seeder;
use App\LaravelRestCms\Page\PageDetail;

class PageDetailTableSeeder extends Seeder {

    public function run()
    {
        DB::table('page_detail')->delete();

        PageDetail::create(['page_id' => 1, 'template_detail_id' => 1, 'data' => 'First page content']);
        PageDetail::create(['page_id' => 1, 'template_detail_id' => 2, 'data' => 'First page sub-content']);
    }

}