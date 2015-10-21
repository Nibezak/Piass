<?php namespace App\Handlers\Commands;

use Event;

use App\Commands\StudentRegisterCommand;
use App\Models\Student;
use App\Models\Department;
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
		$studentInfo['registration_number'] 	= $studentInfo['registration_number']?:$this->getRegistrationNumber($studentData->department_id);
		$studentInfo['created_by'] 				= \Sentry::getUser()->id;

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
	private function getRegistrationNumber($departmentId)
	{			
			// Get the Faculity in which current student is registered in
			$faculity = Department::find($departmentId)->faculity->name;

			// Make sure there is no space 
			$faculity = str_replace(' ','',$faculity);
		    
		    // Get total number of registered student then add 1
		    $countStudents = Student::count()+1;

			return 'PIASS/'.$faculity.'/'.date('y').'/'.$countStudents;
	}
}
