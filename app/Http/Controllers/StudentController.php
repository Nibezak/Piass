<?php namespace App\Http\Controllers;

use Redirect,Input,Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Student; 
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Commands\StudentRegisterCommand;
use App\Commands\StudentUpdateCommand;

use Illuminate\Http\Request;

class StudentController extends Controller {

	/**
	 * @var App\Http\Models\Student 
	 */
	protected $student;

	function __construct(Student $student)
	 {
		$this->student = $student;
	}
	/**
	 * Display a listing of the student.
	 *
	 * @return Response
	 */
	public function index()
	{
		$students 	= $this->student->paginate(10);

		if ($keyword = Input::get('q'))
	    {
		  $students = $this->student->search($keyword)->paginate(50);
		}

		return view('students.index',compact('students'));
	}

	/**
	 * Show the form for creating a new student.
	 *
	 * @return Response
	 */
	public function create()
	{
		$student = new $this->student;

		return view('students.create',compact('student'));
	}

	/**
	 * Store a newly created student in storage.
	 *
	 * @return Response
	 */
	public function store(StudentRegisterRequest $request)
	{
		$this->dispatch(new StudentRegisterCommand($request));

		Flash::success('New Student was registered successfully ');

		return Redirect::route('students.index');
	}

	/**
	 * Display the specified student.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified student.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$student = $this->student->findOrFail($id);

		return view('students.edit',compact('student'));
	}

	/**
	 * Update the specified student in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StudentUpdateRequest $request)
	{
		$student = Student::findOrFail($id);

		$student->update((array) $request->all());

		Flash::success($request->names.' has been updated successfully');

		return Redirect::route('students.index');
	}

	/**
	 * Remove the specified student from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 
	}

}
