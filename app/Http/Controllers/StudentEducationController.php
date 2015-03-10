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
		if(!$request->student_id)
		{
			Flash::error('You must register a student before adding education.');

			return Redirect::back();
		}
		$data = (array) $request->all();

		$data['subjects'] = $this->getEducation( $data['subject'] ,$data['grade']);

		unset($data['subject'],$data['grade'],$data['_method'],$data['_token']); // Remove unwanted information

		$education = $this->education->changeOrCreate($data);

		Flash::success(' Student education updated successfully.');

		return Redirect::back();
	}

	public function getEducation($subject,$grade)
	{
		$education = [];

		foreach ($subject as $key => $value) 
		{
			$education[$value] = $grade[$key];
		}

		return json_encode($education);
	}
}
