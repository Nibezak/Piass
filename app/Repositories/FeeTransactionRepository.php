<?php namespace App\Repositories;

use DB;
use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

/**
* Repository for the transaction fee
*/
class FeeTransactionRepository extends Model
{
	protected $table = 'fee_transactions';

	protected $fillable =[
						'debit',
						'credit',
						'balance',
						'description',
						'payslip_number',
						'receipt_number',
						'date',
						'student_id',
						'done_by',
						];

	
	public static function registerTransaction($student)
	{
		$studentFee['date'] 			= 	date('Y-m-d h:i:s');
		$studentFee['credit'] 			= 	\Setting::get('registration_fees')?:0;
		$studentFee['description']		= 	'Student registration fees ';
		$studentFee['debit']  			= 	\Setting::get('registration_fees')?:0;
		$studentFee['done_by'] 			=	 \Sentry::getUser()->id;
		$studentFee['student_id'] 		=	$student->id;
		$studentFee['balance'] 			=	$student->balance();

		return self::create($studentFee);
	}
}