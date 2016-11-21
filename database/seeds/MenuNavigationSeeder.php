<?php

use Illuminate\Database\Seeder;
use App\Models\MenuNavigation;

class MenuNavigationSeeder extends Seeder {

    public function run()
    {
        DB::table('menu_navigations')->delete();

        MenuNavigation::create([
            'id' => 1,
            'rank' => 1,
            'title' => '網站管理',
        ]);

        MenuNavigation::create([
            'id' => 2,
            'rank' => 2,
            'title' => '後台系統',
        ]);

        MenuNavigation::create([
            'id' => 3,
            'rank' => 3,
            'title' => '活動管理',
        ]);

        MenuNavigation::create([
            'id' => 4,
            'rank' => 4,
            'title' => '序號管理',
        ]);
    }

}