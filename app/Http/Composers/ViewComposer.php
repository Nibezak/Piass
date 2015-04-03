<?php namespace App\Http\Composers;


use App\Models\Faculity;
use App\Models\Department;
use App\Models\StudentModules;
use anlutro\LaravelSettings\SettingStore as Settings;
use Illuminate\Contracts\View\View;

/**
* Composer class for the left navigation
*/
class ViewComposer 
{
	protected $settings;

	function __construct(Settings $settings) {
		$this->settings = $settings;
	}
	/** Left navigation View composer */
	public function leftNav(View $view)
	{
		$view->with('faculities',Faculity::all());
	}

	/** Faculities to the department form */
	public function faculityForm(View $view)
	{
		$view->with('faculities',Faculity::lists('name','id'));
	}

	public function departmentForm(View $view)
	{
		$view->with('departments',Department::lists('name','id'));
	}


	public function companyName(View $view)
	{
		$view->with('company',$this->settings->get('Company_name'));
	}

	public function academicYears(View $view)
	{
		$view->with('academicYears',StudentModules::getAcademicYears());
	}
}