<?php namespace App\Http\Controllers;

use App\Commands\ModuleRegisterCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRegisterRequest;
use App\Http\Requests\ModuleUpdateRequest;
use App\Models\Department;
use App\Models\Module;
use Flash;
use Log;
use Redirect;

class ModuleController extends Controller {

	private $module;
	private $department;

	function __construct(Module $module, Department $department) {
		parent::__construct();

		$this->module = $module;

		$this->department = $department;

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('module.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$modules = $this->module->paginate(20);

		return view('modules.index', compact('modules'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($department = 0, $level = 0) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('module.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		if ($department) {
			$department = $this->department->findOrFail($department);
		}

		Log::info($this->user->email . ' viewed module form ');

		$module = new $this->module;

		return view('modules.create', compact('module', 'department', 'level'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ModuleRegisterRequest $request) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('module.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$this->dispatch(
			new ModuleRegisterCommand($request)
		);

		Log::info($this->user->email . ' added module with following information :' . json_encode($request->all()));

		Flash::success($request->name . ' module added to this department');

		return Redirect::route('departments.levels', [$request->department_id, $request->department_level]);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function levelModules($departmentId, $level) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('module.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$department = $this->department->findOrFail($departmentId);

		$modules = $department->level($level)->paginate(10);

		Log::info($this->user->email . ' retrieved module levels with information:' . json_encode($modules));

		return view('modules.index', compact('modules', 'department', 'level'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('module.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$module = $this->module->findOrFail($id);

		$level = $module->department_level;

		$department = $module->departments->first();

		Log::info($this->user->email . ' viewed module with information:' . json_encode($module));

		return view('modules.edit', compact('module', 'department', 'level'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ModuleUpdateRequest $request, $id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('module.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$module = $this->module->findOrFail($id);
		$oldData = $module;
		$modules = (array) $request->all();

		$modules['amount'] = $request->credits * $request->credit_cost;

		$module->update($modules);

		Log::info($this->user->email . ' changed module information from ' . json_encode($oldData) . ' to ' . json_encode($module));

		Flash::success('Module ' . $request->name . ' was updated successfully.');

		return Redirect::route('modules.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('module.delete')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$module = $this->module->findOrFail($id);

		$oldData = $module;

		// //Check if this module has students before removing it
		//    //If it has students then tell user to remove those students firsts

		//    if(!$module->modules->isEmpty())
		//    {
		//    	Flash::error('The module you are trying to delete has students, Please remove those students firsts..');

		//        return redirect()->back();
		//    }

		$module->delete();
		Log::info($this->user->email . ' deleted module with information' . json_encode($oldData));

		Flash::success('Module was deleted successfully.');

		return Redirect::route('modules.index');
	}

}
