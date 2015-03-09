<?php namespace App\Http\Controllers;

use Flash,Redirect;
use App\Http\Requests;
use App\Http\Requests\ModuleRegisterRequest;
use App\Models\Module;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Commands\ModuleRegisterCommand;

use Illuminate\Http\Request;

class ModuleController extends Controller {

	private $module;
	private $department;

	function __construct(Module $module,Department $department) 
    {
		$this->module = $module;
		$this->department = $department;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($department,$level)
	{
		 $department =  $this->department->findOrFail($department);

		 $module =  new $this->module;

		 return view('modules.create',compact('module','department','level'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ModuleRegisterRequest $request)
	{
		$this->dispatch(
			new ModuleRegisterCommand($request)
			);

		Flash::success($request->name.' module added to this department');

		return Redirect::route('departments.levels',[$request->department_id,$request->department_level]);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function levelModules($departmentId,$level)
	{
		$department = $this->department->findOrFail($departmentId);
		
		$modules 	= $department->level($level)->paginate(10);			  

		return view('modules.index',compact('modules','department','level'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$module = $this->module->findOrFail($id);

		$level = $module->department_level;

		$department = $module->departments->first();

		return view('modules.edit',compact('module','department','level'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
