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
		$student = $this->student->findOrFail($id);

		return view('fees.create',compact('student'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
