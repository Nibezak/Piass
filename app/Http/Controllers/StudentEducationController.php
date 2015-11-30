<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRegisterRequest;
use App\Models\Student;
use App\Models\StudentEducation;
use Flash;
use Log;
use Redirect;

class StudentEducationController extends Controller {

	private $education;
	private $student;

	function __construct(StudentEducation $education, Student $student) {
		parent::__construct();

		$this->education = $education;
		$this->student = $student;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EducationRegisterRequest $request, $id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->student->findOrFail($id);

		if (!$request->student_id) {
			Flash::error('You must register a student before adding education.');

			return Redirect::back();
		}
		$data = (array) $request->all();

		$data['subjects'] = $this->arraysMatchIndexes($data['subject'], $data['grade']);

		unset($data['subject'], $data['grade'], $data['_method'], $data['_token']); // Remove unwanted information

		$education = $this->education->changeOrCreate($data);

		Log::info($this->user->email . ' modified student ' . json_encode($student) . ' education information : ' . json_encode($education));

		Flash::success(' Student education updated successfully.');

		return Redirect::back();
	}

}
