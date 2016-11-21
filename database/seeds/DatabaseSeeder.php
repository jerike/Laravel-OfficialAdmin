<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('GameDownloadLinkSeeder');
                $this->call('MenuNavigationSeeder');
                $this->call('MenuSeeder');
                $this->call('NewsCategorySeeder');
                $this->call('NewsSeeder');
                $this->call('GroupSeeder');
                $this->call('UserSeeder');
                $this->call('GroupPowerSeeder');
                $this->call('BannerSeeder');
	}

}
