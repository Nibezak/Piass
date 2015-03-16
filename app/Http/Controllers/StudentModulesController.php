<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentModules;

use Illuminate\Http\Request;

class StudentModulesController extends Controller {

	private $student;

	function __construct(Student $student) 
	{
		$this->student = $student;
	}
    /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$student = $this->student->findOrFail($id);
		
		return view('studentModules.create',compact('student'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
	
}
