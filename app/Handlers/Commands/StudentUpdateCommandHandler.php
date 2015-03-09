<?php namespace App\Handlers\Commands;

use App\Commands\StudentUpdateCommand;
use App\Models\Student;

use Illuminate\Queue\InteractsWithQueue;

class StudentUpdateCommandHandler {


	/**
	 * Handle the command.
	 *
	 * @param  StudentUpdateCommand  $command
	 * @return void
	 */
	public function handle(StudentUpdateCommand $command)
	{
		$student = Student::update((array) $command);

	}

}
