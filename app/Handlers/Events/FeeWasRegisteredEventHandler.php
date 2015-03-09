<?php namespace App\Handlers\Events;

use App\Events\FeeWasRegisteredEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class FeeWasRegisteredEventHandler {

	/**
	 * Handle the event.
	 *
	 * @param  FeeWasRegisteredEvent  $event
	 * @return void
	 */
	public function handle(FeeWasRegisteredEvent $event)
	{
		/**
		 * @todo HANDLE EVENTS AFTER THE FEES IS REGISTED
		 */
	}

}
