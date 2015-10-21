<?php namespace App\Http\Controllers;

use App\Commands\StudentRegisterCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\FeeTransaction;
use App\Models\Student;
use Flash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use League\Csv\Reader;
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
		$report = view('students.marks', compact('student'))->render();
		if (Request::get('export') == 'printer') {
			 return view('layouts.print',compact('report'));
		}
		if (Request::get('export') == 'excel') {
			
			 $filename = $student->names .'-marks.xls';

			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$filename);

			 return $report;
		}
		return view('students.transcripts',compact('student','report'));
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

	/**
	 * Uploading students
	 * @return [type] [description]
	 */
	public function upload() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.online.registrationi.upload')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		
		if (Input::hasFile('studentsfile')== false) {
			  	return $this->index();
		  }

		  if (Input::file('studentsfile')->getClientOriginalExtension() != 'csv') {
		    Flash::error($validator->messages()->first());
		    return $this->index();
		  }

	    // checking file is valid.
	    if (Input::file('studentsfile')->isValid()) {
	       
	       $csv = Reader::createFromPath(Input::file('studentsfile'));
	       $rules = (new \App\Http\Requests\StudentRegisterRequest)->rules();

	       $message = '';

		   $csv->setOffset(1); //because we don't want to insert the header
	       $students = $csv->fetchAll();
	       $count = 0;
	       foreach ($students as $row) {
				//Do not forget to validate your data before inserting it in your database		
				$student = new \stdClass();

				$student->names             	= $row[0];
				$student->DOB               	= $row[1];
				$student->gender            	= $row[2];
				$student->martial_status    	= $row[3];
				$student->NID               	= $row[4];
				$student->telephone         	= $row[5];
				$student->email             	= $row[6];
				$student->occupation        	= $row[7];
				$student->residence         	= $row[8];
				$student->nationality       	= $row[9];
				$student->father_name       	= $row[10];
				$student->mother_name       	= $row[11];
				$student->mode_of_study     	= $row[14];
				$student->session           	= $row[15];
				$student->campus            	= $row[16];
				$student->department_id     	= $row[17];
				$student->registration_number   = false;
				$student->online_registered     = "0";

				 // doing the validation, passing post data, rules and the messages
				$validator = Validator::make((array) $student, $rules); 
				if ($validator->fails()) {
					foreach ($validator->messages()->toArray() as $key => $value) {
						    foreach ($value as $key => $error) {
						    	$message .= $error;
						    }
				   }
				   Flash::error($message);
				   break;
				}

				++$count;
				//if the function return false then the iteration will stop
			    $this->dispatch(new StudentRegisterCommand($student))->student;
			}
		      // sending back with successfully message.
		      if ($count > 0) {
		      	Log::info($this->user->email . ' uploaded students '+$count);
			    Flash::success('You have successfully uploaded students '.$count);
		      }
		      
		      return $this->index();
	    }
	    else {
	      // sending back with error message.
	     Flash::error('uploaded file is not valid');
	     return $this->index();
	    }
  }

}
