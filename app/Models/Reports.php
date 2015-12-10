<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Reports extends Model {

	protected $table = 'V_STUDENT_REPORTS';

	/**
	 * Getting details for the student
	 * @param  $status (if null don't check payment, if true check full paid if other check balance )
	 */
	public function studentDetails($faculity=false,$department=false,$level=false,$module=false,$status=null)
	{

	 return static::where(function ($query) use($faculity,$department,$level,$module,$status) {
				if($faculity!=false)
				{
					$query->where('faculity_id',$faculity);
				}

				if ($department!=false) 
				{
					$query->where('department_id',$department);
				}

				if($level!=false)
				{
					$query->where('level',$level);
				}
				// Check we need those who paid or not
				if(!is_null($status))
				{
					$sign   = $status==true ? '<=':'>';

					$query->where('balance',$sign,0);
				}
		});

	}
}
