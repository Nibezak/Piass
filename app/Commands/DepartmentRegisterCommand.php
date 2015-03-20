<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class DepartmentRegisterCommand extends Command{

	public $name;
	public $descriptions;
	public $faculity_id;

	public function __construct($request)
	{
		$this->name = $request->name;
		$this->descriptions = $request->description;
		$this->faculity_id  = $request->faculity;
	}

}
