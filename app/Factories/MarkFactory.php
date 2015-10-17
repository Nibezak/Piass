<?php 
namespace App\Factories;

use App\Models\StudentModules;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
/**
* Marking factory
*/
class MarkFactory 
{

	function __construct(StudentModules $studentModules) {
		$this->studentModules = $studentModules;
	}
	/**
	 * Set student to be marked
	 * 
	 * @param numeric $moduleId module to search for
	 */
	public function setStudents($moduleId)
	{
		$studentModules = $this->studentModules->with('student')
											   ->where('module_id',$moduleId)
											   ->orderBy('created_at','DESC')
											   ->get();
		$students = [];
		foreach ($studentModules as $studentModule) {
			$students[] = $studentModule->student;
		}

		Session::set('studentToMarks', $students);
	}

	/**
	 * Get students to mark
	 * 			
	 * @return Array [description]
	 */
	public function getStudents()
	{
		return Session::get('studentToMarks', []);
	}
}
