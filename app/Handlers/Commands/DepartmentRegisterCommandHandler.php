<?php namespace App\Handlers\Commands;

use App\Commands\DepartmentRegisterCommand;
use App\Models\Department;

use Illuminate\Queue\InteractsWithQueue;

class DepartmentRegisterCommandHandler {

	protected $department; 

	function __construct(Department $department) {
		$this->department = $department;
	}
	/**
	 * Handle the command.
	 *
	 * @param  DepartmentRegisterCommand  $command
	 * @return void
	 */
	public function handle(DepartmentRegisterCommand $command)
	{
		return $this->department->create((array) $command);
	}

}
