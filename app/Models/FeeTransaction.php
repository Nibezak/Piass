<?php namespace App\Models;

use App\Models\Student;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeTransaction extends Model {
	use SoftDeletes;
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];
	/** @var string Table that is associated to this model */
	public $table = 'fee_transactions';

	protected $fillable = [
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
	public function student() {
		return $this->belongsTo('App\Models\Student');
	}

	/**
	 * Relationship with the user Table
	 *
	 * @return this
	 */
	public function doneBy() {
		return $this->belongsTo('App\Models\User', 'done_by');
	}

	public function getChartData() {
		return DB::table($this->table)
			->select(DB::raw('LEFT(date,7) as month, sum(credit) as credit,sum(debit) as debit'))
			->groupBy(DB::raw('LEFT(date,7)'));
	}
}
