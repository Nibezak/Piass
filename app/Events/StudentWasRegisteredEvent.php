<?php namespace App\Events;

use App\Events\Event;
use App\Models\Student;
use App\Repositories\FeeTransactionRepository;
use Illuminate\Queue\SerializesModels;

class StudentWasRegisteredEvent extends Event {

	use SerializesModels;

	public $student;
	public $id;
	protected $feetransaction;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Student $student,$charge_registration_fees=false)
	{
		$this->student = $student;

		$this->id = $student->id;

		if ($charge_registration_fees !== false) {
			$this->feetransaction = FeeTransactionRepository::registerTransaction($student);
		}
	}
}
