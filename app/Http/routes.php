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
Route::get('modules/{id}/create/{level}',['as'=>'modules.department.create','uses'=>'ModuleController@create']);
Route::get('departments/{departmentid}/level/{levelid}',['as' =>'departments.levels','uses' =>'ModuleController@levelModules']);
Route::group(['prefix'=>'settings'],function()
	{
		Route::resource('faculities','faculityController');

		Route::resource('departments','DepartmentController');
	});


/*
|--------------------------------------------------------------------------
| Student routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'reports'],function()
{
	Route::get('/', function()
		{
			return  App\Models\Student::all()->department;
		});
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
      
		Route::get('export',function()
			{
				
				 $data = array(
    array('data1', 'data2'),
    array('data3', 'data4')
);

	 Excel::create('Students', function($excel) use($data) {

    $excel->sheet('Students', function($sheet) use($data) {

        $sheet->fromArray(\App\Models\Student::all());
          $sheet->setOrientation('landscape');

    });

     $excel->sheet('users', function($sheet) use($data) {

        $sheet->fromArray(\App\Models\User::all());
          $sheet->setOrientation('landscape');

    });
    $excel->sheet('Fee_stransactions', function($sheet) use($data) {

        $sheet->fromArray(\App\Models\FeeTransaction::all());
          $sheet->setOrientation('landscape');

    });

})->export('pdf');
			});
	});