<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model {
	use SoftDeletes;
	protected $table = 'student_marks';

}
