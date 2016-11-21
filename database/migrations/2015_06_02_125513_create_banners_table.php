<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('img_path');
            $table->integer('rank')->default(0)->unsigned()->index();
            $table->string('url');
            $table->tinyInteger('status')->default(0)->unsigned()->index();
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
        Schema::drop('banners');
    }

}
