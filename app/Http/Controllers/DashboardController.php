<?php namespace App\Http\Controllers;

use App\Http\Requests,Flash;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller {

		/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('sentry.auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$students 	=		\App\Models\Student::count();
		$faculities =	 	\App\Models\Faculity::count();
		$departments=		\App\Models\Department::count();
        $modules	=		\App\Models\Module::count();

		return view('dashboards.dashboard1',compact('students','faculities','departments','modules'));
	}

}
