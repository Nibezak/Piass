<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model {

	protected $table = 'V_STUDENT_REPORTS';

	public function studentDetails($faculity=false,$department=false,$level=false,$module=false)
	{
	 return static::where(function ($query) use($faculity,$department,$level,$module) {
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
		});
	}
}
