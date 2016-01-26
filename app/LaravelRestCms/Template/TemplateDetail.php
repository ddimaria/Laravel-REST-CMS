<?php namespace App\LaravelRestCms\Template;

use App\LaravelRestCms\BaseModel;

class TemplateDetail extends BaseModel {

	public static $searchCols = ['name', 'description', 'var'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'template_detail';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public static $types = [
		'wysiwyg' => 'HTML Editor',
		'image_picker' => 'Image Picker',
		'date_picker' => 'Date Picker',
		'select' => 'Select',
		'select_multiple' => 'Select Multiple',
		'text' => 'Text',
		'textarea' => 'Textarea',
		'repeater' => 'Repeating Group',
		'picker' => 'Picker',
		'info' => 'Info Box (Backend Only)',
	];

	/**
	 * Joins the parent table
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function parent()
	{
		return $this->hasMany(TemplateDetail::class, 'id', 'parent_id');
	}

}
