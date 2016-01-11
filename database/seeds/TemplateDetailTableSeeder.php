<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\LaravelRestCms\Template\TemplateDetail;

class TemplateDetailTableSeeder extends Seeder {

    public function run()
    {
        DB::table('template_detail')->delete();

        TemplateDetail::create(['parent_id' => null, 'template_id' => 1, 'name' => 'Main Content', 'description' => null, 'var' => 'main_content', 'type' => 'wysiwyg', 'data' => null]);
    }

}