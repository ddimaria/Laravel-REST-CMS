<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\LaravelRestCms\Template\Template;

class TemplateTableSeeder extends Seeder {

    public function run()
    {
        DB::table('templates')->delete();

        Template::create(['name' => 'Home', 'class' => null, 'method' => null, 'params' => null, 'template_name' => 'home', 'layout' => 'default']);
    }

}