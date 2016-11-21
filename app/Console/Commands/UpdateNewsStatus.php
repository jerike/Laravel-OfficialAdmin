<?php

namespace App\Console\Commands;

use App\Models\NewsPublish;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateNewsStatus extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'update_news_status';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'update_news_status';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		echo date('Y-m-d H:i:s')." start\r\n";
		$news_publishes = NewsPublish::where('show_time', '<=', date('Y-m-d H:i:s'))->where('status', 'waiting')->get();

		foreach ($news_publishes as $news_publish) {
			$news_publish->status = 'ready';
			$news_publish->save();

			if ($news_publish->news()->where('status', 2)->get()->isEmpty()) {
				$news_publish->status = 'fail';
				$news_publish->save();
				continue;
			}

			DB::transaction(function() use ($news_publish) {
				$news_publish->news()->where('status', 2)->update(['status' => 1]);

				$news_publish->status = 'success';
				$news_publish->save();
			});
		}


		echo date('Y-m-d H:i:s') . " end\r\n";
	}

}
