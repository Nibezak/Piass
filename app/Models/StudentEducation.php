<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model {
	use SoftDeletes;
	protected $fillable = ['qualification','subjects','school_attended','completion_year','student_id','section_of_study'];

	 /**
	  * Update or Create
	  * @param  $education
	  * @return $this
	  */
	public static function changeOrCreate($data)
	{
	    $education = static::where('student_id',$data['student_id']);

	    return !$education->get()->isEmpty() ? $education->update($data) : static::create($data);
	}

	/**
	 * Casts subject into object
	 * 
	 * @return object
	 */
	public function subjects()
	{
		return (object) json_decode($this->subjects);
	}

	/**
	 * Get Subject names
	 * 
	 * @return object
	 */
	public function subjectsNames()
	{
		$subjects = json_decode($this->subjects);

		$names     = [
					'subject1' =>NULL,
					'subject2' =>NULL,
					'subject3' =>NULL,
					'subject4' =>NULL
					];

		$index    = 1; 

		foreach ($subjects as $key => $value) 
		{
			$names['subject'.$index] = $key;

			$index++; 

		}

		return (object) $names;
	}

		/**
	 * Get Subject names
	 * 
	 * @return object
	 */
	public function subjectsGrades()
	{
		$subjects = json_decode($this->subjects);

		$grades   = [
					'grade1' =>NULL,
					'grade2' =>NULL,
					'grade3' =>NULL,
					'grade4' =>NULL,
					];

		$index    = 1; 

		foreach ($subjects as $key => $value) 
		{
			$grades['grade'.$index] = $value;

			$index++; 

		}

		return (object) $grades;
	}
}
