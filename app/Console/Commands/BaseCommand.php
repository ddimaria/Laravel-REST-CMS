<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BaseCommand extends Command {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function output($message, $sendToSlack = true)
	{
		$message = '`[' . strtoupper(app('env')) . ']` ' . $message;
		
		$this->info(str_replace('`', '', $message));

		if ($sendToSlack) {
			\Slack::send($message);
		}
	}
}
