<?php namespace App\Http\Controllers;

use App\Commands\StudentRegisterCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StudentRegisterRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Controller as BaseController;

class OnlineRegistrationController extends  BaseController {

	public function index()
	{
		$student = new Student;
		return view('students.online_registration',compact('student'));
	}

	/**
	 * Handle online registration
	 * 
	 * @param  Request $request 
	 * @return            
	 */
	public function register(StudentRegisterRequest $request)
	{
		$student = $this->dispatch(new StudentRegisterCommand($request))->student;
		Flash::success( $student->names . ',thank you for registeration. we shall get back to you shortly');
		return $this->index();
	}
}
