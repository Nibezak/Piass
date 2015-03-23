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

			$this->export($filename,$this->transformStudentDetails($students,$level));
		
		}

		return view('reports.students.details',compact('students'));

		
	}

	/**
	 * Student payment progress
	 * 
	 * @return mixed
	 */
	public function paymentProgression()
	{

		$faculity 		= Input::get('faculity');
		$department 	= Input::get('department');
		$level 			= Input::get('level');
		$module 		= Input::get('module');

		$students = $this->student->studentList($faculity,$department,$level,$module);
		
		$students = $this->transformPaymentProgress($students,$level);

		if(Input::get('export'))
		{
			$filename = 'studentsPaymentProgress'.implode('_', Input::all());

			$this->export($filename,$students );
		
		}

		return view('reports.students.paymentprogression',compact('students'));
		
	}


	/**
	 * Student with full paid school fees progress
	 * 
	 * @return mixed
	 */
	public function fullPaid()
	{

		$faculity 		= Input::get('faculity');
		$department 	= Input::get('department');
		$level 			= Input::get('level');
		$module 		= Input::get('module');

		$students = $this->student->studentList($faculity,$department,$level,$module);

		$students = $this->transformPaidStudent($students,$level);

		if(Input::get('export'))
		{
			$filename = 'FullPaidStudents'.implode('_', Input::all());

			$this->export($filename,$students);
		
		}

		return view('reports.students.paymentfull',compact('students'));
		
	}

	/**
	 * Student with full paid school fees progress
	 * 
	 * @return mixed
	 */
	public function pendingPayment()
	{

		$faculity 		= Input::get('faculity');
		$department 	= Input::get('department');
		$level 			= Input::get('level');
		$module 		= Input::get('module');

		$students = $this->student->studentList($faculity,$department,$level,$module);

		$students = $this->transformNotPaidStudent($students,$level);

		if(Input::get('export'))
		{
			$filename = 'PendingPaymentStudents'.implode('_', Input::all());

			$this->export($filename,$students);
		
		}

		return view('reports.students.paymentpending',compact('students'));
		
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

	/**
	 * Get the student details
	 * 
	 * @param  students
	 * 
	 * @return array
	 */
	private function transformStudentDetails($students,$level=0)
	{
		$studentModel = $this->student;

		return array_map(function($student) use ($studentModel,$level)
			{
				// If the level matchin ? otherwise go to the next record

				if($level!=0 && $studentModel->find($student['id'])):
             		
             		return [];
           		
           		endif;
				
				return [
						'Names'           		=> $student['names'],
						'Date of Birth'    		=> date('Y-m-d',strtotime($student['DOB'])),
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
						'Faculity'			    => $studentModel->find($student['id'])->department->faculity->name,
						'Department'			=> $studentModel->find($student['id'])->department->name,
						'Class / Level'			=> $studentModel->find($student['id'])->level(),
						
						];

			}, $students->toArray());
	}

	/**
	 * Get the student who paid
	 * 
	 * @param  students
	 * 
	 * @return array
	 */
	private function transformPaidStudent($students,$level = 0)
	{
		$studentModel = $this->student;

		return array_map(function($student) use ($studentModel,$level)
			{
				// If the level matching ? otherwise go to the next record

				if($level!=0 && $studentModel->find($student['id'])->level()!=$level):
             		
             		return [];
           		
           		endif;
                // Check if there is pending amount that are not yet paid

				if ($studentModel->find($student['id'])->balance() > 0)
				 {
					return [];
				 }
				return [
						'Names'           		=> $student['names'],
						'Date of Birth'    		=> date('Y-m-d',strtotime($student['DOB'])),
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
						'Amount to pay'			=> $studentModel->find($student['id'])->totalDebitAmount(),
						'Amount Paid so far'	=> $studentModel->find($student['id'])->totalCreditAmount(),	
						'balance'				=> $studentModel->find($student['id'])->balance(),
						'Payment progresss'		=> round($severity=$studentModel->find($student['id'])->totalCreditAmount() * 100 / $studentModel->find($student['id'])->totalDebitAmount()).'%',
						'severity'				=> $severity<50 ?'danger':'success',
						'Faculity'			    => $studentModel->find($student['id'])->department->faculity->name,
						'Department'			=> $studentModel->find($student['id'])->department->name,
						'Class / Level'			=> $studentModel->find($student['id'])->level(),
						
						];

			}, $students->toArray());
	}

	/**
	 * Get the student who paid
	 * 
	 * @param  students
	 * 
	 * @return array
	 */
	private function transformPaymentProgress($students,$level=0)
	{
		$studentModel = $this->student;

		return array_map(function($student) use ($studentModel,$level)
			{
				//Check if the level is matching otherwise go to the next record

				if($level!=0 && $studentModel->find($student['id'])->level()!=$level()):
             		
             		return [];
           		
           		endif;

				return [
						'Names'           		=> $student['names'],
						'Date of Birth'    		=> date('Y-m-d',strtotime($student['DOB'])),
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
						'Amount to pay'			=> $studentModel->find($student['id'])->totalDebitAmount(),
						'Amount Paid so far'	=> $studentModel->find($student['id'])->totalCreditAmount(),	
						'balance'				=> $studentModel->find($student['id'])->balance(),
						'Payment progresss'		=> round($severity=$studentModel->find($student['id'])->totalCreditAmount() * 100 / $studentModel->find($student['id'])->totalDebitAmount()).'%',
						'severity'				=> $severity<50 ?'danger':'success',
						'Faculity'			    => $studentModel->find($student['id'])->department->faculity->name,
						'Department'			=> $studentModel->find($student['id'])->department->name,
						'Class / Level'			=> $studentModel->find($student['id'])->level(),
						
						];

			}, $students->toArray());
	}


	/**
	 * Get the student who paid
	 * 
	 * @param  students
	 * 
	 * @return array
	 */
	private function transformNotPaidStudent($students,$level=0)
	{
		$studentModel = $this->student;

		return array_map(function($student) use ($studentModel,$level)
			{
				// if the level is different from what was provided then go to the next record

				if($level!=0 && $studentModel->find($student['id'])->level()!=$level()):
             		
             		return [];
           		
           		endif;

           		// Check if there is pending amount that are not yet paid

				if ($studentModel->find($student['id'])->balance() <= 0)
				 {
					return [];
				 }

			return [
						'Names'           		=> $student['names'],
						'Date of Birth'    		=> date('Y-m-d',strtotime($student['DOB'])),
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
						'Amount to pay'			=> $studentModel->find($student['id'])->totalDebitAmount(),
						'Amount Paid so far'	=> $studentModel->find($student['id'])->totalCreditAmount(),	
						'balance'				=> $studentModel->find($student['id'])->balance(),
						'Payment progresss'		=> round($severity=$studentModel->find($student['id'])->totalCreditAmount() * 100 / $studentModel->find($student['id'])->totalDebitAmount()).'%',
						'severity'				=> $severity<50 ?'danger':'success',
						'Faculity'			    => $studentModel->find($student['id'])->department->faculity->name,
						'Department'			=> $studentModel->find($student['id'])->department->name,
						'Class / Level'			=> $studentModel->find($student['id'])->level(),
						
						];

			}, $students->toArray());
	}
}
