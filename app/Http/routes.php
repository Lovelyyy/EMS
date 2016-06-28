<?php

Route::auth();
Route::get('/', 'DashboardController@index');
Route::get('/home', 'HomeController@index');

Route::get('/employee', 'EmployeeController@index');
Route::get('/employee/{id}/view', ['as' => 'view-employee', 'uses' => 'EmployeeController@viewEmployee']);
Route::get('/employee/create', 'EmployeeController@showCreateForm');
Route::post('/employee/create', 'EmployeeController@postCreate');
Route::get('/employee/{id}/edit', ['as' => 'edit-employee', 'uses' =>  'EmployeeController@showEditForm']);
Route::post('/employee/{id}/edit', ['as' => 'edit-employee', 'uses' =>  'EmployeeController@postEdit']);
Route::delete('/employee/{id}/delete', 'EmployeeController@deleteEmployee');

Route::get('/position', 'PositionController@index');
Route::get('/position/{id}/view', ['as' => 'view-position', 'uses' => 'PositionController@viewPosition']);
Route::get('/position/create', 'PositionController@showCreateForm');
Route::post('/position/create', 'PositionController@postCreate');
Route::get('/position/{id}/edit', ['as' => 'edit-position', 'uses' =>  'PositionController@showEditForm']);
Route::post('/position/{id}/edit', ['as' => 'edit-position', 'uses' =>  'PositionController@postEdit']);
Route::delete('/position/{id}/delete', 'PositionController@deletePosition');

Route::get('/department', 'DepartmentController@index');
Route::get('/department/{id}/view', ['as' => 'view-department', 'uses' => 'DepartmentController@viewDepartment']);
Route::get('/department/create', 'DepartmentController@showCreateForm');
Route::post('/department/create', 'DepartmentController@postCreate');
Route::get('/department/{id}/edit', ['as' => 'edit-department', 'uses' =>  'DepartmentController@showEditForm']);
Route::post('/department/{id}/edit', ['as' => 'edit-department', 'uses' =>  'DepartmentController@postEdit']);
Route::delete('/department/{id}/delete', 'DepartmentController@deleteDepartment');