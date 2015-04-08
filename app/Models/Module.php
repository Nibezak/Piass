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
	/**
	 * Find or create a new 
	 */ 
	public static function findOrCreate($module)
	{
	    $obj = static::where(['name'=>$module['name'],'code'=>$module['code']])->first();
	    
	    return $obj ?: static::create($module);
	}
}
