<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Student events
 */
use App\Events\StudentWasRegisteredEvent;
use App\Handlers\Events\NotifyAboutRegisteredStudent;


/**
 * Fees Events
 */
use App\Events\FeeWasRegisteredEvent;
use App\Handlers\Events\FeeWasRegisteredEventHandler;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		/** Events for the Student */
		StudentWasRegisteredEvent::class => [
			NotifyAboutRegisteredStudent::class,
		],

		/** Events for the Fee */
		FeeWasRegisteredEvent::class=>[
			FeeWasRegisteredEventHandler::class,
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
