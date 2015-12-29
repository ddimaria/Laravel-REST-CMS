<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 250);
            $table->text('keywords');
            $table->text('description');
            $table->string('og_title', 250)->nullable();
            $table->string('og_description', 250)->nullable();
            $table->string('og_image', 250)->nullable();
            $table->string('og_type', 250)->nullable();
            $table->string('fb_app_id', 250)->nullable();
            $table->text('meta')->nullable();
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
        Schema::drop('seo');
    }

}
