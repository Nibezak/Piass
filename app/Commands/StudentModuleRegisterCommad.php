<?php namespace App\Commands;

use App\Commands\Command;


class StudentModuleRegisterCommad extends Command  {

	public $student_id;
	public $modules;
	public function __construct($request)
	{
	 	$this->student_id = $request->student_id;
	 	$this->modules 	  = $request->modules;
	}


}
