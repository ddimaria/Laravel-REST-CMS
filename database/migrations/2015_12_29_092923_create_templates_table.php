<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('class', 250)->nullable();
            $table->string('method', 250)->nullable();
            $table->string('params', 250)->nullable();
            $table->string('template_name', 250)->nullable();
            $table->string('layout', 250)->default('default');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('templates');
    }

}
