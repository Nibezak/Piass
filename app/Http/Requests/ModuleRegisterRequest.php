<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ModuleRegisterRequest extends Request {

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
			'name' =>'required',
			'code' =>'required',
			'credits' =>'required|numeric',
			'credit_cost' => 'required|numeric'
		];
	}

}
