<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'Admin\DashboardController@show');
    Route::get('/dashboard', 'Admin\DashboardController@show')->name('admin.dashboard');
    Route::get('/control', 'Admin\HRController@control')->name('admin.hr-control');
    Route::get('/wages', 'Admin\HRController@wages')->name('admin.hr-wage');
    Route::get('/wages_total', 'Admin\HRController@wages_total')->name('admin.hr-wages-total');
    Route::get('/wages_advance', 'Admin\HRController@wages_advance')->name('admin.hr-wages-advance');
    Route::get('/projects', 'Admin\ProjectsController@index')->name('admin.projects');
    Route::post('/projects/store', 'Admin\ProjectsController@store')->name('admin.projects.store');

    Route::get('/employees', 'Admin\EmployeesController@index')->name('admin.employees');
    Route::get('/employees_list', 'Admin\EmployeesController@list')->name('admin.employees.list');
    Route::post('/employees/store', 'Admin\EmployeesController@store')->name('admin.employees.store');
    Route::post('/employees/edit', 'Admin\EmployeesController@edit')->name('admin.employees.edit');
    Route::post('/employees/update', 'Admin\EmployeesController@update')->name('admin.employees.update');
    
    Route::get('/general_settings', 'Admin\SettingsController@general_settings')->name('admin.settings.general');
    Route::post('/general_settings/update', 'Admin\SettingsController@general_settings_update')->name('admin.settings.general-update');

    Route::get('/language_settings/{action}', 'Admin\SettingsController@language_settings')->name('admin.settings.language');
    Route::post('/language_settings/update', 'Admin\SettingsController@language_settings_update')->name('admin.settings.language-update');
    
    Route::get('/code_settings', 'Admin\SettingsController@code_settings')->name('admin.settings.code');
    Route::post('/code_settings/store', 'Admin\SettingsController@code_settings_store')->name('admin.settings.code-add');

    Route::get('/vacationdays_settings', 'Admin\SettingsController@vacationdays_settings')->name('admin.settings.vacationdays');
    Route::post('/vacationdays_settings/store', 'Admin\SettingsController@vacationdays_settings_store')->name('admin.settings.vacationdays-add');
    Route::post('/vacationdays_settings/edit', 'Admin\SettingsController@vacationdays_settings_edit')->name('admin.settings.vacationdays-edit');
    Route::post('/vacationdays_settings/update', 'Admin\SettingsController@vacationdays_settings_update')->name('admin.settings.vacationdays-update');
    Route::post('/vacationdays_settings/delete', 'Admin\SettingsController@vacationdays_settings_delete')->name('admin.settings.vacationdays-delete');


    Route::get('/messages', 'ChatSystemController@index')->name('messages.index');
    Route::get('/timesheet', 'TimeTrackingController@index')->name('timetracking.index');
});