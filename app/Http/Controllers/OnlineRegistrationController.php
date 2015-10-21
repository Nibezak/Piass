<?php namespace App\Http\Controllers;

use App\Commands\StudentRegisterCommand;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesCommands;
use App\Http\Requests\StudentRegisterRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Controller ;
use League\Csv\Writer;

class OnlineRegistrationController extends  Controller {

	use DispatchesCommands, ValidatesRequests;

	public function index()
	{
		$student = new Student;

		return view('students.online_registration', array('student' => $student));
	}

	/**
	 * Handle online registration
	 * 
	 * @param  Request $request 
	 * @return            
	 */
	public function register(StudentRegisterRequest $request)
	{
		$student = $this->dispatch(new StudentRegisterCommand($request))->student;
		Flash::success('Thank you for registration. we shall get back to you shortly');
		return $this->index();
	}

	/**
	 * Export registered students
	 * 
	 * @return 
	 */
	public function export(Student $student)
	{
		$columns =['names',
		'DOB',
		'gender',
		'martial_status',
		'NID',
		'telephone',
		'email',
		'occupation',
		'residence',
		'nationality',
		'father_name',
		'mother_name',
		'created_at',
		'updated_at',
		'mode_of_study',
		'session',
		'campus',
		'department_id',
		];
	
	$students = $student->where('online_registered',1)->get($columns)->toArray();
	
		//we create the CSV into memory
	$csv = Writer::createFromFileObject(new \SplTempFileObject());

	//we insert the CSV header
	$csv->insertOne($columns);

	// The PDOStatement Object implements the Traversable Interface
	// that's why Writer::insertAll can directly insert
	// the data into the CSV
	$csv->insertAll($students);

	// Because you are providing the filename you don't have to
	// set the HTTP headers Writer::output can
	// directly set them for you
	// The file is downloadable
	$csv->output('students.csv');
	die;
	}
}
