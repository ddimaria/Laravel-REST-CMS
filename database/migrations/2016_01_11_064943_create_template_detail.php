<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_detail', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('template_id')->unsigned();
            $table->string('name', 250);
            $table->string('description', 250)->nullable();
            $table->string('var', 250);
            $table->string('type', 250);
            $table->string('data', 1000)->nullable();
            $table->integer('sort')->unsigned()->default(9999999);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('template_detail');
            $table->foreign('template_id')->references('id')->on('templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('template_detail');
    }

}