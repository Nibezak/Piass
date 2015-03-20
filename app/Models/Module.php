<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {
	
	protected $fillable = ['name','code','credits','credit_cost','department_level','amount'];
	/**
	 * Relationship with Department Model
	 * 
	 * @return this
	 */
	public function departments()
	{
		return $this->belongsToMany('App\Models\Department');
	}

}
