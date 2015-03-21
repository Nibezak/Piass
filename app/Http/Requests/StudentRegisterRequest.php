<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentRegisterRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return \Sentry::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'names'          =>'required',  
			'DOB'            =>'required|date',
			'gender'         =>'required',   
			'martial_status' =>'required',           
			'NID'            =>'required|numeric|unique:students',
			'telephone'      =>'numeric|unique:students',      
			'email'          =>'email|unique:students',  
			'occupation'     =>'alpha_spaces',       
			'residence'      =>'alpha_spaces',      
			'nationality'    =>'required',        
			'father_name'    =>'alpha_spaces',        
			'mother_name'    =>'alpha_spaces',        
		];
	}

}
