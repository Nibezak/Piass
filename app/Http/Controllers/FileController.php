<?php namespace App\Http\Controllers;

use Response,File,Validator,Input;
use App\Http\Requests;
use App\Models\Student;
use App\Models\File as FileModel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FileController extends Controller {
   

    private $student ;
    private $file;

    function __construct(Student $student,FileModel $file) {
    	$this->student = $student;
    	$this->file    = $file;
    }

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
		    'student_id'=>'required'
		);


		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors()->first(), 400);
		}

		$file = Input::file('file');

        $student = $this->student->findOrFail($input['student_id']);
        
        $directory ='public/uploads/'.$student->names;

        $upload_success = $file->move($directory,$name=$file->getClientOriginalName()); 

        if( $upload_success ) 
        {

        	$this->file->create(['name'=>$name,'student_id'=>$student->id]);

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
