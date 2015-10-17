<?php namespace App\Http\Controllers;

use App\Factories\MarkFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\StudentModules;
use Illuminate\Support\Facades\Request;

class MarkController extends Controller {

	function __construct(StudentModules $studentmodules,MarkFactory $markFactory) {
		$this->StudentModules = $studentmodules;
		$this->markFactory = $markFactory;
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
	 * Reload the content of the marking
	 * 
	 * @return view
	 */
	private function reload()
	{	
		/** Set student if needed */
		$this->setStudentsToBeMarked();

		/** Get student to be marked */
	 	$students = $this->markFactory->getStudents();

		return view('marks.index');
	}

	/**
	 * Set students to be marked
	 */
	private function setStudentsToBeMarked()
	{
		$this->markFactory->setStudents(70);
		if (Request::has('module_id')) {
			$this->markFactory->setStudents(Request::get('module_id'));
		}
	}
}
