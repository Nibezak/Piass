<?php namespace App\Handlers\Commands;

use App\Commands\StudentRegisterCommand;
use App\Events\StudentWasRegisteredEvent;
use App\Models\Department;
use App\Models\Student;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Event;
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
		$studentInfo['created_by'] 				= (is_null(Sentry::getUser()) == false )? Sentry::getUser()->id : 0;

		$student =  Student::create($studentInfo);
		
		
		if ($studentData->online_registered=="0") {	
			$event 	 = new StudentWasRegisteredEvent($student);
			Event::fire($event);
			return $event;
		}

		return $student;
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
