<?php namespace App\Handlers\Events;

use App\Events\StudentWasRegisteredEvent;
use Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class NotifyAboutRegisteredStudent {

	
	/**
	 * Handle the event.
	 *
	 * @param  StudentWasRegisteredEvent  $event
	 * @return void
	 */
	public function handle(StudentWasRegisteredEvent $event)
	{
		// Mail::send('emails.testMail', [], function($mail)
		// {
		// 	$mail->to('testmail@gmail.com');
		// 	$mail->subject('Test mail');
		// 	$mail->cc('another@gmail.com');

		// 	$mail->bcc(['email@bcc.com']);
		// }
		// 	);
	}

}
