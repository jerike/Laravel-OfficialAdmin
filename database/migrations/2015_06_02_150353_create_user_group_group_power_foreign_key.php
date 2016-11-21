<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupGroupPowerForeignKey extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::table('group_powers', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('menu_navigation_id')->references('id')->on('menu_navigations')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_group_id_foreign');
        });

        Schema::table('group_powers', function(Blueprint $table) {
            $table->dropForeign('group_powers_group_id_foreign');
            $table->dropForeign('group_powers_menu_navigation_id_foreign');
            $table->dropForeign('group_powers_menu_id_foreign');
        });
    }

}
