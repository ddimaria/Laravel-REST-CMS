<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_detail', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('template_detail_id')->unsigned();
            $table->string('data', 1000);
            $table->integer('group')->unsigned()->default(0);
            $table->integer('version')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('template_detail_id')->references('id')->on('template_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_detail', function (Blueprint $table) {
            $table->dropForeign('page_detail_page_id_foreign');
            $table->dropForeign('page_detail_template_detail_id_foreign');
        });

        Schema::drop('page_detail');
    }

}