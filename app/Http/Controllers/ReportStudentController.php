<?php namespace App\Http\Controllers;

use Input;
use App\Http\Requests;
use App\Models\Student;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReportStudentController extends Controller {

	private $student;

	function __construct(Student $student) {
		$this->student = $student;
	}

	public function details()
	{	
		$faculity 		= Input::get('faculity');
		$department 	= Input::get('department');
		$level 			= Input::get('level');
		$module 		= Input::get('module');

		$students = $this->student->studentList($faculity,$department,$level,$module);
		
		return view('reports.students.details',compact('students'));
	}
}
