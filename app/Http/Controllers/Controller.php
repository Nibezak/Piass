<?php namespace App\Http\Controllers;

use Sentry,Flash;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	protected $user;

		function __construct() 
		{
			$this->middleware('sentry.auth');
			
			$this->user = Sentry::getUser();
		}

	/**
	 * Mix two array and match the indexes
	 * @param   $array1 
	 * @param   $array2 
	 * @return  array
	 */
	public function arraysMatchIndexes($array1,$array2)
	{
		$finalArray = [];
		// If passed arguments are not array then force them to be array
		$array1 = (array) $array1;
		$array2 = (array) $array2;

		if (!is_array($array1) || !is_array($array2))
	    {
		  throw new Exception("Only array are accepted as parameters", 1);
		  
		}
		
		foreach ($array1 as $key => $value) 
		{
			$finalArray[$value] = $array2[$key];
		}

		return json_encode($finalArray);
	}

}
