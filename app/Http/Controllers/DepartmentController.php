<?php namespace App\Http\Controllers;

use Redirect,Flash;
use App\Http\Requests;
use App\Http\Requests\DepartmentRegisterRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Commands\DepartmentRegisterCommand; 

use Illuminate\Http\Request;

class DepartmentController extends Controller {

    private $department; 

    function __construct(Department $department ) 
    {
    	$this->department = $department;
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

}
