<?php

use Illuminate\Database\Seeder;
use App\Models\NewsCategory;

class NewsCategorySeeder extends Seeder {

    public function run()
    {
        DB::table('news_categories')->delete();

        NewsCategory::create([
            'id' => 1,
            'name' => '活動',
        ]);

        NewsCategory::create([
            'id' => 2,
            'name' => '更新',
        ]);

        NewsCategory::create([
            'id' => 3,
            'name' => '系統',
        ]);

    }

}