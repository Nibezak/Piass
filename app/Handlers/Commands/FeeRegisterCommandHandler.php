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
		$amount     = $fee->credit;
		$studentFee = (array) $fee;
		$studentFee['debit']   = $amount;
		$studentFee['done_by'] = Sentry::getUser()->id;
		$studentFee['balance'] = $this->newBalance($fee->student_id,$amount,$fee->transaction_type);

		switch ($fee->transaction_type) {
			case 'debit':
				$studentFee['credit'] = 0;
				break;
			default:
				$studentFee['debit']  = 0;
				break;
		}

		return $this->feeTransaction->create($studentFee);
	}
	/**
	 * Determine new balance to be added in the fees table 
	 * @param  integer $studentID ID of the student we are recording
	 * @param  numeric $credit     Credited amount to this student
	 * @return numeric
	 */
	private function newBalance($studentID,$amount,$type='credit')
	{
		$balance =  $this->oldBalance($studentID);

		switch ($type) {
			case 'credit':
				$balance = $balance - $amount;
				break;
			case 'debit':
				$balance = $balance + $amount;
				break;
		}

		return $balance;
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
