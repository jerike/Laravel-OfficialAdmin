<?php

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder {

    public function run()
    {
        DB::table('news')->delete();

        News::create([
            'id' => 1,
            'title' => 'Laravel Seeder 1',
            'content' => 'Laravel News Seeder Content',
            'news_category_id' => 1,
            'status' => 1,
            'top_status' => 0,
            'rank' => 0,
            'og_image' => 'http://www.jerike.com/assets/images/myphoto.jpg',
        ]);

        
    }

}