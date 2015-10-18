<?php namespace App\Http\Controllers;

use App\Commands\StudentRegisterCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\FeeTransaction;
use App\Models\Student;
use Flash;
use Input;
use Log;
use Redirect;

class StudentController extends Controller {

	/**
	 * @var App\Http\Models\Student
	 */
	protected $student;
	protected $fees;
	function __construct(Student $student, FeeTransaction $fees) {
		parent::__construct();

		$this->student = $student;
		$this->fees = $fees;
	}
	/**
	 * Display a listing of the student.
	 *
	 * @return Response
	 */
	public function index() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$students = $this->student->paginate(10);

		if ($keyword = Input::get('q')) {
			$students = $this->student->search($keyword)->paginate(50);
		}

		Log::info($this->user->email . ' viewed students list');

		return view('students.index', compact('students'));
	}

	/**
	 * Show the form for creating a new student.
	 *
	 * @return Response
	 */
	public function create() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$student = new $this->student;

		Log::info($this->user->email . ' wants to create new student. viewing student creation form. ');

		return view('students.create', compact('student'));
	}

	/**
	 * Store a newly created student in storage.
	 *
	 * @return Response
	 */
	public function store(StudentRegisterRequest $request) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->dispatch(new StudentRegisterCommand($request))->student;

		Log::info($this->user->email . ' added new student with following information ' . json_encode($student));

		Flash::success('New student ' . $student->names . ' was registered successfully. ');

		return Redirect::route('students.edit', $student->id);
	}

	/**
	 * Show the form for editing the specified student.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$student = $this->student->findOrFail($id);

		Log::info($this->user->email . ' viewed student with following information ' . json_encode($student));

		return view('students.edit', compact('student'));
	}

	/**
	 * Update the specified student in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StudentUpdateRequest $request) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$student = Student::findOrFail($id);

		// Prepare data
		$studentData = (array) $request->all();
		$studentData['DOB'] = date('Y-m-d h:i:s', strtotime($request->DOB));
		$studentData['updated_by'] = \Sentry::getUser()->id;

		$student->update($studentData);

		Log::info($this->user->email . ' changed student informations from ' . json_encode($studentData) . ' to ' . json_encode($student));

		Flash::success($request->names . ' has been updated successfully');

		return Redirect::route('students.edit', $student->id);
	}

	public function fees($studentId) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.fees')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->student->findOrFail($studentId);

		Log::info($this->user->email . ' viewed student fees information of ' . json_encode($student));

		return view('students.fees', compact('student'));
	}


	public function marks($studentId)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.marks')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->student->findOrFail($studentId);

		Log::info($this->user->email . ' viewed student marks information of ' . json_encode($student));

		return view('students.marks', compact('student'));
	}
	/**
	 * Remove the specified student from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.delete')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$student = $this->student->findOrFail($id);
		$this->student->destroy($id);

		Log::info($this->user->email . ' viewed student fees information of ' . json_encode($student));

		Flash::success('You have deleted a student ');

		return redirect()->to('students');
	}

}
