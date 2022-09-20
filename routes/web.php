<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "AuthController@index")->name('auth.index')->middleware('guest');
Route::post('login', "AuthController@login")->name('auth.login');
Route::post('logout', "AuthController@logout")->name('auth.logout');
Route::get('pagenotfound', "AuthController@pagenotfound")->name('pagenotfound');
Route::post('users/searchUsers', "UsersController@searchUsers")->name('u.searchUsers');
//Route::get('main', "MainController@index")->name('main')->middleware('auth');


//$2y$10$OevD9bxNWujnf0DgHTXRS.W5cLs4mOTmvSsmehnQ7W6p5.foEErpS
Route::group(['middleware' => ['role:administrador']], function () {

    Route::get( 'users/manage' , "UsersController@manage" )->name('u.manage')->middleware('auth');
    Route::post( 'users/manage/create' , "UsersController@manageCreate" )->name('u.manage.create')->middleware('auth');
    Route::post( 'users/manage/edit' , "UsersController@manageEdit" )->name('u.manage.edit')->middleware('auth');
    Route::post( 'users/manage/load' , "UsersController@manageLoad" )->name('u.manage.load')->middleware('auth');
     
    Route::get('reports/recordsManagement', "ReportsController@recordsManagement")->name('recordsManagement')->middleware('auth');
    Route::post('reports/loadRecords', "ReportsController@loadRecords")->name('rep.loadRecords');
    Route::get('reports/downloadExcel/{desde}/{hasta}/{codigo}/{personal}', "ReportsController@downloadExcel")->name('rep.downloadExcel')->middleware('auth');

    Route::get( 'schedule/manage' , "ScheduleController@manage" )->name('sch.manage')->middleware('auth');
    Route::post( 'schedule/manage/create_edit' , "ScheduleController@manageCreateEdit" )->name('sch.create.edit');
    Route::post( 'schedule/manage/load' , "ScheduleController@manageLoad" );

    Route::get( 'schedule/assignment' , "ScheduleController@assignment" )->name('sch.assignment')->middleware('auth');
    Route::post( 'schedule/assignment/load' , "ScheduleController@assignmentLoad" );
    Route::post( 'schedule/assignment/create' , "ScheduleController@assignmentCreate" );

    Route::get( 'schedule/usersBySchedule' , "ScheduleController@usersBySchedule" )->name('sch.usersBySchedule')->middleware("auth");
    Route::post( 'schedule/usersBySchedule/load' , "ScheduleController@usersByScheduleLoad" )->name("sch.usersByScheduleLoad");

});

Route::group(['middleware' => ['role:empleado']], function () {

    Route::get('users/inbox', "UsersController@inbox")->name('users.inbox')->middleware('auth');
    Route::post('users/inboxLoad', "UsersController@inboxLoad")->name('users.inboxLoad');

    Route::get('attendance', "AttendanceController@index")->name('attendance')->middleware('auth');
    Route::post('attendance/register', "AttendanceController@register")->name('attendance.register');

});