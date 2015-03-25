<?php namespace App\Http\Controllers;

use Redirect,Flash;
use App\Http\Requests;
use App\Http\Requests\EducationRegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\StudentEducation;

use Illuminate\Http\Request;

class StudentEducationController extends Controller {
   	
   	private $education; 

	function __construct(StudentEducation $education) 
	{
		parent::__construct();

		$this->education = $education;
	}

	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EducationRegisterRequest $request)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.update')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		
		$student = $this->student->findOrFail($id);

		if(!$request->student_id)
		{
			Flash::error('You must register a student before adding education.');

			return Redirect::back();
		}
		$data = (array) $request->all();

		$data['subjects'] = $this->arraysMatchIndexes( $data['subject'] ,$data['grade']);

		unset($data['subject'],$data['grade'],$data['_method'],$data['_token']); // Remove unwanted information

		$education = $this->education->changeOrCreate($data);

		Flash::success(' Student education updated successfully.');

		return Redirect::back();
	}

	
}
