<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModules extends Model {

	// Defining Mass asignment
	
  protected $fillable = ['student_id','module_id','name','code','credits','credit_cost','amount','department_level'];

  /**
   * Defining relations with the Student model
   * 
   * @return this
   */
  public function student()
  {
  	return $this->belongsTo('App\Models\Student');
  }

  /**
   * Defining relationship with module Model
   * @return this
   */
  public function module()
  {
  	return $this->belongsTo('App\Models\Module');
  }
}
