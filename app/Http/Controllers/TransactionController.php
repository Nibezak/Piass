<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FeeTransaction;
use Flash;
use Log;

class TransactionController extends Controller {

	/**
	 * Instance of the FeeTransaction model
	 *
	 * @var App\Models\FeeTransaction
	 */
	protected $transaction;

	function __construct(FeeTransaction $transaction) {
		parent::__construct();

		$this->transaction = $transaction;
	}

	/**
	 * Display a listing of the Fee Transactions.
	 *
	 * @return Response
	 */
	public function index() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('transaction.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$student = $this->student->findOrFail($id);
		$transactions = $this->transaction->paginate(10);

		Log::info($this->user->email . ' viewed transaction information for student : ' . json_encode($student) . ' and transactions ' . json_encode($transactions));

		return view('transactions.index', compact('transactions'));
	}

}
