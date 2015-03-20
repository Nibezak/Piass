<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class FaculityUpdateCommand extends Command implements SelfHandling {

  	public $name;
  	public $description; 
	public function __construct($request)
	{
		dd($request);
		
		$this->name = $request->name;

		$this->description = $request->description;
	}

}
