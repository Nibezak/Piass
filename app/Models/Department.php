<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	protected $fillable = ['name','descriptions','faculity_id','levels'];
	/**
	 * Relationship with Faculity model
	 * 
	 * @return  this
	 */
	public function faculity()
	{
		return $this->belongsTo('App\Models\Faculity');
	}
    
    /**
	 * Student Department
	 * 
	 * @return mixed
	 */
	public function students()
	{
		return $this->hasMany('App\Models\Student');
	}

	/**
	 * Relationship with module Model
	 * 
	 * @return this
	 */
	public function modules()
	{
		return $this->belongsToMany('App\Models\Module');
	}

	/**
	 * Get Modules under this
	 * @param  $level 
	 * @return this 
	 */
	public function level($level)
	{
		return $this->modules()->where('department_level',$level);
	}

	/**
	 * Get array of levels
	 * 
	 * @return this
	 */
	public function levels()
	{
		$levels = [];

		for ($level=1; $level <= $this->levels ; $level++) 
		{ 
			$levels[$level] = $level;
		}

		return $levels;
	}
}
