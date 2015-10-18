<?php 
namespace App\Factories;

use App\Models\Department;
use App\Models\Faculity;
use App\Models\Module;
use App\Models\StudentMark;
use App\Models\StudentModules;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Sentry;
/**
* Marking factory
*/
class MarkFactory 
{
    /**
     * Entry point of mark factory
     * 
     * @param App\Models\StudentModules $studentModules 
     * @param App\Models\Faculity       $faculity       
     * @param App\Models\Department     $department     
     * @param App\Models\Module         $module         
     */
	function __construct(StudentModules $studentModules,Faculity $faculity,Department $department,Module $module) {
		$this->studentModules = $studentModules;
		$this->faculity = $faculity;
		$this->department = $department;
		$this->module = $module;

	}

	/**
	 * Method to add students per current set session
	 * 
	 */
	public function addStudentByCurrentSession()
	{
        // If we have students in the session
        // then we have nothing to do here
        $students =(array) $this->getStudents();

        if (count($students) > 0) {
        	return ;
        }

		$module = $this->getModule();

		$academicYear = $this->getAcademicYear();

		$this->addStudents($module,$academicYear);
	}
	/**
	 * Add students to be marked
	 * 
	 * @param numeric $moduleId module to search for
	 */
	public function addStudents($moduleId,$academicYear)
	{
		$studentModules = $this->studentModules->with('student')
											   ->where('module_id',$moduleId)
											   ->where('academic_year',$academicYear)
											   ->orderBy('created_at','DESC')
											   ->get();
		$students =[];

		foreach ($studentModules as $studentModule) {
			$student = new \stdClass();
			$student->id = $studentModule->student->id;
			$student->registration_number = $studentModule->student->registration_number;
			$student->names = $studentModule->student->names;
			$student->faculity = $studentModule->student->department->faculity->name;
			$student->department = $studentModule->student->department->name;
			$student->level = $studentModule->student->level();
			$student->academicYear = $studentModule->student->academicYear();
			$student->marks = 0;

			$students[] = $student;
		}

		Session::set('studentToMarks',(object) $students);
	}

	/**
	 * Update marks of a student in the current session
	 * 
	 * @param  int $studentId 
	 * @param  int $marks     
	 */
	public function updateMarks($studentId,$marks)
	{
		$students = $this->getStudents();

		foreach ($students as $key => $student) {
			if ($student->id == $studentId) {
				$students->$key->marks = $marks;
				break;
			}
		}

	Session::set('studentToMarks', $students);
	}

	/**
	 * Complete marking 
	 * 
	 * @return void
	 */
	public function complete()
	{
		$students = $this->getStudents();
		try {
		DB::transaction(function () use ($students){
		$count = 0;
		foreach ($students as  $student) 
		{
		 	$newStudent = new StudentMark;
			$newStudent->student_id = $student->id;
			$newStudent->student_registration_number = $student->registration_number;
			$newStudent->faculity_id= $this->getFaculity();
			$newStudent->department_id = $this->getDepartment();
			$newStudent->level = $this->getLevel();
			$newStudent->academicYear = $this->getAcademicYear();
			$newStudent->marks = $student->marks;
			$newStudent->module_id = $this->getModule();
			$newStudent->module_name = $this->getFilterDetails()->module;
			$newStudent->module_code = $this->getFilterDetails()->module_code;
			$newStudent->user_id = Sentry::getUser()->id;
			$newStudent->save();
			$count++;
		 }

		 $this->clearAll();

		 Flash::success('You have successfully marked '.$count.' students');

		});
			
		} catch (Exception $e) {
			Flash::error('Error occurent while trying to mark students');
		}
	}

	/**
	 * Cancel current marking process
	 * 		
	 * @return void
	 */
	public function cancel()
	{
		$this->clearAll();

		Flash::error('Marking proccess has been cancelled.');
	}
	/**
	 * Get students to mark
	 * 			
	 * @return Array 
	 */
	public function getStudents()
	{
		return Session::get('studentToMarks', []);
	}

	/**
	 * Set mark faculity
	 * 
	 * @param numeric $faculityId set the faculity ID
	 */
	public function setFaculity($faculityId)
	{
		Session::set('mark_faculity', $faculityId);
	}

	/**
	 * Get mark faculity
	 * @return integer
	 */
	public function getFaculity()
	{
		return Session::get('mark_faculity', 0);
	}

	/**
	 * Set department
	 * 
	 * @param  numeric $departmentId id of the department
	 */
	public function setDepartment($departmentId)
	{
		Session::set('mark_department', $departmentId);
	}

	/**
	 * Get deparment set for this session
	 * 
	 * @return int 
	 */
	public function getDepartment()
	{
		return Session::get('mark_department', 0);
	}
	
	/**
	 * Set level for this marking session
	 * 
	 * @param numeric $level 
	 */
	public function setLevel($level)
	{
		Session::set('mark_level', $level);
	}

	/**
	 * Get department level for this marking session
	 * 
	 * @return numeric level
	 */
	public function getLevel()
	{
		return Session::get('mark_level', 0);
	}

	/**
	 * Set module for this marking session
	 * 
	 * @param int $moduleId module ID to mark
	 */
	public function setModule($moduleId)
	{
		Session::set('mark_module', $moduleId);
	}

	/**
	 * Get module set for this marking session
	 * 
	 * @return int 
	 */
	public function getModule()
	{
		return Session::get('mark_module', 0);
	}

	/**
	 * Set academic Year
	 * @param string $academicYear academic year
	 */
	public function setAcademicYear($academicYear)
	{
		Session::set('mark_academic_year', $academicYear);
	}

	/**
	 * Get academic year
	 * 
	 * @return string
	 */
	public function getAcademicYear()
	{
		return Session::get('mark_academic_year', 0);
	}

	/**
	 * Get selected details in a human friendly way 
	 * 
	 * @return 
	 */
	public function getFilterDetails()
	{  
		$details = new \stdClass();

		$details->faculity 		=   $this->faculity->find($this->getFaculity());
		$details->faculity 		=   !is_null($details->faculity)?$details->faculity->name:null;

		$details->department 	= $this->department->find($this->getDepartment());
		$details->department 	= !is_null($details->department)?$details->department->name:null;

		$module     			= $this->module->find($this->getModule());
		$details->module 	 	= !is_null($module)? $module->name:null;
        $details->module_code   = !is_null($module)? $module->code:null;

		$details->academicYear 	= $this->getAcademicYear();

		return $details;
	}

	/**
	 * Clear all data we have in the session that are related to 
	 * marking processes of PIASS
	 * 
	 * @return void
	 */
	protected function clearAll()
	{	
		$toClear = [
				'mark_faculity',
				'mark_department',
				'mark_module',
				'mark_level',
				'mark_academic_year',
				'studentToMarks',
			];
		Session::forget($toClear);
	}
}
