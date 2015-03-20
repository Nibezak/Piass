<?php namespace App\Handlers\Commands;

use Event;
use Sentry;
use App\Events\FeeWasRegisteredEvent;

use App\Commands\FeeRegisterCommand;
use App\Models\Student;
use App\Models\FeeTransaction;
use Illuminate\Queue\InteractsWithQueue;

class FeeRegisterCommandHandler {

	public $user;
	public $student;
	public $feeTransaction;

	function __construct(Student $student, FeeTransaction $feeTransaction)
    {
		$this->student        = $student;
		$this->feeTransaction = $feeTransaction;
	}
	/**
	 * Handle the command.
	 *
	 * @param  FeeRegisterCommand  $command
	 * @return void
	 */
	public function handle(FeeRegisterCommand $fee)
	{
		$feeTransaction = $this->save($fee);

		$event = new FeeWasRegisteredEvent($feeTransaction);

		Event::fire($event);

		return $event;
	}


	public function save($fee)
	{
		$studentFee = (array) $fee;
		$studentFee['debit']   = 0;
		$studentFee['done_by'] = Sentry::getUser()->id;
		$studentFee['balance'] = $this->newBalance($fee->student_id,$fee->credit);

		return $this->feeTransaction->create($studentFee);
	}
	/**
	 * Determine new balance to be added in the fees table 
	 * @param  integer $studentID ID of the student we are recording
	 * @param  numeric $credit     Credited amount to this student
	 * @return numeric
	 */
	private function newBalance($studentID,$credit)
	{
		return  $this->oldBalance($studentID) - $credit;
	}
	/**
	 * Get current balance before we add this record to the database
	 * @param   integer $studentID 
	 * @return numeric
	 */
	private function oldBalance($studentID)
	{
		 return $this->student->findOrFail($studentID)->balance();
	}
}
