<?php namespace App\LaravelRestCms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseModel extends Model {

	use ValidatesRequests;

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
	 * Output contents of an array
	 * 
	 * @param  array  	$array        
	 * @param  boolean 	$castKeyAsInt 
	 * @return array                
	 */
	public static function keyValue($array, $castValAsInt = false)
	{
		array_walk($array, function(&$val, $key) use ($castValAsInt){
            $val = $castValAsInt ? (int)$val : $val;
            $val = "{$val} {$key}";
        });

        return $array;
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

		\Slack::send($message);
		
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