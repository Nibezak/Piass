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
	];


	/** RelattionShip with the registered Module */
	public function registeredModules()
	{
		return $this->hasMany('App\Models\StudentModules');
	}
	
	/** Relationship with the edication history model */
	public function educations()
	{
		return $this->hasOne('App\Models\StudentEducation');
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
    
    public function balance()
    {
    	if ($this->latestFees()->count())
         {
    		return $this->latestFees()->first()->balance;
       	}

       	return 0;
    }

    public function latestFees()
    {
    	return  $this->fees()->orderBy('created_at','Desc');
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


}
