<?php
/*
|--------------------------------------------------------------------------
| Home routes
|--------------------------------------------------------------------------
*/
	Route::get('/', ['as'=>'home','before'=>'Sentinel\hasAccess:user','uses'=>'DashboardController@index']);
	Route::get('/dashboard', ['as'=>'dashboard','uses'=>'DashboardController@index']);

/*
|--------------------------------------------------------------------------
| Student routes
|--------------------------------------------------------------------------
*/
   Route::group(['prefix'=>'students','before'=>'Sentinel\hasAccess:user'],	function()
	{
		 Route::resource('educations', 'StudentEducationController');

		 Route::resource('modules','StudentModulesController');

		 Route::get('{studentId}/modules/registered/',['as'=>'student.registered.modules','uses'=>'StudentModulesController@registeredModules']);
	});

	Route::resource('students', 'StudentController');
/*
|--------------------------------------------------------------------------
| Fees, Transactions and files routes
|--------------------------------------------------------------------------
*/
Route::resource('fees', 'FeeController');
Route::resource('transactions', 'TransactionController');
Route::resource('files','FileController');

/*
|--------------------------------------------------------------------------
| Section of Menu
|--------------------------------------------------------------------------
*/
Route::resource('modules','ModuleController');
Route::get('modules/{id}/create/{level}',['as'=>'modules.department.create','uses'=>'ModuleController@create']);
Route::get('departments/{departmentid}/level/{levelid}',['as' =>'departments.levels','uses' =>'ModuleController@levelModules']);
Route::group(['prefix'=>'settings'],function()
	{
		Route::resource('faculities','faculityController');

		Route::resource('departments','DepartmentController');
	});

Route::get('test',function()
	{
		return view('students.upload');
	});

/*
|--------------------------------------------------------------------------
| Section of Menu
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'api'], function()
	{
		Route::get('departments/{faculityId}','DepartmentController@apiDepartments');

		Route::get('department/level/{departmentId}', 'DepartmentController@apiLevel');

		Route::get('department/{departmentId}/level/{level}', 'DepartmentController@apiModules');
	});