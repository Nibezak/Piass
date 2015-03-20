<?php namespace App\Http\Controllers;

use Redirect,Flash;
use App\Http\Requests;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\DepartmentRegisterRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculity;
use App\Models\Module;
use App\Commands\DepartmentRegisterCommand; 

use Illuminate\Http\Request;

class DepartmentController extends Controller {

    private $department; 
    private $faculity;

    function __construct(Department $department ,Faculity $faculity) 
    {
    	$this->department = $department;

    	$this->faculity   = $faculity;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departments = $this->department->paginate(20);

		return view('departments.index',compact('departments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$department = new $this->department;

		return view('departments.create',compact('department'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DepartmentRegisterRequest $request)
	{
		$this->dispatch(
			new DepartmentRegisterCommand($request)
			);

		Flash::success('New department well added');

		return Redirect::route('settings.departments.index');
	}

	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$department = $this->department->findOrFail($id);

		return view('departments.edit',compact('department'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(DepartmentUpdateRequest $request, $id)
	{
		$department = $this->department->findOrFail($id);

		$data = (array) $request->all();
		$data['departments'] = $request->department;
		$data['faculity_id'] = $request->faculity;

		$department->update($data);

		Flash::success($request->name. ' department updated successfully.');

		return Redirect::route('settings.departments.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$department = $this->department->findOrFail($id);

		$department->delete();

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
	public function apiDepartments(ApiRequest $request,$faculity_id)
	{
		 $departments = $this->faculity->findOrFail($faculity_id)
		 							   ->departments->lists('name','id');

	     return response()->json((array) $departments);
	}
	/**
	 * Get the level of a given api
	 * 
	 * @param  ApiRequest $request 
	 * @param  $department 
	 * @return id @example {1}
	 */
	public function apiLevel(ApiRequest $request,$department)
	{
		$level  = $this->department->findOrFail($department)->levels;

		return response()->json($level);
	}	

	/**
	 * Get all modules under a given department and level
	 *
	 * @param ApiRequest $request 
	 * @param integer departmentId Id of the department we are going to look for
	 * @param integer level Department level
	 */

	public function apiModules(ApiRequest $request,$departmentId,$level)
	{
		$modules = $this->department->findOrFail($departmentId)->modules->where('department_level',$level);

		return response()->json($modules);
	}
}
