<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentUpdateRequest extends Request {

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
			'NID'            =>'required|numeric',
			'telephone'      =>'required|numeric',      
			'email'          =>'required|email',  
			'occupation'     =>'required',       
			'residence'      =>'required',      
			'nationality'    =>'required',        
			'father_name'    =>'required',        
			'mother_name'    =>'required',        
		];
	}

}
