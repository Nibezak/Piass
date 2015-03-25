<?php namespace App\Http\Controllers;

use Input,Redirect,Flash;
use App\Http\Requests\FeeRequest;
use App\Http\Controllers\Controller;
use App\Models\FeeTransaction;
use App\Models\Student;
use App\Commands\FeeRegisterCommand;
use Illuminate\Http\Request;

class FeeController extends Controller {

	/**
	 * @var App\Models\Student
	 */
	protected $student;

	/** 
	 * @var App\Models\FeeTransaction
	 */
	protected $transaction;

	function __construct(FeeTransaction $transaction,Student $student)
	 {
	 	parent::__construct();

	 	$this->student = $student;

		$this->transaction = $transaction;
	}
	/**
	 * Display a listing of the Fee Transactions.
	 *
	 * @return Response
	 */
	public function index()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('fee.view')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		$students 	= $this->student->paginate(10);

		if ($keyword = Input::get('q'))
	    {
		  $students = $this->student->search($keyword)->paginate(50);
		}

		return view('fees.index',compact('students'));
	}

	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(FeeRequest $request)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('fee.create')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		$this->dispatch(new FeeRegisterCommand($request));

		Flash::success('Student Fees has been recorded succesffully');

		return Redirect::route('fees.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('fee.view')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		
		$student = $this->student->findOrFail($id);
        
		return view('fees.create',compact('student'));
	}

}
