<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class ModuleRegisterCommand extends Command {

	
   public $name;
   public $code;
   public $credits;
   public $credit_cost;
   public $department_level;
   public $department_id;

	public function __construct($request)
	{
		$this->name            = $request->name;
		$this->code            = $request->code;
		$this->credits         = $request->credits;
		$this->credit_cost     = $request->credit_cost;
		$this->department_level= $request->department_level;
		$this->department_id   = $request->department_id;
	}
}
