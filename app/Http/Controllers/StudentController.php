<?php namespace App\Http\Controllers;

use Redirect,Input,Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Student; 
use App\Models\FeeTransaction;
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
	protected $fees;
	function __construct(Student $student,FeeTransaction $fees)
	 {
	 	parent::__construct();
	 	
	 	$this->student = $student;
		$this->fees    = $fees;
	}
	/**
	 * Display a listing of the student.
	 *
	 * @return Response
	 */
	public function index()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.view')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

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
	    // First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.create')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
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
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.create')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		$student = $this->dispatch(new StudentRegisterCommand($request))->student;

		Flash::success('New student '.$student->names.' was registered successfully. ');

		return Redirect::route('students.edit',$student->id);
	}


	/**
	 * Show the form for editing the specified student.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.update')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
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
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.update')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		$student = Student::findOrFail($id);

		// Prepare data 
		$studentData 	= (array) $request->all();
		$studentData['DOB']	= date('Y-m-d h:i:s',strtotime($request->DOB));
		
		$student->update($studentData);

		Flash::success($request->names.' has been updated successfully');

		return Redirect::route('students.edit',$student->id);
	}


	public function fees($studentId)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.fees')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		$student = $this->student->findOrFail($studentId);

		return view('students.fees',compact('student'));
	}
	/**
	 * Remove the specified student from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.delete')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		$this->student->destroy($id);

		Flash::success('You have deleted a student ');

	   return redirect()->to('students');
	}

}
