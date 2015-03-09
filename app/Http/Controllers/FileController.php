<?php namespace App\Http\Controllers;

use Response,File,Validator,Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FileController extends Controller {


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();

		$rules = array(
		    'file' => 'mimes:jpeg,png,PNG,JPEG,PDF,pdf|max:3000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors()->first(), 400);
		}

		$file = Input::file('file');

        $directory ='public/uploads/'.sha1(time());
        $filename = sha1(time().time());

        $upload_success = $file->move($directory, $filename .$file->getClientOriginalName()); 

        if( $upload_success ) 
        {
        	return Response::json('success', 200);
        } 
        else
         {
        	return Response::json('error', 400);
        }
	}
	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
