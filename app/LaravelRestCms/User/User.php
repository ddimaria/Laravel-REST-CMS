<?php namespace App\LaravelRestCms\User;

use App\LaravelRestCms\BaseModel;

class User extends BaseModel {

	public static $searchCols = ['first_name', 'last_name', 'email', 'username'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'username'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * Rules to validate when creating a model
	 * 
	* @var array
	 */
	protected static $createRules = [	
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required|email|unique:users',
		'username' => 'required|unique:users',
		'password' => 'required',
		//'created_by' => 'integer',
		//'updated_by' => 'integer',
	];

	/**
	 * Valiadate a user's login
	 * 
	 * @param  string $username 
	 * @param  string $password 
	 * @return \App\LaravelRestCms\BaseModel
	 */
	public function authenticate($username, $password)
	{
		return $this->where('username', $username)->where('password', $password)->get();
	}

	/**
	 * Relationship to the api_key table
	 * 
	 * @codeCoverageIgnore
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function apiKey()
	{
		return $this->hasOne('App\LaravelRestCms\ApiKey\ApiKey', 'user_id');
	} 

}
