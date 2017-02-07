<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class FeeRegisterCommand extends Command{

	public $credit;
	public $description;
	public $payslip_number;
	public $date;
	public $student_id;
	public $transaction_type;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($request)
	{
			$this->credit           = $request->credit; 
			$this->description      = $request->description;
			$this->payslip_number   = $request->payslip_number;           
			$this->date             = $request->date; 
			$this->student_id       = $request->student_id;       
			$this->transaction_type = $request->transaction_type;
	}

}
