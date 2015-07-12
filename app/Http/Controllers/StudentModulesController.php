<?php namespace App\Http\Controllers;

use App\Commands\StudentModuleRegisterCommad;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentModuleRegisterRequest;
use App\Models\Student;
use Flash;
use Log;
use Redirect;

class StudentModulesController extends Controller {

	private $student;

	function __construct(Student $student) {
		parent::__construct();

		$this->student = $student;
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->student->findOrFail($id);

		Log::info($this->user->email . ' viewed ' . json_encode($student) . ' modules information  ');

		return view('studentModules.create', compact('student'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StudentModuleRegisterRequest $request) {

		$StudentModules = (array) $request->all();
		$StudentModules['modules'] = $this->arraysMatchIndexes($request->get('ids'), $request->get('credits'));

		// Remove unecessary indexes
		unset($StudentModules['ids'], $StudentModules['credits']);

		$this->dispatch(
			new StudentModuleRegisterCommad((object) $StudentModules)
		);

		Log::info($this->user->email . ' added student modules : ' . json_encode($StudentModules));

		Flash::success("New modules added to the student ");

		return $this->registeredmodules($request->student_id);
	}

	public function registeredModules($studentId) {
		$student = $this->student->findOrFail($studentId);

		Log::info($this->user->email . ' viewed student registered modules : ' . json_encode($student));

		return view('studentModules.registeredmodules', compact('student'));
	}

}
