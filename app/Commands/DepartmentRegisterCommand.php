<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class DepartmentRegisterCommand extends Command{

	public $name;
	public $descriptions;
	public $faculity_id;
	public $levels;
	public function __construct($request)
	{
		$this->levels = $request->levels;
		$this->name = $request->name;
		$this->descriptions = $request->description;
		$this->faculity_id  = $request->faculity;
	}

}
