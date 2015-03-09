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

		$this->departmentFormcomposer();
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

	public function departmentFormcomposer()
	{
		view()->composer('departments.form','App\Http\Composers\ViewComposer@departmentForm');
	}

}
