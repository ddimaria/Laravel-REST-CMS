<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\LaravelRestCms\Seo\Seo;

class SeoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('seo')->delete();

        Seo::create(['title' => 'Welcome to the blog', 'keywords' => 'laravel, cms, blog', 'description' => 'Blogging about the web', 'og_title' => 'Welcome to the blog', 'og_description' => 'Blogging about the web']);
        Seo::create(['title' => 'Laravel REST CMS', 'keywords' => 'laravel,cms,rest', 'description' => 'Laravel REST CMS, a configurale cms for any situation', 'og_title' => 'Laravel REST CMS', 'og_description' => 'Laravel REST CMS, a configurale cms for any situation']);
        Seo::create(['title' => 'Laravel REST CMS API Docs', 'keywords' => 'laravel,cms,rest,api,docs', 'description' => 'Laravel REST CMS API Docs, documentation for public methods and attributes', 'og_title' => 'Laravel REST CMS API Docs', 'og_description' => 'Laravel REST CMS API Docs, documentation for public methods and attributes']);
    }

}