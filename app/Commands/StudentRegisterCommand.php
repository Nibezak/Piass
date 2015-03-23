<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class StudentRegisterCommand extends Command {

   public $names;
   public $DOB;
   public $gender;
   public $martial_status;
   public $NID;
   public $telephone;
   public $email;
   public $occupation;
   public $residence;
   public $nationality;
   public $father_name;
   public $mother_name;
   public $department_id;
   public $mode_of_study;
   public $session;
   public $campus;

	public function __construct($student)
	{
		
		$this->names 			= $student->names;
		$this->DOB 				= $student->DOB;
		$this->gender 			= $student->gender;
		$this->martial_status 	= $student->martial_status;
		$this->NID 				= $student->NID;
		$this->telephone 		= $student->telephone;
		$this->email 			= $student->email;
		$this->occupation 		= $student->occupation;
		$this->residence 		= $student->residence;
		$this->nationality 		= $student->nationality;
		$this->father_name 		= $student->father_name;
		$this->mother_name 		= $student->mother_name;
		$this->mode_of_study	= $student->mode_of_study;
        $this->session 			= $student->session;
        $this->campus			= $student->campus;
		$this->department_id	= $student->department_id;
	}


}
