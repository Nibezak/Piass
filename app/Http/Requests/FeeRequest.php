<?php namespace App\Http\Requests;

use Sentry;

use App\Http\Requests\Request;

class FeeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Sentry::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [

				'credit'=>'required|numeric',
				'description'=>'required',
				'payslip_number'=>'required|unique:fee_transactions',
				'date'=>'required|date',
				'student_id'=>'required',
		];
	}

}
