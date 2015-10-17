<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ApiRequest;
use App\Models\Department;
use App\Models\Faculity;
use Illuminate\Http\Request;

class ApiController extends Controller {
	private $department;
	private $faculity;

	function __construct(Department $department, Faculity $faculity) {
		$this->department = $department;
		$this->faculity = $faculity;
		parent::__construct();
	}


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
