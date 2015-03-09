<?php namespace App\Handlers\Commands;

use App\Commands\CreateFaculityCommand;
use App\Models\Faculity;
use Illuminate\Queue\InteractsWithQueue;

class CreateFaculityCommandHandler {
	/**
	 * Handle the command.
	 *
	 * @param  CreateFaculityCommand  $command
	 * @return void
	 */
	public function handle(CreateFaculityCommand $command)
	{
		$Faculity = (array) $command;

		return Faculity::create($Faculity);		
	}

}
