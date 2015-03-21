<?php namespace App\Handlers\Commands;

use Event;

use App\Commands\StudentRegisterCommand;
use App\Models\Student;
use App\Events\StudentWasRegisteredEvent;
use Illuminate\Queue\InteractsWithQueue;

class StudentRegisterCommandHandler {

	/**
	 * Handle the command.
	 *
	 * @param  StudentCommand  $command
	 * @return void
	 */
	public function handle(StudentRegisterCommand $studentData)
	{
		// Prepare data before registering new student
		$studentInfo 							= (array) $studentData;
		$studentInfo['DOB']						= date('Y-m-d h:i:s',strtotime($studentData->DOB));
		$studentInfo['registration_number'] 	= $this->getRegistrationNumber();
		$student =  Student::create($studentInfo);
		
		$event 	 = new StudentWasRegisteredEvent($student);

		Event::fire($event);

		return $event;
	}

	/**
	 * Get unique registration number as per PIASS policy
	 * 
	 * @return string registration number
	 */
	private function getRegistrationNumber()
	{		
		// Get total number of registered student then add 1
		    $countStudents = Student::count()+1;

			return 'PIASS/'.date('y').'/'.$countStudents;
	}
}
