<?php namespace App\Events;

use App\Events\Event;
use App\Models\FeeTransaction;

use Illuminate\Queue\SerializesModels;

class FeeWasRegisteredEvent extends Event {

	use SerializesModels;

	public $FeeTransaction;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(FeeTransaction $FeeTransaction)
	{
		$this->FeeTransaction = $FeeTransaction;
	}

}
