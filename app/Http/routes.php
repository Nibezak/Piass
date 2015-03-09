<?php

Route::get('/', ['as'=>'home','uses'=>'DashboardController@index']);
Route::get('/dashboard', ['as'=>'dashboard','uses'=>'DashboardController@index']);


Route::resource('students', 'StudentController');
Route::resource('fees', 'FeeController');
Route::resource('transactions', 'TransactionController');
Route::resource('files','FileController');

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
