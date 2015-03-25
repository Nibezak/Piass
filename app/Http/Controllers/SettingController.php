<?php namespace App\Http\Controllers;

use App\Http\Requests,Flash,Setting,Input,Redirect;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SettingController extends Controller {


	function __construct(Setting $settings)
	 {
	 	parent::__construct();
	}

	/**
	 * View the current settings
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('settings.view')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		$settings = Setting::all();

		return view('settings.index',compact('settings'));
	}

	/**
	 * Modify current settings
	 * 
	 * @return Reirect
	 */
	public function store()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('settings.change')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		
		$settings = Input::except('_token');

		foreach ($settings as $key => $value) 
		{
			Setting::set($key, $value);
		}

		Setting::save();

		Flash::success('Settings well saved');

		return Redirect::route('settings.index');
	}
}
