<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateFaculityCommand extends Command {

	public $name ;
	public $description ;

	public function __construct($request)
	{

	    $this->name        = $request->name;
	    $this->description = $request->description; 
	}


}
