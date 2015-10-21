<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TeacherController extends Controller {

	function __construct() {	
		
		parent::__construct();
	}	

	public function index()
	{
		return view('teachers.list');
	}
}
