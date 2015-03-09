<?php namespace App\Models;

use App\Models\User;
use App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class FeeTransaction extends Model {

	/** @var string Table that is associated to this model */
	public $table = 'fee_transactions';

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

	/**
	 * Relationship with the student
	 * @return this
	 */
	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}

	/**
	 * Relationship with the user Table
	 * 
	 * @return this
	 */
	public function doneBy()
	{
		return $this->belongsTo('App\Models\User','done_by');
	}

}