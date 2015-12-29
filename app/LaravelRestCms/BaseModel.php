<?php namespace App\LaravelRestCms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseModel extends Model {

	use CacheTrait;
	use ValidatesRequests;

	
	/**
	 * The table name
	 * 
	 * @var string
	 */
	protected $table;
	
	/**
	 * The singular version of the table name
	 * 
	 * @var string
	 */
	protected $singular;
	
	/**
	 * The plural version of the table name
	 * 
	* @var string
	 */
	protected $plural;

	/**
	 * The Validator object
	 * 
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
	 * Retrieves the singular name of the table
	 * 
	 * @param  boolean $format
	 * @return string
	 */
	public function getSingular($format = false)
	{
		if (!isset($this->singular)) {
			$this->singular = \Pluralizer::singular($this->table);
		}

		return $format ? $this->formatTableName($this->singular) : $this->singular;
	}	
	
	/**
	 * Retrieves the plural name of the table
	 * 
	 * @param  boolean $format
	 * @return string
	 */
	public function getPlural($format = false)
	{
		if (!isset($this->plural)) {
			$this->plural = \Pluralizer::plural($this->table);
		}

		return $format ? $this->formatTableName($this->plural) : $this->plural;
	}
	
	/**
	 * Formats the table name into a human readable format
	 * 
	 * @param  string $name
	 * @return string
	 */
	public static function formatTableName($name)
	{
		return ucwords(str_replace('_', ' ', $name));
	}
}