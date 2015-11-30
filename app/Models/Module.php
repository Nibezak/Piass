<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model {
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	protected $fillable = ['name', 'code', 'credits', 'credit_cost', 'department_level', 'amount'];
	/**
	 * Relationship with Department Model
	 *
	 * @return this
	 */
	public function departments() {
		return $this->belongsToMany('App\Models\Department');
	}
	/**
	 * Find or create a new
	 */
	public static function findOrCreate($module) {
		$obj = static::where(['name' => $module['name'], 'code' => $module['code']])->first();

		return $obj ?: static::create($module);
	}
}
