<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('news_category_id')->unsigned();
            $table->string('title');
            $table->text('content');
            $table->string('og_image');
            $table->tinyInteger('status')->default(0)->unsigned()->index();
            $table->tinyInteger('top_status')->default(0)->unsigned()->index();
            $table->integer('rank')->default(0)->unsigned()->index();
            $table->integer('view')->default(0)->unsigned();
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
        Schema::drop('news');
    }

}
