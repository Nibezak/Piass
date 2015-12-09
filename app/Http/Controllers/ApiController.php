<?php namespace App\Http\Controllers;

use App\Factories\MarkFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ApiRequest;
use App\Models\Department;
use App\Models\Faculity;
use App\Models\StudentModules;
use Illuminate\Http\Request;

class ApiController extends Controller {
	private $department;
	private $faculity;

	function __construct(Department $department, Faculity $faculity,MarkFactory $markFactory) {
		$this->department = $department;
		$this->faculity = $faculity;
		$this->markFactory = $markFactory;
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
        $departments[0] = 'Select a department';

        $this->markFactory->setFaculity($faculity_id);

		return response()->json($departments);
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
		$this->markFactory->setDepartment($department);
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
       
		$modules = $modules->where('department_level',$level);
 		
 		$this->markFactory->setLevel($level);

		return response()->json($modules);
	}

	/**
	 * Select module lists based on the departments and level
	 * @param  ApiRequest $request      
	 * @param  numeric     $departmentId department id as set in the model
	 * @param  numeric     $level        level of the department
	 * @return json                 
	 */
	public function departmentLevelModules(ApiRequest $request, $departmentId, $level) {

		$modules = $this->department->findOrFail((int) $departmentId)->modules;
       
		$modules = $modules->where('department_level',(int) $level)->lists('name','id');

 		$modules[0] = 'select a module';
        $this->markFactory->setLevel($level);
		return response()->json($modules);
	}

	/**
	 * Get academic year of a given module
	 * 
	 * @param  ApiRequest     $request        
	 * @param  numeric         $level          
	 * @param  numeric         $module         
	 * @param  StudentModules $studentModules 
	 * @return json                         
	 */
	public function moduleAcademicYears(ApiRequest $request,$level,$module,StudentModules $studentModules)
	{
		$academicYears = $studentModules->where('department_level',$level)
									    ->where('module_id',$module)
									    ->lists('academic_year','academic_year');

	    $academicYears[0] = 'Select academic year';
	    
	    $this->markFactory->setModule($module);

		return response()->json($academicYears);									    
	}

}
