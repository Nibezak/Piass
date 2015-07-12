<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FeeTransaction;
use Log;

class ReportController extends Controller {
	protected $feeTransaction;

	function __construct(FeeTransaction $feeTransaction) {
		parent::__construct();
		$this->feeTransaction = $feeTransaction;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$months = json_encode($this->getMonths());
		$credits = json_encode($this->getCredits());
		$debits = json_encode($this->getDebits());

		return view('reports.index', compact('months', 'credits', 'debits'));
	}

	private function getMonths() {
		$months = $this->feeTransaction->getChartData()->lists('month');

		Log::info($this->user->email . ' viewed transactions months :' . json_encode($months));

		return array_map(function ($month) {
			return date('F-Y', strtotime($month));

		}, $months);
	}

	private function getCredits() {
		$credits = $this->feeTransaction->getChartData()->lists('credit');

		Log::info($this->user->email . ' viewed credits information ' . json_encode($credits));

		return array_map(function ($credit) {
			return (float) $credit;

		}, $credits);
	}

	private function getDebits() {
		$debits = $this->feeTransaction->getChartData()->lists('debit');

		Log::info($this->user->email . ' viewed debit information' . json_encode($debits));

		return array_map(function ($debit) {
			return (float) $debit;

		}, $debits);
	}
}
