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
Route::get('/messages', 'ChatSystemController@index')->name('messages')->middleware('auth');
Route::get('/messages/{sender}', 'ChatSystemController@index2')->name('messages.hasSender')->middleware('auth');
Route::get('/timesheet', 'TimeTrackingController@index')->name('timetracking')->middleware('auth');
Route::post('/timesheet/store', 'TimeTrackingController@store')->name('timetracking.store')->middleware('auth');
Route::post('/timesheet/delete', 'TimeTrackingController@destroy')->name('timetracking.destroy')->middleware('auth');

Route::group(['middleware' => ['auth','employee']], function(){
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

Route::group(['prefix' => 'admin','middleware' => ['auth','admin']], function(){
    Route::get('/', 'Admin\DashboardController@show')->name('home');
   
    Route::get('/dashboard', 'Admin\DashboardController@show')->name('admin.dashboard');

    Route::get('/control', 'Admin\HRController@control')->name('admin.hr-control');
    Route::post('/control/add', 'Admin\HRController@control_addtime')->name('admin.hr-control.add');
    Route::post('/control/edit', 'Admin\HRController@control_edittime')->name('admin.hr-control.edit');
    Route::post('/control/update', 'Admin\HRController@control_updatetime')->name('admin.hr-control.update');
    Route::post('/control/delete', 'Admin\HRController@control_deletetime')->name('admin.hr-control.delete');
    Route::post('/control/confirmall', 'Admin\HRController@control_confirmall')->name('admin.hr-control.confirmall');

    Route::get('/wages', 'Admin\HRController@wages')->name('admin.hr-wage');
    Route::get('/wages_total', 'Admin\HRController@wages_total')->name('admin.hr-wages-total');
    Route::get('/wages_advance', 'Admin\HRController@wages_advance')->name('admin.hr-wages-advance');

    Route::get('/projects', 'Admin\ProjectsController@index')->name('admin.projects');
    Route::post('/projects/edit', 'Admin\ProjectsController@edit')->name('admin.projects.edit');
    Route::post('/projects/update', 'Admin\ProjectsController@update')->name('admin.projects.update');
    Route::post('/projects/delete', 'Admin\ProjectsController@destroy')->name('admin.projects.destroy');

    Route::post('/projects/store', 'Admin\ProjectsController@store')->name('admin.projects.store');
    Route::get('/projects/calendar', 'Admin\ProjectsController@calendar')->name('admin.projects.calendar');
    
    Route::get('/employees', 'Admin\EmployeesController@list')->name('admin.employees');
    Route::get('/employees/details/{id}', 'Admin\EmployeesController@details')->name('admin.employees.details');
    Route::post('/employees/store', 'Admin\EmployeesController@store')->name('admin.employees.store');
    Route::post('/employees/edit', 'Admin\EmployeesController@edit')->name('admin.employees.edit');
    Route::post('/employees/update', 'Admin\EmployeesController@update')->name('admin.employees.update');
    Route::post('/employees/filters', 'Admin\EmployeesController@filters')->name('admin.employees.filter');
    Route::post('/employees/delete', 'Admin\EmployeesController@destroy')->name('admin.employees.destroy');
    
    Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');
    Route::post('/profile/update', 'Admin\ProfileController@update')->name('admin.profile.update');
    
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

    Route::get('/mailbox', 'MailboxController@index')->name('mailbox');
    Route::get('/mailbox/compose', 'MailboxController@compose')->name('mailbox.compose');
    Route::post('/mailbox/compose', 'MailboxController@send')->name('mailbox.compose');
    Route::get('/mailbox/read/{id}', 'MailboxController@read')->name('mailbox.read');
    Route::get('/mailbox/drafts', 'MailboxController@drafts')->name('mailbox.drafts');
    Route::get('/mailbox/templates', 'MailboxController@templates')->name('mailbox.templates');

    Route::resource('tasks', 'Admin\TasksController', ['except'=>['update', 'destroy']]);
    Route::post('task/update', 'Admin\TasksController@update')->name('tasks.update');
    Route::post('task/destroy', 'Admin\TasksController@destroy')->name('tasks.destroy');

    Route::resource('emailtemplates', 'Admin\EmailTemplatesController', ['except'=>['edit','update', 'destroy']]);
    Route::post('emailtemplates/edit', 'Admin\EmailTemplatesController@edit')->name('emailtemplates.edit');
    Route::post('emailtemplates/update', 'Admin\EmailTemplatesController@update')->name('emailtemplates.update');
    Route::post('emailtemplates/destroy', 'Admin\EmailTemplatesController@destroy')->name('emailtemplates.destroy');

    Route::resource('emailtriggers', 'Admin\EmailTriggersController', ['except'=>['edit','update', 'destroy']]);
    Route::post('emailtriggers/edit', 'Admin\EmailTriggersController@edit')->name('emailtriggers.edit');
    Route::post('emailtriggers/update', 'Admin\EmailTriggersController@update')->name('emailtriggers.update');
    Route::post('emailtriggers/destroy', 'Admin\EmailTriggersController@destroy')->name('emailtriggers.destroy');

    Route::resource('emailactions', 'Admin\EmailActionsController', ['except'=>['edit','update', 'destroy']]);
    Route::post('emailactions/edit', 'Admin\EmailActionsController@edit')->name('emailactions.edit');
    Route::post('emailactions/update', 'Admin\EmailActionsController@update')->name('emailactions.update');
    Route::post('emailactions/destroy', 'Admin\EmailActionsController@destroy')->name('emailactions.destroy');

    Route::resource('tickets', 'Admin\TicketsController', ['except'=>['edit','update', 'destroy']]);
    Route::post('tickets/edit', 'Admin\TicketsController@edit')->name('tickets.edit');
    Route::post('tickets/update', 'Admin\TicketsController@update')->name('tickets.update');
    Route::post('tickets/destroy', 'Admin\TicketsController@destroy')->name('tickets.destroy');

    Route::resource('tickettypes', 'Admin\TicketsTypeController', ['except'=>['edit','update', 'destroy']]);
    Route::post('tickettypes/edit', 'Admin\TicketsTypeController@edit')->name('tickettypes.edit');
    Route::post('tickettypes/update', 'Admin\TicketsTypeController@update')->name('tickettypes.update');
    Route::post('tickettypes/destroy', 'Admin\TicketsTypeController@destroy')->name('tickettypes.destroy');


    Route::resource('vehicles', 'Admin\VehiclesController', ['except'=>['edit','update', 'destroy']]);
    Route::post('vehicles/edit', 'Admin\VehiclesController@edit')->name('vehicles.edit');
    Route::post('vehicles/update', 'Admin\VehiclesController@update')->name('vehicles.update');
    Route::post('vehicles/destroy', 'Admin\VehiclesController@destroy')->name('vehicles.destroy');

    Route::resource('vehiclegroups', 'Admin\VehicleGroupsController', ['except'=>['edit','update', 'destroy']]);
    Route::post('vehiclegroups/edit', 'Admin\VehicleGroupsController@edit')->name('vehiclegroups.edit');
    Route::post('vehiclegroups/update', 'Admin\VehicleGroupsController@update')->name('vehiclegroups.update');
    Route::post('vehiclegroups/destroy', 'Admin\VehicleGroupsController@destroy')->name('vehiclegroups.destroy');

    Route::resource('fuels', 'Admin\FuelsController', ['except'=>['edit','update', 'destroy']]);
    Route::post('fuels/edit', 'Admin\FuelsController@edit')->name('fuels.edit');
    Route::post('fuels/update', 'Admin\FuelsController@update')->name('fuels.update');
    Route::post('fuels/destroy', 'Admin\FuelsController@destroy')->name('fuels.destroy');

}); 