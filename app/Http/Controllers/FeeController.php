<?php namespace App\Http\Controllers;

use App\Commands\FeeRegisterCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\Models\FeeTransaction;
use App\Models\Student;
use Flash;
use Input;
use Log;
use Redirect;

class FeeController extends Controller {

	/**
	 * @var App\Models\Student
	 */
	protected $student;

	/**
	 * @var App\Models\FeeTransaction
	 */
	protected $transaction;

	function __construct(FeeTransaction $transaction, Student $student) {
		parent::__construct();

		$this->student = $student;

		$this->transaction = $transaction;
	}
	/**
	 * Display a listing of the Fee Transactions.
	 *
	 * @return Response
	 */
	public function index() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('fee.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$students = $this->student->paginate(10);

		if ($keyword = Input::get('q')) {
			$students = $this->student->search($keyword)->paginate(50);
		}

		return view('fees.index', compact('students'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(FeeRequest $request) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('fee.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$this->dispatch(new FeeRegisterCommand($request));

		// First log
		Log::info($this->user->email . ' added fees with following information :' . json_encode($request->all()));

		Flash::success('Student Fees has been recorded succesffully');

		return Redirect::route('student.fees', $request->student_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('fee.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->student->findOrFail($id);

		// First log
		Log::info($this->user->email . ' views student fees with following information :' . json_encode($student));

		return view('fees.create', compact('student'));
	}
	/**
	 * Destroy fee transaction
	 * @param  transactionId $id
	 * @return
	 */
	public function destroy($id) {

		if ($this->transaction->destroy($id)) {
			// First log
			Log::info($this->user->email . ' deleted student fees information with ID :' . $id);
			Flash::success('You have succesffully deleted fee information');

			return Redirect::back();
		}
		Log::info($this->user->email . ' tried to delete student fees information with ID :' . $id . ' but it failed');

		Flash::error('Error occured while deleting fees information');

		return Redirect::back();

	}
}
