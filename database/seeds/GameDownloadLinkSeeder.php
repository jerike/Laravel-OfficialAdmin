<?php

use Illuminate\Database\Seeder;
use App\Models\GameDownloadLink;

class GameDownloadLinkSeeder extends Seeder {

    public function run()
    {
        DB::table('game_download_links')->delete();

       
    }

}