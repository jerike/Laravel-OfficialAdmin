<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder {

    public function run()
    {
        DB::table('menus')->delete();

        Menu::create([
            'id' => 1,
            'menu_navigation_id' => 1,
            'title' => '新聞',
            'link' => 'news',
            'rank' => 1,
            'target' => '_self',
        ]);

        Menu::create([
            'id' => 2,
            'menu_navigation_id' => 1,
            'title' => 'Banner',
            'link' => 'banner',
            'rank' => 2,
            'target' => '_self',
        ]);

        Menu::create([
            'id' => 3,
            'menu_navigation_id' => 1,
            'title' => 'APK連結',
            'link' => 'game-download-link',
            'rank' => 3,
            'target' => '_self',
        ]);

        Menu::create([
            'id' => 4,
            'menu_navigation_id' => 2,
            'title' => '使用者',
            'link' => 'user',
            'rank' => 5,
            'target' => '_self',
        ]);

        Menu::create([
            'id' => 5,
            'menu_navigation_id' => 2,
            'title' => '群組名稱',
            'link' => 'group',
            'rank' => 5,
            'target' => '_self',
        ]);

        Menu::create([
            'id' => 6,
            'menu_navigation_id' => 2,
            'title' => '群組權限',
            'link' => 'group-power',
            'rank' => 6,
            'target' => '_self',
        ]);

        Menu::create([
            'id' => 7,
            'menu_navigation_id' => 2,
            'title' => '後台次選單',
            'link' => 'menu',
            'rank' => 7,
            'target' => '_self',
        ]);
    }

}