<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsPublishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_publishes', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('news_id')->unsigned();
            $table->dateTime('show_time');
            $table->enum('status', ['waiting' ,'ready', 'success', 'fail'])->default('waiting');
            $table->timestamps();
        });

        Schema::table('news_publishes', function(Blueprint $table) {
            $table->foreign('news_id')->references('id')->on('news')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('news_publishes', function(Blueprint $table) {
            $table->dropForeign('news_publishes_news_id_foreign');
        });

		Schema::drop('news_publishes');
	}

}
