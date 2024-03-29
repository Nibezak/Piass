<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Faculity extends Model {
	use SoftDeletes;
	protected $fillable = ['name','description'];
	/**
	 * Relationship with Department Model
	 * @return this
	 */
	public function departments()
	{
		return $this->hasMany('App\Models\Department');
	}

}
