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
   Route::group(['prefix'=>'students'],	function()
	{

		 Route::resource('educations', 'StudentEducationController');

		 Route::resource('modules','StudentModulesController');

		 Route::get('fees/{studentId}',['as'=>'student.fees','uses'=>'StudentController@fees']);

		 Route::get('/file/{id}/delete',['as'=>'student.file.delete','uses'=>'FileController@destroy']);

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
Route::get('modules/{id}/create/{level}',['as'=>'modules.department.create','middleware'=>'sentry.auth','uses'=>'ModuleController@create']);
Route::get('departments/{departmentid}/level/{levelid}',['as' =>'departments.levels','middleware'=>'sentry.auth','uses' =>'ModuleController@levelModules']);

Route::group(['prefix'=>'settings'],function()
	{
		Route::resource('faculities','FaculityController');

		Route::resource('departments','DepartmentController');

		Route::get('/',['as'=>'settings.index','uses'=>'SettingController@index']);

		Route::post('/store',['as'=>'settings.store','uses'=>'SettingController@store']);
	});


/*
|--------------------------------------------------------------------------
| Student reports routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'reports'],function()
{
	Route::get('/','ReportController@index');

	Route::get('/students/details', ['as'=>'reports.students.details','uses'=>'ReportStudentController@details']);

	Route::get('/students/payments/progression',['as'=>'reports.students.payments.progression','uses'=>'ReportStudentController@paymentProgression'] );

	Route::get('/students/payments/full',['as'=>'reports.students.payments.paid','uses'=>'ReportStudentController@fullPaid'] );
	Route::get('/students/payments/pending',['as'=>'reports.students.payments.pending','uses'=>'ReportStudentController@pendingPayment'] );

});

/*
|--------------------------------------------------------------------------
| Section of Menu
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'api','middleware'=>'sentry.auth'], function()
	{
		Route::get('departments/{faculityId}','DepartmentController@apiDepartments');

		Route::get('department/level/{departmentId}', 'DepartmentController@apiLevel');

		Route::get('department/{departmentId}/level/{level}', 'DepartmentController@apiModules');
      
});