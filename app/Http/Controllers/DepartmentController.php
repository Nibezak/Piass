<?php namespace App\Http\Controllers;

use App\Commands\DepartmentRegisterCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\DepartmentRegisterRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use App\Models\Faculity;
use App\Models\Module;
use Flash;
use Illuminate\Http\Request;
use Log;
use Redirect;

class DepartmentController extends Controller {

	private $department;
	private $faculity;

	function __construct(Department $department, Faculity $faculity) {
		parent::__construct();

		$this->department = $department;

		$this->faculity = $faculity;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('department.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$departments = $this->department->paginate(20);

		return view('departments.index', compact('departments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('department.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$department = new $this->department;
		// First log
		Log::info($this->user->email . ' viewed department form ' . $department->name);

		return view('departments.create', compact('department'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DepartmentRegisterRequest $request) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('department.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$this->dispatch(
			new DepartmentRegisterCommand($request)
		);
		// First log
		Log::info($this->user->email . ' added department ' . json_encode($request->all()));
		Flash::success('New department well added');

		return Redirect::route('settings.departments.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('department.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$department = $this->department->findOrFail($id);
		// First log
		Log::info($this->user->email . ' viewed department ' . json_encode($department));

		return view('departments.edit', compact('department'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(DepartmentUpdateRequest $request, $id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('department.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$department = $this->department->findOrFail($id);
		$oldData = $department;
		$data = (array) $request->all();
		$data['departments'] = $request->department;
		$data['faculity_id'] = $request->faculity;

		$department->update($data);
		// First log
		Log::info($this->user->email . ' modified department information from' . json_encode($oldData) . ' to  ' . json_encode($department));

		Flash::success($request->name . ' department updated successfully.');

		return Redirect::route('settings.departments.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('department.delete')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$department = $this->department->findOrFail($id);
		$oldData = $department;
		//Check if this department has module before removing it
		//If it has modules then tell user to remove those modules firsts

		if (!$department->modules->isEmpty() || !$department->students->isEmpty()) {
			Flash::error('The department you are trying to delete has some modules or Students under it, Please remove those modules before removing it.');

			return redirect()->back();
		}

		$department->delete();
		// First log
		Log::info($this->user->email . ' deleted department informations :' . json_encode($oldData));

		Flash::success(' Department was deleted successfully.');

		return Redirect::route('settings.departments.index');
	}

	/*
	|--------------------------------------------------------------------------
	| Section of API
	|--------------------------------------------------------------------------
	 */

	/**
	 * Get lists of the Departments
	 *
	 * @param  ApiRequest $request
	 * @param  $faculity_id
	 * @return json object @example {id,name}
	 */
	public function apiDepartments(ApiRequest $request, $faculity_id) {
		$departments = $this->faculity->findOrFail($faculity_id)
		                    ->departments->lists('name', 'id');

		return response()->json((array) $departments);
	}
	/**
	 * Get the level of a given api
	 *
	 * @param  ApiRequest $request
	 * @param  $department
	 * @return id @example {1}
	 */
	public function apiLevel(ApiRequest $request, $department) {
		$level = $this->department->findOrFail($department)->levels;

		return response()->json($level);
	}

	/**
	 * Get all modules under a given department and level
	 *
	 * @param ApiRequest $request
	 * @param integer departmentId Id of the department we are going to look for
	 * @param integer level Department level
	 */

	public function apiModules(ApiRequest $request, $departmentId, $level) {

		$modules = $this->department->findOrFail((int) $departmentId)->modules;
       
		$modules = $modules->where('department_level',(int) $level);
 
		return response()->json($modules);
	}
}
