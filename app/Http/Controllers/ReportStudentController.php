<?php namespace App\Http\Controllers;

use Input,Excel;
use App\Http\Requests;
use App\Models\Student;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReportStudentController extends Controller {

	private $student;

	function __construct(Student $student) {
		$this->student = $student;
	}

	/**
	 * Get student details in a report
	 * 
	 * @return mixed
	 */
	public function details()
	{	
		$faculity 		= Input::get('faculity');
		$department 	= Input::get('department');
		$level 			= Input::get('level');
		$module 		= Input::get('module');

		$students = $this->student->studentList($faculity,$department,$level,$module);
		
		if(Input::get('export'))
		{
			$filename = 'students'.implode('_', Input::all());

			$this->export($filename,$this->transformStudentDetails($students));
		
		}

		return view('reports.students.details',compact('students'));

		
	}


	/**
	 * Export to excel
	 * @param  [type]
	 * @param  [type]
	 * @return [type]
	 */
	private function export($name,$data)
	{
		
	 Excel::create($name, function($excel) use($data)
	  {
         $excel->sheet('Students', function($sheet) use($data) 
         {

        	$sheet->fromArray($data);

    	  });

     })->export('xlsx');
	
	}


	public function transformStudentDetails($students)
	{
		$studentModel = $this->student;

		return array_map(function($student) use ($studentModel)
			{
				return [
						'Names'           		=> $student['names'],
						'Date of Birth'    		=> $student['DOB'],
						'Gender'          		=> $student['gender'],
						'Martial status'  		=> $student['martial_status'],
						'NID'             		=> $student['NID'],
						'Telephone'       		=> $student['telephone'],
						'Email'           		=> $student['email'],
						'Occupation'      		=> $student['occupation'],
						'Residence'       		=> $student['residence'],
						'Nationality'     		=> $student['nationality'],
						'Father name'     		=> $student['father_name'],
						'Mother name'     		=> $student['mother_name'],
						'Mode of study'	 		=> $student['mode_of_study'],
						'Session' 				=> $student['session'],
						'Registration number'	=> $student['registration_number'],
						'Campus' 				=> $student['campus'],
						'Department'			=> $studentModel->find($student['id'])->department->name,
						'Faculity'			    => $studentModel->find($student['id'])->department->faculity->name
						];

			}, $students->toArray());
	}
}
