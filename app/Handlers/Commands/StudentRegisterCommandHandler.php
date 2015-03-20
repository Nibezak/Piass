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
		$student =  Student::create((array) $studentData);
		
		$event 	 = new StudentWasRegisteredEvent($student);

		Event::fire($event);

		return $event;
	}

}
