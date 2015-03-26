<?php namespace App\Handlers\Commands;

use App\Models\Module;
use App\Models\Student;
use App\Models\StudentModules;
use App\Models\FeeTransaction;
use App\Commands\StudentModuleRegisterCommad;
use Illuminate\Queue\InteractsWithQueue;

class StudentModuleRegisterCommadHandler {

	public $module;
	public $student;
	public $studentModule;
	public $feeTransaction;

	public function __construct(Module $module,StudentModules $studentModule,Student $student,FeeTransaction $feeTransaction)
	{
		$this->module 		 	= 	$module;
		$this->student 			= 	$student;
		$this->studentModule 	= 	$studentModule;
		$this->feeTransaction 	=	$feeTransaction;
	}

	/**
	 * Handle the command.
	 *
	 * @param  StudentModuleRegisterCommad  $command
	 * @return void
	 */
	public function handle(StudentModuleRegisterCommad $command)
	{
		/** Ensure that the module injected is an array  */

		$modules = (array) json_decode($command->modules);

		// Check if the student is full time
		$modeOfStudy	= 	($this->student->findOrFail($command->student_id)->mode_of_study == 'Full time');
	
		$debitAmount = 0;

		foreach ($modules as $moduleId => $credits) 
    	{

			$module = $this->module->findOrFail($moduleId)->toArray();

			// if it's Full Time then use fixed price
			$module['credit_cost'] = $modeOfStudy ? 3000 : $$module['credit_cost'];

			$module['credits'] 		= 	(int) $credits; // Change the credits first

			$module['amount']  		= 	(int) $module['credits']*$module['credit_cost']; // Change the amount to reflect credit too.

			$module['student_id']	= 	(int) $command->student_id; // Who is getting this module?

			$module['module_id']	=	(int) $module['id'];

			//Remove unecessary indixes so that we may remove the confusion
			unset($module['id'],$module['created_at'],$module['updated_at']);


			// If a module added then increase student debit amount
			$studentModule=$this->studentModule->create($module);

			if($studentModule)
			{
				$debitAmount+= $module['amount'];
			}
			
		}
		
		//Register Fee transactions
	    $this->saveFees($debitAmount,count($modules),$command->student_id);
	}

    /** Debit the account of the student */
	public function saveFees($debitAmount,$countModule,$student_id)
	{
		$studentFee['date'] 			= 	date('Y-m-d h:i:s');
		$studentFee['credit'] 			= 	0;
		$studentFee['description']		= 	'Registerd for '.$countModule. ' modules ';
		$studentFee['debit']  			= 	(float) $debitAmount;
		$studentFee['done_by'] 			=	 \Sentry::getUser()->id;
		$studentFee['student_id'] 		=	$student_id;
		$studentFee['balance'] 			=	$this->newBalance($student_id,$debitAmount);

		return $this->feeTransaction->create($studentFee);
	}
	
	/**
	 * Determine new balance to be added in the fees table 
	 * @param  integer $studentID ID of the student we are recording
	 * @param  numeric $credit     Credited amount to this student
	 * @return numeric
	 */
	private function newBalance($studentID,$credit)
	{
		return  $this->oldBalance($studentID) + $credit;
	}
	/**
	 * Get current balance before we add this record to the database
	 * @param   integer $studentID 
	 * @return numeric
	 */
	private function oldBalance($studentID)
	{
		 return $this->student->findOrFail($studentID)->balance();
	}

}
