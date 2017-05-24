<?php namespace App\Http\Controllers;

use Flash;
use App\Factories\MarkFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\StudentModules;
use Illuminate\Support\Facades\Request;

class MarkController extends Controller {

	function __construct(StudentModules $studentmodules,MarkFactory $markFactory) {
		$this->StudentModules = $studentmodules;
		$this->markFactory = $markFactory;
		parent::__construct();
	}


	/**
	 * Display what we have in our controller
	 * 
	 * @return mixed
	 */
	public function index()
	{
		return $this->reload();
	}

	/**
	 * Update student mark
	 * 
	 * @param  int $studentId 
	 * @return mixed
	 */
	public function update($studentId)
	{
		$this->markFactory->updateMarks(Request::get('student_id'),Request::get('cat'),Request::get('exam'));

		return $this->reload();
	}

	/**
	 * Completing marking process
	 * 
	 * @return mixed
	 */
	public function complete()
	{

	 	$markingDetails  = $this->markFactory->getFilterDetails();
	 	$permission      = $markingDetails->department.'.'.$markingDetails->module;

		// First check if the user has the permission to do this
		if (!$this->user->hasAccess($permission)) {
			Flash::error(trans('Sentinel::users.noaccess'));
			return redirect()->back();
		}
		
		$this->markFactory->complete();

		Log::info($this->user->email . ' has completed to mark'.implode(',', $markingDetails));
		
		return $this->reload();
	}

	/**
	 * Cancel Marking process
	 * 
	 * @return @mixed
	 */
	public function cancel()
	{
		$this->markFactory->cancel();
		return $this->reload();
	}
	/**
	 * Reload the content of the marking
	 * 
	 * @return view
	 */
	private function reload()
	{	
		/** Set student if needed */
		$this->setStudentsToBeMarked();


		/** Get student to be marked and the marking details*/
		$students       = $this->markFactory->getStudents();
		$markingDetails = $this->markFactory->getFilterDetails();

		return view('marks.index',compact('students','markingDetails'));
	}

	/** Just fixing a bug */
	public function show($id=null)
	{
		return $this->reload();
	}
	/**
	 * Set students to be marked
	 */
	private function setStudentsToBeMarked()
	{	
		$this->setAcademicYear();
		$this->markFactory->addStudentByCurrentSession();
	}

	/**
	 * set academic year
	 * 
	 */
	private function setAcademicYear()
	{
		if (Request::has('academicyear')) {
			$this->markFactory->setAcademicYear(Request::get('academicyear'));
		}
	}
}
