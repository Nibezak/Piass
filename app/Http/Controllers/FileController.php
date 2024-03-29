<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\File as FileModel;
use App\Models\Student;
use File;
use Input;
use Log;
use Redirect;
use Response;
use Validator;

class FileController extends Controller {

	private $student;
	private $file;

	function __construct(Student $student, FileModel $file) {

		$this->student = $student;
		$this->file = $file;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('file.upload')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$input = Input::all();

		$rules = array(
			'file' => 'mimes:jpeg,png,PNG,JPEG,PDF,pdf|max:3000',
			'student_id' => 'required',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Response::make($validation->errors()->first(), 400);
		}

		$file = Input::file('file');

		$student = $this->student->findOrFail($input['student_id']);

		$directory = 'uploads/student' . $student->id;

		$upload_success = $file->move($directory, $name = $file->getClientOriginalName());

		if ($upload_success) {
			$file = 'uploads/student' . $student->id . '/';

			$fileInfo = $this->file->create(['name' => $name, 'student_id' => $student->id]);

			$file .= $fileInfo->name;

			Log::info($this->user->email . ' uploaded file with following information :' . json_encode($fileInfo));

			return view('files.show', compact('file', 'fileInfo'));
		} else {
			return Response::json('error', 400);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('file.delete')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$fileInfo = $this->file->findOrFail($id);

		$file = 'uploads/student' . $fileInfo->student_id . '/' . $fileInfo->name;

		$this->file->destroy($id);
		// Delete a single file
		File::delete($file);

		Log::info($this->user->email . ' deleted a file with information :' . json_encode($fileInfo));

		return Redirect::back();
	}

}
