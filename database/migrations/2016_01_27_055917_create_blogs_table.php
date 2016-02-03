<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('seo_id')->unsigned()->nullable();
            $table->string('url', 250);
            $table->string('title', 250);
            $table->text('content')->nullable();
            $table->text('tags')->nullable();
            $table->date('published_on')->nullable();
            $table->timestamps();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();

            $table->foreign('seo_id')->references('id')->on('seo')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign('blogs_seo_id_foreign');
            $table->dropForeign('blogs_created_by_foreign');
            $table->dropForeign('blogs_updated_by_foreign');
        });

        Schema::drop('blogs');
    }

}
