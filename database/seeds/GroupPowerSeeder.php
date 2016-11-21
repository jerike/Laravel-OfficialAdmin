<?php

use Illuminate\Database\Seeder;
use App\Models\GroupPower;

class GroupPowerSeeder extends Seeder {

    public function run()
    {
        DB::table('group_powers')->delete();

        GroupPower::create([
            'group_id' => 1,
            'menu_navigation_id' => 1,
            'menu_id' => 1,
        ]);

        GroupPower::create([
            'group_id' => 1,
            'menu_navigation_id' => 1,
            'menu_id' => 2,
        ]);

        GroupPower::create([
            'group_id' => 1,
            'menu_navigation_id' => 1,
            'menu_id' => 3,
        ]);

        GroupPower::create([
            'group_id' => 1,
            'menu_navigation_id' => 2,
            'menu_id' => 4,
        ]);

        GroupPower::create([
            'group_id' => 1,
            'menu_navigation_id' => 2,
            'menu_id' => 5,
        ]);

        GroupPower::create([
            'group_id' => 1,
            'menu_navigation_id' => 2,
            'menu_id' => 6,
        ]);

        GroupPower::create([
            'group_id' => 1,
            'menu_navigation_id' => 2,
            'menu_id' => 7,
        ]);
    }

}