<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModules extends Model {

	// Defining Mass asignment
	
  protected $fillable = ['student_id','academic_year','intake','module_id','user_id','name','code','credits','credit_cost','amount','department_level'];

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
    //Check if the existing 
    $model = (bool) static::findOrFail($data['student_id']);

    $data['user_id']    = \Sentry::getUser()->id;

    return $model ? : static::create($data);
}
  
  /**
   * Get academic years
   */
  public static function getAcademicYears()
  {
    $current_year = (int) date('Y');

    $academicYears  = [];

    for ($year=2008; $year <= $current_year+1 ; $year++) 
    { 
      $index = ((string)  $year-1).'-'.((string) $year); 

      $academicYears[ $index] =  $index;
    }

    return $academicYears;
  }
}
