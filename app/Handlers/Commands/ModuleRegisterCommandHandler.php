<?php namespace App\Handlers\Commands;

use App\Commands\ModuleRegisterCommand;
use App\Models\Module;
use Illuminate\Queue\InteractsWithQueue;

class ModuleRegisterCommandHandler {

	
	/**
	 * Handle the command.
	 *
	 * @param  ModuleRegisterCommand  $command
	 * @return void
	 */
	public function handle(ModuleRegisterCommand $command)
	{
		$this->save($command);
	}
    

    private function save($command)
    {
    	$data = (array) $command;

    	$data['amount'] = $command->credits * $command->credit_cost;

    	$module = Module::create($data);

  		$module->departments()->sync((array) $command->department_id);

    	return $module;
    }
}
