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

		$this->partialsComposer();

		$this->academicYearsComposer();

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
		$views =[
			'partials.leftnav',
		];

		view()->composer($views,'App\Http\Composers\ViewComposer@leftnav');
	}
	/**
	 * Academic years viewComposer
	 * @return [type] [description]
	 */
	public function academicYearsComposer()
	{
		$views =[
			'marks.module_filter',
		];

		view()->composer($views,'App\Http\Composers\ViewComposer@academicYears');
	}

	/**
	 * Faculity form composer
	 * @return void
	 */
	public function faculityFormComposer()
	{
		$views =[
			'departments.form',
			'studentModules.form',
			'studentModules.form',
			'marks.module_filter',
			'reports.students.filter',
		];

		view()->composer($views,'App\Http\Composers\ViewComposer@faculityForm');

	}

	public function departmentFormComposer()
	{
		$views = [
			'students.form',
			'studentModules.form',
			'reports.students.filter',

			];
		view()->composer($views,'App\Http\Composers\ViewComposer@departmentForm');
	}

	/**
	 * LEFT NAVITION COMPOSER
	 * 
	 * @return [type] [description]
	 */
	private function partialsComposer()
	{
		$viewsAcademicYeaers = [
		'studentModules.form',
		'reports.students.filter',
		];
		$viewsCompanyname = [
							 'partials.header',
					         'layouts.default',
		 			         'sentinel.sessions.login',
		 			         'reports.students.filter',
		 			       ];
		view()->composer($viewsAcademicYeaers,'App\Http\Composers\ViewComposer@academicYears');
		view()->composer($viewsCompanyname,'App\Http\Composers\ViewComposer@companyName');
	}


}
