<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposersProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->leftNavComposer();

		$this->faculityFormComposer();

		$this->departmentFormComposer();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * LEFT NAVITION COMPOSER
	 * 
	 * @return [type] [description]
	 */
	private function leftNavComposer()
	{
		
		view()->composer('partials.leftnav','App\Http\Composers\ViewComposer@leftnav');
	}

	public function faculityFormComposer()
	{
		view()->composer('departments.form','App\Http\Composers\ViewComposer@faculityForm');

		view()->composer('studentModules.form','App\Http\Composers\ViewComposer@faculityForm');

	}

	public function departmentFormComposer()
	{
		view()->composer('students.form','App\Http\Composers\ViewComposer@departmentForm');
		view()->composer('studentModules.form','App\Http\Composers\ViewComposer@departmentForm');
	}

}
