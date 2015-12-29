<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('template_id')->unsigned();
            $table->integer('seo_id')->unsigned();
            $table->string('nav_name', 250);
            $table->string('url', 250);
            $table->string('title', 250);
            $table->integer('sort')->unsigned()->default(9999999);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('pages');
            $table->foreign('template_id')->references('id')->on('templates');
            $table->foreign('seo_id')->references('id')->on('seo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_parent_id_foreign');
            $table->dropForeign('pages_template_id_foreign');
            $table->dropForeign('pages_seo_id_foreign');
        });

        Schema::drop('pages');
    }

}
