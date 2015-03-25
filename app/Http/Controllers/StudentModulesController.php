<?php namespace App\Http\Controllers;

use Flash,Redirect,Flash;
use App\Http\Requests\StudentModuleRegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentModules;
use App\Commands\StudentModuleRegisterCommad;

use Illuminate\Http\Request;

class StudentModulesController extends Controller {

	private $student;

	function __construct(Student $student) 
	{
		parent::__construct();
		
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
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.view')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		$student = $this->student->findOrFail($id);
		$student = $this->student->findOrFail($id);
		
		return view('studentModules.create',compact('student'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StudentModuleRegisterRequest $request)
	{
		$StudentModules 	     	= (array) $request->all();
		$StudentModules['modules'] 	=  $this->arraysMatchIndexes($request->get('ids'),$request->get('credits'));

		// Remove unecessary indexes
		unset($StudentModules['ids'],$StudentModules['credits']);
		
		$this->dispatch(
			new StudentModuleRegisterCommad((object) $StudentModules)
		);

		Flash::success("New modules added to the student ");

		return Redirect::route('students.index');
	}

	public function registeredModules($studentId)
	{
		$student = $this->student->findOrFail($studentId);

		return view('studentModules.registeredmodules',compact('student'));
	}
	
}
