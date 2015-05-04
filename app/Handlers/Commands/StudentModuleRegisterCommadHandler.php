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

			// If the level is not configured for full time then choose default module cost
			$level_fees =  \Setting::get('full_time_cost_per_credit_level_'.$module['department_level']) ;

			// if it's Full Time then use fixed price
			$module['credit_cost'] = $modeOfStudy ? $level_fees : $module['credit_cost'];

			$module['credits'] 		= 	(int) $credits; // Change the credits first

			$module['amount']  		= 	(int) $module['credits']*$module['credit_cost']; // Change the amount to reflect credit too.

			$module['student_id']	= 	(int) $command->student_id; // Who is getting this module?

			$module['module_id']	=	(int) $module['id'];

			$module['academic_year']=	$command->academic_year;

			$module['intake']		=	$command->intake;
			
			//Remove unecessary indixes so that we may remove the confusion
			unset($module['id'],$module['created_at'],$module['updated_at']);
			//Who did this transaction ?
			$module['user_id']    = \Sentry::getUser()->id;

			// If a module added then increase student debit amount
			$studentModule=$this->studentModule->create($module);

			if($studentModule)
			{
				$debitAmount+= $module['amount'];
			}
			
		}
		//Register Fee transactions if there is a module
		if((bool) count($modules))
		{		
			$this->saveFees($debitAmount,count($modules),$command->student_id,$command->academic_year,$command->intake,$command->fine_fees,$module['department_level']);
		}
	}

    /** Debit the account of the student */
	public function saveFees($debitAmount,$countModule,$student_id,$academic_year,$intake,$fine_fees=0,$level)
	{
		$studentFee['date'] 			= 	date('Y-m-d h:i:s');
		$studentFee['credit'] 			= 	0;
		$studentFee['description']		= 	'Registerd for '.$countModule. ' modules, Academic year :'.$academic_year.' in level:'.$level;
		$studentFee['debit']  			= 	(float) $debitAmount;
		$studentFee['done_by'] 			=	 \Sentry::getUser()->id;
		$studentFee['student_id'] 		=	$student_id;
		$studentFee['balance'] 			=	$this->newBalance($student_id,$debitAmount);

		// If we have to charge fine, first record fine before continuing	
		if((float) $fine_fees >0)
		{
			$this->registerFine($fine_fees,$student_id,$academic_year,$intake);
		}

		return $this->feeTransaction->create($studentFee);
	}
	
	private function registerFine($fine_fees=0,$student_id,$academic_year,$intake)
	{
		$studentFee['date'] 			= 	date('Y-m-d h:i:s');
		$studentFee['credit'] 			= 	0;
		$studentFee['description']		= 	'Charged fine of :'.$fine_fees.' in Academic year:'.$academic_year.', intake:'.$intake.'.';
		$studentFee['debit']  			= 	(float) $fine_fees;
		$studentFee['done_by'] 			=	 \Sentry::getUser()->id;
		$studentFee['student_id'] 		=	$student_id;
		$studentFee['balance'] 			=	$this->newBalance($student_id,$fine_fees);

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
