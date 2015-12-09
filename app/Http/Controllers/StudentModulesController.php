<?php namespace App\Http\Controllers;

use App\Commands\StudentModuleRegisterCommad;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentModuleRegisterRequest;
use App\Models\FeeTransaction;
use App\Models\Student;
use App\Models\StudentModules;
use Flash;
use Illuminate\Support\Facades\DB;
use Log;
use Redirect;

class StudentModulesController extends Controller {

	private $student;

	function __construct(Student $student) {
		parent::__construct();

		$this->student = $student;
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('student.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->student->findOrFail($id);

		Log::info($this->user->email . ' viewed ' . json_encode($student) . ' modules information  ');

		return view('studentModules.create', compact('student'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StudentModuleRegisterRequest $request) {

		$StudentModules = (array) $request->all();
		$StudentModules['modules'] = $this->arraysMatchIndexes($request->get('ids'), $request->get('credits'));

		dd($StudentModules);
		// Remove unecessary indexes
		unset($StudentModules['ids'], $StudentModules['credits']);

		$this->dispatch(
			new StudentModuleRegisterCommad((object) $StudentModules)
		);

		Log::info($this->user->email . ' added student modules : ' . json_encode($StudentModules));

		Flash::success("New modules added to the student ");

		return $this->registeredmodules($request->student_id);
	}

	public function registeredModules($studentId) {
		$student = $this->student->findOrFail($studentId);

		Log::info($this->user->email . ' viewed student registered modules : ' . json_encode($student));

		return view('studentModules.registeredmodules', compact('student'));
	}

	/**
	 * Destroy student moduls
	 * @param  moduleId $id
	 * @return
	 */
	public function destroy($id, StudentModules $studentModule,FeeTransaction $feeTransaction) {

		// 1. Find the module to be deleted
		// 2. Delete its transaction fees
		// 3. Delete module
		$module = $studentModule->findOrFail($id);


		$transaction = $feeTransaction->where('student_id',$module->student_id)
									  ->where(DB::raw('LEFT(created_at,10)'),substr($module->created_at, 0,10))
									  ->first();
	    DB::beginTransaction();

	    $removeFees = false;
	    if (!is_null($transaction)) {
	    	$transaction->debit -= $module->amount;
	    	$transaction->balance -= $module->amount;

	    	$removeFees = $transaction->save();
	    }
	    
	    $removeStudentModule = (is_null($module)) ? : $module->delete();
        
		if ($removeFees && $removeStudentModule) {
			// All wend well
			DB::commit();
			// First log
			Log::info($this->user->email . ' deleted student module information with ID :' . $id);

			Flash::success('You have succesffully deleted module:'.$module->name.'.');

			return Redirect::back();
		}
		
		// If we reach here, it means something went wrong rollback and build the error	
		DB::rollBack();

		Log::info($this->user->email . ' tried to delete student module information with ID :' . $id . ' but it failed');

		Flash::error('Error occured while deleting module:'.$module->name.'.');

		return Redirect::back();

	}

}
