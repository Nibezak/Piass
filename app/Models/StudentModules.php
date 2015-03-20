<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModules extends Model {

	// Defining Mass asignment
	
  protected $fillable = ['student_id','module_id','user_id','name','code','credits','credit_cost','amount','department_level'];

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

// Put this in any model and use
// Modelname::findOrCreate($id);
public static function findOrCreate($data)
{
    $model = (bool) static::where(['student_id'    =>  $data['student_id'],
                            'module_id'      => $data['module_id'],
                            ])
                    ->get()->count();

    $data['user_id']    = \Sentry::getUser()->id;

    return $model ? false : static::create($data);
}

}
