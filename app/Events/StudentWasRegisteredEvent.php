<?php namespace App\Events;

use App\Events\Event;
use App\Models\Student;
use Illuminate\Queue\SerializesModels;

class StudentWasRegisteredEvent extends Event {

	use SerializesModels;

	public $student;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Student $student)
	{
		$this->student = $student;
	}
}
