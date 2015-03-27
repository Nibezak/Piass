<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

	protected $fillable = [
							'names'          ,
							'DOB'            ,
							'gender'         ,
							'martial_status' ,
							'NID'            ,
							'telephone'      ,
							'email'          ,
							'occupation'     ,
							'residence'      ,
							'nationality'    ,
							'father_name'    ,
							'mother_name'    ,
							'mode_of_study'	,
							'session',
							'registration_number',
							'campus',
							'created_by',
							'updated_by',
							'department_id'
	];

	/**
	 * Student Department
	 * 
	 * @return mixed
	 */
	public function department()
	{
		return $this->belongsTo('App\Models\Department');
	}

	/** 
	 * RelattionShip with the registered Module
	 * 
	 * @return [type]
	 */
	public function registeredModules()
	{
		return $this->hasMany('App\Models\StudentModules');
	}

	/** 
	 * RelattionShip with the registered Module
	 * 
	 * @return [type]
	 */
	public function level()
	{
		return $this->registeredModules()->max('department_level');
	}
	
	/** 
	 * Relationship with the edication history model 
	 * 
	 * @return mixed
	 */
	public function educations()
	{
		return $this->hasOne('App\Models\StudentEducation');
	}

	/**
	 * Get files associated to this student
	 * 
	 * @return mixed
	 */
	public function files()
	{
		return $this->hasMany('App\Models\File');
	}

    /**
	 * Realationshi with the FeeTransaction Model
	 * 
	 * @return this
	 */
	public function fees()
	{
		return $this->hasMany('App\Models\FeeTransaction');
	}

    /**
     * Get the actual balance per student
     * 
     * @return numeric
     */
    public function balance()
    {
    	if ($this->latestFees()->count())
         {
    		return $this->latestFees()->first()->balance;
       	}

       	return 0;
    }

    /** 
     * Get latest fees for this student
     * 
     * @return this
     */
    public function latestFees()
    {
    	return  $this->fees()->orderBy('created_at','Desc');
    }

    /** 
     * Get latest fees for this studen
     * 
     * @return this
     */
    public function totalDebitAmount()
    {
    	return  $this->fees()->sum('debit');
    }

    /** 
     * Get latest fees for this student
     * 
     * @return this
     */
    public function totalCreditAmount()
    {
    	return  $this->fees()->sum('credit');
    }

    
	/**
	 * Search in the student table
	 * @param  [type] $query   [description]
	 * @param  [type] $keyword [description]
	 * @return [type]          [description]
	 */
	public function scopeSearch($query,$keyword)
	{

    return $query->where("names","like","%$keyword%")
  				 ->orWhere('father_name','like',"$keyword%")
  				 ->orWhere('mother_name','like',"%keyword%");
	}

	public static function studentList($faculityId=false,$departmentId=false,$level=false,$moduleId=false)
	{
		return static::whereHas('department', function($query) use ($faculityId,$departmentId)
			{	
				// If we have department ID then search it
			   !$departmentId ?	: $query->where('id',$departmentId);

			   	// If we have faculity ID then use it for search
			    if($faculityId) :

				$query->whereHas('faculity', function($query) use($faculityId)
				{
					$query->where('id',$faculityId);
				});

				endif;

			})
			->whereHas('registeredModules',function($query) use ($moduleId,$level)
			{
				// Do we have moduleId? then search for it
				!$moduleId ? : $query->where('module_id',$moduleId);

				//!$level ? : $query->where('department_level',$level)->orderBy('created_at','DESC')->take(1);
			})
			->get();
	}
}
