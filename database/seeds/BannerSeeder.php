<?php

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder {

    public function run()
    {
        DB::table('banners')->delete();

        
    }

}