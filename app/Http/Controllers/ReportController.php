<?php namespace App\Http\Controllers;

use App\Http\Requests,Flash;
use App\Models\FeeTransaction;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReportController extends Controller
 {
 	protected $feeTransaction ;

 	function __construct(FeeTransaction $feeTransaction) {
 		$this->feeTransaction = $feeTransaction;
 	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$months 	=	json_encode($this->getMonths());
		$credits 	=	json_encode($this->getCredits());
		$debits 	=	json_encode($this->getDebits());

		return view('reports.index',compact('months','credits','debits'));
	}

	private function getMonths()
	{
		$months =$this->feeTransaction->getChartData()->lists('month');

		return array_map(function($month)
			{
				return  date('F-Y',strtotime($month));

			}, $months);
	}

	private function getCredits()
	{
		$credits = $this->feeTransaction->getChartData()->lists('credit');

		return array_map(function($credit)
			{
				return  (float) $credit;

			}, $credits);
	}


	private function getDebits()
	{
		$debits = $this->feeTransaction->getChartData()->lists('debit');

		return array_map(function($debit)
			{
				return  (float) $debit;

			}, $debits);
	}
}
