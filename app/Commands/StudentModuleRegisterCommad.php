<?php namespace App\Commands;

use App\Commands\Command;


class StudentModuleRegisterCommad extends Command  {

	public $student_id;
	public $modules;
	public $academic_year;
	public $intake;
	public $fine_fees;

	public function __construct($request)
	{
	 	$this->student_id 		= $request->student_id;
	 	$this->modules 	  		= $request->modules;
	 	$this->academic_year 	= $request->academic_year;
	 	$this->intake			= $request->intake;
	 	$this->fine_fees		= $request->fine_fees;
	}


}
