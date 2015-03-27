<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model {

	protected $table = 'V_STUDENT_REPORTS';

	/**
	 * Getting details for the student
	 * @param  $status (if null don't check payment, if true check full paid if other check balance )
	 */
	public function studentDetails($faculity=false,$department=false,$level=false,$module=false,$status=null)
	{
	 return static::where(function ($query) use($faculity,$department,$level,$module,$status) {
				if($faculity)
				{
					$query->where('Faculity',$faculity);
				}

				if ($department) 
				{
					$query->where('Department',$department);
				}

				if($level)
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
