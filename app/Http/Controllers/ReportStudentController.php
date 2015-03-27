<?php namespace App\Http\Controllers;

use Input,Excel,Flash;
use App\Http\Requests;
use App\Models\Student;
use App\Models\Faculity;
use App\Models\Department;
use App\Models\Module;
use App\Models\Reports;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReportStudentController extends Controller {

	private $student;
	private $faculity;
	private $department;
	private $module;
	private $reports;

	function __construct(Student $student,Faculity $faculity,Department $department,Module $module,Reports $reports) 
	{
		parent::__construct();

		$this->student 		= 	$student;
		$this->faculity 	=	$faculity;
		$this->department 	= 	$department;
		$this->module 		= 	$module;
		$this->reports 		= 	$reports;
	}

	/**
	 * Get student details in a report
	 * 
	 * @return mixed
	 */
	public function details()
	{	
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('report.student.details')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		// Get information
		$students 	= $this->studentDetails();
		//Get html table
		$table 		= $this->htmlTable($students);

		// Do we have to export the results ?
		Input::get('export')?$this->export('students_pending payments',$students) : null ;

		return view('reports.students.details',compact('table'));
		
	}

	/**
	 * Student payment progress
	 * 
	 * @return mixed
	 */
	public function paymentProgression()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('report.student.details')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		
		// Get information
		$students 	= $this->studentDetails();

		$table 		= $this->htmlTable($students);
		// Do we have to export the results ?
		Input::get('export')?$this->export('students_pending payments',$students) : null ;

		return view('reports.students.details',compact('table'));
		
	}


	/**
	 * Student with full paid school fees progress
	 * 
	 * @return mixed
	 */
	public function fullPaid()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('report.student.payment.paid')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		
		// Get information
		$students 	= $this->studentDetails();

		$table 		= $this->htmlTable($students);
		// Do we have to export the results ?
		Input::get('export')?$this->export('students_pending payments',$students) : null ;

		return view('reports.students.details',compact('table'));	
	}

	/**
	 * Student with full paid school fees progress
	 * 
	 * @return mixed
	 */
	public function pendingPayment()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('report.student.payment.panding')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		
		// Get information
		$students 	= $this->studentDetails();

		$table 		= $this->htmlTable($students);
		// Do we have to export the results ?
		Input::get('export')?$this->export('students_pending payments',$students) : null ;
		
		return view('reports.students.details',compact('table'));
		
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
	 * This method will help us to get all student related information from V_STUDENTS_REPORT VIEW
	 */ 
	private function studentDetails()
	{

		$faculity 		= !Input::get('faculity')? false :	$this->faculity->findOrFail(Input::get('faculity'))->name;	
		$department 	= !Input::get('department')? false:	$this->department->findOrFail(Input::get('department'))->name;
		$level 			= (int) Input::get('level');
		$module 		= !Input::get('module')?	false :	$this->module->findOrFail(Input::get('module'))->name;

	  return	$students = $this->reports->studentDetails($faculity,$department,$level,$module)->get()->toArray();
		
	}

	private function htmlTable($students)
	{
	    // Try to get arrays headers
	    $headers = array_keys($students);
	    
	    //if it is multidimensions get sub array keys
	    
	    if (isset($students[0]))
	    {
	    	$headers = array_keys($students[0]) ;
	    }

		$table = new \App\Helpers\HtmlTable;

		// $table->set_heading($headers);
	   return	$table = $table->generate($students);
	}
}
