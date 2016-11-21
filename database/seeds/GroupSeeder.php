<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder {

    public function run()
    {
        DB::table('groups')->delete();

        Group::create([
            'id' => 1,
            'title' => '技術部'
        ]);

        Group::create([
            'id' => 2,
            'title' => '營運部'
        ]);
    }

}