<?php namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Generic extends BaseCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'generic';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Helper for running a Model\s method from an artisan command.';

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$data = \App::make($this->argument('model'))->{$this->argument('method')}($this->argument('arguments'));
		$output = (is_array($data) ? implode("\n", $data) : $data);		
		
		$this->output($output, false);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['model', InputArgument::REQUIRED, 'model name, with namespaces escaped (e.g. App\\\\LaravelRestCms\\\\SomeFolder\\\\SomeClass)'],
			['method', InputArgument::REQUIRED, 'method name'],
			['arguments'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		//	['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
