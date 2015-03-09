<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class DepartmentUpdateRequest extends Request {

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
			'name' => 'required',
			'description' => 'required',
			'levels'	  =>'required|numeric|min:1',
			'faculity'	  => 'required'
		];
	}

}
