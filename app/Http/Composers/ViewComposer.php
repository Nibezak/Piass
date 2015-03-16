<?php namespace App\Http\Composers;

use App\Models\Faculity;

use Illuminate\Contracts\View\View;

/**
* Composer class for the left navigation
*/
class ViewComposer 
{
	/** Left navigation View composer */
	public function leftNav(View $view)
	{
		$view->with('faculities',Faculity::all());
	}

	/** Faculities to the department form */
	public function departmentForm(View $view)
	{
		$view->with('faculities',Faculity::lists('name','id'));
	}
}