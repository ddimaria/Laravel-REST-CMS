<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\LaravelRestCms\Seo\Seo;

class SeoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('seo')->delete();

        Seo::create(['title' => 'Welcome to the blog', 'keywords' => 'laravel, cms, blog', 'description' => 'Blogging about the web', 'og_title' => 'Welcome to the blog', 'og_description' => 'Blogging about the web']);
    }

}