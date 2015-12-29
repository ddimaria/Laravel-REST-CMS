<?php namespace App\LaravelRestCms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseModel extends Model {

	use CacheTrait;
	use ValidatesRequests;

	/**
	 * @var \Validator
	 */
	protected $validation;

	/**
	 * Validates a model
	 * 
	 * @param  array  	$data     
	 * @param  boolean 	$isUpdate 
	 * @return boolean            
	 */
	public function validate($data, $isUpdate = false)
	{
		if ($isUpdate) {
			$rules = static::$updateRules;
		} else {
			$rules = static::$createRules;
		}

		$this->validation = \Validator::make($data, $rules);
		
		return $this->validation->passes();
	}
	
	/**
	 * Gets the table name of the model.
	 * Override this for custom names to be used in the caching engine.
	 * 
	 * @return string
	 */
	public function getTable()
	{
		return $this->table;
	}

	/**
	 * General message handling that outputs to the log, slack and directly to the stream
	 * 
	 * @param  string $message 
	 */
	public function output($message)
	{
		$message = '`[' . strtoupper(app('env')) . ']` ' . $message;
		$messageClean = str_replace('`', '', $message);

		try {
			\Slack::send($message);
		} catch (\Exception $e) {
			print $e->getMessage();
		}
		
		try {
			\Log::warning($messageClean);
		} catch (\Exception $e) {
			print $e->getMessage();
		}

		if (\App::runningInConsole()) {
			print $messageClean . "\n";
		}
	}
}